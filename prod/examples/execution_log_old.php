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
  <title>CAP360 - Execution Logs</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/c.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <style>
  th{
	  padding:10px !important;
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
            <a class="nav-link" href="tables.php">
              <i class="ni ni-laptop text-red"></i> Automation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="execution_log.php">
              <i class="ni ni-align-center text-green"></i> Execution Logs
            </a>
          </li>	
		  <li>
            <a class="nav-link" href="reports.php">
              <i class="ni ni-single-copy-04 text-white"></i> Reports
            </a>
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
        <h1 style="color:#fff">CAP360 - Execution Logs</h1>
        <!-- Form -->
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
        <div style="margin-top: -7%" class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">Reports to be executed</h3>
            </div>
			<div class="table-responsive">
			  <table class="table align-items-center table-dark table-flush">
				<thead class="thead-dark">
				  <tr>
					  <th>Report ID</th>
					  <th>Report Name</th>
					  <th>Report Level</th>
					  <th>Report Status</th>
					  <th>Total Threads</th>
					  <th>Current Threads</th>
					  <th>Completed Threads</th>					
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>				  
				</tbody>
			  </table>
			</div>
          </div>
        </div>
      </div>
	  <!---Second Dark Table-->
		<div class="row mt-5">
			<div class="col">
			  <div class="card bg-default shadow">
				<div class="card-header bg-transparent border-0">
				  <h3 class="text-white mb-0">Reports executing</h3>
				</div>
				<div class="table-responsive">
				  <table class="table align-items-center table-dark table-flush">
					<thead class="thead-dark">
					  <tr>
						  <th>Report ID</th>
						  <th>Report Name</th>
						  <th>Report Level</th>
						  <th>Report Status</th>
						  <th>Total Threads</th>
						  <th>Current Threads</th>
						  <th>Completed Threads</th>					
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>600</td>
						<td>drop_impact</td>
						<td>6</td>
						<td>WAITING</td>
						<td>1</td>	
						<td>1</td>
						<td>0</td>						
					  </tr>				  
					</tbody>
				  </table>
				</div>
			  </div>
			</div>
		</div>	  
	  <!---Third Dark Table-->
      <div class="row mt-5">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">Reports Completed</h3>
            </div>
			<div class="table-responsive">
			  <table class="table align-items-center table-dark table-flush">
				<thead class="thead-dark">
				  <tr>
					  <th>Report ID</th>
					  <th>Report Name</th>
					  <th>Report Level</th>
					  <th>Report Status</th>
					  <th>Total Threads</th>
					  <th>Current Threads</th>
					  <th>Completed Threads</th>					
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>	
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>	
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>	
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>	
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>	
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>	
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>	
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>	
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>	
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>	
				  <tr>
					<td>600</td>
					<td>drop_impact</td>
					<td>6</td>
					<td>WAITING</td>
					<td>1</td>	
					<td>1</td>
					<td>0</td>						
				  </tr>					  
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