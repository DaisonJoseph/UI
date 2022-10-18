<?php
//sec_session_start();

session_start();

if (isset($_SESSION['name']))
{
		$imagetobeused = $_SESSION['image'];
		$nametobeused = $_SESSION['name'];
}
else
{
	ob_start();
     if (headers_sent()) 
	 {
		die("Redirect failed.");
     }
	 else
	 {
		exit(header("Location: login.php"));
	 }

}
?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	<link href="../vendors/vis/vis-network.min.css" rel="stylesheet" type="text/css"/>
	
	<style type="text/css">
        #mynetwork {
            width: 1000px;
            height: 600px;
        }
    </style>
	
  </head>

  <body class="nav-md">
    <div class="container body">
		<div class="main_container">
			<!-- Headers -->
			<?php
			   include "headers.php";
			?>
			<!-- /Headers -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left"></div>   	  
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<h2>Control Flow Diagram</h2>
								<div class="col-md-2 col-sm-12 col-xs-12"></div>
								<div class="x_content">
									<div id="mynetwork"></div>
									<pre id="eventSpan"></pre>				  	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
    var nodes = new vis.DataSet([
		<?php
			$m = New MongoClient();
			$db = $m->barclaysd;
			$masterinventory_collection = $db->masterinventory;
			$startingpoint_collection = $db->startingpoint;
			$crossreference_collection = $db->crossreference;
			
			$color = "black";
			$called = "no";
			//For Business Functions only
			if(!isset($_GET['input']))
			{
				$direction = "to";
				echo "{id: 1, label: 'VIM',color: 'Red',border: 'Black'},";
				
				$id = 2;
				$businesses = $startingpoint_collection->distinct('business');
				for ($i=0; $i <count($businesses); $i++)
				{
					$business = $businesses[$i];
					//$businesslabel = strpos("");
					echo "{id: ".$id .", label:'" .$business ."', title: '" .$business ."',color: 'yellow'},";
					$id = $id + 1;
				}
			}
			else
			{
				$inputvalue = $_GET['input'];
				$inputname = $inputvalue;
				$istype = strpos($inputvalue,".");
				$inputlen = strlen($inputvalue);
				if ($istype > 0)
				{
					$inputname = substr($inputvalue,0,$istype);
					$inputtype = substr($inputvalue,$istype+1,$inputlen-1);
					$type = $inputtype;
				}
				$startingpoints = $startingpoint_collection->find(array('business'=>$inputname));
				$startingpointcount = $startingpoint_collection->find(array('business'=>$inputname))->count();
				$direction = "to";
				//Only if the input value is business
				
				if($startingpointcount > 0)
				{
					echo "{id: 1, label: '" .$inputname ."',color: 'yellow',border: 'Black'},";				
					$id = 2;					
					
					foreach($startingpoints as $startingpoint)
					{
						$component_name = $startingpoint['component_name'];
						$component_type = $startingpoint['type'];
						$type = $component_type;
						
						$returncolor = getColor($type,$color);
						
						echo "{id: ".$id .", value1:'" .$component_type ."', label:'" .$component_name ."', title: 'Type:" .$component_type ."',color: '".$returncolor."'},";
						$id = $id + 1;	
					}
				}
				else	/* If the input is component */
				{
					$inputarray = array('component_name'=>$inputname,'component_type'=>$inputtype );
					$crossreferences1 = $crossreference_collection->find($inputarray)->limit(100);
					$direction = "to";
					
					$returncolor = getColor($type,$color);
					
					echo "{id: 1, label: '" .$inputname ."',value1: '" .$inputtype ."',color: '".$returncolor."',border: 'Black'},";				
					$id = 2;					
					$checkarray = array();
					$i = 0;
					foreach($crossreferences1 as $crossreference)
					{
						$component_type = $crossreference['component_type'];
						$calling_component = $crossreference['calling_component'];
						$calling_type = $crossreference['calling_type'];
						$type = $calling_type;
						
						$masterresults = $masterinventory_collection->find(array('component_name'=>$calling_component,'pdsname'=>$calling_type));
						$appname = "Unknown";
						$orphan = "No";
						$dead = "No";
						$loc = "Unknown";						
						foreach($masterresults as $masterresult)
						{
							$loc = $masterresult['loc'];
							$appname = $masterresult['ownership'];
							$orphan = $masterresult['orphan'];
							if (($orphan == "N") or ($orphan == ""))
							{
								$orphan = "No";
							}
							if ($orphan == "Y")
							{
								$orphan = "Yes";
							}
							$dead = $masterresult['dead'];
							if (($dead == "") or ($dead == "N"))
							{
								$dead = "No";
							}
						}
						
						if (!in_array($calling_component,$checkarray))
						{
							$returncolor = getColor($type,$color);
							echo "{id: ".$id .",value1: '" .$calling_type ."', label:'" .$calling_component ."', title: 'Name:" .$calling_component ."</br> Type:" .$calling_type ."</br> LOC:" .$loc ."</br> Application:" .$appname ."</br> Orphan:" .$orphan ."</br> Dead:" .$dead. "',color: '".$returncolor."'},";
							$id = $id + 1;
							$fromid = $id;
							$checkarray[$i] = $calling_component;
							$i = $i + 1;
						}
						
					}
					
					$inputarray = array('calling_component'=>$inputname);
					$crossreferences2 = $crossreference_collection->find($inputarray)->limit(100);
					$checkarray = array();
					$i = 0;
					foreach($crossreferences2 as $crossreference)
					{
						$component_name = $crossreference['component_name'];
						$component_type = $crossreference['component_type'];					
						$type = $component_type;
						
						$masterresults = $masterinventory_collection->find(array('component_name'=>$component_name,'pdsname'=>$component_type));

						$appname = "Unknown";
						$orphan = "No";
						$dead = "No";
						$loc = "Unknown";						
						foreach($masterresults as $masterresult)
						{
							$loc = $masterresult['loc'];
							$appname = $masterresult['ownership'];
							$orphan = $masterresult['orphan'];
							$dead = $masterresult['dead'];
							if (($orphan == "N") or ($orphan == ""))
							{
								$orphan = "No";
							}
							if ($orphan == "Y")
							{
								$orphan = "Yes";
							}
							$dead = $masterresult['dead'];
							if (($dead == "") or ($dead == "N"))
							{
								$dead = "No";
							}
						}
												
						if (!in_array($component_name,$checkarray))
						{
							$returncolor = getColor($type,$color);
							echo "{id: ".$id .",value1: '" .$component_type ."', label:'" .$component_name ."', title: 'Name:" .$component_name ."</br> Type:" .$component_type ."</br> LOC:" .$loc ."</br> Application:" .$appname ."</br> Orphan:" .$orphan ."</br> Dead:" .$dead. "',color: '".$returncolor."'},";
							$id = $id + 1;
							$checkarray[$i] = $component_name;
							$i = $i + 1;
						}
					}
				}
			}
			
			function getColor($type,$color)
			{
				$get_type = $type;
				if ($get_type == "PROGRAM")
				{
					$color = "#ffeb8d";
				}
				if ($get_type == "JCL")
				{
					$color = "#feaa9f";
				}
				if ($get_type == "PROCEDURE")
				{
					$color = "#faca88";
				}
				if (($get_type == "FILE") or ($get_type == "FILES"))
				{
					$color = "#83af9b";
				}
				if ($get_type == "REXX")
				{
					$color = "#cbbf97";
				}
				if ($get_type == "CNTLCARD")
				{
					$color = "#EEAC99";
				}
				if ($get_type == "COPYBOOK")
				{
					$color = "#f55f51";
				}
				if ($get_type == "VSAMDEF")
				{
					$color = "#6D3DC8";
				}
				return $color;
			}
			
		?>
    ]);

    // create an array with edges
    var edges = new vis.DataSet([
		<?php
			
			for ($idvalue = 2; $idvalue < $id; $idvalue++)
			{
				if ($idvalue < $fromid)
				{	$direction = "to";
					echo "{from: ". 1 .", to:" .$idvalue .", arrows: '".$direction."', color:{color:'black'} },";
				}
				else
				{
					$direction = "from";
					echo "{from: ". 1 .", to:" .$idvalue .", arrows: '".$direction."',dashes:true, color:{color:'#45adae'} },";
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
			interaction:{hover:true},
			manipulation: {
				enabled: true
			}
		};

    var network = new vis.Network(container, data, options);

    network.on("click", function (params) {
        
    });
    network.on("doubleClick", function (params) {
        if (params.nodes.length > 0)
		{
			var nodeId = params.nodes[0];
            nodeLabel = nodes.get(nodeId).label;
            nodeType = nodes.get(nodeId).value1;
				
			if (!!nodeType)
			{
				window.location.href = "visgraph.php?input=" + nodeLabel + "." +nodeType;
			}
			else
			{
				window.location.href = "visgraph.php?input=" + nodeLabel;				
			}
		}
    });
    network.on("oncontext", function (params) {
        params.event = "[original event]";
        document.getElementById('eventSpan').innerHTML = '<h2>oncontext (right click) event:</h2>' + JSON.stringify(params, null, 4);
    });
    network.on("zoom", function (params) {
        document.getElementById('eventSpan').innerHTML = '<h2>zoom event:</h2>' + JSON.stringify(params, null, 4);
    });
    network.on("showPopup", function (params) {
        document.getElementById('eventSpan').innerHTML = '<h2>showPopup event: </h2>' + JSON.stringify(params, null, 4);
    });
    network.on("hidePopup", function () {
        console.log('hidePopup Event');
    });
    network.on("select", function (params) {
        console.log('select Event:', params);
    });
    network.on("selectNode", function (params) {
        console.log('selectNode Event:', params);
    });
    network.on("selectEdge", function (params) {
        console.log('selectEdge Event:', params);
    });
    network.on("deselectNode", function (params) {
        console.log('deselectNode Event:', params);
    });
    network.on("deselectEdge", function (params) {
        console.log('deselectEdge Event:', params);
    });
    network.on("hoverNode", function (params) {
        console.log('hoverNode Event:', params);
    });
    network.on("hoverEdge", function (params) {
        console.log('hoverEdge Event:', params);
    });
    network.on("blurNode", function (params) {
        console.log('blurNode Event:', params);
    });
    network.on("blurEdge", function (params) {
        console.log('blurEdge Event:', params);
    });
</script>
    <!-- /Flow Diagram -->
  </body>
</html>