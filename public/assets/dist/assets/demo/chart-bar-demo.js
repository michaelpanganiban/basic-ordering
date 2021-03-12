const getBarChart = (year = null, month = null) => {
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    let labelContainer = []
    let hours = []
    $.post("/getDistinctTags", {year, month}, function(r){
        const temp_data = jQuery.parseJSON(r)
        let labelContainer = []
        temp_data && temp_data.map(x => {
            labelContainer.push(x.tag)
            hours.push(x.hours)
        })

        // Bar Chart
        var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelContainer,
                datasets: [{
                    label: "Hours",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: hours,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 50,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    })

}

getBarChart()
