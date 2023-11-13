<?php
require 'functions.php';
$produk = query("SELECT * FROM produk");
//tombol cari diklik
if (isset($_POST["cari"])) {
	$produk = cari($_POST["keyword"]);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Admin</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>
	
<?php require_once ("header.php"); ?>
<div class="container">
        </div>
<h2>Daftar Produk</h2>
<table>
<form action="" method="post" align="">
	<input type="text" name="keyword" size="50" autofocus placeholder="Masukkan keyword pencarian..." autocomplete="off">
	<button type="submit" name="cari">Cari</button>
</form>
<br>
<a href="tambah.php">Tambah data produk     ||   </a>
<a href="logout.php">Logout</a>
</table>
<br>
<table border="1" cellpadding="10" cellspacing="0" align="left" id=t01>
<tr>
<th>No.</th>
<th>Aksi</th>
<th>Nama</th>
<th>Harga</th>
<th>Tersedia</th>
<th>Foto</th>
</tr>

<?php $i = 1; ?>
<?php foreach ( $produk as $row) : ?>
<tr>
	<td><?= $i; ?></td>
<td>
	<a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a>
	<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('YAKIN?');">Hapus</a>
</td>
<td><?= $row["nama"]; ?></td>
<td><?= $row["harga"]; ?></td>
<td><?= $row["keterangan"]; ?></td>
<td><img src="gambar/<?= $row["gambar"]; ?>" width="50"></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>
</body>
</html>