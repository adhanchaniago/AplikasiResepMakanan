<?php
include "connect.php";
$name="";
if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
$limit = 5;
$query="SELECT * from resep where nama like '%$nama%'";
$result= $con->query($query);
$rows=$result->num_rows;
$page=ceil($rows/$limit);
$row=$result->fetch_array(MYSQLI_NUM);
echo "<center>";
echo "<h2> Hasil Searching </h2>";
echo "<table border='1' cellpadding='5' cellspacing='8'>";
echo "
<tr bgcolor='orange'>
<td>No</td>
<td>Judul Resep</td>
<td>Harga</td>
</tr>";

if (isset($_GET['p'])){
    $mulai = ($_GET['p']-1)*$limit;
    for($i=1;$i<=$limit;$i++){
        $result->data_seek($mulai-1+$i);
        if(!($result->data_seek($mulai-1+$i))){
            break;
        }
        $row = $result->fetch_array(MYSQLI_NUM);
        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
    }
}else{
    for($i=0;$i<=$limit;$i++){
        $result->data_seek($i-1);
        $row=$result->fetch_array(MYSQLI_NUM);
        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
    }
}

echo "<tr><td colspan='3'>";
for($i=1;$i<=$page;$i++){
    if(isset($_GET['p'])){
        if($_GET['p']==$i){
            echo"<strong>$i</strong>";
        }else{
            echo"<a href='search_exe.php?p=$i'>$i</a>";
        }
    }else{
        echo"<a href='search_exe.php?p=$i'>$i</a>";
    }
}
echo "</td></tr></table>";
?>