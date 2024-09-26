 <?php include("dataconnection.php"); 
session_start();

 if(isset($_SESSION['id']))
		{
			$user=$_SESSION['id'];
			$result=mysqli_query($connect,"SELECT * FROM user where user_id='$user'");
		}
			
		?>


<html>

<head>
<title>52 Hz | Buy Now</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>
body {
  font-family: Arial, Helvetica, sans-serif;
 /* background:linear-gradient(50deg, #B0C4DE, #fff);*/
}

.info{text-shadow:1px 2px grey;
		letter-spacing:5px;
		font-style:italic;}
	
.user_info{width:43%;
			height:500px;
			padding-left:14px;
			padding-top:35px;
			margin-top:30px;}

.label{font-size:17px;
		font-weight:bold;
		color:#778899;
		text-shadow:1px 1px #B8860B;}

.user_email{padding:10px;
				text-align:center;
				border-radius:5px;
				width:98%;
				font-style:italic;
				font-size:15px;}

.address_frm{padding:10px;
				text-align:center;
				border-radius:5px;
				width:160px;}

.name_frm{padding:10px;
			text-align:center;
			border-radius:5px;
			width:290px;
			}
				
.change_btn{padding:10px;
			margin-top:40px;
			float:right;
			border:none;
			background:transparent;
			color:#4B0082;
			font-size:20px;
			font-weight:bold;
			letter-spacing:2px;
			margin-left:30px;}
			
.change_btn:hover{text-decoration:overline;
					letter-spacing:4px;
					color:#9FC4B5;
					cursor:grabbing;}

		
table {
  margin-top:-500px;
  border-spacing: 0;
  border: none;
  float:right;
  width:50%;
}

th, td {
  
  padding: 16px;
  border:none;
}

.p_name{font-size:20px;
			font-weight:bold;
			color:#000080;}

.p_type_name{color:grey;
				font-size:15px;
				font-style:italic;
				text-align:left;}

.p_qty{font-weight:bold;
		}

.p_subtotal{font-weight:bold;
			color:black;}

.subtotal{letter-spacing:2px;
			font-size:22px;}

.total{letter-spacing:4px;}

.btnsub{padding:20px;
			border:none;
			box-shadow:1px 1px 2px 3px lightgrey;
			background-color:#F9FFFF;
			color:#696969;
			letter-spacing:1px;
			font-size:18px;
			letter-spacing:5px;
			margin-top:15px;
			margin-right:19px;}
			
.btnsub:hover{background-color:#9AAFC1;
				font-weight:bold;
				letter-spacing:2px;
				cursor:grabbing;
				color:#E9F5FF;
				letter-spacing:7px;
				margin-top:5px;}
				
option{text-align:left;}
</style>

<script>
<?php 
	if(isset($_SESSION['id']))
	{
		$user=$_SESSION['id'];
		$result=mysqli_query($connect,"SELECT * FROM user where user_id='$user'");
						
		$row=mysqli_fetch_assoc($result);
						
		$user_status=$row["user_name"];
						
	}
	else
	{
		$user_status="LOGIN";
						
	}
?>
				
function user_status_link()
{
	var user_status="<?php echo $user_status;?>";
	if(user_status=="login")
	{
		window.location.href = "login.php";
	}
	else
	{
		window.location.href = "profile.php";
	}
	
}

function search()
{
	var search_name=document.getElementById("searching").value;
	
	window.location.href = "search.php?search="+search_name;
}


</script>
</head>
<body>
	<?php
if(isset($_GET['procode']))
		 {
			 $prod_id=$_GET['procode'];
			 $qty=$_GET['qty'];
		 }
		 ?>
<div class="user_info">
	<h2 class="info">RECEPIENT CONTACT INFO </h2>
		<form method="post" action="buynow.php?header&procode=<?php echo $prod_id ?>&qty=<?php echo $qty ?>">
		
		<?php 
			$address=mysqli_query($connect,"SELECT * FROM user where user_id='$user'");
			$row_add = mysqli_fetch_assoc($address);
		?>
		
			<p class="label">Recipient  Name</p>
			<div ><input type="text" name="r_name" class="name_frm" pattern="[a-zA-Z]{1,30}" title = "Character Only." value="<?php echo $row_add['user_name']; ?>" required></div>
			
			<p class="label" style="margin-left:350px; margin-top:-75px;">Contact Number</p>
			<div style="margin-left:350px;"><input type="text" name="r_phone" class="name_frm" pattern="[0-9]{10,11}" title = "Minimum 10 numbers. Maximum 11 numbers" value="<?php echo $row_add['phone_num']; ?>" required></div>
			
			<p class="label">Email</p>
			<input type="email" name="email" class="user_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Format : xxx@email.com" autocomplete="off" value="<?php echo $row_add['user_email']; ?>" required>
			
			<p class="label" class="user_address">Address</p>
			<input type="text" name="address" class="user_email" title="minimum need 10 character" value="<?php echo $row_add["user_address"];?>" required>
						
			<p class="label">Postal Code</p>
			<div ><input type="text" name="postal" class="address_frm" pattern="[0-9]{5}" title="Five Number Postal Code" value="<?php echo $row_add['postal']; ?>" required></div>
			
			<p class="label" style="margin-left:240px; margin-top:-75px;">State</p>
			<div style="margin-left:240px;">
				<select name="state" class="address_frm" required> 
					<option hidden><?php echo $row_add['state']; ?></option>
					<option value="Malacca">Malacca</option>
					<option value="Johor">Johor</option>
					<option value="Selangor">Selangor</option>
				</select>
			</div>
			
			<p class="label" style="margin-left:480px; margin-top:-75px;">City</p>
			<div style="margin-left:480px;">
					<select name="city" class="address_frm" required> 
						<option hidden><?php echo $row_add['city']; ?></option>
						<option value="Ayer Keroh">Ayer Keroh</option>
						<option value="Malim">Malim</option>
						<option value="Kota Laksamana">Kota Laksamana</option>
						<option value="Batu Pahat">Batu Pahat</option>
						<option value="Segamat">Segamat</option>
						<option value="Senai">Senai</option>
						<option value="Petaling Jaya">Petaling Jaya</option>
						<option value="Cheras">Cheras</option>
						<option value="Seri Kembangan">Seri Kembangan</option>
					</select>
				</div>
				
			<input type="submit" value="Return to home" name="return_btn" class="change_btn">
			
			
</div>

<div style="text-align:center;">
	
		<table width="800px" style="text-align:center; margin-top:-475px; margin-right:50px;">
		
		<?php
			
			
		if(isset($_GET['procode']))
		 {
			 $prod_id=$_GET['procode'];
			 $qty=$_GET['qty'];
			
			mysqli_query($connect,"CREATE TABLE `52hz`.`tempo_buynow` ( `code` VARCHAR(255) NOT NULL , `qty` INT(255) NOT NULL ) ;");
			$table=mysqli_query($connect,"select * from tempo_buynow" );
			$got_value = mysqli_fetch_array($table, MYSQLI_ASSOC) ;
			if(!$got_value)
			{
				mysqli_query($connect,"insert into tempo_buynow (code,qty) values ('$prod_id',$qty);");
			}
			else//makesure the table only store one data!
			{
				mysqli_query($connect,"DROP TABLE `52hz`.`tempo_buynow`");
				mysqli_query($connect,"CREATE TABLE `52hz`.`tempo_buynow` ( `code` VARCHAR(255) NOT NULL , `qty` INT(255) NOT NULL ) ;");
				mysqli_query($connect,"insert into tempo_buynow (code,qty) values ('$prod_id',$qty);");
				
			}
		 }
		
			$result = mysqli_query($connect, "select * from product_type where product_type_id='$prod_id'");
			$row = mysqli_fetch_assoc($result);
			
			$p_id=$row['product_id'];
			
			$p_result = mysqli_query($connect, "select * from product where product_id='$p_id'");
			$p_row = mysqli_fetch_assoc($p_result);
			$price = $row["product_type_price"];
			$total=($price*$qty);
		?>
		<h2 class="info" style="margin-left:350px; margin-top:-475px;">ORDER SUMMARY</h2>
		
			<tr>
				

				<td><img src="Admin/working_site/Product_img/<?php echo $row["img_dir"] ?>" onerror="this.onerror=null; this.src='Default.png'" width="150px;"></td>
				
				<td>
					<p class="p_name"><?php echo $p_row["product_name"] ?> </p>
					<p class="p_type_name"><?php echo $row["product_type_name"] ?></p>
				</td>
				
				<!--<td name="price"></td>-->
				
				<td class="p_qty">
					x<?php echo $qty;?>
				</td >
				
				
				<td class="p_subtotal">RM <?php echo number_format($price, 2, '.', ''); ?></td>
				
			</tr>	
		
			<tr>
				<th colspan="9" align="right" class="subtotal">SUBTOTAL : RM <?php echo number_format($total, 2, '.', ''); ?>
				<p align="left" style="margin-left:445px;">SHIPPING <p style="margin-top:-48px; margin-left:585px; text-align:left;">: FREE</p></p>
			</tr>
			
				<tr>
					
					<th colspan="10" align="right" class="total"><hr><br>	TOTAL: <span style="font-size:25px;">MYR <?php echo number_format($total, 2, '.', ''); ?></span>
					<br><br>
					<input type="submit" class="btnsub" value="PROCEED" name="checkout">
					</th>
				
				</tr>
			
		</table>
		</form>
</div>
</body>
</html>
<?php


if (isset($_POST['return_btn']))
{
	?>
	<script>
		window.location.href="index.php";
	</script>
	<?php
}

if (isset($_POST['checkout']))
{
	
	$name=$_POST["r_name"];
	$phone=$_POST["r_phone"];
	$add=$_POST["address"];
	$uemail=$_POST["email"];
	$ucity = $_POST['city'];
	$ustate = $_POST['state'];
	$upostal = $_POST['postal'];
	
	$address=$add.",".$ucity.",".$upostal.",".$ustate;
	mysqli_query($connect,"INSERT INTO shipping (user_id,address,recipient_email,recipient_name,recipient_phone) values ('$userid','$address','$uemail','$name','$phone');");

	
	?>
	<script>
		window.location.href="payment(buynow).php?procode=<?php echo $prod_id?>&qty=<?php echo $qty?>";
	</script>
	
	<?php
}


	
mysqli_close($connect);
?>
