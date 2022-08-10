<?php  
session_start();
require 'functions.php';
include 'style.css';
//cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	//ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM akun WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	//cek cookie dan username
	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
	}



if(isset($_SESSION["login"])){
	header("Location: index.php");
}


if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username'");

//cek username
	if(mysqli_num_rows($result) === 1 ) {
		//cek password
		 $row = mysqli_fetch_assoc($result);
		if(password_verify($password, $row["password"])){

			//set session
			$_SESSION["login"] = true;

			//cek remember me
			if (isset($_POST['remember'])) {
				//buat cookie
				setcookie('id',$row['id'], time()+600000);
				setcookie('key',hash('sha256', $row['username']), time()+600000);
			}


		header("Location: index.php");
			exit;
		}
	}
	$error = true;

}

?>
<div class="bg">

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
	
</head>
<body>
	
<div id="utama">
	<div id="judul">
		Halaman Login
	</div>
<div id="inputan">
<form action="" method="post">
	<div>
		<input type="text" name="username" id="username" placeholder="Username" class="panjang" required autocomplete="off">
	</div>
	<div style="margin-top: 5px">
		<input type="password" name="password" id="password" placeholder="Password" class="panjang">
	</div>
	<div>
		<input type="checkbox" name="remember" id="remember">
			<label for="remember">Remember :</label>
			<?php 
	if(isset($error)) : ?>
		<p style="color: red; font-style: italic;">Username/password salah</p>
	<?php endif; ?>
	</div>
	<div>
		<input type="submit" name="login" value="Login" class="btn">
	</div>
	</form>
</div>
</div>
	</div>
	<div class="footer">
			&copy; 2020 Copyright
		</div>







</body>
</html>