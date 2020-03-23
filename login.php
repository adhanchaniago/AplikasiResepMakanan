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
    <title>Warteg Online | Login</title>
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
    <h1>Login <small>Warteg Online</small></h1>
</div>
<div class="container">
    <div class="row">
        <form role="form" action="proses.php" method="post" enctype="multipart/form-data">
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
                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" value="Login" class="btn btn-info pull-left">
                </div>
        </form>
    </div>
</div>
</div>
</body>
</html>