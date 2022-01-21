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
$id=$_POST['pack'];
$p=mysqli_query($connection_db, "SELECT * FROM holiday WHERE id='$id'");
$q=mysqli_fetch_array($p);
$rate=$q['amount'];
$pack=$q['name'];
$j=$_POST['j'];
$m=$_POST['mem'];
$d=$_POST['d'];

$amount=$m*$rate;
if($id!=NULL && $j!=NULL && $m!=NULL && $d!=NULL)
{
	$sql=mysqli_query($connection_db, "INSERT INTO bookings(email,package,members,journey,amount,date,status) VALUES('$email','$pack','$m','$j','$amount','$d','0')");
	if($sql)
	{
		$info="Successfully Received Your Booking Info.<br> Total Amount Payable for $m Member(s) is INR $amount";
	}
	else
	{
		$info="Error Please Try Again";
	}
}
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Holiday Reservation System</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.shape_table
{
	border:1px solid #333;
	border-collapse:collapse;
	color:#FFF;
}

</style>
</head>

<body>
<div id="header">
  <div align="center"> <span class="headingMain">Holiday Reservation System</span> </div>
</div>
<br />
<br />
<div align="center"> <span class="subHead">Book Holiday Package</span> <br />
  <br />
  <form method="post" action="">
 <table border="0" cellpadding="5" cellspacing="5" class="design">
 <tr><td colspan="2" align="center" class="info"><?php echo $info;?></td></tr>
 <tr><td class="labels">Package : </td><td>
 <select name="pack" class="fields" required>
 <option value="" selected="selected" disabled="disabled"> - - Select Package - -</option>
 <?php
 $x=mysqli_query($connection_db, "SELECT * FROM holiday");
 while($y=mysqli_fetch_array($x))
 {
	 ?>
<option value="<?php echo $y['id'];?>"><?php echo $y['amount']."&#8378"."/".$y['name'];?></option>
<?php } ?>
</select></td></tr>
<tr><td class="labels">Journey By : </td><td>
<select name="j" class="fields" required>
<option value="" selected="selected" disabled="disabled">- - Ticket By - -</option>
<option value="Air">Air</option>
<option value="Train">Train</option>
<option value="Travels(BUS)">Travels(BUS)</option>
</select>
</td></tr>
<tr><td class="labels">Members : </td><td><input type="number" class="fields" size="5" placeholder="Select Members"  required="required" name="mem" /></td></tr>
<tr><td class="labels">Date : </td><td><input type="date" class="fields" size="10" placeholder="DD/MM/YYY"   required="required" name="d" /></td></tr>



<tr><td colspan="2" align="center"><input type="submit" value="BOOK NOW" class="button" /></td></tr>
</table> 
</form>
<br />
<br />
 <span class="subHead">Current Holiday Packages<br /></span><br />

<table border="0" cellpadding="5" cellspacing="5" class="design shape_table">
<tr><th>Sr.No.</th><th class="shape_table">Package Name</th>
<th>Journey By</th><th class="shape_table">Total Amount</th><th class="shape_table">Date</th><th class="shape_table">Status</th>
<th class="shape_table">Delete</th></tr>
<?php
$u=1;
$x=mysqli_query($connection_db, "SELECT * FROM bookings WHERE email='$email'");
while($y=mysqli_fetch_array($x))
{
	?>
<tr class="labels">
<td class="shape_table"><?php echo $u;$u++;?></td>
<td class="shape_table"><?php echo $y['package'];?></td>
<td class="shape_table"><?php echo $y['journey'];?></td>
<td class="shape_table"><?php echo "&#8378 ".$y['amount'];?></td>
<td class="shape_table"><?php echo $y['date'];?></td>
<td class="shape_table"><?php if($y['status']==1){echo "Approved";}else{echo "Pending";}?></td>
<td class="shape_table">
	<a href="deleteH.php?d=<?php echo $y['id'];?>" ><p class="delete">Delete</p></a></td>
</tr>
<?php } ?>
</table>
<br /><br /><br /><br />
<a href="home.php" class="link">&#10232 HOME</a>
</div>
</body>
</html>