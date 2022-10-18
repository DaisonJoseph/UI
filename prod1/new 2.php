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
    "title": "Website visits",
    "value": 300
  }, {
    "title": "Downloads",
    "value": 123
  }, {
    "title": "Requested price list",
    "value": 98
  }, {
    "title": "Contaced for more info",
    "value": 72
  }, {
    "title": "Purchased",
    "value": 35
  }, {
    "title": "Contacted for support",
    "value": 15
  }, {
    "title": "Purchased additional products",
    "value": 8
  } ],
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