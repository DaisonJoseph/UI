<!-- Styles -->
<style>
#priority {
	width		: 100%;
	height		: 500px;
	font-size	: 11px;
}						
</style>

<!-- Resources -->
<script src="../assets/testapp/amcharts.js"></script>
		<script src="../assets/testapp/funnel.js" type="text/javascript" ></script>
		<script src="../assets/testapp/serial.js"></script>
		<script src="../assets/testapp/light.js"></script>
		<link rel="stylesheet" href="../assets/testapp/export.css" type="text/css" media="all" />
<!-- Chart code -->
<script>
var chart = AmCharts.makeChart( "priority", {
  "type": "funnel",
  "theme": "light",
  "dataProvider": [ {
    "title": "Critical Defects Count",
    "value": 300
  }, {
    "title": "High Defects Count",
    "value": 123
  }, {
    "title": "Medium defects Count",
    "value": 98
  }, {
    "title": "Low defects Count",
    "value": 72
  }],
  "balloon": {
    "fixedPosition": true
  },
  "valueField": "value",
  "titleField": "title",
  "marginRight": 240,
  "marginLeft": 50,
  "startX": -500,
  "rotate": true,
  "labelPosition": "right",
  "balloonText": "[[title]]: [[value]]n[[description]]",
  "export": {
    "enabled": true
  }
} );
</script>

<!-- HTML -->
<div id="priority"></div>