<?php $filename = basename($_SERVER['PHP_SELF']);
$page = trim(substr($filename, 0, stripos($filename, ".")));
?>

<div class="page-sidebar-wrapper">
     <div class="page-sidebar navbar-collapse collapse" style="margin-top: 50px;">
          <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top : 0px; height: 528px;">
               <li class="nav-item <?php if ($page == 'index') {
                                        echo 'start active open';
                                   } ?>" id="main-dashboard">
                    <a href="index.php" class="nav-link nav-toggle">
                         <img src="../assets/img/dash.png" style="height:30px;width:30px;margin-right:7%">
                         <span class="title" style="color:#fff; font-weight:bold;">Dashboard</span>
                    </a>
               </li>
               <!-- <li class="nav-item <?php if (
                                             $page == 'masterReports' | $page == 'crossReferenceReports' | $page == 'assemXref' | $page == 'cobolXref' | $page == 'esyXref' | $page == 'jclXref' | $page == 'rexxXref' | $page == 'sasXref' | $page == 'transXref'
                                             | $page == 'missingReport' | $page == 'db2CrudReport' | $page == 'singleton' | $page == 'parainv' | $page == 'exciReport' | $page == 'printReport'
                                             | $page == 'db2FieldCrud' | $page == 'clonedQuery' | $page == 'db2OrphanTables' | $page == 'oracleReport' | $page == 'batchCallchain' | $page == 'onlineCallchain' | $page == 'schedulerCallChain'
                                             | $page == 'emailReport' | $page == 'ftpReport' | $page == 'filesCreatedNotUsed' | $page == 'imsMissingTables'
                                             | $page == 'imsOrphanTables' | $page == 'imsSingleOperation' | $page == 'deadTransactions' | $page == 'db2imageCopyReport' | $page == 'imsimageCopyReport'
                                             | $page == 'loadunloadReport' | $page == 'queryWithoutIndex' | $page == 'schedulerFlow' | $page == 'mqReport' | $page == 'dropImpact' | $page == 'deadJclReport' | $page == 'orphanReport'
                                             | $page == 'db2FieldsNotUsed' | $page == 'tsqReport' | $page == 'channelContainer' | $page == 'deadPara' | $page == 'applicationCluster' | $page == 'subRoutine'
                                             | $page == 'cpuReport' | $page == 'orphanVsam' | $page == 'searchReport' | $page == 'sequentialReport' | $page == 'sortReport' | $page == 'vsamActive' | $page == 'vsamInactive' | $page == 'vsamFilter'
                                        ) {
                                             echo 'start active open';
                                        } ?>" id="main-report"> -->
               <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle collapsed" data-toggle="collapse" data-target="#submenu1sub2">
                         <img src="../assets/img/report.png" style="height:30px;width:30px;margin-right:7%">
                         <span class="title" style="color:#fff; font-weight:bold;">Inventory</span>
                    </a>
                    <ul class="sub-menu collapse" id="submenu1sub2" aria-expanded="true">
                         <li class="nav-item <?php if ($page == 'masterReports') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="masterReports.php" class="nav-link nav-toggle">
                                   <span class="title">Master Inventory</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'orphanReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="orphanReport.php" class="nav-link nav-toggle">
                                   <span class="title">Orphan Components</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'deadJclReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="deadJclReport.php" class="nav-link nav-toggle">
                                   <span class="title">Dead Components</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'dropImpact') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="dropImpact.php" class="nav-link nav-toggle">
                                   <span class="title">Drop Impact</span>
                              </a>
                         </li>
                         <!--  <li class="nav-item <?php if ($page == 'parainv') {
                                                            echo 'start active open';
                                                       } ?>">
                              <a href="fileinv.php" class="nav-link nav-toggle">
                                   <span class="title">File Inventory</span>
                              </a>
                         </li> -->
                         <li class="nav-item <?php if ($page == 'missingReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="missingReport.php" class="nav-link nav-toggle">
                                   <span class="title">Missing Report</span>
                              </a>
                         </li>
                         <!-- <li class="nav-item <?php if ($page == 'missingReport') {
                                                       echo 'start active open';
                                                  } ?>">
                              <a href="missingJclReport.php" class="nav-link nav-toggle">
                                   <span class="title">Missing JCL</span>
                              </a>
                         </li> -->
                         <!-- <li class="nav-item <?php if ($page == 'mqReport') {
                                                       echo 'start active open';
                                                  } ?>">
                              <a href="tsqReport.php" class="nav-link nav-toggle">
                                   <span class="title">TSQ Report</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'mqReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="tdqReport.php" class="nav-link nav-toggle">
                                   <span class="title">TDQ Report</span>
                              </a>
                         </li> -->

                    </ul>
               </li>
               <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle collapsed" data-toggle="collapse" data-target="#submenu1sub2">
                         <img src="../assets/img/data.png" style="height:30px;width:30px;margin-right:7%">
                         <span class="title" style="color:#fff; font-weight:bold;">Cross Reference</span>
                    </a>
                    <ul class="sub-menu collapse" id="submenu1sub2" aria-expanded="true">
                         <li class="nav-item <?php if ($page == 'assXref') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="assemblerXref.php" class="nav-link nav-toggle">
                                   <span class="title">Assembler</span>
                              </a>
                         </li>
                         <!-- <li class="nav-item <?php if ($page == 'cobolXref') {
                                                       echo 'start active open';
                                                  } ?>">
                              <a href="clistXref.php" class="nav-link nav-toggle">
                                   <span class="title">CLIST</span>
                              </a>
                         </li> -->
                         <li class="nav-item <?php if ($page == 'cobolXref') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="cobolXref.php" class="nav-link nav-toggle">
                                   <span class="title">COBOL</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'comXref') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="compositeXref.php" class="nav-link nav-toggle">
                                   <span class="title">Composite</span>
                              </a>
                         </li>
                         <!-- <li class="nav-item <?php if ($page == 'jclXref') {
                                                       echo 'start active open';
                                                  } ?>">
                              <a href="esyXref.php" class="nav-link nav-toggle">
                                   <span class="title">Easytrieve</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'transXref') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="focusdialogueXref.php" class="nav-link nav-toggle">
                                   <span class="title">Focus Dialogue</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'paraXref') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="focusexecXref.php" class="nav-link nav-toggle">
                                   <span class="title">Focus Exec</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'paraXref') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="imsXref.php" class="nav-link nav-toggle">
                                   <span class="title">IMS Transaction</span>
                              </a>
                         </li> -->
                         <li class="nav-item <?php if ($page == 'paraXref') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="jclXref.php" class="nav-link nav-toggle">
                                   <span class="title">JCL</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'transXref') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="transXref.php" class="nav-link nav-toggle">
                                   <span class="title">Transaction</span>
                              </a>
                         </li>
                         <!-- <li class="nav-item <?php if ($page == 'paraXref') {
                                                       echo 'start active open';
                                                  } ?>">
                              <a href="skeletonXref.php" class="nav-link nav-toggle">
                                   <span class="title">Skeleton</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'paraXref') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="teloncobolXref.php" class="nav-link nav-toggle">
                                   <span class="title">Telon COBOL</span>
                              </a>
                         </li> -->

                    </ul>
               </li>
               </li>
               <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle collapsed" data-toggle="collapse" data-target="#submenu1sub2">
                         <img src="../assets/img/databases.png" style="height:30px;width:30px;margin-right:7%">
                         <span class="title" style="color:#fff; font-weight:bold;">CRUD Operations</span>
                    </a>
                    <ul class="sub-menu collapse" id="submenu1sub2" aria-expanded="true">
                         <li class="nav-item <?php if ($page == 'db2CrudReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="db2CrudReport.php" class="nav-link nav-toggle">
                                   <span class="title">DB2 Crud Report</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'singleton') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="db2MissingTablesReport.php" class="nav-link nav-toggle">
                                   <span class="title">File</span>
                              </a>
                         </li>
                         <!-- <li class="nav-item <?php if ($page == 'db2CrudReport') {
                                                       echo 'start active open';
                                                  } ?>">
                              <a href="imsCrudReport.php" class="nav-link nav-toggle">
                                   <span class="title">IMS Crud</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'singleton') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="imsOrphanTablesReport.php" class="nav-link nav-toggle">
                                   <span class="title">IMS Orphan Tables</span>
                              </a>
                         </li> -->
                         <!-- <li class="nav-item <?php if ($page == 'singleton') {
                                                       echo 'start active open';
                                                  } ?>">
                              <a href="imsMissingTablesReport.php" class="nav-link nav-toggle">
                                   <span class="title">IMS Missing Tables</span>
                              </a>
                         </li> -->
                         <!--<li class="nav-item <?php if ($page == 'clonedQuery') {
                                                       echo 'start active open';
                                                  } ?>">
						<a href="clonedQueryReport.php" class="nav-link nav-toggle">
							<span class="title">DB2 Cloned Query</span>
						</a>
					</li>-->

                    </ul>
               </li>
               </li>
               <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle collapsed" data-toggle="collapse" data-target="#submenu1sub2">
                         <img src="../assets/img/programming.png" style="height:30px;width:30px;margin-right:7%">
                         <span class="title" style="color:#fff; font-weight:bold;">Interface Report</span>
                    </a>
                    <ul class="sub-menu collapse" id="submenu1sub2" aria-expanded="true">

                         <li class="nav-item <?php if ($page == 'emailReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="emailReport.php" class="nav-link nav-toggle">
                                   <span class="title">Email</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'ftpReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="ftpReport.php" class="nav-link nav-toggle">
                                   <span class="title">FTP</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'emailReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="mqReport.php" class="nav-link nav-toggle">
                                   <span class="title">MQ</span>
                              </a>
                         </li>
                         <!-- <li class="nav-item <?php if ($page == 'appInterfaceReport') {
                                                       echo 'start active open';
                                                  } ?>">
                              <a href="appInterfaceReport.php" class="nav-link nav-toggle">
                                   <span class="title">Application Interface</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'db2InterfaceReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="db2InterfaceReport.php" class="nav-link nav-toggle">
                                   <span class="title">DB2 Interface</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'imsInterfaceReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="imsInterfaceReport.php" class="nav-link nav-toggle">
                                   <span class="title">IMS Interface</span>
                              </a>
                         </li> -->

                    </ul>
               </li>
               <!-- <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle collapsed" data-toggle="collapse" data-target="#submenu1sub2">
                         <img src="../assets/img/documents.png" style="height:30px;width:30px;margin-right:7%">
                         <span class="title" style="color:#fff; font-weight:bold;">Other Report</span>
                    </a>
                    <ul class="sub-menu collapse" id="submenu1sub2" aria-expanded="true">
                         <li class="nav-item <?php if ($page == 'mqReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="filesCreatedNotUsed.php" class="nav-link nav-toggle">
                                   <span class="title">Files Created But Not Used</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'mqReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="inlineEsy.php" class="nav-link nav-toggle">
                                   <span class="title">Inline Easytrieve</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'ftpReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="internalReader.php" class="nav-link nav-toggle">
                                   <span class="title">Internal Reader</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'emailReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="loadReport.php" class="nav-link nav-toggle">
                                   <span class="title">Load Report</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'emailReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="unloadReport.php" class="nav-link nav-toggle">
                                   <span class="title">Unload Report</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'emailReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="imagecopy.php" class="nav-link nav-toggle">
                                   <span class="title">Imagecopy Report</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'emailReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="rmdsJcl.php" class="nav-link nav-toggle">
                                   <span class="title">RMDS JCL</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'emailReport') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="printer.php" class="nav-link nav-toggle">
                                   <span class="title">Printer</span>
                              </a>
                         </li>

                    </ul>
               </li> -->
               <!-- <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle collapsed" data-toggle="collapse" data-target="#submenu1sub2">
                         <img src="../assets/img/loop.png" style="height:30px;width:30px;margin-right:7%">
                         <span class="title" style="color:#fff; font-weight:bold;">Call Chain</span>
                    </a>
                    <ul class="sub-menu collapse" id="submenu1sub2" aria-expanded="true">
                         <li class="nav-item <?php if ($page == 'batchCallchain') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="batchCallchain.php" class="nav-link nav-toggle">
                                   <span class="title">Batch Callchain </span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'onlineCallchain') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="onlineCallchain.php" class="nav-link nav-toggle">
                                   <span class="title">Online Callchain</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'schedulerCallChain') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="schedulerCallChain.php" class="nav-link nav-toggle">
                                   <span class="title">Scheduler Callchain</span>
                              </a>
                         </li>

                    </ul>
               </li> -->
               <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle collapsed" data-toggle="collapse" data-target="#submenu1sub2">
                         <img src="../assets/img/strategy.png" style="height:30px;width:30px;margin-right:7%">
                         <span class="title" style="color:#fff; font-weight:bold;">Interface Charts</span>
                    </a>
                    <ul class="sub-menu collapse" id="submenu1sub2" aria-expanded="true">
                         <!-- <li class="nav-item <?php if ($page == 'btobsankey') {
                                                       echo 'start active open';
                                                  } ?>">
                              <a href="btobsankey.php" class="nav-link nav-toggle">
                                   <span class="title">Application to Business Mapping</span>
                              </a>
                         </li> -->
                         <li class="nav-item <?php if ($page == 'systemSankey') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="appInterfaceChart.php" class="nav-link nav-toggle">
                                   <span class="title">Application Interface</span>
                              </a>
                         </li>
                         <!-- <li class="nav-item <?php if ($page == 'db2InterfaceSankey') {
                                                       echo 'start active open';
                                                  } ?>">
                              <a href="db2InterfaceSankey.php" class="nav-link nav-toggle">
                                   <span class="title">DB2 Interface</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'IMSInterfaceSankey') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="imstablesystem.php" class="nav-link nav-toggle">
                                   <span class="title">IMS Interface</span>
                              </a>
                         </li>
                         <li class="nav-item <?php if ($page == 'fileInterfaceChart') {
                                                  echo 'start active open';
                                             } ?>">
                              <a href="fileInterfaceChart.php" class="nav-link nav-toggle">
                                   <span class="title">File Interface</span>
                              </a>
                         </li> -->

                    </ul>
               </li>
               <li class="nav-item">
                    <a href="uploadFile.php" class="nav-link nav-toggle collapsed" data-toggle="collapse" data-target="#submenu1sub2">
                         <img src="../assets/img/file.png" style="height:30px;width:30px;margin-right:7%">
                         <span class="title" style="color:#fff; font-weight:bold;">Upload</span>
                    </a>
               </li>
               <li class="nav-item">
                    <a href="controlFlow.php" class="nav-link nav-toggle collapsed" data-toggle="collapse" data-target="#submenu1sub2">
                         <img src="../assets/img/distribution.png" style="height:30px;width:30px;margin-right:7%">
                         <span class="title" style="color:#fff; font-weight:bold;">Control FLow</span>
                    </a>
               </li>
		   </li>

               <!--<li class="nav-item">
				<a href="mailto:legacymodernization.fssbu@capgemini.com" class="nav-link nav-toggle">
					<img src="../assets/img/contact.png" style="height:30px;width:30px;margin-right:7%">
					<span class="title" style="color:#fff; font-weight:bold;">Contact Us</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="http://34.197.209.70/landingpage/index.html" target="_blank" class="nav-link nav-toggle">
					<img src="../assets/img/about.png" style="height:30px;width:30px;margin-right:7%">
					<span class="title" style="color:#fff; font-weight:bold;">About Us</span>
				</a>
			</li>-->
          </ul>
     </div>
</div>