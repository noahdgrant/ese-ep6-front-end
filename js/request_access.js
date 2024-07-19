// Javascript for validating information when someone requests access

const MIN_LENGTH = 7;

var form = document.getElementById("request_access");
var email = document.getElementById("email");
var username = document.getElementById("username");
var password = document.getElementById("password");
var verify_password = document.getElementById("verify_password");

form.addEventListener("submit", function(e) {validate_information(e);}, false);
email.addEventListener("keyup", function(e) {validate_email(e);}, false);
email.addEventListener("blur", function(e) {check_email_availability(e);}, false);
username.addEventListener("keyup", function(e) {validate_username(e);}, false);
username.addEventListener("blur", function(e) {check_username_availability(e);}, false);
password.addEventListener("keyup", function(e) {validate_password(e);}, false);
verify_password.addEventListener("keyup", function(e) {validate_verify_password(e);}, false);


function validate_email(e) {
    let error = false;
    let error_msg = "<b>Invalid Email</b><br>";
    document.getElementById("email_errror_msg").innerHTML ="";

    if (!email.value.endsWith("@conestogac.on.ca")) {
        error_msg += "Must provide a valid Conestoga College email.";
        error = true;
    }

    // Print error
    if (error) {
        document.getElementById("email_errror_msg").innerHTML = error_msg;
        if(e.submitter?.id == "submit"){
            e.preventDefault();
        }
    }
}

function validate_username(e) {
    let error = false;
    let error_msg = "<b>Invalid Username</b><br>";
    document.getElementById("user_errror_msg").innerHTML ="";

    // Check length
    if (username.value.length < MIN_LENGTH) {
        error_msg += "Username too short. Minimum length is " + MIN_LENGTH + "<br>";
        error = true;
    }

    // Print error
    if (error) {
        document.getElementById("user_errror_msg").innerHTML =error_msg;
        if(e.submitter?.id == "submit"){
            e.preventDefault();
        }
    }
}

function validate_password(e) {
    let error = false;
    let error_msg = "<b>Invalid Password</b><br>";
    document.getElementById("pswd_errror_msg").innerHTML = "";
    let contains_num = false;

    // Check length
    if (password.value.length < MIN_LENGTH) {
        error_msg += "Use " + MIN_LENGTH + " characters or more for your password.<br>";
        error = true;
    }

    // Check uppercase
    if (password.value === password.value.toLowerCase()) {
        error_msg += "Password must contain an uppercase letter.<br>";
        error = true;
    }

    // Check number
    for (i = 0; i < password.value.length; i++) {
        character = password.value.charAt(i)
        if (!isNaN(character * 1)) {
            contains_num = true;
            break;
        }
    }
    if (contains_num == false) {
        error_msg += "Password must contain a number.<br>";
        error = true;
    }

    // Print error
    
    if (error) {
        document.getElementById("pswd_errror_msg").innerHTML += error_msg;
        if(e.submitter?.id == "submit"){
            e.preventDefault();
        }
    }
}

function validate_verify_password(e) {
    document.getElementById("pswd_vf_errror_msg").innerHTML ="";
    if (password.value != verify_password.value) {
        document.getElementById("pswd_vf_errror_msg").innerHTML ="Passwords don't match.";
        if(e.submitter?.id == "submit"){
            e.preventDefault();
        }
    }
}

async function validate_information(e) {
    validate_email(e);
    validate_username(e);
    validate_password(e);
    validate_verify_password(e);
    await check_username_availability(e);
    await check_email_availability(e);
}

function check_username_availability(e){
    let error_msg = "";
    if (document.getElementById("user_errror_msg").innerHTML == ""){
        error_msg = "<b>Invalid Username</b><br>";
    }
    else{
        error_msg = document.getElementById("user_errror_msg").innerHTML;
    }

    // if the username is valid check to make sure it is not already used in the database
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            // document.getElementById("users").innerHTML = xhttp.responseText;
            let response = JSON.parse(xhttp.responseText);
            if (!response.success){
                document.getElementById("user_errror_msg").innerHTML = error_msg + "Username already taken<br>";
                e.preventDefault();
            }
        }
    };
    xhttp.open("POST", "./php/db_crud.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("username="+encodeURIComponent(username.value)+"&function=check_user");
}

function check_email_availability(e){
    let error_msg = "";
    if (document.getElementById("email_errror_msg").innerHTML == ""){
        error_msg = "<b>Invalid Email</b><br>";
    }
    else{
        error_msg = document.getElementById("email_errror_msg").innerHTML;
    }

    // if the email is valid check to make sure it is not already used in the database
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(xhttp.responseText);
            if (!response.success){
                document.getElementById("email_errror_msg").innerHTML = error_msg + "Email is already in use<br>";
                e.preventDefault();
            }
        }
    };
    xhttp.open("POST", "./php/db_crud.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("email="+encodeURIComponent(email.value)+"&function=check_user");
}

function get_server() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(xhttp.responseText);
            if (response.success){
                document.getElementById("conestoga_id").value = response.content.replace(/['" ]+/g, '');
            }
        }
    };
    xhttp.open("GET", "./php/get_server.php", true);
    xhttp.send();
}

setInterval(get_server, 5000);