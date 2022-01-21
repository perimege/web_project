<?php
/*Author: Ege PERIM*/
include("connectiondb.php");
session_start();
if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
$email=$_SESSION['email'];
$a=mysqli_query($connection_db, "SELECT * FROM customers WHERE email='$email'");
$b=mysqli_fetch_array($a);
$name=$b['name'];
$avatar=$b['image'];
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Holiday Reservation System</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="header">
  <div align="center"> <span class="headingMain">Holiday Reservation System</span> </div>
</div>
<br />
<br />
<div align="center"> <span class="subHead">Welcome <?php echo strtoupper($name);?></span> <br />
  <br />
<img src="images/<?=$avatar?>" width="200" alt="PROFILE PHOTO">;
  <table border="0">
<tr><td><a href="book.php" class="cmd">&#9992;Book Holiday Package</a></td><td><a href="changePassword.php" class="cmd">&#9992; Change Password</a></td></tr>
<tr><td colspan="2" align="center"><a href="logout.php" class="cmd">&#9992; Logout</a>
</table>
</div>
</body>
</html>