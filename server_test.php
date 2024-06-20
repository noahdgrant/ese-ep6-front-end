<!DOCTYPE html>
<html lang="en">
    <?php $title = "Server Test"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <input id="startServerButton" type="button" value="Start Server" onclick="start_server();" />
                <input id="stopServerButton" type="button" value="Stop Server" onclick="stop_server();" />
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
                    // Typical action to be performed when the document is ready:
                    document.getElementById("log").innerHTML += xhttp.responseText;
                    getData();
                }
            };
            xhttp.open("GET", "./php/start_server.php", true);
            xhttp.send();
        }

        function stop_server(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Typical action to be performed when the document is ready:
                    document.getElementById("log").innerHTML += xhttp.responseText;
                    getData();
                }
            };
            xhttp.open("GET", "./php/stop_server.php", true);
            xhttp.send();
        }

        function get_server() {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Typical action to be performed when the document is ready:
                    document.getElementById("log").innerHTML += xhttp.responseText;
                    getData();
                }
            };
            xhttp.open("GET", "./php/get_server.php", true);
            xhttp.send();
        }

        setInterval(get_server, 5000); // Time in milliseconds

    </script>
</html>
