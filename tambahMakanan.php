<?php
if (!isset($_SESSION)) {
    session_start();
}

@ini_set('output_buffering',0);
set_time_limit(0);
error_reporting(E_ALL);

    if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {     
        session_unset();
        header("Location:login.php");
        exit;
    }

require 'inc/koneksi.php'; 
$uname = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warteg Online | Tambah Makanan</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap-3.3.1/dist/css/bootstrap.min.css"

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <style>
    body {
            padding-top: 20px;
            padding-bottom: 20px;
        }

    .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Warteg Online</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="daftarMakanan.php">Daftar Makanan</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-user">
                <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
    </nav>
<div class="page-header">
    <h1>Tambah Makanan <small>Warteg Online</small></h1>
</div>
<div class="container">
    <div class="row">
        <form role="form" method="post" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span> Tidak Boleh Kosong</strong></div>
                <div class="form-group">
                    <label for="nama">Nama Makanan</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Makanan">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gambar">Upload Gambar</label>
                    <div class="input-group">
                        <input name="gambar" type="file" class="form-control">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="resep">Resep</label>
                    <div class="input-group">
                        <input name="resep" type="file" class="form-control">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span> Format TXT</span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" value="Tambah Makanan" class="btn btn-info pull-left">
                </div>
            <div class="col-lg-5 col-md-push-1">
            <div class="col-md-12">
<?php
if (isset($_POST['submit'])) {
    if (empty($_POST['nama'])) {
        echo '<div class="alert alert-danger">
                <strong><span class="glyphicon glyphicon-remove"></span><strong> Pastikan Tidak Ada Form Kosong !!</strong>
              </div>';
    }
    else {
        $nama = $_POST['nama'];
        $usergambar = $_FILES['gambar']['name'];
        $file_size = $_FILES['gambar']['size'];
        $file_type = $_FILES['gambar']['type'];
        $source = $_FILES['gambar']['tmp_name'];

        $userresep = $_FILES['resep']['name'];
        $file_sizep = $_FILES['resep']['size'];
        $file_typep = $_FILES['resep']['type'];
        $sourcep = $_FILES['resep']['tmp_name'];
        $direktori = "gambar/$usergambar";

        $direktorip = "resep/$userresep";
        if($file_type != "image/gif" && $file_type != "image/jpg" && $file_type != "image/jpeg" && $file_type != "image/png")
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
                    $query = "INSERT INTO `menu` (`no`, `nama_menu`, `url_menu`) VALUES ('', '$nama', '$direktori')";
                    mysqli_query($koneksi, $query);
                    echo '<div class="alert alert-success">
                        <strong><span class="glyphicon glyphicon-ok"></span> Berhasil Menambah Makanan !!</strong>
                        </div>';
                }
            }   
            
        }
    }
}
?>
        </div></div>
        </form>
    </div>
</div>
</div>
</body>
</html>