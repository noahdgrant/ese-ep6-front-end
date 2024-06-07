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
email.addEventListener("blur", function(e) {validate_email(e);}, false);
username.addEventListener("blur", function(e) {validate_username(e);}, false);
password.addEventListener("blur", function(e) {validate_password(e);}, false);
verify_password.addEventListener("blur", function(e) {validate_verify_password(e);}, false);

function validate_email(e) {
    if (!email.value.endsWith("@conestogac.on.ca")) {
        alert("Must provide a valid Conestoga College email.");
        e.preventDefault();
    }
}

function validate_username(e) {
    let error = false;
    let error_msg = "";
    let contains_uppercase = false;
    let contains_num = false;

    // Check length
    if (username.value.length < MIN_LENGTH) {
        error_msg += "Username too short. Minimum length is " + MIN_LENGTH + ".\n";
        error = true;
    }

    // Check uppercase
    for (i = 0; i < username.value.length; i++) {
        character = username.value.charAt(i)
        if (character == character.toUpperCase()) {
            contains_uppercase = true;
            break;
        }
    }
    if (contains_uppercase == false) {
        error_msg += "Username must contain an uppercase letter.\n";
        error = true;
    }

    // Check number
    for (i = 0; i < username.value.length; i++) {
        character = username.value.charAt(i)
        if (!isNaN(character * 1)) {
            contains_num = true;
            break;
        }
    }
    if (contains_num == false) {
        error_msg += "Username must contain a number.\n";
        error = true;
    }

    // Print error
    if (error) {
        alert(error_msg);
        e.preventDefault();
    }
}

function validate_password(e) {
    let error = false;
    let error_msg = "";
    let contains_uppercase = false;
    let contains_num = false;

    // Check length
    if (password.value.length < MIN_LENGTH) {
        error_msg += "Password too short. Minimum length is " + MIN_LENGTH + ".\n";
        error = true;
    }

    // Check uppercase
    for (i = 0; i < password.value.length; i++) {
        character = password.value.charAt(i)
        if (character == character.toUpperCase()) {
            contains_uppercase = true;
            break;
        }
    }
    if (contains_uppercase == false) {
        error_msg += "Password must contain an uppercase letter.\n";
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
        error_msg += "Password must contain a number.\n";
        error = true;
    }

    // Print error
    if (error) {
        alert(error_msg);
        e.preventDefault();
    }
}

function validate_verify_password(e) {
    if (password.value != verify_password.value) {
        alert("Passwords don't match.");
        e.preventDefault();
    }
}

function validate_information(e) {
    validate_email(e);
    validate_username(e);
    validate_password(e);
    validate_verify_password(e);
}
