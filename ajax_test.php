<!DOCTYPE html>
<html lang="en">
    <?php $title = "Ajax Test"; include "./common/head.php"; ?>
    <body onload = "getData()">
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <fieldset>
                    <legend>Add Entry</legend>
                    <div>
                        <label for="name" class="form_label">Name: </label>
                        <input id="name" class="form_input" type="text">
                    </div>
                    <div>
                        <label for="ID" class="form_label">ID:</label>
                        <input id="ID" class="form_input" type="text">
                    </div>
                    <br>
                    <input type="submit" value="Add entry" id="submit" onclick="setData()">
                </fieldset>
                <div>
                    <p id="users"></p>
                </div>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
    </body>

    <script>
        function getData(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Typical action to be performed when the document is ready:
                    document.getElementById("users").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("GET", "./php/flatfile_db.php", true);
            xhttp.send();
        }
        function setData(){
            let id = document.getElementById("ID").value;
            let name = document.getElementById("name").value;
            // check if Name and ID are set
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Typical action to be performed when the document is ready:
                    document.getElementById("users").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "./php/flatfile_db.php", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.send("id="+encodeURIComponent(id)+"&name="+encodeURIComponent(name));
        }
    </script>
</html>
