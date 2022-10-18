<html lang="en">
<!--<![endif]-->
<style>
	#donut {
  width: 100%;
  height: 500px;
}												
</style>
<head>
    <meta charset="utf-8" />
    <title>DevOps Analyzer</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="DevOps Analyser created by Legacy Modernization Team" name="description" />
    <meta content="" name="author" />
	<script src="../assets/amcharts.js"  type="text/javascript" ></script>
	<script src="../assets/piechart.js"></script>
	<script src="../assets/min.js"></script>
	<link rel="stylesheet" href="../assets/export.css" type="text/css" media="all" />
	<script src="../assets/light.js"></script>
</head>
<body>
<div id="donut"></div>
</body>
<script>
var chart = AmCharts.makeChart( "donut", {
  "type": "pie",
  "theme": "light",
  "titles": [ {
    "text": "Visitors countries",
    "size": 16
  } ],
  "dataProvider": [ {
    "application": "United States",
    "value": 7252
  }, {
    "application": "China",
    "value": 3882
  }, {
    "application": "Japan",
    "value": 1809
  }, {
    "application": "Germany",
    "value": 1322
  }, {
    "application": "United Kingdom",
    "value": 1122
  }, {
    "application": "France",
    "value": 414
  }, {
    "application": "India",
    "value": 384
  }, {
    "application": "Spain",
    "value": 211
  } ],
  "valueField": "value",
  "titleField": "application",
  "startEffect": "elastic",
  "startDuration": 2,
  "labelRadius": 15,
  "innerRadius": "50%",
  "depth3D": 10,
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 15,
  "export": {
    "enabled": true
  }
} );
</script>
<!-- HTML -->
<div id="donut"></div>
</html>
