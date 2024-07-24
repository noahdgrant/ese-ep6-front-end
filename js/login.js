// Javascript for validating login information & Elevator Control GUI
let is_debug = false;

// Login Form Validation

// Login Form Variables 
const MIN_LENGTH = 5;
var form = document.getElementById("login");
var username = document.getElementById("username");
var password = document.getElementById("password");
var conestoga_id = document.getElementById("conestoga_id")

// Elevator Control Variables
var current_floor;
var floor_history_pointer;
var btn_1 = document.getElementById("btn_1");
var btn_2 = document.getElementById("btn_2");
var btn_3 = document.getElementById("btn_3");
var elev = document.getElementById("elevator_image");


window.addEventListener("load", (event) => {
    // if not logged in:
    if(username){
        username.focus();
        form.addEventListener("submit", function(e) {validate_information(e);}, false);
        username.addEventListener("keyup", function(e) {validate_username(e);}, false);
        password.addEventListener("keyup", function(e) {validate_password(e);}, false);
        setInterval(get_server, 5000);
    }
    else{
        // initialize elevatorHistory && floorHistory pointers
        setInterval(update_pointers, 1000);
        btn_1.addEventListener("click", function(e) {floor_select(1);}, false);
        btn_2.addEventListener("click", function(e) {floor_select(2);}, false);
        btn_3.addEventListener("click", function(e) {floor_select(3);}, false);
    }
});

// Check for Login attempt via NFC
function get_server() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            let response = JSON.parse(xhttp.responseText);
            if (response.success){
                login_with_id(response.content.replace(/['" ]+/g, ''))
            }
        }
    };
    xhttp.open("GET", "./php/get_server.php", true);
    xhttp.send();
}

// Login via NFC
function login_with_id(id) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(xhttp.responseText);
            if (response.success){
                location.href = "index.php";
            }
        }
    };
    xhttp.open("POST", "./php/db_crud.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("conestoga_id="+encodeURIComponent(id)+"&function=login");
}

// Ensure username meets the required length
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
        document.getElementById("user_errror_msg").innerHTML = error_msg;
        if(e.submitter?.id === "submit"){
            e.preventDefault();
        }
    }
}

// Ensure password meets the required length
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

// Check username and password lenghts before submitting the form
function validate_information(e) {
    if(conestoga_id.value === ""){
        validate_username(e);
        validate_password(e);
    }
}


function floor_select(floor) {
    document.getElementById("audioElement").play();

    document.getElementById("btn_"+floor).src = "./images/elevator_btns/elevator-btn-"+floor+"-grn.png";

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(xhttp.responseText);
            if(is_debug){
                console.log(response);
            }
            
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
                if(response.data.length > 0){   // New data in floor history
                    floor_history_pointer = Math.max(...response.data.map(item => item.Id));
                    if(response.data.some(item => item.Floor === "1")){
                        btn_1.src = "./images/elevator_btns/elevator-btn-1.png"
                    }
                    if(response.data.some(item => item.Floor === "2")){
                        btn_2.src = "./images/elevator_btns/elevator-btn-2.png"
                    }
                    if(response.data.some(item => item.Floor === "3")){
                        btn_3.src = "./images/elevator_btns/elevator-btn-3.png"
                    }

                    elev.src = "./images/elevator_"+response.data.find(item => item.Id == floor_history_pointer).Floor+".png"
                }
            }
            else if(is_debug){
                console.log("Error Getting DB Pointers");
            }
        }
    };
    xhttp.open("POST", "./php/db_crud.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("function=check_history&floor_pointer="+encodeURIComponent(floor_history_pointer));
}