<?php
if (!isset($_SESSION)) {
    session_start();
}
ob_start();
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
$id = $_GET['id'];
require 'inc/koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM menu WHERE no=$id");
$data = mysqli_fetch_array($query);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warteg Online | Resep</title>
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
            <a class="navbar-brand" href="indexnonadmin.php">Warteg Online</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="daftarMakanannonadmin.php">Daftar Makanan</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-user">
                <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>Resep <?php echo $data['nama_menu'];?> <small>Warteg Online</small></h1>
        </div>
<div class="container">
    <div class="row">
        <form role="form" method="post">
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-pushpin"> </span> <b> Resep</b></div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <table class="table">
                                <tbody>
                                    <tr class="default">
                                        <td> <small><span class="glyphicon glyphicon-link"> </span> <b>Nama Makanan</small></td>
                                        <td> : <small><span class="label label-success"> <?php echo $data['nama_menu'];?></span></small></td>
                                    </tr>
                                    <tr class="default">
                                        <td> <small><span class="glyphicon glyphicon-link"> </span> <b>Gambar Makanan</small></td>
                                        <td> : <img src="<?php echo $data['url_menu'];?>" width="100" height="100"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-push-1">
            <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"> </span><b> Cara Membuat</b></div>
                <div class="panel-body">
                    <small><?php echo file_get_contents('resep/'.$data['nama_menu'].'.txt');?></small>
        </div></div></div></div>
         <div class="col-lg-6">
                <div class="form-group">
                    <form role="form" method="post">
                    <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-comment"> </span> <b> Masukkan Komentar</b></div>
                    <div class="panel-body">
                        <?php
                        if (isset($_POST['submit'])) {
                            if (empty($_POST['komentar'])) {
                                echo '<div class="alert alert-danger">
                                    <span class="glyphicon glyphicon-remove"></span><strong> Pastikan Tidak Ada Form Kosong !!</strong>
                                    </div>';
                            }
                            else {
                                $komentar = $_POST['komentar'];
                                $querykomen = "INSERT INTO `komentar`(`no`,`username`, `komentar`,`no_menu`) VALUES ('','$uname', '$komentar','$id')";
                                $dataKomentar = mysqli_query($koneksi,$querykomen);
                                if ($dataKomentar = true) {
                                header("Location:resepMakanannonindex.php?id=$id");
                                }
                                else {
                                    echo '<div class="alert alert-danger">
                                    <span class="glyphicon glyphicon-remove"></span><strong> Gagal Menambahkan Komentar !!</strong>
                                    </div>';
                                }
                            }
                        }
                        
                        ?>
                        <div class="panel panel-default">
                            <table class="table">
                                <tbody>
                                    <tr class="default">
                                        <td> <small><span class="glyphicon glyphicon-link"> </span> <b>Username </small></td>
                                        <td> : <small><span class="label label-success"> <?php echo $uname;?></span></small></td>
                                    </tr>
                                    <tr class="default">
                                        <td> <small><span class="glyphicon glyphicon-link"> </span> <b>Komentar </small></td>
                                        <td> <textarea rows="10" cols="40" name="komentar"></textarea> </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name="submit" value="Komen" class="btn btn-success btn-sm" role="button"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-push-1">
            <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-blackboard"> </span><b> Komentar</b></div>
                <div class="panel-body">
                    <tr>
                        <?php
                        $ambilKomentar = mysqli_query($koneksi, "SELECT * FROM komentar WHERE no_menu = $id");
                        while ($komen = mysqli_fetch_array($ambilKomentar)) {
                        ?>
                        <td><span class="label label-success"> <?php echo $komen['username'];?></span></td>
                        <td><small><?php echo $komen['komentar'];?></small></td>
                        <br>
                        <?php
                        }
                        ?>
                    </tr>
        </div></div></div></div>
    </form>
</div>
</div>
</body>
</html>