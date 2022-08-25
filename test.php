<?php
$conn = mysqli_connect("localhost","root","","rumah");

$id=1;
$potongan=1;
$tanggal = date("Y-m-d H:i:s", strtotime("+5 hours"));
$sql_potongan = "SELECT * FROM hutang WHERE id = '$id'";
	
	$data = mysqli_fetch_assoc(mysqli_query($conn, $sql_potongan));
	$stok = htmlspecialchars($data["hutang"]);

	$total_stok = $stok - $potongan;
	$sql_pemotong = "UPDATE hutang SET 
	hutang ='$total_stok',
	tanggal = '$tanggal' WHERE id = '$id'";
	mysqli_query($conn, $sql_pemotong);
	return mysqli_affected_rows($conn);

var_dump($sql_potongan);
?>
