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
    <?php
        $nama = "select * from menu where no=$_GET[id]";
        $sql = mysqli_query($koneksi, $nama);
        $arr = mysqli_fetch_array($sql);
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warteg Online | Edit Makanan</title>
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
    <h1>Edit Makanan <small>Warteg Online</small></h1>
</div>
<div class="container">
    <div class="row">
        <form role="form" method="POST" action="editsql.php" enctype="multipart/form-data">
            <input type="hidden" name="no" value="<?php echo $arr['no'] ?>">
            <div class="col-lg-6">
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span><?php echo $arr['no'] ?> Tidak Boleh Kosong</strong></div>
                <div class="form-group">
                    <label for="nama">Nama Makanan</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Makanan" value="<?php echo $arr['nama_menu']?>">
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
                <input type="submit" name="submit" id="submit" value="Edit Makanan" class="btn btn-info pull-left">
                </div>
            <div class="col-lg-5 col-md-push-1">
            <div class="col-md-12">
        </div></div>
        </form>
    </div>
</div>
</div>
</body>
</html>