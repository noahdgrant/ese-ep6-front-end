// on load get all stats
window.addEventListener("load", readStats);

// Global Variables
const fh_counts = {
    "hour": {
        1: Array(24).fill(0),
        2: Array(24).fill(0),
        3: Array(24).fill(0)
    },
    "day":{
        1: Array(7).fill(0),
        2: Array(7).fill(0),
        3: Array(7).fill(0)
    },
    "total": Array(3).fill(0)
}


const rh_counts = {
    "hour":{
       "Website": Array(24).fill(0),
       "Voice": Array(24).fill(0),
       "FloorOneController": Array(24).fill(0),
       "FloorTwoController": Array(24).fill(0),
       "FloorThreeController": Array(24).fill(0),
       "CarController": Array(24).fill(0)
    },
    "day":{
        "Website": Array(7).fill(0),
        "Voice": Array(7).fill(0),
        "FloorOneController": Array(7).fill(0),
        "FloorTwoController": Array(7).fill(0),
        "FloorThreeController": Array(7).fill(0),
        "CarController": Array(7).fill(0)
    },
    "total":{
        "Website": 0,
        "Voice": 0,
        "FloorOneController": 0,
        "FloorTwoController": 0,
        "FloorThreeController": 0,
        "CarController": 0
    }
}

let barColors = ["#003f5c", "#444e86", "#955196", "#dd5182", "#ff6e54", "#ffa600"];

function readStats(){
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            let response = JSON.parse(xhttp.responseText);
            if(response.success){
                console.log("Successfully got elevator history")
                processData(response);
                initializeFhTimeChart();
                $('#fh_time_canv').data('initialized', true);
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

function processData(data){

    for ( id in data.floor_history) {
        let day = new Date(data.floor_history[id]["Date"]).getDay();
        let hour = data.floor_history[id]["Time"].substring(0,2);
        let floor = data.floor_history[id]["Floor"];
        fh_counts.hour[floor][parseInt(hour)]++;
        fh_counts.day[floor][parseInt(day)]++;
        fh_counts.total[floor-1]++;
    }

    for ( id in data.request_history) {
        let day = new Date(data.request_history[id]["Date"]).getDay();
        let hour = data.request_history[id]["Time"].substring(0,2);
        let method = data.request_history[id]["Method"];
        rh_counts.hour[method][parseInt(hour)]++;
        rh_counts.day[method][parseInt(day)]++;
        rh_counts.total[method]++;
    }
}

function initializeFhTimeChart() {
    var ctx = document.getElementById("fh_time_canv").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
            datasets: [{
                label: "Floor 1",
                backgroundColor: barColors[0],
                data: fh_counts.hour[1],
            }, {
                label: "Floor 2",
                backgroundColor: barColors[1],
                data: fh_counts.hour[2],
            }, {
                label: "Floor 3",
                backgroundColor: barColors[2],
                data: fh_counts.hour[3],
            }],
        },
        options: {
            tooltips: {
                displayColors: true,
                callbacks:{
                    mode: "x",
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
                    type: "linear",
                }]
            },
            responsive: true,
            maintainAspectRatio: false,
            legend: { position: "bottom" },
        }
    });
}

function initializeFhDayChart() {
    var ctx = document.getElementById("fh_day_canv").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["MON","TUE","WED","THU","FRI","SAT","SUN"],
            datasets: [{
                label: "Floor 1",
                backgroundColor: barColors[0],
                data: fh_counts.day[1],
            }, {
                label: "Floor 2",
                backgroundColor: barColors[1],
                data: fh_counts.day[2],
            }, {
                label: "Floor 3",
                backgroundColor: barColors[2],
                data: fh_counts.day[3],
            }],
        },
        options: {
            tooltips: {
                displayColors: true,
                callbacks:{
                    mode: "x",
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
                    type: "linear",
                }]
            },
            responsive: true,
            maintainAspectRatio: false,
            legend: { position: "bottom" },
        }
    });
}

function initializeRhTimeChart() {
    var ctx = document.getElementById("rh_time_canv").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
            datasets: [{
                label: "Website",
                backgroundColor: barColors[0],
                data: rh_counts.hour["Website"],
            }, {
                label: "Voice",
                backgroundColor:  barColors[1],
                data: rh_counts.hour["Voice"],
            }, {
                label: "Floor 1",
                backgroundColor: barColors[2],
                data: rh_counts.hour["FloorOneController"],
            }, {
                label: "Floor 2",
                backgroundColor: barColors[3],
                data: rh_counts.hour["FloorTwoController"],
            }, {
                label: "Floor 3",
                backgroundColor: barColors[4],
                data: rh_counts.hour["FloorThreeController"],
            }, {
                label: "Car Controller",
                backgroundColor: barColors[5],
                data: rh_counts.hour["CarController"],
            }],
        },
        options: {
            tooltips: {
                displayColors: true,
                callbacks:{
                    mode: "x",
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
                    type: "linear",
                }]
            },
            responsive: true,
            maintainAspectRatio: false,
            legend: { position: "bottom" },
        }
    });
}

function initializeRhDayChart() {
    var ctx = document.getElementById("rh_day_canv").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["MON","TUE","WED","THU","FRI","SAT","SUN"],
            datasets: [{
                label: "Website",
                backgroundColor: barColors[0],
                data: rh_counts.day["Website"],
            }, {
                label: "Voice",
                backgroundColor: barColors[1],
                data: rh_counts.day["Voice"],
            }, {
                label: "Floor 1",
                backgroundColor: barColors[2],
                data: rh_counts.day["FloorOneController"],
            }, {
                label: "Floor 2",
                backgroundColor: barColors[3],
                data: rh_counts.day["FloorTwoController"],
            }, {
                label: "Floor 3",
                backgroundColor: barColors[4],
                data: rh_counts.day["FloorThreeController"],
            }, {
                label: "Car Controller",
                backgroundColor: barColors[5],
                data: rh_counts.day["CarController"],
            }],
        },
        options: {
            tooltips: {
                displayColors: true,
                callbacks:{
                    mode: "x",
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
                    type: "linear",
                }]
            },
            responsive: true,
            maintainAspectRatio: false,
            legend: { position: "bottom" },
        }
    });
}

function initializeRhPieChart() {
    var ctx = document.getElementById("rh_pie_canv").getContext("2d");

    var xValues = ["Website", "Voice", "Floor 1", "Floor 2", "Floor 3", "Car Controller"];
    var yValues = [ rh_counts.total["Website"],
                    rh_counts.total["Voice"],
                    rh_counts.total["FloorOneController"],
                    rh_counts.total["FloorTwoController"],
                    rh_counts.total["FloorThreeController"],
                    rh_counts.total["CarController"]];

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
                text: "Request History"
            }
        }
    });
}

function initializeFhPieChart() {
    var ctx = document.getElementById("fh_pie_canv").getContext("2d");

    var xValues = ["Floor 1", "Floor 2", "Floor 3"];
    var yValues = fh_counts.total;

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
                text: "Floor History"
            }
        }
    });
}

$("a[data-toggle='tab']").on("shown.bs.tab", function (e) {
    var target = $(e.target).attr("href"); // Get the target tab

    switch(target) {
        case "#fh_time":
            if (!$("#fh_time_canv").data("initialized")) {
                initializeFhTimeChart();
                $("#fh_time_canv").data("initialized", true);
            }
            break;
        case "#fh_day":
            if (!$("#fh_day_canv").data("initialized")) {
                initializeFhDayChart();
                $("#fh_day_canv").data("initialized", true);
            }
            break;
        case "#rh_time":
            if (!$("#rh_time_canv").data("initialized")) {
                initializeRhTimeChart();
                $("#rh_time_canv").data("initialized", true);
            }
            break;
        case "#rh_day":
            if (!$("#rh_day_canv").data("initialized")) {
                initializeRhDayChart();
                $("#rh_day_canv").data("initialized", true);
            }
            break;
        case "#rh_pie":
            if (!$("#rh_pie_canv").data("initialized")) {
                initializeRhPieChart();
                $("#rh_pie_canv").data("initialized", true);
            }
            break;
        case "#fh_pie":
            if (!$("#fh_pie_canv").data("initialized")) {
                initializeFhPieChart();
                $("#fh_pie_canv").data("initialized", true);
            }
            break;
    }
});