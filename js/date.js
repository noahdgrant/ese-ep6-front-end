// javascript used to print age in logbook about page
let today = new Date();
let year = today.getFullYear();
let birthdate = new Date("June 26, 2002, 12:00:00");

let age = today.getTime() - birthdate.getTime();
age = Math.floor(age/31556900000);
if (document.getElementById("age") != null){
    document.getElementById("age").innerHTML=age;
}
if (document.getElementById("current_date") != null){
    setInterval(update_time, 1000);
    document.getElementById("current_date").innerHTML=today.toLocaleString("en-CA");
}
document.getElementById("year").innerHTML=year;

function update_time(){
    today = new Date();
    document.getElementById("current_date").innerHTML=today.toLocaleString("en-CA");
}