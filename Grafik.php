<?php
//PAKE mysql biasa, bagi yg ga support (PHP 5.5) bisa pake mysqli
mysql_connect("localhost","root","");
mysql_select_db("warteg_online");
//kita ngambil jumlah penjualan pertahun dan di grup kan tahun nya, karena banyak nilai tahun pada data
$sql="Select SUM(jumlah) as m,tahun from grafik GROUP BY tahun";
//jalankan query
$rs=mysql_query($sql);
//bikin variabel sebagai array untuk menampung data nantinya
$data=array();
//loooooooooop sebagai object, bisa pake fetch_array $row['field']
while ($row = mysql_fetch_object($rs)) {
	$data[]=array(
		'y'=>$row->tahun, //y sebagai kata kunci nya (tahun)		
		'jumlah'=>$row->m, //jumlah penjualan
		);	
}
	//outputkan sebagai json
	echo json_encode($data);
?>