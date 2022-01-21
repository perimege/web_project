<?php
/*Author: Ege PERIM*/
include("connectiondb.php");
include("fileIO.php");
$n=$_POST['name'];
$e=$_POST['email'];
$p=($_POST['pass']);

/*image upload variables*/

$img_name=$_FILES['profile_avatar']['name'];
$img_size=$_FILES['profile_avatar']['size'];
$tmp_name=$_FILES['profile_avatar']['tmp_name'];
$error=$_FILES['profile_avatar']['error'];
$img_ex=pathinfo($img_name, PATHINFO_EXTENSION);//image uzantısını döndürür
$img_ex_lc=strtolower($img_ex);
/*image upload variables*/

$allowed_exs=array("jpg","jpeg","png");



if($n!=NULL && $e!=NULL && $p!=NULL)
{
	if(in_array($img_ex_lc, $allowed_exs) or $img_name==NULL){
		$new_img_name=uniqid("IMG-",true).".".$img_ex_lc;
		$img_upload_path='images/'.$new_img_name;
		if($img_name!=NULL)
		{
			move_uploaded_file($tmp_name, $img_upload_path);
			$query="INSERT INTO customers (name,email,password,image) VALUES ('$n','$e','$p','$new_img_name')";
			$sql=mysqli_query($connection_db,$query);
		}
		else{
			$query="INSERT INTO customers (name,email,password) VALUES ('$n','$e','$p')";
			$sql=mysqli_query($connection_db,$query);

		}
		
		if($sql)
		{
			$info="<p style='color: green;''>Successfully Registered</p>";
			$log_message=$n." "."successfully registered to system with"." ".$e;
			write_log($log_message);

		}
		else
		{
			$info="<p style='color: red;''>Email Already Exists</p>";
		}

		}
	else
	{
		$info="<p style='color: red;''>You can't upload files of this type</p>";
	}
	
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" lang="en" />
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
<div align="center"><br />
<br />
<span class="subHead"><b>Registration Panel<b></span><br />
<br />

<form method="post" action="" enctype="multipart/form-data">
<table border="0" align="center" cellpadding="5" cellspacing="5" class="design">
<tr><td colspan="2" class="info" align="center"><?php echo $info;?></td></tr>
<tr><td class="labels">Name : </td><td><input type="text" size="25" name="name" class="fields" placeholder="Enter Username" required="required" autocomplete="off" /></td></tr>
<tr><td class="labels">Email : </td><td><input type="email" size="25" name="email" class="fields" placeholder="Enter Email" required="required" autocomplete="off" /></td></tr>
<tr><td class="labels">Password : </td><td><input type="password" size="25" name="pass" class="fields" placeholder="Enter Password" required="required" /></td></tr>
<tr><td class="labels">Upload Avatar :</td><td><input type="file" class="fields" name="profile_avatar" size="10"/></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Register" class="button" /></td></tr>
</table>
</form>
<br />
<br />

<a href="index.php" class="link">&#10232 HOME</a>
</div>
</body>
</html>