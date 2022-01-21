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

 <span class="subHead">Customers Booking<br /></span><br />

<table border="0" cellpadding="5" cellspacing="5" class="design ashu">
<tr class="labels ashu"><th class="ashu">Sr.No.</th><th class="ashu">E-Mail</th><th class="ashu">Package Name</th>
<th class="ashu">Journey By</th>
<th class="ashu">Total Amount</th>
<th class="ashu">Members</th>
<th class="ashu">Date</th>
<th class="ashu">Status</th>
<th class="ashu">Delete</th></tr>
<?php
$u=1;
$x=mysqli_query($connection_db, "SELECT * FROM bookings");
while($y=mysqli_fetch_array($x))
{
	?>
<tr class="labels">
<td class="ashu"><?php echo $u;$u++;?></td>
<td class="ashu"><?php echo $y['email'];?></td>
<td class="ashu"><?php echo $y['package'];?></td>
<td class="ashu"><?php echo $y['journey'];?></td>
<td class="ashu"><?php echo "INR ".$y['amount'];?></td>
<td class="ashu"><?php echo $y['members'];?></td>
<td class="ashu"><?php echo $y['date'];?></td>
<?php if($y['status']==0)
{
	
?> <td class="ashu"><a href="app.php?a=<?php echo $y['id'];?>" class="approve">Approve</a></td>
<?php } else { ?>
<td class="ashu"><p style="color: green;">Approved</p></td>
<?php }
?>
<td class="ashu"><a href="deleteH.php?dd=<?php echo $y['id'];?>" class="delete">Delete</a></td>
</tr>
<?php } ?>
</table>
<br />
<br />
<a href="ahome.php" class="link">&#10232 HOME</a>
</div>
</body>
</html>