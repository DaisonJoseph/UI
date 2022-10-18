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
  <link href="../assets/img/brand/c.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>
<style>
.font-white { 
		color: white !important;
	}
	
</style>

<body>
  <!-- Sidenav -->
  <nav style="background-color:#1C345D!important" class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="../index.html">
        <img src="../assets/img/brand/cap360.png" style="margin-left:-30px" class="navbar-brand-img" alt="...">
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
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="../examples/profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="../examples/profile.php" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="../examples/profile.php" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>
            <a href="../examples/profile.php" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item">
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
              <a href="../index.html">
                <img src="../assets/img/brand/cap360.png">
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
            <a class="nav-link" href="../index.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="tables.html">
              <i class="ni ni-laptop text-red"></i> Automation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="execution_log.php">
              <i class="ni ni-align-center text-green"></i> Execution Logs
            </a>
          </li>	
			<li class="nav-item">
			  <a class="nav-link" href="#navbar-dashboards" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards">
				<i class="ni ni-single-copy-04 text-white"></i>
				<span class="nav-link-text">Reports</span>
			  </a>
			  <div class="collapse" id="navbar-dashboards">
				<ul class="nav nav-sm flex-column">
				  <li class="nav-item">
					<a href="reports.php" class="nav-link">All Reports</a>
				  </li>
				  <li class="nav-item">
					<a href="masterinventory.php" class="nav-link">Master Inventory</a>
				  </li>
				  <li class="nav-item">
					<a href="crossreference.php" class="nav-link">Cross Reference</a>
				  </li>
				  <li class="nav-item">
					<a href="crud.php" class="nav-link">CRUD</a>
				  </li>
				  <li class="nav-item">
					<a href="tablesinventory.php" class="nav-link">Tables Inventory</a>
				  </li>
				  <li class="nav-item">
					<a href="masterinventory.php" class="nav-link">Master Inventory</a>
				  </li>
				  <li class="nav-item">
					<a href="masterinventory.php" class="nav-link">Master Inventory</a>
				  </li>
				  <li class="nav-item">
					<a href="masterinventory.php" class="nav-link">Master Inventory</a>
				  </li>				  
				</ul>
			  </div>
			</li>	  
          <li class="nav-item">
            <a class="nav-link" href="profile.php">
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
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <h1 style="color:#fff">CAP360 Automation</h1>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
				<?php
				$filename = "../uploads/".$_SESSION['email'].".jpg";	
				if (file_exists($filename)){	
				?>				
				<img alt="Image placeholder" src="../uploads/<?php echo $_SESSION['email'].".jpg"?>">
				<?php  
				}
				else{
				?>
				<img alt="Image placeholder" src="../uploads/default.jpg">
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
              <a href="../examples/profile.php" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="../examples/profile.php" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <a href="../examples/profile.php" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="../examples/profile.php" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item">
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
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
	<!-- Dark table -->
      <div class="row mt-5">
        <div style="margin-top: -10%" class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">CAP360 Prerequisites</h3>
            </div>
			<form action="../../php/BL/success04.php" method="POST" enctype="multipart/form-data">
				<div class="table-responsive">
				  <table class="table align-items-center table-dark table-flush">
					<thead class="thead-dark">
					  <tr>
						<th scope="col">Prerequisite Name</th>
						<th scope="col"></th>
						<th scope="col"></th>
						<th scope="col"></th>					
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<a href="#" class="avatar rounded-circle mr-3">
							  <img alt="Image placeholder" src="../assets/img/theme/sourcecode.jpg">
							</a>
							<div class="media-body">
							  <span class="mb-0 text-sm">Source Code</span>
							</div>
						  </div>
						</th>
						<td>
						<button id="sourcecode_id" class="btn btn-success btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span>
							<input type="file" name="file1">	
						</button>
						</td>
						<td>
						<button class="btn btn-danger btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>						
							<a onclick="clearFileInputField('sourcecode_id')">Clear</a>						
						</button>
						</td>
						<td>
						<button class="btn btn-icon btn-3 btn-primary btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>						
							<span class="btn-inner--text"><a href="./prerequistes excel/source_code.docx" class="font-white">Download Format</a></span>
						</button>
						</td>					
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<a href="#" class="avatar rounded-circle mr-3">
							  <img alt="Image placeholder" src="../assets/img/theme/transaction.jpg">
							</a>
							<div class="media-body">
							  <span class="mb-0 text-sm">Transaction Execution</span>
							</div>
						  </div>
						</th>
						<td>
						<button id="transexec_id" class="btn btn-success btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span>						
							<input type="file" name="filefield2">						
						</button>
						</td>
						<td>
						<button class="btn btn-danger btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>						
							<a onclick="clearFileInputField('transexec_id')">Clear</a>							
						</button>
						</td>
						<td>
						<button class="btn btn-icon btn-3 btn-primary btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>						
							<span class="btn-inner--text"><a href="./prerequistes excel/Transaction_execution.xlsx" class="font-white">Download Format</a></span>					
						</button>
						</td>					
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<a href="#" class="avatar rounded-circle mr-3">
							  <img alt="Image placeholder" src="../assets/img/theme/schedule.jpg">
							</a>
							<div class="media-body">
							  <span class="mb-0 text-sm">Scheduler Information</span>
							</div>
						  </div>
						</th>
						<td>
						<button id="schedulerinfo_id" class="btn btn-success btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span>						
							<input type="file" name="filefield3">						
						</button>
						</td>
						<td>
						<button class="btn btn-danger btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>						
							<a onclick="clearFileInputField('schedulerinfo_id')">Clear</a>						
						</button>
						</td>
						<td>
						<button class="btn btn-icon btn-3 btn-primary btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>						
							<span class="btn-inner--text"><a href="./prerequistes excel/schedular_information.xlsx" class="font-white">Download Format</a></span>					
						</button>
						</td>					
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<a href="#" class="avatar rounded-circle mr-3">
							  <img alt="Image placeholder" src="../assets/img/theme/mips.jpg">
							</a>
							<div class="media-body">
							  <span class="mb-0 text-sm">MIPS Report</span>
							</div>
						  </div>
						</th>
						<td>
						<button id="mips_id" class="btn btn-success btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span>						
							<input type="file" name="filefield4">						
						</button>
						</td>
						<td>
						<button class="btn btn-danger btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>						
							<a onclick="clearFileInputField('mips_id')">Clear</a>						
						</button>
						</td>
						<td>
						<button class="btn btn-icon btn-3 btn-primary btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>						
							<span class="btn-inner--text"><a href="./prerequistes excel/mips_report.xlsx" class="font-white">Download Format</a></span>					
						</button>
						</td>					
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<a href="#" class="avatar rounded-circle mr-3">
							  <img alt="Image placeholder" src="../assets/img/theme/tables.jpg">
							</a>
							<div class="media-body">
							  <span class="mb-0 text-sm">SysTables Information</span>
							</div>
						  </div>
						</th>
						<td>
						<button id="systables_id" class="btn btn-success btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span>						
							<input type="file" name="filefield5">						
						</button>
						</td>
						<td>
						<button class="btn btn-danger btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>						
							<a onclick="clearFileInputField('systables_id')">Clear</a>							
						</button>
						</td>
						<td>
						<button class="btn btn-icon btn-3 btn-primary btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>						
							<span class="btn-inner--text"><a href="./prerequistes excel/sys_table_information.xlsx" class="font-white">Download Format</a></span>						
						</button>
						</td>					
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<a href="#" class="avatar rounded-circle mr-3">
							  <img alt="Image placeholder" src="../assets/img/theme/listing.jpg">
							</a>
							<div class="media-body">
							  <span class="mb-0 text-sm">Compiler Listing</span>
							</div>
						  </div>
						</th>
						<td>
						<button id="complist_id" class="btn btn-success btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span>						
							<input type="file" name="filefield6">						
						</button>
						</td>
						<td>
						<button class="btn btn-danger btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>						
							<a onclick="clearFileInputField('complist_id')">Clear</a>						
						</button>
						</td>
						<td>
						<button class="btn btn-icon btn-3 btn-primary btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>						
							<span class="btn-inner--text">Download Format</span>						
						</button>
						</td>					
					  </tr>				  
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<a href="#" class="avatar rounded-circle mr-3">
							  <img alt="Image placeholder" src="../assets/img/theme/columns.jpg">
							</a>
							<div class="media-body">
							  <span class="mb-0 text-sm">SysColumns Information</span>
							</div>
						  </div>
						</th>
						<td>
						<button id="syscolinfo_id" class="btn btn-success btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span>						
							<input type="file" name="filefield7">						
						</button>
						</td>
						<td>
						<button class="btn btn-danger btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>						
							<a onclick="clearFileInputField('syscolinfo_id')">Clear</a>						
						</button>
						</td>
						<td>
						<button class="btn btn-icon btn-3 btn-primary btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>						
							<span class="btn-inner--text"><a href="./prerequistes excel/sys_coloumn_information.xlsx" class="font-white">Download Format</a></span>						
						</button>
						</td>					
					  </tr>				  
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<a href="#" class="avatar rounded-circle mr-3">
							  <img alt="Image placeholder" src="../assets/img/theme/startpoint.jpg">
							</a>
							<div class="media-body">
							  <span class="mb-0 text-sm">Staring Points</span>
							</div>
						  </div>
						</th>
						<td>
						<button id="startpoint_id" class="btn btn-success btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span>						
							<input type="file" name="filefield8">						
						</button>
						</td>
						<td>
						<button class="btn btn-danger btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>						
							<a onclick="clearFileInputField('startpoint_id')">Clear</a>						
						</button>
						</td>
						<td>
						<button class="btn btn-icon btn-3 btn-primary btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>						
							<span class="btn-inner--text"><a href="./prerequistes excel/start_point.xlsx" class="font-white">Download Format</a></span>						
						</button>
						</td>					
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<a href="#" class="avatar rounded-circle mr-3">
							  <img alt="Image placeholder" src="../assets/img/theme/stoppoint.jpg">
							</a>
							<div class="media-body">
							  <span class="mb-0 text-sm">Stop Points</span>
							</div>
						  </div>
						</th>
						<td>
						<button id="stoppoint_id" class="btn btn-success btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span>						
							<input type="file" name="filefield9">						
						</button>
						</td>
						<td>
						<button class="btn btn-danger btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>						
							<a onclick="clearFileInputField('stoppoint_id')">Clear</a>						
						</button>
						</td>
						<td>
						<button class="btn btn-icon btn-3 btn-primary btn-sm" type="button">
							<span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>						
							<span class="btn-inner--text"><a href="./prerequistes excel/stop_point.xlsx" class="font-white">Download Format</a></span>						
						</button>
						</td>					
					  </tr>		
					  <tr>
						<th scope="row">
						</th>
						<td>
						</td>
						<td>
						</td>
						<td>
						<button style="margin-left:-210%" class="btn btn-secondary" type="submit" name="uploadFile">
							<span class="btn-inner--icon"><i class="ni ni-send"></i></span>						
							<span class="btn-inner--text">Submit</span>						
						</button>					
						</td>					
					  </tr>					  
					</tbody>
				  </table>
				</div>
			</form>
          </div>
        </div>
      </div>
	  <!---Second Dark Table-->
		<form action="../../php/BL/setexecutionstatus.php" method="POST">
		  <div class="row mt-5">
			<div class="col">
			  <div class="card bg-default shadow">
				<div class="card-header bg-transparent border-0">
				  <h3 class="text-white mb-0">CAP360 Pre Reports</h3>
				</div>
				<div style="padding-left: 30px">
					<div class="row">
						<div style="padding-right: 30px" class="custom-control custom-radio mb-3">
						  <input name="execution_type" value="INDEPENDENT" class="custom-control-input" id="customRadio5" checked="" type="radio">
						  <label class="custom-control-label" for="customRadio5">Independent Reports</label>
						</div>
						<div class="custom-control custom-radio mb-3">
						  <input name="execution_type" value="DEPENDENT" class="custom-control-input" id="customRadio6" type="radio">
						  <label class="custom-control-label" for="customRadio6">Run Dependency</label>
						</div>
					</div>
				</div>
				<div class="table-responsive">
				  <table class="table align-items-center table-dark table-flush">
					<thead class="thead-dark">
					  <tr>
						<th scope="col">Report Name</th>
						<th scope="col">Required</th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<div class="media-body">
							  <span class="mb-0 text-sm">Master Inventory</span>
							</div>
						  </div>
						</th>
						<td>
						<div class="custom-control custom-control-alternative custom-checkbox mb-3">
						  <input class="custom-control-input" id="masterinventory" value="masterinventory" name="reports[]" type="checkbox">
						  <label class="custom-control-label" for="masterinventory"></label>
						</div>
						</td>
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<div class="media-body">
							  <span class="mb-0 text-sm">Cross Reference Report</span>
							</div>
						  </div>
						</th>
						<td>
						<div class="custom-control custom-control-alternative custom-checkbox mb-3">
						  <input class="custom-control-input" id="crossreference" value="crossreference" name="reports[]" type="checkbox">
						  <label class="custom-control-label" for="crossreference"></label>
						</div>
						</td>                  
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<div class="media-body">
							  <span class="mb-0 text-sm">JCL Cross Reference</span>
							</div>
						  </div>
						</th>
						<td>
						<div class="custom-control custom-control-alternative custom-checkbox mb-3">
						  <input class="custom-control-input" id="jcl_crossreference" value="jcl_crossreference" name="reports[]" type="checkbox">
						  <label class="custom-control-label" for="jcl_crossreference"></label>
						</div>
						</td>
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<div class="media-body">
							  <span class="mb-0 text-sm">CRUD Report</span>
							</div>
						  </div>
						</th>
						<td>
						<div class="custom-control custom-control-alternative custom-checkbox mb-3">
						  <input class="custom-control-input" id="crud" value="crud" name="reports[]" type="checkbox">
						  <label class="custom-control-label" for="crud"></label>
						</div>
						</td>
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<div class="media-body">
							  <span class="mb-0 text-sm">Field CRUD Report</span>
							</div>
						  </div>
						</th>
						<td>
						<div class="custom-control custom-control-alternative custom-checkbox mb-3">
						  <input class="custom-control-input" id="field_crud" value="field_crud" name="reports[]" type="checkbox">
						  <label class="custom-control-label" for="field_crud"></label>
						</div>
						</td>
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<div class="media-body">
							  <span class="mb-0 text-sm">Orphan Report</span>
							</div>
						  </div>
						</th>
						<td>
						<div class="custom-control custom-control-alternative custom-checkbox mb-3">
						  <input class="custom-control-input" id="orphan_report" value="orphan_report" name="reports[]" type="checkbox">
						  <label class="custom-control-label" for="orphan_report"></label>
						</div>
						</td>
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<div class="media-body">
							  <span class="mb-0 text-sm">Drop Impact Report</span>
							</div>
						  </div>
						</th>
						<td>
						<div class="custom-control custom-control-alternative custom-checkbox mb-3">
						  <input class="custom-control-input" id="drop_impact" value="drop_impact" name="reports[]" type="checkbox">
						  <label class="custom-control-label" for="drop_impact"></label>
						</div>
						</td>
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<div class="media-body">
							  <span class="mb-0 text-sm">Callchain Report</span>
							</div>
						  </div>
						</th>
						<td>
						<div class="custom-control custom-control-alternative custom-checkbox mb-3">
						  <input class="custom-control-input" id="callchain_overall" value="callchain_overall" name="reports[]" type="checkbox">
						  <label class="custom-control-label" for="callchain_overall"></label>
						</div>
						</td>
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<div class="media-body">
							  <span class="mb-0 text-sm">Expanding COBOL</span>
							</div>
						  </div>
						</th>
						<td>
						<div class="custom-control custom-control-alternative custom-checkbox mb-3">
						  <input class="custom-control-input" id="expand_cobol" value="expand_cobol" name="reports[]" type="checkbox">
						  <label class="custom-control-label" for="expand_cobol"></label>
						</div>
						</td>
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<div class="media-body">
							  <span class="mb-0 text-sm">Expanding JCL</span>
							</div>
						  </div>
						</th>
						<td>
						<div class="custom-control custom-control-alternative custom-checkbox mb-3">
						  <input class="custom-control-input" id="expand_jcl" value="expand_jcl" name="reports[]" type="checkbox">
						  <label class="custom-control-label" for="expand_jcl"></label>
						</div>
						</td>
					  </tr>
					  <tr>
						<th scope="row">
						  <div class="media align-items-center">
							<div class="media-body">
							  <span class="mb-0 text-sm">IMS CRUD</span>
							</div>
						  </div>
						</th>
						<td>
						<div class="custom-control custom-control-alternative custom-checkbox mb-3">
						  <input class="custom-control-input" id="ims_crud" value="ims_crud" name="reports[]" type="checkbox">
						  <label class="custom-control-label" for="ims_crud"></label>
						</div>
						</td>
					  </tr>
					  <tr>
						<th scope="row">
						</th>
						<td>
						<button style="margin-left:-20%" class="btn btn-success" type="submit" name="GenerateReport">
							<span class="btn-inner--icon"><i class="ni ni-send"></i></span>						
							<span class="btn-inner--text">Run the Reports</span>						
						</button>					
						</td>					
					  </tr>					  
				   </tbody>
				  </table>
				</div>
			  </div>
			</div>
		  </div>
		</form>	  
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
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
  <!-- User Defined JS -->
  <script src="../assets/js/userdefined.js"></script>
</body>

</html>
<?php
}
else
	header("location:login.php");
?>