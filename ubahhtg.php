<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}
require 'functions.php';
include 'style.css';
$mhs = query("SELECT transaksi.id, transaksi.nama, transaksi.tonase, transaksi.harga, transaksi.bayar, transaksi.tanggal, transaksi.potongan, transaksi.id_pelanggan, hutang.hutang from transaksi inner join hutang where transaksi.id_pelanggan=hutang.id
order by transaksi.id desc LIMIT 1 ");
// ambil data di url
$id = $_GET["id"];
//query data berdasarkan id
$user = query("select * from hutang inner join pelanggan on hutang.id = pelanggan.id_pelanggan where pelanggan.id_pelanggan=$id")[0];



//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])) {
	


	//cek apakah data berhasil diubah atau tidak
	if(ubahhtg($_POST) > 0){
		echo "
		<script>
		alert('Data Berhasil Diubah!');
		document.location.href = 'ubahhtg.php?id=$id';
		</script>
		";

	} else {
		echo "
		<script>
		alert('Hutang Tidak Berubah!');
		document.location.href = 'ubahhtg.php?id=$id';
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

	

<div id="utama2" class="ph">
	<div id="judul" >
		Tambah data transaksi
	</div>

<div id="inputan" >
	<div align="right">
	<button><a href="hutang.php" class="kembali">Kembali</a> </button>
	</div>
<form oninput="kalkulator.value=parseFloat(tonase.value)*parseFloat(harga.value)" action="" method="post">
	<div style="margin-top: 5px">
		<input type="hidden" name="id" value="<?= $user["id_pelanggan"]; ?>">
				<input type="text" name="nama" id="nama" value="<?php echo $user["nama"]; ?>" class="panjang" autocomplete="off" readonly>
     &nbsp&nbsp <input type="number" name="potongan" id="potongan" placeholder="Potongan" class="panjang" autocomplete="off"  > 

		<!-- <div>
	<span style="display:inline-block; width: 270;"></span>	
		<input type="checkbox" name="hutang" value="Hutang"><label>Hutang</label>
	<span style="display:inline-block; width: 20;"></span>
		<input type="checkbox" name="panen" value="& Panen"><label>Upah Panen</label>
	</div> -->
	
</div>
	

<div style="margin-top: 5px">
		<input type="number" name="tonase" id="tonase" placeholder="Tonase" class="panjang" autocomplete="off" required >
		&nbsp&nbsp&nbsp&nbspSisa Bon &nbsp&nbsp<?php echo "Rp. ".number_format($user["hutang"], 0, ".", "."); ?>
		<div style="margin-top: 5px" >
			
			 	
			
			
			</td>
		
	</div>
	
				
</div>
<div style="margin-top: 5px">
	<input type="number" name="harga" id="harga" placeholder="Harga" class="panjang" autocomplete="off" required>
	<!-- &nbsp&nbsp&nbsp&nbspBayar:	<?php echo "Rp. ".number_format($user["hutang"], 0, ".", "."); ?> -->
	&nbsp&nbsp&nbsp&nbspBayar:
	<output name="kalkulator" for="a b"></output>

</div>
	
			
		

<br>

<div style="margin-top: 10px">
	<button type="submit" name="submit">Kirim</button> 
	<!-- <button type="submit" name="cek">Cek</button>  -->
	<form action="" method="post">
	<button type="submit" name="cari2">< + ></button> 
	</form>


</div>
	<a href="" title="Print Page" onclick="myFunction()"><img src="gambar/print2.png" height="30px"  /></a>
</form>

</div>
</div>



<div id="kalimat" align="center"><h2>Dagang Hasil Bumi</h2>
<h1>ARNELLY</h1>
<p>KM 6 No 32. Jl. Lintas Bangko Sungai Manau</p>
<p>|| 085266667054 |*| 081366935500 ||</p>
<p>===============================</p>

</div>

<div id="backtable">	
<table border="1", cellpadding="10", cellspacing="0" align="center" class="a" >

 	<tr>
 		<th>No</th>
 		<th class="a">Aksi</th>
 		<th>Nama</th>
 		<th>Tanggal</th>
 		<th>Berat</th>
 		<th>Harga</th>
 		<th colspan="2">Bayar</th>
 	</tr>

<!-- <?php $i =1; ?> -->
<?php foreach( $mhs as $row) :  ?>
	<tr>
		<!-- <td><?= $i; ?></td> -->
		
		
		<td><?php echo $row["id"]; ?></td>
		<td class="a">
			<a href="ubah_tambah.php?id=<?= $row["id"];?>">Ubah</a> |
			<a href="hapus.php?id= <?=$row["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
		</td>
		<td><?php echo $row["nama"]; ?></td>
		<td><?php echo date('d-m-Y H:i', strtotime($row["tanggal"])) ?></td>
		<td><?php echo $row["tonase"]; ?></td>
		<td><?php echo $row["harga"]; ?></td>
		<td align="right"><?php $bayar_rp = $row["bayar"]; 
					echo "Rp. ".number_format($bayar_rp, 0, ".", "."); ?></td>
	
	</tr>
	<tr>
		<td colspan="6" >
			Jumlah Potongan :  

		</td>
		
		<td align="right" colspan="2" width=""100px ><?php $potongan_rp = $row["potongan"]; 
						echo "Rp. ".number_format($potongan_rp, 0, ".", "."); ?></td>
		
	</tr>
	<tr>
		<td colspan="6" >
			Sisa Bon :  
			
		</td>

		<td align="right" colspan="2"><?php $potongan_rp = $row["hutang"]; 
						echo "Rp. ".number_format($potongan_rp, 0, ".", "."); ?></td>
		
		
	</tr>
	<tr>
		<td colspan="6">
			Total Dibayar
		</td>
		
	
		<td align="right" colspan="2"> 
			<?php $total_rp = $row["bayar"] - $row["potongan"];  
			echo "Rp. ".number_format($total_rp, 0, ".", "."); ?></td>
	</tr>
	
	<?php $i++; ?>
	<?php endforeach; ?>
 </table>
 <!-- <div id="printlogo"><img src="gambar/logo.jpg" height="80"> -->

</div>

</div>
<div class="b">
	<h3 style="text-align: center;">Yth. Bpk/ibu <?php echo $row["nama"]; ?></h3>
	<!-- <p> &nbsp&nbsp&nbsp&nbsp<?php echo $row["tonase"]; ?> * <?php echo $row["harga"]; ?></td></p> -->
	<p style="text-align: left;"><?php echo $row["tonase"]; ?> X <?php echo $row["harga"]; ?><span style="float:right;"><?php $bayar_rp = $row["bayar"]; 
					echo "Rp. ".number_format($bayar_rp, 0, ".", "."); ?></span></p>
	<p style="text-align: left;">Potongan <span style="float:right;"><?php $bayar_rp = $row["potongan"]; 
					echo "Rp. ".number_format($bayar_rp, 0, ".", "."); ?></span></p>
	<p style="text-align: left;">Total <span style="float:right;"><?php $total_rp = $row["bayar"] - $row["potongan"];  
			echo "Rp. ".number_format($total_rp, 0, ".", "."); ?></span></p>
	<p style="text-align: left;">Sisa Bon <span style="float:right;"><?php $potongan_rp = $row["hutang"]; 
						echo "Rp. ".number_format($potongan_rp, 0, ".", "."); ?></span></p>
			<p style="text-align: center;">========|| NoNota <?php echo $row["id"]; ?> ||=======</p>
		  <p>=========<?php echo date('d-m-Y H:i', strtotime($row["tanggal"])) ?>
		     ========</p>

</div>
</body>
</html>