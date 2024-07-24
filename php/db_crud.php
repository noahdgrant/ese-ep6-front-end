<?php
session_start();


/*
Reference for different methods of structuring queries:
Method 1:
$result = $database->query("INSERT INTO RequestHistory (Method, Floor) VALUES ($method, $floor)");

Method 2:
$query = "INSERT INTO RequestHistory (Method, Floor) VALUES (:method, :floor)";
$statement = $database->prepare($query);
$statement->bindParam(":method", $method, PDO::PARAM_STR);
$statement->bindParam(":floor", $floor, PDO::PARAM_STR);
$result = $statement->execute();

Method 3:
$statement = $database->prepare("INSERT INTO RequestHistory (Method, Floor) VALUES (?, ?)");
$statement->execute([$method, $floor]);
*/



// Include db connect functions
require "db_connect.php";

if(isset($_POST["function"])){
    // CREATE

    // Select Floor
    // DB: ElevatorOne
    // T: RequestHistory
    if($_POST["function"] === "select_floor"){
        $database = db_connect($db_elevator_one);
        $database->beginTransaction();
        try{
            $floor = $_POST["floor"];

            $statement = $database->prepare("INSERT INTO RequestHistory (Method, Floor) VALUES ('Website', ?)");
            $statement->execute([$floor]);
            $result = $statement->rowCount();

            if ($result == 0){
                throw new Exception("Error: ");
            }
            $database->commit();
        }
        catch(Exception $e){
            $database->rollBack();
            die(json_encode(array("success" => false, "message" => $e)));
        }
        die(json_encode(array("success" => true, "message" => "")));
    }

    // Create User
    // DB: users
    // T: accounts
    elseif($_POST["function"] === "create_user"){
        $database = db_connect("users");
        $database->beginTransaction();
        try{
            $hashed_password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            if($_POST["conestoga_id"]==""){
                $conestoga_card_id = NULL;
            }
            else{
                $conestoga_card_id = $_POST["conestoga_id"];
            }

            $statement = $database->prepare("INSERT INTO accounts (Username, Password, Email, ConestogaCardID) VALUES (?, ?, ?, ?)");
            $statement->execute([$_POST["username"], $hashed_password, $_POST["email"], $conestoga_card_id]);
            $result = $statement->rowCount();

            if ($result == 0){
                throw new Exception("Error: ");
            }
            
            $_SESSION["username"] = $_POST["username"];

            $database->commit();
        }
        catch(Exception $e){
            $database->rollBack();
            header("Location: ../request_access.php");
        }
        header("Location: ../index.php");
    }

    // READ

    // Check New User Credential Availability
    // DB: users
    // T: accounts
    elseif($_POST["function"] === "check_user"){
        $database = db_connect($db_users);
        if(isset($_POST["username"])){
            $query_field = "Username";
            $query_value = $_POST["username"];
        }
        elseif(isset($_POST["email"])){
            $query_field = "Email";
            $query_value = $_POST["email"];
        }
        elseif(isset($_POST["conestoga_card_id"])){
            $query_field = "ConestogaCardID";
            $query_value = $_POST["conestoga_card_id"];
        }

        $statement = $database->prepare("SELECT COUNT(*) FROM accounts WHERE $query_field = :query_field");
        $statement->bindParam(":query_field", $query_value);
        $statement->execute();
        $count = $statement->fetchColumn();
        if ($count > 0) {
            die(json_encode(array("success" => false)));
        } else {
            die(json_encode(array("success" => true)));
        }

    }

    // Check Floor and elevator History
    // DB: ElevatorOne
    // T: FloorHistory
    elseif($_POST["function"] === "check_history"){
        $database = db_connect($db_elevator_one);
        $statement = $database->prepare("SELECT Floor, Id FROM FloorHistory WHERE Id > ?");
        $statement->execute([$_POST["floor_pointer"]]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            die(json_encode(array("success" => true, "data" => $result)));
        }
        else{
            die(json_encode(array("success" => false)));
        }
    }

    // Get Elevator Stats
    // DB: ElevatorOne
    // T: FloorHistory & RequestHistory
    elseif($_POST["function"] === "read_stats"){
        $database = db_connect($db_elevator_one);
        $statement = $database->prepare("SELECT * FROM FloorHistory");
        $statement->execute();
        $floor_result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement = $database->prepare("SELECT * FROM RequestHistory");
        $statement->execute();
        $request_result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if($floor_result && $request_result){
            die(json_encode(array("success" => true, "floor_history" => $floor_result, "request_history" => $request_result)));
        }
        else{
            die(json_encode(array("success" => false)));
        }
    }

    // Login
    // DB: users
    // T: accounts
    elseif($_POST["function"] === "login"){
        $database = db_connect($db_users);

        if($_POST["conestoga_id"]==""){
            $query = "SELECT password FROM accounts WHERE Username = :username";
            $statement = $database->prepare($query);
            $statement->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
            $result = $statement->execute();

            $storedPassword = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($_POST["password"], $storedPassword["password"])){
                // start session
                $_SESSION["username"] = $_POST["username"];
            }
            else{
                session_unset();
                session_destroy();
            }
        }
        else{
            $statement = $database->prepare("SELECT Username FROM accounts WHERE ConestogaCardID = ?");
            $result = $statement->execute([$_POST["conestoga_id"]]);
            $storedUsername = $statement->fetch(PDO::FETCH_ASSOC);
            if ($storedUsername){
                // start session
                $_SESSION["username"] = $storedUsername["Username"];
                die(json_encode(array("success" => true)));
            }
            else{
                session_unset();
                session_destroy();
                die(json_encode(array("success" => false)));
            }
        }
        
        header("Location: ../index.php");

        
    }

    // UPDATE

    // Update User Credentials
    // DB: users
    // T: accounts
    elseif($_POST["function"] === "update_user"){
        $database = db_connect($db_users);
        $database->beginTransaction();
        try{
            $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $statement = $database->prepare("UPDATE accounts SET password = ? WHERE email = ?");
            $statement->execute([$new_password, $_POST["email"]]);
            $result = $statement->rowCount();

            if ($result == 0){
                throw new Exception("Error: Unable to update password");
            }

            // Delete the token
            $statement = $database->prepare("DELETE FROM password_resets WHERE token = ?");
            $statement->execute([$_POST["token"]]);
            $result = $statement->rowCount();

            if ($result == 0){
                throw new Exception("Error: Unable to delete token");
            }

            $database->commit();
        }
        catch(Exception $e){
            $database->rollBack();
            die(json_encode(array("success" => false, "message" => $e)));
        }
        die(json_encode(array("success" => true)));
    }

    // DELETE

}
elseif(isset($_GET["function"])){
    if ($_GET["function"]==="logout"){
        session_unset();
        session_destroy(); 
    }
    header("Location: ../index.php");
}
?>