<script> 

// --------------------------------------
// charts for report showcase
// --------------------------------------------
/*function handleClick(event)
        {
            // alert("hi");
            window.location = "https://www.google.com";
        }*/

// var chart = AmCharts.makeChart( "codeCoverage", {
//   "type": "pie",
//   "theme": "light",
//   "addClassNames": true,
//   "fontFamily": "Arial",
//   	"titles": [{
//             "text": '% of Code Covered and Uncovered',
// 			"size":16,
// 			"position": "top",
//       "fontFamily": "Arial",
// 			"paddingTop":0
//         }],
		
//   "dataProvider": [    
//      <?php
//     $codeCovered = $codelocCol->find();
//     $totalLoc = 0;
//     $coveredLoc = 0;
//     $uncoveredLoc = 0;
//     foreach($codeCovered as $code)
//     {
//       $totalLoc += $code["LOC"];
//       $coveredLoc += $code["Covered_LOC"];
//     }
//     $coveredPercentage = (100 * $coveredLoc)/$totalLoc;
//     $uncoveredPercentage = 100 - $coveredPercentage;
// 	?>
//      { 
// 			"Type": "Code Covered",
// 			"Percentage": <?php echo round($coveredPercentage,2); ?>
//     },
//     { 
// 			"Type": "Code Uncovered",
// 			"Percentage": <?php echo round($uncoveredPercentage,2); ?>
//     } ],
//   "titleField": "Type",
//   "valueField": "Percentage",
//   "labelRadius": 5,
//   "radius": "25%",
//   "innerRadius": "45%",
//   "labelText": "[[status]]",
//   "labelRotation": 40,
//    "legend" : {
// 	"enabled": true,
//   "fontFamily": "Arial",
//   "align": "center"
//   }, 
//    "chartCursor": {
//     "oneBalloonOnly": true,
//     "enabled": true
//   },


//   "export": {
//     "enabled": true
//   }
  
// } );

// chart.addListener("init", handleInit);

// chart.addListener("rollOverSlice", function(e) {
//   handleRollOver(e);
// });

// function handleInit(){
//   chart.legend.addListener("rollOverItem", handleRollOver);
// }

// function handleRollOver(e){
//   var wedge = e.dataItem.wedge.node;
//   wedge.parentNode.appendChild(wedge);
// }


//  chart.addListener("clickSlice", handleClick);
//  function handleClick(event)
//         {
// 			window.location = "http://34.197.209.70/Devops/prod/coveragetable.php";    
//         }
  


var chart = AmCharts.makeChart("codeCoverage", {
  "type": "pie",
  "startDuration": 0,
   "theme": "light",
    "fontFamily": "Arial",
  "addClassNames": true,
  "titles": [{
            "text": '% of Code Covered and Uncovered',
			"size":16,
			"position": "top",
      "fontFamily": "Arial",
			"paddingTop":0
        }],
  "legend":{
   	"position":"bottom",
    "align": "center",
    "autoMargins":false,
     "fontFamily": "Arial"
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
      "dataProvider": [    
     <?php
    $codeCovered = $codelocCol->find();
    $totalLoc = 0;
    $coveredLoc = 0;
    $uncoveredLoc = 0;
    foreach($codeCovered as $code)
    {
      $totalLoc += $code["LOC"];
      $coveredLoc += $code["Covered_LOC"];
    }
    $coveredPercentage = (100 * $coveredLoc)/$totalLoc;
    $uncoveredPercentage = 100 - $coveredPercentage;
	?>
     { 
			"Type": "Code Covered",
			"Percentage": <?php echo round($coveredPercentage,2); ?>
    },
    { 
			"Type": "Code Uncovered",
			"Percentage": <?php echo round($uncoveredPercentage,2); ?>
    } ],
  "valueField": "Percentage",
  "titleField": "Type",
  "export": {
    "enabled": true
  }
});

chart.addListener("init", handleInit);

chart.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});

function handleInit(){
  chart.legend.addListener("rollOverItem", handleRollOver);
}

function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}

 chart.addListener("clickSlice", handleClick);
 function handleClick(event)
        {
			window.location = "http://34.197.209.70/Devops/prod/coveragetable.php";    
        }



</script>