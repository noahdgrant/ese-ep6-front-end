<?php
session_start();
// Databases
$db_users = "users";
$db_elevator_one = "ElevatorOne";

// Connect to database
function db_connect($db) {
    $username = getenv("MYSQL_USERNAME");
    $password = getenv("MYSQL_PASSWORD");
    $host = "127.0.0.1";
    $path = "mysql:host=".$host.";dbname=".$db;

    $database = new PDO($path, $username, $password);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $database;
}

function shutdown() {
    global $database;
    if ($database) {
        $database = null;
    }
}
register_shutdown_function("shutdown");

if(isset($_POST["function"])){
    // CREATE

    // Select Floor
    // DB: ElevatorOne
    // T: RequestHistory
    if($_POST["function"] === "select_floor"){
        $database = db_connect($db_elevator_one);
        $floor = $_POST["floor"];
        $result = $database->query("INSERT INTO RequestHistory (Method, Floor) VALUES ('Website', $floor)");
        //die(json_encode(array("success" => false, "message" => "Error: .")));
    }

    // Create User
    // DB: users
    // T: accounts
    elseif($_POST["function"] === "create_user"){
        $database = db_connect("users");
        $hashed_password = password_hash($_POST["password"], PASSWORD_BCRYPT);
        if($_POST["conestoga_id"]==""){
            $conestoga_card_id = NULL;
        }
        else{
            $conestoga_card_id = $_POST["conestoga_id"];
        }
        $query = "INSERT INTO accounts (Username, Password, Email, ConestogaCardID) VALUES (:Username, :Password, :Email, :ConestogaCardID)";
        $statement = $database->prepare($query);
        $statement->bindParam(":ConestogaCardID", $conestoga_card_id, PDO::PARAM_STR);
        $statement->bindParam(":Username", $_POST["username"], PDO::PARAM_STR);
        $statement->bindParam(":Password", $hashed_password, PDO::PARAM_STR);
        $statement->bindParam(":Email", $_POST["email"], PDO::PARAM_STR);
        
        $result = $statement->execute();

        $_SESSION["username"] = $_POST["username"];
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
        $statement->bindParam(':query_field', $query_value);
        $statement->execute();
        $count = $statement->fetchColumn();
        if ($count > 0) {
            die(json_encode(array("success" => false)));
        } else {
            die(json_encode(array("success" => true)));
        }

    }

    // Check Current Floor
    // DB: ElevatorOne
    // T: FloorHistory
    elseif($_POST["function"] === "check_floor"){
        $database = db_connect($db_elevator_one);

        $statement = $database->prepare("SELECT * FROM FloorHistory WHERE Id = (SELECT MAX(Id) FROM FloorHistory)");
        $statement->execute();

        $currentFloor = $statement->fetch(PDO::FETCH_ASSOC);

        if($currentFloor){
            die(json_encode(array("success" => true, "message" => $currentFloor["Floor"])));
        }else{
            die(json_encode(array("success" => false)));
        }

    }

    // Login
    // DB: users
    // T: accounts
    elseif($_POST["function"] === "login"){
        $database = db_connect($db_users);

        $query = "SELECT password FROM accounts WHERE username = :username";
        $statement = $database->prepare($query);
        $statement->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
        $result = $statement->execute();

        $storedPassword = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($_POST["password"], $storedPassword['password'])){
            // start session
            $_SESSION["username"] = $_POST["username"];
        }
        else{
            session_unset();
            session_destroy();
        }
        header("Location: ../index.php");

        
    }

    // UPDATE

    // Update User Credentials
    // DB: users
    // T: accounts
    elseif($_POST["function"] === "update_user"){
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
        elseif(isset($_POST["password"])){
            $query_field = "Password";
            $query_value = $_POST["password"];
        }
    }

    // DELETE

    // Close connection
    $database = null;
}
elseif(isset($_GET["function"])){
    if ($_GET["function"]==="logout"){
        session_unset();
        session_destroy(); 
    }
    header("Location: ../index.php");
}
?>