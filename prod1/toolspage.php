<?php 
    require 'sessioncon.php'; if(!isset($_SESSION['Uid'])) { header('Location:login.php'); } ?>

<!DOCTYPE html>
<html lang="en">
<style>
	tbody tr a{
			color:black;		
			
	}
	.portlet-body table a
	{
		text-decoration: none;
		cursor: default;
	}
</style>
<head>
    <meta charset="utf-8" />
    <title>DevOps Analyzer</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="DevOps Analyser created by Legacy Modernization Team" name="description" />
    <meta content="" name="author" />
    <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/pages/css/tools.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../assets/layouts/layout/img/cap.ico" />
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white  page-sidebar-fixed">
    <div class="page-wrapper">
	   <?php include 'header.php'; ?>
        <div class="clearfix"> </div>
        <div class="page-container">
		<?php include 'sidebar.php'; ?>           
		   <div class="page-content-wrapper">
                <div class="page-content" style="background-color:#fff;">
                    <div class="page-bar" style="background-color:#778899;height:21px;">
                        <ul class="page-breadcrumb" style="padding-top:1px;">
                            <li>
                                <span style="color:white">DevOps Assessment</span>
                                <i class="fa fa-circle" style="color:white"></i>
                            </li>
                            <li>
                                <span style="color:white">Tools</span>
                            </li>
                        </ul>
                    </div><br /><br />
					<div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered" id="secondscroll">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-blue hide"></i>
                                            <span class="caption-subject font-blue bold">Impact Analysis</span>
                                    </div>
                                    <div class="tools">
                                        <a href="" class="expand"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body portlet-collapsed-on-mobile portlet-collapsed">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            Tool
                                                        </td>
                                                        <td>
                                                            Vendor
                                                        </td>
														<td>
															Add
														</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a href="#">
                                                            Rational Asset Analyzer</a>
														</td>
														<td>
															IBM
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td><a href="#">
                                                            Enterprise Analyzer</a>
														</td>
														<td>
															Microfocus
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td><a href="#">
                                                            CA Application Lifecycle</a>
														</td>
														<td>
															CA Technologies
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn green" onClick="save()">Submit Tools</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered" id="secondscroll">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-blue hide"></i>
                                            <span class="caption-subject font-blue bold">Coding/Development Environment</span>
                                    </div>
                                    <div class="tools">
                                        <a href="" class="expand"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body portlet-collapsed-on-mobile portlet-collapsed">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            Tool
                                                        </td>
                                                        <td>
                                                            Vendor
                                                        </td>
														<td>
															Add
														</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a href="#">
                                                            Rational Developer for System Z(RDz)</a>
														</td>
														<td>
															IBM
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td><a href="#">
                                                           Enterprise Developer</a>
														</td>
														<td>
															Microfocus
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td><a href="#">
                                                            Enterprise Sync</a>
														</td>
														<td>
															Micro Focus
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td><a href="#">
                                                            Changeman ZMF (Serena)</a>
														</td>
														<td>
															Microfocus
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn green" onClick="save()">Submit Tools</button>
									</div>
								</div>
							</div>
						</div>
					</div><div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered" id="secondscroll">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-blue hide"></i>
                                            <span class="caption-subject font-blue bold">Code Review</span>
                                    </div>
                                    <div class="tools">
                                        <a href="" class="expand"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body portlet-collapsed-on-mobile portlet-collapsed">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            Tool
                                                        </td>
                                                        <td>
                                                            Vendor
                                                        </td>
														<td>
															Add
														</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a href="#">
                                                            Rational Developer for System Z(RDz)</a>
														</td>
														<td>
															IBM
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td><a href="#">
                                                            Enterprise Developer</a>
														</td>
														<td>
															Microfocus
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td><a href="#">
                                                            Topaz Suite with SonarSource Integrated</a>
														</td>
														<td>
															Compuware
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn green" onClick="save()">Submit Tools</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered" id="secondscroll">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-blue hide"></i>
                                            <span class="caption-subject font-blue bold">Version Control</span>
                                    </div>
                                    <div class="tools">
                                        <a href="" class="expand"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body portlet-collapsed-on-mobile portlet-collapsed">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            Tool
                                                        </td>
                                                        <td>
                                                            Vendor
                                                        </td>
														<td>
															Add
														</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a href="#">
                                                            Endevor</a>
														</td>
														<td>
															CA Technologies
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td><a href="#">
                                                            Changeman</a>
														</td>
														<td>
															Microfocus
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn green" onClick="save()">Submit Tools</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light bordered" id="secondscroll">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-blue hide"></i>
                                            <span class="caption-subject font-blue bold">Testing</span>
                                    </div>
                                    <div class="tools">
                                        <a href="" class="expand"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body portlet-collapsed-on-mobile portlet-collapsed">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            Tool
                                                        </td>
                                                        <td>
                                                            Vendor
                                                        </td>
														<td>
															Add
														</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a href="#">
                                                            Enterprise Developer</a>
														</td>
														<td>
															Micro Focus
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td><a href="#">
                                                            Designer</a>
														</td>
														<td>
															CA Technologies
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td><a href="#">
                                                            Xpeditor</a>
														</td>
														<td>
															Compuware
														</td>
														<td>
															<div class="form-group">
																<div class="mt-checkbox-list">
																	<label class="mt-checkbox mt-checkbox-outline">
																		<input type="checkbox" value="<?php echo $v++; ?>" name="<?php echo "name".$k; ?>" />
																		<span></span>
																	</label>
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn green" onClick="save()">Submit Tools</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>				
            <div class="page-footer">
                <div class="page-footer-inner"> 2017 &copy; DevOps Tool By
                    <a href="https://www.capgemini.com/">Capgemini</a>
                    <div class="scroll-to-top">
                        <i class="icon-arrow-up"></i>
                    </div>
                </div>
            </div>
        </div>
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/ui-extended-modals.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
		<script>
		/*	var counter = 0;
			var jsonObj = new Object();
			function funct(name,vendor){
				var toolname = name;
				var vendorname = vendor;  
				if (!(toolname in jsonObj)) { // if item is not in the object, (title in jsonObj) returns true of false
						   jsonObj[toolname] = { // When you have hundreds of items, this approach is way faster then using FOR loop, and if you need to alter the item or get one value, you can just call it by name: jsonObj['ABC'].image will return the path of the image
							   : counter,
							   image: 
						   }
						   counter++;
						   $('#lblCart').html(counter);
					   } else {
						   // Do what you want if the item is already in the list
						   alert('Item already in the list');
						   console.log(jsonObj[title]);
					   }
					};				
			*/
			function save(){
				alert("Successfully Submitted");
			}
		</script>
</body>
</html>