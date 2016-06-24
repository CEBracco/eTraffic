var chart;
var url;

function setUrl(address){
    url=address;
    querySemaphore();
}

$(function () {

    Highcharts.setOptions({
        global : {
            useUTC : false
        }
    });

    // Create the chart
    $('#container').highcharts('StockChart', {
        chart : {
            zoomType: 'x',
            events : {
                load : function () {
                    // set up the updating of the chart each second
                    setInterval(function () {
                        querySemaphore();
                    }, 5000);
                }
            }
        },

        scrollbar : {
                enabled : false
        },

        rangeSelector: {
            selected: 4,
            inputEnabled: false,
            buttonTheme: {
                visibility: 'hidden'
            },
            labelStyle: {
                visibility: 'hidden'
            }
        },

        title : {
            text : 'Autos Por Minuto'
        },

        exporting: {
            enabled: false
        },

        series : [{
            name : 'Random data',
            data : [],
            type : 'area',
            fillColor : {
                linearGradient : {
                    x1: 1,
                    y1: 1,
                    x2: 1,
                    y2: 0
                },
                stops : [
                    [0, Highcharts.getOptions().colors[0]],
                    [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
        }]
    });

    chart=$('#container').highcharts();

});

function querySemaphore(){
    $.getJSON( url, function( json ) {
        setData(json.autosPorMinuto);
    });
}

var offsetXAxis=0;

function setData(data){
    var actualDate = (new Date()).getTime();
    chart.series[0].addPoint([actualDate, data], true, false);

    /*chart.xAxis[0].setExtremes(chart.series[0].data[offsetXAxis].x, actualDate);*/

    // if(chart.series[0].data.length > 10){
    //     offsetXAxis++;
    // }

    chart.xAxis[0].setExtremes(chart.series[0].data[0].x, actualDate);
}