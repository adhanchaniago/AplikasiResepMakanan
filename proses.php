<?php
include ('inc/koneksi.php');
error_reporting(0);
session_start();

if (isset($_POST['submit'])) {
	if (empty($_POST['user']) AND empty($_POST['password'])) {
		echo "Form Tidak Boleh Kosong";
	}
	else {
		
		$user = $_POST['user'];
		$password = md5($_POST['password']);
		$sql = "SELECT * FROM user WHERE username = '$user' AND password = '$password'";
		$query = mysqli_query($koneksi, $sql);
		$data = mysqli_fetch_assoc($query);
		//$username = mysql_real_escape_string($_POST[username]);
		echo "$data";
		if ($data[username] == $user) {
			$_SESSION['username'] = $user;
			$_SESSION['password'] = $password;
			if ($data[no] == 14) {
				header('location:./index.php');
			}
			else{
				header('location:./indexnonadmin.php');
			}

			//header('location:./index.php');
			//echo "<a href = 'index.php'>";
		}
		else {
			echo "Username Dan Password Salah !!<br>";
			echo "<a href='login.php'>Kembali</a>";
		}
	}
}
?>