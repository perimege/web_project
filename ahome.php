<?php
/*Author: Ege PERIM*/
include("connectiondb.php");
session_start();
if(!isset($_SESSION['aid']))
{
	header("location:admin.php");
}
$aid=$_SESSION['aid'];
$a=mysqli_query($connection_db, "SELECT * FROM admin WHERE aid='$aid'");
$b=mysqli_fetch_array($a);
$name=$b['name'];
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
<div align="center"> <span class="subHead">Welcome <?php echo $name;?></span> <br />
  <br />
  <table border="0">
<tr><td>  <a href="holiday.php" class="cmd">&#9992; Manage Holiday Packages</a></td><td><a href="changePasswordAdmin.php" class="cmd">&#9992; Change Password</a></td></tr>
<tr><td><a href="orders.php" class="cmd">&#9992; Orders</a></td><td><a href="logout.php" class="cmd">&#9992; Logout</a>
</table>
</div>
</body>
</html>