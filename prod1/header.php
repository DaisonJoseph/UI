<div class="page-header navbar navbar-fixed-top" style="background-image:url('../assets/img/back.jpg'); background-size: cover">
     <div class="page-header-inner">
          <div class="page-logo">
               <a href="index.php">
                    <img src="cap2.png" alt="logo" class="logo-default" width="180" height="50" style="margin: 0px 0px 0px -20px;padding-left:14px;" />
               </a>

               <div class="menu-toggler sidebar-toggler" id="main-sidebar"><span></span></div>
          </div>
          <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
               <span></span>
          </a>

          <div class="top-menu">
               <ul class="nav navbar-nav pull-left">
                    <p style="text-transform: capitalize;color:#fff; font-weight:bold; margin-top:15px!important"><?php echo $_SESSION['name'] ?></p>
               </ul>
               <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-user">
                         <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                              <img alt="" class="img-circle" src="../assets1/layouts/layout/img/capg.png" />
                              <span class="username uppercase">
                                   <?php if (isset($_SESSION['Uid'])) {
                                        echo $_SESSION['Uid'];
                                   } ?>
                              </span>
                              <i class="fa fa-angle-down"></i>
                         </a>
                         <ul class="dropdown-menu dropdown-menu-default">
                              <!-- <li>
							<a href="setting.php">
								<i class="fa fa-cog "></i> Settings
							</a>
						</li> -->
                              <!-- <li class=" <?php
                                                  // if ($_SESSION['role'] !== 'Admin') {
                                                  // echo 'hide';
                                                  // }
                                                  ?>">
							<a href="newuser.php">
								<i class="fa fa-user"></i> Add New User
							</a>
						</li> -->
                              <li>
                                   <a href="logout.php">
                                        <i class="fa fa-sign-out "></i> Logout
                                   </a>
                              </li>
                         </ul>
                    </li>
               </ul>
          </div>
     </div>
</div>