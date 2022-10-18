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
    $page = 'onlineTransaction';
    include 'header.php'; ?>
    <div class="clearfix"> </div>
    <div class="page-container">
      <?php include 'sidebar.php'; ?>
      <div class="page-content-wrapper">
        <div class="page-content" style="background-color:#DCDCDC;">
          <div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-xs-12 col-sm-12">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <div class="col-md-10 col-sm-12 col-xs-12">
                          <h2>CAP360 - ONLINE TRANSACTION REPORT</h2>
                        </div>
                        <ul class="nav navbar-right panel_toolbox">
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
          <script>
            const x = new Date().getFullYear();
            let date = document.getElementById('date');
            date.innerHTML = '&copy; ' + x + date.innerHTML;
          </script>
        </div>
      </div>
      <!--   Core JS Files   -->
      <?php include 'footer.php'; ?>
</body>

</html>