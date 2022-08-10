<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}
require 'functions.php';
include 'style.css';

// ambil data di url
$id = $_GET["id"];
//query data berdasarkan id
$user = query("SELECT * FROM hutang WHERE id = $id")[0];


//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])) {
	


	//cek apakah data berhasil diubah atau tidak
	if(ubahhtg($_POST) > 0){
		echo "
		<script>
		alert('data berhasil diubah!');
		document.location.href = 'hutang.php';
		</script>
		";

	} else {
		echo "
		<script>
		alert('data gagal diubah!');
		document.location.href = 'hutang.php';
		</script>
		";
	}



}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data</title>
</head>
<body>
	<div id="utama_ubah">
	<div id="judul">
		Ubah Data
	</div>
<div id="inputan">


<form action="" method="post">
	<input type="hidden" name="id" value="<?= $user["id"]; ?>">
	<table border="0" align="center">
		<tr>
			<td width="6">
				<div>
		
			<label for="nama">Nama </label>
				</div>
			</td>
			<td>:</td>
			<td>
			<input type="text" name="nama" id="nama" autocomplete="off"  value="<?= $user["nama"]; ?>">
				
			</td>

		</tr>
		<tr>
			<td>
				<div style="margin-top: 5px">
		
			<label for="hutang">Hutang </label>
			</div>	
			</td>
			<td>:</td>
			<td>
				
			<input type="text" name="hutang" id="hutang" autocomplete="off" required value="<?= $user["hutang"]; ?>">
			</td>
		</tr>
		
			<td>
				<div style="margin-top: 5px">
</div>
			</td>
			
			
		</tr>
		<tr >
			<td align="center" colspan="3">
				<div style="margin-top: 5px">
			
			<button type="submit" name="submit">Ubah Data</button>
		</div>
			</td>
		</tr>

	
	
		
	

		
		

		
		
	

</form>
</div>
</div>
<div class="footer">
			&copy; 2020 Copyright
		</div>
</table>
</body>
</html>