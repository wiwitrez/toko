<!DOCTYPE html>
<title>Halaman User</title>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
require 'connect.php';
require 'functions.php';

//List produk dari database
$sql = 'SELECT * FROM produk';
$result = mysqli_query($con, $sql);
 //tombol cari diklik
if (isset($_POST["cari"])) {
	$sql = cari($_POST["keyword"]);
}

?>
<center><h2> Pilihan Barang </h2>
	<a href="logout.php">Logout</a>
	<form action="" method="post" align="">
	<input type="text" name="keyword" size="20" autofocus placeholder="Masukkan keyword pencarian..." autocomplete="off">
	<button type="submit" name="cari">Cari</button>
</form><br>
 <table id="t01">
 <tr>
 	<th>Gambar</th>
 	<th>Nama</th>
 	<th>Harga</th>
 	<th>Tersedia</th>
 	<th>Beli</th>
 </tr>
 	<?php while($produk = mysqli_fetch_object($result)) { ?> 
	<tr>
		<td><img src="gambar/<?php echo $produk->gambar;?>" width="50"></td>
		<td> <?php echo $produk->nama; ?> </td>
		<td> Rp.<?php echo $produk->harga; ?> </td>
		<td> <?php echo $produk->keterangan; ?> </td>
		<td> <a href="cart.php?id= <?php echo $produk->id; ?> &action=add">Order Now</a> </td>
	</tr>
	<?php } ?>
 </table>
</body>

 </html>