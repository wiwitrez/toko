<?php
require  'functions.php';
if(isset($_POST["register"])){
	if(registrasi($_POST) > 0){
		echo "<script>
		alert('user baru berhasil ditambahkan!');
		</script>";
	}else{
		echo mysqli_error($conn);
	}
}

?>




<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>Halaman Registrasi</title>
</head>
<body>

<h1>Halaman Registrasi</h1>

<form action="" class=kotak_login method="post">
	<ul>
		<div>
		<label for="username">username :</label>
		<input type="text" class=form_login name="username" id="username">
		</div>
		<div>
		<label for="password">password :</label>
		<input type="password" class=form_login name="password" id="password">
		</div>
		<div>
		<label for="password2">konfirmasi password :</label>
		<input type="password" class=form_login name="password2" id="password2">
		</div>
		<div>
		<button type="submit" class=tombol_login name="register">
			Register!
		</button>
		</div>
		<br>
		<div>
		Halaman<a href="login.php"> Login</a>
	</div>
	</ul>
</form>
</body>
</html>