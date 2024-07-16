// on load get all stats
window.addEventListener("load", read_stats);



function read_stats(){
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            let response = JSON.parse(xhttp.responseText);
            if(response.success){
                console.log("Successfully got elevator history")
                create_charts();
            }
            else{
                console.log("Error getting elevator history")
            }
        }
    };
    xhttp.open("POST", "./php/db_crud.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("function=read_stats");
}


function create_charts(){
    var ctx = document.getElementById("HOMEChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["<  1","1 - 2","3 - 4","5 - 9","10 - 14","15 - 19","20 - 24","25 - 29","> - 29"],
            datasets: [{
                label: "Webpage",
                backgroundColor: "#caf270",
                data: [12, 59, 5, 56, 58,12, 59, 87, 45],
            }, {
                label: "Voice",
                backgroundColor: "#45c490",
                data: [12, 59, 5, 56, 58,12, 59, 85, 23],
            }, {
                label: "Floor 1",
                backgroundColor: "#008d93",
                data: [12, 59, 5, 56, 58,12, 59, 65, 51],
            }, {
                label: "Floor 2",
                backgroundColor: "#2e5468",
                data: [12, 59, 5, 56, 58, 12, 59, 12, 74],
            }],
        },
        options: {
            tooltips: {
                displayColors: true,
                callbacks:{
                    mode: 'x',
                },
            },
            scales: {
                xAxes: [{
                    stacked: true,
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    stacked: true,
                    ticks: {
                        beginAtZero: true,
                    },
                    type: 'linear',
                }]
            },
            responsive: true,
            maintainAspectRatio: false,
            legend: { position: 'bottom' },
        }
    });



    var ctx = document.getElementById("menu1Chart").getContext('2d');

    var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
    var yValues = [55, 49, 44, 24, 15];
    var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
    ];

    new Chart(ctx, {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "World Wide Wine Production 2018"
            }
        }
    });
}