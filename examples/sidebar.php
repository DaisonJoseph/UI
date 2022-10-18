<?php $filename = basename($_SERVER['PHP_SELF']); ?>
<div class="sidebar <?php echo $_COOKIE['SIDEBAR_COLLPASED'] == 1 ? 'collapsed' : ''; ?> " id="main-sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      CAP 360
    </a>
    <button id="nav-button"><i class="material-icons">list</i></button>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav" id="activeLink">
      <li class="nav-item">
        <a class="nav-link" href="./dashboard.php">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item div-1">
        <a class="nav-link collapsed py-1" href="#" data-toggle="collapse" data-target="#submenu1sub1">
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
          <li class="nav-item">
            <a class="nav-link p-1" href="./missingReport.php">
              <i class="material-icons">list</i> Missing Components
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./orphanReport.php">
              <i class="material-icons">list</i> Orphan Components
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./deadJobReport.php">
              <i class="material-icons">list</i> Dead Jobs
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./dropImpactReport.php">
              <i class="material-icons">list</i> Drop Impact
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./loadVsSourceReport.php">
              <i class="material-icons">list</i> Load vs Source
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./staticAndDynamicReport.php">
              <i class="material-icons">list</i> Static and Dynamic
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./crudReport.php">
              <i class="material-icons">list</i> CRUD
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./fieldCrudReport.php">
              <i class="material-icons">list</i> Field CRUD
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./clonedQueryReport.php">
              <i class="material-icons">list</i> Cloned Query
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./tableWithoutIndexReport.php">
              <i class="material-icons">list</i> Table without Index
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./queryWithoutIndexReport.php">
              <i class="material-icons">list</i> Query without Index
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./fieldWithNoUsageReport.php">
              <i class="material-icons">list</i> Field with no usage
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./onlineTransaction.php">
              <i class="material-icons">list</i> Online Transaction
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./callChain.php">
              <i class="material-icons">list</i> Call Chain
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link p-1" href="./schedulerCallChain.php">
              <i class="material-icons">list</i> Scheduler Call Chain
            </a>
          </li>
        </ul>
      </div>
      <li class="nav-item">
        <a class="nav-link" href="./sankeyEuroclear.php">
          <i class="material-icons">chart</i>
          <p>Application Interface</p>
        </a>
      </li>
    </ul>
  </div>
</div>

<script>
  window.addEventListener('DOMContentLoaded', function() {
    const urlArray = window.location.href.split('/');
    const reportsMenu = document.querySelector('#submenu1sub1');

    const currentPage = urlArray[urlArray.length - 1];
    let links = document.querySelectorAll('.nav-item .nav-link');
    links.forEach(function(link) {
      if (link.attributes.href.value && link.attributes.href.value.includes(currentPage)) {
        link.parentElement.classList.add('active');
        reportsMenu.classList.add('show');
      }
    })
  })
</script>

<!-- <script>
      var activeContainer = document.getElementById("activeLink");
var navItems = activeContainer.getElementsByClassName("nav-item");
for (var i = 0; i < navItems.length; i++) {
    navItems[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    if(activeContainer.classname.contains['div-1']) {

      this.className += " active";
    }
    else {   
      this.className += " active";
    }
  });
}
    </script> -->