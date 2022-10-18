var ChartsAmcharts = function () {
        var initChartSample1 = function () {

var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "columnWidth": 1,
        "theme": "light",
        "marginRight": 150,
        "dataProvider": [{
            "country": "2015",
            "visits": 5060,
            "color": "#E7505A"
        }, {
            "country": "2016",
            "visits": 4050,
            "color": "#32C5D2"
        }, {
            "country": "2017",
            "visits": 3000,
            "color": "#67809F"
        }],
        "valueAxes": [{
            "labelsEnabled": false,
            "axisAlpha": 0,
            "position": "left",
            "gridThickness": 0
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "fixedColumnWidth": 17,
            "cornerRadiusTop": 10,
            "valueField": "visits"
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "columnWidth": 0,
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "gridAlpha": 0,
            "position": "left"
        }
    }

)}; 

var initChartSample2 = function () {
var chart=AmCharts.makeChart("chartdiv1", {
"type": "serial", "columnWidth": 1, "theme": "light", "marginRight": 150, "dataProvider": [{
    "country": "2015",
    "visits": 1025,
    "color": "#E7505A"
}, {
    "country": "2016",
    "visits": 2082,
    "color": "#32C5D2"
}, {
    "country": "2017",
    "visits": 2809,
    "color": "#67809F"
}], "valueAxes": [{
    "labelsEnabled": false,
    "axisAlpha": 0,
    "position": "left",
    "gridThickness": 0
}], "startDuration": 1, "graphs": [{
    "balloonText": "<b>[[category]]: [[value]]</b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "fixedColumnWidth": 17,
    "cornerRadiusTop": 10,
    "valueField": "visits"
}], "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
}, "categoryField": "country", "columnWidth": 0, "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "gridAlpha": 0,
    "position": "left"
}
}

)};

 var initChartSample3 = function () {
var chart=AmCharts.makeChart("chartdiv2", {
"type": "serial", "columnWidth": 1, "theme": "light", "marginRight": 150, "dataProvider": [{
    "country": "2015",
    "visits": 4025,
    "color": "#E7505A"
}, {
    "country": "2016",
    "visits": 7882,
    "color": "#32C5D2"
}, {
    "country": "2017",
    "visits": 9809,
    "color": "#67809F"
}], "valueAxes": [{
    "labelsEnabled": false,
    "axisAlpha": 0,
    "position": "left",
    "gridThickness": 0
}], "startDuration": 1, "graphs": [{
    "balloonText": "<b>[[category]]: [[value]]</b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "fixedColumnWidth": 17,
    "cornerRadiusTop": 10,
    "valueField": "visits"
}], "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
}, "categoryField": "country", "columnWidth": 0, "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "gridAlpha": 0,
    "position": "left"
}
}

)};

 return {
     //main function to initiate the module
     init: function () {
         initChartSample1();
         initChartSample2();
         initChartSample3();
     }
 };
 }();
 jQuery(document).ready(function () {
     ChartsAmcharts.init();
 });