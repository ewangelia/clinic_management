<?php
function check_login()
{
if(strlen($_SESSION['id_user'])==0)
	{
		// $host = $_SERVER['HTTP_HOST'];
		// $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		// $extra="index.php";
		// $_SESSION["id_user"]="";
		header("Location: http://localhost/clinic_management2/clinic_management/login.php");
	}
}
?>
