// this wont work if already logged in
window.addEventListener("load", (event) => {
    // if not logged in:
    document.getElementById("username").focus();
});



const MIN_LENGTH = 5;


var form = document.getElementById("login");
var username = document.getElementById("username");
var password = document.getElementById("password");

form.addEventListener("submit", function(e) {validate_information(e);}, false);
username.addEventListener("keyup", function(e) {validate_username(e);}, false);
password.addEventListener("keyup", function(e) {validate_password(e);}, false);

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
        document.getElementById("user_errror_msg").innerHTML = error_msg;
        if(e.submitter?.id === "submit"){
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

    // Print error
    
    if (error) {
        document.getElementById("pswd_errror_msg").innerHTML += error_msg;
        if(e.submitter?.id === "submit"){
            e.preventDefault();
        }
    }
}

function validate_information(e) {
    validate_username(e);
    validate_password(e);
}
