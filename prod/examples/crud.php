<?php
ob_start();
session_start();
$m = new MongoClient();
$db = $m->bnpp;
$collection = $db->crud;
$cursor = $collection->find();
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
  <title>CAP360 - CRUD</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/c.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">
  <!-- User Defined Styles -->
  <!-- Links for Data Table -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.bootstrap4.min.css">
<!----<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>--->
<script src="../assets/js/jquery.js"></script>
<script src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.bootstrap4.min.js"></script>  
  <style>
table#example {
    font-size: 0.8rem;
}

#example tbody tr {
    cursor: pointer;
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
      <a class="navbar-brand pt-0" href="../index.php">
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
              <a href="../index.php">
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
					<a href="missingreport.php" class="nav-link">Missing Report</a>
				  </li>		
				  <li class="nav-item">
					<a href="callchain.php" class="nav-link">Call Chain Report</a>
				  </li>					  

				  <li class="nav-item">
					<a href="crud.php" class="nav-link active">CRUD</a>
				  </li>
				  <li class="nav-item">
					<a href="tablesinventory.php" class="nav-link">Tables Inventory</a>
				  </li>
			<!--	  <li class="nav-item">
					<a href="masterinventory.php" class="nav-link">Master Inventory</a>
				  </li>
				  <li class="nav-item">
					<a href="masterinventory.php" class="nav-link">Master Inventory</a>
				  </li>
				  <li class="nav-item">
					<a href="masterinventory.php" class="nav-link">Master Inventory</a>
				  </li>		-->				  
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
        <h1 style="color:#fff">CAP360 - CRUD</h1>
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
	<div class='container'>
		<div class="card" style="overflow-x: auto;">
			<div class="card-body">	
				<table class="table table-hover" id="example" cellspacing="0">
				<thead>
					<tr>
					<th>Calling Component Name</th>
					<th>Calling Component Type</th>
					<th>Table Name</th>
					<th>Operation</th>
					<th>SQL Query</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($cursor as $document) {?>
					<tr>
						<td><?php echo $document["calling_component_name"];?></td>
						<td><?php echo $document["calling_component_type"];?></td>
						<td><?php echo $document["table_name"];?></td>
						<td><?php echo $document["operation"];?></td>
						<td><?php echo $document["sql_query"];}?></td>
					</tr>				
				</tbody>
				</table>

			</div><!-- Card body END -->
		</div><!-- Card END -->
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
  <script>
// PARAMS
var TableID         = '#example';
var TooltipText     = 'Click here to edit';
var SelectRowClass  = 'bg-primary'; // To force Bootstrap's primary colour or any other
//


var table = $(TableID).DataTable({
    "dom": "<'card-body pl-0 pr-0 pt-0'<'row align-items-center'<'col-12 col-md-6'B><'col-6'f>>>" +
            "<'row'<'col-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    buttons: [
    // FIXED CONTROL BUTTONS
        // Page rows
        'pageLength',
        
        // Export to CSV
        {
            className: 'ml-2 rounded',
            text: 'Export',
            extend: 'csvHtml5'
        },
    // END FIXED CONTROL
    
    // SELECTED ROWS BUTTONS
    // Those buttons appear when there are selected buttons
        {
            text: 'Edit',
            // .ml-2 and .rounded-left to make a flawless space between this first button and the fixed ones 
            // .btn-req-selection to make the show/disapear behaviour
            // .invisible to make it invisible by default 
            className: 'ml-2 rounded-left btn-req-selection invisible',  
            action: function ( e, dt, node, config ) {
                var SelectedRow = dt.rows({ selected: true }).data().join(',');
                alert(SelectedRow);
            }
        },                
        {
            text: 'Lock',
            className: 'btn-req-selection invisible', // Basic classes for selection control and invisibility
            action: function ( e, dt, node, config ) {
                var SelectedRow = dt.rows({ selected: true }).data().join(',');
                alert(SelectedRow);
            }
        },
        {
            text: 'Delete',
            className: 'btn-req-selection invisible btn-danger', // Bootstrap's btn-danger for delete
            action: function ( e, dt, node, config ) {
                var SelectedRow = dt.rows({ selected: true }).data().join(',');
                alert(SelectedRow);
            }
        }
        
    ],                    
    "select": {
        "style":    'os',
        "blurable": true
    },
});

// ROW SELECTION
//
// I had to force Bootstrap's primary colour to highlight the selection. 
// I also used Bootstrap's invisible class to make the buttons appear/disappear
// depending on row selection
table.on( 'select', function ( e, dt, type, indexes ) {
    // Set Bootstrap's highlight 
    indexes.forEach(function (element, index, array) {
        table.row(element).nodes().to$().addClass( 'text-white ' + SelectRowClass);    
    });

    // Make '.btn-req-selection' buttons visible
    $('div.dt-buttons a.btn-req-selection').removeClass('invisible');
} );

// ROW DESELECTION
table.on( 'deselect', function ( e, dt, type, indexes ) {
    // Removing Bootstrap's highlight
    indexes.forEach(function (element, index, array) {
        table.row(element).nodes().to$().removeClass( 'text-white ' + SelectRowClass);    
    });   

    // Make '.btn-req-selection' buttons invisible
    if (table.rows( { selected: true } ).data().length == 0 ) {
        $('div.dt-buttons a.btn-req-selection').addClass('invisible');
    }            
});


// To make the control buttons smaller
$('div.dt-buttons').addClass('btn-group-sm'); 

// Adding table's tooltip
$(TableID + ' tr').attr('title', TooltipText);  
  </script>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
  <!-- Ajax JS -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- User Defined JS -->
  <script src="../assets/js/userdefined.js"></script>
</body>
</html>
<?php
}
else
	header("location:login.php");
?>