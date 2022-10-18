<?php
ob_start();
session_start();
?>
<?php
if(isset($_SESSION['name']))
{
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>CAP360 - Automation</title>
  <!-- Favicon -->
  <link href="./assets/img/brand/c.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <style>
  @import 'https://code.highcharts.com/css/highcharts.css';
		#chartdiv {
		  width: 100%;
		  height: 300px;
		}
		#chartdiv1 {
		  width: 100%;
		  height: 300px;
		}
		#missing {
		  width: 100%;
		  height: 300px;
		}
		#orphan {
		  width: 100%;
		  height: 300px;
		}
	</style>
</head>

<body>
  <!-- Sidenav -->
  <nav style="background-color:#1C345D!important" class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="./index.php">
        <img src="./assets/img/brand/cap360.png" style="margin-left:-30px" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
				<?php
				$filename = "uploads/".$_SESSION['email'].".jpg";	
				if (file_exists($filename)){	
				?>				
				<img alt="Image placeholder" src="uploads/<?php echo $_SESSION['email'].".jpg"?>">
				<?php  
				}
				else{
				?>
				<img alt="Image placeholder" src="uploads/default.jpg">
				<?php	
				}				
				?>
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION['name'] ?></span>
                </div>
              </div>
            </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="./examples/profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="./examples/profile.php" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="./examples/profile.php" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>
            <a href="./examples/profile.php" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="examples/logout.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.php">
                <img src="./assets/img/brand/cap360.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>		  
          <!--<li class="nav-item">
            <a class="nav-link" href="examples/tables.php">
              <i class="ni ni-laptop text-red"></i> Automation
            </a>
          </li>-->
          <!--<li class="nav-item">
            <a class="nav-link" href="examples/execution_log.php">
              <i class="ni ni-align-center text-green"></i> Execution Logs
            </a>
          </li>-->
			<li class="nav-item">
			  <a class="nav-link" href="#navbar-dashboards" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards">
				<i class="ni ni-single-copy-04 text-white"></i>
				<span class="nav-link-text">Reports</span>
			  </a>
			  <div class="collapse" id="navbar-dashboards">
				<ul class="nav nav-sm flex-column">
				  <li class="nav-item">
					<a href="examples/reports.php" class="nav-link">All Reports</a>
				  </li>
				  <li class="nav-item">
					<a href="examples/masterinventory.php" class="nav-link">Master Inventory</a>
				  </li>
				  <li class="nav-item">
					<a href="examples/crossreference.php" class="nav-link">Cross Reference</a>
				  </li>
				  <li class="nav-item">
					<a href="examples/missingreport.php" class="nav-link">Missing Report</a>
				  </li>		
				  <li class="nav-item">
					<a href="examples/callchain.php" class="nav-link">Call Chain Report</a>
				  </li>					  
				  <li class="nav-item">
					<a href="examples/crud.php" class="nav-link">CRUD</a>
				  </li>
				  <li class="nav-item">
					<a href="examples/tablesinventory.php" class="nav-link">Tables Inventory</a>
				  </li>  
				</ul>
			  </div>
			</li>		  
          <li class="nav-item">
            <a class="nav-link" href="examples/profile.php">
              <i class="ni ni-single-02 text-yellow"></i> User profile
            </a>
          </li>
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Documentation</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
              <i class="ni ni-spaceship"></i> Getting started
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
              <i class="ni ni-palette"></i> Foundation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
              <i class="ni ni-ui-04"></i> Components
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
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
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <h1 style="color:#fff">Dashboard</h1>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
			<li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-ungroup"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
                <div class="row shortcuts px-4 text-center">
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                      <i class="ni ni-calendar-grid-58"></i>
                    </span>
                    <small>Calendar</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                      <i class="ni ni-email-83"></i>
                    </span>
                    <small>Email</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                      <i class="ni ni-credit-card"></i>
                    </span>
                    <small>Payments</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                      <i class="ni ni-books"></i>
                    </span>
                    <small>Reports</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                      <i class="ni ni-pin-3"></i>
                    </span>
                    <small>Maps</small>
                  </a>
                  <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                      <i class="ni ni-basket"></i>
                    </span>
                    <small>Shop</small>
                  </a>
                </div>
              </div>
            </li>		
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
				<?php
				$filename = "uploads/".$_SESSION['email'].".jpg";	
				if (file_exists($filename)){	
				?>				
				<img alt="Image placeholder" src="uploads/<?php echo $_SESSION['email'].".jpg"?>">
				<?php  
				}
				else{
				?>
				<img alt="Image placeholder" src="uploads/default.jpg">
				<?php	
				}				
				?>
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION['name'] ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="./examples/profile.php" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="./examples/profile.php" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <a href="./examples/profile.php" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="./examples/profile.php" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="examples/logout.php" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row mb-2">
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" id="card">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">No. of Components</h5>
                      <span class="h2 font-weight-bold mb-0">35676</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" id="card">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total LOC</h5>
                      <span class="h2 font-weight-bold mb-0">4456787</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" id="card">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">No. of Active JCL</h5>
                      <span class="h2 font-weight-bold mb-0">56789</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>		  
		  <div class="row">
			<div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" id="card">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Active JCL LOC</h5>
                      <span class="h2 font-weight-bold mb-0">2434678</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" id="card">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">No. of Tables</h5>
                      <span class="h2 font-weight-bold mb-0">5467889</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" id="card">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">No. of Orphan Tables</h5>
                      <span class="h2 font-weight-bold mb-0">432567 </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>			
		  </div>		
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">	 
		<div class="row mt-4">
			<div class="col-xl-6 mb-5 mb-xl-0">
			  <div class="card shadow">
				<div class="card-header border-0">
				  <div class="row align-items-center">
					<div class="col">
					  <h3 class="mb-0">Master Inventory <small>Total Components</small></h3>
					</div>
				  </div>
				</div>
				<div class="table-responsive">
				  <!-- Projects table -->
				  <table class="table align-items-center table-flush">
					<thead class="thead-light">
					  </thead>
					  <tbody>
						<div class="clearfix"></div>
						<div class="x_content">
							 <div id="chartdiv"></div>
						</div>
					  </tbody>
				  </table>
				</div>
			  </div>
			</div>		
			<div class="col-xl-6 mb-5 mb-xl-0">
			  <div class="card shadow">
				<div class="card-header border-0">
				  <div class="row align-items-center">
					<div class="col">
					  <h3 class="mb-0">Master Inventory <small>Total LOC</small></h3>
					</div>

				  </div>
				</div>
				<div class="table-responsive">
				  <!-- Projects table -->
				  <table class="table align-items-center table-flush">
					<thead class="thead-light">
					  </thead>
					  <tbody>
						<div class="clearfix"></div>
						<div class="x_content">
							<div id="chartdiv1"></div>
						</div>
					  </tbody>
				  </table>
				</div>
			  </div>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-xl-6 mb-5 mb-xl-0">
			  <div class="card shadow">
				<div class="card-header border-0">
				  <div class="row align-items-center">
					<div class="col">
					  <h3 class="mb-0">Missing Components </h3>
					</div>
				  </div>
				</div>
				<div class="table-responsive">
				  <!-- Projects table -->
				  <table class="table align-items-center table-flush">
					<thead class="thead-light">
					  </thead>
					  <tbody>
						<div class="clearfix"></div>
						<div class="x_content">
							 <div id="missing"></div>
						</div>
					  </tbody>
				  </table>
				</div>
			  </div>
			</div>		
			<div class="col-xl-6 mb-5 mb-xl-0">
			  <div class="card shadow">
				<div class="card-header border-0">
				  <div class="row align-items-center">
					<div class="col">
					  <h3 class="mb-0">Orphan components <small>Total Components</small></h3>
					</div>

				  </div>
				</div>
				<div class="table-responsive">
				  <!-- Projects table -->
				  <table class="table align-items-center table-flush">
					<thead class="thead-light">
					  </thead>
					  <tbody>
						<div class="clearfix"></div>
						<div class="x_content">
							<div id="orphan"></div>
						</div>
					  </tbody>
				  </table>
				</div>
			  </div>
			</div>
		</div> 
	  <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2019<a href="#" class="font-weight-bold ml-1" target="_blank">Legacy Revitalization</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">About Us</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Core -->
  <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>
    <!-- Chart Scripts -->
  <script src="https://www.amcharts.com/lib/4/core.js"></script>
  <script src="https://www.amcharts.com/lib/4/charts.js"></script>
  <script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script>
  <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
  <script src="https://www.amcharts.com/lib/4/plugins/sunburst.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
	
	
	<script>
	am4core.ready(function() {
	
	// Themes begin
	am4core.useTheme(am4themes_animated);
	// Themes end
	
	var chart = am4core.create("chartdiv", am4charts.PieChart3D);
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
	var series = chart.series.push(new am4charts.PieSeries3D());
	series.dataFields.value = "litres";
	series.dataFields.category = "country";
	
	}); // end am4core.ready()

	</script>

	<script>
	am4core.ready(function() {
	
	// Themes begin
	am4core.useTheme(am4themes_animated);
	// Themes end
	
	// Create chart instance
	var chart = am4core.create("chartdiv1", am4charts.PieChart);
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
			];
			
			// Add data
			chart.data = generateChartData();
			// Add and configure Series
			var pieSeries = chart.series.push(new am4charts.PieSeries());
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
					label: types[i].status,
					pulled: true
					});
				}
				} else {
				chartData.push({
					type: types[i].type,
					percent: types[i].percent,
					color: types[i].color,
					label: types[i].status,
					id: i
				});
				}
			}
			return chartData;
			}
			
			pieSeries.slices.template.events.on("hit", function(event) {
			if (event.target.dataItem.dataContext.id != undefined) {
				selected = event.target.dataItem.dataContext.id;
			} else {
				selected = undefined;
			}
			chart.data = generateChartData();
			});
			
			}); // end am4core.ready()
	</script>
	<script>
	am4core.ready(function() {
	
	// Themes begin
	am4core.useTheme(am4themes_animated);
	// Themes end
	
	// Create chart
	var chart = am4core.create("missing", am4charts.PieChart);
	chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
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
		/*
		{
		type: "COPYBOOK",
		value: 24
		},
		{
		type: "PARMLIB",
		value: 53
		},
		{
		type: "PROC",
		value: 194
		}*/
		<?php
		}
		}
		?>
	];
	var series = chart.series.push(new am4charts.PieSeries());
	series.dataFields.value = "value";
	series.dataFields.radiusValue = "value";
	series.dataFields.category = "type";
	series.slices.template.cornerRadius = 6;
	series.colors.step = 3;
	
	series.hiddenState.properties.endAngle = -90;
	
	chart.legend = new am4charts.Legend();
	
	}); // end am4core.ready()
	</script>
	<script>
	am4core.ready(function() {
	
	// Themes begin
	am4core.useTheme(am4themes_animated);
	// Themes end
	
	// Create chart instance
	var chart = am4core.create("orphan", am4charts.XYChart3D);
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
  ];// Create axes
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
var series = chart.series.push(new am4charts.ConeSeries());
series.dataFields.valueY = "value";
series.dataFields.categoryX = "type";

var columnTemplate = series.columns.template;
columnTemplate.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

columnTemplate.adapter.add("stroke", function(stroke, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

}); // end am4core.ready()
</script>

</body>
</html>
<?php
}
else
	header("location:examples/login.php");
?>