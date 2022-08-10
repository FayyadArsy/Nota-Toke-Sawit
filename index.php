<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}

require 'functions.php';
include 'style.css';
$jumlahhalaman = 7;
$today= date('y-m-d');
$halamanaktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$today2= date('y-m-d', strtotime("-$halamanaktif day"));
 	$mhs = query("SELECT * FROM transaksi WHERE tanggal between '$today2' and '$today 23:59:59' ORDER BY id DESC"); 

	
//tombol cari ditekana
if (isset($_POST["cari"])) {
	$mhs = cari($_POST["keyword"]);
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
		Daftar Transaksi
	</div>
<div id="inputan">

	<div align="right">
<button><a href="logout.php" class="logout" >LogOut</a></button>
	</div>
<form action="" method="post">
	<input type="text" name="keyword" size="25" autofocus placeholder="Masukkan Nama" autocomplete="off">
	<button type="submit" name="cari">Cari!</button>


</form>
<div>
	<button> <a href="tambah.php">Tambah Transaksi</a></button>
	<button> <a href="hutang.php">Daftar Bon</a></button>
</div>

<!-- navigasi -->
<div align="center" >
	<h2>Data Hari Ini</h2> 
<?php if($halamanaktif > 1) : ?>

<a href="?halaman=<?= $halamanaktif -1; ?>"style="font-size: 20px;">&laquo;</a>
<?php endif; ?>

<?php for($i = 1; $i <= $jumlahhalaman; $i++) : ?>
	<?php if( $i == $halamanaktif) : ?>
		
		<a href="?halaman=<?= $i; ?>" style="font-weight: bold;font-size:20px; color: red;"><?= $i; ?></a>
	<?php else : ?>
		<a href="?halaman=<?= $i; ?>"style="font-size: 20px;"><?= $i; ?></a>
	<?php endif; ?>
<?php endfor; ?>

<?php if($halamanaktif < $jumlahhalaman) : ?>
<a href="?halaman=<?= $halamanaktif +1; ?>"style="font-size: 20px;">&raquo;</a>
<?php endif; ?>
</div>
<br>
 <table border="1", cellpadding="10", cellspacing="0" align="center">
 	<tr>
 		<th>No</th>
 		<th>aksi</th>
 		<th>Nama</th>
 		<th>Tonase</th>
 		<th>Harga</th>
 		<th>Total</th>
 		<th>Potongan</th>
 		<th>Bayar</th>
 		<th>Tanggal</th>
 		
 	</tr>

<?php $i =1; ?>
<?php foreach( $mhs as $row) : ?>
	<tr>
		<td><?= $i; ?></td>
		<td>
			<a href="ubah.php?id=<?= $row["id"];?>">Ubah</a> |
			<a href="hapus.php?id= <?=$row["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
		</td>
		
		<td><?php echo $row["nama"]; ?></td>
		<td><?php echo $row["tonase"]; ?></td>
		<td><?php echo $row["harga"]; ?></td>
		<td><?php echo $row["bayar"]; ?></td>
		<td><?php echo $row["potongan"]; ?></td>
		<td><?php echo $row["bayar"] - $row["potongan"]; ?></td>
		<td><?php echo $row["tanggal"]; ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
<!-- 	<div class="footer">
			&copy; 2020 Copyright
		</div> -->
 </table>
 </body>
 </html>