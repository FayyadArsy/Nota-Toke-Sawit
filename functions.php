<?php 
$conn = mysqli_connect("localhost","root","","rumah");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function  tambah($data){
	global $conn;
// ambil data dari tiap elemen dalam form
	$nama = htmlspecialchars($data["nama"]);
	$tonase = htmlspecialchars($data["tonase"]);
	$harga = htmlspecialchars($data["harga"]);
	$potongan = htmlspecialchars($data["potongan"]);
	// $hutang = htmlspecialchars($data["hutang"]);
	// $panen = htmlspecialchars($data["panen"]);
	$tanggal = date("Y-m-d H:i:s", strtotime("+5 hours"));
	$bayar = $tonase * $harga;
	//query insert data
	$query = "INSERT INTO transaksi
				VALUES 
				('','$nama','$tonase','$harga','$bayar','$tanggal','$potongan','')
				";
	mysqli_query($conn, $query);





	
//Dipakai kalau perlu

	// $sql_potongan = "SELECT * FROM hutang WHERE nama = '$nama'";
	
	// $data = mysqli_fetch_assoc(mysqli_query($conn, $sql_potongan));
	// $stok = $data["hutang"];

	// $total_stok = $stok - $potongan;
	// $sql_pemotong = "UPDATE hutang SET hutang ='$total_stok' WHERE nama = '$nama'";
	// mysqli_query($conn, $sql_pemotong);
	return mysqli_affected_rows($conn);
 

}
function  tambahhtg($data){
	global $conn;
// ambil data dari tiap elemen dalam form
	$nama = htmlspecialchars($data["nama"]);
	$hutang = htmlspecialchars($data["hutang"]);
	
	// $hutang = htmlspecialchars($data["hutang"]);
	// $panen = htmlspecialchars($data["panen"]);
	$tanggal = date("Y-m-d");
	
	//query insert data
	$query = "INSERT INTO hutang
				VALUES 
				('','$hutang','$tanggal')
				";
	mysqli_query($conn, $query);

	$query2 = "INSERT INTO pelanggan
				VALUES 
				('','$nama','','')
				";
	mysqli_query($conn, $query2);
	return mysqli_affected_rows($conn);
	}

function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM transaksi WHERE id = $id");
	return mysqli_affected_rows($conn);
}
function hapushtg($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM hutang && pelanggan WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function ubah($data) {
	global $conn;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$tonase = htmlspecialchars($data["tonase"]);
	$harga = htmlspecialchars($data["harga"]);
	$potongan = htmlspecialchars($data["potongan"]);
	$bayar = $tonase * $harga;

	//query insert data
	$query = "UPDATE transaksi SET 
				nama = '$nama',
				tonase = '$tonase',
				harga = '$harga',
				bayar = '$bayar',
				potongan = '$potongan'
				WHERE id = $id
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahhtg($data) {
	global $conn;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$tonase = htmlspecialchars($data["tonase"]);
	$harga = htmlspecialchars($data["harga"]);
	$potongan = htmlspecialchars($data["potongan"]);
	// $hutang = htmlspecialchars($data["hutang"]);
	// $panen = htmlspecialchars($data["panen"]);
	$tanggal = date("Y-m-d H:i:s", strtotime("+5 hours"));
	$bayar = $tonase * $harga;
	$id_pelanggan = $_GET["id"];

	//query insert data
	$query = "INSERT INTO transaksi
				VALUES 
				('','$nama','$tonase','$harga','$bayar','$tanggal','$potongan','$id_pelanggan')
				";
	mysqli_query($conn, $query);

	$sql_potongan = "SELECT * FROM hutang WHERE id = '$id'";
	$potongan = empty($potongan) ? 0 : $potongan;
	$data = mysqli_fetch_assoc(mysqli_query($conn, $sql_potongan));
	$stok = htmlspecialchars($data["hutang"]);
	$total_stok = $stok - $potongan;
	$sql_pemotong = "UPDATE hutang SET 
	hutang ='$total_stok',
	tanggal = '$tanggal' WHERE id = '$id'";
	mysqli_query($conn, $sql_pemotong);
	return mysqli_affected_rows($conn);
 

}


function cari($keyword){
	$query = "SELECT * FROM transaksi
				WHERE
				nama LIKE '%$keyword%' 
				 ORDER BY tanggal DESC
				
				";
	return query($query);
}
function cariplg($keyword){
	$query = "SELECT * FROM pelanggan
				WHERE
				nama LIKE '%$keyword%' 
				";
	return query($query);
}



function registrasi($data){
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	
//cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM akun WHERE username = '$username'");
	if(mysqli_fetch_assoc($result)) {
		echo"<script>
		alert('username sudah terdaftar!');
		</script>";
		return false;
	}

	//cek konfirmasi password
	if ( $password !== $password2) {
		echo "<script>
			alert('konfirmasi password tidak sesuai!');
			</script>";
		return false;
	}
	//encripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

// tambahkan userbari ke database
	mysqli_query($conn, "INSERT INTO akun VALUES('','$username','$password')");

	return mysqli_affected_rows($conn);
} 



 ?>

<script>
function myFunction() {
    window.print();
}
</script>

