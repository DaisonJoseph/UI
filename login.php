<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CAP360 Analyzer! | </title>

    <!-- Bootstrap -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content" >
            <form action="userlogin.php" method="post" >
			 <h1><span style="color:blue">CAP360</span>  Analyzer</h1>
              <h3>Login</h3>
			  <?php
				if (isset($_GET['message']))
					{
						$message = $_GET['message'];
						if($message == "auth-error")
							$message = "Invalid User Name or Password";
						echo '<h2><mark> ' . $message . '</mark></h2>';
					}
				?>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="userid" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password" />
              </div>
              <div>
                <input type="Submit" value="Submit">
                
              </div>
              <div class="clearfix"></div>


            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>