<?php
$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->MasterInventory;
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
  <?php include 'header.php'; ?>
</head>

<body class="white">
  <div class="wrapper">
    <?php include 'sidebar.php'; ?>
    <div class="main-panel <?php echo $_COOKIE['SIDEBAR_COLLPASED'] == 1 ? 'expand-panel' : ''; ?>">
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
                  <h4 class="card-title ">CAP360 - MASTER INVENTORY</h4>
                  <!--<p class="card-category"> Here is a subtitle for this table</p>-->
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="datatable" class="table table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th><strong>Component Name</strong></th>
                          <th><strong>Component Type</strong></th>
                          <th><strong>LOC</strong></th>
                          <th><strong>Application Name</strong></th>
                          <th><strong>Orphan</strong></th>
                          <th><strong>Dead jobs</strong></th>
                        </tr>
                      </thead>
                      <?php

                      if (isset($_GET['input']) || isset($_GET['search'])) {
                        if (isset($_GET['input'])) {
                          $input = trim($_GET['input']);
                        } else {
                          $input = trim($_GET['search']);
                        }
                        $input =  str_replace(" ", "-", $input);
                        //	$input =  "\"" . str_replace("+","-",$input) . "\"";
                        $input = str_replace("-", " ", $input);
                        // $input = '\"' . $input . '\"';

                        $inputs = array('$text' => array('$search' => $input));


                        //	var_dump($inputs);
                        $results = $collection->find($inputs)->limit(500);
                        $numdocs = 0;
                        foreach ($results as $result) {
                          $numdocs = 1;
                        }
                        if ($numdocs == 0) {
                          $input = str_replace(" ", "-", $input);
                          //echo 'value of input ' . $input;
                          //		$inputs = array('$text'=>array('$search'=>$input));
                          //		var_dump($inputs);
                          $results = $collection->find($inputs)->limit(500)->sort(array("_id" => 0));
                        }
                      } else {
                        $results = $collection->find()->sort(array("Component_Type" => 1))->limit(500)->skip($from);
                      }
                      echo '<tbody>';

                      foreach ($results as $result) {
                        $component_name = $result['Component_Name'];
                        $component_type = $result['Component_Type'];
                        $cloc = $result['CLOC'];
                        $uloc = $result['ULOC'];
                        $lloc = $result['LLOC'];
                        $appname = $result['Application_Name'];
                        $orphan = $result['Orphan'];
                        $dead = $result['Dead_Jobs'];
                        $tloc = $cloc + $uloc + $lloc;


                        echo '<tr>';
                        echo '<td>' . $component_name . '</td>';
                        echo '<td>' . $component_type . '</td>';
                        echo '<td>' . $tloc . '</td>';
                        echo '<td>' . $appname . '</td>';
                        echo '<td>' . $orphan . '</td>';
                        echo '<td>' . $dead . '</td>';
                        echo '</tr>';
                      }
                      echo '</tbody>';
                      ?>
                    </table>
                    <div class="row">
                      <div class="col-sm-6">
                        <?php
                        if (isset($previousFrom)) {
                          ?>
                          <a href="masterReports.php?from=<?php echo $previousFrom; ?>&to=<?php echo $previousTo; ?>" class="btn btn-primary"><?php echo $previousFrom . " - " . $previousTo; ?></a>
                        <?php
                        }
                        ?>
                      </div>
                      <div class="col-sm-6">
                        <?php
                        if (isset($nextFrom)) {
                          ?>
                          <a href="masterReports.php?from=<?php echo $nextFrom; ?>&to=<?php echo $nextTo; ?>" class="btn btn-primary" style="margin-left: 70%"><?php echo $nextFrom . " - " . $nextTo; ?></a>
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
    <!-- <script>
      const x = new Date().getFullYear();
      let date = document.getElementById('date');
      date.innerHTML = '&copy; ' + x + date.innerHTML;
    </script>-->
    <script>
      $(document).ready(function() {
        $('#datatable').DataTable();
      });
    </script>
  </div>
  </div>

  <?php include 'footer.php'; ?>
  <?php include 'datatablesFooter.php'; ?>
  <!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
  <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> -->
</body>

</html>