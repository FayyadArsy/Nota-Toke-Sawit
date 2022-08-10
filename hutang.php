<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}

require 'functions.php';
include 'style.css';

$plg = query("SELECT * FROM pelanggan ORDER BY nama ASC"); 

//tombol cari ditekana
if (isset($_POST["cari"])) {
	$plg = cariplg($_POST["keyword"]);
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Fayyad Agro</title>
 	<style>
 		.loader {
 			width: 100px;
 			position: absolute;
 			top: 118px;
 			left: 210px;
 			z-index: -1;
 			display: none;
 		}
 		@media print {
 			.logout {
 				display: none;
 			}
 		}
 	</style>
 </head>
 <body>



<br><br>

<div id="utama_index">
	<div id="judul">
		Daftar Hutang
	</div>
<div id="inputan">

	<div align="right">
<button><a href="index.php" class="logout" >Kembali</a></button>
	</div>
<form action="" method="post">
	<input type="text" name="keyword" size="25" autofocus placeholder="Masukkan Nama" autocomplete="off">
	<button type="submit" name="cari">Cari!</button>


</form>
<div>
	<button> <a href="tambahhtg.php">Tambah Data</a></button>
</div>
<br><br>
<!-- navigasi -->

<br>
 <table border="1", cellpadding="10", cellspacing="0" align="center">
 	<tr>
 		<th>No</th>
 		<th>Aksi</th>
 		<th>Nama</th>


 		
 	</tr>

<?php $i =1; ?>
<?php foreach( $plg as $row) : ?>
	<tr>
		<td><?= $i; ?></td>
		<td>
			<a href="ubahhtg.php?id=<?=$row["id_pelanggan"];?>">Ubah</a> |
			<a href="#" onclick="return confirm('yakin?');">Hapus</a>
			<!-- hapushtg.php?id=<?=$row["id_pelanggan"];?> -->
		</td>
		
		<td><?php echo $row["nama"]; ?></td>
	

	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
<!-- 	<div class="footer">
			&copy; 2020 Copyright
		</div> -->
 </table>
 </body>
 </html>