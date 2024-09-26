<?php include("dataconnection.php"); 
session_start();


?>

<html>
<head>
</head>
<style>
    .cc-img {height: 200px;
			width: 500px;
			padding:10px;}
	
	h1{color:grey;
		font-style:italic;
		}
	
	.label{font-weight:bold;
			text-shadow:1px 2px grey;
			padding:10px;}
			
  .card_input{padding:10px;
				text-align:center;
				width:35%;
				font-size:17px;}
	
	.input-group{padding:10px;}
	
	.cv{margin-left:280px;
		margin-top:-85px;}
		
	.input{padding:10px;
			text-align:center;
			width:240px;
			font-size:17px;}
			
	input{border:1px solid #2B1B17;
			box-shadow:1px 2px 1px 2px grey;
			border-radius:5px;}
	
	.submit_btn{padding:10px;
					box-shadow:2px 2px powerblue;
					cursor:grabbing;
					margin:10px;
					margin-left:340px;
					margin-top:19px;
					letter-spacing:3px;
					color:#151B54;}	
					
	.submit_btn:hover{font-weight:bold;
						font-size:15px;
						text-shadow:2px 1px grey;
						background-color:#FFE6E8;}
						
			
table {
  margin-top:-570px;
  margin-right:50px;
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
				padding-left:5px;
				font-style:italic;}

.p_qty{font-weight:bold;
		}

.p_subtotal{font-weight:bold;
			color:black;}

.subtotal,.shipping{letter-spacing:2px;}

.total{letter-spacing:4px;}
</style>
<body>
<?php if(isset($_SESSION['id']))
	{
		$user=$_SESSION['id'];
		$result=mysqli_query($connect,"SELECT * FROM user where user_id='$user'");
			
		$row=mysqli_fetch_assoc($result);
			
	}
	?>



	<h1 class="text">
		<a>PAYMENT DETAILS</a>
	</h1>
	
	<img class="img-responsive cc-img" src="https://www.nicepng.com/png/full/54-542683_credit-card-pay-now-visa-and-mastercard-accepted.png">

<form name="payment_form">	
      
     <label class="label">CARD NUMBER</label>
        <div  class="input-group">
   <input type="tel" name="card" id="card" class="card_input" maxlength="19" minlength="19" placeholder="xxxx xxxx xxxx xxxx"  autocomplete="off" required/>
  </div>
 
 <script>
   document.querySelector('#card').addEventListener('keydown', (e) => {
   e.target.value = e.target.value.replace(/(\d{4})(\d+)/g, '$1 $2')
  })
  /* Jquery */
  $('#card').keyup(function() {
    $(this).val($(this).val().replace(/(\d{4})(\d+)/g, '$1 $2'))
  });
 </script>
 
  <label class="label">CARD OWNER</label>
   <div class="input-group">
    <input type="text" name="cname" class="card_input" placeholder="Kong Zi Yin" pattern="[a-zA-Z]{1,30}" title="Character only" autocomplete="off" required>
   </div>       
   
  <label class="label">EXPIRATION DATE</label>
  <div class="input-group">
   <input type="month" class="input" name="exp" min="2022-01" placeholder="MM / YY" required/>
  </div>
 <div class="cv">  
  <label class="label">CVV CODE</label>
   <div class="input-group">
    <input type="tel" name="cv" class="input" placeholder="xxx" minlength="3" maxlength="3" autocomplete="off" pattern="[0-9]{3}" title="Three Number CVV Code" required/>
   </div>                  
 </div>

 <input type="submit" name="btn" class="submit_btn" value="SUBMIT PAYMENT">
 </form>
 
            	<table border="1" width="800px">
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
				<th colspan="10" align="right" class="subtotal">SUBTOTAL : RM <?php echo number_format($total, 2, '.', '');?>
			</tr>
				
			<tr>
				<th colspan="10" align="right" class="shipping">SHIPPING : FREE</th>
			</tr>
				
				<tr>
					
					<th colspan="10" align="right" class="total"><hr><br>	TOTAL: <span style="font-size:25px;">MYR <?php echo number_format($total, 2, '.', '');?></span>
					</tr>
		
			
</body>
</html>
<?php

if(isset($_SESSION['id']))
{
	$id=($_SESSION["id"]);

	
}


if (isset($_GET['btn']))
{
	
	$result=mysqli_query($connect,"SELECT MAX(shipping_id) from shipping;");
	while($row = mysqli_fetch_assoc($result)){
	   print_r($row);
	   $sid=$row['MAX(shipping_id)'];
	}
	
	//get card info
	$card=($_GET['card']);
	$exp=($_GET['exp']);
	$cv=($_GET['cv']);
	$name=($_GET['cname']);
	
	mysqli_query($connect,"INSERT INTO payment (credit_card_no,credit_card_expired,credit_card_cvv,credit_card_name,user_id,shipping_id) values ('$card','$exp','$cv','$name','$id','$sid');");
	
	?>
	
	<script>
		alert("Your payment made successfully.");
		window.location.href="updatepurchase(buynow).php?sid=<?php echo $sid ?>&id=<?php echo $id ?>";
	</script>
	
	
	<?php
	
	
	

}


?>
