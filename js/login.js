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