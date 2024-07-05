<?php
    $servername = "mysql:host=127.0.0.1;dbname=ElevatorOne";
    $username = getenv('MYSQL_USERNAME');
    $password = getenv('MYSQL_PASSWORD');

    // Connect to database
    $database = new PDO($servername, $username, $password);

    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "isset response: " . isset($_POST['floor']) . ", floor value: " . $_POST['floor'];

    if(isset($_POST['floor'])){
        if($_POST['floor']==='1'){
            $result = $database->query("INSERT INTO RequestHistory (Method, Floor) VALUES ('Website', 1)");
        }
        
        else if($_POST['floor']==='2'){
            $result = $database->query("INSERT INTO RequestHistory (Method, Floor) VALUES ('Website', 2)");
        }
    
        else if($_POST['floor']==='3'){
            $result = $database->query("INSERT INTO RequestHistory (Method, Floor) VALUES ('Website', 3)");
        }
    }
    

    
    // Close connection
    $database = null;
    
?>