<?php
session_start();
if($_POST["kode"] != $_SESSION["kode_cap"] OR $_POST["kode"] == ""){
echo"Kode salah... <a href='index.php'>Kembali</a>";
}else{
echo"Kode BENAR";
}