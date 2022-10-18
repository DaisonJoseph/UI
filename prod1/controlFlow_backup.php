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
    $db = $m->barclaysd;
    $masterinventory_collection = $db->masterinventory;

    $input = array('component_name' => $name1, 'pdsname' => $type1);
    $masterresults = $masterinventory_collection->find($input);

    foreach ($masterresults as $masterresult) {
        $sloc = $masterresult['sloc'];
        $appname = $masterresult['ownership'];
        $status = $masterresult['status'];
        $compid = $masterresult['Compid'];
    }
    return array($appname, $sloc, $status, $compid);
}

function getColor($type, $color)
{
    $get_type = $type;
    if ($get_type == "RPGLE") {
        $color = "#ffeb8d";
    }
    if ($get_type == "CLLE") {
        $color = "#feaa9f";
    }
    if ($get_type == "SQLRPGLE") {
        $color = "#faca88";
    }
    if (($get_type == "PRINTER") or ($get_type == "FILES") or ($get_type == "SCREEN")) {
        $color = "#83af9b";
    }
    if ($get_type == "RPGLE/COPYBOOK") {
        $color = "#cbbf97";
    }
    if ($get_type == "BNDDIR") {
        $color = "#EEAC99";
    }
    if ($get_type == "SQLRPGLE/COPYBOOK") {
        $color = "#f55f51";
    }
    if ($get_type == "PROCEDURE") {
        $color = "#6D3DC8";
    }
    return $color;
}


if (isset($_SESSION['name'])) {
?>


    <!DOCTYPE html>
    <html lang="en">

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
    <!-- <link href="/DT/dt/vendors/nprogress/nprogress.css" rel="stylesheet"> -->


    <!-- Custom Theme Style -->
    <!-- <link href="/DT/dt/build/css/custom.min.css" rel="stylesheet"> -->
    <!-- <link href="/DT/dt/vendors/vis/vis-network.min.css" rel="stylesheet" type="text/css" /> -->

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
                                                        <h2>Control Flow Chart</h2>
                                                    </div>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <!-- Chart goes here -->
                                                    <div id="mynetwork"></div>
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
        <script src="/DT/dt/vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/DT/dt/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="/DT/dt/vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="/DT/dt/vendors/nprogress/nprogress.js"></script>
        <!-- iCheck -->
        <script src="/DT/dt/vendors/iCheck/icheck.min.js"></script>
        <!-- Datatables -->

        <!-- Custom Theme Scripts -->
        <script src="/DT/dt/build/js/custom.min.js"></script>
        <script type="text/javascript" src="/DT/dt/vendors/vis/vis.js"></script>


        <!-- Flow Diagram -->
        <script type="text/javascript">
            // create an array with nodes
            var newidarray = [];
            var nodes = new vis.DataSet([
                <?php
                $m = new MongoClient();
                $db = $m->barclaysd;
                $masterinventory_collection = $db->masterinventory;
                $startingpoint_collection = $db->startingpoint;
                $crossreference_collection = $db->crossreference;

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
                    echo "{id: 1, label: 'DMS',color: 'Red',border: 'Black'},";

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
                            echo "{id: " . $businessid . ", label:'" . $businesslabel . "', title: 'Business Features Under DMS',color: 'yellow'},";
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

                            // echo "just before get master details function call";
                            // try {
                            //     //code...
                            //     print_r(getMasterDetails($component_name, $component_type));
                            // } catch (Exception $e) {
                            //     //throw $th;
                            //     echo $e;
                            // }getMasterDetails
                            // printMyName('vignesh');
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

                        $inputarray = array('calling_component' => $inputname);
                        $crossreferences2 = $crossreference_collection->find($inputarray)->limit(100);
                        $checkarray = array();
                        $i = 0;
                        $callingcount = 0;
                        $setbusiness = false;

                        foreach ($crossreferences2 as $crossreference) {
                            $callingcount = $callingcount + 1;
                            $component_name = $crossreference['component_name'];
                            $component_type = $crossreference['component_type'];
                            $type = $component_type;

                            list($appname, $sloc, $status, $compid) = getMasterDetails($component_name, $component_type);

                            if (!in_array($component_name, $checkarray)) {
                                if ($compid == 0) {
                                    $compid = rand();
                                }
                                $returncolor = getColor($type, $color);
                                echo "{id: " . $compid . ",value1: '" . $component_type . "', label:'" . $component_name . "', title: 'Name:" . $component_name . "</br> Type:" . $component_type . "</br> LOC:" . $sloc . "</br> Application:" . $appname . "</br> Status:" . $status . "',color: '" . $returncolor . "',level:0},";

                                $idarray[$cid] = $compid;
                                $callingidarray[$cid] = $compid;
                                $cid = $cid + 1;

                                $checkarray[$i] = $component_name;
                                $i = $i + 1;
                            }
                        }
                    }
                }

                // function getColor($type, $color)
                // {
                //     $get_type = $type;
                //     if ($get_type == "RPGLE") {
                //         $color = "#ffeb8d";
                //     }
                //     if ($get_type == "CLLE") {
                //         $color = "#feaa9f";
                //     }
                //     if ($get_type == "SQLRPGLE") {
                //         $color = "#faca88";
                //     }
                //     if (($get_type == "PRINTER") or ($get_type == "FILES") or ($get_type == "SCREEN")) {
                //         $color = "#83af9b";
                //     }
                //     if ($get_type == "RPGLE/COPYBOOK") {
                //         $color = "#cbbf97";
                //     }
                //     if ($get_type == "BNDDIR") {
                //         $color = "#EEAC99";
                //     }
                //     if ($get_type == "SQLRPGLE/COPYBOOK") {
                //         $color = "#f55f51";
                //     }
                //     if ($get_type == "PROCEDURE") {
                //         $color = "#6D3DC8";
                //     }
                //     return $color;
                // }
                // function getMasterDetails($name, $type)
                // {
                //     echo "inside get master details function";
                //     $name1 = $name;
                //     $type1 = $type;
                //     $appname = "Unknown";
                //     $status = "Unknown";
                //     $sloc = 0;
                //     $compid = 0;

                //     $m = new MongoClient();
                //     $db = $m->barclaysd;
                //     $masterinventory_collection = $db->masterinventory;

                //     $input = array('component_name' => $name1, 'pdsname' => $type1);
                //     $masterresults = $masterinventory_collection->find($input);

                //     foreach ($masterresults as $masterresult) {
                //         $sloc = $masterresult['sloc'];
                //         $appname = $masterresult['ownership'];
                //         $status = $masterresult['status'];
                //         $compid = $masterresult['Compid'];
                //     }
                //     return array($appname, $sloc, $status, $compid);
                // }
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
                        } else {
                            $direction = "from";
                            echo "{from: " . 1 . ", to:" . $compid2 . ", arrows: '" . $direction . "',dashes:true, color:{color:'#45adae'} },";
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
            console.log(network);
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
                        //alert(isIdPresent);
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
                        addNode(getresponse);
                    }
                };
                xmlhttp.open("GET", "addnodes.php?inputname=" + nodeLabel2 + "&inputtype=" + nodeType2 + "&inputId=" + nodeId, true);
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
                            window.location.href = "controlFlow.php?input=" + nodeLabel + "." + nodeType + "&business=" + nodeBusiness;
                        } else {
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
                console.log('hidePopup Event');
            });
            network.on("select", function(params) {
                console.log('select Event:', params);
            });
            network.on("selectNode", function(params) {
                console.log('selectNode Event:', params);
            });
            network.on("selectEdge", function(params) {
                console.log('selectEdge Event:', params);
            });
            network.on("deselectNode", function(params) {
                console.log('deselectNode Event:', params);
            });
            network.on("deselectEdge", function(params) {
                console.log('deselectEdge Event:', params);
            });
            network.on("hoverNode", function(params) {
                console.log('hoverNode Event:', params);
            });
            network.on("hoverEdge", function(params) {
                console.log('hoverEdge Event:', params);
            });
            network.on("blurNode", function(params) {
                console.log('blurNode Event:', params);
            });
            network.on("blurEdge", function(params) {
                console.log('blurEdge Event:', params);
            });
        </script>
        <!-- /Flow Diagram -->

    </body>

    </html>
<?php
} else {
    header("location:login.php");
}
?>