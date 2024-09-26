<?php
session_start();
include ("dataconnection.php");
$error = "";

if(isset($_GET["log_user"]))
{
	if(empty($_GET["email"])|| empty($_GET["password"]))
	{
		$error="Email or password is empty";
	}
	else
	{
		$email = $_GET["email"];
		$password = $_GET["password"];
		
		$email= mysqli_real_escape_string($connect, $email);
		$password= mysqli_real_escape_string($connect, $password);
		//escape those special characters
		
		$result=mysqli_query($connect, 
		"SELECT * FROM user WHERE user_email='$email' 
		AND user_pass='$password'");
		
		$count=mysqli_num_rows($result);
		
		if($count==1)
		{
			$row=mysqli_fetch_assoc($result);
			$_SESSION["id"]=$row["user_id"]; //created session variable.
			header("location: profile.php");
		}
		else
		{
			?>
			<script>
			alert("Incorrect email and password.");
			</script>
			<?php
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>52Hz | Login</title>
  <link rel="icon" type="image/png" sizes="80x80" href="favicon/52Hz_logo.ico">
  <link
	rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
<style>
body{
	margin:0;
	color:#6a6f8c;
	background:#E1E8EE;
	font:600 16px/18px 'Open Sans',sans-serif;
	margin-top:50px;
}
*,:after,:before{box-sizing:border-box}
.clearfix:after,.clearfix:before{content:'';display:table}
.clearfix:after{clear:both;display:block}
a{color:inherit;text-decoration:none}

.login-wrap{
	width:100%;
	margin:auto;
	max-width:525px;
	min-height:660px;
	position:relative;
	box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
}
.login-html{
	width:100%;
	height:100%;
	position:absolute;
	padding:55px 70px 50px 70px;
}
.login-html .sign-in-htm,
.login-html .sign-up-htm{
	top:0;
	left:0;
	right:0;
	bottom:0;
	position:absolute;
	transform:rotateY(180deg);
	backface-visibility:hidden;
	transition:all .4s linear;
}
.login-html .sign-in,
.login-html .sign-up,
.login-form .group .check{
	display:none;
}
.login-html .tab,
.login-form .group .label,
.login-form .group .button{
	text-transform:uppercase;
}
.login-html .tab{
	font-size:22px;
	margin-right:15px;
	padding-bottom:5px;
	margin:0 15px 10px 0;
	display:inline-block;
	border-bottom:2px solid transparent;
}
.login-html .sign-in:checked + .tab,
.login-html .sign-up:checked + .tab{
	color:#fff;
	border-color:#1161ee;
}
.login-form{
	min-height:345px;
	position:relative;
	perspective:1000px;
	transform-style:preserve-3d;
}
.login-form .group{
	margin-bottom:15px;
}
.login-form .group .label,
.login-form .group .input,
.login-form .group .button{
	width:100%;
	color:#fff;
	font-weight:bold;
	font-style:italic;
	letter-spacing:2px;
	display:block;
}
.login-form .group .input,
.login-form .group .button{
	border:none;
	padding:15px 20px;
	border-radius:25px;
	background:#6B8888;
	box-shadow:2px 2px #C0D1D1;
}
.login-form .group input[data-type="password"]{
	text-security:circle;
	-webkit-text-security:circle;
}
.login-form .group .label{
	color:black;
	text-shadow:1px 2px #aaa;
	font-size:12px;
}
.login-form .group .button{
	background:#1161ee;
}
.login-form .group label .icon{
	width:15px;
	height:15px;
	border-radius:2px;
	position:relative;
	display:inline-block;
	background:rgba(255,255,255,.1);
}
.login-form .group label .icon:before,
.login-form .group label .icon:after{
	content:'';
	width:10px;
	height:2px;
	background:#fff;
	position:absolute;
	transition:all .2s ease-in-out 0s;
}
.login-form .group label .icon:before{
	left:3px;
	width:5px;
	bottom:6px;
	transform:scale(0) rotate(0);
}
.login-form .group label .icon:after{
	top:6px;
	right:0;
	transform:scale(0) rotate(0);
}
.login-form .group .check:checked + label{
	color:#fff;
}
.login-form .group .check:checked + label .icon{
	background:#1161ee;
}
.login-form .group .check:checked + label .icon:before{
	transform:scale(1) rotate(45deg);
}
.login-form .group .check:checked + label .icon:after{
	transform:scale(1) rotate(-45deg);
}
.login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
	transform:rotate(0);
}
.login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
	transform:rotate(0);
}

.hr{
	height:2px;
	margin:60px 0 50px 0;
	background:rgba(255,255,255,.2);
}
.foot-lnk{
	margin-top:-30px;
	text-align:center;
	letter-spacing:1px;
}

.foot-lnk:hover{letter-spacing:3px;
				color:#0E6262;
				font-style:italic;}

.sub_button{background:#286969;
				border:none;
				padding:15px 20px;
				border-radius:25px;
				width:100%;
				color:white;
				font-weight:bold;
				font-style:italic;
				letter-spacing:2px;}
				
.sub_button:hover{background:#A4C6C6;
					color:#044B4B;}
</style>
<script>
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</head>
<body>
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab" style="color:#597B7B;">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
		<div class="login-form">
		<form method="get" name="logform">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" style="padding-top:20px;" class="label">Email</label>
					<input id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninvalid="this.setCustomValidity('Email format is not correct. Example: xxx@mail.com')" oninput="this.setCustomValidity('')"  name="email" type="text" class="input" autocomplete="off">
					<span class="design_error" id="email_error" name="email_error"></span>
				</div>
				<div class="group">
					<label for="pass" style="padding-top:20px;" class="label">Password</label>
					<input id="pass" name="password" type="password" class="input" autocomplete="off">
					<br>
					<br>
					<input type="checkbox" onclick="myFunction()">Show Password
					<span class="design_error" id="pass_error" name="pass_error"></span>
				<br>
				<br>
				<br>
				<br>
				<div class="group">
					<input type="submit" name="log_user" onMouseOver="this.style.cursor='pointer'" class="sub_button" onclick="loginvalidation();" value="Log In">
				</div>
				<div style="text-align:center; margin-top:80px; color:#F5B041;"><p>Didn't Have An Account? </p></div>
				<div class="hr" style="margin-top:20px;"></div>
				<div class="foot-lnk">
					<a type="submit" name="back_res" style="text-align:center;" href="Registration.php">Create Accout</a>
				</div>
				<br>
				<br>
				<br>
				<div class="foot-lnk">
					<a type="submit" name="go_forgetpass" style="text-align:center;" href="forgetpass.php">Forget Password</a>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>
</div>
<!-- partial -->
  <script  src="./script.js"></script>
</form>
</body>
</html>