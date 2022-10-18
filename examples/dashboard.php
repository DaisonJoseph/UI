<!DOCTYPE html>
<?php include('tiles_data.php'); ?>
<html lang="en">

<head>
  <?php include 'header.php'; ?>
</head>

<body class="white">
  <div class="wrapper">
    <?php include 'sidebar.php'; ?>
    <div class="main-panel <?php echo $_COOKIE['SIDEBAR_COLLPASED'] == 1 ? 'expand-panel' : ''; ?> <?php echo $_COOKIE['SIDEBAR_COLLPASED'] == 1 ? 'expand-panel' : ''; ?>" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <!-- <a class="navbar-brand" href="javascript:void(0)">CAP360</a> -->
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
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
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv1" onclick="modalClick('PieChart3D','PieSeries3D');">
                <div class="card-header card-header-blue card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">donut_small</i>
                  </div>
                  <h2 class="card-category"><strong>Total Components</strong></h2>
                  <h3 class="card-title"><small><?php echo $components_count; ?></small></h3>
                </div>
                <div class="card-footer">
                  <!-- <p class="card-category">Click for details</p> -->
                  <p class="card-category">Master Inventory</p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv2" onclick="modalClick('PieChart','PieSeries','chart1');">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h2 class="card-category"><strong>Total LOC</strong></h2>
                  <h3 class="card-title"><small><?php echo $loc_count; ?></small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Master Inventory</p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv3" onclick="modalClick('Container','PieSeries','chart2');">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">link_off</i>
                  </div>
                  <h2 class="card-category"><strong>Total LOC</strong></h2>
                  <h3 class="card-title"><small><?php echo $orphan_loc_count; ?></small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Orphan components</p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv3" onclick="modalClick('XYChart3D','ConeSeries','chart1');">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">link_off</i>
                  </div>
                  <h2 class="card-category"><strong>Total Components</strong></h2>
                  <h3 class="card-title"><small><?php echo $orphan_count; ?></small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Orphan components</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv4" onclick="modalClick('PieChart','PieSeries','chart3');">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">create</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>Missing Components</strong></h2>
                  <h3 class="card-title"><small><?php echo $missing_count; ?>
                    </small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv6" onclick="modalClick('Sunburst','SunburstSeries');">
                <div class="card-header card-header-blue card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category"></p>
                  <br />
                  <h2 class="card-category"><strong>Cross Reference</strong></h2>
                  <h3 class="card-title"><small>5161</small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv5" onclick="modalClick('XYChart','ColumnSeries','chart3');">
                <div class="card-header card-header-yellow card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">timeline</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>Static & Dynamic Call</strong></h2>
                  <h3 class="card-title"><small><?php echo $static_call; ?>| <?php echo $dynamic_call; ?></small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv5" onclick="modalClick('XYChart','LineSeries','chart4');">
                <div class="card-header card-header-yellow card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">timeline</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>Load vs Source</strong></h2>
                  <h3 class="card-title"><small>6282</small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv7" onclick="modalClick('XYChart3D','ColumnSeries3D','chart2');">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category">Files</p>
                  <!-- <br> -->
                  <h2 class="card-category"><strong>with no usage</strong></h2>
                  <h3 class="card-title"><small><?php echo $files_not_used_count; ?>
                      <!-- <small>GB</small> -->
                    </small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv7" onclick="modalClick('XYChart','ColumnSeries','chart5');">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <!-- <br> -->
                  <h2 class="card-category"><strong>VSAM</strong></h2>
                  <h3 class="card-title"><small><?php echo $vsam; ?>
                      <!-- <small></small> -->
                    </small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv7" onclick="modalClick('RadarChart','RadarColumnSeries');">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>FTP Stats</strong></h2>
                  <h3 class="card-title"><small><?php echo $ftp; ?>
                      <!-- <small>GB</small> -->
                    </small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv7" onclick="modalClick();">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <h2 class="card-category"><strong>Table without Index</strong></h2>
                  <h3 class="card-title"><small>1267
                      <small>GB</small>
                    </small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv4" onclick="modalClick('XYChart3D','ColumnSeries3D','chart3');">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">create</i>
                  </div>
                  <p class="card-category">CRUD</p>
                  <h2 class="card-category"><strong>Operation (with only)</strong></h2>
                  <h3 class="card-title"><small><?php echo $insert; ?>|<?php echo $read; ?>|<?php echo $update; ?>|<?php echo $delete; ?>
                    </small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv4" onclick="modalClick('Container','PieSeries','chart1');">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">create</i>
                  </div>
                  <p class="card-category">CRUD</p>
                  <h2 class="card-category"><strong>Total Operation</strong></h2>
                  <h3 class="card-title"><small><?php echo $total_crud; ?>
                      <!-- <small>GB</small> -->
                    </small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv8" onclick="modalClick();">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">repeat</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>No. of cloned queries</strong></h2>
                  <h3 class="card-title"><small><?php echo $clonedquery; ?></small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">
                    Click for details
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv6" onclick="modalClick();">
                <div class="card-header card-header-blue card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>Field CRUD</strong></h2>
                  <h3 class="card-title"><small>5161</small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv6" onclick="modalClick();">
                <div class="card-header card-header-blue card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list</i>
                  </div>
                  <p class="card-category"></p>
                  <br>
                  <h2 class="card-category"><strong>Query without Index</strong></h2>
                  <h3 class="card-title"><small><?php echo $QueryWindex_count; ?></small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details</p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats" data-toggle="modal" data-target="#exampleModal" id="chartdiv9" onclick="modalClick();">
                <div class="card-header card-header-yellow card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                  </div>
                  <h2 class="card-category"><strong>Application level Component</strong></h2>
                  <h3 class="card-title"><small>750000</small></h3>
                </div>
                <div class="card-footer">
                  <p class="card-category">Click for details
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  <?php include 'footer.php'; ?>

  <!-- scripts from grid gallery -->
  <script src="../assets/js/dashboard-chart.php"></script>
  <!-- amcharts -->
  <script src="https://www.amcharts.com/lib/4/core.js"></script>
  <script src="https://www.amcharts.com/lib/4/charts.js"></script>
  <script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script>
  <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
  <script src="https://www.amcharts.com/lib/4/plugins/sunburst.js"></script>
</body>

</html>