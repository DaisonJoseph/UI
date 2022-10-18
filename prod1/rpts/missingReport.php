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

<head>
  <?php
  $page = 'missingReport';
  include 'header.php'; ?>
</head>

<body class="white">
  <div class="wrapper">
    <?php include 'sidebar.php'; ?>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <!-- <a class="navbar-brand" href="javascript:void(0)">Table List</a> -->
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-blue">
                  <h4 class="card-title ">CAP360 - MISSING COMPONENTS</h4>
                  <!--        <p class="card-category"> Here is a subtitle for this table</p> -->
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th><strong>Component Name</strong></th>
                          <th><strong>Component Type</strong></th>
                          <!--     <th><strong>Called Component Name</strong></th>
                          <th><strong>Called Component Type</strong></th>
                          <th><strong>Star</strong></th>
                          <th><strong>Sala</strong></th> -->
                        </tr>
                      </thead>

                      <?php
                      $results = $collection->find()->sort(array("Type" => 1, "Component" => 1))->limit(500)->skip($from);
                      echo '<tbody>';

                      foreach ($results as $result) {
                        $component_name = $result['Component'];
                        $component_type = $result['Type'];


                        echo '<tr>';
                        echo '<td>' . $component_name . '</td>';
                        echo '<td>' . $component_type . '</td>';
                        echo '</tr>';
                      }
                      echo '</tbody>';
                      ?>

                      <!--     <tbody>
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
                      </tbody>  -->
                    </table>
                    <div class="row">
                      <div class="col-sm-6">
                        <?php
                        if (isset($previousFrom)) {
                          ?>
                          <a href="missingReport.php?from=<?php echo $previousFrom; ?>&to=<?php echo $previousTo; ?>" class="btn btn-primary"><?php echo $previousFrom . " - " . $previousTo; ?></a>
                        <?php
                        }
                        ?>
                      </div>
                      <div class="col-sm-6">
                        <?php
                        if (isset($nextFrom)) {
                          ?>
                          <a href="missingReport.php?from=<?php echo $nextFrom; ?>&to=<?php echo $nextTo; ?>" class="btn btn-primary" style="margin-left: 70%"><?php echo $nextFrom . " - " . $nextTo; ?></a>
                        <?php
                        }
                        ?>
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

  <?php include 'footer.php'; ?>
</body>

</html>