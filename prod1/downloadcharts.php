<?php require 'sessioncon.php'; if (!isset($_SESSION['Uid'])) { header('Location:login.php'); } 
$m = new MongoClient();
$db = $m->questions;
$toolselected = $db->tools;
/*---------------------Dev & Test Offloading --------------------------*/
$devcost = 2880000;
$testcost = 4320000;
$currentCost = $devcost + $testcost;


$y1hardware = 148032;
$y1MainMig = 2263926;
$y1ToolCost = 349744;

$y1mainframecost = 7200000;
$y2mainframecost = 4320000;
$y3mainframecost = 2160000;

$y2hardware = 140630;
$y2MainMig = 1697944;
$y2ToolCost = 332257;

$y3hardware = 131748;
$y3MainMig = 1131963;
$y3ToolCost = 297282;

$y1MigCost = $y1hardware+$y1MainMig+$y1ToolCost+$y1mainframecost;
$y2MigCost = $y2hardware+$y2MainMig+$y2ToolCost+$y2mainframecost;
$y3MigCost = $y3hardware+$y3MainMig+$y3ToolCost+$y3mainframecost;

$currPlatformCost = 7200000;
$y1MigSavings = $currPlatformCost - $y1MigCost;
$y2MigSavings = $currPlatformCost - $y2MigCost;
$y3MigSavings = $currPlatformCost - $y3MigCost;

$y1MigRoi = $y1MigSavings*100/$y1MigCost;
$y2MigRoi = $y2MigSavings*100/$y2MigCost;
$y3MigRoi = $y3MigSavings*100/$y3MigCost;


/*---------------------------------- Test and Data Setup Automation ROI analysis----------------------------------*/
$casecount = 19798;
$caseManEff = 8;
$rateCard = 40;
$currCost = $casecount*$caseManEff*$rateCard;
$manEff = (1 - 0.3) * $casecount * $caseManEff;
$scriptDevEff = 2;
$dataSetupEff = 3*4*20*8;
$caseExecEff = 0.25;
$dataMaskEff = 6*12*20*8;
$testercount = 192;
$m = new MongoClient();
$db = $m->devops_db;
$toolselected = $db->toolselected;
$cursor = $toolselected->find();
$input = array("Type"=> "Testing");
$tools = $toolselected->find($input);
$toolCostTot = "";
foreach ($tools as $tool)
{
    $perusercost = $tool['PerUserCost'];
    $licensecost = $tool['LicenseCost'];
    $toolCost = ($perusercost * $testercount * 0.25) + $licensecost;
    $toolCostTot += $toolCost;
}

$scriptEffTotal = (0.3 * $casecount * $scriptDevEff) + $dataSetupEff;
$L2scriptEffTotal = (0.25 * $casecount * $scriptDevEff) + $dataSetupEff;
$L3scriptEffTotal = (0.2 * $casecount * $scriptDevEff) + $dataSetupEff;
$scriptExecEffTot = (0.3 * $casecount * $caseExecEff);
$L3scriptExecEffTot = (0.75 * $casecount * $caseExecEff);

$caseManEff = 8;
$manEff = (1 - 0.3) * $casecount * $caseManEff;
$L3manEff = (1 - 0.75) * $casecount * $caseManEff;

$oneTimeCost = (($scriptEffTotal + $dataMaskEff)*$rateCard) + $toolCostTot;

$y1datamask = $dataMaskEff * $rateCard;
$y2datamask = $dataMaskEff * $rateCard * 0.1;
$y3datamask = $dataMaskEff * $rateCard * 0.1;

$y1tool = $toolCostTot;
$y2tool = $toolCostTot * 0.1;
$y3tool = $toolCostTot * 0.1;

$y1Cost = $oneTimeCost + (($scriptExecEffTot + $manEff) * $rateCard);
$y2Cost = ($oneTimeCost*0.1) + (($scriptExecEffTot + ($manEff*0.9)) * $rateCard);
$y3Cost = ($oneTimeCost*0.1) + (($scriptExecEffTot + ($manEff*0.8)) * $rateCard);

$Py1Cost = $oneTimeCost + (($L3scriptExecEffTot + $L3manEff) * $rateCard);
$Py2Cost = ($oneTimeCost*0.1) + (($L3scriptExecEffTot + ($L3manEff*0.9)) * $rateCard);
$Py3Cost = ($oneTimeCost*0.1) + (($L3scriptExecEffTot + ($L3manEff*0.8)) * $rateCard);

$y1script = $y1Cost - $y1datamask - $y1tool;
$y2script = $y2Cost - $y2datamask - $y2tool;
$y3script = $y3Cost - $y3datamask - $y3tool;

$Py1script = $Py1Cost - $y1datamask - $y1tool;
$Py2script = $Py2Cost - $y2datamask - $y2tool;
$Py3script = $Py3Cost - $y3datamask - $y3tool;

$y1Savings = $currCost - $y1Cost;
$y2Savings = $currCost - $y2Cost;
$y3Savings = $currCost - $y3Cost;

$y1Roi = $y1Savings*100/$y1Cost;
$y2Roi = $y2Savings*100/$y2Cost;
$y3Roi = $y3Savings*100/$y3Cost;

/*-----------------------CI-CD---------------------------------------------*/
$rev = 100000000;
$failCount = 1000;
$diffRecovery = 28.3;
$opsCount = 193;
$devCount = 112;
$rateCard1 = 40;

$opsResCost = $opsCount * $rateCard1 * 8*20*12;
$devResCost = $devCount * $rateCard1 * 8*20*12;
$resCount = $opsCount + $devCount;
$resCost = $opsResCost + $devResCost;

$opsResCost = $opsCount * $rateCard1 * 8*20*12;
$devResCost = $devCount * $rateCard1 * 8*20*12;
$resCount = $opsCount + $devCount;
$resCost = $opsResCost + $devResCost;
/* Gains */
$gtm = $rev * 0.08 /100;
$ghc = $opsResCost * 0.16 + $devResCost * 0.072;
$gql = $failCount*$diffRecovery*$rev / (365*24*60);
$gfx = $rev*0.4*0.14;

$gainTot = $gtm + $ghc + $gql + $gfx;

$totcost = 12566152;
$toolcost = 1926000;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>DevOps Analyzer</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="DevOps Analyser created by Legacy Modernization Team" name="description" />
    <meta content="" name="author" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/pages/css/roi.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../assets/layouts/layout/img/cap.ico" type="image/x-icon" />
</head>
<body>  
		<div class="col-lg-12">
				<h2>Assessment Chart</h2>
            	<div id="chartdiv" class="chart" style="height:600px;"></div>
            	<h4>Assessment Chart created based on your assessments</h4>
            	<br/>
		</div>        
        <div class="col-lg-12">
        	<div class="col-md-3">            
                            
            </div>
            <div class="col-md-6">            	
            	<h2>Dev-Test Offloading ROI Analysis</h2>
            	<div id="myChart1" class="chartheight"></div>
            	<h4>Dev-Test Offloading ROI Analysis created based on ROI</h4>
            	<br/>
				
            	<h2>Test and Data Setup Automation ROI analysis</h2>
            	<div id="myChart2" class="chartheight"></div><br />
            	<!-- <h4>Test and Data Setup Automation ROI analysis this is also created based on ROI</h4>  --> 
            	<br/>
				
            	<h2>CI-CD ROI Analysis</h2>
            	<div id="cicdroi" class="chartheight"></div>
				<h4>CI-CD ROI Analysis created from ROI</h4>
				
				<h2>Criticality</h2>            	
                <div id="criticalchart" style="height:400px;"></div> 
                <h2>SDLC Methodology</h2>   
                <div id="techchart" class="" style="height:400px;"></div>  
                <h2>Batch/Online</h2>
                <div id="batchchart" class="" style="height:400px;"> </div>   
                <h2>Internal/External</h2>
                <div id="donut_chart1" class="" style="height:400px;"> </div>  
                <h2>Location</h2>
                <div id="expdonut" class="" style="height:400px;"> </div>   
                <h2>ALM Application</h2>
                <div id="almpiechart" style="height:400px;"></div>    
                <h2>Vendor</h2>
                <div id="toolsvendor" class="" style="height:400px;"> </div> 
                <h2>Application by Service Line</h2>
                <div id="vendorschart1" class="" style="height:320px;"> </div>
                <h2>People by Service Line</h2>
                <div id="vendorschart2" class="" style="height:320px;"> </div> 
                <h2>Deployment Duration by Portfolio</h2>
                <div id="deployspeed" class="chart" style="height:400px"></div>
                <h2>Deployments by Technology & by No. of Components</h2>
                <div id="chartdive" class="chart" style="height:400px"></div>
                <h2>Deployment Failure by Portfolios</h2>
                <div id="vendorpie3" style="height:400px"></div>
                <h2>Change Lead Time by Portfolios</h2>
                <div id="leadtime" class="chart" style="height:400px"></div>
                <h2>Deployment by Vendor</h2>
                <div id="deploybar" class="chart" style="height:400px"></div>
                <h2>Deployment by Environment</h2>
                <div id="deploybar2" class="chart" style="height:400px"></div>
                <h2>Deployed Components by Portfolios</h2>
                <div id="vendorpie" class="chart" style="height:400px"></div>  
                <h2>Deployed Components by Technology</h2>
                <div id="techpie" class="chart" style="height:400px"></div>  
                <h2>Deployed Components by Environment</h2>
                <div id="envpie" class="chart" style="height:400px"></div>   
                <h2>Deployed Components Count</h2>
                <div id="bubblecomp" class="chart" style="height:400px"></div>     
                <h2>Deployment Failure by Vendor</h2>
                <div id="failure2" class="chart" style="height:400px"></div>
                <h2>Failure by Top 5 Application</h2>
                <div id="failure3" class="chart" style="height:400px"></div>
                <h2>Deployment and Failure by Application</h2>
                <div id="negativechart" class="chart" style="height:400px"></div>
				<h2>Deployment Failures by Environment</h2>
				<div id="failure4" class="chart" style="height:400px"></div>
				<h2>Deployment Failures - Pareto Chart</h2>
				<div id="failure1" class="chart" style="height:400px""></div>
            	<br/>
            	<div>
            	<input type="button" value="Save as PDF" class="btn btn-primary" onclick="exportCharts();" />
            	</div>
            	
            	<br/>
            	<br/>
            	<br/>
            </div>        
            <div class="col-md-3">            
                                
            </div>
        </div>        
            
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/xy.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script> 
        <script src="../assets/global/plugins/amcharts_3.21.7/amcharts/plugins/export/export.js" type="text/javascript"></script>
		<link rel="stylesheet" href="../assets/global/plugins/amcharts_3.21.7/amcharts/plugins/export/export.css" type="text/css" media="all" />    
        <script src="../assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>     
		<script src="../assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
         <script>
            var chart = AmCharts.makeChart("chartdiv", {
                "type": "radar",
                "theme": "light",
				"legend": {
								"align": "center",
								"Left":10,
								"position": "right",  
								"useGraphSettings": true,
								"textClickEnabled": true,
								"valueWidth":250
							},	
			    "allLabels": [{
								"text": "Current",
								"x": "!10",
								"y": "!230",
								"width": "50%",
								"size": 15,
								"bold": true,
								"align": "right"
							  }, {
								"text": "Desired",
								"x": "!10",
								"y": "!195",
								"width": "50%",
								"size": 15,
								"bold": true,
								"align": "right"
							  }],
                "color": "#000",
                "fontSize": 15,
                "lineThickness": 5,
                "dataProvider": [{
                    "field": "Culture/Organisation",
                    "current": <?php echo $_SESSION['avgcur1']?>,
                    "desired": 5
                }, {
                    "field": "Build, Integration & Release",
                    "current": <?php echo $_SESSION['avgcur2'] ?>,
                    "desired": 5
                }, {
                    "field": "Data Management",
                    "current": <?php echo $_SESSION['avgcur3'] ?>,
                    "desired": 5
                }, {
                    "field": "Quality Management",
                    "current": <?php echo $_SESSION['avgcur4'] ?>,
                    "desired": 5
                }, {
                    "field": "Collaborate/Monitor",
                    "current": <?php echo $_SESSION['avgcur5'] ?>,
                    "desired": 5
                }],
                "valueAxes": [{
                    "axisTitleOffset": 4,
                    "minimum": 0,
				"axisTitleOffset": 20,
                    "axisAlpha": 0.2
                }],
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "Current: [[value]]",
                    "bullet": "round",
                    "lineThickness": 2,
                    "valueField": "current"
                }, {
                    "balloonText": "Desired: [[value]]",
                    "bullet": "round",
                    "lineThickness": 2,
                    "valueField": "desired"
                }],
                "categoryField": "field",
                "export":{
                    "enabled":true,
            		"menu": []
                }

            });
            
            var chart = AmCharts.makeChart("myChart1", {
                "type": "serial",
                "addClassNames": true,
                "theme": "light",
                "autoMargins": false,
                "marginLeft": 75,
                "marginRight": 8,
                "color": "#1B1F23",
                "marginTop": 10,
                "marginBottom": 26,
				"labelsEnabled": false,
				 "legend": {
                    "position": "right",
                    "valueText": '',
                    "markerSize": 6,
                    "valueWidth": 10,
                }, 
                "balloon": {
                    "adjustBorderColor": false,
                    "horizontalPadding": 10,
                    "verticalPadding": 8,
                    "color": "#ffffff"
                },
                "dataProvider": [{
                    "year": 'Year 1',
                    "income": <?php echo $currentCost ?>,
                    "Current": <?php echo $y1MigCost ?>,
                    "expenses": <?php echo $y1MigSavings ?>
                }, {
                    "year": 'Year 2',
                    "income": <?php echo $currentCost ?>,
                    "Current": <?php echo $y2MigCost ?>,
                    "expenses": <?php echo $y2MigSavings ?>
                }, {
                    "year": 'Year 3',
                    "income": <?php echo $currentCost ?>,
                    "Current": <?php echo $y3MigCost ?>,
                    "expenses": <?php echo $y3MigSavings ?>
                }],
                "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left",
                }],
                "startDuration": 0,
                "graphs": [{
                    "alphaField": "alpha",
                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='-size:12px;'>[[value]]</span> [[additional]]</span>",
                    "fillAlphas": 1,
                    "title": "Current Cost",
                    "type": "column",
                    "valueField": "income",
                    "fillColors": "#08B2C9",
                    "lineColor": "#65909A",
                    "dashLengthField": "dashLengthColumn"
                }, {
                    "alphaField": "alpha",
                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:12px;'>[[value]]</span> [[additional]]</span>",
                    "fillAlphas": 1,
                    "title": "Yearly Cost After Migration",
                    "type": "column",
                    "valueField": "Current",
                    "lineColor": "#65909A",
                    "dashLengthField": "dashLengthColumn",
                    "fillColors": "#097B96"
                }, {
                    "id": "graph2",
                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:12px;'>[[value]]</span> [[additional]]</span>",
                    "bullet": "round",
                    "lineThickness": 3,
                    "bulletSize": 7,
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "useLineColorForBulletBorder": true,
                    "bulletBorderThickness": 3,
                    "fillAlphas": 0,
                    "lineAlpha": 1,
                    "title": "Yearly Profit",
                    "lineColor": "#65909A",
                    "valueField": "expenses",
                    "dashLengthField": "dashLengthLine"
                }],
                "categoryField": "year",
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "tickLength": 0
                },
				"export": {
					"enabled": true
							}
            });

        var chart = AmCharts.makeChart("myChart2", {
                    "type": "serial",
                    "addClassNames": true,
                    "theme": "light",
                    "autoMargins": false,
                    "marginLeft": 70,
                    "marginRight": 8,
                    "marginTop": 10,
                    "marginBottom": 26,
                    "balloon": {
                        "adjustBorderColor": false,
                        "horizontalPadding": 10,
                        "verticalPadding": 8,
                        "color": "#ffffff"
                    },

                    "dataProvider": [{
                        "year": 'Year 1',
                        "income": <?php echo $currCost ?>,
                        "Current": <?php echo $y1Cost ?>,
                        "expenses": <?php echo $y1Savings?>
                    }, {
                        "year": 'Year 2',
                        "income": <?php echo $currCost ?>,
                        "Current": <?php echo $y2Cost ?>,
                        "expenses": <?php echo $y2Savings?>
                    }, {
                        "year": 'Year 3',
                        "income": <?php echo $currCost ?>,
                        "Current": <?php echo $y3Cost ?>,
                        "expenses": <?php echo $y3Savings?>
                    }],
                    "valueAxes": [{
                        "axisAlpha": 0,
                        "position": "left"
                    }],
                    "startDuration": 0,
                    "graphs": [{
                        "alphaField": "alpha",
                        "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:12px;'>[[value]]</span> [[additional]]</span>",
                        "fillAlphas": 1,
                        "title": "Without automation",
                        "type": "column",
                        "valueField": "income",
                        "dashLengthField": "dashLengthColumn",
                        "fillColors": "#738989",
                        "lineColor": "#65909A"
                    }, {
                        "alphaField": "alpha",
                        "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:12px;'>[[value]]</span> [[additional]]</span>",
                        "fillAlphas": 1,
                        "title": "With Maturity Level 1",
                        "type": "column",
                        "valueField": "Current",
                        "dashLengthField": "dashLengthColumn",
                        "fillColors": "#98B4BB",
                        "lineColor": "#65909A"
                    }, {
                        "id": "graph2",
                        "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:12px;'>[[value]]</span> [[additional]]</span>",
                        "bullet": "round",
                        "lineThickness": 3,
                        "bulletSize": 7,
                        "lineColor": "#65909A",
                        "bulletBorderAlpha": 1,
                        "bulletColor": "#FFFFFF",
                        "useLineColorForBulletBorder": true,
                        "bulletBorderThickness": 3,
                        "fillAlphas": 0,
                        "lineAlpha": 1,
                        "title": "With DevOps Progressing",
                        "valueField": "expenses",
                        "dashLengthField": "dashLengthLine"
                    }],
                    "categoryField": "year",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "axisAlpha": 0,
                        "tickLength": 0
                    },
					"export": {
						"enabled": true
								}
                });

		var chart = AmCharts.makeChart("cicdroi", {
                "type": "pie",
                "theme": "light",
                "innerRadius": "60%",
                "labelsEnabled": true,
                "legend": {
                    "position": "right",
                    "valueText": '',
                    "markerSize": 6,
                    "valueWidth": 10,
                },
                "autoMargins": false,
                "marginTop": 0,
                "marginBottom": 0,
                "color": "#142C35",
                "marginLeft": 0,
                "marginRight": 0,
                "pullOutRadius": 10,
                "dataProvider": [{
                    "id": "new functionality",
                    "value": <?php echo $gtm ?>,
                    "color": "#738989"
                }, {
                    "id": "headcount waste",
                    "value": <?php echo $ghc ?>,
                    "color": "#0A6A8B"
                }, {
                    "id": "increased quality",
                    "value": <?php echo $gql ?>,
                    "color": "#39B7CD"
                }, {
                    "id": "flexibility environment",
                    "value": <?php echo $gfx ?>,
                    "color": "#B1FFFF"
                }],
                "valueField": "value",
                "titleField": "id",
                "startEffect": "elastic",
                "colorField": "color",
                "startDuration": 2,
                "labelRadius": 0,
                "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
				"export": {
					"enabled": true
							}

            });
			
			

		var chart = AmCharts.makeChart("criticalchart", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
			
            //"labelsEnabled": false,
			//"dataPoints": [
                         //{y : 10, label : "High" , name : "Larger"}
						 //],
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
				"indexLabelPlacement" : "outside",
                "showInLegend": true,
                "valueWidth": 10,
			},
            "allLabels": [{
                "text": "",
                "align": "left",
                "bold": true,
                "size": 8
            }],
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [{
                "country": "Larger",
                "visits": <?php $cursor = $application_collection->find(array('Criticality'=>'High'));
                                $count=0;
                                foreach($cursor as $cur){
                                    $count = $count + 1;
                                }echo $count;
                                ?>,
                "color": "#e7505a"
            }, {
                "country": "Lowest",
                "visits": <?php $cursor = $application_collection->find(array('Criticality' => 'Medium'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
								?>,
                "color": "#888888"
            }, {
                "country": "Moderate",
                "visits": <?php $cursor = $application_collection->find(array('Criticality' => 'Low'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
								?>,
                "color": "#49a2df"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 15,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",	
			"export":{
				"enabled":true
			}
        });

		var chart = AmCharts.makeChart("techchart", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10
            },

            "allLabels": [{
                "text": "",
                "align": "left",
                "bold": true,
                "size": 8
            }],
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "title": "new",
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [{
                "country": "Waterfall",
                "visits": <?php $cursor = $application_collection->find(array('SDLC_Method' => 'Waterfall'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
								?>,
                "color": "#e7505a"
            }, {
                "country": "Agile",
                "visits": <?php $cursor = $application_collection->find(array('SDLC_Method' => 'Agile'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
								?>,
                "color": "#888888"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 15,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
			"export":{
				"enabled":true
			}
        });

		var chart = AmCharts.makeChart("batchchart", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10
            },
            "allLabels": [{
                "text": "",
                "align": "left",
                "bold": true,
                "size": 8
            }],
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [{
                "country": "Batch",
                "visits": <?php $cursor = $application_collection->find(array('Process' => 'Batch'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
                            ?>,
                "color": "#e7505a"
            }, {
                "country": "Online",
                "visits": <?php $cursor = $application_collection->find(array('Process' => 'Online'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
                            ?>,
                "color": "#49a2df"
            }, {
                "country": "Both",
                "visits": <?php $cursor = $application_collection->find(array('Process' => 'Both'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
                            ?>,
                "color": "#888888"
            }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 15,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
			"export":{
				"enabled":true
			}
        });

		var chart = AmCharts.makeChart("donut_chart1", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10,
            },
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [<?php
                                $cursor = $people_collection->distinct("Emp_of");
                                for($i=0;$i<sizeof($cursor);$i++){
                                            $vendor = array("Emp_of"=>$cursor[$i]);
                                            $maincursor = $people_collection->find($vendor)->count();
                                            echo '{"field":"'.$cursor[$i].'",';
                                            echo '"value":"'.$maincursor .'"},';
                                }
                            ?>],
            "valueField": "value",
            "titleField": "field",
            "startEffect": "elastic",
            "startDuration": 2,
            "labelRadius": 0,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",	"export":{
			"enabled":true
		}
        });

		var chart = AmCharts.makeChart("expdonut", {
            "type": "pie",
            "theme": "light",
            "innerRadius": "60%",
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10,
            },
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [<?php
                                $cursor = $people_collection->distinct("Location");
                                for ($i = 0; $i < sizeof($cursor); $i++) {
                                    $vendor = array("Location" => $cursor[$i]);
                                    $maincursor = $people_collection->find($vendor)->count();
                                    echo '{"field":"' . $cursor[$i] . '",';
                                    echo '"value":"' . $maincursor . '"},';
                                }
                                ?>],
            "valueField": "value",
            "titleField": "field",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 0,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",	"export":{
			"enabled":true
		}
        });

		var chart = AmCharts.makeChart("almpiechart", {
            "type": "pie",
            "theme": "light",
			"labelsEnabled": true,
            "legend": {
                "position": "bottom",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10
            },
            "autoMargins": false,
            "marginTop": 10,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 0,
            "dataProvider": [<?php
                                $toolscollection = $db->tools;
                                $cursor = $toolscollection->distinct("Type");
                                for ($i = 0; $i < sizeof($cursor); $i++) {
                                    $vendor = array("Type" => $cursor[$i]);
                                    $maincursor = $toolscollection->find($vendor)->count();
                                    echo '{"field":"' . $cursor[$i] . '",';
                                    echo '"value":"' . $maincursor . '"},';
                                }
                            ?>],
            "valueField": "value",
            "titleField": "field",
            "startEffect": "elastic",
            "colorField": "color",
            "startDuration": 2,
            "labelRadius": 5,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
			"export":{
				"enabled":true
			}
        });

		var chart = AmCharts.makeChart("toolsvendor", {
            "type": "pie",
            "innerRadius": "60%",
            "legend": {
                "position": "right",
                "valueText": '',
                "markerSize": 6,
                "valueWidth": 10,
            },
            "allLabels": [{
                "text": "",
                "align": "left",
                "bold": true,
                "size": 8
            }],
            "autoMargins": false,
            "marginTop": 0,
            "marginBottom": 0,
            "marginLeft": 0,
            "marginRight": 0,
            "pullOutRadius": 10,
            "dataProvider": [<?php
                                $cursor = $toolscollection->distinct('Vendor');
                                for ($i = 0; $i < sizeof($cursor); $i++) {
                                    $vendor = array('Vendor'=> $cursor[$i]);
                                    $maincursor = $toolscollection->find($vendor)->count();
                                    echo '{"field":"' . $cursor[$i] . '",';
                                    echo '"value":"' . $maincursor . '"},';
                                }
                                ?>],
            "valueField": "value",
            "titleField": "field",
            "startEffect": "elastic",
            "startDuration": 2,
            "labelRadius": 0,
            "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",	"export":{
			"enabled":true
		}
        });

		var chart = AmCharts.makeChart("vendorschart1", {
            "type": "serial",
            "theme": "light",
            "depth3D": 20,
            "angle": 30,
            "legend": {
                "horizontalGap": 10,
                "useGraphSettings": true,
                "markerSize": 5,
                "position": 'bottom',
                "color": "#000"
            },
            "dataProvider": [{				
                "Services": "AO",
                "Capgemini": <?php 	$array = array("AO_Vendor"=>"Capgemini");
									$cursor = $application_collection->find($array)->count(); 
									echo $cursor;
							 ?>,
                "Adroit IT": <?php $array = array("AO_Vendor"=>"Adroit IT");
									$cursor = $application_collection->find($array)->count(); 
									echo $cursor;
							 ?>,
                "Capterra":  <?php $array = array("AO_Vendor"=>"Capptera");
									$cursor = $application_collection->find($array)->count(); 
									echo $cursor;
							 ?>
            }, {
                "Services": "AD",
                "Capgemini": <?php $array = array("AD_Vendor"=>"Capgemini");
									$cursor = $application_collection->find($array)->count(); 
									echo $cursor;
							 ?>,
                "Adroit IT": <?php $array = array("AD_Vendor"=>"Adroit IT");
									$cursor = $application_collection->find($array)->count(); 
									echo $cursor;
							 ?>,
                "Capterra": <?php $array = array("AD_Vendor"=>"Capptera");
									$cursor = $application_collection->find($array)->count(); 
									echo $cursor;
							 ?>
            }, {
                "Services": "AM",
                "Capgemini": <?php $array = array("AM_Vendor"=>"Capgemini");
									$cursor = $application_collection->find($array)->count(); 
									echo $cursor;
							 ?>,
                "Adroit IT": <?php $array = array("AM_Vendor"=>"Adroit IT");
									$cursor = $application_collection->find($array)->count(); 
									echo $cursor;
							 ?>,
                "Capterra": <?php $array = array("AM_Vendor"=>"Capptera");
									$cursor = $application_collection->find($array)->count(); 
									echo $cursor;
							 ?>
            }],
            "valueAxes": [{
                "stackType": "regular",
                "axisAlpha": 0,
                "gridAlpha": 0
            }],
            "graphs": [{
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Capgemini",
                "type": "column",
                "fillColors": "#98F5FF",
                "valueField": "Capgemini",
                "fixedColumnWidth": 100
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Adroit IT",
                "type": "column",
                "fillColors": "#65909A",
                "valueField": "Adroit IT",
                "fixedColumnWidth": 100
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Capterra",
                "type": "column",
                "fillColors": "#00688B",
                "valueField": "Capterra",
                "fixedColumnWidth": 100
            }],
            "categoryField": "Services",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "position": "left"
            },	"export":{
			"enabled":true
		}
        });

		var chart = AmCharts.makeChart("vendorschart2", {
            "type": "serial",
            "theme": "light",
            "depth3D": 20,
            "angle": 30,
            "legend": {
                "horizontalGap": 10,
                "useGraphSettings": true,
                "markerSize": 5,
                "position": 'bottom'
            },
            "dataProvider": [{
                "Services": "AO",
                "Capgemini": <?php 	$array = array("Emp_of"=>"Capgemini","App_Service_Line"=>"AO");
									$cursor = $people_collection->find($array)->count(); 
									echo $cursor;  ?>,
                "Adroit IT":  <?php 	$array = array("Emp_of"=>"Adroit IT","App_Service_Line"=>"AO");
									$cursor = $people_collection->find($array)->count(); 
									echo $cursor;  ?>,
                "Capterra":  <?php 	$array = array("Emp_of"=>"Capterra","App_Service_Line"=>"AO");
									$cursor = $people_collection->find($array)->count(); 
									echo $cursor;  ?>
            }, {
                "Services": "AD",
                "Capgemini": <?php 	$array = array("Emp_of"=>"Capgemini","App_Service_Line"=>"AD");
									$cursor = $people_collection->find($array)->count(); 
									echo $cursor;  ?>,
                "Adroit IT": <?php 	$array = array("Emp_of"=>"Adroit IT","App_Service_Line"=>"AD");
									$cursor = $people_collection->find($array)->count(); 
									echo $cursor;  ?>,
                "Capterra": <?php 	$array = array("Emp_of"=>"Capterra","App_Service_Line"=>"AD");
									$cursor = $people_collection->find($array)->count(); 
									echo $cursor;  ?>
            }, {
                "Services": "AM",
                "Capgemini": <?php 	$array = array("Emp_of"=>"Capgemini","App_Service_Line"=>"AM");
									$cursor = $people_collection->find($array)->count(); 
									echo $cursor;  ?>,
                "Adroit IT": <?php 	$array = array("Emp_of"=>"Adroit IT","App_Service_Line"=>"AM");
									$cursor = $people_collection->find($array)->count(); 
									echo $cursor;  ?>,
                "Capterra": <?php 	$array = array("Emp_of"=>"Capterra","App_Service_Line"=>"AM");
									$cursor = $people_collection->find($array)->count(); 
									echo $cursor;  ?>,
            }],
            "valueAxes": [{
                "stackType": "regular",
                "axisAlpha": 0,
                "gridAlpha": 0
            }],
            "graphs": [{
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Capgemini",
                "type": "column",
                "fillColors": "#39B7CD",
                "valueField": "Capgemini",
                "fixedColumnWidth": 100
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Adroit IT",
                "type": "column",
                "fillColors": "#65909A",
                "valueField": "Adroit IT",
                "fixedColumnWidth": 100
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Capterra",
                "type": "column",
                "fillColors": "#00688B",
                "valueField": "Capterra",
                "fixedColumnWidth": 100
            }],
            "categoryField": "Services",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "position": "left"
            },	"export":{
			"enabled":true
		}
        });

		var chart = AmCharts.makeChart("deployspeed", {
		  "type": "serial",
          "theme": "light",
          "titles": [{
              "text": "Deployment Duration by Portfolio"
          }],
          "valueAxes": [{
              "position": "left"
          }],
		  "labelsEnabled": false,
				 "legend": {
                    "position": "right",
                    "valueText": '',
                    "markerSize": 6,
                    "valueWidth": 9,
                }, 
          "chartCursor": {
              "pan": true,
              "valueLineEnabled": true,
              "valueLineBalloonEnabled": true,
			  "cursorAlpha": 1,
              "cursorColor": "#258cbb",
              "limitToGraph": "g1",
              "valueLineAlpha": 0.2,
          },
          "graphs": [
			<?php 
				$cursor = $depduration->find();
				$g = 0;
				$value = 0;
				foreach($cursor as $cur){
						echo '{"id":"g'.$g++.'",';
						echo '"bullet": "round",
							  "bulletBorderAlpha": 1,
							  "bulletColor": "#FFFFFF",
                            "bulletSize": 5,
                            "lineThickness": 2,
							  "title":"';
						echo $cur['Portfolio_Name'];
						echo '","useLineColorForBulletBorder" : true,
							 "balloonText": "<span style=\'font-size:11px;\'>[[title]] [[value]]</span>",';
						echo '"valueField": "'.$cur['Portfolio_Name'].'"},';
				}
			?>],
          "categoryField": "date",
          "categoryAxis": {
              "dashLength": 1,
              "minorGridEnabled": true,

          },
          "dataProvider": [{
              "date": "Jan",
				<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Jan'].',';
				}?>
          }, {
              "date": "Feb",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Feb'].',';
				}?>
          }, {
              "date": "Mar",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Mar'].',';
				}?>
          }, {
              "date": "Apr",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Apr'].',';
				}?>
          }, {
              "date": "May",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['May'].',';
				}?>
          }, {
              "date": "Jun",
             	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Jun'].',';
				}?>
          }, {
              "date": "Jul",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['July'].',';
				}?>
          }, {
              "date": "Aug",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Aug'].',';
				}?>
          }, {
              "date": "Sep",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Sep'].',';
				}?>
          }, {
              "date": "Oct",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Oct'].',';
				}?>
          }, {
              "date": "Nov",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Nov'].',';
				}?>
          }, {
              "date": "Dec",
            	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Dec'].',';
				}?>
			}],
          "allLabels": [{
              "text": "Duration in mins",
              "rotation": 270,
              "x": "10",
              "y": "100",
              "size": 10,
              "align": "right"
          }],	"export":{
			"enabled":true
		}
      });
         
        var chart = AmCharts.makeChart("chartdive", {
          "type": "serial",
          "theme": "none",
          "allLabels": [{
              "text": "Deployments by Technology & by No. of Components",
              "align": "center",
              "bold": true,
              "size": 12,
              "y": 10,
              "x": 2
          }],
          "marginTop": 40,
		  /* "labelsEnabled": false,
				 "legend": {
                    "position": "right",
                    "valueText": '',
                    "markerSize": 6,
                    "valueWidth": 10,
                },  */
		  "labelsEnabled": false,
          "legend": {
              "equalWidths": true,
              "position": "right",
              "valueAlign": "left",
              "labelWidth": 70,
              "valueWidth": 10,
              "markerSize": 6,
              "align": "left",
			},
          "rotate": "true",
          "columnWidth": 0.6,
          "dataProvider": [
			
			<?php $cursor = $depbytech->find();
				  foreach($cursor as $cur){
					echo '{"Portfolio": "'.$cur['Portfolio_Name'].'",
						 "Mainframe":'.$cur['Mainframe'].',
						 "Java":'.$cur['Java'].',
						 "Python":'.$cur['dotNet'].',
						 "Unix":'.$cur['Unix'].',
						 "Windows":'.$cur['Windows'].',
						 "ETL":'.$cur['ETL'].',
						 "Others":'.$cur['Others'].'},';
				  }
			?>],
          "valueAxes": [{
              "gridColor": "#FFFFFF",
              "gridAlpha": 0.2,
              "dashLength": 0,
              "stackType": "regular"
          }],
          "gridAboveGraphs": true,
          "startDuration": 2,
          "graphs": [
			<?php $cursor = $depbytech->findOne(); 
					$keys = array_keys($cursor);
					$keys = array_slice($keys, 2); 
					foreach($keys as $key){
						echo '{"title": "'.$key.'",
						 "balloonText": "[[category]]: <b>[[value]]</b>",
						 "fillAlphas": 0.8,
						 "lineAlpha": 0.2,
						 "type": "column",
					"valueField": "'.$key.'"},';
					}
			?>],
          "chartCursor": {
              "categoryBalloonEnabled": false,
              "cursorAlpha": 0,
              "zoomable": false
          },
          "categoryField": "Portfolio",
          "categoryAxis": {
              "gridPosition": "start",
              "gridAlpha": 0,
              "tickPosition": "start",
              "tickLength": 10
          },	"export":{
			"enabled":true
		}
      });

      var chart = AmCharts.makeChart("vendorpie3", {
          "type": "pie",
          "theme": "light",
          "titles": [{
              "text": "Deployment Failure by Portfolios",
              "fontSize": 10
          }],
          "innerRadius": 50,
          "labelsEnabled": false,
          "autoMargins": false,
          "marginTop": 0,
          "marginBottom": 0,
          "marginLeft": 0,
          "marginRight": 0,
          "pullOutRadius": 0,
		  "legend": {
                    "position": "right",
                    "valueText": '',
                    "markerSize": 6,
                    "valueWidth": 10,
                },
         "dataProvider": [<?php $cursor = $portfolio_collection->find();
                              foreach ($cursor as $cur) {
                                  echo '{"field":"' . $cur["Portfolio_Name"] . '",';
                                  echo '"value":' . $cur["Deployment_failure"] . '},';
                              } ?>],
          "valueField": "value",
          "titleField": "field",
          "startEffect": "elastic",
          "startDuration": 2,
          "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
			"export":{
				"enabled":true
			}
      });
	  
	  var chart = AmCharts.makeChart("failure4", {
            "type": "serial",
            "theme": "light",
            //"labelsEnabled": false,
			/* "legend": {
                    "position": "right",
                    "valueText": '',
                    "markerSize": 6,
                    "valueWidth": 10,
                }, */
            "titles": [{
                "text": "Deployment Failures by Environment"
            }],
            "dataProvider": [{
                "field": "Develop",
                "value":  <?php $cursor = $deployment_collection->find(array("Deployment Successful" => "No"));
                            $count = 0;
                            foreach ($cursor as $cur) {
                                if ($cur["env"] == "dev") {
                                    $count = $count + 1;
                                }
                            }
                            echo $count;
                            ?>
            }, {
                "field": "Test",
                "value": <?php $cursor = $deployment_collection->find(array("Deployment Successful" => "No"));
                            $count = 0;
                            foreach ($cursor as $cur) {
                                if ($cur["env"] == "test") {
                                    $count = $count + 1;
                                }
                            }
                            echo $count;

                            ?>
            }, {
                "field": "Pre-Prod",
                "value": <?php $cursor = $deployment_collection->find(array("Deployment Successful" => "No"));
                            $count = 0;
                            foreach ($cursor as $cur) {
                                if ($cur["env"] == "preprod") {
                                    $count = $count + 1;
                                }
                            }
                            echo $count;

                            ?>
            }, {
                "field": "Production",
                "value": <?php $cursor = $deployment_collection->find(array("Deployment Successful" => "No"));
                            $count = 0;
                            foreach ($cursor as $cur) {
                                if ($cur["env"] == "prod") {
                                    $count = $count + 1;
                                }
                            }
                            echo $count;
                            ?>
            }],
			"valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "value"
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "field",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20
            },	"export":{
			"enabled":true
		}
        });
	  
	  var chart = AmCharts.makeChart("failure1", {
            "type": "serial",
            "theme": "light",
			"titles": [{
                "text": "Deployment Failures - Pareto Chart"
            }],
            "dataProvider": [<?php $cursor = $deployment_collection->distinct('Failure_reason');
				$val = 0;
				foreach($cursor as $cur){
					$array = array('Failure_reason'=>$cur);
					if($cur !== "NULL"){
						$totfailure = $deployment_collection->find($array)->count();
						$val = $totfailure + $val;
				  }
				  }
				$pareto = 0;
				foreach($cursor as $cur){
					$array = array('Failure_reason'=>$cur);
					if($cur !== "NULL"){
						echo '{"reason":"'.$cur.'",';
						$maincursor = $deployment_collection->find($array)->count();
						echo '"counts":'.$maincursor.',';
						$pareto = $maincursor + $pareto;
						echo '"percent":'.(($pareto/$val)*100).'},';
				  }
				  }  					  
			?>],
            "valueAxes": [{
                "id": "v1",
                "axisAlpha": 0,
                "position": "left",
                "maximum": 100
            }, {
                "id": "v2",
                "axisAlpha": 0,
                "position": "right",
                "unit": "%",
                "gridAlpha": 0,
                "maximum": 100
            }],
            "startDuration": 1,
            "graphs": [{
                "fillAlphas": 1,
                "colorField": "color",
                "type": "column",
                "balloonText": "<div style='margin:5px; font-size:10px;'><span style='font-size:13px;'>[[category]]</span><br>[[value]]</div>",
                "valueField": "counts"
            }, {
                "valueAxis": "v2",
                "bullet": "round",
                "lineThickness": 3,
                "bulletSize": 7,
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "useLineColorForBulletBorder": true,
                "fillAlphas": 0,
                "lineAlpha": 1,
                "title": "Percent",
                "valueField": "percent"
            }],
            "categoryField": "reason",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "tickLength": 0
            },	"export":{
			"enabled":true
		}
        });

      var chart = AmCharts.makeChart("leadtime", {
          "type": "serial",
          "theme": "light",
          "titles": [{
              "text": "Change Lead Time by Portfolios"
          }],
          "valueAxes": [{
              "position": "left"
          }],
          "chartCursor": {
              "pan": true,
              "valueLineEnabled": true,
              "valueLineBalloonEnabled": true,
              "cursorAlpha": 1,
              "cursorColor": "#258cbb",
              "limitToGraph": "g1",
              "valueLineAlpha": 0.2,
          },
		  "labelsEnabled": false,
				 "legend": {
                    "position": "right",
                    "valueText": '',
                    "markerSize": 6,
                    "valueWidth": 10,
                }, 
          "graphs": [
			<?php 
				$cursor = $changeleadtime->find();
				$g = 0;
				$value = 0;
				foreach($cursor as $cur){
						echo '{"id":"g'.$g++.'",';
						echo '"bullet": "round",
							  "bulletBorderAlpha": 1,
							  "bulletColor": "#FFFFFF",
                            "bulletSize": 5,
                            "lineThickness": 2,
							  "title":"';
						echo $cur['Portfolio_Name'];
						echo '","useLineColorForBulletBorder" : true,
							 "balloonText": "<span style=\'font-size:11px;\'>[[title]] [[value]]</span>",';
						echo '"valueField": "'.$cur['Portfolio_Name'].'"},';
				}
			?>],
          "categoryField": "date",
          "categoryAxis": {
              "dashLength": 1,
              "minorGridEnabled": true
          },
          "dataProvider": [{
              "date": "Jan",
				<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Jan'].',';
				}?>
          }, {
              "date": "Feb",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Feb'].',';
				}?>
          }, {
              "date": "Mar",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Mar'].',';
				}?>
          }, {
              "date": "Apr",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Apr'].',';
				}?>
          }, {
              "date": "May",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['May'].',';
				}?>
          }, {
              "date": "Jun",
             	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Jun'].',';
				}?>
          }, {
              "date": "Jul",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['July'].',';
				}?>
          }, {
              "date": "Aug",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Aug'].',';
				}?>
          }, {
              "date": "Sep",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Sep'].',';
				}?>
          }, {
              "date": "Oct",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Oct'].',';
				}?>
          }, {
              "date": "Nov",
              	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Nov'].',';
				}?>
          }, {
              "date": "Dec",
            	<?php foreach($cursor as $cur){
				echo '"'.$cur['Portfolio_Name'].'":'.$cur['Dec'].',';
				}?>
			}],
          "allLabels": [{
              "text": "Duration in days",
              "rotation": 270,
              "x": "10",
              "y": "100",
              //"width": "50%",
              "size": 10,
              //"bold": true,
              "align": "right"
          }],	"export":{
			"enabled":true
		}
      });

      var chart = AmCharts.makeChart("deploybar", {
          "type": "serial",
          "theme": "none",
          "titles": [{
              "text": "Deployment by Vendor"
          }],
          "legend": {
              "position": "bottom",
              "valueText": '',
              "markerSize": 6,
              "valueWidth": 10
          },
          "columnWidth": 0.8,
          "dataProvider": [
			<?php $cursor = $vendor_deployment->distinct('Vendor');
				  foreach($cursor as $cur){ //var_dump($cur);
					    $array = array('Vendor'=>$cur);
						$maincursor = $vendor_deployment->find($array);
						$i = 0;
						$dev = 0;
						foreach($maincursor as $cur1){
							$dev = $dev + $cur1['Develop'];
							$test = $dev + $cur1['Test'];
							$preprod = $dev + $cur1['Pre-Prod'];
							$prod = $dev + $cur1['Prod'];
						}
							echo '{"vendor":"'.$cur1['Vendor'].'",';
							echo '"dev":'.$dev.',';
							echo '"test":'.$test.',';
							echo '"preprod":'.$preprod.',';
							echo '"prod":'.$prod.'},';
				  }
			?>],
          "valueAxes": [{
              "gridColor": "#FFFFFF",
              "gridAlpha": 0.2,
              "dashLength": 0,
              "stackType": "regular"
          }],
          "gridAboveGraphs": true,
          "startDuration": 1,
          "graphs": [{
              "title": "Development",
              "balloonText": "[[title]]: <b>[[value]]</b>",
              "fillAlphas": 0.8,
              "lineAlpha": 0.2,
              "type": "column",
              "valueField": "dev"
          }, {
              "title": "Test",
              "balloonText": "[[title]]: <b> [[value]] </b>",
              "fillAlphas": 0.8,
              "lineAlpha": 0.2,
              "type": "column",
              "valueField": "test"
          }, {
              "title": "Pre-Prod",
              "balloonText": "[[title]]: <b>[[value]]</b>",
              "fillAlphas": 0.8,
              "lineAlpha": 0.2,
              "type": "column",
              "valueField": "preprod"
          }, {
              "title": "Production",
              "balloonText": "[[title]]: <b>[[value]]</b>",
              "fillAlphas": 0.8,
              "fillAlphas": 0.8,
              "lineAlpha": 0.2,
              "type": "column",
              "valueField": "prod"
          }],
          "chartCursor": {
              "categoryBalloonEnabled": false,
              "cursorAlpha": 0,
              "zoomable": false
          },
          "categoryField": "vendor",
          "categoryAxis": {
              "gridPosition": "start",
              "gridAlpha": 0,
              "tickPosition": "start",
              "tickLength": 20
          },	"export":{
			"enabled":true
		}
      });

      var chart = AmCharts.makeChart("deploybar2", {
          "type": "serial",
          "theme": "none",
          "titles": [{
              "text": "Deployment by Environment"
          }],
		  /* "legend": {
              "position": "bottom",
              "valueText": '',
              "markerSize": 6,
              "valueWidth": 10 
          },*/
          "columnWidth": 0.8,
          "dataProvider": [{
              "field": "Develop",
              "value":  <?php $cursor = $deployment_collection->find(array("Deployment Successful"=>"Yes"));
                              $count = 0;
                              foreach($cursor as $cur){
                                  if($cur["env"]=="dev"){
                                      $count = $count + 1;
                                  }
                              }echo $count;
                          ?>
          }, {
              "field": "Test",
              "value": <?php $cursor = $deployment_collection->find(array("Deployment Successful" => "Yes"));
                              $count = 0;
                              foreach ($cursor as $cur) {
                                  if ($cur["env"] == "test") {
                                      $count = $count + 1;
                                  }
                              }
                              echo $count;

                          ?>
          }, {
              "field": "Pre-Prod",
              "value": <?php $cursor = $deployment_collection->find(array("Deployment Successful" => "Yes"));
                              $count = 0;
                              foreach ($cursor as $cur) {
                                  if ($cur["env"] == "preprod") {
                                      $count = $count + 1;
                                  }
                              }
                              echo $count;

                          ?>
          }, {
              "field": "Prod",
              "value": <?php  $cursor = $deployment_collection->find(array("Deployment Successful" => "Yes"));
                              $count = 0;
                              foreach ($cursor as $cur) {
                                  if ($cur["env"] == "prod") {
                                      $count = $count + 1;
                                  }
                              }
                              echo $count;

                          ?>
          }],
          "valueAxes": [{
              "gridColor": "#FFFFFF",
              "gridAlpha": 0.2,
              "dashLength": 0
          }],
		  "gridAboveGraphs": true,
          "startDuration": 1,
          "graphs": [{
              "balloonText": "[[category]]: <b>[[value]]</b>",
              "fillAlphas": 0.8,
              "lineAlpha": 0.2,
              "type": "column",
			  "valueField": "value"
          }],
          "chartCursor": {
              "categoryBalloonEnabled": false,
              "cursorAlpha": 0,
              "zoomable": false
          },
          "categoryField": "field",
		  "categoryAxis": {
              "gridPosition": "start",
              "gridAlpha": 0,
              "tickPosition": "start",
              "tickLength": 20
          },	"export":{
			"enabled":true
		}
      });

      var chart = AmCharts.makeChart("vendorpie", {
          "type": "pie",
          "theme": "light",
          "innerRadius": 30,
          "titles": [{
              "fontSize": 10,
              "text": "Deployed Components by Portfolios",
              "switchable": false
          }],
		  
          "legend": {
              "position": "right",
              "valueText": '',
              "switchable": false,
              "markerSize": 10,
              "fontSize": 10,
              "spacing": 1,
          },
         
          "autoMargins": false,
          "marginTop": 20,
          "marginBottom": 20,
          "marginLeft": 20,
          "marginRight": 20,
          "pullOutRadius": 10,
          "dataProvider": [<?php $cursor = $deployment_collection->distinct("Portfolio");
                                  $count = 0;
                              for ($i = 0; $i < sizeof($cursor); $i++) {
                                  $vendor = array("Portfolio" => $cursor[$i]);
                                  $maincursor = $deployment_collection->find($vendor);
                                  foreach($maincursor as $main){
                                      if($main["Portfolio"] == $cursor[$i]){
                                          $mainframe_components = $main["Mainframe_tech"];
                                          $windows_components = $main["Windows_tech"];
                                          $unix_components = $main["Unix_tech"];
                                          $java_components = $main["Java_tech"];
                                          $other_components = $main["Others"];
                                          $count = $mainframe_components + $windows_components + $unix_components + $java_components + $other_components + $count;
                                      }
                                  }
                                  echo '{"field":"' . $cursor[$i] . '",';
                                  echo '"value":' . $count . '},';
                                  $count = 0;
                              }
                              ?>],
          "valueField": "value",
          "titleField": "field",
          "startEffect": "elastic",
          "startDuration": 2,
          "labelRadius": 15,
          "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",	"export":{
			"enabled":true
		}

      });

      var chart = AmCharts.makeChart("techpie", {
          "type": "pie",
          "theme": "light",
          "innerRadius": 50,
          "titles": [{
              "fontSize": 10,
              "text": "Deployed Components by Technology",
              "switchable": false
          }],
          "legend": {
              "position": "right",
              "valueText": '',
              "switchable": false,
              "markerSize": 10,
              "fontSize": 10,
              "spacing": 1
          },
          "autoMargins": false,
          "marginTop": 20,
          "marginBottom": 20,
          "marginLeft": 20,
          "marginRight": 20,
          "pullOutRadius": 10,
          "dataProvider": [<?php
                                  $cursor = $deployment_collection->find(array("Deployment Successful"=>"Yes"));
                                  $mainframecount = 0;
                                  $javacount = 0;
                                  $windowscount = 0;
                                  $unixcount = 0;
                                  $others = 0;
                                  foreach($cursor as $cur){
                                         $mainframecount = $cur["Mainframe_tech"] + $mainframecount;
                                         $javacount = $cur["Java_tech"] + $javacount;
                                         $unixcount = $cur["Unix_tech"] + $unixcount;
                                         $others = $cur["Others"] + $others;
                                  }
                                  echo '{"field":"Mainframe"'.',';
                                  echo '"value":'.$mainframecount.'},';
                                  echo '{"field":"Java"' . ',';
                                  echo '"value":' . $javacount . '},';
                                  echo '{"field":"Windows Server"' . ',';
                                  echo '"value":' . $windowscount . '},';
                                  echo '{"field":"Unix"' . ',';
                                  echo '"value":' . $unixcount . '},';
                                  echo '{"field":"Others"' . ',';
                                  echo '"value":' . $others . '},';
                              ?>],
          "valueField": "value",
          "titleField": "field",
          "startEffect": "elastic",
          "startDuration": 2,
          "labelRadius": 15,
          "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
			"export":{
				"enabled":true
			}
      });

      var chart = AmCharts.makeChart("envpie", {
          "type": "pie",
          "theme": "light",
          "innerRadius": 50,
          "titles": [{
              "fontSize": 10,
              "text": "Deployed Components by Environment",
              "switchable": false
          }],
          "legend": {
              "position": "right",
              "valueText": '',
              "switchable": false,
              "markerSize": 10,
              "fontSize": 10,
              "spacing": 1
          },
          "autoMargins": false,
          "marginTop": 20,
          "marginBottom": 20,
          "marginLeft": 20,
          "marginRight": 20,
          "pullOutRadius": 10,
          "dataProvider": [<?php $cursor = $deployment_collection->distinct("env");
                              $count = 0;
                              for ($i = 0; $i < sizeof($cursor); $i++) {
                                  $env = array("env" => $cursor[$i]);
                                  $maincursor = $deployment_collection->find($env);
                                  foreach ($maincursor as $main) {
                                      if ($main["env"] == $cursor[$i]) {
                                          $mainframe_components = $main["Mainframe_tech"];
                                          $windows_components = $main["Windows_tech"];
                                          $unix_components = $main["Unix_tech"];
                                          $java_components = $main["Java_tech"];
                                          $other_components = $main["Others"];
                                          $count = $mainframe_components + $windows_components + $unix_components + $java_components + $other_components + $count;
                                      }
                                  }
                                  echo '{"field":"' . $cursor[$i] . '",';
                                  echo '"value":' . $count . '},';
                                  $count = 0;
                              }
                              ?>],
          "valueField": "value",
          "titleField": "field",
          "startEffect": "elastic",

          "startDuration": 2,
          "labelRadius": 15,
          "balloonText": "[[title]]<br><span style='font-size:8px'><b>[[value]]</b> ([[percents]]%)</span>",
			"export":{
				"enabled":true
			}
      });

      var chart = AmCharts.makeChart("bubblecomp", {
          "type": "xy",
          "theme": "light",
          "dataDateFormat": "DD/MM/YYYY",
          "startDuration": 1.5,
           autoMargins: false,
              marginTop: 10,
              marginBottom: 0,
              marginLeft: 27,
              marginRight: 10,
          "titles": [{
              "text": "Deployed Components Count"
          }],
		  
		  "labelsEnabled": true,
          "legend": [{
              "enabled": true,
              "marker": 2,
              "markerSize": 8,
			  "position": "top",
          }],

          "balloon": {
              "adjustBorderColor": false,
              "shadowAlpha": 0,
              "fixedPosition": true
          },
          "graphs": [{
              "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>Deployments:<b>[[y]]</b><br>Components:<b>[[value]]</b></div>",
              "bullet": "round",
              "bulletAlpha": 0.5,
              "id": "AmGraph-1",
              "title": "Dev",
              "lineAlpha": 0,
              "fillAlphas": 0,
              "valueField": "devValue",
              "xField": "date",
              "yField": "devy"
          }, {
              "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>Deployments:<b>[[y]]</b><br>Components:<b>[[value]]</b></div>",
              "bullet": "round",
              "bulletAlpha": 0.5,
              "id": "AmGraph-2",
              "title": "Test",
              "lineAlpha": 0,
              "fillAlphas": 0,
              "valueField": "testValue",
              "xField": "date",
              "yField": "testy"
          }, {
              "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>Deployments:<b>[[y]]</b><br>Components:<b>[[value]]</b></div>",
              "bullet": "round",
              "bulletAlpha": 0.5,
              "id": "AmGraph-3",
              "title": "Pre-Prod",
              "lineAlpha": 0,
              "fillAlphas": 0,
              "valueField": "preprodValue",
              "xField": "date",
              "yField": "preprody"
          }, {
              "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>Deployments:<b>[[y]]</b><br>Components:<b>[[value]]</b></div>",
              "bullet": "round",
              "bulletAlpha": 0.5,
              "id": "AmGraph-4",
              "title": "Prod",
              "lineAlpha": 0,
              "fillAlphas": 0,
              "valueField": "prodValue",
              "xField": "date",
              "yField": "prody"
          }],
          "valueAxes": [{
              "id": "ValueAxis-1",
              "axisAlpha": 0
          }, {
              "id": "ValueAxis-2",
              "axisAlpha": 0,
              "position": "bottom",
              "type": "date",
              "minimumDate": new Date(2014, 11, 31),
              "maximumDate": new Date(2015, 12, 31)
          }],
          "dataProvider": [
			<?php $cursor = $overlaybubble->find();
				  foreach($cursor as $cur){
					echo '{"date":"'.$cur['Month'].'",';
					echo '"devy":'.$cur['Dev'].',';
					echo '"prody":'.$cur['Prod'].',';
					echo '"testy":'.$cur['Pre_Prod'].',';
					echo '"preprody":'.$cur['Test'].',';
					echo '"devValue":'.$cur['Dev_comp'].',';
					echo '"prodValue":'.$cur['Prod_comp'].',';
					echo '"preprodValue":'.$cur['Pre_Prod_comp'].',';
					echo '"testValue":'.$cur['Test_comp'].'},';
				  }
			?>],	"export":{
			"enabled":true
		}
     });

      var chart = AmCharts.makeChart("failure2", {
          "type": "pie",
          "theme": "light",
          "titles": [{
              "text": "Deployment Failure by Vendor"
          }],
          "innerRadius": 50,
          "autoMargins": false,
          "marginTop": 0,
          "marginBottom": 0,
          "marginLeft": 0,
          "marginRight": 0,
		 "legend": {
              "position": "right",
			  "valueText": '',
              "switchable": false,
              "markerSize": 6,
              "fontSize": 10,
			  "valueWidth": 10,
              "spacing": 1,
          },
         
          "pullOutRadius": 10,
          "dataProvider": [<?php $cursor = $deployment_collection->find(array("Deployment Successful" => "No"));
                              $count = 0;
                              $count1 = 0;
                              $count2 = 0;
                              foreach ($cursor as $cur) {
                                  if ($cur["vendor"] == "capterraa") {
                                      $count = $count + 1;
                                  }
                                  if ($cur["vendor"] == "adroit_IT") {
                                      $count1 = $count1 + 1;
                                  }
                                  if ($cur["vendor"] == "Capgemini") {
                                      $count2 = $count2 + 1;
                                  }
                               }
                              echo '{"field":"test"' . ',';
                              echo '"value":' . $count . '},';
                              echo '{"field":"preprod"' . ',';
                              echo '"value":' . $count1 . '},';
                              echo '{"field":"prod"' . ',';
                              echo '"value":' . $count2 . '},';
                             ?>],
          "titleField": "field",
          "valueField": "value",	"export":{
			"enabled":true
		}
      });

      var chart = AmCharts.makeChart("failure3", {
          "type": "pie",
          "theme": "light",
          "titles": [{
              "text": "Failure by Top 5 Application"
          }],
          "dataProvider": [
			<?php  $cursor = $top5failapp->find();
					foreach($cursor as $cur){
						echo '{"title":"'.$cur['App_Name'].'",';
						echo '"value":'.$cur['Failure'].'},';
					}
			?>
			{
              "title": "PLIS",
              "value": 5
          }],
          "titleField": "title",
          "valueField": "value",
          "innerRadius": 50,
          "labelsEnabled": false,
          /*"autoMargins": false,
          "marginTop": 0,
          "marginBottom": 0,
          "marginLeft": 0,
          "marginRight": 0, */
		  "legend": {
                    "position": "right",
                    "valueText": '',
                    "markerSize": 6,
                    "valueWidth": 10,
                },

          "pullOutRadius": 10,	"export":{
			"enabled":true
		}
      });

      var chart = AmCharts.makeChart("negativechart", {
          "type": "serial",
          "theme": "light",
		  "labelsEnabled": false,
          "legend": [{
			  "position" : "right",
              "enabled": true,
              "marker": 2,
              "markerSize": 6,
			  "position": "top",
          }],
          "titles": [{
              "text": "Deployment and Failure by Application"
          }],
          "rotate": true,
          "marginBottom": 0,
          "dataProvider": [{
              "age": "PLIS",
              "Failure": -1,
              "Deployment": 07
          }, {
              "age": "STAT",
              "Failure": -2,
              "Deployment": 09
          }, {
              "age": "Carestat",
              "Failure": -3,
              "Deployment": 06
          }, {
              "age": "Finance",
              "Failure": -5,
              "Deployment": 08
          }, {
              "age": "Producer",
              "Failure": -4,
              "Deployment": 10
          }, {
              "age": "Informatica",
              "Failure": -8,
              "Deployment": 13
          }, {
              "age": "Bridging(FSC/TAM)",
              "Failure": -6,
              "Deployment": 19
          }, {
              "age": "AMI",
              "Failure": -8,
              "Deployment": 25
          }, {
              "age": "Download",
              "Failure": -9,
              "Deployment": 30
          }, {
              "age": "Advanced Claims",
              "Failure": -12,
              "Deployment": 36
          }, {
              "age": "Texas Town Code Service",
              "Failure": -12,
              "Deployment": 44
          }, {
              "age": "Quoting Producer Service",
              "Failure": -13,
              "Deployment": 48
          }, {
              "age": "EPICS",
              "Failure": -13,
              "Deployment": 51
          }, {
              "age": "BillingCenter",
              "Failure": -9,
              "Deployment": 48
          }, {
              "age": "ClaimCenter",
              "Failure": -8,
              "Deployment": 42
          }, {
              "age": "Audit-Control",
              "Failure": -11,
              "Deployment": 34
          }, {
              "age": "Agency Port",
              "Failure": -4,
              "Deployment": 41
          }, {
              "age": "Inbox",
              "Failure": -2,
              "Deployment": 48
          }],
          "startDuration": 1,
          "graphs": [{
              "fillAlphas": 0.8,
              "lineAlpha": 0.2,
              "type": "column",
              "valueField": "Deployment",
              "title": "Deployment",
              "labelText": "[[value]]",
              "clustered": false,
              "labelFunction": function(item) {
                  return Math.abs(item.values.value);
              },
              "balloonFunction": function(item) {
                  return item.category + ": " + Math.abs(item.values.value) + "%";
              }
          }, {
              "fillAlphas": 0.8,
              "lineAlpha": 0.2,
              "type": "column",
              "valueField": "Failure",
              "title": "Failure",
              "labelText": "[[value]]",
              "clustered": false,
              "labelFunction": function(item) {
                  return Math.abs(item.values.value);
              },
              "balloonFunction": function(item) {
                  return item.category + ": " + Math.abs(item.values.value) + "%";
              }
          }],
          "categoryField": "age",
          "categoryAxis": {
              "gridPosition": "start",
              "gridAlpha": 0.2,
              "axisAlpha": 0
          },
          "valueAxes": [{
              "gridAlpha": 0,
              "ignoreAxisWidth": true,
              "labelFunction": function(value) {
                  return Math.abs(value) + '%';
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
              "text": "Failure",
              "x": "25%",
              "y": "95%",
              "bold": true,
              "align": "up"
          }, {
              "text": "Deployment",
              "x": "90%",
              "y": "95%",
              "bold": true,
              "align": "up"
          }],	"export":{
			"enabled":true
		}
      });
      

            function exportCharts() {
          	  var firstPage = [];
          	  firstPage.push({
              		"text": "\n\n\n\n\n\nDevops\n\nImplementation - Recommendations\n\n",
    				"fontSize": 25,
    				"bold":true,
					"color": "#4e183e",
    				"alignment": "center"
              	  });
          	  firstPage.push({
					"text":"For Royal Bank of Canada",
					"fontSize":20,
					"color": "#3E2909",
					"alignment": "center",
    				"pageBreak": "after"						
              	  })
          	  var secondPage = [];
              	secondPage.push({
    				"text": "2\n",
    				"alignment": "right"
      	        });
              	secondPage.push({
    				"text": "RBC Delivery  & Need for DevOps Assessment\n\n\n\n",
					"alignment": "center",
					"bold":true,
					"color": "#3E2909",
					"font-family": "fantasy",
					"fontSize": 16
      	        });
              	secondPage.push({
                  	"columns":[{
                      	"width":"5%",
                      	"text":"1.",
                      	"fontSize":12
                  	},{
                      	"width":"*",
                  		"text": "RBC Mainframe Delivery team predominantly employs waterfall delivery model.\n",
                  		"fontSize":12,
					 	"alignment":"justify"
                  	}],
                    "columnGap": 2    				
      	        });
              	secondPage.push({
                  	"columns":[{
                      	"width":"5%",
                      	"text":"2.",
                      	"fontSize":12
                  	},{
                      	"width":"*",
                  		"text": "RBC wants to fasten its time to market and achieve quicker turn around time for its release  cycle.\n",
                  		"fontSize":12,
					 	"alignment":"justify"
                  	}],
                    "columnGap": 2    				
      	        });
              	secondPage.push({
                  	"columns":[{
                      	"width":"5%",
                      	"text":"3.",
                      	"fontSize":12
                  	},{
                      	"width":"*",
                  		"text": "RBC is looking at how DevOps methodology for mainframes can help them.\n",
                  		"fontSize":12,
					 	"alignment":"justify" 
                  	}],
                    "columnGap": 2   				
      	        });
              	secondPage.push({
                  	"columns":[{
                      	"width":"5%",
                      	"text":"4.",
                      	"fontSize":12
                  	},{
                      	"width":"*",
                  		"text": "Mainframes are an ideal location for processing information in a scalable and secure way. This flexibility makes them an excellent resource for organizations like RBC seeking to optimize their agility and hence a DevOps Assessment is pertinent.\n\n",
                  		"fontSize":12,
					 	"alignment":"justify"   
                  	}],
                    "columnGap": 2 				
      	        });
              	secondPage.push({
                  	"columns":[{
                      	"width":"5%",
                      	"text":"5.",
                      	"fontSize":12
                  	},{
                      	"width":"*",
                  		"text": "Capgemini' s DevOps expertise is utilized for conducting a DevOps  Assessment to determine the current maturity levels of RBC Delivery and how it can implement DevOps through specific Tool chain recommendations.\n",
                  		"fontSize":12,
					 	"alignment":"justify"
                  	}],
                    "columnGap": 2    				
      	        });
              	secondPage.push({
                  	"columns":[{
                      	"width":"5%",
                      	"text":"6."
                  	},{
                      	"width":"*",
                  		"text": "This assessment is performed for one LOB for RBC- their Retail portfolio.\n\n",
                  		"fontSize":12,
					 	"alignment":"justify" 
                  	}],
                    "columnGap": 2,
                    "pageBreak": "after"   				
      	        });

              	var thirdPage = [];
              	var chart0 = AmCharts.charts[0];
              	
          	    thirdPage.push({
    				"text": "Assessment Report\n\n",
					"bold":true,
					"color": "#3E2909",
    				"fontSize": 18,
					"alignment": "center"
      	        });
          	  	
              	chart0.export.capture( {}, function() {
            	      this.toJPG( {
            	        multiplier: 4
            	      }, function( data ) {
                          	  thirdPage.push({
                          		"image": data,
                    	        "fit": [ 523.28, 769.89 ]
                	          });
            	      } );
          	    } ); 

              	var thirdPageTable = [];
				thirdPageTable.push({
					"text":"\n\nAssessment Score\n\n",
					"bold":true,
					"color": "#3E2909",
					"fontSize":18,
					 "alignment": "center"
					})
          	    thirdPageTable.push({
          	    	"alignment": "center",
					"table": {
          	    	    "headerRows": 1,
						"widths": ["*", "*", "*"],
						"body": [
          	    	      ["Phase", "Current Score", "Desired Score"],
          	    	      ["Culture/Organisation", "<?php echo $_SESSION['avgcur1']?>", "5"],
          	    	      ["Build, Integration & Release", "<?php echo $_SESSION['avgcur2']?>", "5"],
          	    	      ["Data Management", "<?php echo $_SESSION['avgcur3']?>", "5"],
        	    	      ["Quality Managemen", "<?php echo $_SESSION['avgcur4']?>", "5"],
          	    	      ["Collaborate/Monitor", "<?php echo $_SESSION['avgcur5']?>", "5"]
          	    	    ]
          	    	  },
                      "pageBreak": "after" 
              	    });

				var forthPage = [];
				 forthPage.push({
	  				"text": "4\n",
	  				"alignment": "right"
	    	        });
	              forthPage.push({
	            	  "text": "\n\nAssess: Organization Culture at RBC\n\n\n",
	  				  "fontSize": 18,
					  "alignment": "center",
					  "color": "#3E2909",
					  "bold":true
	                  });
				forthPage.push({
          	    	"table": {
          	    	    "headerRows": 1,
						 "bold":true,
          	    	    "widths": ["33%", "33%", "35%"],
          	    	    "body": [
          	    	      ["Observations", "Actions Recommended", "Benefits"],
          	    	      ["Teams organized based on Technology / scope of work (development and maintenance)", "DevOps and Agile coaching for all associates", "Enables stakeholders to get accustomed with the end product much earlier and refine the requirements accordingly"],
						  ["Many teams with hierarchical structure having targeted end goals", "Migrate to Agile methodologies", "Better working relationship  model through a unified collaboration tool"],
                          ["Multiple tools for collaboration","Adopt an enterprise wide collaboration tool","Greater visibility and transparency among teams and the work in progress"],          	    	   
                          ["Frequent & delayed requirements freeze in waterfall model, causing additional effort for development and testing","Establish centralized approval process and strict governance mechanism for development & maintenance projects","Early identification of defects and incidents"],          	    	   
                          [" "," ","Bring key participants as one team with common goal as delivery to production"]          	    	   
					   ]
          	    	  },
                      "pageBreak": "after" 
              	    });	
					
			/*	var forthPage = [];
	              forthPage.push({
	  				"text": "4\n",
	  				"alignment": "right"
	    	        });
	              forthPage.push({
	            	  "text": "Assess: Organization Culture at RBC\n\n\n\n\n",
	  				  "fontSize": 16,
					  "alignment": "center",
					  "bold":true
	                  });
	              forthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Observations",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "33%",
						    "text":"Actions Recommended",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "*",
						    "text":"Benefits\n\n\n",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
							}],
		                    "columnGap": 10
						});
	              forthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Teams organized based on Technology / scope of work (development and maintenance)",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"DevOps and Agile coaching for all associates",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Enables stakeholders to get accustomed with the end product much earlier and refine the requirements accordingly\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              forthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Many teams with hierarchical structure having targeted end goals",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Migrate to Agile methodologies",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Better working relationship  model through a unified collaboration tool\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              forthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Multiple tools for collaboration",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Adopt an enterprise wide collaboration tool",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Greater visibility and transparency among teams and the work in progress\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              forthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Frequent & delayed requirements freeze in waterfall model, causing additional effort for development and testing",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Establish centralized approval process and strict governance mechanism for development & maintenance projects",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Early identification of defects and incidents\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              forthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Bring key participants as one team with common goal as delivery to production\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10,						
		                    "pageBreak": "after"
						});*/

	             /* var fifthPage = [];
	              fifthPage.push({
	  				"text": "5\n",
					"alignment": "center"
					});
	              fifthPage.push({
	            	  "text": ": Build, Integration & release\n\n\n",
	  				  "fontSize": 26,
					  "alignment": "center",
					  "color": "#3E2909",
					  "bold":true
	                  });
	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Observations",
							"fontSize":14,
							"alignment": "center"
						  }, {
						    "width": "33%",
						    "text":"Actions Recommended",
							"fontSize":14,
							
							"alignment": "center"
						  }, {
						    "width": "*",
						    "text":"Benefits\n\n\n",
							"fontSize":14,
							
							"alignment": "center"
							}],
		                    "columnGap": 10
						});
	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Significant effort spent on manual Impact analysis; Current code analyzer tool (Revolve) is unsupported and rarely used by the team",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Adopt an static analyzer tool to perform static code analysis",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduced effort during impact analysis\n\n\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Current SCM (Endeavor) do not support parallel development",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Perform scheduled code impoverishments and remove dead code and functionality",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Identification of indirect impact at one go\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Code reviews done manually",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Implement code review checklist tool with SCM Tool during every promotion from development region",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Availability of documentation  repository\n\n\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Limited availability of documentation across teams",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Develop optimum documentation required to improve impact analysis timeframe",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduced development effort by eliminating common defects with help of IDEs\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Limited business documentation for the applications",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Operations and delivery teams to efficiently collaborate to manage risks and reduce cycle time",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Improved time to market by enabling parallel development\n\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Longer release duration",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Automate deployment audits, logging and verification using custom scripts/COTS products",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Provides rapid feedback loop to catch integration issues and unintended side effects\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});
					
	            /*  fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Integrated code quality verification using dedicated IDEs",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduced overall IT life cycle timeframe\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10,
		                    "pageBreak": "after"
						});*/

	              var sixthPage = [];
	              sixthPage.push({
	  				"text": "5\n",
	  				"alignment": "right"
	    	        });
	              sixthPage.push({
	            	  "text": "Assess: Data Management\n\n\n",
	  				  "fontSize": 18,
					  "alignment": "center",
					  "color": "#3E2909",
					  "bold":true
	                  });
	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Observations",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "33%",
						    "text":"Actions Recommended",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "*",
						    "text":"Benefits\n\n\n",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
							}],
		                    "columnGap": 10
						});
	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Significant effort spent on test data preparation at various stages of testing (Unit, QA, IST)",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Data masking of production data to development & test regions",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduced testing timeframe by automated regression test data\n\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Production/Production-like data not available for developers to foresee defects in development region",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Automated generation of production like data",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduction in defects as production like data is available for developers to test exhaustively\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Manual data creation by associates leading to unknown defects",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Frequent and scheduled data refresh across development & test regions",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Improved test coverage by enforcing it as part of SCM tool\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Dependency of SMEs to understand complexity involved in data creation",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Automated regression test bed creation for enabling automated testing",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Simplified Data refresh and maintenance\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Automated test coverage verification to validate the integrity of test data and enforce it as part of SCM tool",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Higher quality assurance as testing performed on prod-like data\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10,						
		                    "pageBreak": "after"
						});

	              var fifthPage = [];
	              fifthPage.push({
	  				"text": "5\n",
	  				"alignment": "right"
	    	        });
	              fifthPage.push({
	            	  "text": "\nAssess: Build, Integration & release\n\n",
	  				  "fontSize": 18,
					  "alignment": "center",
					  "color": "#3E2909",
					  "bold":true
					  
	                  });
	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Observations",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "33%",
						    "text":"Actions Recommended",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "*",
						    "text":"Benefits\n\n\n",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
							}],
		                    "columnGap": 10
						});
	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Significant effort spent on manual Impact analysis; Current code analyzer tool (Revolve) is unsupported and rarely used by the team",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Adopt an static analyzer tool to perform static code analysis",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduced effort during impact analysis\n\n\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Current SCM (Endeavor) do not support parallel development",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Perform scheduled code impoverishments and remove dead code and functionality",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Identification of indirect impact at one go\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Code reviews done manually",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Implement code review checklist tool with SCM Tool during every promotion from development region",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Availability of documentation  repository\n\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Limited availability of documentation across teams",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Develop optimum documentation required to improve impact analysis timeframe",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduced development effort by eliminating common defects with help of IDEs\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Limited business documentation for the applications",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Operations and delivery teams to efficiently collaborate to manage risks and reduce cycle time",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Improved time to market by enabling parallel development\n\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Longer release duration",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Automate deployment audits, logging and verification using custom scripts/COTS products",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Provides rapid feedback loop to catch integration issues and unintended side effects\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});
					
	              fifthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Integrated code quality verification using dedicated IDEs",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduced overall IT life cycle timeframe\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10,
		                    "pageBreak": "after"
						});

	              var sixthPage = [];
	              sixthPage.push({
	  				"text": "6\n",
	  				"alignment": "right"
	    	        });
	              sixthPage.push({
	            	  "text": "Assess: Data Management\n\n\n",
	  				  "fontSize": 18,
					  "alignment": "center",
					  "color": "#3E2909",
					  "bold":true
	                  });
	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Observations",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "33%",
						    "text":"Actions Recommended",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "*",
						    "text":"Benefits\n\n\n",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
							}],
		                    "columnGap": 10
						});
	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Significant effort spent on test data preparation at various stages of testing (Unit, QA, IST)",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Data masking of production data to development & test regions",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduced testing timeframe by automated regression test data\n\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Production/Production-like data not available for developers to foresee defects in development region",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Automated generation of production like data",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduction in defects as production like data is available for developers to test exhaustively\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Manual data creation by associates leading to unknown defects",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Frequent and scheduled data refresh across development & test regions",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Improved test coverage by enforcing it as part of SCM tool\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Dependency of SMEs to understand complexity involved in data creation",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Automated regression test bed creation for enabling automated testing",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Simplified Data refresh and maintenance\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              sixthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Automated test coverage verification to validate the integrity of test data and enforce it as part of SCM tool",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Higher quality assurance as testing performed on prod-like data\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10,						
		                    "pageBreak": "after"
						});

	              var seventhPage = [];
	              seventhPage.push({
	  				"text": "7\n",
	  				"alignment": "right"
	    	        });
	              seventhPage.push({
	            	  "text": "Assess: Quality Management\n\n\n",
	  				  "fontSize": 18,
					  "alignment": "center",
					  "color": "#3E2909",
					  "bold":true
	                  });
	              seventhPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Observations",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "33%",
						    "text":"Actions Recommended",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "*",
						    "text":"Benefits\n\n\n",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
							}],
		                    "columnGap": 10
						});
	              seventhPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Significant effort spent on testing manually, in all regions",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Prepare scripts to automate tests using custom or COTS products",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Early identification of quality concerns and reduction of defects across life cycle\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              seventhPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Scope to automate non functional tests like performance, security, auditing, etc",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Enable test output validation through custom scripts",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Optimal effort and cost spent for  testing\n\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              seventhPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Manual verification of test results",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Verify unit test coverage using test data coverage tools",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Achieve increased application  delivery velocity by enabling automated tests\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              seventhPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Code coverage are manually validated",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Enable service virtualization for testing to reduce dependency with interfacing systems",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduction in overall effort and time consumed during various testing phases\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              seventhPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Dependencies between front office and back office applications during development (2 speed IT)",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Reduce defect turn around time by automated regression testing",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"\n\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              seventhPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"\nSignificant time gap between defect identification and retest",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"",
							"fontSize":12
							}],
		                    "columnGap": 10,						
		                    "pageBreak": "after"
						});

	              var eighthPage = [];
	              eighthPage.push({
	  				"text": "8\n",
	  				"alignment": "right"
	    	        });
	              eighthPage.push({
	            	  "text": "Assess: Collaboration\n\n\n",
	  				 "fontSize": 18,
					  "alignment": "center",
					  "color": "#3E2909",
					  "bold":true
	                  });
	              eighthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Observations",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "33%",
						    "text":"Actions Recommended",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
						  }, {
						    "width": "*",
						    "text":"Benefits\n\n\n",
							"fontSize":14,
							"bold":true,
							"alignment": "center"
							}],
		                    "columnGap": 10
						});
	              eighthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Identified scope for improvement across teams on information & interactions",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Enable one stop collaboration and documentation management COTS product",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Identification of defects at early stages due to collaboration\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              eighthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Currently limited collaboration achieved within teams via multiple COTS products such as SharePoint, HP-QC, HP-SM, SM9, Rally and etc",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Establish streamlined approval mechanism within collaboration tool for increased accountability",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Ability to trace deliverables at all phases across the teams\n\n\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              eighthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Minimal visibility to teams on outcomes of cross-functional meetings",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Ensure seamless information flow across the teams through the chosen collaboration tool",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Logging and tracking of all systematic approvals and information sharing through one scalable platform\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              eighthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"Approvals, code reviews, test reviews, etc. tracked in e-mails",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Generate and track the progress of delivery",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Achieve greater visibility and transparency among teams\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10
						});

	              eighthPage.push({
						"columns": [{
						    "width": "33%",
						    "text":"",
							"fontSize":12
						  }, {
						    "width": "33%",
						    "text":"Ensure complete team participation in cross functional discussions",
							"fontSize":12
						  }, {
						    "width": "*",
						    "text":"Reduction in overall timeframe by avoiding waiting time & loss of communication\n\n\n",
							"fontSize":12
							}],
		                    "columnGap": 10,						
		                    "pageBreak": "after"
						});

					var ninethPage = [];
					ninethPage.push({
		  				"text": "9\n",
		  				"alignment": "right"
		    	        });

					ninethPage.push({
	              		"text": "\n\n\n\n\n\nRecommendations\nAnd\nROI Analysis\n",
	    				"fontSize": 25,
						"bold":true,
						"color": "#4e183e",
						"alignment": "center",
	    				"pageBreak": "after"
	              	  });

			var tenthPage = [];	
			tenthPage.push({
  				"text": "10\n",
  				"alignment": "right"
    	        });
              tenthPage.push({
            	  "text": "\nRecommendation 1	- Development & Test Offloading\n\n\n\n",
  				      "fontSize": 18,
					  "alignment": "center",
					  "color": "#3E2909",
					  "bold":true
                  });
              tenthPage.push({
					"columns": [{
					    "width": "33%",
					    "text":"Understandings",
						"fontSize":14,
						"bold":true,
						"alignment": "center"
					  }, {
					    "width": "33%",
					    "text":"Actions Recommended",
						"fontSize":14,
						"bold":true,
						"alignment": "center"
					  }, {
					    "width": "*",
					    "text":"Benefits\n\n\n",
						"fontSize":14,
						"bold":true,
						"alignment": "center"
						}],
	                    "columnGap": 10
					});
              tenthPage.push({
					"columns": [{
					    "width": "33%",
					    "text":"Around 25% of overall MIPS consumed by test and development regions",
						"fontSize":12
					  }, {
					    "width": "33%",
					    "text":"Phase out the development and test region from Mainframes",
						"fontSize":12
					  }, {
					    "width": "*",
					    "text":"MIPS consumption by development and test region can be leveraged for Production\n\n",
						"fontSize":12
						}],
	                    "columnGap": 10
					});

              tenthPage.push({
					"columns": [{
					    "width": "33%",
					    "text":"Around 25% of overall MIPS consumed by test and development regions",
						"fontSize":12
					  }, {
					    "width": "33%",
					    "text":"Phase out the development and test region from Mainframes",
						"fontSize":12
					  }, {
					    "width": "*",
					    "text":"MIPS consumption by development and test region can be leveraged for Production\n\n",
						"fontSize":12
						}],
	                    "columnGap": 10
					});

              tenthPage.push({
					"columns": [{
					    "width": "33%",
					    "text":"300+ users work actively on development and test regions",
						"fontSize":12
					  }, {
					    "width": "33%",
					    "text":"Host the offloaded regions on a Windows/AIX based platform",
						"fontSize":12
					  }, {
					    "width": "*",
					    "text":"Improvement in productivity of users working actively in development region\n\n",
						"fontSize":12
						}],
	                    "columnGap": 10
					});

              tenthPage.push({
					"columns": [{
					    "width": "33%",
					    "text":"DB2/IMS/VSAM are the primarily used databases",
						"fontSize":12
					  }, {
					    "width": "33%",
					    "text":"Enable modern IDE based development",
						"fontSize":12
					  }, {
					    "width": "*",
					    "text":"Reduction in overall mainframe MIPS cost\n",
						"fontSize":12
						}],
	                    "columnGap": 10
					});

              tenthPage.push({
					"columns": [{
					    "width": "33%",
					    "text":"Manual development, unit testing and code reviews using 3270 based screens",
						"fontSize":12
					  }, {
					    "width": "33%",
					    "text":"Integrated code quality verification using dedicated IDEs",
						"fontSize":12
					  }, {
					    "width": "*",
					    "text":"Reduction in production & test region elapsed time\n\n\n",
						"fontSize":12
						}],
	                    "columnGap": 10
					});

              tenthPage.push({
					"columns": [{
					    "width": "33%",
					    "text":"Elimination of green screen development for  younger workforce",
						"fontSize":12
					  }, {
					    "width": "33%",
					    "text":"",
						"fontSize":12
					  }, {
					    "width": "*",
					    "text":"Elimination of green screen development for  younger workforce\n\n",
						"fontSize":12
						}],
	                    "columnGap": 10
					});

				var tenthPage1 = [];
               var chart1 = AmCharts.charts[1]; 				
               tenthPage1.push({
  				"text": "\n\n\n\n\nDev-Test Offloading ROI Analysis\n\n\n",
  				"fontSize": 18,
				"alignment": "center"
    	        }); 
				
                  
            	chart1.export.capture( {}, function() {
          	      this.toJPG( {
          	        multiplier: 8
          	      }, function( data ) {
          	    	  tenthPage1.push({
                        		"image": data,
                  	        "fit": [ 523.28, 769.89 ]
                  	      });
          	      });
        	    });
				
				
              	
          var eleventhPage = [];
			eleventhPage.push({
  				"text": "11\n",
  				"alignment": "right"
    	        });
			var chart2 = AmCharts.charts[2];

        
        eleventhPage.push({
      	  "text": "\n\n\n\n\n\nRecommendation 2 - Test and Data Setup Automation\n\n\n\n",
			  "fontSize": 18,
			  "alignment": "center",
			  "color": "#3E2909",
			  "bold":true
            });
        eleventhPage.push({
				"columns": [{
				    "width": "33%",
				    "text":"Understandings",
					"fontSize":14,
					"bold":true,
					"alignment": "center"
				  }, {
				    "width": "33%",
				    "text":"Actions Recommended",
					"fontSize":14,
					"bold":true,
					"alignment": "center"
				  }, {
				    "width": "*",
				    "text":"Benefits\n\n\n",
					"fontSize":14,
					"bold":true,
					"alignment": "center"
					}],
                  "columnGap": 10
				});
        eleventhPage.push({
				"columns": [{
				    "width": "33%",
				    "text":"Manual testing performed in all test regions for functionalities involving mainframes",
					"fontSize":12
				  }, {
				    "width": "33%",
				    "text":"Induce end to end automation for testing in mainframe based functionalities",
					"fontSize":12
				  }, {
				    "width": "*",
				    "text":"Achieve increased application  delivery velocity by enabling automated tests\n\n",
					"fontSize":12
					}],
                  "columnGap": 10
				});

        eleventhPage.push({
				"columns": [{
				    "width": "33%",
				    "text":"Dependencies on external interfaces for inputs and outputs",
					"fontSize":12
				  }, {
				    "width": "33%",
				    "text":"Enable service virtualization for testing to reduce dependency with interfacing systems",
					"fontSize":12
				  }, {
				    "width": "*",
				    "text":"Reduction in production incidents & system testing defects by shifting left (using prod like data for unit & system testing)\n\n",
					"fontSize":12
					}],
                  "columnGap": 10
				});

        eleventhPage.push({
				"columns": [{
				    "width": "33%",
				    "text":"Manual process to generate data for tests in all regions",
					"fontSize":12
				  }, {
				    "width": "33%",
				    "text":"Enable automation for output validation, test coverage, etc.",
					"fontSize":12
				  }, {
				    "width": "*",
				    "text":"Reduce defect turn around time by automated regression testing\n\n",
					"fontSize":12
					}],
                  "columnGap": 10
				});

        eleventhPage.push({
				"columns": [{
				    "width": "33%",
				    "text":"1 or more data owners for each test region for data refresh",
					"fontSize":12
				  }, {
				    "width": "33%",
				    "text":"Enable of automation of production like data availability in all dev/test regions",
					"fontSize":12
				  }, {
				    "width": "*",
				    "text":"Seamless development/testing through service virtualization\n",
					"fontSize":12
					}],
                  "columnGap": 10
				});

        eleventhPage.push({
				"columns": [{
				    "width": "33%",
				    "text":"Dependency on SMEs to understand complexity involved in data creation",
					"fontSize":12
				  }, {
				    "width": "33%",
				    "text":"Data masking of sensitive data from production data stores",
					"fontSize":12
				  }, {
				    "width": "*",
				    "text":"Simplified Data refresh and maintenance\n\n\n",
					"fontSize":12
					}],
                  "columnGap": 10
				});

        eleventhPage.push({
				"text": "\n\n\n\n\n\nTest and Data Setup Automation ROI analysis\n\n",
				"fontSize": 18,
				"alignment": "center",
			});
    	  	
        	chart2.export.capture( {}, function() {
      	      this.toJPG( {
      	        multiplier: 2
      	      }, function( data ) {
      	    	  eleventhPage.push({
                    		"image": data,
              	        "fit": [ 523.28, 769.89 ]
          	          });
      	      } );
    	    } ); 


            var twelvethPage = [];
    		twelvethPage.push({
    				"text": "12\n",
    				"alignment": "right"
    	        });   

            twelvethPage.push({
            	  "text": "\n\nRecommendation 3 - CI CD Implementation\n\n\n\n",
            	  "fontSize": 18,
				  "alignment": "center",
				  "color": "#3E2909",
				  "bold":true
                });
            twelvethPage.push({
            		"columns": [{
            		    "width": "33%",
            		    "text":"Understandings",
            			"fontSize":14,
            			"bold":true,
            			"alignment": "center"
            		  }, {
            		    "width": "33%",
            		    "text":"Actions Recommended",
            			"fontSize":14,
            			"bold":true,
            			"alignment": "center"
            		  }, {
            		    "width": "*",
            		    "text":"Benefits\n\n\n",
            			"fontSize":14,
            			"bold":true,
            			"alignment": "center"
            			}],
                      "columnGap": 10
            		});
            twelvethPage.push({
            		"columns": [{
            		    "width": "33%",
            		    "text":"Waterfall model based delivery",
            			"fontSize":12
            		  }, {
            		    "width": "33%",
            		    "text":"Migrate to Agile methodologies",
            			"fontSize":12
            		  }, {
            		    "width": "*",
            		    "text":"Enables stakeholders to get accustomed with the end product much earlier and refine the requirements accordingly\n\n",
            			"fontSize":12
            			}],
                      "columnGap": 10
            		});
            
            twelvethPage.push({
            		"columns": [{
            		    "width": "33%",
            		    "text":"Release duration ranges from 1 month to more than 1 year",
            			"fontSize":12
            		  }, {
            		    "width": "33%",
            		    "text":"Adopt an enterprise wide collaboration tool",
            			"fontSize":12
            		  }, {
            		    "width": "*",
            		    "text":"Enabling transparency and traceability by unified collaboration tool\n\n",
            			"fontSize":12
            			}],
                      "columnGap": 10
            		});
            
            twelvethPage.push({
            		"columns": [{
            		    "width": "33%",
            		    "text":"Long and manual process to promote code to next regions",
            			"fontSize":12
            		  }, {
            		    "width": "33%",
            		    "text":"Adopt an static analyzer tool to perform static code analysis",
            			"fontSize":12
            		  }, {
            		    "width": "*",
            		    "text":"Reduced overall IT life cycle timeframe\n\n\n",
            			"fontSize":12
            			}],
                      "columnGap": 10
            		});
            
            twelvethPage.push({
            		"columns": [{
            		    "width": "33%",
            		    "text":"Multiple collaboration tools used",
            			"fontSize":12
            		  }, {
            		    "width": "33%",
            		    "text":"Enable of automation of code  integrations and code deployments",
            			"fontSize":12
            		  }, {
            		    "width": "*",
            		    "text":"Enabling parallel development  across development & maintenance community\n\n",
            			"fontSize":12
            			}],
                      "columnGap": 10
            		});
            
            twelvethPage.push({
            		"columns": [{
            		    "width": "33%",
            		    "text":"Code analysis, development, integration and unit testing done manually",
            			"fontSize":12
            		  }, {
            		    "width": "33%",
            		    "text":"Adopt parallel development",
            			"fontSize":12
            		  }, {
            		    "width": "*",
            		    "text":"\n\n\n\n",
            			"fontSize":12
            			}],
                      "columnGap": 10
            		});

            var chart3 = AmCharts.charts[3];        	
    		twelvethPage.push({
    			"text": "\n\n\n\n\n\nCI-CD ROI Analysis\n\n\n\n",
    			"fontSize": 18,
				  "alignment": "center",
				  "color": "#3E2909",
				  "bold":true
				
            });
    	  	
        	chart3.export.capture( {}, function() {
      	      this.toJPG( {
      	        multiplier: 2
      	      }, function( data ) {
      	    	  twelvethPage.push({
                    		"image": data,
              	            "fit": [ 523.28, 769.89 ]
						});
      	      } );
    	    } );
			
			

            var thirteenpage = [];
        	var chart4 = AmCharts.charts[4]; 
			thirteenpage.push({
    			"text": "\n\n\n\n\n\n\n\n\nCriticality\n\n",
    			"fontSize": 18,
				  "alignment": "center",
				  "color": "#3E2909",
				  "bold":true
				
            });
        	chart4.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 1
        	      }, function( data ) {
        	    	  thirteenpage.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    });
			
			var fifteen = [];
			var chart16 = AmCharts.charts[5]; 
			fifteen.push({
    			"text": "\n\nSDLC Methodology\n\n",
    			"fontSize": 18,
				  "alignment": "center",
				  "color": "#3E2909",
				  "bold":true
				
            });
        	chart16.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 1
        	      }, function( data ) {
        	    	  fifteen.push({
                      		"image": data,
                	        "fit": [523.28, 769.89]
            	          });
        	           });
      	           });
				   
			var sixteen = [];
			var chart6 = AmCharts.charts[6]; 
			sixteen.push({
    			"text": "\n\n\n\nSDLC\n\n",
    			"fontSize": 18,
				  "alignment": "center",
				  "color": "#3E2909",
				  "bold":true
				
            });
			chart6.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  sixteen.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
			
			//practice for chart 18
			var lastPages = [];
        	
        	var chart7 = AmCharts.charts[7]; 
        	chart7.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart8 = AmCharts.charts[8]; 
        	chart8.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart9 = AmCharts.charts[9]; 
        	chart9.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart10 = AmCharts.charts[10]; 
        	chart10.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart11 = AmCharts.charts[11]; 
        	chart11.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart12 = AmCharts.charts[12]; 
        	chart12.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart13 = AmCharts.charts[13]; 
        	chart13.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart14 = AmCharts.charts[14]; 
        	chart14.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart15 = AmCharts.charts[15]; 
        	chart15.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	
        	var chart17 = AmCharts.charts[17]; 
        	chart17.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
			
			
        	var chart19 = AmCharts.charts[19]; 
        	chart19.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart20 = AmCharts.charts[20]; 
        	chart20.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart21 = AmCharts.charts[21]; 
        	chart21.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart22 = AmCharts.charts[22]; 
        	chart22.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart23 = AmCharts.charts[23]; 
        	chart23.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart24 = AmCharts.charts[24]; 
        	chart24.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
        	var chart25 = AmCharts.charts[25]; 
        	chart25.export.capture( {}, function() {
        	      this.toJPG( {
        	        multiplier: 2
        	      }, function( data ) {
        	    	  lastPages.push({
                      		"image": data,
                	        "fit": [ 523.28, 769.89 ]
            	          });
        	      } );
      	    } );
			
			
        	
			var twelvethPagechart = [];
			twelvethPagechart.push({
          	    	"table": {
          	    	    "headerRows": 1,
					    "alignment": "center",
          	    	    "widths": ["25%","25%"],
					    "text" : "\n\n Table Chart\n\n\n\n\n",
					    "body": [
						  ["Data", "Value"],
          	    	      ["Gains from new functionality", "<?php echo $gtm ?>"],
          	    	      ["Gains from headcount waste", "<?php echo $ghc?>"],
          	    	      ["Gains from increased quality", "<?php echo $gql?>"],
        	    	      ["Quality Management", "<?php echo $gfx ?>"]
          	    	    ]
          	    	  } 
              	    });
					
					var thirteenpagechart = [];
					thirteenpagechart.push({
          	    	"table": {
          	    	    "headerRows": 1,
          	    	    "widths": ["20%","20%"],
						"alignment": "center",
					    "body": [
						  ["access", "Data"],
          	    	      ["Larger", "<?php $cursor = $application_collection->find(array('Criticality'=>'High'));
                                $count=0;
                                foreach($cursor as $cur){
                                    $count = $count + 1;
                                }echo $count;
                                ?>"],
						["Lowest", "<?php $cursor = $application_collection->find(array('Criticality'=>'Medium'));
						$count=0;
						foreach($cursor as $cur){
							$count = $count + 1;
						}echo $count;
						?>"],
						["Moderate", "<?php $cursor = $application_collection->find(array('Criticality'=>'Low'));
						$count=0;
						foreach($cursor as $cur){
							$count = $count + 1;
						}echo $count;
						?>"],
          	    	            ]
          	    	  }
              	    });	
				//start	
				//Data is for deployment by environment chart chart number[18]	
				var eighteenPage = [];
				var chart18 = AmCharts.charts[18]; 
				eighteenPage.push({
					"text": "\n\n\npractice\n\n",
					"fontSize": 15,
					  "alignment": "center",
					  "color": "#3E2909",
					  "bold":true
					
				});
				
				chart18.export.capture( {}, function() {
					  this.toJPG( {
						multiplier: 2
					  }, function( data ) {
						  eighteenPage.push({
								"image": data,
								"fit": [ 523.28, 769.89 ]
							  });
					  });
				});
					
					var eighteenPagechart = [];
					eighteenPagechart.push({
          	    	"table": {
          	    	    "headerRows": 1,
          	    	    "widths": ["20%","20%"],
						"alignment": "center",
					    "body": [
						  ["access", "Data"],
          	    	      ["Devlop", "<?php $cursor = $deployment_collection->find(array("Deployment Successful"=>"Yes"));
                              $count = 0;
                              foreach($cursor as $cur){
                                  if($cur["env"]=="dev"){
                                      $count = $count + 1;
                                  }
                              }echo $count;
                          ?>"],
						 ["Test", "<?php $cursor = $deployment_collection->find(array("Deployment Successful" => "Yes"));
                              $count = 0;
                              foreach ($cursor as $cur) {
                                  if ($cur["env"] == "test") {
                                      $count = $count + 1;
                                  }
                              }
                              echo $count;

                          ?>"],
						["Pre-Prod", "<?php $cursor = $deployment_collection->find(array("Deployment Successful" => "Yes"));
                              $count = 0;
                              foreach ($cursor as $cur) {
                                  if ($cur["env"] == "preprod") {
                                      $count = $count + 1;
                                  }
                              }
                              echo $count;

                          ?>"],
                        ["Prod", "<?php  $cursor = $deployment_collection->find(array("Deployment Successful" => "Yes"));
                              $count = 0;
                              foreach ($cursor as $cur) {
                                  if ($cur["env"] == "prod") {
                                      $count = $count + 1;
                                  }
                              }
                              echo $count;

                          ?>"],						
          	    	            ]
          	    	  }
              	    });	
					
					var tenthPageOne = [];
					tenthPageOne.push({
					"text":"\nDev-Test Offloading ROI Analysis\n\n",
					"bold":true,
					"color": "#3E2909",
					"fontSize":16,
					"labelsEnabled": false,
					 "legend": {
						"position": "right",
						"valueText": '',
						"markerSize": 6,
						"valueWidth": 10,
					},
					 "alignment": "center"
					})
			        tenthPageOne.push({
          	    	"table": {
          	    	    "headerRows": 1,
					    "alignment": "center",
          	    	    "widths": ["18%","18%","18%","18%"],
					    "body": [
						  ["VALUE","YEAR1", "YEAR2","YEAR3"],
          	    	      ["INCOME", "<?php echo $currentCost ?>", "<?php echo $currentCost ?>", "<?php echo $currentCost ?>"],
          	    	      ["CURRENT","<?php echo $y1MigCost ?>","<?php echo $y2MigCost ?>","<?php echo $y3MigCost ?>"],
          	    	      ["EXPENSES","<?php echo $y1MigSavings ?>","<?php echo $y2MigSavings ?>","<?php echo $y3MigSavings ?>"],
        	    	    ]
          	    	  } 
              	    });
					
					var eleventhchart = [];
					eleventhchart.push({
					"text":"\n\Test and Data Setup Automation ROI analysis\n\n\n\n\n\n",
					"bold":true,
					"color": "#3E2909",
					"fontSize":16,
					"labelsEnabled": false,
					 "legend": {
						"position": "right",
						"valueText": '',
						"markerSize": 6,
						"valueWidth": 10,
					},
					"alignment": "center"
					})
			        eleventhchart.push({
          	    	"table": {
          	    	    "headerRows": 1,
					    "alignment": "center",
          	    	    "widths": ["18%","18%","18%","18%"],
					    "body": [
						  ["VALUE","YEAR1", "YEAR2","YEAR3"],
          	    	      ["INCOME", "<?php echo $currCost ?>", "<?php echo $currCost ?>", "<?php echo $currCost ?>"],
          	    	      ["CURRENT","<?php echo $y1Cost ?>","<?php echo $y2Cost ?>","<?php echo $y3Cost ?>"],
          	    	      ["EXPENSES","<?php echo $y1Savings ?>","<?php echo $y2Savings ?>","<?php echo $y3Savings ?>"],
        	    	    ]
          	    	  } 
              	    });
					
					
					var fifteenchart = [];
					fifteenchart.push({
          	    	"table": {
          	    	    "headerRows": 1,
          	    	    "widths": ["17%","17%"],
						"alignment": "center",
					    "body": [
						  ["access", "Data"],
          	    	      ["Waterfall", "<?php $cursor = $application_collection->find(array('SDLC_Method' => 'Waterfall'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
								?>"],
						["Agile", "<?php $cursor = $application_collection->find(array('SDLC_Method' => 'Agile'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
								?>"],
						
          	    	    ]
          	    	  }
              	    });


                    var sixteenchart = [];
					sixteenchart.push({
          	    	"table": {
          	    	    "headerRows": 1,
          	    	    "widths": ["20%","20%"],
						"alignment": "center",
					    "body": [
						  ["access", "Data"],
          	    	      ["Batch", "<?php $cursor = $application_collection->find(array('Process' => 'Batch'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
                            ?>"],
						["Online", "<?php $cursor = $application_collection->find(array('Process' => 'Online'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
                            ?>"],
							["Both", "<?php $cursor = $application_collection->find(array('Process' => 'Both'));
								$count = 0;
								foreach ($cursor as $cur) {
									$count = $count + 1;
								}
								echo $count;
                            ?>"],
						
          	    	    ]
          	    	  }
              	    });					
				chart.export.capture( {}, function() {
            	chart.export.toPDF( {
      	            content: [firstPage,secondPage]
      	          }, function( data ) {
      	            this.download( data, "application/pdf", "Report.pdf" );
      	          });
            	});
          	}
        </script>
</body>
</html>