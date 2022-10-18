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
  <title>CAP360 - MyProfile</title>
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
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="../examples/profile.html" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>
            <a href="../examples/profile.html" class="dropdown-item">
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
					<a href="missingreport.php" class="nav-link active">Missing Report</a>
				  </li>		
				  <li class="nav-item">
					<a href="callchain.php" class="nav-link">Call Chain Report</a>
				  </li>
				  <li class="nav-item">
					<a href="crud.php" class="nav-link">CRUD</a>
				  </li>
				  <li class="nav-item">
					<a href="tablesinventory.php" class="nav-link">Tables Inventory</a>
				  </li>				  
				</ul>
			  </div>
			</li>		  
          <li class="nav-item">
            <a class="nav-link active" href="profile.php">
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
      $db = $m->bnpp;
      $collection = $db->user;
      $result = $collection->findOne(array('emailid'=>$_SESSION['email']));
	  $email = $result['emailid'];
	  $username = $result['name'];
	  $fname = $result['fname'];
	  $lname = $result['lname'];
	  $address = $result['address'];
	  $city = $result['city'];
	  $country = $result['country'];
	  $pcode = $result['postal_code'];
	  $aboutme = $result['about_me'];
	  
    ?>



  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <h1 style="color:#fff">User profile</h1>
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
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
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
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 200px;background-color:#676EE4 !important;">
      <!-- Mask -->
      <!-- Header container -->
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
			<div class="col-xl-12 order-xl-1">
				<div class="card bg-secondary shadow">
					<div class="card-header bg-white border-0">
					  <div class="row align-items-center">
						<div class="col-4">
						  <h3 class="mb-0">My account</h3>
						</div>
						<ul class="nav nav-pills">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#home">View Profile</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#messages">Edit Profile</a>
							</li>
						</ul>
					  </div>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane active" id="home">
								<div class="row">
									<div class="col-xl-8">
										<form>
											<h6 class="heading-small text-muted mb-4">User information</h6>
											<div class="pl-lg-4">
											  <div class="row">
												<div class="col-lg-6">
												  <div class="form-group">
													<label class="form-control-label" for="input-username" >Username</label>
													<input type="text" id="input-username" name="username" class="form-control form-control-alternative" value= "<?php echo $username; ?>" disabled>
												  </div>
												</div>
												<div class="col-lg-6">
												  <div class="form-group">
													<label class="form-control-label" for="input-email">Email address</label>
													<input type="email" id="input-email" name="email" class="form-control form-control-alternative" value="<?php echo $email; ?>" disabled>
												  </div>
												</div>
											  </div>
											  <div class="row">
												<div class="col-lg-6">
												  <div class="form-group">
													<label class="form-control-label" for="input-first-name">First name</label>
													<input type="text" id="input-first-name" name="fname" class="form-control form-control-alternative" placeholder="First name" value="<?php echo $fname; ?>" disabled>
												  </div>
												</div>
												<div class="col-lg-6">
												  <div class="form-group">
													<label class="form-control-label" for="input-last-name">Last name</label>
													<input type="text" id="input-last-name" name="lname" class="form-control form-control-alternative" placeholder="Last name" value="<?php echo $lname; ?>" disabled>
												  </div>
												</div>
											  </div>
											</div>
											<hr class="my-4" />
											<!-- Address -->
											<h6 class="heading-small text-muted mb-4">Contact information</h6>
											<div class="pl-lg-4">
											  <div class="row">
												<div class="col-md-12">
												  <div class="form-group">
													<label class="form-control-label" for="input-address">Address</label>
													<input id="input-address" class="form-control form-control-alternative" name="address" placeholder="Home Address" value="<?php echo $address; ?>" type="text" disabled>
												  </div>
												</div>
											  </div>
											  <div class="row">
												<div class="col-lg-4">
												  <div class="form-group">
													<label class="form-control-label" for="input-city">City</label>
													<input type="text" id="input-city" name="city" class="form-control form-control-alternative" placeholder="City" value="<?php echo $city; ?>" disabled>
												  </div>
												</div>
												<div class="col-lg-4">
												  <div class="form-group">
													<label class="form-control-label" for="input-country">Country</label>
													<input type="text" id="input-country" name="countryy" class="form-control form-control-alternative" placeholder="Country" value="<?php echo $country; ?>" disabled>
												  </div>
												</div>
												<div class="col-lg-4">
												  <div class="form-group">
													<label class="form-control-label" for="input-country">Postal code</label>
													<input type="number" id="input-postal-code" name="pcode" class="form-control form-control-alternative" value="<?php echo $pcode; ?>" placeholder="Postal code" disabled>
												  </div>
												</div>
											  </div>
											</div>
											<hr class="my-4" />
											<!-- Description -->
											<h6 class="heading-small text-muted mb-4">About me</h6>
											<div class="pl-lg-4">
											  <div class="form-group">
												<label>About Me</label>
												<textarea rows="4" id="input-about-me" name="aboutme" class="form-control form-control-alternative" value="<?php echo $aboutme; ?>" placeholder="A few words about you ..." disabled></textarea>
											  </div>
											</div>
										</form>
									</div>
									<div class="col-xl-4">
										<!--<div class="card card-profile shadow"> -->
											<div class="row justify-content-center">
											  <div class="col-lg-3 order-lg-2">
												<div class="card-profile-image">
												  <a>
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
												  </a>
												  <hr>
												</div>
											  </div>
											</div> 								
											<div class="card-body pt-0 pt-md-4">
											  <div style="margin-top:70px"class="text-center">
												<h3>
												  <?php echo $_SESSION['name'] ?>
												</h3>
												<div class="h5 font-weight-300">
												  <i class="ni location_pin mr-2"></i>Chennai, India
												</div>
												<div class="h5 mt-1">
												  <i class="ni business_briefcase-24 mr-2"></i>UI Designer
												</div>
												<div style="padding-bottom: 10px">
												  <i class="ni education_hat mr-2"></i>Legacy Revitalization
												</div>
											  </div>
											</div>
										<!--</div> -->
									</div>
								</div>
							</div>
							<div class="tab-pane" id="messages">
								<div class="row">
									<div class="col-xl-8">
										<form role="form" action="update.php" method="POST">
											<h6 class="heading-small text-muted mb-4">User information</h6>
											<div class="pl-lg-4">
											  <div class="row">
												<div class="col-lg-6">
												  <div class="form-group">
													<label class="form-control-label" for="input-username" >Username</label>
													<input type="text" id="input-username" name="username" class="form-control form-control-alternative" value= "<?php echo $username; ?>" disabled>
												  </div>
												</div>
												<div class="col-lg-6">
												  <div class="form-group">
													<label class="form-control-label" for="input-email">Email address</label>
													<input type="email" id="input-email" name="email" class="form-control form-control-alternative" value="<?php echo $email; ?>" disabled>
												  </div>
												</div>
											  </div>
											  <div class="row">
												<div class="col-lg-6">
												  <div class="form-group">
													<label class="form-control-label" for="input-first-name">First name</label>
													<input type="text" id="input-first-name" name="fname" class="form-control form-control-alternative" placeholder="First name" value="">
												  </div>
												</div>
												<div class="col-lg-6">
												  <div class="form-group">
													<label class="form-control-label" for="input-last-name">Last name</label>
													<input type="text" id="input-last-name" name="lname" class="form-control form-control-alternative" placeholder="Last name" value="">
												  </div>
												</div>
											  </div>
											</div>
											<hr class="my-4" />
											<!-- Address -->
											<h6 class="heading-small text-muted mb-4">Contact information</h6>
											<div class="pl-lg-4">
											  <div class="row">
												<div class="col-md-12">
												  <div class="form-group">
													<label class="form-control-label" for="input-address">Address</label>
													<input id="input-address" class="form-control form-control-alternative" name="address" placeholder="Home Address" value="" type="text">
												  </div>
												</div>
											  </div>
											  <div class="row">
												<div class="col-lg-4">
												  <div class="form-group">
													<label class="form-control-label" for="input-city">City</label>
													<input type="text" id="input-city" name="city" class="form-control form-control-alternative" placeholder="City" value="" >
												  </div>
												</div>
												<div class="col-lg-4">
												  <div class="form-group">
													<label class="form-control-label" for="input-country">Country</label>
													<input type="text" id="input-country" name="country" class="form-control form-control-alternative" placeholder="Country" value="" >
												  </div>
												</div>
												<div class="col-lg-4">
												  <div class="form-group">
													<label class="form-control-label" for="input-country">Postal code</label>
													<input type="number" id="input-postal-code" name="pcode" class="form-control form-control-alternative" placeholder="Postal code" >
												  </div>
												</div>
											  </div>
											</div>
											<hr class="my-4" />
											<!-- Description -->
											<h6 class="heading-small text-muted mb-4">About me</h6>
											<div class="pl-lg-4">
											  <div class="form-group">
												<label>About Me</label>
												<textarea rows="4" id="input-about-me" name="aboutme" class="form-control form-control-alternative" placeholder="A few words about you ..." ></textarea>
											  </div>
											</div>
											<div class="text-center">
											  <button type="submit" class="btn btn-primary my-4">Update</button>
											</div>
										 </form>
									</div>
									<div class="col-xl-4">
										<!--<div class="card card-profile shadow"> -->
										<div class="row justify-content-center">
											  <div class="col-lg-3 order-lg-2">
												<div class="card-profile-image">
												  <a>
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
												  </a>
												  <hr>
												</div>
											  </div>
											</div> 								
											<div class="card-body pt-0 pt-md-4">
											  <div style="margin-top:70px"class="text-center">
												<h3>
												  <?php echo $_SESSION['name'] ?>
												</h3>
												<div class="h5 font-weight-300">
												  <i class="ni location_pin mr-2"></i>Chennai, India
												</div>
												<div class="h5 mt-2">
												  <i class="ni business_briefcase-24 mr-2"></i>UI Designer
												</div>
												<div style="padding-bottom: 10px">
												  <i class="ni education_hat mr-2"></i>Legacy Revitalization
												</div>
												<div class="container">
													<form action="upload.php" method="POST" enctype="multipart/form-data">
														<input style="width: 220px; background-color: #eee;outline: 2px solid coral;" type="file" name="fileToUpload" id="fileToUpload" >
														<input style="margin-top:5%" class= "btn btn-success" type="submit" value="Upload Image" name="submit">
													</form>
													<form action="delete.php" method="POST" enctype="multipart/form-data">
														<input style="margin-top:5%" class= "btn btn-danger" type="submit" value="Delete Image" name="submit">
													</form>					
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
</body>
</html>
<?php
}
else
	header("location:login.php");
?>