<html>
   <head>
      <title>Google Charts Tutorial</title>
      <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
      </script>
      <script type = "text/javascript" src = "https://www.google.com/jsapi"></script>
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['sankey']});     
      </script>
   </head>
   
   <body>
      <div id = "container" style = "width: 550px; height: 400px; margin: 0 auto">
      </div>
      <script language = "JavaScript">
         function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();   
            data.addColumn('string', 'From');
            data.addColumn('string', 'To');
            data.addColumn('number', 'Weight');

            data.addRows([
<?php

$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->btobsankey;

$LOB  = array("VP","IF","Others");
$result_array = array();
$data_array = array();

foreach($LOB as $temp){
	$rows = $collection->find();
	foreach($rows as $row){
		if ($temp == $row['App_Code']) {
			$result_array[] = $row;
		}
	}
}


foreach($result_array as $row){
	//if ((strpos($row['AppName'],"#APP") === false) && ($row['LOB'] != $row['Interface_LOB']))
	{
		if ($row['App_Code'] == "IF"){
			$row['App_Code'] = "Owner's Information";
		} else if ($row['App_Code'] == "VP") {
			$row['App_Code'] = "Securities Maintenance";
		} 
		
		if ($row['Interface_App_Code'] == "IF"){
			$row['Interface_App_Code'] = "Owner's Information";
		} else if ($row['Interface_App_Code'] == "VP") {
			$row['Interface_App_Code'] = "Securities Maintenance";
		}
		
		echo '[ "' . $row['App_Code'] . '", "'. $row['Interface_App_Code'] . ' ", ' . '10' . ' ],';
		$data_array[] = $row['App_Code'];
	}
}

?>
            ]);	

            // Set chart options
            var options = {
					width: 550, 
					height: 500,
					sankey: {
						iterations: 0,
					}
				};
                  
            // Instantiate and draw the chart.
            var chart = new google.visualization.Sankey(document.getElementById('container'));
            chart.draw(data, options);
			
			google.visualization.events.addListener(chart, 'onmouseover', selectHandler);
         }
         google.charts.setOnLoadCallback(drawChart);
		 
		var dataarrayphp = <?php echo json_encode($data_array); ?>;
		
		var rowvalue;
		function selectHandler(properties) {
			
			document.ondblclick = docOnMousedown;
			rowvalue = JSON.stringify(properties.row);
		}
		
		function docOnMousedown()
		{
			var rownumber = rowvalue;
			var lob = dataarrayphp[rownumber];				
			window.location.href = "sankeycomponents.php?lob="+lob;
		}
		 
      </script>
   </body>
</html>