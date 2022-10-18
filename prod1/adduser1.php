<?php
	include 'sessioncon.php';
	unset($_SESSION["error"]);
	unset($_SESSION["success"]);
	unset($_SESSION["nameerror"]);
	unset($_SESSION['unsuccess']);
	$error = "";
	$success = "";
	$nameerror = "";
	
	if(isset($_POST['create'])){
		echo $firstname = $_POST['firstname'];
		echo $firstname = ltrim($firstname);
		echo $firstname = rtrim($firstname);
		      /* if (!preg_match("/^[a-zA-Z ]*$/",$firstname)){ */
                                          /*       $nameerror = "Firstame should be alphabetic only";
                                                $_SESSION['nameerror'] = $nameerror;
                                                header("Location:newuser.php");
                                } */
		echo $lastname = $_POST['lastname'];
		echo $lastname = ltrim($lastname);
		echo $lastname = rtrim($lastname);
			/* if (!preg_match("/^[a-zA-Z ]*$/",$firstname) || !preg_match("/^[a-zA-Z ]*$/",$lastname)){
                                                $nameerror = "Name should be alphabetic only";
                                                $_SESSION['nameerror'] = $nameerror;
                                                header("Location:newuser.php");
                                } */
		$Uid = $_POST['Uid'];
		$password = $_POST['password'];
		$password1 = $_POST['password1'];
		$role = $_POST['role'];
		$i = 0;
		foreach($_POST["portfolio"] as $port){
			$portfolioarray[$i] = $port;
			echo $port.'/';
			$i++;
		}
		//var_dump($portfolioarray);
		$j = 0;
		foreach($_POST["application"] as $app){
			$applicationarray[$j] = $app;
			echo $app.'/';
			$j++;
		}
		//var_dump($applicationarray);
//Changes made from here on (shivam,puja,karthik)		
		if($password !== $password1){
			$error =  "Password doesn't match";
			$_SESSION['error'] = $error;
		}
		else
		{
			unset($_SESSION["error"]);
			if (preg_match("/^[a-zA-Z ]*$/",$firstname) && preg_match("/^[a-zA-Z ]*$/",$lastname))				
			{				
				//header("Location:newuser.php");  
				$array = array("Uid"=>$Uid);
				$cursor = $user->find($array)->count();
				if($cursor == 0){
					$userdocument = array("firstname"=>$firstname,"lastname"=>$lastname,
											"Uid"=>$Uid,"Password"=>$password,"role"=>$role,"portfolio"=>$portfolioarray,"application"=>$applicationarray);
					$user->insert($userdocument);
					$success = "Successfully Submitted";
					$_SESSION['success'] = $success;
				}
				else{
					$error = "User Id already exist";
					$_SESSION['unsuccess'] = $error;
					/* unset($_SESSION["success"]); */
				}			
			}
			else
			{
//				$nameerror = "Name should be alphabetic only";
//				$_SESSION['nameerror'] = $nameerror;
				$error = "Please enter valid details";
				$_SESSION['unsuccess'] = $error;
			}
		}
	}
	header("Location:newuser.php");
	?>