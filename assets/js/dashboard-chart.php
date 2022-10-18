<?php
$m = new MongoClient();
$db = $m->euroclear;
$MI_col = $db -> MasterInventory;
$missing_components_col =$db ->MissingComponents;
$xref_col = $db->Crossreference;
$stat_col = $db->staticDynamic;
$load_col = $db->loadSource;
$file_notused_col = $db->files_notUsed;
$ftp_col = $db->ftp;
$crudcol = $db->CRUD;
$crudops = $db->CRUD_Ops;
?>
<script>
function modalClick(chartType, seriesType, chartId) {
  $("#display-chart").html("");
  $('#myModal').modal('show')
  setTimeout(function () {
    loadChart(chartType, seriesType, chartId);
  }, 200);
};

function hideModal() {
  $('#myModal').modal('hide');
}



function loadChart(chartType, seriesType, chartId) {
  var chart;
  if (chartType == 'Container') {
    chart = am4core.create("display-chart", am4core[chartType]);
  }
  else if (chartType == 'Sunburst') {
    // console.log("inside sunburst");
    chart = am4core.create("display-chart", am4plugins_sunburst[chartType]);
  }
  else {
    chart = am4core.create("display-chart", am4charts[chartType]);
  }

  // Themes begin
  am4core.useTheme(am4themes_frozen);
  am4core.useTheme(am4themes_animated);
  // Themes end

  // var series = chart.series.push(new am4charts[seriesType]());


  switch (chartType) {

    case 'PieChart':
      createPieChart(chart, seriesType, chartId);
      break;
    case 'PieChart3D':
      createPieChart3D(chart, seriesType);
      break;

    case 'XYChart3D':
      createXY3DChart(chart, seriesType, chartId);
      break;
    case 'Container':
      createContainer(chart, seriesType, chartId);
      break;
    case 'XYChart':
      createXYChart(chart, seriesType, chartId);
      break;
    case 'Sunburst':
      createSunburst(chart, seriesType);
      break;
    case 'RadarChart':
      createRadarChart(chart, seriesType);
      break;
    case 'SlicedChart':
      createSlicedChart(chart, seriesType, chartId);
      break;
  }
}

function createPieChart(chart, seriesType, chartId) {
  switch (chartId) {
    case 'chart1':
      createPieChart1(chart, seriesType);
      break;
    case 'chart2':
      createPieChart2(chart, seriesType);
      break;

    case 'chart3':
      createPieChart3(chart, seriesType);
      break;
  }
}

function createContainer(chart, seriesType, chartId) {
  switch (chartId) {
    case 'chart1':
      createContainer1(chart, seriesType);
      break;
    case 'chart2':
      createContainer2(chart, seriesType);
      break;
  }
}

function createXY3DChart(chart, seriesType, chartId) {
  switch (chartId) {
    case 'chart1':
      createXY3DChart1(chart, seriesType);
      break;
    case 'chart2':
      createXY3DChart2(chart, seriesType);
      break;
    case 'chart3':
      createXY3DChart3(chart, seriesType);
      break;
  }
}

function createContainer(chart, seriesType, chartId) {
  switch (chartId) {
    case 'chart1':
      createContainer1(chart, seriesType);
      break;
    case 'chart2':
      createContainer2(chart, seriesType);
      break;
  }
}

function createSlicedChart(chart, seriesType, chartId) {
  switch (chartId) {
    case 'chart1':
      createSlicedChart1(chart, seriesType);
      break;
  }
}

function createXYChart(chart, seriesType, chartId) {
  switch (chartId) {
    case 'chart3':
      createXYChart1(chart, seriesType);
      break;
    case 'chart4':
      createXYChart2(chart, seriesType);
      break;
    case 'chart5':
      createXYChart3(chart, seriesType);
  }
}

function createPieChart1(chart, seriesType) {


  // Set data
      <?php
  
   $total_loc = $MI_col->aggregate(array('$group'=>array('_id'=>'null',"TotalLLoc"=>array('$sum'=>'$LLOC'))));
   $distinct_components = $MI_col->distinct("Component_Type");
   $lloc_array = array();
   $cloc_array = array();
   $uloc_array = array();
   foreach($total_loc as $t)
   {
	foreach($t as $t1)
		{
		//print_r($t1);
		$total_Lines = $t1['TotalLLoc'];
		}
   }
   
   foreach($distinct_components as  $distinct_component)
   {
		$comp_total_loc = $MI_col->aggregate(array('$match'=>array("Component_Type"=>$distinct_component)),array('$group'=>array('_id'=>'null','TotalLLoc'=>array('$sum'=>'$LLOC'))));
		foreach($comp_total_loc as $c)
		{
			foreach($c as $c1)
			{
				$lloc_array[$distinct_component] = $c1['TotalLLoc'];
			}
		}
   }
   foreach($distinct_components as  $distinct_component)
   {
		$comp_total_cloc = $MI_col->aggregate(array('$match'=>array("Component_Type"=>$distinct_component)),array('$group'=>array('_id'=>'null','TotalLLoc'=>array('$sum'=>'$CLOC'))));
		
		foreach($comp_total_cloc as $c)
		{
			
			foreach($c as $c1)
			{
				$cloc_array[$distinct_component] = $c1['TotalLLoc'];
			}
		}
   }
   foreach($distinct_components as  $distinct_component)
   {
		$comp_total_uloc = $MI_col->aggregate(array('$match'=>array("Component_Type"=>$distinct_component)),array('$group'=>array('_id'=>'null','TotalLLoc'=>array('$sum'=>'$ULOC'))));
		
		foreach($comp_total_uloc as $c)
		{
			
			foreach($c as $c1)
			{
				$uloc_array[$distinct_component] = $c1['TotalLLoc'];
			}
		}
   }

 
  ?>
  var selected;
  

  var types = [ 
  <?php
  $i = 0;
	foreach($distinct_components as $distinct_component)
	{
	
		if($distinct_component != "UNFOUND")
		{
		
			$type = $distinct_component;
			$percentage = number_format((($lloc_array[$distinct_component]/$total_Lines) * 100),2);
			$cloc_per = number_format((($cloc_array[$distinct_component]/$lloc_array[$distinct_component])*100),2);
			$uloc_per = number_format((($uloc_array[$distinct_component]/$lloc_array[$distinct_component])*100),2);
			$lloc_per = number_format((100 - ($cloc_per+$uloc_per)),2);
			
?>
{
    type: "<?php echo $type;?>",
    percent: <?php echo $percentage;?>,
    color: chart.colors.getIndex(<?php echo $i;?>),
    subs: [{
      type: "CLOC",
      percent: <?php echo $cloc_per;?>
    }, {
      type: "ULOC",
      percent: <?php echo $uloc_per;?>
    }, {
      type: "ULOC",
      percent: <?php echo $lloc_per;?>
    }]
  },

<?php
			//echo "** $type|$percentage|$cloc_per|$uloc_per";
		}
		$i++;
	}
	
  ?>
  

 /* {
    type: "COPYBOOK",
    percent: 30,
    color: chart.colors.getIndex(1),
    subs: [{
      type: "LLOC",
      percent: 15
    }, {
      type: "CLOC",
      percent: 10
    }, {
      type: "ULOC",
      percent: 5
    }]
  }*/];

  // Add data
  chart.data = generateChartData();

  // Add and configure Series
  var pieSeries = chart.series.push(new am4charts[seriesType]());
  pieSeries.dataFields.value = "percent";
  pieSeries.dataFields.category = "type";
  pieSeries.slices.template.propertyFields.fill = "color";
  pieSeries.slices.template.propertyFields.isActive = "pulled";
  pieSeries.slices.template.strokeWidth = 0;

  function generateChartData() {
    var chartData = [];
    for (var i = 0; i < types.length; i++) {
      if (i == selected) {
        for (var x = 0; x < types[i].subs.length; x++) {
          chartData.push({
            type: types[i].subs[x].type,
            percent: types[i].subs[x].percent,
            color: types[i].color,
            pulled: true
          });
        }
      } else {
        chartData.push({
          type: types[i].type,
          percent: types[i].percent,
          color: types[i].color,
          id: i
        });
      }
    }
    return chartData;
  }

  pieSeries.slices.template.events.on("hit", function (event) {
    if (event.target.dataItem.dataContext.id != undefined) {
      selected = event.target.dataItem.dataContext.id;
    } else {
      selected = undefined;
    }
    chart.data = generateChartData();
  });

}

function createPieChart2(chart, seriesType) {
  chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

  chart.data = [
    {
      type: "COBOL",
      value: 7134
    },
    {
      type: "Copybook",
      value: 12617
    }
  ];
  chart.radius = am4core.percent(70);
  chart.innerRadius = am4core.percent(40);
  chart.startAngle = 180;
  chart.endAngle = 360;

  var series = chart.series.push(new am4charts[seriesType]());
  series.dataFields.value = "value";
  series.dataFields.category = "type";

  series.slices.template.cornerRadius = 10;
  series.slices.template.innerCornerRadius = 7;
  series.slices.template.draggable = true;
  series.slices.template.inert = true;
  series.alignLabels = false;

  series.hiddenState.properties.startAngle = 90;
  series.hiddenState.properties.endAngle = 90;

  chart.legend = new am4charts.Legend();

}

function createPieChart3(chart, seriesType) {

  chart.hiddenState.properties.opacity = 0;
<?php

$missing_components_array = array();

foreach($distinct_components as $distinct_component)
{

$type = $distinct_component;
//echo "~$distinct_component";
$value = $missing_components_col->find(array("Type"=>$distinct_component))->count();
$missing_components_array[$type] = $value;
}

//print_r($missing_components_array);
?>
  chart.data = [
  <?php
  foreach($missing_components_array as $key => $value)
  {
  if($key != "UNFOUND")
  
  {
  ?>
    {
      type: "<?php echo $key;?>",
      value: <?php echo $value;?>
    },
	
	<?php
	}
	}
	?>
  ];

  var series = chart.series.push(new am4charts[seriesType]());
  series.dataFields.value = "value";
  series.dataFields.radiusValue = "value";
  series.dataFields.category = "type";
  series.slices.template.cornerRadius = 6;
  series.colors.step = 2;

  series.hiddenState.properties.endAngle = -90;
	 series.slices.template.events.on("hit", function(ev) {
			window.location = "http://10.246.88.97/cap360-material/examples/missingReport.php";
}); 
  chart.legend = new am4charts.Legend();
}

function createPieChart3D(chart, seriesType) {
  chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

  chart.legend = new am4charts.Legend();
<?php
 $total_cloc = $MI_col->aggregate(array('$group'=>array('_id'=>'null',"TotalLLoc"=>array('$sum'=>'$CLOC'))));
$total_uloc = $MI_col->aggregate(array('$group'=>array('_id'=>'null',"TotalLLoc"=>array('$sum'=>'$ULOC'))));
foreach($total_cloc as $total)
{
  foreach($total as $tc)
  {
	$total_commented_loc = $tc['TotalLLoc'];
  }
}
foreach($total_uloc as $total)
{
  foreach($total as $tc)
  {
	$total_uncommented_loc = $tc['TotalLLoc'];
  }
}
 //echo "!!!$total_uncommented_loc";
 ?>
  chart.data = [ 
    {
      country: "CLOC",
      litres: <?php echo $total_commented_loc ?>
    },
    {
      country: "ULOC",
      litres: <?php echo $total_uncommented_loc ?>
    }
  ];
  var series = chart.series.push(new am4charts[seriesType]());
  series.dataFields.value = "litres";
  series.dataFields.category = "country";
  series.slices.template.events.on("hit", function(ev) {
			window.location = "http://10.246.88.97/cap360-material/examples/masterReports.php";
});
}

function createXY3DChart1(chart, seriesType) {
  chart.paddingBottom = 30;
  chart.angle = 35;

  <?php
	$distincts = $MI_col->distinct("Component_Type");
	$Component_array = array();
	foreach($distincts as $distinct)
	{
		$type = $distinct;
		$value = $MI_col->find(array("Component_Type"=>$distinct))->count();
		$Component_array[$type] = $value;
	}
	//print_r($static_dynamic_array);
	?>
  // Add data
  chart.data = [
  
  <?php
	foreach($Component_array as $key => $value)
	{
		
	?>
	{
      type: "<?php echo $key;?>",
      value: <?php echo $value;?>
    },
  <?php
	}
  ?>
  

  ];


  // Create axes
  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "type";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 20;
  categoryAxis.renderer.inside = true;
  categoryAxis.renderer.grid.template.disabled = true;

  let labelTemplate = categoryAxis.renderer.labels.template;
  labelTemplate.rotation = -90;
  labelTemplate.horizontalCenter = "left";
  labelTemplate.verticalCenter = "middle";
  labelTemplate.dy = 10; // moves it a bit down;
  labelTemplate.inside = false; // this is done to avoid settings which are not suitable when label is rotated

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.grid.template.disabled = true;

  // Create series
  var series = chart.series.push(new am4charts[seriesType]());
  series.dataFields.valueY = "value";
  series.dataFields.categoryX = "type";
	
	
	series.columns.template.events.on("hit", function(ev) {
 window.location = "http://10.246.88.97/cap360-material/examples/orphanReport.php";
});
	
  var columnTemplate = series.columns.template;
  columnTemplate.adapter.add("fill", function (fill, target) {
    return chart.colors.getIndex(target.dataItem.index);
  })

  columnTemplate.adapter.add("stroke", function (stroke, target) {
    return chart.colors.getIndex(target.dataItem.index);
  })
}

function createContainer1(container, seriesType) {

  am4core.useTheme(am4themes_frozen);
  am4core.useTheme(am4themes_animated);
<?php
$total_crud_count = $crudcol->count();
$create = $crudcol->find(array("Operation"=>"CREATE"))->count();
$read = $crudcol->find(array("Operation"=>"READ"))->count();
$update = $crudcol->find(array("Operation"=>"UPDATE"))->count();
$delete = $crudcol->find(array("Operation"=>"DELETE"))->count();
$insert = $crudcol->find(array("Operation"=>"INSERT"))->count();

?>
  var data = [{
    "type": "Dummy",
    "disabled": true,
    "value": 0,
    "color": am4core.color("#dadada"),
    "opacity": 0.3,
    "strokeDasharray": "4,4"
  }, {
    "type": "Insert",
    "value": <?php echo $insert; ?>
  }, {
    "type": "Read",
    "value": <?php echo $read; ?>
  }, {
    "type": "Update",
    "value": <?php echo $update; ?>
  }, {
    "type": "Delete",
    "value": <?php echo $delete; ?>
  }];


  // cointainer to hold both charts
  // var container = am4core.create("chartdiv", am4core.Container);
  container.width = am4core.percent(100);
  container.height = am4core.percent(100);
  container.layout = "horizontal";

  container.events.on("maxsizechanged", function () {
    chart1.zIndex = 0;
    separatorLine.zIndex = 1;
    dragText.zIndex = 2;
    chart2.zIndex = 3;
  })

  var chart1 = container.createChild(am4charts.PieChart);
  chart1.fontSize = 11;
  chart1.hiddenState.properties.opacity = 0; // this makes initial fade in effect
  chart1.data = data;
  chart1.radius = am4core.percent(70);
  chart1.innerRadius = am4core.percent(40);
  chart1.zIndex = 1;

  var series1 = chart1.series.push(new am4charts[seriesType]());
  series1.dataFields.value = "value";
  series1.dataFields.category = "type";
  series1.colors.step = 2;
  series1.alignLabels = false;
  series1.labels.template.bent = false;
  series1.labels.template.radius = 3;
  series1.labels.template.padding(0, 0, 0, 0);

  var sliceTemplate1 = series1.slices.template;
  sliceTemplate1.cornerRadius = 5;
  sliceTemplate1.draggable = true;
  sliceTemplate1.inert = true;
  sliceTemplate1.propertyFields.fill = "color";
  sliceTemplate1.propertyFields.fillOpacity = "opacity";
  sliceTemplate1.propertyFields.stroke = "color";
  sliceTemplate1.propertyFields.strokeDasharray = "strokeDasharray";
  sliceTemplate1.strokeWidth = 1;
  sliceTemplate1.strokeOpacity = 1;

  var zIndex = 5;

  sliceTemplate1.events.on("down", function (event) {
    event.target.toFront();
    // also put chart to front
    var series = event.target.dataItem.component;
    series.chart.zIndex = zIndex++;
  })

  series1.ticks.template.disabled = true;

  sliceTemplate1.states.getKey("active").properties.shiftRadius = 0;

  sliceTemplate1.events.on("dragstop", function (event) {
    handleDragStop(event);
  })

  // separator line and text
  var separatorLine = container.createChild(am4core.Line);
  separatorLine.x1 = 0;
  separatorLine.y2 = 300;
  separatorLine.strokeWidth = 3;
  separatorLine.stroke = am4core.color("#dadada");
  separatorLine.valign = "middle";
  separatorLine.strokeDasharray = "5,5";


  var dragText = container.createChild(am4core.Label);
  dragText.text = "Drag slices over the line";
  dragText.rotation = 90;
  dragText.valign = "middle";
  dragText.align = "center";
  dragText.paddingBottom = 5;

  // second chart
  var chart2 = container.createChild(am4charts.PieChart);
  chart2.hiddenState.properties.opacity = 0; // this makes initial fade in effect
  chart2.fontSize = 11;
  chart2.radius = am4core.percent(70);
  chart2.data = data;
  chart2.innerRadius = am4core.percent(40);
  chart2.zIndex = 1;

  var series2 = chart2.series.push(new am4charts[seriesType]());
  series2.dataFields.value = "value";
  series2.dataFields.category = "type";
  series2.colors.step = 2;

  series2.alignLabels = false;
  series2.labels.template.bent = true;
  series2.labels.template.radius = 3;
  series2.labels.template.padding(0, 0, 0, 0);
  series2.labels.template.propertyFields.disabled = "disabled";

  var sliceTemplate2 = series2.slices.template;
  sliceTemplate2.copyFrom(sliceTemplate1);

  series2.ticks.template.disabled = true;

  function handleDragStop(event) {
    var targetSlice = event.target;
    var dataItem1;
    var dataItem2;
    var slice1;
    var slice2;

    if (series1.slices.indexOf(targetSlice) != -1) {
      slice1 = targetSlice;
      slice2 = series2.dataItems.getIndex(targetSlice.dataItem.index).slice;
    }
    else if (series2.slices.indexOf(targetSlice) != -1) {
      slice1 = series1.dataItems.getIndex(targetSlice.dataItem.index).slice;
      slice2 = targetSlice;
    }


    dataItem1 = slice1.dataItem;
    dataItem2 = slice2.dataItem;

    var series1Center = am4core.utils.spritePointToSvg({ x: 0, y: 0 }, series1.slicesContainer);
    var series2Center = am4core.utils.spritePointToSvg({ x: 0, y: 0 }, series2.slicesContainer);

    var series1CenterConverted = am4core.utils.svgPointToSprite(series1Center, series2.slicesContainer);
    var series2CenterConverted = am4core.utils.svgPointToSprite(series2Center, series1.slicesContainer);

    // tooltipY and tooltipY are in the middle of the slice, so we use them to avoid extra calculations
    var targetSlicePoint = am4core.utils.spritePointToSvg({ x: targetSlice.tooltipX, y: targetSlice.tooltipY }, targetSlice);

    if (targetSlice == slice1) {
      if (targetSlicePoint.x > container.pixelWidth / 2) {
        var value = dataItem1.value;

        dataItem1.hide();

        var animation = slice1.animate([{ property: "x", to: series2CenterConverted.x }, { property: "y", to: series2CenterConverted.y }], 400);
        animation.events.on("animationprogress", function (event) {
          slice1.hideTooltip();
        })

        slice2.x = 0;
        slice2.y = 0;

        dataItem2.show();
      }
      else {
        slice1.animate([{ property: "x", to: 0 }, { property: "y", to: 0 }], 400);
      }
    }
    if (targetSlice == slice2) {
      if (targetSlicePoint.x < container.pixelWidth / 2) {

        var value = dataItem2.value;

        dataItem2.hide();

        var animation = slice2.animate([{ property: "x", to: series1CenterConverted.x }, { property: "y", to: series1CenterConverted.y }], 400);
        animation.events.on("animationprogress", function (event) {
          slice2.hideTooltip();
        })

        slice1.x = 0;
        slice1.y = 0;
        dataItem1.show();
      }
      else {
        slice2.animate([{ property: "x", to: 0 }, { property: "y", to: 0 }], 400);
      }
    }

    toggleDummySlice(series1);
    toggleDummySlice(series2);

    series1.hideTooltip();
    series2.hideTooltip();
  }

  function toggleDummySlice(series) {
    var show = true;
    for (var i = 1; i < series.dataItems.length; i++) {
      var dataItem = series.dataItems.getIndex(i);
      if (dataItem.slice.visible && !dataItem.slice.isHiding) {
        show = false;
      }
    }

    var dummySlice = series.dataItems.getIndex(0);
    if (show) {
      dummySlice.show();
    }
    else {
      dummySlice.hide();
    }
  }

  series2.events.on("datavalidated", function () {

    var dummyDataItem = series2.dataItems.getIndex(0);
    dummyDataItem.show(0);
    dummyDataItem.slice.draggable = false;
    dummyDataItem.slice.tooltipText = undefined;

    for (var i = 1; i < series2.dataItems.length; i++) {
      series2.dataItems.getIndex(i).hide(0);
    }
  })

  series1.events.on("datavalidated", function () {
    var dummyDataItem = series1.dataItems.getIndex(0);
    dummyDataItem.hide(0);
    dummyDataItem.slice.draggable = false;
    dummyDataItem.slice.tooltipText = undefined;
  })
}

function createContainer2(container, seriesType) {

  container.width = am4core.percent(100);
  container.height = am4core.percent(100);
  container.layout = "horizontal";


  var chart = container.createChild(am4charts.PieChart);
  <?php
	 $distinct_components = $MI_col->distinct("Component_Type");
	?>
  chart.data = [
	<?php

		foreach($distinct_components as $distinct_component)
		{
			if($dstinct_component != "UNFOUND" &&(($MI_col->find(array("Component_Type"=>$distinct_component,"Orphan"=>"Yes"))->count())>0))
			{
			//echo "@@@$distinct_component";
			$lloc_agg = $MI_col->aggregate(array('$match'=>array("Component_Type"=>$distinct_component,"Orphan"=>"Yes")),array('$group'=>array('_id'=>'$Component_Type',"LLOC"=>array('$sum'=>'$LLOC'))));
			$uloc_agg = $MI_col->aggregate(array('$match'=>array("Component_Type"=>$distinct_component,"Orphan"=>"Yes")),array('$group'=>array('_id'=>'$Component_Type',"ULOC"=>array('$sum'=>'$ULOC'))));
			$cloc_agg = $MI_col->aggregate(array('$match'=>array("Component_Type"=>$distinct_component,"Orphan"=>"Yes")),array('$group'=>array('_id'=>'$Component_Type',"CLOC"=>array('$sum'=>'$CLOC'))));
				 foreach($lloc_agg as $lloc_obj)
				 {
						foreach($lloc_obj as $lloc_obj1)
							$orp_lloc = $lloc_obj1['LLOC'];
						
				}
				 foreach($uloc_agg as $uloc_obj)
				 {
						foreach($uloc_obj as $uloc_obj1)
							$orp_uloc = $uloc_obj1['ULOC'];
						
				}
				 foreach($cloc_agg as $cloc_obj)
				 {
						foreach($cloc_obj as $uloc_obj1)
							$orp_cloc = $uloc_obj1['CLOC'];
						
				}
				
			
					
	?>
					{
					"type": "<?php echo $distinct_component; ?>",
					"litres":<?php echo $orp_lloc;?>,
					"subData": [ { name: "ULOC", value: <?php echo $orp_uloc ?> }, { name: "CLOC", value: <?php echo $orp_cloc ?> }]
				  },
  <?php
						
				
			}
		}
  ?>
  
  ];

  // Add and configure Series
  var pieSeries = chart.series.push(new am4charts[seriesType]());
  pieSeries.dataFields.value = "litres";
  pieSeries.dataFields.category = "type";
  pieSeries.slices.template.states.getKey("active").properties.shiftRadius = 0;
  //pieSeries.labels.template.text = "{category}\n{value.percent.formatNumber('#.#')}%";

  pieSeries.slices.template.events.on("hit", function (event) {
    selectSlice(event.target.dataItem);
  })

  var chart2 = container.createChild(am4charts.PieChart);
  chart2.width = am4core.percent(30);
  chart2.radius = am4core.percent(80);

  // Add and configure Series
  var pieSeries2 = chart2.series.push(new am4charts[seriesType]());
  pieSeries2.dataFields.value = "value";
  pieSeries2.dataFields.category = "name";
  pieSeries2.slices.template.states.getKey("active").properties.shiftRadius = 0;
  //pieSeries2.labels.template.radius = am4core.percent(50);
  //pieSeries2.labels.template.inside = true;
  //pieSeries2.labels.template.fill = am4core.color("#ffffff");
  pieSeries2.labels.template.disabled = true;
  pieSeries2.ticks.template.disabled = true;
  pieSeries2.alignLabels = false;
  pieSeries2.events.on("positionchanged", updateLines);

  var interfaceColors = new am4core.InterfaceColorSet();

  var line1 = container.createChild(am4core.Line);
  line1.strokeDasharray = "2,2";
  line1.strokeOpacity = 0.5;
  line1.stroke = interfaceColors.getFor("alternativeBackground");
  line1.isMeasured = false;

  var line2 = container.createChild(am4core.Line);
  line2.strokeDasharray = "2,2";
  line2.strokeOpacity = 0.5;
  line2.stroke = interfaceColors.getFor("alternativeBackground");
  line2.isMeasured = false;

  var selectedSlice;

  function selectSlice(dataItem) {

    selectedSlice = dataItem.slice;

    var fill = selectedSlice.fill;

    var count = dataItem.dataContext.subData.length;
    pieSeries2.colors.list = [];
    for (var i = 0; i < count; i++) {
      pieSeries2.colors.list.push(fill.brighten(i * 2 / count));
    }

    chart2.data = dataItem.dataContext.subData;
    pieSeries2.appear();

    var middleAngle = selectedSlice.middleAngle;
    var firstAngle = pieSeries.slices.getIndex(0).startAngle;
    var animation = pieSeries.animate([{ property: "startAngle", to: firstAngle - middleAngle }, { property: "endAngle", to: firstAngle - middleAngle + 360 }], 600, am4core.ease.sinOut);
    animation.events.on("animationprogress", updateLines);

    selectedSlice.events.on("transformed", updateLines);

    //  var animation = chart2.animate({property:"dx", from:-container.pixelWidth / 2, to:0}, 2000, am4core.ease.elasticOut)
    //  animation.events.on("animationprogress", updateLines)
  }


  function updateLines() {
    if (selectedSlice) {
      var p11 = { x: selectedSlice.radius * am4core.math.cos(selectedSlice.startAngle), y: selectedSlice.radius * am4core.math.sin(selectedSlice.startAngle) };
      var p12 = { x: selectedSlice.radius * am4core.math.cos(selectedSlice.startAngle + selectedSlice.arc), y: selectedSlice.radius * am4core.math.sin(selectedSlice.startAngle + selectedSlice.arc) };

      p11 = am4core.utils.spritePointToSvg(p11, selectedSlice);
      p12 = am4core.utils.spritePointToSvg(p12, selectedSlice);

      var p21 = { x: 0, y: -pieSeries2.pixelRadius };
      var p22 = { x: 0, y: pieSeries2.pixelRadius };

      p21 = am4core.utils.spritePointToSvg(p21, pieSeries2);
      p22 = am4core.utils.spritePointToSvg(p22, pieSeries2);

      line1.x1 = p11.x;
      line1.x2 = p21.x;
      line1.y1 = p11.y;
      line1.y2 = p21.y;

      line2.x1 = p12.x;
      line2.x2 = p22.x;
      line2.y1 = p12.y;
      line2.y2 = p22.y;
    }
  }

  chart.events.on("datavalidated", function () {
    setTimeout(function () {
      selectSlice(pieSeries.dataItems.getIndex(0));
    }, 1000);
  });

}

function createXYChart1(chart, seriesType) {

  chart.scrollbarX = new am4core.Scrollbar();
  
	<?php
	$distincts = $stat_col->distinct("Type");
	$static_dynamic_array = array();
	foreach($distincts as $distinct)
	{
		$type = $distinct;
		$value = $stat_col->find(array("Type"=>$distinct))->count();
		$static_dynamic_array[$type] = $value;
	}
	//print_r($static_dynamic_array);
	?>
  chart.data = [
	<?php
	foreach($static_dynamic_array as $key => $value)
	{
		
	?>
    {
      type: "<?php echo $key;?>",
      value: <?php echo $value;?>
    },
  <?php
	}
  ?>
  ];
  // Create axes
  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "type";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 30;
  categoryAxis.renderer.labels.template.horizontalCenter = "right";
  categoryAxis.renderer.labels.template.verticalCenter = "middle";
  categoryAxis.renderer.labels.template.rotation = 270;
  categoryAxis.tooltip.disabled = true;
  categoryAxis.renderer.minHeight = 110;

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.minWidth = 50;

  // Create series
  var series = chart.series.push(new am4charts[seriesType]());
  series.sequencedInterpolation = true;
  series.dataFields.valueY = "value";
  series.dataFields.categoryX = "type";
  series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
  series.columns.template.strokeWidth = 0;

  series.tooltip.pointerOrientation = "vertical";

  series.columns.template.column.cornerRadiusTopLeft = 10;
  series.columns.template.column.cornerRadiusTopRight = 10;
  series.columns.template.column.fillOpacity = 0.8;

  // on hover, make corner radiuses bigger
  var hoverState = series.columns.template.column.states.create("hover");
  hoverState.properties.cornerRadiusTopLeft = 0;
  hoverState.properties.cornerRadiusTopRight = 0;
  hoverState.properties.fillOpacity = 1;

  series.columns.template.adapter.add("fill", function (fill, target) {
    return chart.colors.getIndex(target.dataItem.index);
  });
  
  series.columns.template.events.on("hit", function(ev) {
			window.location = "http://10.246.88.97/cap360-material/examples/staticAndDynamicReport.php";
});

  // Cursor
  chart.cursor = new am4charts.XYCursor();
}


function createSunburst(chart, seriesType) {
  chart.padding(0, 0, 0, 0);
  chart.radius = am4core.percent(98);
  <?php
	$distincts_called = $xref_col->distinct("called_component_type");
	$distincts_calling = $xref_col->distinct("calling_component_type");
	$called_components_array = array();
	$calling_components_array = array();
	foreach($distincts_called as $distinct)
	{
		$type = $distinct;
		$value = $xref_col->find(array("called_component_type"=>$distinct))->count();
		$called_component_array[$type] = $value;
	}
	foreach($distincts_calling as $distinct)
	{
		$type = $distinct;
		$value = $xref_col->find(array("calling_component_type"=>$distinct))->count();
		$calling_component_array[$type] = $value;
	}
	//print_r($called_component_array);
	?>

  chart.data = [{
    name: "Called Cross Reference",
    children: [
		<?php
		foreach($called_component_array as $key => $value)
		{
		?>
      { name: "<?php echo $key; ?>", value: <?php echo $value; ?> },
     
	  <?php
		}
	  ?>
    ]
  },
  {
    name: "Calling Cross-reference",
    children: [
	<?php
		foreach($calling_component_array as $key => $value)
		{
		?>
      { name: "<?php echo $key; ?>", value: <?php echo $value; ?> },
	  
      
	  <?php
		}
	  ?>
    ]
  }];
  chart.colors.step = 2;
  chart.fontSize = 11;
  chart.innerRadius = am4core.percent(10);

  // define data fields
  chart.dataFields.value = "value";
  chart.dataFields.name = "name";
  chart.dataFields.children = "children";

  var level0SeriesTemplate = new am4plugins_sunburst.SunburstSeries();
  level0SeriesTemplate.hiddenInLegend = false;
  chart.seriesTemplates.setKey("0", level0SeriesTemplate)

  // this makes labels to be hidden if they don't fit
  level0SeriesTemplate.labels.template.truncate = true;
  level0SeriesTemplate.labels.template.hideOversized = true;

  level0SeriesTemplate.labels.template.adapter.add("rotation", function (rotation, target) {
    target.maxWidth = target.dataItem.slice.radius - target.dataItem.slice.innerRadius - 10;
    target.maxHeight = Math.abs(target.dataItem.slice.arc * (target.dataItem.slice.innerRadius + target.dataItem.slice.radius) / 2 * am4core.math.RADIANS);

    return rotation;
  })


  var level1SeriesTemplate = level0SeriesTemplate.clone();
  chart.seriesTemplates.setKey("1", level1SeriesTemplate)
  level1SeriesTemplate.fillOpacity = 0.75;
  level1SeriesTemplate.hiddenInLegend = true;

  var level2SeriesTemplate = level0SeriesTemplate.clone();
  chart.seriesTemplates.setKey("2", level2SeriesTemplate)
  level2SeriesTemplate.fillOpacity = 0.5;
  level2SeriesTemplate.hiddenInLegend = true;
  
  level1SeriesTemplate.slices.template.events.on("hit", function(ev) {
			window.location = "http://10.246.88.97/cap360-material/examples/masterReports.php";
});

 level2SeriesTemplate.slices.template.events.on("hit", function(ev) {
			window.location = "http://10.246.88.97/cap360-material/examples/masterReports.php";
});

  chart.legend = new am4charts.Legend();
}

function createXYChart2(chart, seriesType) {
	<?php
	$distincts_sourceNA = $load_col->distinct("Load Available, Source NA");
	$distincts_loadNA = $load_col->distinct("Source Available,Load NA");
	$sourceNA_array = array();
	$loadNA_array = array();
	foreach($distincts_sourceNA as $distinct)
	{
		$type = $distinct;
		$value = $load_col->find(array("Load Available, Source NA"=>$distinct))->count();
		$sourceNA_array[$type] = $value;
	}
	foreach($distincts_loadNA as $distinct)
	{
		$type = $distinct;
		$value = $load_col->find(array("Source Available,Load NA"=>$distinct))->count();
		$loadNA_array[$type] = $value;
	}
	//print_r($static_dynamic_array);
	?>

  chart.data = [
	  <?php
	  foreach($sourceNA_array as $key=>$value){
	  ?>
	  {
    "type": "<?php echo $key; ?>",
    "value": <?php echo $value;?>
  },
  <?php
	  }
  ?>
  <?php
	  foreach($loadNA_array as $key=>$value){
	  ?>
  {
    "type": "<?php echo $key;?>",
    "value": <?php echo $value;?>
  }
  <?php
	  }
  ?>
  ];

  chart.padding(40, 40, 40, 40);

  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.dataFields.category = "type";
  categoryAxis.renderer.minGridDistance = 60;

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

  var series = chart.series.push(new am4charts[seriesType]());
  series.dataFields.categoryX = "type";
  series.dataFields.valueY = "value";
  series.tooltipText = "{valueY.value}"

  series.bullets.template.events.on("hit", function(ev) {
			window.location = "http://10.246.88.97/cap360-material/examples/masterReports.php";
}); 
  
  var errorBullet = series.bullets.create(am4charts.ErrorBullet);
  errorBullet.isDynamic = true;
  errorBullet.strokeWidth = 2;

  var circle = errorBullet.createChild(am4core.Circle);
  circle.radius = 3;
  circle.fill = am4core.color("#ffffff");

  // adapter adjusts height of a bullet
  errorBullet.adapter.add("pixelHeight", function (pixelHeight, target) {
    var dataItem = target.dataItem;

    if (dataItem) {
      var value = dataItem.valueY;
      var errorTopValue = value + dataItem.dataContext.error / 2;
      var errorTopY = valueAxis.valueToPoint(errorTopValue).y;

      var errorBottomValue = value - dataItem.dataContext.error / 2;
      var errorBottomY = valueAxis.valueToPoint(errorBottomValue).y;

      return Math.abs(errorTopY - errorBottomY);
    }
    return pixelHeight;
  })

  chart.cursor = new am4charts.XYCursor();
}



// function createXYChart3(chart,seriesType) {
//   chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

//   chart.paddingBottom = 30;

//   chart.data = [{
//       "name": "VP Securities maintenance",
//       "steps": 301,
//       // "href": "https://www.amcharts.com/wp-content/uploads/2019/04/monica.jpg"
//   }, {
//       "name": "IC - Issue Access Connect (ISAC)",
//       "steps": 14,
//       // "href": "https://www.amcharts.com/wp-content/uploads/2019/04/joey.jpg"
//   },
//   {
//     "name": "UNKNOWN",
//     "steps": 5,
//     // "href": "https://www.amcharts.com/wp-content/uploads/2019/04/joey.jpg"
// }];

//   var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
//   categoryAxis.dataFields.category = "name";
//   categoryAxis.renderer.grid.template.strokeOpacity = 0;
//   categoryAxis.renderer.minGridDistance = 10;
//   categoryAxis.renderer.labels.template.dy = 35;
//   categoryAxis.renderer.tooltip.dy = 35;

//   var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
//   valueAxis.renderer.inside = true;
//   valueAxis.renderer.labels.template.fillOpacity = 0.3;
//   valueAxis.renderer.grid.template.strokeOpacity = 0;
//   valueAxis.min = 0;
//   valueAxis.cursorTooltipEnabled = false;
//   valueAxis.renderer.baseGrid.strokeOpacity = 0;

//   var series = chart.series.push(new am4charts[seriesType]());
//   series.dataFields.valueY = "steps";
//   series.dataFields.categoryX = "name";
//   series.tooltipText = "{valueY.value}";
//   series.tooltip.pointerOrientation = "vertical";
//   series.tooltip.dy = - 6;
//   series.columnsContainer.zIndex = 100;

//   var columnTemplate = series.columns.template;
//   columnTemplate.width = am4core.percent(50);
//   columnTemplate.maxWidth = 36;
//   columnTemplate.column.cornerRadius(60, 60, 10, 10);
//   columnTemplate.strokeOpacity = 0;

//   series.heatRules.push({ target: columnTemplate, property: "fill", dataField: "valueY", min: am4core.color("#e5dc36"), max: am4core.color("#5faa46") });
//   series.mainContainer.mask = undefined;

//   var cursor = new am4charts.XYCursor();
//   chart.cursor = cursor;
//   cursor.lineX.disabled = true;
//   cursor.lineY.disabled = true;
//   cursor.behavior = "none";

//   var bullet = columnTemplate.createChild(am4charts.CircleBullet);
//   bullet.circle.radius = 30;
//   bullet.valign = "bottom";
//   bullet.align = "center";
//   bullet.isMeasured = true;
//   bullet.mouseEnabled = false;
//   bullet.verticalCenter = "bottom";
//   bullet.interactionsEnabled = false;

//   var hoverState = bullet.states.create("hover");
//   var outlineCircle = bullet.createChild(am4core.Circle);
//   outlineCircle.adapter.add("radius", function (radius, target) {
//       var circleBullet = target.parent;
//       return circleBullet.circle.pixelRadius;
//   })

//   var image = bullet.createChild(am4core.Image);
//   image.width = 60;
//   image.height = 60;
//   image.horizontalCenter = "middle";
//   image.verticalCenter = "middle";
//   image.propertyFields.href = "href";

//   image.adapter.add("mask", function (mask, target) {
//       var circleBullet = target.parent;
//       return circleBullet.circle;
//   })

//   var previousBullet;
//   chart.cursor.events.on("cursorpositionchanged", function (event) {
//       var dataItem = series.tooltipDataItem;

//       if (dataItem.column) {
//           var bullet = dataItem.column.children.getIndex(1);

//           if (previousBullet && previousBullet != bullet) {
//               previousBullet.isHover = false;
//           }

//           if (previousBullet != bullet) {

//               var hs = bullet.states.getKey("hover");
//               hs.properties.dy = -bullet.parent.pixelHeight + 30;
//               bullet.isHover = true;

//               previousBullet = bullet;
//           }
//       }
//   })
// }

function createXY3DChart2(chart, seriesType) {
	<?php
	$distincts = $file_notused_col->distinct("Application_Name");
	$files_notUsed_array = array();
	foreach($distincts as $distinct)
	{
		$type = $distinct;
		$value = $file_notused_col->find(array("Application_Name"=>$distinct))->count();
		$files_notUsed_array[$type] = $value;
	}
	//print_r($static_dynamic_array);
	?>
  chart.data = [
	  <?php
	  foreach($files_notUsed_array as $key=>$value){
	  ?>
	  {
		"type": "<?php echo $key; ?>",
		"value": <?php echo $value;?>
	  }, 
  //{
  //  "type": "IC - Issue Access Connect (ISAC)",
  //  "value": 14
  //},
  //{
  //  "type": "UNKNOWN",
  //  "value": 5
  //}
  <?php
	  }
  ?>
  ];

  // Create axes
  let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "type";
  categoryAxis.renderer.labels.template.rotation = 270;
  categoryAxis.renderer.labels.template.hideOversized = false;
  categoryAxis.renderer.minGridDistance = 20;
  categoryAxis.renderer.labels.template.horizontalCenter = "right";
  categoryAxis.renderer.labels.template.verticalCenter = "middle";
  categoryAxis.tooltip.label.rotation = 270;
  categoryAxis.tooltip.label.horizontalCenter = "right";
  categoryAxis.tooltip.label.verticalCenter = "middle";

  let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  // valueAxis.title.text = "value";
  valueAxis.title.text = "";
  valueAxis.title.fontWeight = "bold";

  // Create series
  var series = chart.series.push(new am4charts.ColumnSeries3D());
  series.dataFields.valueY = "value";
  series.dataFields.categoryX = "type";
  series.name = "Value";
  series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
  series.columns.template.fillOpacity = .8;

  var columnTemplate = series.columns.template;
  columnTemplate.strokeWidth = 2;
  columnTemplate.strokeOpacity = 1;
  columnTemplate.stroke = am4core.color("#FFFFFF");

  columnTemplate.adapter.add("fill", function (fill, target) {
    return chart.colors.getIndex(target.dataItem.index);
  })

  columnTemplate.adapter.add("stroke", function (stroke, target) {
    return chart.colors.getIndex(target.dataItem.index);
  })

  chart.cursor = new am4charts.XYCursor();
  chart.cursor.lineX.strokeOpacity = 0;
  chart.cursor.lineY.strokeOpacity = 0;
}

function createXYChart3(chart, seriesType) {

  chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

  chart.data = [
    {
      category: "VSAM",
      value1: 10,
      value2: 9,
      value3: 33,
      value4: 42
    }
  ];

  chart.colors.step = 2;
  chart.padding(30, 30, 10, 30);
  chart.legend = new am4charts.Legend();

  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "category";
  categoryAxis.renderer.grid.template.location = 0;

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.min = 0;
  valueAxis.max = 100;
  valueAxis.strictMinMax = true;
  valueAxis.calculateTotals = true;
  valueAxis.renderer.minWidth = 50;


  var series1 = chart.series.push(new am4charts[seriesType]());
  series1.columns.template.width = am4core.percent(80);
  series1.columns.template.tooltipText =
    "{name}: {valueY}";
  series1.name = "No.Of jobs using VSAM Files";
  series1.dataFields.categoryX = "category";
  series1.dataFields.valueY = "value1";
  series1.dataFields.valueYShow = "totalPercent";
  series1.dataItems.template.locations.categoryX = 0.5;
  series1.stacked = true;
  series1.tooltip.pointerOrientation = "vertical";

  var bullet1 = series1.bullets.push(new am4charts.LabelBullet());
  bullet1.interactionsEnabled = false;
  bullet1.label.text = "{valueY}";
  bullet1.label.fill = am4core.color("#ffffff");
  bullet1.locationY = 0.5;

  var series2 = chart.series.push(new am4charts.ColumnSeries());
  series2.columns.template.width = am4core.percent(80);
  series2.columns.template.tooltipText =
    "{name}: {valueY}";
  series2.name = "No.of VSAM file used in Jobs";
  series2.dataFields.categoryX = "category";
  series2.dataFields.valueY = "value2";
  series2.dataFields.valueYShow = "totalPercent";
  series2.dataItems.template.locations.categoryX = 0.5;
  series2.stacked = true;
  series2.tooltip.pointerOrientation = "vertical";

  var bullet2 = series2.bullets.push(new am4charts.LabelBullet());
  bullet2.interactionsEnabled = false;
  bullet2.label.text = "{valueY}";
  bullet2.locationY = 0.5;
  bullet2.label.fill = am4core.color("#ffffff");

  var series3 = chart.series.push(new am4charts.ColumnSeries());
  series3.columns.template.width = am4core.percent(80);
  series3.columns.template.tooltipText =
    "{name}: {valueY}";
  series3.name = "Unused VSAM Files";
  series3.dataFields.categoryX = "category";
  series3.dataFields.valueY = "value3";
  series3.dataFields.valueYShow = "totalPercent";
  series3.dataItems.template.locations.categoryX = 0.5;
  series3.stacked = true;
  series3.tooltip.pointerOrientation = "vertical";

  var bullet3 = series3.bullets.push(new am4charts.LabelBullet());
  bullet3.interactionsEnabled = false;
  bullet3.label.text = "{valueY}";
  bullet3.locationY = 0.5;
  bullet3.label.fill = am4core.color("#ffffff");


  var series4 = chart.series.push(new am4charts[seriesType]());
  series4.columns.template.width = am4core.percent(80);
  series4.columns.template.tooltipText =
    "{name}: {valueY}";
  series4.name = "Total Unique VSAM Counts";
  series4.dataFields.categoryX = "category";
  series4.dataFields.valueY = "value4";
  series4.dataFields.valueYShow = "totalPercent";
  series4.dataItems.template.locations.categoryX = 0.5;
  series4.stacked = true;
  series4.tooltip.pointerOrientation = "vertical";

  var bullet4 = series4.bullets.push(new am4charts.LabelBullet());
  bullet4.interactionsEnabled = false;
  bullet4.label.text = "{valueY}";
  bullet4.label.fill = am4core.color("#ffffff");
  bullet4.locationY = 0.5;


  chart.scrollbarX = new am4core.Scrollbar();
}

function createRadarChart(chart, seriesType) {
  // chart.scrollbarX = new am4core.Scrollbar();

  var data = [];
	<?php
	$ftp_array = array();
	$distinct_apps = $ftp_col->distinct("Application_Name");
	foreach($distinct_apps as $distinct){
		$name = $distinct;
		$count = $ftp_col->find(array("Application_Name"=>$name))->count();
		$ftp_array[$name] = $count;
	}
	//print_r($ftp_array);
	
	?>
  // for(var i = 0; i < 20; i++){
  //   data.push({category: i, value:Math.round(Math.random() * 100)});
  // }
  chart.data = [
	<?php
	foreach($ftp_array as $key=>$value){
	?>
    {
      type: "<?php echo $key; ?>",
      value: <?php echo $value; ?>
    },
    //{
    //  type: "AV Notification",
    //  value: 18
    //},
    //{
    //  type: "DE Debiting",
    //  value: 2
    //},
    //{
    //  type: "EN New issue",
    //  value: 23
    //}, {
    //  type: "EO Issue other",
    //  value: 4
    //},
    //{
    //  type: "EU Payment system",
    //  value: 2
    //},
    //{
    //  type: "FA FATCA",
    //  value: 18
    //},
    //{
    //  type: "IE VPC Analys",
    //  value: 1
    //}
	<?php
	}
	?>
  ];

  chart.radius = am4core.percent(60);
  chart.innerRadius = am4core.percent(10);

  // Create axes
  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "type";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 30;
  categoryAxis.tooltip.disabled = true;
  categoryAxis.renderer.minHeight = 110;
  categoryAxis.renderer.grid.template.disabled = true;
  //categoryAxis.renderer.labels.template.disabled = true;
  let labelTemplate = categoryAxis.renderer.labels.template;
  labelTemplate.radius = am4core.percent(3);
  labelTemplate.location = 0.5;
  labelTemplate.relativeRotation = 90;

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.grid.template.disabled = true;
  valueAxis.renderer.labels.template.disabled = true;
  valueAxis.tooltip.disabled = true;

  // Create series
  var series = chart.series.push(new am4charts[seriesType]());
  series.sequencedInterpolation = true;
  series.dataFields.valueY = "value";
  series.dataFields.categoryX = "type";
  series.columns.template.strokeWidth = 0;
  series.tooltipText = "{valueY}";
  series.columns.template.radarColumn.cornerRadius = 10;
  series.columns.template.radarColumn.innerCornerRadius = 0;

  series.tooltip.pointerOrientation = "vertical";

  // on hover, make corner radiuses bigger
  let hoverState = series.columns.template.radarColumn.states.create("hover");
  hoverState.properties.cornerRadius = 0;
  hoverState.properties.fillOpacity = 1;


  series.columns.template.adapter.add("fill", function (fill, target) {
    return chart.colors.getIndex(target.dataItem.index);
  })

  // Cursor
  chart.cursor = new am4charts.RadarCursor();
  chart.cursor.innerRadius = am4core.percent(50);
  chart.cursor.lineY.disabled = true;
}

function createXY3DChart3(chart, seriesType) {
<?php
 $distinct_ops = $crudops->distinct("Operation");
$crud_only_array = array();
foreach($distinct_ops as $distinct_op)
{
$crud_only_array[$distinct_op] = $crudops->find(array("Operation"=>$distinct_op))->count();
}
asort($crud_only_array);
	
?>

  // Add data
  chart.data = [{
    "type": "CRUD Only",
	<?php
	 foreach($crud_only_array as $operation=>$count)
	{ 
	?>
    "<?php echo $operation;?>Only": <?php echo $count; ?>,
    /*"readOnly": 2709,
    "updateOnly": 2817,
    "deleteOnly": 22610,*/
	<?php
	}
	?>
  }];

  // Create axes
  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "type";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 30;

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.title.text = "CRUD Operation";
  valueAxis.renderer.labels.template.adapter.add("text", function (text) {
    return text + "";
  });

  // Create series
  
<?php 
foreach($crud_only_array as $operation=>$count)
	{
?>
  var <?php echo $operation?>_series = chart.series.push(new am4charts[seriesType]());
  <?php echo $operation?>_series.dataFields.valueY = "<?php echo $operation;?>Only";
  <?php echo $operation?>_series.dataFields.categoryX = "type";
  <?php echo $operation?>_series.name = "<?php echo $operation;?> Only";
  <?php echo $operation?>_series.clustered = false;
  <?php echo $operation?>_series.columns.template.tooltipText = "<?php echo $operation;?> Only: [bold]{valueY}[/]";
  //series.columns.template.fillOpacity = 0.9;
<?php
	}
?>
 /* var series2 = chart.series.push(new am4charts[seriesType]());
  series2.dataFields.valueY = "ReadOnly";
  series2.dataFields.categoryX = "type";
  series2.name = "Read Only";
  series2.clustered = false;
  series2.columns.template.tooltipText = "Read Only: [bold]{valueY}[/]";

  var series3 = chart.series.push(new am4charts[seriesType]());
  series3.dataFields.valueY = "UpdateOnly";
  series3.dataFields.categoryX = "type";
  series3.name = "Update Only";
  series3.clustered = false;
  series3.columns.template.tooltipText = "Update Only: [bold]{valueY}[/]";

  var series4 = chart.series.push(new am4charts[seriesType]());
  series4.dataFields.valueY = "DeleteOnly";
  series4.dataFields.categoryX = "type";
  series4.name = "Delete Only";
  series4.clustered = false;
  series4.columns.template.tooltipText = "Delete Only: [bold]{valueY}[/]";*/
}

function createSlicedChart1(chart, seriesType) {
  chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

  chart.data = [{
    "name": "Insert",
    "value": 600
  }, {
    "name": "Read",
    "value": 300
  }, {
    "name": "Update",
    "value": 200
  }, {
    "name": "Delete",
    "value": 180
  }];

  var series = chart.series.push(new am4charts.FunnelSeries());
  series.colors.step = 2;
  series.dataFields.value = "value";
  series.dataFields.category = "name";
  series.alignLabels = true;

  series.labelsContainer.paddingLeft = 15;
  series.labelsContainer.width = 200;

  //series.orientation = "horizontal";
  //series.bottomRatio = 1;

  chart.legend = new am4charts.Legend();
  chart.legend.position = "left";
  chart.legend.valign = "bottom";
  chart.legend.margin(5, 5, 20, 5);

}
</script>
<?php
?>