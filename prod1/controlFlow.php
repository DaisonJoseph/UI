<?php
session_start();


function getMasterDetails($name, $type)
{
    // echo "inside get master details function";
    $name1 = $name;
    $type1 = $type;
    $appname = "Unknown";
    $status = "Unknown";
    $sloc = 0;
    $compid = 0;

    $m = new MongoClient();
    $db = $m->aflac;
    $masterinventory_collection = $db->masterinventory;

    $input = array('component_name' => $name1, 'component_type' => $type1);
    $masterresults = $masterinventory_collection->find($input);

    foreach ($masterresults as $masterresult) {
        $sloc = $masterresult['tloc'];
        $appname = $masterresult['app_name'];
        $status = $masterresult['status'];
        $compid = $masterresult['Compid'];
    }
    return array($appname, $sloc, $status, $compid);
}

function getColor($type, $color)
{
    $get_type = $type;
    if ($get_type == "JCL") {
        $color = "#CD9DEA";
    }
    if ($get_type == "PROC") {
        $color = "#B8F7BE";
    }
    if ($get_type == "COBOL") {
        $color = "#A6C4F6";
    }
    if ($get_type == "UTILITY") {
        $color = "#F3DCB4";
    }
    if ($get_type == "CONTROL_CARD") {
        $color = "#FC899E";
    }
    if (($get_type == "ASSEMBLER")or ($get_type == "EZPLUS")) {
        $color = "#B0E4E3";
    }
    if ($get_type == "READ") {
        $color = "#E4B0BF";
    }
    if ($get_type == "INSERT") {
        $color = "#BEE4B0";
    }
    if ($get_type == "UPDATE") {
        $color = "#B0BEE4";
    }
    if ($get_type == "DELETE") {
        $color = "#E4B0C9";
    }
    if (($get_type == "COPYBOOK") or ($get_type == "DCLGEN") or ($get_type == "MAPS") ){
        $color = "#E9DBAD";
    }
    if ($get_type == "TRANSACTION") {
        $color = "#F9A9A2";
    }
    if (stripos($get_type,"Level_")!==false) {
        $color = "#BAF5F4";
    }
    return $color;
}


if (isset($_SESSION['name'])) {
?>


    <!DOCTYPE html>
    <html lang="en">
	<style>
	
.right-sidebar-2{
	width: 200px;
	position: fixed;
	overflow-x: hidden;
	top: 0;
	right: -600px;
	z-index: 999;
	text-align:center;
	padding:10px;
	background: #ffffff;
	-webkit-transition: all .3s ease;
	-moz-transition: all .3s ease;
	-ms-transition: all .3s ease;
	-o-transition: all .3s ease;
	transition: all .3s ease;
}

.switcher-icon-2{
	width: 40px;
	height: 40px;
	line-height:40px;
	background: #fff;
	text-align:center;
	font-size:22px;
	color:#fff;
	cursor: pointer;
	display: inline-block;
	position: fixed;
	right: 0;
	top: 15rem;
	border-top-left-radius: .25rem;
	border-bottom-left-radius: .25rem;
	-webkit-transition: all .3s ease;
	-moz-transition: all .3s ease;
	-ms-transition: all .3s ease;
	-o-transition: all .3s ease;
	transition: all .3s ease;
}

.right-sidebar-2.right-toggled-2{
  right: 0px;
}
.right-sidebar-2.right-toggled-2 .switcher-icon-2{
  right: 200px;
}

.button-round {
            background-color: yellow;
            color: black;
            text-align: center;
            font-size: 15px;
            padding: 20px;
            border-radius: 15px;
}

/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 62px;
  height: 50px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 24px!important;
}

.slider.round:before {
  border-radius: 50%;
}

	</style>

    <meta charset="utf-8" />
    <title>CAP360 Code Analyzer</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="DevOps Analyser created by Legacy Modernization Team" name="description" />
    <meta content="" name="author" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
    <link href="../assets1/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets1/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets1/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../assets1/global/css/scroll.css" type="text/css">
    <link rel="stylesheet" href="new 1.css" type="text/css">
    <link href="../assets1/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <link href="../assets1/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets1/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets1/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets1/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="../assets1/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../assets1/layouts/layout/img/cap.ico" type="image/x-icon" />

    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
    </script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['sankey']
        });
    </script>


    <!-- NProgress -->
    <!-- <link href="../vendors/nprogress/nprogress.css" rel="stylesheet"> -->


    <!-- Custom Theme Style -->
    <!-- <link href="../build/css/custom.min.css" rel="stylesheet"> -->
    <!-- <link href="../vendors/vis/vis-network.min.css" rel="stylesheet" type="text/css" /> -->

    <style>
        #mynetwork {
            width: 1250px;
            height: 600px;
        }
    </style>
    </head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
        <div class="page-wrapper" id="table">
            <?php
            $page == 'controlFlow';
            include 'header.php'; ?>
            <div class="page-container">
                <?php require 'sidebar1.php'; ?>
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <!--start here-->
                                <div class="col-xs-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel container drop-shadow" style="background-color: white;">
                                                <div class="x_title">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
														<div class="col-lg-4">	
															<h2>Control Flow Chart</h2>
														</div>
														<div  class="col-lg-4">
															<h5 style="text-align: center;padding-left:320px;margin-top: 20px;">Include Tables</h5>
														</div>
														<div class="col-lg-4">
															<div class="row">
																<div class="col-lg-3">
																	<label class="switch">
																	<input class="switch-input" type="checkbox">
																	<span class="slider round"></span>
																	</label>
																</div>
																	<a href="neglectComponent.php"><h5 style="padding-top: 17px;">Remove Component</h5></a>
																</div>
															</div>	
														<!--<div id="legend2" ><img src="legends.png"></div>-->
														</div>
														 <div>
                                                    <div class="clearfix"></div>
                                                </div>
												<form action="controlFlow.php">
													<button style="margin-left:20px;border-radius: 15%!important;" class="btn btn-primary" type="submit">Reset</button>
												</form>
														 </div>
                                                <div class="x_content">
                                                    <!-- Chart goes here -->
                                                    <div id="mynetwork"></div>
                                                </div>
												<div class="right-sidebar-2" style="margin-top:100px">
													<div class="switcher-icon-2" style="float: bottom">
														<img src="../assets/img/information.png" height="100%">
													</div>
													<div class="portlet-body" style="background-color: #ffffff;">
														<div class="col-lg-6">
															 <div class="card" style="width: 600px">
																  <div class="card-body">
																  <div class="card-title">
																	   <div class="row">
																			<div class="col-8">
																				 <div style="float:left;padding-left:70px"><b>Legends</b></div>
																			</div>
																			<!--<div class="col-4">
																				 <button id="close-assign" class="button-round btn btn-primary" style="float: left;margin-left:50px">x</button>
																			</div>-->
																		</div>
																	</div>
																		<div style="width: 100%; display: flex; justify-content: space-between">
																			<div><img src="legends.png" width="150px"></div>
																		</div>
																  </div>
															 </div>
														</div>
													</div>
												</div>
                                            </div>
                                        </div>
                                        <!--end here-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php include 'footer.php'; ?>

        <!-- Chart Script goes here -->


        <?php include 'scripts.php' ?>

        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>
        <!-- Datatables -->

        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>
        <script type="text/javascript" src="../vendors/vis/vis.js"></script>


        <!-- Flow Diagram -->
        <script type="text/javascript">
            // create an array with nodes
            var newidarray = [];
            var nodes = new vis.DataSet([
                <?php
                $m = new MongoClient();
                $db = $m->aflac;
                $masterinventory_collection = $db->masterinventory;
                $startingpoint_collection = $db->startingpoint;
                $startingpoint_collection = $db->starting_business;
                $crossreference_collection = $db->crossreference_dummy;
				$table_inv_collection = $db->table_inv;
				$crud_collection = $db->crud;

                $color = "brown";
                $called = "no";
                $businessid = 2;
                $idarray = array();
                $calledidarray = array();
                $callingidarray = array();
                $calledcount = 0;
                $callingcount = 0;
                $cid = 0;

                //For Business Functions only
                if (!isset($_GET['input'])) {
                    $direction = "to";
                    echo "{id: 1, label: 'Capability',color: '#FB5757',border: 'Black'},";

                    $businessarray = array();
                    $businesses = $startingpoint_collection->distinct('business');

                    for ($i = 0; $i < count($businesses); $i++) {
                        $business = $businesses[$i];
                        $businesslabel = $business;
                        $businesspos = strpos($business, "_");
                        $setbusiness = true;

                        if ($businesspos > 0) {
                            $businesslabel = substr($business, 0, $businesspos);
                        }
                        if (!in_array($businesslabel, $businessarray)) {
                            echo "{id: " . $businessid . ", label:'" . $businesslabel . "', title: 'Business Features Under DMS',color: '#FAFA8A'},";
                            $businessarray[$businessid - 2] = $businesslabel;
                            $businessid = $businessid + 1;
                        }
                    }
                } else {
                    $inputvalue = $_GET['input'];

                    $inputname = $inputvalue;
                    $istype = strpos($inputvalue, ".");
                    $inputlen = strlen($inputvalue);
                    if ($istype > 0) {
                        $inputname = substr($inputvalue, 0, $istype);
                        $inputtype = substr($inputvalue, $istype + 1, $inputlen - 1);
                        $type = $inputtype;
                    }

                    //$inputsearch = "\""  . $inputname . "\"";
                    //$input = array('$text'=>array('$search'=>$inputsearch));
                    $regex = new MongoRegex("/^$inputname/i");   //Added by Sumanth on 25Oct2018 - To handle wildcard search
                    $input = array('business' => $regex);    //Added by Sumanth on 25Oct2018 - To handle wildcard search

                    $startingpoints = $startingpoint_collection->find($input);
                    $startingpointcount = $startingpoint_collection->find($input)->count();
                    $direction = "to";
                    $idarray = array();

                    //Only if the input value is business
                    if (($startingpointcount > 0) and (!isset($_GET['business']))) {
                        $setbusiness = true;
                        echo "{id: 1, label: '" . $inputname . "',color: 'yellow',border: 'Black'},";
                        $id = 2;

                        foreach ($startingpoints as $startingpoint) {
                            // print_r($startingpoint);
                            $component_name = $startingpoint['component_name'];
                            $component_type = $startingpoint['type'];
                            $functionality = $startingpoint['business'];
                            $type = $component_type;

                            list($appname, $sloc, $status, $compid) = getMasterDetails($component_name, $component_type);
                            // echo "just after get master details function call";

                            $appname = "";
                            $sloc = "";
                            $status = "";
                            $compid = "";
                            // echo "after listing";
                            $returncolor = getColor($type, $color);
                            // $returncolor = "#ffeb8d";

                            // echo "just before bugged echo";

                            echo "{id: " . $id . ", value1:'" . $component_type . "', business1:'" . $functionality . "', label:'" . $component_name . "', title: 'Name:" . $component_name . "</br>Type " . $component_type . "</br>Starting Point for: </br>" . $functionality . "',color: {background:'" . $returncolor . "',border:'red'}},";
                            $businessid = $businessid + 1;
                            $id = $id + 1;
                        }
                    } else    /* If the input is component */ {
                        $inputarray = array('component_name' => $inputname, 'component_type' => $inputtype);
                        $crossreferences1 = $crossreference_collection->find($inputarray)->limit(100);
                        $direction = "to";
                        $returncolor = getColor($type, $color);
                        $setbusiness = false;

                        echo "{id: 1, label: '" . $inputname . "',value1: '" . $inputtype . "',color: '" . $returncolor . "',border: 'Black',level:1,size:90},";
                        $checkarray = array();
                        $calledcount = 0;
                        $i = 0;
                        foreach ($crossreferences1 as $crossreference) {
							// print_r($crossreference);
                            $calledcount = $calledcount + 1;
                            $component_type = $crossreference['component_type'];
                            $calling_component = $crossreference['calling_component'];
                            $calling_type = $crossreference['calling_type'];
                            $type = $calling_type;

                            list($appname, $sloc, $status, $compid) = getMasterDetails($calling_component, $calling_type);
                            if (!in_array($calling_component, $checkarray)) {
                                if ($compid == 0) {
                                    $compid = rand();
                                }
                                $returncolor = getColor($type, $color);
                                echo "{id: " . $compid . ",value1: '" . $calling_type . "', label:'" . $calling_component . "', title: 'Name:" . $calling_component . "</br> Type:" . $calling_type . "</br> LOC:" . $sloc . "</br> Application:" . $appname . "</br> Status:" . $status . "',color: '" . $returncolor . "',level:2},";

                                $idarray[$cid] = $compid;
                                $calledidarray[$cid] = $compid;
                                $cid = $cid + 1;

                                $checkarray[$i] = $calling_component;
                                $i = $i + 1;
                            }
                        }
						// print_r($inputarray);
						$crudresults = $crud_collection->find($inputarray)->limit(50);
						foreach($crudresults as $crudresult)
						{
						// print_r($crudresult);
							$crossrefcount = $crossrefcount + 1;
							$component_type = $crudresult['component_type'];
							$calling_component = $crudresult['table_name'];
							$calling_type = $crudresult['operation'];
							$appname = $crudresult['app_name'];
							$status = "";
							$sloc = "";
							$type = $calling_type;
							
							$returncolor = getColor($type, $color);
							
							$tableresults = $table_inv_collection->find(array('table_name' => $calling_component));
							$compid = rand();
							$direction = "to";
							// $mastercount = 0;
							foreach ($tableresults as $tableresult) {
								if (isset($tableresult['Compid'])) {
									$compid = $tableresult['Compid'];
								}
							}
							
							$title = "Name:" . $calling_component . "</br> Type:" . $calling_type . "</br> LOC:" . $sloc . "</br> Application:" . $appname . "</br> Status:" . $status;

							if (!in_array($calling_component, $checkarray)) {
								$checkarray[$i] = $calling_component;
								echo "{id: " . $compid . ",value1: '" . $calling_type . "', label:'" . $calling_component . "', title: 'Name:" . $calling_component . "</br> Type:" . $calling_type . "</br> LOC:" . $sloc . "</br> Application:" . $appname . "</br> Status:" . $status . "',color: '" . $returncolor . "',level:2},";
								
                                $idarray[$cid] = $compid;
                                $calledidarray[$cid] = $compid;
                                $cid = $cid + 1;

                                $checkarray[$i] = $calling_component;
                                $i = $i + 1;
							}
						}
						

                    }
                }
                ?>
            ]);

            // create an array with edges
            var edges = new vis.DataSet([
                <?php
                if ($setbusiness == true) {
                    for ($idvalue = 2; $idvalue < $businessid; $idvalue++) {
                        $direction = "to";
                        echo "{from: " . 1 . ", to:" . $idvalue . ", arrows: '" . $direction . "', color:{color:'black'}},";
                    }
                } else {
                    for ($idvalue2 = 0; $idvalue2 < count($idarray); $idvalue2++) {
                        $compid2 = $idarray[$idvalue2];

                        if (in_array($compid2, $calledidarray)) {

                            $direction = "to";
                            echo "{from: " . 1 . ", to:" . $compid2 . ", arrows: '" . $direction . "', color:{color:'black'} },";
                        } 
                    }
                }


                ?>
            ]);

            // create a network
            var container = document.getElementById('mynetwork');
            var data = {
                nodes: nodes,
                edges: edges
            };

            var options = {
                interaction: {
                    hover: true
                },
                manipulation: {
                    enabled: true
                },

                <?php
                // Make it heirarchical only if the calling and called components are less then 21
                $calledcount = 0;
                $calledcount = 0;
                /*if (($calledcount < 21) and ($callingcount < 21) and ($setbusiness == false))
			{
				echo "layout: {";
					echo "hierarchical: {";
						echo 'direction: "LR",';	
					echo "}";
				echo "},";
			}*/
                ?>

                physics: true

            };

            var network = new vis.Network(container, data, options);
            // console.log(network);
            var nodeId = 0;
            //var	newId = <?php echo $id; ?>;
            var newidarrayphp = <?php echo json_encode($idarray); ?>;

            //var	newId = <?php echo 90; ?>;
            //Function to create new nodes on click
            function addNode(getresponse) {
                var getcomponents = getresponse;

                //newidarray[101] = 0;
                getcomponents = getcomponents.replace(/(\r\n|\n|\r)/gm, "");

                var notFound = "NOTFOUND";

                if (getcomponents === notFound) {} else {
                    var componentsarray = getcomponents.split("|");

                    for (i = 0; i < componentsarray.length; i++) {
                        var datavalue = componentsarray[i];
                        var dataarray = datavalue.split(".");
                        var compname = dataarray[0];
                        var comptype = dataarray[1];
                        var fromid = dataarray[2];
                        var nodecolor = dataarray[3];
                        var newId = dataarray[4];
                        var direction = dataarray[5];
                        var titledata = dataarray[6];
						// console.log(titledata);
                        var isIdPresent = 0;

                        for (k = 0; k < newidarray.length; k++) {
                            var isInArray = newidarray[k];

                            if (isInArray == newId) {
                                isIdPresent = 1;
                            }

                        }
                        for (l = 0; l < newidarray.length; l++) {
                            var isInArrayphp = newidarrayphp[l];

                            if (isInArrayphp == newId) {
                                isIdPresent = 1;
                            }

                        }
                        // alert(isIdPresent);
                        if (isIdPresent == 0) {
                            nodes.add({
                                id: newId,
                                label: compname,
                                color: nodecolor,
                                value1: comptype,
                                title: titledata
                            });
                        }

                        if ((isIdPresent == 0) || (isIdPresent == 1)) {
                            if (direction == "from") {
                                edges.add({
                                    from: fromid,
                                    to: newId,
                                    arrows: direction,
                                    color: {
                                        color: '#45adae'
                                    },
                                    dashes: true
                                });
                            } else {
                                edges.add({
                                    from: fromid,
                                    to: newId,
                                    arrows: direction,
                                    color: {
                                        color: 'black'
                                    }
                                });
                            }
                        }
                        newidarray[i] = newId;
                        //newId = newId + 1;	
                    }
                }

            }
				var switchresult = "no";	
				// $('.switch-input').on('change', function() {
				// switchresult = document.getElementsByClassName("switch-input")[0].checked ? 'yes' : 'no';
				// console.log(switchresult);
				// });

            network.on("click", function(params) {
                // addNode();
                if (params.nodes.length > 0) {
                    var nodeId = params.nodes[0];
                    var nodeLabel2 = nodes.get(nodeId).label;
                    var nodeType2 = nodes.get(nodeId).value1;
                    nodeId = nodes.get(nodeId).id;
                }

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var getresponse = this.responseText;
						// alert(getresponse);
                        addNode(getresponse);
                    }
                };
				// var switchresult ="no";
				$('.switch-input').on('change', function() {
				switchresult = document.getElementsByClassName("switch-input")[0].checked ? 'yes' : 'no';
					// if(switchresult == "yes")
					// {
						// alert("Yes");
					// }
					// else
					// {
						// alert("No");
					// }
				});
				// alert(switchresult);
						// alert("addnodes.php?inputname=" + nodeLabel2 + "&inputtype=" + nodeType2 + "&inputId=" + nodeId + "&tableInc=" + switchresult +"?");
						// console.log(nodeLabel2);
						xmlhttp.open("GET", "addnodes.php?inputname=" + nodeLabel2 + "&inputtype=" + nodeType2 + "&inputId=" + nodeId + "&tableInc=" + switchresult, true);
						xmlhttp.send();
            });
            network.on("doubleClick", function(params) {
                if (params.nodes.length > 0) {
                    var nodeId = params.nodes[0];
                    nodeLabel = nodes.get(nodeId).label;
                    nodeType = nodes.get(nodeId).value1;
                    nodeBusiness = nodes.get(nodeId).business1;
                    if (!!nodeType) {
                        if (!!nodeBusiness) {
							// alert("-"+nodeLabel);
                            window.location.href = "controlFlow.php?input=" + nodeLabel + "." + nodeType + "&business=" + nodeBusiness;
                        } else {
							// alert("--"+nodeLabel);
                            window.location.href = "controlFlow.php?input=" + nodeLabel + "." + nodeType;
                        }
                    } else {
                        if (!!nodeBusiness) {
                            window.location.href = "controlFlow.php?input=" + nodeLabel + "&business=" + nodeBusiness;
                        } else {
                            window.location.href = "controlFlow.php?input=" + nodeLabel;
                        }
                    }
                }
            });
            network.on("oncontext", function(params) {
                params.event = "[original event]";
                document.getElementById('eventSpan').innerHTML = '<h2>oncontext (right click) event:</h2>' + JSON.stringify(params, null, 4);
            });
            network.on("zoom", function(params) {
                document.getElementById('eventSpan').innerHTML = '<h2>zoom event:</h2>' + JSON.stringify(params, null, 4);
            });
            network.on("showPopup", function(params) {
                document.getElementById('eventSpan').innerHTML = '<h2>showPopup event: </h2>' + JSON.stringify(params, null, 4);
            });
            network.on("hidePopup", function() {
                // console.log('hidePopup Event');
            });
            network.on("select", function(params) {
                // console.log('select Event:', params);
            });
            network.on("selectNode", function(params) {
                // console.log('selectNode Event:', params);
            });
            network.on("selectEdge", function(params) {
                // console.log('selectEdge Event:', params);
            });
            network.on("deselectNode", function(params) {
                // console.log('deselectNode Event:', params);
            });
            network.on("deselectEdge", function(params) {
                // console.log('deselectEdge Event:', params);
            });
            network.on("hoverNode", function(params) {
                // console.log(titledata);
            });
            network.on("hoverEdge", function(params) {
                // console.log('hoverEdge Event:', params);
            });
            network.on("blurNode", function(params) {
                // console.log('blurNode Event:', params);
            });
            network.on("blurEdge", function(params) {
                // console.log('blurEdge Event:', params);
            });
			
			 
			 $(".switcher-icon-2").on("click", function(e) {
				e.preventDefault();
				$(".right-sidebar-2").toggleClass("right-toggled-2");
			});
			
			$('#close-assign').click(function() {
			   $('.switcher-icon-2').click();
			})
			// $('.switch-input').on('change', function() {
				// result = document.getElementsByClassName("switch-input")[0].checked ? 'yes' : 'no';
				// alert(result);
			// });
        </script>
        <!-- /Flow Diagram -->

    </body>

    </html>
<?php
} else {
    header("location:login.php");
}
?>