<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user']) || isset($_SESSION['password'])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warteg Online | Daftar</title>
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
            <ul class="nav navbar-nav navbar-right navbar-user">
                <li><a href="daftar.php">Daftar</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
          </div>
        </div>
    </nav>
<div class="page-header">
    <h1>Daftar <small>Warteg Online</small></h1>
</div>
<div class="container">
    <div class="row">
        <form role="form" method="post">
            <div class="col-lg-6">
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span> Tidak Boleh Kosong</strong></div>
                <div class="form-group">
                    <label for="user">Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="user" placeholder="Masukkan Username">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="repass"> Re-Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="repass" placeholder="Masukkan Password Lagi" required="required">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
	<img src="captcha.php" id="captcha">
                    <div class="input-group">
                <input type="text" class="captcha" id="captchatextbox" name="captcha" placeholder="Input Captcha" required="required"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<select name="tahun" hidden="">
                	<option value="<?php $today = date("Y"); echo $today;?>"> <?php $today = date("Y"); echo $today;?></option>
                </select>
                <select name="jumlah" hidden="">
                	<option value="1">1</option>
                </select>
                <input type="submit" name="submit" id="submit" value="Daftar" class="btn btn-info pull-left">
                </div>
                <div class="col-lg-5 col-md-push-1">
                <div class="col-md-12">
                <?php
                if (isset($_POST['submit'])) {
                    if (empty($_POST['user'])) {
                        echo '<div class="alert alert-danger">
                                <span class="glyphicon glyphicon-remove"></span><strong> Username Kosong !!</strong>
                                </div>';
                    }
                    elseif ($_POST['password'] == $_POST['repass']) {
                        $userx = $_POST['user'];
                        $passwordx = md5($_POST['password']);
						$tahun = $_POST['tahun'];
						$jumlah = $_POST['jumlah'];
                        require 'inc/koneksi.php';
						$captcha = $_POST['captcha'];
						if($captcha!=$_SESSION['bilangan']){
							echo "<script> alert('Salah sam.'); location='daftar.php'; </script>";
						} else {
                            $query = mysqli_query($koneksi,"INSERT INTO `user`(`username`, `password`) VALUES ('$userx', '$passwordx')");
						  //$query = mysqli_query("INSERT INTO 'grafik'('tahun', 'jumlah') VALUES ('$tahun', '$jumlah')");
						}
                        if ($query = true && $query1 = true) {
                        ?>
                        <div class="panel panel-default">
                        <div class="panel-heading"><span class="glyphicon glyphicon-education"> </span><b> Result Pendaftaran <span class="label label-success"></span></b></div>
                        <div class="panel-body">
                        <table>
                            <tr>
                                <td>Username</td>
                                <td> : <?php echo $_POST['user'];?></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>: <?php echo $_POST['password'];?></td>
                            </tr>
                        </table>
                        <hr>
                        <button type="button" class="btn btn-sm btn-primary btn-block" onclick="window.location.href='login.php'">Login</button>
                        </div></div></div></div>
                        <?php
                        }
                        else {
                            echo '<div class="alert alert-danger">
                                <span class="glyphicon glyphicon-remove"></span><strong> Pendaftaran Gagal !!</strong>
                                </div>';
                        }

                    }
                    else {
                        echo '<div class="alert alert-danger">
                                <span class="glyphicon glyphicon-remove"></span><strong> Pastikan Password Dan Retype Password Sama !!</strong>
                                </div>';
                    }
                }
                ?>
        </form>
    </div>
</div>
</div>
</body>
</html>