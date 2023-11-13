<?php 
require 'functions.php';
//langkah 11 ubah bagian input gambar

//koneksi ke DBMS

//ambil data di URL
$id = $_GET["id"];

//query data produk berdasarkan id
$sis = query("SELECT * FROM produk WHERE id = $id")[0];

//cek apakah tombol submit sudah ditekan atau belum
if ( isset($_POST["submit"])) {
	
	//cek apakah data berhasil ditambahkan atau tidak
	if(ubah($_POST) > 0 ){
		echo "
		<script>
		alert('Data Berhasil Diubah!');
		document.location.href = 'index.php';
		</script>
		";
	}else {
		echo "
		<script>
		alert('Data Gagal Diubah!');
		document.location.href = 'index.php';
		</script>
		";
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data produk</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
</head>
<body>
<h1>Ubah Data produk</h1>

<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $sis["id"]; ?>">
	<input type="hidden" name="gambarLama" value="<?= $sis["gambar"]; ?>">
	<ul>
		<li>
			<label for="nama">Nama : </label>
			<input type="text" name="nama" id="nama" value="<?= $sis["nama"]; ?>">
		</li>
		<li>
			<label for="harga">Harga : </label>
			<input type="text" name="harga" id="harga" value="<?= $sis["harga"]; ?>">
		</li>
		<li>
			<label for="keterangan">Keterangan : </label>
			<input type="text" name="keterangan" id="keterangan" value="<?= $sis["keterangan"]; ?>">
		</li>
		<li>
			<label for="gambar">Gambar : </label> <br>
			<img src="gambar/<?= $sis['gambar']; ?>" width="40">  <br>
			<input type="file" name="gambar" id="gambar">
		</li>
		<li>
			<button type="submit" name="submit">Ubah Data!</button>
		</li>


	</ul>

</form>

</body>
</html>