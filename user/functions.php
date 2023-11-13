<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "toko");


function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data){
	//ambil data dari tiap elemen dalam form
	global $conn;
	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);
	$keterangan = htmlspecialchars($data["keterangan"]);

	//langkah ke 3 hapus $gambar
//upload gambar
	$gambar = upload();
	if(!$gambar){
		return false;
	}
	
	//query insert data
	$query = "INSERT INTO produk
		VALUES
	('', '$nama', '$harga', '$keterangan', '$gambar')
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

//langkah ke 4
function upload(){

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	//langkah ke 5 cek apakah tdk ada gambar yang di upload dan kasih pesan kesalahan
	if($error === 4){
		echo "<script>
		alert('Silahkan pilih gambar dulu!');
		</script>";
		return false;
	}

	//langkah 6 cek yangdiupload pasti adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.',$namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "<script>
		alert('Yang Anda upload bukan gambar!');
		</script>";
		return false;
	}

	//langkah 7 cek jika ukuran gambar terlalu besar
	if($ukuranFile > 1000000){
		echo "<script>
		alert('Ukuran file yang Anda upload terlalu besar!');
		</script>";
		return false;
	}
	//langkah 9 generate nama file baru agar tidak merubah file orang lain yang sudah ada dalam data/folder
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	//langkah 8 jika lolos 3 pengecekan di atas, tinggal pindahkan data tsb
	//langkah 10 ubah code ini menjadi move_uploaded_file($tmpName, 'gambar/' . $namaFile);
	move_uploaded_file($tmpName, 'gambar/' . $namaFileBaru);
	return $namaFileBaru;


}

function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM produk WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function ubah($data){
	global $conn;
	$id=$data["id"];
	$harga = htmlspecialchars($data["nama"]);
	$nama = htmlspecialchars($data["harga"]);
	$keterangan = htmlspecialchars($data["keterangan"]);
	//langkah 11 adalah ubah code ini
	//$gambar = htmlspecialchars($data["gambar"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	//langkah 12 cek apakah user pilih gambarbaru/tidak
	if($_FILES['gambar']['error'] === 4){
		$gambar = $gambarLama;
	}else{
		$gambar = upload();
	}

	//query insert data
	$query = "UPDATE produk SET
		nama = '$nama',
		harga = '$harga',
		keterangan = '$keterangan',
		gambar = '$gambar'
		WHERE id = $id
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function cari($keyword){
	$query = "SELECT * FROM produk
	WHERE
	nama LIKE '%$keyword%' OR 
	harga LIKE '%$keyword%' OR
	keterangan LIKE '%$keyword%' 
	";
	return query($query);
}


function registrasi($data){
	global $conn;

	$username =  strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

//LANGKAH KE 2 setelah bisa tambah ke database. cek username sudah ada atau belum
	$result = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");
	if(mysqli_fetch_assoc($result)) {
		echo "<script>
		alert('username sudah terdaftar!')
		</script>";
		return false;
	}


	//cek konfirmasi password
	if($password !== $password2){
		echo "<script>
		alert  ('konfirmasi password tidak sesuai!');
		</script>";
		return false;
	}
	//enkripsi dulu passwordnya pakai hash
	$password = password_hash($password, PASSWORD_DEFAULT);

	//tambahkan user baru kedatabase
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
	return mysqli_affected_rows($conn);

}


?>