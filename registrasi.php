<?php 
require 'functions.php';
require 'style.css';
if(isset($_POST["register"])){
	if(registrasi($_POST) >0 ) {
		echo "<script>
		alert('user baru berhasil ditambahkan!');
		</script>";
	} else {
		echo mysqli_error($conn);
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<style>
		label {
			display: block;
		}
	</style>
</head>
<body>
<div id="utama">
	<div id="judul">
		Halaman Registrasi
	</div>
<div id="inputan">
<form action="" method="post">
	<div>
		<input type="text" name="username" id="username" placeholder="Username" class="panjang" required autocomplete="off">
	</div>
	<div style="margin-top: 5px">
		<input type="password" name="password" id="password" placeholder="Password" class="panjang">
	</div>
	<div style="margin-top: 5px">
		<input type="password" name="password2" id="password2" placeholder="Ulangi Password" class="panjang">
	</div>
	
	<div style="margin-top: 5px">
		<input type="submit" name="register" value="Registrasi" class="btn">
		<div style="margin-top: 5px">
		<a href="login.php"   class="button">Login</a>
			
</div>
			

			
	</div>
	</form>
</div>
</div>
<div class="footer">
			&copy; 2020 Copyright
		</div>




</body>
</html>