<?php require 'sessioncon.php';if(isset($_SESSION['name'])){session_destroy();header('Location: login.php');}else{header('Location: login.php');}?>