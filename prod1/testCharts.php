<?php 
$testData = $testingCol->find();
?>
<script>   
    var testData = [
			<?php
			foreach($testData as $data)
			{
				?>
				{
					"TestCases" : [
						<?php
						foreach($data["TestCases"] as $tdata)
						{
							?>
							{
								"TestCase": "<?php echo $tdata["TestCase"]; ?>",
								"testingcase": <?php echo $tdata["testingcase"]; ?>,
								"color": "<?php echo $tdata["color"]; ?>"
							},
							<?php
						}	
						?>
					],
					"Defects" : [
						<?php
						foreach($data["Defects"] as $defectData)
						{
							?>
							{
								"DefectName": "<?php echo $defectData["DefectName"]; ?>",
								"Count": <?php echo $defectData["Count"]; ?>,
								"color": "<?php echo $defectData["color"]; ?>"
							},
							<?php
						} 
						?>
					],
					"passedCases":[
						<?php
						foreach($data["passedCases"] as $passedcasesData)
						{
							?>
							{
								"title": "<?php echo $passedcasesData["title"]; ?>",
								"value": <?php echo $passedcasesData["value"]; ?>,
                "color": "<?php echo $passedcasesData["color"]; ?>"
							},
							<?php
						}	
						?>
					],
					"Priorities": [
						<?php
						foreach($data["Priorities"] as $prioritiesData)
						{
							?>
							{
								"title": "<?php echo $prioritiesData["title"]; ?>",
								"value": <?php echo $prioritiesData["value"]; ?>,
                "color": "<?php echo $prioritiesData["color"]; ?>"
							},
							<?php
						}	
						?>
					],
					"Completion": [
						<?php
						foreach($data["Completion"] as $completionData)
						{
							?>
							{
								"Status": "<?php echo $completionData["Status"]; ?>",
								"Value": <?php echo $completionData["Value"]; ?>,
                "color": "<?php echo $completionData["color"]; ?>"
							},
							<?php
						}	
						?>
					]
				},
				<?php
			}	
			?>
		];
    var testCasesData = [];
    var defectsTestCasesData = [];
	var testCasesPassedData = [];
	var testPriorityData = [];
    var testCompletionData = [];
    for (var i = 0; i < testData.length; i++) {
        var dataPoint = testData[i];
        for (var y in dataPoint.TestCases) {
            testCasesData.push({
                "TestCase": dataPoint.TestCases[y].TestCase,
                "testingcase": dataPoint.TestCases[y].testingcase,
                "color": dataPoint.TestCases[y].color
            });
        }
		for (var y in dataPoint.Defects) {
            var hasMatch = false;
            for (var index = 0; index < defectsTestCasesData.length; ++index) 
            {
                if(defectsTestCasesData[index].DefectName === dataPoint.Defects[y].DefectName)
                {
                    hasMatch = true;
                    var foundIndex = index;
                    break;
                }
            }
            if(hasMatch)
            {
                defectsTestCasesData[foundIndex].Count += dataPoint.Defects[y].Count;
            }
            else
            {
                defectsTestCasesData.push({
                    "DefectName": dataPoint.Defects[y].DefectName,
					"Count": dataPoint.Defects[y].Count,
					"color": dataPoint.Defects[y].color
                });
            }
        }
		for (var y in dataPoint.passedCases) {
            var hasMatch = false;
            for (var index = 0; index < testCasesPassedData.length; ++index) 
            {
                if(testCasesPassedData[index].title === dataPoint.passedCases[y].title)
                {
                    hasMatch = true;
                    var foundIndex = index;
                    break;
                }
            }
            if(hasMatch)
            {
                testCasesPassedData[foundIndex].value += dataPoint.passedCases[y].value;
            }
            else
            {
                testCasesPassedData.push({
                    "title": dataPoint.passedCases[y].title,
					"value": dataPoint.passedCases[y].value,
					"color": dataPoint.passedCases[y].color
                });
            }
        }

		for (var y in dataPoint.Priorities) {
			var hasMatch = false;
			for (var index = 0; index < testPriorityData.length; ++index) 
			{
				if(testPriorityData[index].title === dataPoint.Priorities[y].title)
				{
					hasMatch = true;
					var foundIndex = index;
					break;
				}
			}
			if(hasMatch)
			{
				testPriorityData[foundIndex].value += dataPoint.Priorities[y].value;
			}
			else
			{
				testPriorityData.push({
					"title": dataPoint.Priorities[y].title,
					"value": dataPoint.Priorities[y].value,
					"color": dataPoint.Priorities[y].color
				});
			}
		}
		for (var y in dataPoint.Completion) {
			var hasMatch = false;
			for (var index = 0; index < testCompletionData.length; ++index) 
			{
				if(testCompletionData[index].Status === dataPoint.Completion[y].Status)
				{
					hasMatch = true;
					var foundIndex = index;
					break;
				}
			}
			if(hasMatch)
			{
				testCompletionData[foundIndex].Value += dataPoint.Completion[y].Value;
			}
			else
			{
				testCompletionData.push({
					"Status": dataPoint.Completion[y].Status,
					"Value": dataPoint.Completion[y].Value,
          "color": dataPoint.Completion[y].color
				});
			}
		}
	 };

    
    
    var chart_test_cases = AmCharts.makeChart("phasediv1", {
		"theme": "light",
		"type": "serial",
    "addClassNames": true,
		"startDuration": 2,
    "fontFamily": "Arial",
		"titles": [{
				"text": "No. of Test Cases by Testing Phase",
				"size": 16,
        "fontFamily": "Arial",
				"align": "center"
			}],
		"dataProvider": testCasesData,
		"valueAxes": [{
			"position": "left",
			"axisAlpha":0,
			"min":1000,
			"position": "left",
			"title": "Test Cases"
		}],
		"graphs": [{
			"balloonText": "[[category]]: <b>[[value]]</b>",
       "cursor": "pointer",
			"colorField": "color",
			"fillAlphas": 1,
			"lineAlpha": 0.1,
			"type": "column",
			"topRadius":1,
			"valueField": "testingcase",
      "dashLengthField": "dashLengthColumn"
		}],
		"depth3D": 40,
		"angle": 30,
		"chartCursor": {
			"categoryBalloonEnabled": false,
			"cursorAlpha": 0,
      "enabled": 1,
			"zoomable": false,
      "cursorPosition": "mouse"
		},
		"categoryField": "TestCase",
		"categoryAxis": {
			"gridPosition": "start",
			"labelRotation": 60,
      "axisAlpha": 0,
    "gridAlpha": 0
		},
//     "listeners": [{
        
//     "event": "clickGraphItem",
//     "method": function(event) {
//       alert('hello');
//       // colorField = "black";
//       // event.item.category.color = "black";
//       // alert('inside');
//     }
//  }],
		"export": {
			"enabled": true
		 }
	}, 0);

       
    var chart_defects_TestCases = AmCharts.makeChart( "purdefect", {
		"theme": "light",
		"type": "serial",
    "fontFamily": "Arial",
		"titles": [ {
			"text": "No. of Test Cases by Defect",
			"size": 16,
      "fontFamily": "Arial",
		}],
		"dataProvider": defectsTestCasesData,
		"categoryField": "DefectName",
		"depth3D": 20,
		"angle": 30,
		"categoryAxis": {
			"labelRotation": 60,
      "gridPosition": "start",
      "axisAlpha": 0,
      "gridAlpha": 0,
      "position": "left"
		},
		"valueAxes": [ {
			"title": "Test Cases"
		}],
		"graphs": [ {
			"valueField": "Count",
			"colorField": "color",
			"type": "column",
			"lineAlpha": 0.1,
			"fillAlphas": 1
		}],
		"chartCursor": {
			"cursorAlpha": 0,
			"zoomable": false,
			"categoryBalloonEnabled": false
		},
		"export": {
			"enabled": true
		}
	});
    
    var chart_testCase_PassedData = AmCharts.makeChart( "pfbdiv", {
		"type": "pie",
		"theme": "light",
    "fontFamily": "Arial",
		"titles": [ {
			"text": "Test Cases Passed/Failed/Blocked",
			"size": 16,
      "fontFamily": "Arial",
      "padding-top": 0
		}],
		"dataProvider": testCasesPassedData,
		"titleField": "title",
		"valueField": "value",
     "colorField": "color",
		"labelRadius": 5,
		"radius": "30%",
		"innerRadius": "45%",
    "labelsEnabled": false,
    "legend" : {
	"enabled": true,
  "align": "center",
   "markerType": "circle",
   "markerSize": 12,
   "horizontalGap": 2,
   
  },
		"labelText": "[[title]]",
		"export": {
			"enabled": true
	  }
	});
    
    var chart_testPriority = AmCharts.makeChart( "priorities", {
		"type": "funnel",
		"theme": "light",
    "fontFamily": "Arial",
		"titles": [ {
			"text": "Defects by Priority",
			"size": 16,
      "fontFamily": "Arial",
			"align": "center"
		} ],
		"dataProvider": testPriorityData,
		"balloon": {
			"fixedPosition": true
		},
		"valueField": "value",
		"titleField": "title",
		"marginRight": 120,
		"marginLeft": 70,
		"startX": -500,
		"rotate": true,
    "colorField": "color",
    // "graphs": [ {
		// 	"valueField": "value",
		// 	"colorField": "color",
		// 	"type": "column",
		// 	"lineAlpha": 0.1,
		// 	"fillAlphas": 1
		// }],
		"labelPosition": "right",
		"balloonText": "[[title]]: [[value]]",
    "legend" : {
	"enabled": true,
  "align": "left",
  "markerType": "circle",
  "markerSize": 12
  },
		"export": {
			"enabled": true
		}
	});
    
    var chart_testCompletion = AmCharts.makeChart( "statuschart", {
		"type": "serial",
		"theme": "light",
    "fontFamily": "Arial",
		"titles": [ {
			"text": "Test Cases Execution Status",
      "fontFamily": "Arial",
			"size": 16
		}],
		"dataProvider": testCompletionData,
		"gridAboveGraphs": true,
		"startDuration": 1,
		"graphs": [ {
			"balloonText": "<span style='font-size:14px'>[[category]]: <b>[[value]]</b>",
			"fillAlphas": 1.0,
			// "lineAlpha": 1.0,
			"type": "column",
			"valueField": "Value",
      "colorField": "color",
      //  "capMaximum": 10,
		}],
		"chartCursor": {
			"categoryBalloonEnabled": false,
			"cursorAlpha": 0,
			"zoomable": false
		},
		"categoryField": "Status",
    
    "marginRight": 35,
		"marginLeft": 0,
		"categoryAxis": {
			"gridPosition": "start",
			"axisAlpha": 0,
      "gridAlpha": 0,
			"tickPosition": "start",
			"tickLength": 20,
      "autoWrap": 1
		},
    "valueAxis": {
		"capMinimum": 10
		},
		"export": {
			"enabled": true
		}
	});

var chart = AmCharts.makeChart( "donutchart", {
		  "type": "pie",
		  "theme": "light",
      "fontFamily": "Arial",
		  // "titles": [ {
			// "text": "Test Cases For Each Application Cluster",
      // "fontFamily": "Arial",
			// "size": 16
		  // } ],
		  "dataProvider": [ {
			"Application": "Application 1",
			"value": 7695
		  }, {
			"Application": "Application 2",
			"value": 4325
		  }, {
			"Application": "Application 3",
			"value": 2252
		  }, {
			"Application": "Application 4",
			"value": 1765
		  }, {
			"Application": "Application 5",
			"value": 1565
		  }, {
			"Application": "Application 6",
			"value": 857
		  }, {
			"Application": "Application 7",
			"value": 827
		  }, {
			"Application": "Application 8",
			"value": 654
		  } ],
		  "valueField": "value",
		  "titleField": "Application",
		  "startEffect": "elastic",
		  "startDuration": 2,
		  // "labelRadius": 15,
      "labelsEnabled": false,
		  "innerRadius": "50%",
		  "depth3D": 10,
		  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
		  "angle": 15,
      "legend" : {
	"enabled": true,
  "align": "center",
  "markerType": "circle",
  "markerSize": 12
  },
		  "export": {
			"enabled": true
		  }
		} );


		var chart = AmCharts.makeChart("newdiv", {
  "type": "serial",
  "theme": "light",
  "fontFamily": "Arial",
  "rotate": true,
  "marginBottom": 50,
  "paddingRight": 8,
  "paddingLeft": -4,
  "dataProvider": [{
    "task": "Task1",
    "actual": -0.1,
    "scheduled": 0.3
  }, {
    "task": "Task2",
    "actual": -0.2,
    "scheduled": 0.3
  }, {
    "task": "Task3",
    "actual": -0.3,
    "scheduled": 0.6
  }, {
    "task": "Task4",
    "actual": -0.5,
    "scheduled": 0.8
  },{
    "task": "Task5",
    "actual": -3.2,
    "scheduled": 3.4
  }, {
    "task": "Task6",
    "actual": -4.4,
    "scheduled": 4.1
  }, {
    "task": "Task7",
    "actual": -5.2,
    "scheduled": 5.0
  }],
  "startDuration": 1,
  "graphs": [{
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "actual",
    "title": "actual",
     "legend" : {
	"enabled": true,
  "align": "center"
  },
    "labelText": "[[value]]",
   
    "clustered": false,
    "labelFunction": function(item) {
      return Math.abs(item.values.value);
    },
    "balloonFunction": function(item) {
      return item.category + ": " + Math.abs(item.values.value) + "hr";
    }
  }, {
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "scheduled",
    "title": "scheduled",
    "labelText": "[[value]]",
    "clustered": false,
    "labelFunction": function(item) {
      return Math.abs(item.values.value);
    },
    "balloonFunction": function(item) {
      return item.category + ": " + Math.abs(item.values.value) + "hr";
    }
  }],
  "categoryField": "task",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0.2,
    "axisAlpha": 0
  },
  "valueAxes": [{
    "gridAlpha": 0,
    "ignoreAxisWidth": true,
    "labelFunction": function(value) {
      return Math.abs(value) + 'hr';
    },
    "guides": [{
      "value": 0,
      "lineAlpha": 0.2
    }]
  }],
  "balloon": {
    "fixedPosition": true
  },
  "chartCursor": {
    "valueBalloonsEnabled": false,
    "cursorAlpha": 0.05,
    "fullWidth": true
  },
  "allLabels": [{
    "text": "Actual",
    "x": "28%",
    "y": "92%",
    "bold": true,
    "align": "middle"
  }, {
    "text": "Scheduled",
    "x": "75%",
    "y": "92%",
    "bold": true,
    "align": "middle"
  }]

});


  
<?php
	
  $pass = $testCol->find(array('$text' => array('$search'=> "Passed")))->count();
  $paused = $testCol->find(array('$text' => array('$search'=> "Deferred")))->count();
  $fail = $testCol->find(array('$text' => array('$search'=> "Failed")))->count();
  $notapp = $testCol->find(array('$text' => array('$search'=> "N/A")))->count();
  $blocked = $testCol->find(array('$text' => array('$search'=> "Blocked")))->count(); 
  $inconclusive = $testCol->find(array('$text' => array('$search'=> "Not Completed")))->count();
  $none = $testCol->find(array('$text' => array('$search'=> "No")))->count();
  $notexecutive = $testCol->find(array('$text' => array('$search'=> "No Run")))->count(); 
  $notexecuted = $testCol->find(array('$text' => array('$search'=> "Clarification Needed")))->count();

  // total percent of each test case by execution
  $total_exec = $pass+$paused+$fail+$notapp+$blocked+$inconclusive+$none+$notexecutive+$notexecuted;
  $total_pass = ($pass * 100) / $total_exec;
  $total_paused = ($paused * 100) / $total_exec;
  $total_fail = ($fail * 100) / $total_exec;
  $total_notapp = ($notapp * 100) / $total_exec;
  $total_blocked = ($blocked * 100) / $total_exec;
  $total_inconclusive = ($inconclusive * 100) / $total_exec;
  $total_nodata = ($none * 100) / $total_exec;
  $total_norundata = ($notexecutive * 100) / $total_exec;
  $total_clrneeddata = ($notexecuted * 100) / $total_exec;

?> 


var chart = AmCharts.makeChart("testbyexecno", {
  "type": "serial",
  "theme": "light",
  "fontFamily": "Arial",
  "marginRight": 70,
  	"titles": [{
            "text": 'Test Cases by Execution',
			"size":16,
			"position": "top",
      "fontFamily": "Arial",
			"paddingTop":0
        }],
  "dataProvider": [{
  "execution": "Passed",
    "value": <?php echo $pass; ?>,
    "percent": <?php echo round($total_pass,2); ?>,
    "color": "#FF0F00"
  }, 
  {
   "execution": "Not Executed",
    "value": <?php echo $notexecuted; ?>,
    "percent": <?php echo round($total_clrneeddata,2); ?>,
    "color": "#FF6600"
  }, 
  {
    "execution": "Not Applicable",
    "value": <?php echo $notapp; ?>,
    "percent": <?php echo round($total_notapp,2); ?>,
    "color": "#FF9E01"
  }, {
    "execution": "Failed",
    "value": <?php echo $fail; ?>,
    "percent": <?php echo round($total_fail,2); ?>,
    "color": "#FCD202"
  }, {
    "execution": "Blocked",
    "value": <?php echo $blocked; ?>,
    "percent": <?php echo round($total_blocked,2); ?>,
    "color": "#F8FF01"
  },
  //  {
  //   "execution": "None",
  //   "value": <?php echo $none; ?>,
  //   "percent": <?php echo round($total_nodata,2); ?>,
  //   "color": "#B0DE09"
  // },
   {
    "execution": "Paused",
    "value": <?php echo $paused; ?>,
    "percent": <?php echo round($total_paused,2); ?>,
    "color": "#04D215"
  }, {
    "execution": "Inconclusive",
    "value": <?php echo $inconclusive; ?>,
    "percent": <?php echo round($total_inconclusive,2); ?>,
    "color": "#0D8ECF"
  }, {
   "execution": "Not Executive",
    "value": <?php echo $notexecutive; ?>,
    "percent": <?php echo round($total_norundata,2); ?>,
    "color": "#0D52D1"
  }],
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": ""
  },
],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]] ([[percent]] %)</b> ",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "value"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "execution",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});


<?php
	
  $low = $testCol->find(array('$text' => array('$search'=> "Low")))->count();
  $medium = $testCol->find(array('$text' => array('$search'=> "Medium")))->count();
  $high = $testCol->find(array('$text' => array('$search'=> "High")))->count();
  $crit = $testCol->find(array('$text' => array('$search'=> "Critical")))->count();
?> 


var chart = AmCharts.makeChart("testbypriority", {
  "type": "serial",
  "theme": "light",
  "fontFamily": "Arial",
  "marginRight": 70,
  	"titles": [{
            "text": 'Test Cases by Priority',
			"size":16,
      "fontFamily": "Arial",
			"position": "top",
			"paddingTop":0
        }],
  "dataProvider": [{
   "title": "Low",
     "value": <?php echo $low; ?>,
     "color": "#2dfe34"
   },{
     "title": "Medium",
     "value": <?php echo $medium; ?>,
     "color": "#6fdae4"
   },{
     "title": "High",
     "value": <?php echo $high; ?>,
     "color": "#CCCC00"
   }, {
     "title": "Critical",
     "value": <?php echo $crit; ?>,
     "color": "#7c0a02"
   }],
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": ""
  }],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]] </b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "value"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "title",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});


<?php

  $ready = $testCol->find(array('$text' => array('$search'=> "Ready")))->count(); 
  $closed = $testCol->find(array('$text' => array('$search'=> "Repair, Imported")))->count();
  $design = $testCol->find(array('$text' => array('$search'=> "Design")))->count();
?> 


var chart = AmCharts.makeChart("testbystate", {
  "type": "serial",
  "theme": "light",
  "fontFamily": "Arial",
  "marginRight": 70,
  	"titles": [{
            "text": 'Test Cases by State',
			"size":16,
			"position": "top",
      "fontFamily": "Arial",
			"paddingTop":0
        }],
  "dataProvider": [{
   "title": "Design",
     "value": <?php echo $ready; ?>,
     "color": "#6fdae4"
   },{
     "title": "Closed",
     "value": <?php echo $closed; ?>,
     "color": "#CCCC00"
   },{
     "title": "Ready",
     "value": <?php echo $design; ?>,
     "color": "#2fe234"
   }],
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": ""
  }],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]] </b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "value"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "title",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});

<?php
  $auto = $testCol->find(array("TS_TYPE" => array('$ne' => "MANUAL")))->count();
  $total_data = $testCol->count();
  $total_percent =  ($auto * 100)/ $total_data;
  ?>
       
var gaugeChart = AmCharts.makeChart( "perautomated", {
  "type": "gauge",
  "theme": "light",
  "fontFamily": "Arial",
  	"titles": [{
            "text": '% Automation Achieved',
			"size":16,
			"position": "top",
      "fontFamily": "Arial",
			"paddingTop":0
        }],
  "axes": [ {
    "axisThickness": 1,
    "axisAlpha": 0.2,
    "tickAlpha": 0.2,
    "valueInterval": 10,   
    "bands": [ {
      "color": "#cc4748",
      "endValue": 10,
      "startValue": 0
    },
    //  {
    //   "color": "#fdd400",
    //   "endValue": 130,
    //   "startValue": 90
    // },
     {
      "color": "#84b761",
      "endValue": 100,
      "innerRadius": "95%",
      "startValue": 10
    } ],
    "bottomText": "<?php echo round($total_percent,2);  ?>%",
    "bottomTextYOffset": -20,
    "endValue": 100
  } ],
  "arrows": [ {
      "value": <?php echo $total_percent; ?>
  } ], 
  "export": {
    "enabled": true
  }
} );



<?php
  $manual = $testCol->find(array('$text' => array('$search'=> "MANUAL")))->count();
?> 

var chart = AmCharts.makeChart( "testautomation", {
  "type": "pie",
  "theme": "light",
  "fontFamily": "Arial",
  	"titles": [{
            "text": 'Test Case by Automation',
			"size":16,
      "fontFamily": "Arial",
			"position": "top",
			"paddingTop":0
        }],
  "dataProvider": [ {
     "status": "Automated",
     "color": "#bfe9ff",  
     "value": <?php echo $auto; ?>
  }, {
    "status": "Not-Automated",
    "color": "#CCCC00",
    "value": <?php echo $manual; ?>
  } ],
  "titleField": "status",
  "valueField": "value",
  "labelRadius": 5,
  "balloonText": "<b>[[status]]: [[value]] </b>",
  "radius": "25%",
  "innerRadius": "45%",
  "labelsEnabled": false,
  "labelText": "[[status]] : [[value]]",
  "labelRotation": 40,
   "legend" : {
	"enabled": true,
  "align": "center",
  "fontFamily": "Arial",
  "markerType": "circle",
  "markerSize": 12
  },
  "export": {
    "enabled": true
  }
} );


	
	chart_test_cases.addListener("clickGraphItem", function (event) {
        var testCasesData = [];
		var defectsTestCasesData = [];
		var testCasesPassedData = [];
		var testPriorityData = [];
		var testCompletionData = [];
		for (var i = 0; i < testData.length; i++) {
			var dataPoint = testData[i];
			for (var y in dataPoint.TestCases) {
				if(dataPoint.TestCases[y].TestCase === event.item.dataContext.TestCase)
				{
					for (var j = 0; j < dataPoint.Defects.length; j++){
						defectsTestCasesData.push({
							"DefectName": dataPoint.Defects[j].DefectName,
							"Count": dataPoint.Defects[j].Count,
							"color": dataPoint.Defects[j].color
						})
					};
					for (var j = 0; j < dataPoint.passedCases.length; j++){
					testCasesPassedData.push({
						"title": dataPoint.passedCases[j].title,
						"value": dataPoint.passedCases[j].value,
            "color": dataPoint.passedCases[j].color
					})
					};
					for (var j = 0; j < dataPoint.Priorities.length; j++){
					testPriorityData.push({
						"title": dataPoint.Priorities[j].title,
						"value": dataPoint.Priorities[j].value,
            "color": dataPoint.Priorities[j].color
					})
					};
					for (var j = 0; j < dataPoint.Completion.length; j++){
					testCompletionData.push({
						"Status": dataPoint.Completion[j].Status,
						"Value": dataPoint.Completion[j].Value,
            "color": dataPoint.Completion[j].color
					})
					};
				}
			}
		}
        chart_defects_TestCases.dataProvider = defectsTestCasesData;
        chart_defects_TestCases.validateData();
        chart_defects_TestCases.animateAgain();
        chart_testCase_PassedData.dataProvider = testCasesPassedData;
        chart_testCase_PassedData.validateData();
        chart_testCase_PassedData.animateAgain();
        chart_testPriority.dataProvider = testPriorityData;
        chart_testPriority.validateData();
        chart_testPriority.animateAgain();
        chart_testCompletion.dataProvider = testCompletionData;
        chart_testCompletion.validateData();
        chart_testCompletion.animateAgain();
    });



function refreshPage(){
    window.location.reload();
} 




</script>