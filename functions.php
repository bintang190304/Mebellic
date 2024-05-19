<?php

$koneksi = mysqli_connect("localhost", "root", "", "mebellic");




function registrasi($data)
{
	global $koneksi;

	$email = strtolower(stripcslashes($data['email']));
	$username = strtolower(stripcslashes($data['username']));
	$no_telp = strtolower(stripcslashes($data['no_telp']));
	$password = mysqli_real_escape_string($koneksi, $data['password']);
	$password2 = mysqli_real_escape_string($koneksi, $data['password2']);

	// cek username yang sudah ada
	$result = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
					alert ('username already available');
				</script> ";
		return false;
	}

	// cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
					alert ('passwords are not the same');
				</script> ";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	

	// menambah akun ke database
	// untuk '' di awal dan akhir untuk mendefinisikan baris id sama gambar agar tidak eror
	mysqli_query($koneksi, "INSERT INTO users VALUES('','$email', '$username', '', '$no_telp', '$password', '')");

	return mysqli_affected_rows($koneksi);
}



