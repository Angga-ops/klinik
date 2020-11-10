<?php

include "../../../config/koneksi.php";

//ambil detail obat yg akan dipindah
$a = mysql_query("SELECT * FROM kasir_sementara WHERE id IN ($_GET[data])");

?>


<h4>No Billing : <?php echo $_GET[faktur]; ?></h4>
<h4>ID Pasien : <?php echo $_GET[pasien]; ?></h4>

<table>

<thead>

<tr>
<th>Obat</th>
<th>Keterangan</th>
<th>Jml</th> 
<th>Status</th> 
</tr>

</thead>

<tbody>

 <?php

while($ab = mysql_fetch_assoc($a)){
    //cek produk
    $pro = mysql_fetch_assoc(mysql_query("SELECT * FROM produk WHERE kode_barang = '$ab[kode]' AND nama_p = '$ab[nama]'"));
    if($pro[jumlah] > 0){
        $sisa = $pro[jumlah] - $ab[jumlah];
        mysql_query("UPDATE produk SET jumlah = '$sisa' WHERE id_p = '$pro[id_p]'");
        $status = "OBAT SUDAH DIAMBIL";
        mysql_query("INSERT INTO history_kasir (no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,diskon,sub_total,id_kk,jenis,status,ket,penginput,kategori,tgl_visit) SELECT no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,diskon,sub_total,id_kk,jenis,status,ket,penginput,kategori,tgl_visit FROM kasir_sementara WHERE id = '$ab[id]'");
        mysql_query("DELETE FROM kasir_sementara WHERE id = '$ab[id]'");
    } else {
        $status = "STOK OBAT TIDAK TERSEDIA";
    }

    echo "<tr>";
    echo "<td>$pro[nama_p]</td>";
    echo "<td>$ab[ket]</td>";
    echo "<td>$ab[jumlah]</td>";
    echo "<td>$status</td>";
    echo "</tr>";

   

}

?>

</tbody>
</table>