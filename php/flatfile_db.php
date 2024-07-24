<?php
    $file_path = "../json/users.json";

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $contents = file_get_contents($file_path) or die(json_encode(array("success" => false, "message" => "Unable to read flatfile")));
        $contents = json_decode($contents, true) or die(json_encode(array("success" => false, "message" => "Unable to decode flatfile")));
        die(json_encode(array("success" => true, "result" => $contents)));
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $contents = file_get_contents($file_path);
        $php_array=json_decode($contents, true);

        $new_user = array(
            "id" => $_POST["id"],
            "name" => $_POST["name"]
        );

        foreach ($php_array["users"] as $user) {
            if ($user["id"] === $new_user["id"]) {
                die(json_encode(array("success" => false, "message" => "Error: A user with the same ID already exists.")));
            }
        }

        $php_array["users"][] = $new_user;

        $JSON_string = json_encode($php_array, JSON_PRETTY_PRINT);

        file_put_contents($file_path, $JSON_string);

        die(json_encode(array("success" => true, "result" => $php_array)));
    }
?>