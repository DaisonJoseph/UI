<?php 
$testData = $testingCol->find();
?>
<script>   
  //  var colors = ['#0070AD', '#12ABDB', '#95E616', '#FF304C', '#C8FF16', '#6D64CC', '#FF6327', '#7E39BA', '#FF7E83', '#00C37B', '#4701A7', '#CB2980', '#01D1D0', '#860864', '#0F999C', '#15636B', '#80B8D6', '#88D5ED']
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
								"value": <?php echo $passedcasesData["value"]; ?>
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
								"value": <?php echo $prioritiesData["value"]; ?>
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
								"Value": <?php echo $completionData["Value"]; ?>
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
		"titles": [{
				"text": "No. of Testcases for each Testing Phase",
				"size": 14,
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
			"fillAlphas": 0.85,
			"lineAlpha": 0.1,
			"type": "column",
			"topRadius":1,
			"valueField": "testingcase"
		}],
		"depth3D": 40,
		"angle": 30,
		"chartCursor": {
			"categoryBalloonEnabled": false,
			"cursorAlpha": 0,
      "enabled": 1,
			"zoomable": false
		},
		"categoryField": "TestCase",
		"categoryAxis": {
			"gridPosition": "start",
			"labelRotation": 25
		},
		"export": {
			"enabled": true
		 }
	}, 0);
    
    var chart_defects_TestCases = AmCharts.makeChart( "purdefect", {
		"theme": "light",
		"type": "serial",
		"titles": [ {
			"text": "No of testcases for particular defect",
			"size": 16
		}],
		"dataProvider": defectsTestCasesData,
		"categoryField": "DefectName",
		"depth3D": 20,
		"angle": 30,
		"categoryAxis": {
			"labelRotation": 90,
			"gridPosition": "start"
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
		"titles": [ {
			"text": "Test cases passed/failed/blocked",
			"size": 16
		}],
		"dataProvider": testCasesPassedData,
		"titleField": "title",
		"valueField": "value",
		"labelRadius": 5,
		"radius": "42%",
		"innerRadius": "60%",
		"labelText": "[[title]]",
		"export": {
			"enabled": true
	  }
	});
    
    var chart_testPriority = AmCharts.makeChart( "priorities", {
		"type": "funnel",
		"theme": "light",
		"titles": [ {
			"text": "Defects by priority",
			"size": 16,
			"align": "center"
		} ],
		"dataProvider": testPriorityData,
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
		"balloonText": "[[title]]: [[value]][[description]]",
		"export": {
			"enabled": true
		}
	});
    
    var chart_testCompletion = AmCharts.makeChart( "statuschart", {
		"type": "serial",
		"theme": "light",
		"titles": [ {
			"text": "Test Completion Status",
			"size": 16
		}],
		"dataProvider": testCompletionData,
		"gridAboveGraphs": true,
		"startDuration": 1,
		"graphs": [ {
			"balloonText": "[[title]]<br><span style='font-size:14px'>[[category]]: <b>[[value]]</b>",
			"fillAlphas": 5.0,
			"lineAlpha": 1.0,
			"type": "column",
			"valueField": "Value"
		}],
		"chartCursor": {
			"categoryBalloonEnabled": false,
			"cursorAlpha": 0,
			"zoomable": false
		},
		"categoryField": "Status",
		"categoryAxis": {
			"gridPosition": "start",
			"gridAlpha": 0,
			"tickPosition": "start",
			"tickLength": 20
		},
		"export": {
			"enabled": true
		}
	});


	var chart = AmCharts.makeChart( "pye", {
  "type": "pie",
  "theme": "light",
  "titles": [ {
			"text": "Percentage of Completion Status",
			"size": 16
	  }],
  "dataProvider": [ {
    "title": "Executed",
    "value": 60
  }, {
    "title": "Not Executed",
    "value": 40
  } ],
  "titleField": "title",
  "valueField": "value",
  "labelRadius": 2,

  "radius": "35%",
  "innerRadius": "60%",
  "labelText": "[[title]]",
  "legend" : {
	"enabled": true
  },
  "export": {
    "enabled": true
  }
} );
var chart = AmCharts.makeChart( "donutchart", {
		  "type": "pie",
		  "theme": "light",
		  "titles": [ {
			"text": "Test cases for each Application Cluster",
			"size": 16
		  } ],
		  "dataProvider": [ {
			"application": "application1",
			"value": 7252
		  }, {
			"application": "application2",
			"value": 3882
		  }, {
			"application": "application3",
			"value": 1809
		  }, {
			"application": "application4",
			"value": 1322
		  }, {
			"application": "application5",
			"value": 1122
		  }, {
			"application": "application6",
			"value": 414
		  }, {
			"application": "application7",
			"value": 384
		  }, {
			"application": "application8",
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
		var chart = AmCharts.makeChart("newdiv", {
  "type": "serial",
  "theme": "light",
  "rotate": true,
  "marginBottom": 50,
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
    "actual": -5.0,
    "scheduled": 4.8
  }],
  "startDuration": 1,
  "graphs": [{
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "actual",
    "title": "actual",
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
	$passdata = array('$text' => array('$search'=> "Passed"));
  $pass = $testCol->find($passdata)->count();
  $deferreddata = array('$text' => array('$search'=> "Deferred"));
  $paused = $testCol->find($deferreddata)->count();
	$faildata = array('$text' => array('$search'=> "Failed"));
  $fail = $testCol->find($faildata)->count();
  $nadata = array('$text' => array('$search'=> "N/A"));
  $notapp = $testCol->find($nadata)->count();
  $blockdata = array('$text' => array('$search'=> "Blocked"));
  $blocked = $testCol->find($blockdata)->count();
  $notcomdata = array('$text' => array('$search'=> "Not Completed"));
  $inconclusive = $testCol->find($notcomdata)->count();
  $nodata = array('$text' => array('$search'=> "No"));
  $none = $testCol->find($nodata)->count();
  $norundata = array('$text' => array('$search'=> "No Run"));
  $notexecutive = $testCol->find($norundata)->count();
  $clrneeddata = array('$text' => array('$search'=> "Clarification Needed"));
  $notexecuted = $testCol->find($clrneeddata)->count();

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

var chart = AmCharts.makeChart("testbyexecper", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  	"titles": [{
            "text": '% Test Case by Execution',
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
  "dataProvider": [{
  "execution": "Passed",
    "value": <?php echo round($total_pass,2); ?>,
    "color": "#FF0F00"
  }, {
   "execution": "Not Executed",
    "value": <?php echo round($total_clrneeddata,2); ?>,
    "color": "#FF6600"
  }, {
    "execution": "Not Applicable",
    "value": <?php echo round($total_notapp,2); ?>,
    "color": "#FF9E01"
  }, {
    "execution": "Failed",
    "value": <?php echo round($total_fail,2); ?>,
    "color": "#FCD202"
  }, {
    "execution": "Blocked",
    "value": <?php echo round($total_blocked,2); ?>,
    "color": "#F8FF01"
  }, {
    "execution": "None",
    "value": <?php echo round($total_nodata,2); ?>,
    "color": "#B0DE09"
  }, {
    "execution": "Paused",
    "value": <?php echo round($total_paused,2); ?>,
    "color": "#04D215"
  }, {
    "execution": "Inconclusive",
    "value": <?php echo round($total_inconclusive,2); ?>,
    "color": "#0D8ECF"
  }, {
   "execution": "Not Executive",
    "value": <?php echo round($total_norundata,2); ?>,
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
    "balloonText": "<b>[[category]]: [[value]] % </b>",
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







var chart = AmCharts.makeChart("testbyexecno", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  	"titles": [{
            "text": 'Test Case by Execution',
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
  "dataProvider": [{
  "execution": "Passed",
    "value": <?php echo $pass; ?>,
    "color": "#FF0F00"
  }, {
   "execution": "Not Executed",
    "value": <?php echo $notexecuted; ?>,
    "color": "#FF6600"
  }, {
    "execution": "Not Applicable",
    "value": <?php echo $notapp; ?>,
    "color": "#FF9E01"
  }, {
    "execution": "Failed",
    "value": <?php echo $fail; ?>,
    "color": "#FCD202"
  }, {
    "execution": "Blocked",
    "value": <?php echo $blocked; ?>,
    "color": "#F8FF01"
  }, {
    "execution": "None",
    "value": <?php echo $none; ?>,
    "color": "#B0DE09"
  }, {
    "execution": "Paused",
    "value": <?php echo $paused; ?>,
    "color": "#04D215"
  }, {
    "execution": "Inconclusive",
    "value": <?php echo $inconclusive; ?>,
    "color": "#0D8ECF"
  }, {
   "execution": "Not Executive",
    "value": <?php echo $notexecutive; ?>,
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
  "categoryField": "execution",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});





var chart = AmCharts.makeChart("testbynode", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  	"titles": [{
            "text": 'Test Case by Application',
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
  "dataProvider": [{
    "node": "NBFC",
    "value": 6785,
    "color": "#FF0F00"
  }, {
   "node": "Duck Creek",
    "value": 2479,
    "color": "#FF6600"
  }, {
    "node": "GMC",
    "value": 961,
    "color": "#FF9E01"
  }, {
    "node": "Federated LIVE",
    "value": 718,
    "color": "#FCD202"
  }, {
   "node": "EDW Datamark",
    "value": 647,
    "color": "#F8FF01"
  }, {
    "node": "Claims Desk",
    "value": 258,
    "color": "#B0DE09"
  }, {
    "node": "Neuron ESB",
    "value": 245,
    "color": "#04D215"
  }, {
    "node": "NOL",
    "value": 200,
    "color": "#0D8ECF"
  }, {
   "node": "Clips",
    "value": 107,
    "color": "#0D52D1"
  },
  {
    "node": "BICC",
    "value": 74,
    "color": "#FF0F00"
  }, {
   "node": "Legacy Report Groups",
    "value": 54,
    "color": "#FF6600"
  }, {
    "node": "VIP",
    "value": 51,
    "color": "#FF9E01"
  }, {
    "node": "Others RMS",
    "value": 44,
    "color": "#FCD202"
  }, {
   "node": "Document Mgmt Service",
    "value": 29,
    "color": "#F8FF01"
  }, {
    "node": "Finance",
    "value": 27,
    "color": "#B0DE09"
  }, {
    "node": "OASIS",
    "value": 26,
    "color": "#04D215"
  }, {
    "node": "PMS(Mainframe)",
    "value": 26,
    "color": "#0D8ECF"
  }, {
   "node": "Compass",
    "value": 25,
    "color": "#0D52D1"
  },
  {
    "node": "C PLUS",
    "value": 13,
    "color": "#FF0F00"
  }, {
   "node": "Extracts",
    "value": 11,
    "color": "#FF6600"
  }, {
    "node": "Commission-Billing",
    "value": 7,
    "color": "#FF9E01"
  }, {
    "node": "NIAP",
    "value": 7,
    "color": "#FCD202"
  }, {
   "node": "Sales Desk",
    "value": 6,
    "color": "#F8FF01"
  }, {
    "node": "Tokio",
    "value": 6,
    "color": "#B0DE09"
  }, {
    "node": "Underwriting Region",
    "value": 6,
    "color": "#04D215"
  }, {
    "node": "PEDW Staging",
    "value": 4,
    "color": "#0D8ECF"
  }, {
   "node": "Management",
    "value": 4,
    "color": "#0D52D1"
  },
  {
    "node": "Regulatory",
    "value": 3,
    "color": "#FF0F00"
  }],
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": ""
  },
],
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
  "categoryField": "node",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});

var chart = AmCharts.makeChart("testbynodeper", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  	"titles": [{
            "text": '% Test Case by Node',
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
  "dataProvider": [{
    "node": "NBFC",
    "value": 85,
    "color": "#FF0F00"
  }, {
   "node": "Duck Creek",
    "value": 80,
    "color": "#FF6600"
  }, {
    "node": "GMC",
    "value": 79,
    "color": "#FF9E01"
  }, {
    "node": "Federated LIVE",
    "value": 78,
    "color": "#FCD202"
  }, {
   "node": "EDW Datamark",
    "value": 75,
    "color": "#F8FF01"
  }, {
    "node": "Claims Desk",
    "value": 72,
    "color": "#B0DE09"
  }, {
    "node": "Neuron ESB",
    "value": 70,
    "color": "#04D215"
  }, {
    "node": "NOL",
    "value": 64,
    "color": "#0D8ECF"
  }, {
   "node": "Clips",
    "value": 60,
    "color": "#0D52D1"
  },
  {
    "node": "BICC",
    "value": 60,
    "color": "#FF0F00"
  }, {
   "node": "Legacy Report Groups",
    "value": 54,
    "color": "#FF6600"
  }, {
    "node": "VIP",
    "value": 51,
    "color": "#FF9E01"
  }, {
    "node": "Others RMS",
    "value": 44,
    "color": "#FCD202"
  }, {
   "node": "Document Mgmt Service",
    "value": 29,
    "color": "#F8FF01"
  }, {
    "node": "Finance",
    "value": 27,
    "color": "#B0DE09"
  }, {
    "node": "OASIS",
    "value": 26,
    "color": "#04D215"
  }, {
    "node": "PMS(Mainframe)",
    "value": 26,
    "color": "#0D8ECF"
  }, {
   "node": "Compass",
    "value": 25,
    "color": "#0D52D1"
  },
  {
    "node": "C PLUS",
    "value": 13,
    "color": "#FF0F00"
  }, {
   "node": "Extracts",
    "value": 11,
    "color": "#FF6600"
  }, {
    "node": "Commission-Billing",
    "value": 7,
    "color": "#FF9E01"
  }, {
    "node": "NIAP",
    "value": 7,
    "color": "#FCD202"
  }, {
   "node": "Sales Desk",
    "value": 6,
    "color": "#F8FF01"
  }, {
    "node": "Tokio",
    "value": 6,
    "color": "#B0DE09"
  }, {
    "node": "Underwriting Region",
    "value": 6,
    "color": "#04D215"
  }, {
    "node": "PEDW Staging",
    "value": 4,
    "color": "#0D8ECF"
  }, {
   "node": "Management",
    "value": 4,
    "color": "#0D52D1"
  },
  {
    "node": "Regulatory",
    "value": 3,
    "color": "#FF0F00"
  }],
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": ""
  },
],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]]% </b>",
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
  "categoryField": "node",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});

<?php
	$lowdata = array('$text' => array('$search'=> "Low"));
  $low = $testCol->find($lowdata)->count();
  $meddata = array('$text' => array('$search'=> "Medium"));
  $medium = $testCol->find($meddata)->count();
	$highdata = array('$text' => array('$search'=> "High"));
  $high = $testCol->find($highdata)->count();
  $critdata = array('$text' => array('$search'=> "Critical"));
  $crit = $testCol->find($critdata)->count();
?> 


var chart = AmCharts.makeChart("testbypriority", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  	"titles": [{
            "text": 'Test Case by Priority',
			"size":16,
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
	$readydata = array('$text' => array('$search'=> "Ready"));
  $ready = $testCol->find($readydata)->count();
  $closeddata = array('$text' => array('$search'=> "Repair, Imported"));
  $closed = $testCol->find($closeddata)->count();
	$designdata = array('$text' => array('$search'=> "Design"));
  $design = $testCol->find($designdata)->count();
?> 


var chart = AmCharts.makeChart("testbystate", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  	"titles": [{
            "text": 'Test Case by State',
			"size":16,
			"position": "top",
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
  $autodata = array('$text' => array('$search'=>"QUICKTEST_TEST, WR-AUTOMATED, WR-AUTOMATED" ));
  $auto = $testCol->find($autodata)->count();
  $total_data = 335059;
  $total_percent =  ($auto * 100)/ $total_data;
?> 

var gaugeChart = AmCharts.makeChart( "perautomated", {
  "type": "gauge",
  "theme": "light",
  	"titles": [{
            "text": '% Automated',
			"size":16,
			"position": "top",
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

//  setInterval(randomValue, 1000);
//  console.log(randomvalue);

// // set random value
// function randomValue() {
//   var value = Math.round( Math.random() * 100 );
//   if ( gaugeChart ) {
//     if ( gaugeChart.arrows ) {
//       if ( gaugeChart.arrows[ 0 ] ) {
//         if ( gaugeChart.arrows[ 0 ].setValue ) {
//           gaugeChart.arrows[ 0 ].setValue( value );
//           gaugeChart.axes[ 0 ].setBottomText( value + " %" );
//         }
//       }
//     }
//   }
// }

<?php
	$manualdata = array('$text' => array('$search'=> "MANUAL"));
  $manual = $testCol->find($manualdata)->count();
?> 

var chart = AmCharts.makeChart( "testautomation", {
  "type": "pie",
  "theme": "light",
  	"titles": [{
            "text": 'Test Case by Automation',
			"size":16,
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

  "radius": "20%",
  "innerRadius": "40%",
  "labelText": "[[status]]",
  "labelRotation": 20,
  "export": {
    "enabled": true
  }
} );




var chart = AmCharts.makeChart("testbytrend", {
    "type": "serial",
    "theme": "light",
		"titles": [{
            "text": 'Test Execution Trend',
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
    "legend": {
        "equalWidths": false,
        "periodValueText": "total: [[value.sum]]",
        // "position": "top",
				"marginTop": 30,
        "valueAlign": "left",
        "valueWidth": 100
    },
    "dataProvider": [{
        "year": 2014,
        "authorized": 0,
        "created": 130,
        "executed": 130
    }, {
        "year": 2015,
        "authorized": 3530,
        "created": 4258,
        "executed": 2350
    }, {
        "year": 2016,
        "authorized": 9121,
        "created": 8384,
        "executed": 6292
    }, {
        "year": 2017,
       "authorized": 3487,
        "created": 2496,
        "executed": 1485
    }, {
        "year": 2018,
        "authorized": 6489,
        "created": 5483,
        "executed": 5473
    }],
    "valueAxes": [{
        "stackType": "regular",
        "gridAlpha": 0.07,
        "position": "left",
        "title": "value"
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "authorized",
        "valueField": "authorized"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "created",
        "valueField": "created"
    },
    {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "executed",
        "valueField": "executed"
    }],
    "plotAreaBorderAlpha": 0,
    "marginTop": 10,
    "marginLeft": 0,
    "marginBottom": 0,
    "chartScrollbar": {},
    "chartCursor": {
        "cursorAlpha": 0
    },
    "categoryField": "year",
    "categoryAxis": {
        "startOnAxis": true,
        "axisColor": "#DADADA",
        "gridAlpha": 0.07,
        "title": "Year"
    },
    "export": {
    	"enabled": true
     }
});







// ----------------------------------------------------------
// charts for defect
// ------------------------------------------

// var chart = AmCharts.makeChart( "TestExecuted", {
//   "type": "serial",
//   "theme": "light",
//   "titles": [{
//             "text": 'Test Cases executed per person per per Day',
// 			"size":16
//         } ],
//   "dataProvider": [ {
//     "Test Cases executed per person per per Day": "Person1",
//     "Test cases Executed": 2025
//   }, {
//     "Test Cases executed per person per per Day": "Person2",
//     "Test cases Executed": 1882
//   }, {
//     "Test Cases executed per person per per Day": "Person3",
//     "Test cases Executed": 1809
//   }, {
//     "Test Cases executed per person per per Day": "Person4",
//     "Test cases Executed": 1322
//   }, {
//     "Test Cases executed per person per per Day": "Person5",
//     "Test cases Executed": 1122
//   }, ],
//   "valueAxes": [ {
//     "gridColor": "#FFFFFF",
//     "gridAlpha": 0.2,
//     "dashLength": 0
//   } ],
//   "gridAboveGraphs": true,
//   "startDuration": 1,
//   "graphs": [ {
//     "balloonText": "[[category]]: <b>[[value]]</b>",
//     "fillAlphas": 0.8,
//     "lineAlpha": 0.2,
//     "type": "column",
//     "valueField": "Test cases Executed"
//   } ],
//   "chartCursor": {
//     "categoryBalloonEnabled": false,
//     "cursorAlpha": 0,
//     "zoomable": false
//   },
//   "categoryField": "Test Cases executed per person per per Day",
//   "categoryAxis": {
//     "gridPosition": "start",
//     "gridAlpha": 0,
//     "tickPosition": "start",
//     "tickLength": 20
//   },
//   "export": {
//     "enabled": true
//   }

// } );

// var chart = AmCharts.makeChart( "priority", {
//   "type": "funnel",
//   "theme": "light",
//   "titles": [ {
// 			"text": "Defects by priority",
// 			"size": 16
// 		  } ],
//   "dataProvider": [ {
//     "title": "Low defects Count",
//     "value": 300
//   }, {
//     "title": "Medium defects Count",
//     "value": 123
//   }, {
//     "title": "High Defects Count",
//     "value": 98
//   }, {
//     "title": "Critical Defects Count",
//     "value": 72
//   }],
//   "balloon": {
//     "fixedPosition": true
//   },
//   "valueField": "value",
//   "titleField": "title",
//   "marginRight": 240,
//   "marginLeft": 50,
//   "startX": -500,
//   "rotate": true,
//   "labelPosition": "right",
//   "balloonText": "[[title]]: [[value]][[description]]",
//   "export": {
//     "enabled": true
//   }
// } );
	
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
						"value": dataPoint.passedCases[j].value
					})
					};
					for (var j = 0; j < dataPoint.Priorities.length; j++){
					testPriorityData.push({
						"title": dataPoint.Priorities[j].title,
						"value": dataPoint.Priorities[j].value
					})
					};
					for (var j = 0; j < dataPoint.Completion.length; j++){
					testCompletionData.push({
						"Status": dataPoint.Completion[j].Status,
						"Value": dataPoint.Completion[j].Value
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


// --------------------------------------------------------------
//  Defect charts
// -------------------------------------------------
	


var chart = AmCharts.makeChart( "defectdiv", {
	  "type": "serial",
	  "theme": "light",
	  "titles": [{
            "text": 'No. of Defects in each Testing Phase',
			"size":16
        } ],
	  "dataProvider": [ {
		"phase": "Unit Testing",
		"defect": 4
	  }, {
		"phase": "PTechnical Integration Testing",
		"defect": 3
	  }, {
		"phase": "Performance Testing",
		"defect": 5
	  }, {
		"phase": "Load Testing",
		"defect": 2
	  }, {
		"phase": "SIT",
		"defect": 3
	  }, {
		"phase": "E2E",
		"defect": 4
	  }, {
		"phase": "Parallel",
		"defect": 5
	  }, {
		"phase": "NRT",
		"defect": 2
	  }, {
		"phase": "UAT",
		"defect": 4
	  }],
		  "valueAxes": [{
		"axisAlpha": 0,
		"position": "left",
		"title": "No. of Defects"
	  }],
	 
	  "gridAboveGraphs": true,
	  "startDuration": 1,
	  "graphs": [ {
		"balloonText": "[[category]]: <b>[[value]]</b>",
		"fillAlphas": 0.8,
		"lineAlpha": 0.2,
		"type": "column",
		"valueField": "defect"
	  } ],
	  "chartCursor": {
		"categoryBalloonEnabled": false,
		"cursorAlpha": 0,
		"zoomable": false
	  },
	  "categoryField": "phase",
	  "categoryAxis": {
	  "gridPosition": "start",
	  "labelRotation": 45
	  },
	  "export": {
		"enabled": true
	  }

	} );
	// var chart = AmCharts.makeChart("appdefect", {
	//   "type": "serial",
	//   "theme": "light",
	//   "marginRight": 70,
	//  "titles": [ {
	// 		"text": "No of Defects identified in each Application clustering  &  Severity of those defects",
	// 		"size": 16
	//   }],
	//   "dataProvider": [{
	// 	"appdefect": "application1",
	// 	"application": 3025,
	// 	"color": "#FF0F00"
	//   }, {
	// 	"appdefect": "application2",
	// 	"application": 1882,
	// 	"color": "#FF6600"
	//   }, {
	// 	"appdefect": "application3",
	// 	"application": 1809,
	// 	"color": "#FF9E01"
	//   }, {
	// 	"appdefect": "application4",
	// 	"application": 1322,
	// 	"color": "#FCD202"
	//   }, {
	// 	"appdefect": "application5",
	// 	"application": 1122,
	// 	"color": "#F8FF01"
	//   }, {
	// 	"appdefect": "application6",
	// 	"application": 1114,
	// 	"color": "#B0DE09"
	//   }, {
	// 	"appdefect": "application7",
	// 	"application": 984,
	// 	"color": "#04D215"
	//   }, {
	// 	"appdefect": "application8",
	// 	"application": 711,
	// 	"color": "#0D8ECF"
	//   }, {
	// 	"appdefect": "application9",
	// 	"application": 665,
	// 	"color": "#0D52D1"
	//   }, {
	// 	"appdefect": "application10",
	// 	"application": 580,
	// 	"color": "#2A0CD0"
	//   }],
	//   "valueAxes": [{
	// 	"axisAlpha": 0,
	// 	"position": "left",
	// 	"title": "No of Defects"
	//   }],
	//   "startDuration": 1,
	//   "graphs": [{
	// 	"balloonText": "<b>[[category]]: [[value]]</b>",
	// 	"fillColorsField": "color",
	// 	"fillAlphas": 0.9,
	// 	"lineAlpha": 0.2,
	// 	"type": "column",
	// 	"valueField": "application"
	//   }],
	//   "chartCursor": {
	// 	"categoryBalloonEnabled": false,
	// 	"cursorAlpha": 0,
	// 	"zoomable": false
	//   },
	//   "categoryField": "appdefect",
	//   "categoryAxis": {
	// 	"gridPosition": "start",
	// 	 "labelRotation": 45
	//   },
	//   "export": {
	// 	"enabled": true
	//   }

	// });
	

	// 	var chart = AmCharts.makeChart("pardefect", {
	// 		"theme": "light",
	// 		"type": "serial",
  //     "titles": [ {
	//  		"text": "No of Failed Test Cases for each Defect",
	// 		"size": 16
	//    }],
	// 	"startDuration": 2,
	// 		"dataProvider": [{
	// 				"Defect Name": "Defect 1",
	// 				"Failed Test Cases": 4025,
	// 				"color": "#FF0F00"
	// 		}, {
	// 				"Defect Name": "Defect 2",
	// 				"Failed Test Cases": 1882,
	// 				"color": "#FF6600"
	// 		}, {
	// 				"Defect Name": "Defect 3",
	// 				"Failed Test Cases": 1809,
	// 				"color": "#FF9E01"
	// 		}, {
	// 				"Defect Name": "Defect 4",
	// 				"Failed Test Cases": 1322,
	// 				"color": "#FCD202"
	// 		}, {
	// 				"Defect Name": "Defect 5",
	// 				"Failed Test Cases": 1122,
	// 				"color": "#F8FF01"
	// 		}],
	// 		"valueAxes": [{
	// 				"position": "left",
	// 				"title": "Failed Test Cases",
	// 				"titleFontSize": 13

	// 		}],
	// 		"graphs": [{
	// 				"balloonText": "[[category]]: <b>[[value]]</b>",
	// 				"fillColorsField": "color",
	// 				"fillAlphas": 1,
	// 				"lineAlpha": 0.1,
	// 				"type": "column",
	// 				"valueField": "Failed Test Cases"
					
	// 		}],
	// 		"depth3D": 20,
	// 	"angle": 30,
	// 		"chartCursor": {
	// 				"categoryBalloonEnabled": false,
	// 				"cursorAlpha": 0,
	// 				"zoomable": false
	// 		},
	// 		"categoryField": "Defect Name",
	// 		"categoryAxis": {
	// 				"gridPosition": "start",
	// 				"labelRotation": 90
	// 		},
	// 		"export": {
	// 			"enabled": true
	// 		}

	// });

  



var chart = AmCharts.makeChart( "appdefect", {
		"type": "serial",
		"addClassNames": true,
		"theme": "light",
		"autoMargins": false,
		"marginLeft": 75,
		"marginRight": 35,
		"marginTop": 60,
		"marginBottom": 70,
		"paddingTop": 50,
		"autoResize": true,
		"titles": [ {
	 		"text": "No of Defects identified in each Application clustering  &  Severity of those defects",
			"size": 16
	   }],
		"balloon": {
			"adjustBorderColor": false,
			"horizontalPadding": 10,
			"verticalPadding": 8,
			"color": "#ffffff"
		},

		"dataProvider": [ {
			"appdefect": "application1",
			"application": 4,
			"severity": 3,
			"color": "#111111"
		}, {
			"appdefect": "application2",
			"application": 3,
			"severity": 2,
			"color": "#2f5f00"
		}, {
			"appdefect": "application3",
			"application": 5,
			"severity": 3,
			"color": "#FF9E01"
		}, {
			"appdefect": "application4",
			"application": 2,
			"severity": 1,
			"color": "#FF0F00"
		}, {
			"appdefect": "application5",
			"application": 3,
			"severity": 2,
			"color": "#FF9E01"
		},{
			"appdefect": "application6",
			"application": 4,
			"severity": 3,
			"color": "#FF0F00"
		},{
			"appdefect": "application7",
			"application": 5,
			"severity": 3,
			"color": "#FF9E01"
		},{
			"appdefect": "application8",
			"application": 2,
			"severity": 1,
			"color": "#FF0F00"
		}, {
			"appdefect": "application9",
			"application": 4,
			"severity": 3,
			"color": "#FF9E01"
		},
		
		// {
		// 	"appdefect": "application10",
		// 	"application": 580,
		// 	"severity": 05,
		// 	"color": "#FF0F00",
		// 	"alpha": 0.2,
		// 	"additional": "(projection)"
		// } 
		],
		"valueAxes": [ {
			"axisAlpha": 40,
			"position": "left",
			"title": "No of Defects"
		} ],
		"startDuration": 1,
		"graphs": [ {
			"alphaField": "alpha",
			"balloonText": "<span style='font-size:12px;'> [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
			"fillAlphas": 1,
			"title": "application",
			"type": "column",
			"valueField": "application",
			"dashLengthField": "dashLengthColumn"
		}, {
			"id": "graph2",
			"balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
			"bullet": "round",
			"lineThickness": 3,
			"bulletSize": 7,
			"bulletBorderAlpha": 1,
			"bulletColor": "#FFFFFF",
			"useLineColorForBulletBorder": true,
			"bulletBorderThickness": 3,
			"fillAlphas": 0,
			"lineAlpha": 1,
			"title": "severity",
			"valueField": "severity",
			"dashLengthField": "dashLengthLine"
		} ],
		"categoryField": "appdefect",
		"categoryAxis": {
			"gridPosition": "start",
			"axisAlpha": 0,
			"tickLength": 0,
			"labelRotation": 45,
			// "minVerticalGap": 35
		},
		"export": {
			"enabled": true
		}
	} );

//code to fetch data from defect by team

var chart = AmCharts.makeChart("defectbyteam", {
    "theme": "light",
    "type": "serial",
		"titles": [{
            "text": 'Defect By Team',
			"size":16
        } ],
    "startDuration": 2,
    "dataProvider": [
      <?php
      $input = array("BG_DETECTED_BY_TEAM" => array('$ne' => "NULL", '$ne' => ""));
      $teamPipeline = array(
        array(
          '$match' => $input
        ),
        array(
          '$group' => array(
            "_id" => '$BG_DETECTED_BY_TEAM',
            "Count" => array(
              '$sum' => 1
            )
          )
        ),
        array(
          '$sort' => array(
            "Count" => -1
          )
        )
      );
      $teams = $defectCol->aggregate($teamPipeline);
      foreach($teams["result"] as $team)
      {
        ?>
        {
          "team": "<?php echo $team["_id"]; ?>",
          "value": <?php echo $team["Count"]; ?>
        },
        <?php
      }
      ?>],
    "valueAxes": [{
        "position": "left",
        "axisAlpha":0,
        "gridAlpha":0
    }],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "colorField": "color",
        "fillAlphas": 0.85,
        "lineAlpha": 0.1,
        "type": "column",
        "topRadius":0.375,
        "valueField": "value"
    }],
    "depth3D":30,
	"angle": 20,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "team",
    "categoryAxis": {
        "gridPosition": "start",
				"labelRotation": 55,
        "fontSize": 12,
				"autoWrap": true,
        "axisAlpha":0,
        "gridAlpha":0

    },
    "export": {
    	"enabled": true
     }

}, 0);   
     
//count to fetch data from rootcause    

<?php
	$dev = array('$text' => array('$search'=> "coding"));
  $development = $defectCol->find($dev)->count();
  $req = array('$text' => array('$search'=> "requirement"));
	$requirement = $defectCol->find($req)->count();
	$test = array('$text' => array('$search'=> "Test"));
  $testing = $defectCol->find($test)->count();
  $environment = array('$text' => array('$search'=> "environment"));
  $env = $defectCol->find($environment)->count();
  $designing = array('$text' => array('$search'=> "design"));
  $design = $defectCol->find($designing)->count();
  $dataqual = array('$text' => array('$search'=> "database issue"));
	$dataq = $defectCol->find($dataqual)->count();
?> 

var chart = AmCharts.makeChart("defectbyrootcause", {
    "theme": "light",
    "type": "serial",
		"titles": [{
            "text": 'Defect By Rootcause',
			"size":16
        } ],
	"startDuration": 2,
    "dataProvider": [{
        "rootcause": "Development",
        "value": <?php echo $development; ?>,
        "color": "#FF0F00"
    }, {
        "rootcause": "Requirements",
        "value": <?php echo $requirement; ?>,
        "color": "#FF6600"
    }, {
        "rootcause": "Testing",
        "value": <?php echo $testing; ?>,
        "color": "#FF9E01"
    }, 
		// {
    //     "rootcause": "",
    //     "value": 354,
    //     "color": "#FF9E01"
    // }, 
    {
        "rootcause": "Environment",
        "value": <?php echo $env; ?>,
        "color": "#FCD202"
    }, {
        "rootcause": "Design",
        "value": <?php echo $design; ?>,
        "color": "#F8FF01"
    },
     {
        "rootcause": "Data Quality",
        "value": <?php echo $dataq; ?>,
        "color": "#B0DE09"
    } 
    //  {
    //     "rootcause": "Fixed",
    //     "value": 2,
    //     "color": "#B0DE09"
    // }, {
    //     "rootcause": "Informed Ryan",
    //     "value": 1,
    //     "color": "#04D215"
    // }, {
    //     "rootcause": "INC0104712",
    //     "value": 1,
    //     "color": "#0D8ECF"
    // }, {
    //     "rootcause": "7",
    //     "value": 1,
    //     "color": "#0D52D1"
    // }, {
    //     "rootcause": "Policy was corrected",
    //     "value": 1,
    //     "color": "#2A0CD0"
    // }, 
   
    // {
    //     "rootcause": "Corrected to Processed",
    //     "value": 1,
    //     "color": "#CD0D74"
    // }
    ],
    "valueAxes": [{
        "position": "left",
        "title": "Value",
				// autoGridCount : false,
				// gridCount : 50,
				// labelFrequency : 10000
    }],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 1,
        "lineAlpha": 0.1,
        "type": "column",
        "valueField": "value"
    }],
    "depth3D": 1,
	"angle": 30,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "rootcause",
    "categoryAxis": {
        "gridPosition": "start",
				"fontSize": 9,
        "labelRotation": 45
    },
    "export": {
    	"enabled": true
     }

});

// <?php 
//   include sessioncon.php;
// ?>

<?php

//to fetch count from open-status
    $open = $defectCol->find(array("BG_STATUS"=>"Open"))->count();
  
    $closed = $defectCol->find(array("BG_STATUS"=>"Closed"))->count();
    
    $fixed = $defectCol->find(array("BG_STATUS"=>"Fixed"))->count();

  ?>

var gaugeChart = AmCharts.makeChart("defectbystatus", {
  "type": "gauge",
  "theme": "light",
	"titles": [{
            "text": 'Defect By Status',
			"size":16,
			"paddingTop":0
        }],
  "axes": [{
    "axisAlpha": 0,
    "tickAlpha": 0,
    "labelsEnabled": false,
    "startValue": 0,
    "endValue": 70000,
    "startAngle": 0,
    "endAngle": 270,
    "bands": [{
      "color": "#cfd9df",
      "startValue": 0,
      "endValue": 70000,
      "radius": "100%",
      "innerRadius": "85%"
    }, {
      "color": "#84b761",
      "startValue": 0,
      "endValue": <?php echo $closed ?>,
      "radius": "100%",
      "innerRadius": "85%",
      "balloonText": <?php echo $closed ?>
    }, {
      "color": "#cfd9df",
      "startValue": 0,
      "endValue": 70000,
      "radius": "80%",
      "innerRadius": "65%"
    }, {
      "color": "#fdd400",
      "startValue": 0,
      "endValue": <?php echo $open ?>,
      "radius": "80%",
      "innerRadius": "65%",
      "balloonText": "<?php echo $open ?>"
    }, {
      "color": "#cfd9df",
      "startValue": 0,
      "endValue": 70000,
      "radius": "60%",
      "innerRadius": "45%"
    }, {
      "color": "#cc4748",
      "startValue": 100,
      "endValue": 500,
      "radius": "60%",
      "innerRadius": "45%",
      "balloonText": <?php echo $fixed ?>

    }]
  }],	
  

  "allLabels": [{
    "text": "Closed Defects",
    "x": "49%",
    "y": "15%",
    "size": 14,
    "bold": true,
    "color": "#84b761",
    "align": "right"
  }, {
    "text": "Active Defects",
    "x": "49%",
    "y": "24%",
    "size": 14,
    "bold": true,
    "color": "#fdd400",
    "align": "right"
  }, {
    "text": "Resolved Defects",
    "x": "49%",
    "y": "32%",
    "size": 14,
    "bold": true,
    "color": "#cc4748",
    "align": "right"
  }],
  "export": {
    "enabled": true
  }
});

<?php
//to fetch data for different phase
    $qa = $defectCol->find(array("BG_DETECTED_IN_PHASE"=>"03-QA","BG_DETECTED_IN_PHASE"=>"03-QA-Functional","BG_DETECTED_IN_PHASE"=>"04-QA-Regression"))->count();

    $prod = $defectCol->find(array("BG_DETECTED_IN_PHASE"=>"10-Prod"))->count();
  
    $uat = $defectCol->find(array("BG_DETECTED_IN_PHASE"=>"05-UAT"))->count();

    $bav = $defectCol->find(array("BG_DETECTED_IN_PHASE"=>"11-BAV"))->count();

?>

var chart = AmCharts.makeChart("defectbystage", {
    "type": "serial",
    "theme": "light",
		"titles": [{
            "text": 'Defect By Stage',
			"size":16,
			"paddingTop":0,
			"marginTop": 0,
        }],
    "legend": {
        "autoMargins": false,
        "borderAlpha": 0.2,
        "equalWidths": false,
        "horizontalGap": 10,
        "markerSize": 8,
        "useGraphSettings": true,
        "valueAlign": "left",
        "valueWidth": 0
    },
    "dataProvider": [{
        "stage": "Stage",
        "QA": <?php echo $qa ?>,
        "PROD": <?php echo $prod ?>,
        "UAT": <?php echo $uat ?>,
        "BAV": <?php echo $bav ?>,
        // "": 1
    }],
    "valueAxes": [{
        "stackType": "100%",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "labelsEnabled": false,
        "position": "left"
    }],
    "graphs": [{
        "balloonText": "[[title]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
        "fillAlphas": 0.9,
        "fontSize": 11,
        "labelText": "[[percents]]%",
        "lineAlpha": 0.5,
        "title": "QA",
        "type": "column",
        "valueField": "QA"
    }, {
        "balloonText": "[[title]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
        "fillAlphas": 0.9,
        "fontSize": 11,
        "labelText": "[[percents]]%",
        "lineAlpha": 0.5,
        "title": "PROD",
        "type": "column",
        "valueField": "PROD"
    }, {
        "balloonText": "[[title]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
        "fillAlphas": 0.9,
        "fontSize": 11,
        "labelText": "[[percents]]%",
        "lineAlpha": 0.5,
        "title": "UAT",
        "type": "column",
        "valueField": "UAT"
    }, {
        "balloonText": "[[title]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
        "fillAlphas": 0.9,
        "fontSize": 11,
        "labelText": "[[percents]]%",
        "lineAlpha": 0.5,
        "title": "BAV",
        "type": "column",
        "valueField": "BAV"
    }, 
		// {
    //     "balloonText": "[[title]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
    //     "fillAlphas": 0.9,
    //     "fontSize": 11,
    //     "labelText": "[[percents]]%",
    //     "lineAlpha": 0.5,
    //     "title": "",
    //     "type": "column",
    //     "valueField": ""
    // }
    ],
    "marginTop": 35,
    "marginRight": 0,
    "marginLeft": 0,
    "marginBottom": 30,
    "autoMargins": false,
    "categoryField": "stage",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0
    },
    "export": {
    	"enabled": true
     }

});

<?php
    
   //to fetch data for active 
    $highactive = $defectCol->find(array("BG_DEFECT_STATE"=>"Active","BG_SEVERITY"=>"S3-High"))->count();
    $lowactive = $defectCol->find(array("BG_DEFECT_STATE"=>"Active","BG_SEVERITY"=>"S5-Low"))->count();
 
    $medactive = $defectCol->find(array("BG_DEFECT_STATE"=>"Active","BG_SEVERITY"=>"S4-Medium"))->count();
    $critactive = $defectCol->find(array("BG_DEFECT_STATE"=>"Active","BG_SEVERITY"=>"S2-Critical"))->count();

    //to fetch data for inactive 
    $highInactive = $defectCol->find(array("BG_DEFECT_STATE"=>"Inactive","BG_SEVERITY"=>"S3-High"))->count();
    
    $lowInactive = $defectCol->find(array("BG_DEFECT_STATE"=>"Inactive","BG_SEVERITY"=>"S5-Low"))->count();
 
    $medInactive = $defectCol->find(array("BG_DEFECT_STATE"=>"Inactive","BG_SEVERITY"=>"S4-Medium"))->count();

    $critInactive = $defectCol->find(array("BG_DEFECT_STATE"=>"Inactive","BG_SEVERITY"=>"S2-Critical"))->count();
 
?>

var chart = AmCharts.makeChart( "defectbyseverity", {
  "type": "serial",
  "theme": "light",
	"titles": [{
            "text": 'Defect Status By Severity',
			"size":16,
			"paddingTop":0
        }],
  "depth3D": 19,
  "angle": 38.48,
  "legend": {
    "horizontalGap": 10,
    "useGraphSettings": true,
    "markerSize": 10
  },
  "dataProvider": [ {
    "status": "Closed",
		"Low": <?php echo $lowInactive ?>,
    "Medium": <?php echo $medInactive ?>,
		"High": <?php echo $highInactive ?>,
		"Critical": <?php echo $critInactive ?>
  }, {
      "status": "Active",
			"Low": <?php echo $lowactive ?>,
			"Medium": <?php echo $medactive ?>,
			"High": <?php echo $highactive ?>,
			"Critical": <?php echo $critactive ?>
  }, 
  // {
  //   	"status": "Resolved",	
	// 		"Low": 12,	
	// 		"Medium": 8,					
	// 		"High": 4,
	// 		"Critical": 3
  // } 
  ],
  "valueAxes": [ {
    "stackType": "regular",
    "axisAlpha": 0,
    "gridAlpha": 0
  } ],
  "graphs": [ {
    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Low",
    "type": "column",
    "color": "#000000",
    "valueField": "Low"
  }, {
    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Medium",
    "type": "column",
    "color": "#000000",
    "valueField": "Medium"
  }, {
    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "High",
    "type": "column",
    "newStack": true,
    "color": "#000000",
    "valueField": "High"
  }, {
    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Critical",
    "type": "column",
    "color": "#000000",
    "valueField": "Critical"
  }],
  "categoryField": "status",
  "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "gridAlpha": 0,
    "position": "left"
  },
  "export": {
    "enabled": true
  }

} );

<?php

//to fetch count from open-status
    $highOpen = $defectCol->find(array("BG_STATUS"=>"Open","BG_SEVERITY"=>"S3-High"))->count();
   
    $lowOpen = $defectCol->find(array("BG_STATUS"=>"Open","BG_SEVERITY"=>"S5-Low"))->count();
   
    $medOpen = $defectCol->find(array("BG_STATUS"=>"Open","BG_SEVERITY"=>"S4-Medium"))->count();
   
    $critOpen = $defectCol->find(array("BG_STATUS"=>"Open","BG_SEVERITY"=>"S2-Critical"))->count();

//to fetch count from closed status
    $highClose = $defectCol->find(array("BG_STATUS"=>"Closed","BG_SEVERITY"=>"S3-High"))->count();

    $lowClose = $defectCol->find(array("BG_STATUS"=>"Closed","BG_SEVERITY"=>"S5-Low"))->count();

    $medClose = $defectCol->find(array("BG_STATUS"=>"Closed","BG_SEVERITY"=>"S4-Medium"))->count();

    $critClose = $defectCol->find(array("BG_STATUS"=>"Closed","BG_SEVERITY"=>"S2-Critical"))->count();
    
    //to fetch count from fixed status
    $highFixed = $defectCol->find(array("BG_STATUS"=>"Fixed","BG_SEVERITY"=>"S3-High"))->count();
 
    $lowFixed = $defectCol->find(array("BG_STATUS"=>"Fixed","BG_SEVERITY"=>"S5-Low"))->count();

    $medFixed = $defectCol->find(array("BG_STATUS"=>"Fixed","BG_SEVERITY"=>"S4-Medium"))->count();

    $critFixed = $defectCol->find(array("BG_STATUS"=>"Fixed","BG_SEVERITY"=>"S2-Critical"))->count();

 ?>    

var chart = AmCharts.makeChart( "defectbypriority", {
  "type": "serial",
  "theme": "light",
	"titles": [{
            "text": 'Defect Status by Priority',
			"size":16,
			"paddingTop":0
        }],
  "depth3D": 20,
  "angle": 30,
  "legend": {
    "horizontalGap": 1,
    "useGraphSettings": true,
    "markerSize": 5
  },
  "dataProvider": [ {
    "status": "Closed",
		"Low": <?php echo $lowClose ?>,
    "Medium": <?php echo $medClose ?>,
		"High": <?php echo $highClose ?>,
		"Critical": <?php echo $critClose ?>
  }, {
      "status": "Active",
			"Low":<?php echo $lowOpen ?>,
			"Medium": <?php echo $medOpen ?>,
				"High": <?php echo $highOpen ?>,
			"Critical": <?php echo $critOpen ?>
  }, {
    	"status": "Resolved",	
			"Low": <?php echo $lowFixed ?>,	
			"Medium": <?php echo $medFixed ?>,					
			"High": <?php echo $highFixed ?>,
			"Critical": <?php echo $critFixed ?>
  } ],
  "valueAxes": [ {
    "stackType": "regular",
    "axisAlpha": 0,
    "gridAlpha": 0
  } ],
  "graphs": [ {
    "balloonText": "<b>[[title]]</b><br><span style='font-size:12px'>[[category]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Low",
    "type": "column",
    "color": "#000000",
    "valueField": "Low"
  }, {
    "balloonText": "<b>[[title]]</b><br><span style='font-size:12px'>[[category]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Medium",
    "type": "column",
    "color": "#000000",
    "valueField": "Medium"
  }, {
    "balloonText": "<b>[[title]]</b><br><span style='font-size:12px'>[[category]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "High",
    "type": "column",
    "newStack": true,
    "color": "#000000",
    "valueField": "High"
  }, {
    "balloonText": "<b>[[title]]</b><br><span style='font-size:12px'>[[category]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Critical",
    "type": "column",
    "color": "#000000",
    "valueField": "Critical"
  }],
  "categoryField": "status",
  "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "gridAlpha": 0,
    "position": "left"
  },
  "export": {
    "enabled": true
  }

} );


var chart = AmCharts.makeChart("defectbytrend", {
    "type": "serial",
    "theme": "light",
		"titles": [{
            "text": 'Defect Trend',
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
    "legend": {
        "equalWidths": false,
        "periodValueText": "total: [[value.sum]]",
        // "position": "top",
				"marginTop": 30,
        "valueAlign": "left",
        "valueWidth": 100
    },
    "dataProvider": [{
        "year": 2014,
        "close": 4,
        "active": 2
    }, {
        "year": 2015,
        "close": 8,
        "active": 3
    }, {
        "year": 2016,
        "close": 9,
        "active": 2
    }, {
        "year": 2017,
        "close": 8,
        "active": 3
    }, {
        "year": 2018,
        "close": 6,
        "active": 1
    }],
    "valueAxes": [{
        "stackType": "regular",
        "gridAlpha": 0.07,
        "position": "left",
        "title": ""
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Close",
        "valueField": "close"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.6,
        "lineAlpha": 0.4,
        "title": "Active",
        "valueField": "active"
    }],
    "plotAreaBorderAlpha": 0,
    "marginTop": 10,
    "marginLeft": 0,
    "marginBottom": 0,
    "chartScrollbar": {},
    "chartCursor": {
        "cursorAlpha": 0
    },
    "categoryField": "year",
    "categoryAxis": {
        "startOnAxis": true,
        "axisColor": "#DADADA",
        "gridAlpha": 0.07,
        "title": "Year"
    },
    "export": {
    	"enabled": true
     }
});

// --------------------------------------
// charts for resource overview
// --------------------------------------------


<?php
	$codata = array('$text' => array('$search'=> "Change Order-01"));
  $co = $resourceCol->find($codata)->count();
  $coredata = array('$text' => array('$search'=> "Core"));
	$core = $resourceCol->find($coredata)->count();
	$flexdata = array('$text' => array('$search'=> "Flex"));
  $flex = $resourceCol->find($flexdata)->count();
?> 

var chart = AmCharts.makeChart("resbysow", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  "titles": [{
        "text": 'Resource By SOW',
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
  "dataProvider": [{
    "SOW": "Change Order-01",
    "value": <?php echo $co; ?>,
    "color": "#FF9E01"
  }, {
    "SOW": "Core",
    "value": <?php echo $core; ?>,
    "color": "#FF6600"
  }, {
    "SOW": "Flex",
    "value": <?php echo $flex; ?>,
    "color": "#FF0F00"
  }],
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left"
    // "title": "Value"
  }],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]]</b>",
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
  "categoryField": "SOW",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45,
    "size":14
  },
  "export": {
    "enabled": true
  }

});


<?php
	$tldata = array('$text' => array('$search'=> "\"Test Lead\""));
  $testlead = $resourceCol->find($tldata)->count();
  $tmdata = array('$text' => array('$search'=> "\"Test Manager\""));
	$testmngr = $resourceCol->find($tmdata)->count();
	$tadata = array('$text' => array('$search'=> "\"Test Analyst\""));
  $testanalyst = $resourceCol->find($tadata)->count();
  $sejdata = array('$text' => array('$search'=> "\"Specialty Engineer Junior\""));
  $sej = $resourceCol->find($sejdata)->count();
  $sesdata = array('$text' => array('$search'=> "\"Specialty Engineer Senior\""));
	$ses = $resourceCol->find($sesdata)->count();
	$jrautodata = array('$text' => array('$search'=> "\"Speciality Engineer Junior\""));
  $jrauto = $resourceCol->find($jrautodata)->count();
  $srautodata = array('$text' => array('$search'=> "\"Speciality Engineer Senior\""));
  $srauto = $resourceCol->find($srautodata)->count();
  $srsecuritydata = array('$text' => array('$search'=> "\"QA (Security) Lead\""));
	$security = $resourceCol->find($srsecuritydata)->count();
	$srperfdata = array('$text' => array('$search'=> "\"QA (Performance) Lead\""));
  $performance = $resourceCol->find($srperfdata)->count();
?> 

var chart = AmCharts.makeChart("resbyrole", {
    "theme": "light",
    "type": "serial",
    "titles": [{
        "text": 'Resource By Role',
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
    "dataProvider": [
      {
        "role": "Speciality Engg Senior-Automation",
        "value": <?php echo $srauto; ?>
    },
    {
        "role": "Speciality Engg Junior-Automation",
        "value": <?php echo $jrauto; ?>
    },
    {
        "role": "Speciality Engg Senior-Performance",
        "value": <?php echo $performance; ?>
    },{
        "role": "Speciality Engg Senior-Security",
        "value": <?php echo $security; ?>
    },
     {
        "role": "Test Manager",
        "value": <?php echo $testmngr; ?>
    },
    {
        "role": "Speciality Engg Senior",
        "value": <?php echo $ses; ?>
    },{
        "role": "Speciality Engg Junior",
        "value": <?php echo $sej; ?>
    },{
        "role": "Test Lead",
        "value": <?php echo $testlead; ?>
    },
    
    {
        "role": "Test Analyst",
        "value": <?php echo $testanalyst; ?>
    } 
    ],
    "valueAxes": [{
        "title": ""
    }],
    "graphs": [{
        "balloonText": "[[category]]:[[value]]",
        "fillAlphas": 1,
        "lineAlpha": 0.2,
        "title": "Value",
        "type": "column",
        "valueField": "value"
    }],
    "depth3D": 9,
    "angle": 30,
    "rotate": true,
    "categoryField": "role",
    "categoryAxis": {
        "gridPosition": "start",
        "fillAlpha": 0.05,
        "position": "left",
         "title": "Role",
        //  "fontSize": 20
    },
    "export": {
    	"enabled": true
     }
});

<?php
    $changeOrderPerTestLeadCount = $resourceCol->find(array("SOW"=>"Change Order-01","Role"=>"Test Lead"))->count();
  
    $changeOrderPerTestAnalystCount = $resourceCol->find(array("SOW" => "Change Order-01", "Role" => "Test Analyst"))->count();
    
    $changeOrderPerSEJCount = $resourceCol->find(array("SOW" => "Change Order-01", "Role" => "Speciality Engineer Junior"))->count();
    
    $changeOrderPerSESCount = $resourceCol->find(array("SOW" => "Change Order-01", "Role" => "Speciality Engineer Senior"))->count();
		
    $flexPerTestLeadCount = $resourceCol->find(array("SOW" => "Flex", "Role" => "Test Lead"))->count();
   
    $flexPerTestAnalystCount = $resourceCol->find(array("SOW" => "Flex", "Role" => "Test Analyst"))->count();
      
    $flexPerSEJCount = $resourceCol->find(array("SOW" => "Flex", "Role" => "Speciality Engineer Junior"))->count();
    
    $flexPerSESCount = $resourceCol->find(array("SOW" => "Flex", "Role" => "Speciality Engineer Senior"))->count();
    
?>



var chart = AmCharts.makeChart( "resalloc", {
  "type": "serial",
  "theme": "light",
  "depth3D": 20,
  "angle": 30,
  "legend": {
    "horizontalGap": 10,
    "useGraphSettings": true,
    "markerSize": 10
  },
  "titles": [{
        "text": 'Resource Allocation by SoW and Role',
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
  "dataProvider": [ 
    {
    "SOW": "Change Order-01",
    "Test Analyst": <?php echo $changeOrderPerTestAnalystCount;  ?>,
    "Test Lead": <?php echo $changeOrderPerTestLeadCount;  ?>,
    "Special Engg Junior-Automation": <?php echo $changeOrderPerSEJCount;  ?>,
    "Special Engg Senior-Automation": <?php echo $changeOrderPerSESCount;  ?>
  }, 
  {
    "SOW": "Flex",
    "Test Analyst": <?php echo $flexPerTestAnalystCount;  ?>,
    "Test Lead": <?php echo $flexPerTestLeadCount;  ?>,
    "Special Engg Junior-Automation": <?php echo $flexPerSEJCount;  ?>,
    "Special Engg Senior-Automation": <?php echo $flexPerSESCount;  ?>
  }],
  "valueAxes": [ {
    "stackType": "regular",
    "axisAlpha": 0,
    "gridAlpha": 0
  } ],
  "graphs": [ {
    "balloonText": "<b>[[category]]</b><br><span style='font-size:14px'>[[title]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Test Analyst",
    "type": "column",
    // "color": "#000000",
    "valueField": "Test Analyst"
  }, {
    "balloonText": "<b>[[category]]</b><br><span style='font-size:14px'>[[title]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Test Lead",
    "type": "column",
    "color": "#000000",
    "valueField": "Test Lead"
  }, {
    "balloonText": "<b>[[category]]</b><br><span style='font-size:14px'>[[title]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Special Engg Junior-Automation",
    "type": "column",
    "newStack": true,
    "color": "#000000",
    "valueField": "Special Engg Junior-Automation"
  }, {
    "balloonText": "<b>[[category]]</b><br><span style='font-size:14px'>[[title]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Special Engg Senior-Automation",
    "type": "column",
    "color": "#000000",
    "valueField": "Special Engg Senior-Automation"
  }],
  "categoryField": "SOW",
  "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "gridAlpha": 0,
    "position": "left"
  },
  "export": {
    "enabled": true
  }
} );


<?php

$locationOnsiteCount = $resourceCol->find(array("Location"=>"Onsite"))->count();
$locationOffshoreCount = $resourceCol->find(array("Location"=>"Offshore"))->count();

?>

var chart = AmCharts.makeChart("resbyloc", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  "titles": [{
        "text": 'Resource By Location',
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
  "dataProvider": [{
    "Location": "Offshore",
    "value": <?php echo $locationOffshoreCount; ?>,
    "color": "#FF6600"
  }, {
    "Location": "Onsite",
    "value": <?php echo $locationOnsiteCount; ?>,
    "color": "#FF0F00"
  }],
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left"
    // "title": "Value"
  }],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]]</b>",
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
  "categoryField": "Location",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45,
    "size":14
  },
  "export": {
    "enabled": true
  }

});

<?php

$ircaBillableCount = $resourceCol->find(array("Portfolio_Project"=>"IRCA","Billable"=>"Billable"))->count();
$ircaNonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"IRCA","Billable"=>"Non-Billable"))->count();
$ircaNullCount = $resourceCol->find(array("Portfolio_Project"=>"IRCA","Billable"=>"Null"))->count();

$workbenchBillableCount = $resourceCol->find(array("Portfolio_Project"=>"UWWB","Billable"=>"Billable"))->count();
$workbenchNonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"UWWB","Billable"=>"Non-Billable"))->count();
$workbenchNullCount = $resourceCol->find(array("Portfolio_Project"=>"UWWB","Billable"=>"Null"))->count();

$GTBBillableCount = $resourceCol->find(array("Portfolio_Project"=>"GTB","Billable"=>"Billable"))->count();
$GTBNonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"GTB","Billable"=>"Non-Billable"))->count();
$GTBNullCount = $resourceCol->find(array("Portfolio_Project"=>"GTB","Billable"=>"Null"))->count();

$RTBBillableCount = $resourceCol->find(array("Portfolio_Project"=>"RTB","Billable"=>"Billable"))->count();
$RTBNonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"RTB","Billable"=>"Non-Billable"))->count();
$RTBNullCount = $resourceCol->find(array("Portfolio_Project"=>"RTB","Billable"=>"Null"))->count();

$conversionBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Conversion","Billable"=>"Billable"))->count();
$conversionNonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Conversion","Billable"=>"Non-Billable"))->count();
$conversionNullCount = $resourceCol->find(array("Portfolio_Project"=>"Conversion","Billable"=>"Null"))->count();

$transformationBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Transformation","Billable"=>"Billable"))->count();
$transformationNonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Transformation","Billable"=>"Non-Billable"))->count();
$transformationNullCount = $resourceCol->find(array("Portfolio_Project"=>"Transformation","Billable"=>"Null"))->count();

$BIBillableCount = $resourceCol->find(array("Portfolio_Project"=>"BI-Genesis-II","Billable"=>"Billable"))->count();
$BINonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"BI-Genesis-II","Billable"=>"Non-Billable"))->count();
$BINullCount = $resourceCol->find(array("Portfolio_Project"=>"BI-Genesis-II","Billable"=>"Null"))->count();

$plinesBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Personal Lines","Billable"=>"Billable"))->count();
$plinesNonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Personal Lines","Billable"=>"Non-Billable"))->count();
$plinesNullCount = $resourceCol->find(array("Portfolio_Project"=>"Personal Lines","Billable"=>"Null"))->count();

$biAnalyticsBillableCount = $resourceCol->find(array("Portfolio_Project"=>"BI and Analytics","Billable"=>"Billable"))->count();
$biAnalyticsNonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"BI and Analytics","Billable"=>"Non-Billable"))->count();
$biAnalyticsNullCount = $resourceCol->find(array("Portfolio_Project"=>"BI and Analytics","Billable"=>"Null"))->count();


$midMarketBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Mid Market","Billable"=>"Billable"))->count();
$midMarketNonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Mid Market","Billable"=>"Non-Billable"))->count();
$midMarketNullCount = $resourceCol->find(array("Portfolio_Project"=>"Mid Market","Billable"=>"Null"))->count();

$managementBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Management","Billable"=>"Billable"))->count();
$managementNonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Management","Billable"=>"Non-Billable"))->count();
$managementNullCount = $resourceCol->find(array("Portfolio_Project"=>"Management","Billable"=>"Null"))->count();

$commercialLinesBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Commercial Lines","Billable"=>"Billable"))->count();
$commercialLinesNonBillableCount = $resourceCol->find(array("Portfolio_Project"=>"Commercial Lines","Billable"=>"Non-Billable"))->count();
$commercialLinesNullCount = $resourceCol->find(array("Portfolio_Project"=>"Commercial Lines","Billable"=>"Null"))->count();


?>


var chart = AmCharts.makeChart( "projbybill", {
  "type": "serial",
  "theme": "light",
  "depth3D": 20,
  "angle": 30,
  "legend": {
    "horizontalGap": 10,
    "useGraphSettings": true,
    "markerSize": 10
  },
  "titles": [{
        "text": 'Project By Billable',
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
  "dataProvider": [ {
    "project": "IRCA",
    "Billable":  <?php echo $ircaBillableCount; ?>,
    "Non-Billable": <?php echo $ircaNonBillableCount; ?>
  }, 
  
  {
   "project": "Workbench",
    "Billable": <?php echo $workbenchBillableCount; ?>,
    "Non-Billable": <?php echo $workbenchNonBillableCount; ?>
  },

  {
    "project": "GTB",
    "Billable": <?php echo $GTBBillableCount; ?>,
    "Non-Billable": <?php echo$GTBNonBillableCount; ?>
  }, 
  
  {
   "project": "RTB",
    "Billable": <?php echo $RTBBillableCount; ?>,
    "Non-Billable": <?php echo $RTBNonBillableCount; ?>
  },

  {
    "project": "Conversion",
    "Billable": <?php echo $conversionBillableCount; ?>,
    "Non-Billable": <?php echo $conversionNonBillableCount; ?>
  }, 
  
  {
   "project": "Transformation",
    "Billable": <?php echo $transformationBillableCount; ?>,
    "Non-Billable": <?php echo $transformationNonBillableCount; ?>
  },

  {
    "project": "BI-Genesis-II",
    "Billable": <?php echo $BIBillableCount; ?>,
    "Non-Billable": <?php echo $BINonBillableCount; ?>
  }, 
  
  // {
  //  "project": "Claims Delivery",
  //   ?>,
  //   "Billable": <?php echo $conversionBillableCount; ?>,
  //   "Non-Billable": <?php echo $conversionBillableCount; ?>
  // },

  {
    "project": "Personal Lines Delivery",
    "Billable": <?php echo $plinesBillableCount; ?>,
    "Non-Billable": <?php echo $plinesNonBillableCount; ?>
  }, 
  
  {
   "project": "BI and Analytics",
    "Billable": <?php echo $biAnalyticsBillableCount; ?>,
    "Non-Billable": <?php echo $biAnalyticsNonBillableCount; ?>
  },

  {
    "project": "Mid Market",
    "Billable": <?php echo $midMarketBillableCount; ?>,
    "Non-Billable": <?php echo $midMarketNonBillableCount; ?>
  }, 
  
  // {
  //  "project": "Business Systems Winnipeg",
  // 
  //   "Billable": <?php echo $conversionBillableCount; ?>,
  //   "Non-Billable": <?php echo $conversionBillableCount; ?>
  // },
  
   {
   "project": "Management",
    "Billable": <?php echo $managementBillableCount; ?>,
    "Non-Billable": <?php echo $managementNonBillableCount; ?>
  },
  {
    "project": "Genesis",
    "Billable": <?php echo $conversionBillableCount; ?>,
    "Non-Billable": <?php echo $conversionBillableCount; ?>
  }, 
  {
   "project": "CL",
    "Billable": <?php echo $commercialLinesBillableCount; ?>,
    "Non-Billable": <?php echo $commercialLinesNonBillableCount; ?>
  }],
  "valueAxes": [ {
    "stackType": "regular",
    "axisAlpha": 0,
    "gridAlpha": 0
  } ],
  "graphs": [  
    
  //   {
  //   "balloonText": "<b>[[category]]</b><br><span style='font-size:14px'>[[title]]: <b>[[value]]</b></span>",
  //   "fillAlphas": 0.8,
  //   // "labelText": "[[value]]",
  //   "lineAlpha": 0.3,
  //   "title": "null",
  //   "type": "column",
  //   "color": "#000000",
  //   "valueField": "null"
  // },
  
  {
    "balloonText": "<b>[[category]]</b><br><span style='font-size:14px'>[[title]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Billable",
    "type": "column",
    "newStack": true,
    "color": "#000000",
    "valueField": "Billable"
  }, {
    "balloonText": "<b>[[category]]</b><br><span style='font-size:14px'>[[title]]: <b>[[value]]</b></span>",
    "fillAlphas": 0.8,
    // "labelText": "[[value]]",
    "lineAlpha": 0.3,
    "title": "Non-Billable",
    "type": "column",
    "newStack": true,
    "color": "#000000",
    "valueField": "Non-Billable"
  }],
  "categoryField": "project",
  "categoryAxis": {
    "gridPosition": "start",
    "axisAlpha": 0,
    "gridAlpha": 0,
     "labelRotation": 45,
    "position": "left"
  },
  "export": {
    "enabled": true
  }
} );




// --------------------------------------------------------------------------
// PORTFOLIO VIEW
// ---------------------------------------------------------------------


var gaugeChart = AmCharts.makeChart( "OTD", {
  "type": "gauge",
  "theme": "light",
  "titles": [{
        "text": "On-time Delivery (OTD %)",
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
  "axes": [ {
    "axisThickness": 1,
    "axisAlpha": 0.2,
    "tickAlpha": 0.2,
    "valueInterval": 20,
    "bands": [ {
      "color": "#cc4748",
      "endValue": 90,
      "startValue": 0
    }, {
      "color": "#fdd400",
      "endValue": 95,
      "startValue": 90
    }, {
      "color": "#84b761",
      "endValue": 100,
      "innerRadius": "95%",
      "startValue": 95
    } ],
    "bottomText": "98.06 %",
    "bottomTextYOffset": -20,
    "endValue": 100
  } ],
  "arrows": [ {
    "value": 98.06
  } ],
  "export": {
    "enabled": true
  }
} );

// setInterval( randomValue, 2000 );

// // set random value
// function randomValue() {
//   var value = Math.round( Math.random() * 200 );
//   if ( gaugeChart ) {
//     if ( gaugeChart.arrows ) {
//       if ( gaugeChart.arrows[ 0 ] ) {
//         if ( gaugeChart.arrows[ 0 ].setValue ) {
//           gaugeChart.arrows[ 0 ].setValue( value );
//           gaugeChart.axes[ 0 ].setBottomText( value + " km/h" );
//         }
//       }
//     }
//   }
// }


<?php

//to fetch count from open-status
   
    $closedCount = $defectCol->find(array("BG_STATUS"=>"Closed"))->count();

    $fixedCount = $defectCol->find(array("BG_STATUS"=>"Fixed"))->count();

    $newCount = $defectCol->find(array("BG_STATUS"=>"New"))->count();

    $openCount = $defectCol->find(array("BG_STATUS"=>"Open"))->count();

    $readyForTestCount = $defectCol->find(array("BG_STATUS"=>"Ready For Test"))->count();
   
    $readyToDeployCount = $defectCol->find(array("BG_STATUS"=>"Ready To Deploy"))->count();
    
    $reopenCount = $defectCol->find(array("BG_STATUS"=>"Reopen"))->count();

    $reviewCount = $defectCol->find(array("BG_STATUS"=>"Review"))->count();
   
    $fixedCount = $defectCol->find(array("BG_STATUS"=>"Fixed"))->count();

    $deferredCount = $defectCol->find(array("BG_STATUS"=>"Deferred"))->count();

    $notADefectCount = $defectCol->find(array("BG_STATUS"=>"Not A Defect"))->count();
   
    $nullCount = $defectCol->find(array("BG_STATUS"=>"Null"))->count();

    $total_valid_defects = $closedCount + $fixedCount + $newCount + $openCount + $readyForTestCount + $readyToDeployCount + $reopenCount + $reviewCount +  $fixedCount;
    $total_defects = $closedCount + $fixedCount + $newCount + $openCount + $readyForTestCount + $readyToDeployCount + $reopenCount + $reviewCount +  $fixedCount + 
                      + $deferredCount + $notADefectCount + $nullCount;

    $total_dar = ($total_valid_defects * 100) / $total_defects;
  ?> 


var gaugeChart = AmCharts.makeChart( "DAR", {
  "type": "gauge",
  "theme": "light",
  "titles": [{
        "text": "Defect Acceptance Rate (DAR %)",
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
  "axes": [ {
    "axisThickness": 1,
    "axisAlpha": 0.2,
    "tickAlpha": 0.2,
    "valueInterval": 20,
    "bands": [ {
      "color": "#cc4748",
      "endValue": 85,
      "startValue": 0
    }, {
      "color": "#fdd400",
      "endValue": 90,
      "startValue": 85
    }, {
      "color": "#84b761",
      "endValue": 100,
      "innerRadius": "95%",
      "startValue": 90
    } ],
    "bottomText": "<?php echo round($total_dar,2); ?> %",
    "bottomTextYOffset": -20,
    "endValue": 100
  } ],
  "arrows": [ {
    "value": <?php echo $total_dar; ?>
  } ],
  "export": {
    "enabled": true
  }
} );

// setInterval(randomValue, 2000);

// // set random value
// function randomValue() {
//   var value = Math.round(Math.random() * 100);
//   chart.arrows[0].setValue(value);
//   chart.axes[0].setTopText(value + " %");
//   // adjust darker band to new value
//   chart.axes[0].bands[1].setEndValue(value);
// }  

<?php

$total_dre = ($fixedCount * 100) / $total_valid_defects; 
//  echo  "total fixed count";
//  echo  $fixedCount; 
 
//  echo  "total valid count"; 
//  echo  $total_valid_defects; 

?>

var gaugeChart = AmCharts.makeChart( "DRE", {
  "type": "gauge",
  "theme": "light",
  "titles": [{
        "text": "Defect Removal Efficiency (DRE %)",
			"size":16,
			"position": "top",
			"paddingTop":0
        }],
  "axes": [ {
    "axisThickness": 1,
    "axisAlpha": 0.2,
    "tickAlpha": 0.2,
    "valueInterval": 20,
    "bands": [ {
      "color": "#cc4748",
      "endValue": 85,
      "startValue": 0
    }, {
      "color": "#fdd400",
      "endValue": 90,
      "startValue": 85
    }, {
      "color": "#84b761",
      "endValue": 100,
      "innerRadius": "95%",
      "startValue": 90
    } ],
    "bottomText": "<?php echo round($total_dre,2); ?>%",
    "bottomTextYOffset": -20,
    "endValue": 100
  } ],
  "arrows": [ {
    "value": <?php echo $total_dre; ?>
  } ],
  "export": {
    "enabled": true
  }
} );

// setInterval(randomValue, 2000);

// // set random value
// function randomValue() {
//   var value = Math.round(Math.random() * 100);
//   chart.arrows[0].setValue(value);
//   chart.axes[0].setTopText(value + " %");
//   // adjust darker band to new value
//   chart.axes[0].bands[1].setEndValue(value);
// }  



var chart = AmCharts.makeChart( "OTDtrend", {
  "type": "serial",
  "theme": "light",
  "marginRight": 40,
  "marginLeft": 40,
  // "autoMarginOffset": 20,
  "dataDateFormat": "MM",
  "titles": [{
        "text": "OTD Trend",
			"size":18,
			"position": "top",
			"paddingTop":0
        }],
  "valueAxes": [ {
    // "id": "v1",
    "axisAlpha": 0,
    "position": "left",
    // "ignoreAxisWidth": true
  } ],
  "balloon": {
    "borderThickness": 1,
    "shadowAlpha": 0
  },
  "graphs": [ {
    "id": "g1",
    "balloon": {
      "drop": true,
      "adjustBorderColor": false,
      "color": "#ffffff",
      "type": "smoothedLine"
    },
    "fillAlphas": 0.2,
    "bullet": "round",
    "bulletBorderAlpha": 1,
    // "bulletColor": "#FFFFFF",
    "bulletSize": 5,
    "hideBulletsCount": 50,
    "lineThickness": 2,
    "title": "red line",
    "useLineColorForBulletBorder": true,
    "valueField": "value",
    "balloonText": "<span style='font-size:12px;'>Monthly Status:<br>[[month]][[year]]<br> On Time Delivery:<br>[[value]]</span>"
  } ],
  "chartCursor": {
    // "valueLineEnabled": true,
    // "valueLineBalloonEnabled": true,
    "cursorAlpha": 0,
    "zoomable": false,
    "valueZoomable": true,
    "valueLineAlpha": 0.5
  },
  "valueScrollbar": {
    "autoGridCount": true,
    "color": "#000000",
    "scrollbarHeight": 50
  },
  "categoryField": "month",
  "categoryAxis": {
    // "parseDates": true,
    "dashLength": 1,
    "minPeriod":"MM",
    "minorGridEnabled": true
  },
  "export": {
    "enabled": true
  },
  "dataProvider": [ {
    "month": "August",
    "year": "2017",
    "value": 100
  }, {
    "month": "September",
    "year": "2017",
    "value": 91.304
  }, {
    "month": "October",
    "year": "2017",
    "value": 100
  }, {
    "month": "November",
    "year": "2017",
    "value": 100
  }, {
    "month": "December",
    "year": "2017",
    "value": 100
  }, {
    "month": "January",
    "year": "2018",
    "value": 100
  }, {
    "month": "February",
    "year": "2018",
    "value": 100
  }]
} );



var chart = AmCharts.makeChart( "DARtrend", {
  "type": "serial",
  "theme": "light",
  "marginRight": 40,
  "marginLeft": 40,
  // "autoMarginOffset": 20,
  "dataDateFormat": "MM",
  "titles": [{
        "text": "DAR Trend",
			"size":18,
			"position": "top",
			"paddingTop":0
        }],
  "valueAxes": [ {
    // "id": "v1",
    "axisAlpha": 0,
    "position": "left",
    // "ignoreAxisWidth": true
  } ],
  "balloon": {
    "borderThickness": 1,
    "shadowAlpha": 0
  },
  "graphs": [ {
    "id": "g1",
    "balloon": {
      "drop": true,
      "adjustBorderColor": false,
      "color": "#ffffff",
      "type": "smoothedLine"
    },
    "fillAlphas": 0.2,
    "bullet": "round",
    "bulletBorderAlpha": 1,
    // "bulletColor": "#FFFFFF",
    "bulletSize": 5,
    "hideBulletsCount": 50,
    "lineThickness": 2,
    "title": "red line",
    "useLineColorForBulletBorder": true,
    "valueField": "value",
    "balloonText": "<span style='font-size:12px;'>Monthly Status:<br>[[month]][[year]]<br> DAR:<br>[[value]]</span>"
  } ],
  "chartCursor": {
    // "valueLineEnabled": true,
    // "valueLineBalloonEnabled": true,
    "cursorAlpha": 0,
    "zoomable": false,
    "valueZoomable": true,
    "valueLineAlpha": 0.5
  },
  "valueScrollbar": {
    "autoGridCount": true,
    "color": "#000000",
    "scrollbarHeight": 50
  },
  "categoryField": "month",
  "categoryAxis": {
    // "parseDates": true,
    "dashLength": 1,
    "minPeriod":"MM",
    "minorGridEnabled": true
  },
  "export": {
    "enabled": true
  },
  "dataProvider": [  {
    // "mon": "Jan"
    "month": "October",
    "year": "2014",
    "value": 100
  }, {
    "month": "November",
    "year": "2014",
    "value": 100
  }, {
    "month": "December",
    "year": "2014",
    "value": 100
  }, {
    "month": "January",
    "year": "2015",
    "value": 100
  }, {
    "month": "February",
    "year": "2015",
    "value": 100
  }, {
    "month": "March",
    "year": "2015",
    "value": 100
  }, {
    "month": "April",
    "year": "2015",
    "value": 100
  },{
    "month": "May",
    "year": "2015",
    "value": 100
  }, {
    "month": "June",
    "year": "2015",
    "value": 92.86
  },{
    "month": "July",
    "year": "2015",
    "value": 100
  }, {
    "month": "August",
    "year": "2015",
    "value": 100
  }, {
    "month": "September",
    "year": "2015",
    "value": 100
  }, {
    "month": "October",
    "year": "2015",
    "value": 97.835
  },{
    "month": "November",
    "year": "2015",
    "value": 97.335
  }, {
    "month": "December",
    "year": "2015",
    "value": 97.685
  },{
    "month": "January",
    "year": "2016",
    "value": 90.538
  }, {
    "month": "February",
    "year": "2016",
    "value": 99.827
  }, {
    "month": "March",
    "year": "2016",
    "value": 98.731
  }, {
    "month": "April",
    "year": "2016",
    "value": 99.095
  },{
    "month": "May",
    "year": "2016",
    "value": 99.206
  }, {
    "month": "June",
    "year": "2016",
    "value": 99.746
  },{
    "month": "July",
    "year": "2016",
    "value": 100
  }, {
    "month": "August",
    "year": "2016",
    "value": 100
  }, {
    "month": "September",
    "year": "2016",
    "value": 99.286
  }, {
    "month": "October",
    "year": "2016",
    "value": 100
  },{
    "month": "November",
    "year": "2016",
    "value": 96.591
  }, {
    "month": "December",
    "year": "2016",
    "value": 97.66
  },{
    "month": "January",
    "year": "2017",
    "value": 97.933
  }, {
    "month": "February",
    "year": "2017",
    "value": 95.685
  }, {
    "month": "March",
    "year": "2017",
    "value": 100
  }, {
    "month": "April",
    "year": "2017",
    "value": 99.951
  },{
    "month": "May",
    "year": "2017",
    "value": 97.354
  }, {
    "month": "June",
    "year": "2017",
    "value": 96.711
  },{
    "month": "July",
    "year": "2017",
    "value": 99.741
  }, {
    "month": "August",
    "year": "2017",
    "value": 100
  }, {
    "month": "September",
    "year": "2017",
    "value": 98.611
  }, {
    "month": "October",
    "year": "2017",
    "value": 99.562
  },{
    "month": "November",
    "year": "2017",
    "value": 98.677
  }, {
    "month": "December",
    "year": "2017",
    "value": 99.098
  },{
    "month": "January",
    "year": "2018",
    "value": 99.78
  }, {
    "month": "February",
    "year": "2018",
    "value": 98.74
  }, {
    "month": "March",
    "year": "2018",
    "value": 100
  }]
} ); 


var chart = AmCharts.makeChart( "DREtrend", {
  "type": "serial",
  "theme": "light",
  "marginRight": 40,
  "marginLeft": 40,
  // "autoMarginOffset": 20,
  "dataDateFormat": "MM",
  "titles": [{
        "text": "DRE Trend",
			"size":18,
			"position": "top",
			"paddingTop":0
        }],
  "valueAxes": [ {
    // "id": "v1",
    "axisAlpha": 0,
    "position": "left",
     "minAxis": 0,
    // "ignoreAxisWidth": true
  } ],
  "balloon": {
    "borderThickness": 1,
    "shadowAlpha": 0
  },
  "graphs": [ {
    "id": "g1",
    "balloon": {
      "drop": true,
      "adjustBorderColor": false,
      "color": "#ffffff",
      "type": "smoothedLine"
    },
    "fillAlphas": 0.2,
    "bullet": "round",
    "bulletBorderAlpha": 1,
    // "bulletColor": "#FFFFFF",
    "bulletSize": 5,
    "hideBulletsCount": 50,
    "lineThickness": 2,
    "title": "red line",
    "useLineColorForBulletBorder": true,
    "valueField": "value",
    "balloonText": "<span style='font-size:12px;'>Monthly Status:<br>[[month]][[year]]<br> DRE:<br>[[value]]</span>"
  } ],
  "chartCursor": {
    // "valueLineEnabled": true,
    // "valueLineBalloonEnabled": true,
    "cursorAlpha": 0,
    "zoomable": false,
    "valueZoomable": true,
    "valueLineAlpha": 0.5
  },
  "valueScrollbar": {
    // "autoGridCount": false,
    "color": "#000000",
    "scrollbarHeight": 50
  },
  "categoryField": "month",
  "categoryAxis": {
    // "parseDates": true,
    "dashLength": 1,
    "minPeriod":"MM",
    "labelOffset":0,
    "minorGridEnabled": true
  },
  "export": {
    "enabled": true
  },
  "dataProvider": [  {
    // "mon": "Jan"
    "month": "October",
    "year": "2014",
    "value": 100
  }, {
    "month": "November",
    "year": "2014",
    "value": 100
  }, {
    "month": "December",
    "year": "2014",
    "value": 100
  }, {
    "month": "January",
    "year": "2015",
    "value": 100
  }, {
    "month": "February",
    "year": "2015",
    "value": 91.828
  }, {
    "month": "March",
    "year": "2015",
    "value": 92.855
  }, {
    "month": "April",
    "year": "2015",
    "value": 100
  },{
    "month": "May",
    "year": "2015",
    "value": 91.67
  }, {
    "month": "June",
    "year": "2015",
    "value": 100
  },{
    "month": "July",
    "year": "2015",
    "value": 96.875
  }, {
    "month": "August",
    "year": "2015",
    "value": 80
  }, {
    "month": "September",
    "year": "2015",
    "value": 91.67
  }, {
    "month": "October",
    "year": "2015",
    "value": 75
  },{
    "month": "November",
    "year": "2015",
    "value": 100
  }, {
    "month": "December",
    "year": "2015",
    "value": 95
  },{
    "month": "January",
    "year": "2016",
    "value": 94.84
  }, {
    "month": "February",
    "year": "2016",
    "value": 89.035
  }, {
    "month": "March",
    "year": "2016",
    "value": 99.431
  }, {
    "month": "April",
    "year": "2016",
    "value": 99.507
  },{
    "month": "May",
    "year": "2016",
    "value": 100
  }, {
    "month": "June",
    "year": "2016",
    "value": 99.746
  },{
    "month": "July",
    "year": "2016",
    "value": 100
  }, {
    "month": "August",
    "year": "2016",
    "value": 100
  }, {
    "month": "September",
    "year": "2016",
    "value": 99.286
  }, {
    "month": "October",
    "year": "2016",
    "value": 100
  },{
    "month": "November",
    "year": "2016",
    "value": 96.591
  }, {
    "month": "December",
    "year": "2016",
    "value": 97.66
  },{
    "month": "January",
    "year": "2017",
    "value": 97.933
  }, {
    "month": "February",
    "year": "2017",
    "value": 95.685
  }, {
    "month": "March",
    "year": "2017",
    "value": 100
  }, {
    "month": "April",
    "year": "2017",
    "value": 95.506
  },{
    "month": "May",
    "year": "2017",
    "value": 88.194
  }, {
    "month": "June",
    "year": "2017",
    "value": 90.634
  },{
    "month": "July",
    "year": "2017",
    "value": 91.324
  }, {
    "month": "August",
    "year": "2017",
    "value": 86.852
  }, {
    "month": "September",
    "year": "2017",
    "value": 86.024
  }, {
    "month": "October",
    "year": "2017",
    "value": 92.015
  },{
    "month": "November",
    "year": "2017",
    "value": 87.772
  }, {
    "month": "December",
    "year": "2017",
    "value": 79.51
  },{
    "month": "January",
    "year": "2018",
    "value": 93.16
  }, {
    "month": "February",
    "year": "2018",
    "value": 95.9
  }, {
    "month": "March",
    "year": "2018",
    "value": 94.023
  }]
} );
</script>