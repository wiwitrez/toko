<?php
require 'functions.php';

if(isset($_POST["login"])){

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	//cek username
	if(mysqli_num_rows($result) === 1){

		//cek password
		$row = mysqli_fetch_assoc($result);
		if(password_verify($password, $row["password"])){
			header("Location: index.php");
			exit;
		}
	}

			$error = true;
}

?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>Halaman Login</title>
</head>
<body>

<h1>Halaman Login</h1>

<?php if(isset($error)): ?>

<p style="color: red;font-style: italic;">username atau password Anda salah!</p>

<?php endif; ?>


<form class=kotak_login action="" method="post">
	<ul>
		<div>
			<label for="username">Username :</label>
			<input type="text" class=form_login name="username" id="username">
		</div>
		<div>
			<label for="password">Password :</label>
			<input type="password" class=form_login name="password" id="password">
		</div>
		<div>
			<button type="submit" class=tombol_login name="login">Login</button>
		</div>
	</ul>
	<ul>
		Sudah punya akun? Jika belum silahkan<a href="registrasi.php"> Registrasi</a>
	</ul>
</form>

</body>
</html>