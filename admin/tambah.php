<?php 
require 'functions.php';
//langkah 1 ubah text jadi file pada input gambar
//langkah ke 2 tambahkan enctype

//koneksi ke DBMS
//cek apakah tombol submit sudah ditekan atau belum
if ( isset($_POST["submit"])) {


	//cek apakah data berhasil ditambahkan atau tidak
	if(tambah($_POST) > 0 ){
		echo "
		<script>
		alert('Data Berhasil Ditambahkan!');
		document.location.href = 'index.php';
		</script>
		";
	}else {
		echo "
		<script>
		alert('Data Gagal Ditambahkan!');
		document.location.href = 'index.php';
		</script>
		";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
</head>
<body>
<h1>Tambah Data</h1>

<form action="" method="post" enctype="multipart/form-data">
	<ul>
		<li>
			<label for="nama">Nama : </label>
			<input type="text" name="nama" id="nama">
		</li>
		<li>
			<label for="harga">Harga : </label>
			<input type="number" name="harga" id="harga" required>
		</li>
		<li>
			<label for="keterangan">Keterangan : </label>
			<input type="text-area" name="keterangan" id="keterangan">
		</li>
		<li>			
			<label for="gambar">Gambar : </label>
			<input type="file" name="gambar" id="gambar">
		</li>
		<li>
			<button type="submit" name="submit">Tambah Data!</button>
		</li>


	</ul>

</form>

</body>
</html>