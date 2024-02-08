<?php
include("conn.php");

session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>register</title>
	<link rel="stylesheet" href="stye/register.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lemon&display=swap" rel="stylesheet">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style>

	</style>
</head>

<body>
	<nav>
		<div class="tex_logo">
			<h1>BEBBOO</h1>
		</div>
	</nav>
	<div class="container">
		<header>SIGN UP </header>
		<?php if (isset($_SESSION['ERROR_RE'])) { ?>
			<h3 class="error_text">
				<?php echo $_SESSION['ERROR_RE'];
				unset($_SESSION['ERROR_RE']);
				?>
			</h3>
		<?php }
		?>
		
		<?php if (isset($_SESSION['confirm_pass'])) { ?>
			<h3 class="confirmpass">
				<?php echo $_SESSION['confirm_pass'];
				unset($_SESSION['confirm_pass']);
				?>
			</h3>
		<?php }
		?>
		<div class="wrapper">
			<form action="register_proccess.php" method="post" enctype="multipart/form-data">
				<div class="Input_box">
					<input name="username" type="text" placeholder="Username">
					<i class='bx bx-user' style='color:rgba(0,0,0,0.7)'></i>
				</div>
				<div class="Input_box">
					<input name="email" type="email" placeholder="Email">
					<i class='bx bx-envelope' style='color:rgba(0,0,0,0.7)'></i>
				</div>
				<div class="Input_box">
					<input name="password" type="password" placeholder="Password">
					<i class='bx bx-lock-alt' style='color:rgba(0,0,0,0.7)'></i>
				</div>
				<div class="Input_box">
					<input name="con-password" type="password" placeholder="Confirm Password">
					<i class='bx bx-lock-alt' style='color:rgba(0,0,0,0.7)'></i>
				</div>
				<div class="Input_box">
					<input name="pin" type="password" placeholder="Yourpin" maxlength="5">
					<i class='bx bx-user-pin' style='color:rgba(0,0,0,0.7)'></i>
				</div>

				<div class="Input_box">
					<input name="tel" type="tel" placeholder="Tel" maxlength="10">
					<i class='bx bx-mobile-alt' style='color:rgba(0,0,0,0.7)'></i>
				</div>
				<div class="avatar">
					<p>Upload profile</p>
					<input type="file" name="file_img" />
				</div>
				<button class="buttot_sum" type="submit"> Sign up</button>
			</form>
			<div class="comback">
				<a href="login.php">Login</a>
			</div>
		</div>
	</div>
</body>

</html>