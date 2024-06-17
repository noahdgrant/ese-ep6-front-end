<?php
    $file_path = './json/users.json';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $contents = file_get_contents($file_path);
        $php_array=json_decode($contents, true);
        foreach($php_array['users'] as $user){
            echo "User: " . $user["name"] . ", ID: " . $user["id"] . "<br>";
        }
    }
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(!file_exists($file_path) || !is_writeable("./json/users.json")){
            die("Error: User not added, database not accessible <br>");
        }

        $contents = file_get_contents($file_path);
        $php_array=json_decode($contents, true);

        $new_user = array(
            'id' => $_POST['id'],
            'name' => $_POST['name']
        );

        foreach ($php_array['users'] as $user) {
            if ($user['id'] === $new_user['id']) {
                die('Error: A user with the same ID already exists.');
            }
        }

        $php_array['users'][] = $new_user;

        $JSON_string = json_encode($php_array, JSON_PRETTY_PRINT);

        file_put_contents($file_path, $JSON_string);

        foreach($php_array['users'] as $user){
            echo "User: " . $user["name"] . ", ID: " . $user["id"] . "<br>";
        }
    }
?>