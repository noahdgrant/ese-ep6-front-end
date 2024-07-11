// Javascript for validating login information & Elevator Control GUI

// Login Form Validation

window.addEventListener("load", (event) => {
    // if not logged in:
    if(document.getElementById("username")){
        document.getElementById("username").focus();
    }
    else{
        // initialize elevatorHistory && floorHistory pointers
        setInterval(update_pointers, 1000);
    }
});

// Elevator GUI Variables
var current_floor;
var floor_history_pointer;

// Login Form Variables 
const MIN_LENGTH = 5;
var form = document.getElementById("login");
var username = document.getElementById("username");
var password = document.getElementById("password");
var btn_1 = document.getElementById("btn_1");
var btn_2 = document.getElementById("btn_2");
var btn_3 = document.getElementById("btn_3");
var elev = document.getElementById("elevator_image");


// if not logged in:
if(form){
    form.addEventListener("submit", function(e) {validate_information(e);}, false);
    username.addEventListener("keyup", function(e) {validate_username(e);}, false);
    password.addEventListener("keyup", function(e) {validate_password(e);}, false);
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

// Elevator Control GUI

document.getElementById("btn_1").addEventListener("click", function(e) {floor_select(1);}, false);
document.getElementById("btn_2").addEventListener("click", function(e) {floor_select(2);}, false);
document.getElementById("btn_3").addEventListener("click", function(e) {floor_select(3);}, false);

function floor_select(floor) {
    document.getElementById("audioElement").play();
    // btn_1.src = "./images/elevator_btns/elevator-btn-1.png"
    // btn_2.src = "./images/elevator_btns/elevator-btn-2.png"
    // btn_3.src = "./images/elevator_btns/elevator-btn-3.png"

    if (floor==1) {
        btn_1.src = "./images/elevator_btns/elevator-btn-1-grn.png"
    }
    else if (floor==2) {
        btn_2.src = "./images/elevator_btns/elevator-btn-2-grn.png"
    }
    else if(floor==3){
        btn_3.src = "./images/elevator_btns/elevator-btn-3-grn.png"
    }
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            document.getElementById("debug").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("POST", "./php/db_crud.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("floor="+encodeURIComponent(floor)+"&function=select_floor");
}

function update_pointers(){
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            let response = JSON.parse(xhttp.responseText);
            if (response.success){
                if(response.data.length > 0){
                    // New data in floor history
                    floor_history_pointer = Math.max(...response.data.map(item => item.Id));
                    if(response.data.some(item => item.Floor === 1)){
                        btn_1.src = "./images/elevator_btns/elevator-btn-1.png"
                    }
                    if(response.data.some(item => item.Floor === 2)){
                        btn_2.src = "./images/elevator_btns/elevator-btn-2.png"
                    }
                    if(response.data.some(item => item.Floor === 3)){
                        btn_3.src = "./images/elevator_btns/elevator-btn-3.png"
                    }

                    elev.src = "./images/elevator_"+response.data.find(item => item.Id === floor_history_pointer).Floor+".png"
                }
            }
            else{
                console.log("Error Getting DB Pointers");
            }
        }
    };
    xhttp.open("POST", "./php/db_crud.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("function=check_history&floor_pointer="+encodeURIComponent(floor_history_pointer));
}