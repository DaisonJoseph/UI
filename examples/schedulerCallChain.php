<?php
$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->MissingComponents;
$total = $collection->find()->count();

if (isset($_GET["from"])) {
  $from = intval($_GET["from"]);
  $to = intval($_GET["to"]);
} else {
  $from = 7;
  $to = 500;
}

if ($from >= 500) {
  $previousFrom = $from - 500;
  $previousTo = $to - 500;
}

if ($to < $total) {
  $nextFrom = $from + 500;
  $nextTo = $to + 500;
}
?>



<!DOCTYPE html>
<html lang="en">

<meta charset="utf-8" />
<title>DevOps Analyzer</title>
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


<style>
  body,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    font-family: "Arial" !important;
  }

  .amcharts-chart-div .cur {
    cursor: pointer;
  }


  h1 {
    color: #396;
    font-weight: 100;
    font-size: 50px;
    margin: 40px 0px 20px;
  }

  .overflow {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .back-to-top {
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: none;
  }

  .smalltext {
    padding-top: 5px;
    font-size: 20px;
    flex-wrap: wrap;
    color: black;
    margin-top: 2%;
    font-family: 'Do Hyeon', sans-serif;
  }

  #defectByStatus {
    width: 100%;
    height: 500px;
    margin: auto;
  }

  .table.dataTable td.sorting_1 {
    background-color: transparent !important;
  }
</style>
</head>


<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
  <div class="page-wrapper" id="table">

    <?php
    $page = 'schedulerCallChain';
    include 'header.php'; ?>
    <div class="clearfix"> </div>
    <div class="page-container">
      <?php include 'sidebar.php'; ?>
      <div class="page-content-wrapper">
        <div class="page-content" style="background-color:#DCDCDC;">
          <div>
            <div class="clearfix"></div>

            <!--<div class="col-md-12">-->
            <div class="row">
              <!--start here-->
              <div class="col-xs-12 col-sm-12">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <div class="col-md-10 col-sm-12 col-xs-12">
                          <h2>CAP360 - SCHEDULER CALL CHAIN</h2>
                        </div>
                        <ul class="nav navbar-right panel_toolbox">
                          <!-- <li><a class="close-link" href="index.php"><i class="glyphicon glyphicon-menu-left"></i></a>
                          </li> -->
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <div class="table-responsive">
                          <table id="example" class="table table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th><strong>Position</strong></th>
                                <th><strong>Name</strong></th>
                                <th><strong>Office</strong></th>
                                <th><strong>Age</strong></th>
                                <th><strong>Star</strong></th>
                                <th><strong>Salary</strong></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011/07/25</td>
                                <td>$170,750</td>
                              </tr>
                              <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009/01/12</td>
                                <td>$86,000</td>
                              </tr>
                              <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                              </tr>
                              <tr>
                                <td>Airi Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008/11/28</td>
                                <td>$162,700</td>
                              </tr>
                              <tr>
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012/12/02</td>
                                <td>$372,000</td>
                              </tr>
                              <tr>
                                <td>Herrod Chandler</td>
                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td>59</td>
                                <td>2012/08/06</td>
                                <td>$137,500</td>
                              </tr>
                              <tr>
                                <td>Rhona Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <td>2010/10/14</td>
                                <td>$327,900</td>
                              </tr>
                              <tr>
                                <td>Colleen Hurst</td>
                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td>39</td>
                                <td>2009/09/15</td>
                                <td>$205,500</td>
                              </tr>
                            </tbody>
                          </table>
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
    <div class="page-footer">
      <div class="page-footer-inner"> 2018 &copy; DevOps Tool By
        <a href="https://www.capgemini.com/">Capgemini</a>
        <div class="scroll-to-top">
          <i class="icon-arrow-up"></i>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $(window).scroll(function() {
          if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
          } else {
            $('#back-to-top').fadeOut();
          }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function() {
          $('#back-to-top').tooltip('hide');
          $('body,html').animate({
            scrollTop: 0
          }, 800);
          return false;
        });

      });
    </script>
    <script src="../assets1/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://static.fusioncharts.com/code/latest/fusioncharts.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56" type="text/javascript"></script>
    <script src="../assets1/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets1/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../assets1/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#example').DataTable();
      });
    </script>
</body>

</html>