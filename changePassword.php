<?php
/*Author: Ege PERIM*/
include("connectiondb.php");
include("fileIO.php");
session_start();
if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
$email=$_SESSION['email'];
$a=mysqli_query($connection_db, "SELECT * FROM customers WHERE email='$email'");
$b=mysqli_fetch_array($a);
$name=$b['name'];
$pass=$b['password'];
$old=($_POST['old']);
$p1=($_POST['p1']);
$p2=($_POST['p2']);
if($_POST['old']==NULL || $_POST['p1']==NULL || $_POST['p2']==NULL)
{
	
}
else
{
if($old!=$pass)
{
	$info="Incorrect Old Password";
}
elseif($p1!=$p2)
	{
		$info="New Password Didn't Matched";
	}
	else
	{
		mysqli_query($connection_db, "UPDATE admin SET password='$p2' WHERE aid='$aid'");
		$info="Successfully Changed your Password";
		$log_message=$name." "."succesfully changed him/her password.";
		write_log($log_message);
	}

}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Holiday Reservation System</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.ashu
{
	border:1px solid #333;
	border-collapse:collapse;
		color:#FFF;
		text-shadow:1px 1px 1px #000000; 
}

</style>
</head>

<body>
<div id="header">
  <div align="center"> <span class="headingMain">Holiday Reservation System</span> </div>
</div>
<br />
<br />

<div align="center">

 <span class="subHead">Change Password<br /></span><br />
<form method="post" action="">
<table cellpadding="3" cellspacing="3" class="design" align="center">
<tr><td colspan="2" class="info" align="center"><?php echo $info;?></td></tr>
<tr><td class="labels">Old Password :</td><td><input type="password" name="old" size="25" class="fields" placeholder="Enter Old Password" required="required" /></td></tr>
<tr><td class="labels">New Password :</td><td><input type="password" name="p1" size="25" class="fields" placeholder="Enter New Password" required="required"  /></td></tr>
<tr><td class="labels">Re-Type Password :</td><td><input type="password" name="p2" size="25"  class="fields" placeholder="Re-Type New Password" required="required" /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Change" class="button" /></td></tr>
</table>
</form>
<br />
<br />
<a href="home.php" class="link">&#10232 HOME</a>
</div>
</body>
</html>