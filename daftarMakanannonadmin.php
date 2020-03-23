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
		<title>Warteg Online | Daftar Makanan</title>
    	<!-- Bootstrap core CSS -->
    	<link href="css/bootstrap.css" rel="stylesheet">
    	<link href="bootstrap-3.3.1/dist/css/bootstrap.min.css">
    	<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">

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
			.page {
				display:inline-block;
				position:relative;
			}
			#number {
				display:inline-block;
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
            			<h1>Warteg Online <small>Daftar Makanan</small></h1>
            			<a href="tambahMakanannonadmin.php" class="btn btn-info btn-sm" role="button"><span class="glyphicon glyphicon-plus" id="addnew"> </span> Tambah Makanan</a>
            			<form id="search" action="daftarMakanan.php" method="post" >
            				<input type="search" placeholder="search" name="qcari">
            			</form>
        			</div>
    			</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th><center>NO</center></th>
								<th><center>Menu Makanan</center></th>
								<th><center>Gambar</center></th>
								<th><center>Aksi</center></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;			
								$batas = 3;
								if(isset($_POST['qcari'])){
									$qcari=$_POST['qcari'];
									$result1 = mysqli_query($koneksi,"select count(*) from menu where nama_menu like '%$qcari%'");
								} else {
									$result1 = mysqli_query($koneksi, "SELECT count(*) FROM menu");
								}
								$recordcount = mysqli_fetch_row($result1)[0];
								$pagecount = ceil($recordcount / $batas);
								if(!isset($_GET['page'])){
									$activepage = 1;
								} else {
									$activepage = $_GET['page'];
								}
								$mulai = $batas * ($activepage-1);
								if(isset($_POST['qcari'])){
									$qcari=$_POST['qcari'];
									$query = mysqli_query($koneksi,"SELECT nama_menu, url_menu FROM menu where nama_menu like '%$qcari%' limit $mulai, $batas");
								} else { 
									$query = mysqli_query($koneksi,"SELECT * FROM menu");		
								}
								while ($menu = mysqli_fetch_array($query)) {
							?>
							<tr align="center">
								<td><p><?php echo $no; ?></p></td>
								<td><p><?php echo $menu['nama_menu'];?></p></td>
								<td><img src="<?php echo $menu['url_menu'];?>" width="100" heigt="100"></td>
								<td><a href="resepMakanannonindex.php?id=<?php echo $menu['no'];?>" class="btn btn-success btn-sm" role="button">
										<span class="glyphicon glyphicon-eye-open"> </span> Lihat Resep
									</a>
									<a href="pdf.php?id=<?php echo $menu['no'];?>" class="btn btn-warning btn-sm" role="button">
										<span class="glyphicon glyphicon-retweet"> </span> Export To PDF
									</a>
									<a href="editnonadmin.php?id=<?php echo $menu['no'];?>" class="btn btn-primary btn-sm" role="button">
										<span class="glyphicon glyphicon-edit"> </span> Edit
									</a>
								</td>
							</tr>
							<?php
								$no++;
								}
							?>	
						</tbody>
					</table>
				</div>
			</div>	
		</div>
		
			<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".table").DataTable({
			pageLength: 1
		});
	});
	</script>	
	</body>
</html>