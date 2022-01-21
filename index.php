<?php
/*Author: Ege PERIM*/
include("connectiondb.php");
session_start();
if(isset($_SESSION['email']))
{
	header("location:home.php");
}
$e=mysqli_real_escape_string($connection_db, $_POST['email']);
$p=mysqli_real_escape_string($connection_db, $_POST['pass']);
if($_POST['email']!=NULL && $_POST['pass']!=NULL)
{
	$sql=mysqli_query($connection_db, "SELECT * FROM customers WHERE email='$e' AND password='$p'");
	if(mysqli_num_rows($sql)==1)
	{
		$_SESSION['email']=$e;
		header("location:home.php");
	}
	else
	{
		$info="<p style='color: red;'>Incorrect Email or Password</p>";
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Holiday Reservation System</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="header">
<div align="center">
<span class="headingMain">Holiday Reservation System</span>
</div>
</div>
<br />
<br />
<div align="center">
<span class="subHead">User Login</span><br />
<br />

<form method="post" action="">
<table border="0" align="center" cellpadding="5" cellspacing="5" class="design">
<tr><td colspan="2" class="info" align="center"><?php echo $info;?></td></tr>
<tr><td class="labels">Email  : </td><td><input type="email" size="25" name="email" class="fields" placeholder="Enter Email ID" required="required" autocomplete="off" /></td></tr>
<tr><td class="labels">Password : </td><td><input type="password" size="25" name="pass" class="fields" placeholder="Enter Password" required="required" /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Login" class="button" /></td></tr>
</table>
</form>
<br />
<br />
<a href="newReg.php" class="link">Register</a>
<br /><br />
<a href="admin.php" class="link">Admin Login</a>
</div>
</body>
</html>