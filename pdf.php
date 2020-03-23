<?php  
  session_start();  
  ob_start();  
  require_once 'inc/koneksi.php';
  $id   = $_GET['id'];
  $query  = mysqli_query($koneksi, "SELECT * FROM menu WHERE no='".$id."'");  
  $data   = mysqli_fetch_array($query);  
?>  
<html xmlns="http://www.w3.org/1999/xhtml"> 
  <head>  
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
    <title><?php echo $data['nama_menu']; ?></title>  
  </head>  
  <body>    
    <h1><?php echo $data['nama_menu'];?></h1>   
    <table border="0">  
      <tr>  
        <td width="100">Nama Makanan</td>  
        <td width="10">:</td>  
        <td width="250"><?php echo $data['nama_menu'];?></td>  
      </tr>  
      <tr>  
        <td>Gambar Makanan</td>  
        <td>:</td>  
        <td><img src="<?php echo $data['url_menu'];?>" width="100" height="100"></td>  
      </tr>  
      <tr>  
        <td>Cara Pembuatan <?php echo $data['nama_menu'];?></td>  
        <td>:</td>  
        <td><?php echo file_get_contents('resep/'.$data['nama_menu'].'.txt');?></td>  
      </tr>
    </table>
  </body>  
</html>
<?php  
  $filename="mhs-".$data['nama_menu'].".pdf";
  $content = ob_get_clean();  
  $content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';  
  require_once(dirname(__FILE__).'/html2pdf_v4.03/html2pdf.class.php');  
  try  
  {  
    $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));  
    $html2pdf->setDefaultFont('Arial');  
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));  
    $html2pdf->Output($filename);  
  }  
  catch(HTML2PDF_exception $e) { echo $e; }  
?>  