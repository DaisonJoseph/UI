<?php require 'sessioncon.php'; if (!isset($_SESSION['Uid'])) { header('Location:login.php'); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
#a,#b,#a1,#a2,#a3,#a0,#g1,#b1,#b2,#b3,#g1,#g2,#g3,#g4,#h1,#h2,#d1,#d2,d3{
	background-color:white!important;
}
table{
	border:3px solid #888;!important;
}
</style>
    <meta charset="utf-8" />
    <title>DevOps Analyzer</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="DevOps Analyser created by Legacy Modernization Team" name="description"/>
    <meta content="" name="author" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/pages/css/roi.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../assets/layouts/layout/img/cap.ico" />
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed page-sidebar-closed page-sidebar-fixed">
    <div class="page-wrapper">
        <?php include 'header.php' ?>
        <div class="clearfix"> </div>
        <div class="page-container">
            <?php include 'sidebar.php';?>
            </div>
            <div class="page-content-wrapper">
                <div class="page-content" style="background-color:#fff;">
                    <div class="page-bar hide" style="background-color:#778899;height:21px;">
                        <ul class="page-breadcrumb" style="padding-top:1px;">
                            <li>
                                <span style="color:white">ROI</span>
                            </li>
                        </ul>
                    </div><br />
                    <div class="row margin-bottom-40 stories-header" data-auto-height="true">
                        <div class="col-md-12">
                            <h2>Dev-Test Offloading ROI Analysis</h2>
                        </div>
                    </div>       <div class="row">
                        <div class="col-md-6">
                            <div class="portlet tables">
                                <div class="portlet-body">
                                    <table>
                                        <thead>
                                            <tr>
												<th></th>
                                                <th></th>
                                                <th>Year 1</th>
                                                <th>Year 2</th>
                                                <th>Year 3</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
												<td><i class="fa fa-plus-circle" id="firstplus"></i></td>
                                                <td>Current Cost</td>
                                                <td>$ 7,200,000</td>
                                                <td>$ 7,200,000</td>
                                                <td>$ 7,200,000</td>
                                            </tr>
											<!--SUB VAL-->
                                            <tr class="hide" id="a">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>MIPS Cost - DEV</td>
                                                <td>$ 2,880,000</td>
                                                <td>$ 2,880,000</td>
                                                <td>$ 2,880,000</td>
                                            </tr>
                                            <tr class="hide" id="b">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>MIPS Cost - TEST</td>
                                                <td>$ 4,320,000</td>
                                                <td>$ 4,320,000</td>
                                                <td>$ 4,320,000</td>
                                            </tr>
											<!--END SUB VAL-->
											
                                            <tr>
												<td><i class="fa fa-plus-circle" id="secondplus"></i></td>
                                                <td>Yearly Cost After Migration</td>
                                                <td>$ 9,961,702</td>
                                                <td>$ 6,490,831</td>
                                                <td>$ 3,720,993</td>
                                            </tr>
											<!--SUB VAL-->
                                            <tr class="hide" id="a0">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>Mainframe Cost</td>
                                                <td>$ 7,200,000</td>
                                                <td>$ 4,320,000</td>
                                                <td>$ 2,160,000</td>
                                            </tr>
											<tr class="hide" id="a1">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>Hardware Cost</td>
                                                <td>$ 148,032</td>
                                                <td>$ 140,630</td>
                                                <td>$ 131,748</td>
                                            </tr>
                                            <tr class="hide" id="a2">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>Migration Cost</td>
                                                <td>$ 2,263,926</td>
                                                <td>$ 1,697,944</td>
                                                <td>$ 1,131,963</td>
                                            </tr>
                                            <tr class="hide" id="a3">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>Tool Cost</td>
                                                <td>$ 349,744</td>
                                                <td>$ 332,257</td>
                                                <td>$ 297,282</td>
                                            </tr>
											<!--END SUB VAL-->
                                            <tr>
												<td></td>
                                                <td>Yearly Profit [Indicative]</td>
                                                <td>$ -2,761,702</td>
                                                <td>$ 709,169</td>
                                                <td>$ 3,479,007</td>
                                            </tr>
                                            <tr>
												<td></td>
                                                <td>Gain %</td>
                                                <td>-28 %</td>
                                                <td>11 %</td>
                                                <td>93 %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet">
                                <div class="portlet-body">
                                    <center>
                                        <div id="myChart1" class="chartheight"></div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>			
                    <div class="row margin-bottom-40 stories-header">
                        <div class="col-md-12">
                            <h2>Test and Data Setup Automation ROI analysis</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portlet tables">
                                <div class="portlet-body">
                                    <table>
                                        <thead>
                                            <tr>
												<th></th>
                                                <th></th>
                                                <th>Year 1</th>
                                                <th>Year 2</th>
                                                <th>Year 3</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
												<td></td>
                                                <td>Without automation</td>
                                                <td>$ 6,335,360</td>
                                                <td>$ 6,335,360</td>
                                                <td>$ 6,335,360</td>
                                            </tr>
                                            <tr>
												<td><i class="fa fa-plus-circle" id="lastplus"></i></td>
                                                <td>Maturity Level-1</td>
                                                <td>$ 6,002,298</td>
                                                <td>$ 4,201,486</td>
                                                <td>$ 3,758,011</td>
                                            </tr>											
											<!--SUB VAL-->
                                            <tr class="hide" id="b1">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>Test Script Dev</td>
                                                <td>$ 5,046,098</td>
                                                <td>$ 4,105,866</td>
                                                <td>$ 3,662,391</td>
                                            </tr>
                                            <tr class="hide" id="b2">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>Data Masking</td>
                                                <td>$ 460,800</td>
                                                <td>$ 46,080</td>
                                                <td>$ 46,080</td>
                                            </tr>
                                            <tr class="hide" id="b3">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>Tools Cost</td>
                                                <td>$ 495,400</td>
                                                <td>$ 49,540</td>
                                                <td>$ 49,540</td>
                                            </tr><tr class="hide"></tr>
											<!--END SUB VAL-->
                                            <tr>
												<td><i class="fa fa-plus-circle" id="lastplus5"></i></td>
                                                <td>With DevOps Progressing</td>
                                                <td>$ 3,240,477</td>
                                                <td>$ 1,724,756</td>
                                                <td>$ 1,566,372</td>
                                            </tr>
											<!--SUB VAL-->
                                            <tr class="hide" id="d1">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>Test Script Dev</td>
                                                <td>$ 2,284,277</td>
                                                <td>$ 1,629,136</td>
                                                <td>$ 1,470,752</td>
                                            </tr>
                                            <tr class="hide" id="d2">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>Data Masking</td>
                                                <td>$ 460,800</td>
                                                <td>$ 46,080</td>
                                                <td>$ 46,080</td>
                                            </tr>
                                            <tr class="hide" id="d3">
												<td><i class="fa fa-arrow-right"></i></td>
                                                <td>Tools Cost</td>
                                                <td>$ 495,400</td>
                                                <td>$ 49,540</td>
                                                <td>$ 49,540</td>
                                            </tr><tr class="hide"></tr>
											<!--END SUB VAL-->
											<tr>
												<td></td>
                                                <td>ROI</td>
                                                <td>$ 3,094,883</td>
                                                <td>$ 4,610,604</td>
                                                <td>$ 4,768,988</td>
                                            </tr>
										</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet">
                                <div class="portlet-body">
                                    <center>
                                        <div id="myChart2" class="chartheight"></div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-bottom-40 stories-header" data-auto-height="true">
                        <div class="col-md-12">
                            <h2>CI-CD ROI Analysis</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portlet  tables">
                                <div class="portlet-body">
                                    <table>
                                        <thead>
                                            <tr>
												<th></th>
                                                <th>Cost Drivers</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<tr id="cost">
												<td><i class="fa fa-plus-circle" id="lastplus1"></i></td>
                                                <td>Cost</td>
                                                <td>$ 12,566,152</td>
											</tr>
												<tr class="hide" id="h1">
													<td><i class="fa fa-arrow-right"></i></td>
													<td>Training Cost</td>
													<td>$ 10,640,152</td>
												</tr>
												<tr class="hide" id="h2">
													<td><i class="fa fa-arrow-right"></i></td>
													<td>Tools Cost</td>
													<td>$ 1,926,000</td>
												</tr>
                                            <tr id="thirdplus">
												<td><i class="fa fa-plus-circle"></i></td>
                                                <td>Gains</td>
                                                <td>$ 14,055,222</td>
                                            </tr>
												<tr class="hide" id="g1">
													<td><i class="fa fa-arrow-right"></i></td>
													<td>Gains from accelerated time to market of new functionality (GTM)</td>
													<td>$ 80,000</td>
												</tr>
												<tr class="hide" id="g2">
													<td><i class="fa fa-arrow-right"></i></td>
													<td>Gains from enhanced IT team productivity and cost reduction of IT headcount
														waste (GHC)</td>
													<td>$ 2,990,899</td>
												</tr>
												<tr class="hide" id="g3">
													<td><i class="fa fa-arrow-right"></i></td>
													<td>Gains from cost reduction of application failures resulting from increased
														quality (GQL)</td>
													<td>$ 5,384,323</td>
												</tr>
												<tr class="hide" id="g4">
													<td><i class="fa fa-arrow-right"></i></td>
													<td>Gain from flexibility in the IT environment (GFX)</td>
													<td>$ 5,600,000</td>
												</tr>
												<tr id="ROI">
												<td></td>
                                                <td>ROI</td>
                                                <td>$ -1,489,070</td>
											</tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet">
                                <div class="portlet-body">
                                    <center>
                                        <div id="cicdroi" class="chartheight"></div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="page-footer">
                <div class="page-footer-inner"> 2018 &copy; DevOps Tool By
                    <a  href="https://www.capgemini.com/">Capgemini</a>
                    <div class="scroll-to-top">
                        <i class="icon-arrow-up"></i>
                    </div>
                </div>
            </div>
            </div>
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
		<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
		<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
		<script src="../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>	
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script> var chart = AmCharts.makeChart("myChart1", {
                "type": "serial",
                "addClassNames": true,
                "theme": "light",
                "autoMargins": false,
                "marginLeft": 75,
                "marginRight": 8,
                "color": "#1B1F23",
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
                    "income": 7200000,
                    "Current": 9961702,
                    "expenses": -2761702                }, {
                    "year": 'Year 2',
                    "income": 7200000,
                    "Current": 6490831,
                    "expenses": 709169                }, {
                    "year": 'Year 3',
                    "income": 7200000,
                    "Current": 3720993,
                    "expenses": 3479007                }],
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
                        "income": 6335360,
                        "Current": 6002298,
                        "expenses": 333062                    }, {
                        "year": 'Year 2',
                        "income": 6335360,
                        "Current": 4201486,
                        "expenses": 2133874                    }, {
                        "year": 'Year 3',
                        "income": 6335360,
                        "Current": 3758010.8,
                        "expenses": 2577349.2                    }],
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
                "labelsEnabled": false,
                "legend": {
                    "position": "right",
                    "valueText": '',
                    "markerSize": 6,
                    "enabled": false,
                    "valueWidth": 10,
                },
                "autoMargins": false,
                "marginTop": 0,
                "marginBottom": 0,
                "marginLeft": 0,
                "marginRight": 0,
                "pullOutRadius": 10,
                "dataProvider": [{
                    "id": "Gains from new functionality",
                    "value": 80000,
                    "color": "#738989"
                }, {
                    "id": "Gains from headcount waste",
                    "value": 2990899.2,
                    "color": "#0A6A8B"
                }, {
                    "id": "Gains from increased quality",
                    "value": 5384322.6788432,
                    "color": "#39B7CD"
                }, {
                    "id": "Gains from flexibility environment",
                    "value": 5600000,
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
			
	$("#firstplus").click(function(){
    $("#a").toggleClass("hide");
    $("#b").toggleClass("hide");
	$("#a0").addClass("hide");
	$("#a1").addClass("hide");
    $("#a2").addClass("hide");
    $("#a3").addClass("hide");
});

$("#secondplus").click(function(){
    $("#a0").toggleClass("hide");
    $("#a1").toggleClass("hide");
    $("#a2").toggleClass("hide");
    $("#a3").toggleClass("hide");
	$("#a").addClass("hide");
    $("#b").addClass("hide");
});

$("#lastplus").click(function(){
    $("#b1").toggleClass("hide");
    $("#b2").toggleClass("hide");
    $("#b3").toggleClass("hide");
    $("#d1").addClass("hide");
    $("#d2").addClass("hide");
    $("#d3").addClass("hide");
});

$("#thirdplus").click(function(){
    $("#g1").toggleClass("hide");
    $("#g2").toggleClass("hide");
    $("#g3").toggleClass("hide");
    $("#g4").toggleClass("hide");
    $("#h1").addClass("hide");
    $("#h2").addClass("hide");
});

$("#lastplus1").click(function(){
    $("#h1").toggleClass("hide");
    $("#h2").toggleClass("hide");
	$("#g1").addClass("hide");
    $("#g2").addClass("hide");
    $("#g3").addClass("hide");
    $("#g4").addClass("hide");
});

$("#lastplus5").click(function(){
    $("#d1").toggleClass("hide");
    $("#d2").toggleClass("hide");
	$("#d3").toggleClass("hide");
    $("#b1").addClass("hide");
    $("#b2").addClass("hide");
    $("#b3").addClass("hide");
});

        </script>
</body>
</html>