<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}

require 'functions.php';
require 'style.css';

//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])) {
	
	//cek apakah data berhasil ditambahkan atau tidak
	if(tambahhtg($_POST) > 0){
		echo "
		<script>
		alert('data berhasil ditambahkan!');
		document.location.href = 'tambahhtg.php';
		</script>
		";

	} else {
		echo "
		<script>
		alert('data gagal ditambahkan!');
		document.location.href = 'tambahhtg.php';
		</script>
		";
	}



}



 ?>

<!DOCTYPE html>
<html>
<head>
	<title  >Nota Penjualan</title>
</head>
<body>


	

	<div id="utama2" class="a">
	<div id="judul" >
		Tambah Data Bon
	</div>

<div id="inputan" >
	<div align="right">
	<button><a href="hutang.php" class="kembali">Kembali</a> </button>
	</div>
<form action="" method="post">
	<div style="margin-top: 5px">

				<input type="text" name="nama" id="nama" placeholder="Nama" class="panjang" autocomplete="off" autofocus="">
     &nbsp&nbsp <input type="text" name="hutang" id="hutang" placeholder="Hutang" class="panjang" autocomplete="off"> 
		<!-- <div>
	<span style="display:inline-block; width: 270;"></span>	
		<input type="checkbox" name="hutang" value="Hutang"><label>Hutang</label>
	<span style="display:inline-block; width: 20;"></span>
		<input type="checkbox" name="panen" value="& Panen"><label>Upah Panen</label>
	</div> -->
	</div>

<br>

<div style="margin-top: 10px">
	<button type="submit" name="submit">Kirim</button> 
	<!-- <button type="submit" name="cek">Cek</button>  -->


</div>
	
</form>

</div>
</div>



<div id="backtable">	





 </div>

</body>
</html>