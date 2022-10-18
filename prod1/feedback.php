
<?php  $m = new MongoClient(); // connect
    $db = $m->cards; // get the database named "foo"
    //echo $db;
    $collection = $db->registration;
    //echo $collection;
	$regSuccess = false;
    if(isset($_POST['submit'],$_POST['name'],$_POST['question1'],$_POST['question2']))
	{
			$name = $_POST['name'];      
			$question1 = $_POST['question1'];
			$question2 = $_POST['question2'];
			$feedbackid = 0;
			$Highestid = $collection->find()->sort(array('feedbackid' => -1))->limit(1);
			foreach($Highestid as $Highest)
			{
				$feedbackid = $Highest['feedbackid'];
			}
			$feedbackid += 1;
			if($name !== "" && $question2 !== "" && $question1 !== "")
			{
				$array = array(
						'feedbackid' => $feedbackid,
						'name'=>$name,
						'question2'=>$question2,
						'question1'=>$question1,
				);
				$validation = $collection -> find(array( 'name' => $name ))->count();
				if($validation == 1)
				{
					echo "<script>alert('User Already Registered');</script>";
				}
				else
				{
					$cursor = $collection->insert($array);
					$regSuccess = true;
					?>
					<script>
					alert ('<?php echo 'Thank you for your valuable feedback!  Your Registration number is:' ?>');
					
					</script>
					<?php
				} 
			}
			
			if($regSuccess == true)
			{
				$to = "daison.aloor-david@capgemini.com";
				$subject = "New feedback for Legacy Team";

				$message = "
				<html>
				<head>
				<title>Legacy Revitalization</title>
				<style>
				table {
					font-family: Calibri;
					font-size: 16;
					border-collapse: collapse;
					width: 100%;
				}

				td, th {
					border: 1px solid #dddddd;
					text-align: left;
					padding: 8px;
				}

				tr:nth-child(even) {
					background-color: #dddddd;
				}
				</style>
				</head>
				<body>
				<h3>A New user has registered for the Legacy Team</h3>
				<table>
					<tr>
						<td><b>Name: </b></td>
						<td>".$name."</td>
					</tr>
					<tr>
						<td><b>issue: </b></td>
						<td>".$question1."</td>
					</tr>
					<tr>
						<td><b>solution: </b></td>
						<td>".$question2."</td>
					</tr>
				</table>
				</body>
				</html>
				";
				
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <donotreply@legacy.com>' . "\r\n";
				$headers .= 'Cc: alisha.a.alisha@capgemini.com' . "\r\n";

				mail($to,$subject,$message,$headers);
			}
			
			if($regSuccess == true)
			{
				$to = $email;
				$subject = "Feedback Successfully submitted";

				$message = "
				<html>
				<head>
				<title>Legacy Revitalization</title>
				<style>
				table {
					font-family: Calibri;
					font-size: 16;
					border-collapse: collapse;
					width: 100%;
				}

				td, th {
					border: 1px solid #dddddd;
					text-align: left;
					padding: 8px;
				}

				tr:nth-child(even) {
					background-color: #dddddd;
				}
				</style>
				</head>
				<body>
				<h3>Your Feedback for Legacy team is Successful</h3>
				<h6>Feedback details</h6>
				<table>
					<tr>
						<td><b>Name: </b></td>
						<td>".$name."</td>
					</tr>
					<tr>
						<td><b>issue: </b></td>
						<td>".$question1."</td>
					</tr>
					<tr>
						<td><b>solution: </b></td>
						<td>".$question2."</td>
					</tr>
				</table>
				</body>
				</html>
				";
				
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <donotreply@legacy.com>' . "\r\n";
				//$headers .= 'Cc: mathivanan.loganathan@capgemini.com, vishnu-sankar.gengaraj@capgemini.com, karthick.appadurai@capgemini.com' . "\r\n";

				mail($to,$subject,$message,$headers);
			}
		}	
	}  
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<style>
   body{
            margin:0;
				background-color:#F0FFFF;background:url('bg_cards.jpg') no-repeat center center fixed;
				-webkit-background-size:cover;
				-moz-background-size:cover;
				-o-background-size:cover;
				background-size:cover;
				overflow-x:hidden;
				height:100%;
    }
           .b {
                float:left;	
                font-family: 'Bree Serif', serif;
                color:white;
            }
            .image{
                height: 70%;
                width: 100%;
            }
            .header-bg {
                position: relative;
                height: 640px;
                overflow: hidden;
            }
            .header-bg:before {
                top: 0;
                position: absolute;
                display: block;
                width: 100%;
                height: 100%;
                content: "";
                background: url(../images/bg.png) repeat;
                z-index: 40;
            }
            .bottom-left {
                position: absolute;
                bottom: 8px;
                left: 16px;
            }
            .bottom-right {
                position: absolute;
                bottom: 8px;
                right: 16px;
            }
			   
    .well{
      margin-top:3%;
      background-color: #fff;
      border-radius:10px;
      box-shadow: 5px 5px 5px 5px black;
    }
    .red-color{
      color:red;
    }
    .mandatory{
      color:red;
    }
<!--#contactbut{
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0;
	background-color:#9D1313;
	height:60px;
	width:330px;
    border-radius: 10px;
	font-family: 'Quicksand', sans-serif;
	color:black;
	font-size:25px;
}-->
.button-8 {
  
  left: 150px;
  border-radius: 4px;
  background-color:#f47141;
  border: none;
  padding: 20px;
  width: 200px;
  box-shadow: 0 9px #95a5a6;
  transition: all 0.5s;
}


.button-8 span {
  cursor: pointer;
  display: inline-block;
 
  transition: 0.5s;
  color: white;
}

.button-8 span:after {
  color: white;
  
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button-8:hover span {
  padding-right: 25px;
}
.button-8:hover{
  background-color: #e63900;
  }

.button-8:hover span:after {
  opacity: 1;
  right: 0;
}
button {
  font: inherit;
  color: inherit;
  width: 300px;
  text-transform: uppercase;
  padding: 25px 80px;
	margin: 15px 30px;
  background: #823aa0;
  overflow: hidden;
  position: relative;
}
button:before {
  	left: 48%;
}
button:active {
	background: #9053a9;
  color: #823aa0;
	top: 2px;
}
button > span {
	display: inline-block;
	transition: all 0.5s;
}
.icon-forward:before {
  content: "→";
  position: absolute;
}

.btn-1:before {
	left: -50%;
  transition: all 0.5s;
}
.btn-1:hover:before {
	left: 40%;
}
#nav_bg
{
	background-color: #f47141;
}
.col-sm-4 {
    left:20px;
    width: 33.33%;
    padding: 10px;
    height: 300px;
	color: white;
	font-family:"Times New Roman", Times, serif;
	font-size: 22px;
	
	/* Should be removed. Only for demonstration */
}


	</style>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Legacy Revitalization </title>
  <link rel="shortcut icon" href="favicon.ico">
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">-->
		<link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <!--For Plugins external css-->
        <link rel="stylesheet" href="assets/css/plugins.css" />
        <link rel="stylesheet" href="assets/css/raleway-webfont.css" />
        <!--Theme custom css -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" />
		<!--footer style-->
		<link rel="stylesheet" href="footer-distributed-with-address-and-phones.css">
		
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<div class='preloader'><div class='loaded'>&nbsp;</div></div>
         <nav class="navbar navbar-default navbar-fixed-top" id="nav_bg">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
				<div class="col-md-4">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php" style="font-family: 'Times New Roman', sans-serif; color:white; font-size:30px"> Legacy Revitalization </a>
                </div>
				</div>
				<div class="col-md-2"></div>
                <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="col-md-6">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
					
                        <li style="font-family: 'Times New Roman',sans-serif; color:white; font-weight:bold" ><a href="http://34.197.209.70/landingpage/index.html">About Us</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
			</div> <!-- /.container-fluid -->
        </nav>
	
		<br><br><br><br><br><br><br><br>
        <!--Inside of the particle -->
 <div class="container">
	  <div class="row setup-content" id="step-1">
        <div class="col-xs-12 col-sm-12 col-md-12"> 
            <div class="col well">
               <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" id="register">
                <fieldset>
                    <legend><center><h3>Employee Feedback</h3></center></legend>
                <div class="row">
                  <div class="col-sm-offset-2 col-sm-8">
                     <div class="form-group">                   
                        <label for="validate-text"></span> Name </label> 
                          <div class="input-group" role="group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <div class="btn-group btn-group-justified" role="group" >                          
                              <input type="text" class="form-control" name="name" id="name" placeholder="Eg. Daison Joseph"  value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
                          </div>                          
                        </div>
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-offset-2 col-sm-8">
                  </div>
                </div>
				<div class="row">
                  <div class="col-sm-offset-2 col-sm-8">
                     <div class="form-group">                   
                        <label for="validate-text"></span> What are the issues which you face in the team *</label> 
                          <div class="input-group" role="group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <div class="btn-group btn-group-justified" role="group" >                          
                              <input type="text" class="form-control" name="question1" id="question1" placeholder="free food"  value="<?php echo isset($_POST['question1']) ? $_POST['question1'] : '' ?>">
                          </div>                          
                        </div>
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-offset-2 col-sm-8">
                    <div class="form-group red-color">                   
                          <?php
                            if(isset($_POST['submit'])){
                              if(empty($_POST['question1'])) {
                                   echo '<label></span> Please let us know the issues which you are facing as an employee</label>';
                                } else {
                              }
                            }
                          ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-offset-2 col-sm-8">
                     <div class="form-group">                   
                        <label for="validate-text"></span> What better things can we do ?</label> 
                          <div class="input-group" role="group">
                            <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                            <div class="btn-group btn-group-justified" role="group" >                          
                              <input type="number" class="form-control" name="question2" id="question2" placeholder="Eg. 987654321" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : '' ?>" >
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-offset-2 col-sm-8">
                    <div class="form-group red-color">                   
                          <?php
                          ?>
                    </div>
                  </div>
                </div>
                <center><input type="submit" class="btn btn-success" name="submit" value="SUBMIT"  /></center>
              </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>


function checkvalue(val)
{
    if(val==="others")
       document.getElementById('dept').style.display='block';
    else
       document.getElementById('dept').style.display='none'; 
}


     /*$(document).ready(function () {
        $('#topics').change(function () {
            var value = $(this).val(); var toAppend = '';
            if (value == 'Others') {
              $("#container").removeClass("hide");
              toAppend = "<div class='form-group'><label for='validate-select' class='per-col'>Please Enter your topic</label><div class='input-group'><span class='input-group-addon danger'><span class='glyphicon glyphicon-asterisk'></span></span><input type='text' id='Others' name='Others' class='form-control' ></div></div>";
                $("#container").html(toAppend);
                return;
            }else{
              if(value !== 'Others'){
                  $("#container").addClass("hide");
              }
            }
        });
    });*/
</script>
        
        <!--End of the Inside of the particle -->
        <!--Footer-->
        <!--contact us section-->	
<!--contact us section-->
	
	
	
	

	<footer class="footer-distributed">

			<div class="footer-left">

				<img style="width:30%;height:5%" src="logo.png"></img>
				<p style="color:white" class="footer-company-name"><a style="color:white" href="https://www.capgemini.com" target="_blank"> &nbsp; Capgemini</a> &copy;  2018</p>
			
				
			</div>
			<div class="footer-center">
				
				<a href="https://www.facebook.com/capgemini" target="_blank"><i class="fa fa-facebook"></i></a>
					<a href="https://twitter.com/Capgemini?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank"><i class="fa fa-twitter"></i></a>
					<a href="https://www.linkedin.com/company/capgemini" target="_blank"><i class="fa fa-linkedin"></i></a>
			</div>
			<div class="footer-right">

				<div>
				<img style="width:15%;height:7%;"  
				src="legacy.png" align="middle"  ><span style="color:white">LEGACY REVITALIZATION</span> </img>
				
				</div>

			</div>

			

			

		</footer>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/jquery.easypiechart.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/modernizr.js"></script>
    <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="particles.js"></script>
    <script src="app.js"></script>
</body>
</html>