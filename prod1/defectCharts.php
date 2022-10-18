<script>

// --------------------------------------------------------------
//  Defect charts
// -------------------------------------------------

var chart = AmCharts.makeChart( "defectdiv", {
	  "type": "serial",
	  "theme": "light",
    "fontFamily": "Arial",
	  "titles": [{
            "text": 'No. of Defects by Testing Phase',
			"size":16,
      "fontFamily": "Arial"
        } ],
	  "dataProvider": [ 
     {
		"phase": "Technical Integration Testing",
		"defect": 1368,
    "color" : "#A3E4D7"
	  }, {
		"phase": "Performance Testing",
		"defect": 1105,
    "color" : "#2ECC71"
	  }, {
		"phase": "Load Testing",
		"defect": 1115,
    "color" : "#8E44AD"
	  }, {
		"phase": "SIT",
		"defect": 1582,
    "color" : "#5499C7"
	  }, {
		"phase": "E2E",
		"defect": 1511,
    "color" : "#797D7F"
	  }, {
		"phase": "Parallel",
		"defect": 226,
    "color" : "#186A2B"
	  }, {
		"phase": "NRT",
		"defect": 198,
    "color" : "#F0B27A"
	  }, {
		"phase": "UAT",
		"defect": 4782,
    "color" : "#F1948A"
	  }],
		  "valueAxes": [{
		"axisAlpha": 0,
		"position": "left",
		"title": "No. of Defects"
	  }],
	 
	  "gridAboveGraphs": false,
	  "startDuration": 1,
	  "graphs": [ {
		"balloonText": "[[category]]: <b>[[value]]</b>",
		"fillAlphas": 0.8,
    "colorField": "color",
		"lineAlpha": 0.2,
		"type": "column",
		"valueField": "defect"
	  } ],
     "depth3D": 20,
	    "angle": 15,
	  "chartCursor": {
		"categoryBalloonEnabled": false,
		"cursorAlpha": 0,
		"zoomable": false
	  },
	  "categoryField": "phase",
	  "categoryAxis": {
	  "gridPosition": "start",
	  "labelRotation": 60
	  },
	  "export": {
    "enabled": true,
    "fileName": "top level filename",
    "menuReviver": function(item, li) {
      if (item.format === "CSV") {
        item.fileName = "No. of Defects In Each Testing Phase";
      }
      return li;
    },
     exportFields: ["phase", "defect"],
    columnNames: {
      phase: "Test Phase",
      defect: "No. of Defects"     
    }
  }

	} );

var chart = AmCharts.makeChart( "appdefect", {
		"type": "serial",
		"addClassNames": true,
    "fontFamily": "Arial",
		"theme": "light",
		"autoMargins": false,
		"marginLeft": 75,
		"marginRight": 35,
		"marginTop": 60,
		"marginBottom": 70,
		"paddingTop": 50,
		"autoResize": true,
		"titles": [ {
	 		// "text": "No. of Defects Identified In Each Application Clustering  &  Severity of Those Defects",
       "text": "No. of Defects Identified by Application Clustering  &  Severity of Those Defects",
			"size": 16,
      "fontFamily": "Arial"
	   }],
		"balloon": {
			"adjustBorderColor": false,
			"horizontalPadding": 10,
			"verticalPadding": 8,
			// "color": "#ffffff",
      "fillColor": "#FFFFFF"
		},
    "legend": {
    "horizontalGap": 1,
    "useGraphSettings": true,
    "fontFamily": "Arial",
    "markerSize": 5,
    "borderAlpha": 0.2,
    "align": "center",
    // "markerType": "circle",
  },

		"dataProvider": [ {
			"appdefect": "Application1",
			"Application": 4,
			"severity": 3,
			"color": "#FF7F50"
		}, {
			"appdefect": "Application2",
			"Application": 3,
			"severity": 2,
			"color": "#8B4513"
		}, {
			"appdefect": "Application3",
			"Application": 5,
			"severity": 3,
			"color": "#FFB6C1"
		}, {
			"appdefect": "Application4",
			"Application": 2,
			"severity": 1,
			"color": "#008080"
		}, {
			"appdefect": "Application5",
			"Application": 3,
			"severity": 2,
			"color": "#ADD8E6"
		},{
			"appdefect": "Application6",
			"Application": 4,
			"severity": 3,
			"color": "#008000"
		},{
			"appdefect": "Application7",
			"Application": 5,
			"severity": 3,
			"color": "#707B7C"
		},{
			"appdefect": "Application8",
			"Application": 2,
			"severity": 1,
			"color": "#2ECC71"
		}],
		"valueAxes": [ {
			"axisAlpha": 40,
			"position": "left",
			"title": "No. of Defects"
		} ],
		"startDuration": 1,
		"graphs": [ {
			"alphaField": "alpha",
			"balloonText": "<span style='font-size:14px;color:black'> [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
			"fillAlphas": 1,
      "lineAlpha": 0.1,
			"title": "Application",
			"type": "column",
			"valueField": "Application",
      "colorField": "color",
			"dashLengthField": "dashLengthColumn"
		}, {
			"id": "graph2",
			"balloonText": "<span style='font-size:14px;color:black'>[[title]] In [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
			"bullet": "round",
			"lineThickness": 3,
			"bulletSize": 7,
			"bulletBorderAlpha": 1,
			"bulletColor": "#FF0000",
			// "useLineColorForBulletBorder": true,
			"bulletBorderThickness": 0,
			"fillAlphas": 0,
			"lineAlpha": 1,
			"title": "Severity",
			"valueField": "severity",
			"dashLengthField": "dashLengthLine"
		} ],
     "depth3D": 20,
	"angle": 20,
		"categoryField": "appdefect",
		"categoryAxis": {
			"gridPosition": "start",
			"axisAlpha": 0,
			"tickLength": 0,
			"labelRotation": 60,
			// "minVerticalGap": 35
		},
		 "export": {
    "enabled": true,
    "fileName": "top level filename",
    "menuReviver": function(item, li) {
      if (item.format === "CSV") {
        item.fileName = "Defects by Severity";
      }
      return li;
    },
     exportFields: ["appdefect", "Application", "severity"],
    columnNames: {
      appdefect: "Application",
      Application: "No. of Defects Identified by Application & Severity of Those Defects",
      severity: "Severity Level"
    }
  }
	} );

//code to fetch data from defect by team

var chart = AmCharts.makeChart("defectbyteam", {
    "theme": "light",
    "type": "serial",
    "fontFamily": "Arial",
		"titles": [{
            "text": 'Defects by Team',
            "fontFamily": "Arial",
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
      $colors = array("#FF7E83","#00C37B","#4701A7","#707B7C","#01D1D0","#F0B27A","#0F999C","#15636B","#80B8D6","#88D5ED","#9C640C","#707B7C","#15636B","#80B8D6","#88D5ED","#860864","#9C640C","#15636B","#80B8D6","#9C640C","#860864","#0F999C","#9C640C","#80B8D6","#88D5ED");
      //foreach($colors as $color){
        $i = 0;
        foreach($teams["result"] as $team)
        {
            echo '{"team":"' . $team["_id"] . '",'; 
            echo '"value":' . $team["Count"] . ',';
            echo '"color":"' . $colors[$i] . '"},';  
            $i++;
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
        "fillAlphas": 1,
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
				"labelRotation": 58,
        "fontSize": 10,
				"autoWrap": true,
        "axisAlpha":0,
        "gridAlpha":0

    },
    "export": {
    "enabled": true,
    "fileName": "top level filename",
    "menuReviver": function(item, li) {
      if (item.format === "CSV") {
        item.fileName = "Defects by Severity";
      }
      return li;
    },
     exportFields: ["team", "value"],
    columnNames: {
      team: "Team Name",
      value: "Severity"
    }
  }

}, 0);   
     
//count to fetch data from rootcause    

<?php
  $development = $defectCol->find(array('$text' => array('$search'=> "coding")))->count();
	$requirement = $defectCol->find(array('$text' => array('$search'=> "requirement")))->count();
  $testing = $defectCol->find(array('$text' => array('$search'=> "Test")))->count();
  $env = $defectCol->find(array('$text' => array('$search'=> "environment")))->count();
  $design = $defectCol->find(array('$text' => array('$search'=> "design")))->count();
	$dataq = $defectCol->find(array('$text' => array('$search'=> "database issue")))->count();
?> 

var chart = AmCharts.makeChart("defectbyrootcause", {
    "theme": "light",
    "type": "serial",
    "fontFamily": "Arial",
		"titles": [{
            "text": 'Defects by Rootcause',
            "fontFamily": "Arial",
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
    ],
    "valueAxes": [{
        "position": "left",
        "title": "",
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
				"fontSize": 10,
        "labelRotation": 45
    },
    "export": {
    "enabled": true,
    "fileName": "top level filename",
    "menuReviver": function(item, li) {
      if (item.format === "CSV") {
        item.fileName = "Defects By Rootcause";
      }
      return li;
    },
     exportFields: ["rootcause", "value"],
    columnNames: {
      rootcause: "Rootcause Name",
      value: "No. of Defects"
    }
  }

});

<?php

//to fetch count from open-status
    $open = $defectCol->find(array("BG_STATUS"=>"Open"))->count();
  
    $closed = $defectCol->find(array("BG_STATUS"=>"Closed"))->count();
    
    $fixed = $defectCol->find(array("BG_STATUS"=>"Fixed"))->count();

  ?>

var gaugeChart = AmCharts.makeChart("defectbystatus", {
  "type": "gauge",
  "theme": "light",
  "fontFamily": "Arial",
	"titles": [{
            "text": 'Defects by Status',
            "fontFamily": "Arial",
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
  //    "legend": {
  //   "horizontalGap": 10,
  //   "useGraphSettings": true,
  //   "markerSize": 10
  // },
    "bands": [{
      "color": "#cfd9df",
      "startValue": 0,
      "endValue": 70000,
      "radius": "100%",
      "innerRadius": "85%",
      "fontFamily": "Arial"
    }, {
      "color": "#84b761",
      "startValue": 0,
      "endValue": <?php echo $closed ?>,
      "radius": "100%",
      "fontFamily": "Arial",
      "innerRadius": "85%",
      "balloonText": <?php echo $closed ?>
    }, {
      "color": "#cfd9df",
      "fontFamily": "Arial",
      "startValue": 0,
      "endValue": 70000,
      "radius": "80%",
      "innerRadius": "65%"
    }, {
      "color": "#fdd400",
      "fontFamily": "Arial",
      "startValue": 0,      
      "endValue": <?php echo $open ?>,
      "radius": "80%",
      "innerRadius": "65%",
      "balloonText": "<?php echo $open ?>"
    }, {
      "color": "#cfd9df",
      "fontFamily": "Arial",
      "startValue": 0,
      "endValue": 70000,
      "radius": "60%",
      "innerRadius": "45%"
    }, {
      "color": "#cc4748",
      "fontFamily": "Arial",
      "startValue": 100,
      "endValue": 500,
      "radius": "60%",
      "innerRadius": "45%",
      "balloonText": <?php echo $fixed ?>

    }]
  }],	
  

  "allLabels": [{
    "text": "Closed Defects",
    "fontFamily": "Arial",
    "x": "49%",
    "y": "15%",
    "size": 14,
    "bold": true,
    "color": "#84b761",
    "align": "right"
  }, {
    "text": "Active Defects",
    "fontFamily": "Arial",
    "x": "49%",
    "y": "24%",
    "size": 14,
    "bold": true,
    "color": "#fdd400",
    "align": "right"
  }, {
    "text": "Resolved Defects",
    "fontFamily": "Arial",
    "x": "49%",
    "y": "32%",
    "size": 14,
    "bold": true,
    "color": "#cc4748",
    "align": "right"
  }],
  "export": {
    "enabled": true,
    // "fileName": "top level filename",
    // "menuReviver": function(item, li) {
    //   if (item.format === "CSV") {
    //     item.fileName = "Defects By Status";
    //   }
    //   return li;
    // },
    //  exportFields: ["text", "balloonText"],
    // columnNames: {
    //   text: "Defect Status",
    //   balloonText: "Value"
    // }
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
    "fontFamily": "Arial",
		"titles": [{
            "text": 'Defects by Stage',
            "fontFamily": "Arial",
			"size":16,
			"paddingTop":0,
			"marginTop": 0,
        }],
    "legend": {
        "borderAlpha": 0.2,
        "horizontalGap": 10,
        "markerSize": 12,
        // "useGraphSettings": true,
        "valueAlign": "left",
         "fontFamily": "Arial",
        "valueWidth": 0,
        "markerType": "circle",
       "align" : "center"
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
        // "labelText": "[[percents]]%",
        "lineAlpha": 0.5,
        "title": "QA",
        "type": "column",
        "valueField": "QA"
    }, {
        "balloonText": "[[title]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
        "fillAlphas": 0.9,
        "fontSize": 11,
        // "labelText": "[[percents]]%",
        "lineAlpha": 0.5,
        "title": "PROD",
        "type": "column",
        "valueField": "PROD"
    }, {
        "balloonText": "[[title]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
        "fillAlphas": 0.9,
        "fontSize": 11,
        // "labelText": "[[percents]]%",
        "lineAlpha": 0.5,
        "title": "UAT",
        "type": "column",
        "valueField": "UAT"
    }, {
        "balloonText": "[[title]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
        "fillAlphas": 0.9,
        "fontSize": 11,
        // "labelText": "[[percents]]%",
        "lineAlpha": 0.5,
        "title": "BAV",
        "type": "column",
        "valueField": "BAV"
    } ],
    "marginTop": 35,
    "marginRight": 0,
    "marginLeft": 0,
    "marginBottom": 30,
    "autoMargins": false,
    "categoryField": "stage",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "fontSize" : 12
    },
    "export": {
    "enabled": true,
    // "fileName": "top level filename",
    // "menuReviver": function(item, li) {
    //   if (item.format === "CSV") {
    //     item.fileName = "Defects By Stage";
    //   }
    //   return li;
    // },
    //  exportFields: ["stage", "QA","PROD","UAT","BAV"],
    // columnNames: {
    //   stage: "Defect Stage"
    // }
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
  "fontFamily": "Arial",
	"titles": [{
            "text": 'Defect Status by Severity',
            "fontFamily": "Arial",
			"size":16,
			"paddingTop":0
        }],
  "depth3D": 19,
  "angle": 38.48,
  "legend": {
    "horizontalGap": 10,
    // "useGraphSettings": true,
     "fontFamily": "Arial",
    "markerSize": 12,
    "markerType": "circle"
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
    "enabled": true,
    "fileName": "top level filename",
    "menuReviver": function(item, li) {
      if (item.format === "CSV") {
        item.fileName = "Defect Status By Severity";
      }
      return li;
    },
     exportFields: ["status", "Low","Medium","High","Critical"],
    columnNames: {
      status: "Defect Severity Status",
      Low: "Low",
      Medium: "Medium",
      High: "High",
      Critical: "Critical"
    }
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
  "fontFamily": "Arial",
	"titles": [{
            "text": 'Defect Status by Priority',
            "fontFamily": "Arial",
			"size":16,
			"paddingTop":0
        }],
  "depth3D": 20,
  "angle": 30,
  "legend": {
    "horizontalGap": 1,
    // "useGraphSettings": true,
    "fontFamily": "Arial",
    "markerSize": 12,
    "markerType": "circle"
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
    "enabled": true,
    "fileName": "top level filename",
    "menuReviver": function(item, li) {
      if (item.format === "CSV") {
        item.fileName = "Defect Status by Priority";
      }
      return li;
    },
     exportFields: ["status", "Low","Medium","High","Critical"],
    columnNames: {
      status: "Defect Stage",
      Low: "Low",
      Medium: "Medium",
      High: "High",
      Critical: "Critical"
    }
  }


} );

</script>