<?php
if (!isset($_SESSION)) {
    session_start();
    ob_start();
}

@ini_set('output_buffering',0);
set_time_limit(0);
error_reporting(0);

    if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {     
        session_unset();
        header("Location:login.php");
        exit;
    }

require_once 'inc/koneksi.php'; 
$uname = $_SESSION['username'];
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Warteg Online | Dashboard</title>
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
            <h1>Selamat Datang non Admin<small>{<?php echo $uname;?>}</h1>
        </div>

        <div id="demo"><!--ajax-->
            <h1>Panduan Menggunakan Web</h1>
            <button type="button" onclick="loadDoc()" class="btn btn-info btn-sm" role="button">Klik Disini</button>
        </div>

        <script>
            function loadDoc() {//fungsi loaddoc
                var xhttp = new XMLHttpRequest(); //mendeklarasikan var xhttp 
                xhttp.onreadystatechange = function() { 
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("demo").innerHTML =
                        this.responseText;
                    }
                };
                xhttp.open("GET", "ajax_info.txt", true);
                xhttp.send();
            }
        </script>
<?php
$query = mysql_query("SELECT * FROM menu");
$jumlahMenu = mysql_num_rows($query);
?>
<div class="container">
    <div class="row">
        <form role="form" method="post">
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-paperclip"> </span> <b>Rekap Semua Makanan</b></div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <table class="table">
                                <tbody>
                                    <tr class="default">
                                        <td> <small><span class="glyphicon glyphicon-book"> </span> <b>Menu Makanan</small></td>
                                        <td> : <small><span class="label label-success"><?php echo $jumlahMenu;?> Record Data</span></small></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</body>
</html>
