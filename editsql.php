<?php
if (!isset($_SESSION)) {
    session_start();
}

@ini_set('output_buffering', 0);
set_time_limit(0);
error_reporting(E_ALL);

if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
    session_unset();
    header("Location:login.php");
    exit;
}

require 'inc/koneksi.php';
$uname = $_SESSION['username'];

if (isset($_POST['submit'])) {
    $menu = $_POST['nama'];
    $id   = $_POST['no'];

    $nama       = $_POST['nama'];
    $usergambar = $_FILES['gambar']['name'];
    $file_size  = $_FILES['gambar']['size'];
    $file_type  = $_FILES['gambar']['type'];
    $source     = $_FILES['gambar']['tmp_name'];
    $locate     = "gambar/{$usergambar}";
    //move_uploaded_file($source, $locate);

    // $userresep = $_FILES['resep']['name'];
    // $file_sizep = $_FILES['resep']['size'];
    // $file_typep = $_FILES['resep']['type'];
    // $sourcep = $_FILES['resep']['tmp_name'];
    // $direktori = "gambar/$usergambar";
    // $direktorip = "resep/$userresep";
    $aksi = move_uploaded_file($source, $locate);

    $sql = mysqli_query($koneksi, "UPDATE `menu` SET `url_menu`='{$locate}' WHERE `no` = '{$id}'") or die("Data Salah : " . mysqli_error($mysqli));

    /*if($file_type != "image/gif" && $file_type != "image/jpg" && $file_type != "image/jpeg" && $file_type != "image/png")
{
echo '<script language="javascript">alert ("Format Gambar Harus GIF, JPG, JPEG, PNG");
document.location=tambahMakanan.php</script>';
}
else
{
if($file_typep != "text/plain")
{
echo '<script language="javascript">alert ("Format Resep harus TXT");
document.location=tambahMakanan.php</script>';
}
else
{
$aksi = move_uploaded_file($source, $direktori);
$aksip = move_uploaded_file($sourcep, $direktorip);
if($aksi)
{
$query = mysqli_query($koneksi, "UPDATE menu SET url_menu='$aksi' WHERE no='$id'") or die("Data Salah : ".mysqli_error($mysqli));
mysqli_query($koneksi, $query);
echo '<div class="alert alert-success">
<strong><span class="glyphicon glyphicon-ok"></span> Berhasil Menambah Makanan !!</strong>
</div>';
}
}
}*/
}
if ($sql) {
    echo '<div class="alert alert-success">
        <strong><span class="glyphicon glyphicon-ok"></span>Berhasil Mengedit Makanan !!</strong>
        </div>';
    echo "$sql";
}