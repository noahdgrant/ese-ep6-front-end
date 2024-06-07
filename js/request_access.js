// Javascript for validating information when someone requests access

const MIN_LENGTH = 5;

var form;
var email;
var username;
var password;
var verify_password;
var username_feedback;
var password_feedback;
var verify_password_feedback;

form = document.getElementById("request_access");
email = document.getElementById("email");
username = document.getElementById("username");
password = document.getElementById("password");
verify_password = document.getElementById("verify_password");

form.addEventListener("submit", function(e) {validate_information(e);}, false);
email.addEventListener("keyup", function(e) {validate_email(e);}, false);
username.addEventListener("keyup", function(e) {validate_username(e);}, false);
password.addEventListener("keyup", function(e) {validate_password(e);}, false);
verify_password.addEventListener("keyup", function(e) {validate_verify_password(e);}, false);

function validate_email(e) {
    document.getElementById("email_errror_msg").innerHTML ="";

    // check to see if username is already used

    if (!email.value.endsWith("@conestogac.on.ca")) {
        document.getElementById("email_errror_msg").innerHTML = "<b>Invalid Email</b><br>Must provide a valid Conestoga College email.";
        if(e=="submit"){
            e.preventDefault();
        }
    }
}

function validate_username(e) {
    let error = false;
    let error_msg = "<b>Invalid Username</b><br>";
    document.getElementById("user_errror_msg").innerHTML ="";
    let contains_uppercase = false;
    let contains_num = false;

    // Check length
    if (username.value.length < MIN_LENGTH) {
        error_msg += "Username too short. Minimum length is " + MIN_LENGTH + "<br>";
        error = true;
    }
    // check database to see if username is already taken

    // Print error
    if (error) {
        document.getElementById("user_errror_msg").innerHTML =error_msg;
        if(e=="submit"){
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
        if(e=="submit"){
            e.preventDefault();
        }
    }
}

function validate_verify_password(e) {
    document.getElementById("pswd_vf_errror_msg").innerHTML ="";
    if (password.value != verify_password.value) {
        document.getElementById("pswd_vf_errror_msg").innerHTML ="Passwords don't match.";
        if(e=="submit"){
            e.preventDefault();
        }
    }
}

function validate_information(e) {
    validate_email(e);
    validate_username(e);
    validate_password(e);
    validate_verify_password(e);
}