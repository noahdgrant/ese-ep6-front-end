// Javascript for submitting password request form

var form = document.getElementById("request_reset");
var email = document.getElementById("email");

form.addEventListener("submit", function(e) {validate_information(e);}, false);

function validate_information(e) {
    e.preventDefault();
    if (email.value != ""){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Typical action to be performed when the document is ready:
                let response = JSON.parse(xhttp.responseText);
                if (response.success){
                    alert("Email Sent Successfully");
                }
                else{
                    alert("Error Sending Email");
                }
            }
        };
        xhttp.open("POST", "./php/reset_creds.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("email="+encodeURIComponent(email.value));
        email.value = "";
    }
}
