<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <?php $title = "Server Test"; include "./common/head.php"; ?>
    <body onload = "getData()">
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <input id="startServerButton" type="button" value="Start Server" onclick="start_server();" />
                <input id="stopServerButton" type="button" value="Stop Server" onclick="stop_server();" />
                <br><br>
                <fieldset>
                    <legend>Add Entry</legend>
                    <div>
                        <label for="name" class="form_label">Name: </label>
                        <input id="name" class="form_input" type="text">
                    </div>
                    <div>
                        <label for="user_ID" class="form_label">ID:</label>
                        <input id="user_ID" class="form_input" type="text">
                    </div>
                    <br>
                    <input type="submit" value="Add entry" id="submit" onclick="setData()">
                </fieldset>
                <div>
                    <p id="users"></p>
                </div>
                <div>
                    <p id="log"></p>
                </div>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
    </body>

    <script>
        function start_server(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(xhttp.responseText);
                    document.getElementById("log").innerHTML += response.message + "<br>";
                }
            };
            xhttp.open("GET", "./php/start_server.php", true);
            xhttp.send();
        }

        function stop_server(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(xhttp.responseText);
                    document.getElementById("log").innerHTML += response.message + "<br>";
                }
            };
            xhttp.open("GET", "./php/stop_server.php", true);
            xhttp.send();
        }

        // Periodically checks to see if any new NFC cards have been read
        function get_server() {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(xhttp.responseText);
                    if (response.success){
                        document.getElementById("user_ID").value = response.content.replace(/['" ]+/g, '');
                    }
                }
            };
            xhttp.open("GET", "./php/get_server.php", true);
            xhttp.send();
        }

        // Gets values from flatfile DB
        function getData(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(xhttp.responseText);
                    if (response.success){
                        for(const index of response.result.users){
                            document.getElementById("users").innerHTML += "Name: " + index["name"] +", ID: "+ index["id"] + "<br>";
                        }
                    }
                }
            };
            xhttp.open("GET", "./php/flatfile_db.php", true);
            xhttp.send();
        }

        // Sets values in flatfile DB
        function setData(){
            let id = document.getElementById("user_ID").value;
            let name = document.getElementById("name").value;
            // check if Name and ID are set
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(xhttp.responseText);
                    if (response.success){
                        document.getElementById("users").innerHTML = "";
                        for(const index of response.result.users){
                            document.getElementById("users").innerHTML += "Name: " + index["name"] +", ID: "+ index["id"] + "<br>";
                        }
                    }
                }
            };
            xhttp.open("POST", "./php/flatfile_db.php", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.send("id="+encodeURIComponent(id)+"&name="+encodeURIComponent(name));
        }

        setInterval(get_server, 5000); // Time in milliseconds

    </script>
</html>
