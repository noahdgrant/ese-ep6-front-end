// Javascript for submitting password request form
const MIN_LENGTH = 7;

var form = document.getElementById("reset_password");
var password = document.getElementById("password");
var action = document.getElementById("function").value;
var token = document.getElementById("token").value;
var email = document.getElementById("email").value;

password.addEventListener("keyup", function(e) {validate_password(e);}, false);
form.addEventListener("submit", function(e) {validate_information(e);}, false);

function validate_information(e) {
    e.preventDefault();

    if(validate_password(e)){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Typical action to be performed when the document is ready:
                let response = JSON.parse(xhttp.responseText);
                if (response.success){
                    alert("Password Changed Successfully");
                    location.href = "index.php";
                }
                else{
                    alert("Error Changing Password");
                }
            }
        };
        xhttp.open("POST", "./php/db_crud.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("password="+encodeURIComponent(password.value)+"&function="+encodeURIComponent(action)+"&token="+encodeURIComponent(token)+"&email="+encodeURIComponent(email));
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
        return false;
    }
    return true;
}