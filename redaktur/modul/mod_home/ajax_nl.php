<?php include "../../../config/koneksi.php";

switch($_GET['jamin']){
    case "bpjs": $jamin = ",bpjs"; break;
    case "umum": $jamin = ",harga";  break;
    case "lain": $jamin = ",lain"; break;
}

$r = mysqli_query($con, "SELECT id,nama_t $jamin FROM treatment WHERE kategori = '2'");
while($ru = mysqli_fetch_assoc($r)){

switch($_GET['jamin']){
    case "bpjs": $nama = $ru['bpjs']; break;
    case "umum": $nama = $ru['harga']; break;
    case "lain": $nama = $ru['lain']; break;
}


    echo "<option value='$ru[id]'>$ru[nama_t] $nama</option>";
}


?>