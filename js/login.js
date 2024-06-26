function floor_select(floor) {
    document.getElementById("audioElement").play();
    let btn_1 = document.getElementById("btn_1");
    let btn_2 = document.getElementById("btn_2");
    let btn_3 = document.getElementById("btn_3");
    btn_1.src = "./images/elevator_btns/elevator-btn-1.png"
    btn_2.src = "./images/elevator_btns/elevator-btn-2.png"
    btn_3.src = "./images/elevator_btns/elevator-btn-3.png"
    if (floor==1) {
        btn_1.src = "./images/elevator_btns/elevator-btn-1-grn.png"
    }
    else if (floor==2) {
        btn_2.src = "./images/elevator_btns/elevator-btn-2-grn.png"
    }
    else if(floor==3){
        btn_3.src = "./images/elevator_btns/elevator-btn-3-grn.png"
    }
}


window.addEventListener("load", (event) => {
    // if not logged in:
    document.getElementById("username").focus();
});



const MIN_LENGTH = 5;

var form;
var username;
var password;
var username_feedback;
var password_feedback;

form = document.getElementById("login");
username = document.getElementById("username");
password = document.getElementById("password");

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

    // Print error
    
    if (error) {
        document.getElementById("pswd_errror_msg").innerHTML += error_msg;
        if(e.submitter?.id == "submit"){
            e.preventDefault();
        }
    }
}

function validate_information(e) {
    validate_username(e);
    validate_password(e);
}
