
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    CAP360
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
 <!-- css for data table -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  
  <link rel="stylesheet" href="../assets/css/main.css">

  <link src="./chart.css" />

  <script src="../GridGallery/js/modernizr.custom.js"></script>

    <!-- css for data table -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

  <!-- <link rel="stylesheet" href="../assets/css/main.css"> -->
  <style>
    .purple {
      background-color: purple !important;
      color: white;
    }
  </style></head>

<body class="white">
  <div class="wrapper">
    ~~~<div class="sidebar" id="main-sidebar" data-color="purple" data-background-color="black"
      data-image="../assets/img/sidebar-2.jpg">
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          CAP 360
        </a>
        <button id="nav-button"><i class="material-icons">list</i></button>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link collapsed py-1" href="#" data-toggle="collapse"
              data-target="#submenu1sub1">
              <i class="material-icons">content_paste</i>
              <p>Reports</p>
            </a>
          </li>
          <div class="collapse" id="submenu1sub1" aria-expanded="false">
            <ul class="flex-column nav pl-4">
              <li class="nav-item">
                <a class="nav-link p-1" href="./masterReports.php">
                  <i class="material-icons">list</i> Master Inventory
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link p-1" href="./crossReferenceReports.php">
                  <i class="material-icons">list</i> Cross Reference
                </a>
              </li>
            </ul>
          </div>
        </ul>
      </div>
    </div>    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <!-- <a class="navbar-brand" href="javascript:void(0)">CAP360</a> -->
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv1"
                onclick="modalClick('PieChart3D','PieSeries3D');">
                <div class="card-header card-header-blue card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">donut_small</i>
                  </div>
                  <p class="card-category">Master Inventory</p>
                  <h2 class="card-category"><strong>Total Components</strong></h2>
                  <h3 class="card-title">31102</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv2"
                onclick="modalClick('PieChart','PieSeries','chart1');">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <p class="card-category">Master Inventory</p>
                  <h2 class="card-category"><strong>Total LOC</strong></h2>
                  <h3 class="card-title">30957800</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv3"
                onclick="modalClick('Container','PieSeries','chart2');">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">link_off</i>
                  </div>
                  <p class="card-category">Orphan components</p>
                  <h2 class="card-category"><strong>Total LOC</strong></h2>
                  <h3 class="card-title">3954</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv3"
                onclick="modalClick('XYChart3D','ConeSeries','chart1');">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">link_off</i>
                  </div>
                  <p class="card-category">Orphan components</p>
                  <h2 class="card-category"><strong>Total Components</strong></h2>
                  <h3 class="card-title"><small>3954</small></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv4"
                onclick="modalClick('PieChart','PieSeries','chart3');">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">create</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>Missing Components</strong></h2>
                  <h3 class="card-title">373
                    <!-- <small>GB</small> -->
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv6"
                onclick="modalClick('Sunburst','SunburstSeries');">
                <div class="card-header card-header-blue card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category"></p>
                  <br />
                  <h2 class="card-category"><strong>Cross Reference</strong></h2>
                  <h3 class="card-title">5161</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv5"
                onclick="modalClick('XYChart','ColumnSeries','chart3');">
                <div class="card-header card-header-yellow card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">timeline</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>Static & Dynamic Call</strong></h2>
                  <h3 class="card-title">6282</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv5"
                onclick="modalClick('XYChart','LineSeries','chart4');">
                <div class="card-header card-header-yellow card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">timeline</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>Load vs Source</strong></h2>
                  <h3 class="card-title">6282</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv7"
                onclick="modalClick('XYChart3D','ColumnSeries3D','chart2');">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category">Files</p>
                  <!-- <br> -->
                  <h2 class="card-category"><strong>with no usage</strong></h2>
                  <h3 class="card-title">1267
                    <!-- <small>GB</small> -->
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">warning</i>
                    <a href="#pablo" class="warning-link">Get More Space...</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv7"
                onclick="modalClick('XYChart','ColumnSeries','chart5');">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <!-- <br> -->
                  <h2 class="card-category"><strong>VSAM</strong></h2>
                  <h3 class="card-title">52
                    <!-- <small></small> -->
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">warning</i>
                    <a href="#pablo" class="warning-link">Get More Space...</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv7"
                onclick="modalClick('RadarChart','RadarColumnSeries');">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>FTP Stats</strong></h2>
                  <h3 class="card-title">295
                    <!-- <small>GB</small> -->
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">warning</i>
                    <a href="#pablo" class="warning-link">Get More Space...</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv7"
                onclick="modalClick();">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <h2 class="card-category"><strong>Table without Index</strong></h2>
                  <h3 class="card-title">1267
                    <small>GB</small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">warning</i>
                    <a href="#pablo" class="warning-link">Get More Space...</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
          </div>
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv4"
                onclick="modalClick('XYChart3D','ColumnSeries3D','chart3');">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">create</i>
                  </div>
                  <p class="card-category">CRUD</p>
                  <!-- <br> -->
                  <h2 class="card-category"><strong>Operation (with only)</strong></h2>
                  <h3 class="card-title">110
                    <!-- <small>GB</small> -->
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv4"
                onclick="modalClick('Container','PieSeries','chart1');">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">create</i>
                  </div>
                  <p class="card-category">CRUD</p>
                  <h2 class="card-category"><strong>Total Operation</strong></h2>
                  <h3 class="card-title">21040
                    <!-- <small>GB</small> -->
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv8"
                onclick="modalClick();">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">repeat</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>No. of cloned queries</strong></h2>
                  <h3 class="card-title">2328</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Last 24 Hours
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv6"
                onclick="modalClick();">
                <div class="card-header card-header-blue card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>Field CRUD</strong></h2>
                  <h3 class="card-title">5161</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv6"
                onclick="modalClick();">
                <div class="card-header card-header-blue card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>Query without Index</strong></h2>
                  <h3 class="card-title">5161</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-warning">assessment</i>
                    <a href="#pablo" class="warning-link" style="color: black;">click here for Charts</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv9"
                onclick="modalClick();">
                <div class="card-header card-header-yellow card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                  </div>
                  <h2 class="card-category"><strong>Application level Component</strong></h2>
                  <h3 class="card-title">750000</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">local_offer</i> Tracked from Github
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div id="display-container"></div>
                  <div id="display-chart" style="width: 85%; height: 400px;left: 90px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
          </nav>
        </div>
      </footer>
    </div>
  </div>
  <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <ul class="dropdown-menu">
      </ul>
    </div>
  </div>
   <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <!-- <script src="../assets/js/plugins/chartist.min.js"></script> -->
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script src="../assets/js/main.js"></script>

  <script>
    $(document).ready(function () {
      $().ready(function () {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        $('.fixed-plugin a').click(function (event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function () {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function () {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function () {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function () {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function () {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function () {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function () {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function () {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function () {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function () {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
  <!-- scripts from grid gallery -->
  <?php include("../assets/js/dashboard-chart.php"); ?>
  <!-- amcharts -->
  <script src="https://www.amcharts.com/lib/4/core.js"></script>
  <script src="https://www.amcharts.com/lib/4/charts.js"></script>
  <script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script>
  <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
  <script src="https://www.amcharts.com/lib/4/plugins/sunburst.js"></script>

  <script>
    new CBPGridGallery(document.getElementById('grid-gallery'));
  </script>
  <script src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
</body>
</html>