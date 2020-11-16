<?php

include "../../../config/koneksi.php";

//ambil detail obat yg akan dipindah
$a = mysqli_query($con, "SELECT * FROM kasir_sementara WHERE id IN ($_GET[data])");

?>


<h4>No Billing : <?php echo $_GET['faktur']; ?></h4>
<h4>ID Pasien : <?php echo $_GET['pasien']; ?></h4>

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

while($ab = mysqli_fetch_assoc($a)){
    //cek produk
    $pro = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM produk WHERE kode_barang = '$ab[kode]' AND nama_p = '$ab[nama]'"));
    if($pro['jumlah'] > 0){
        $sisa = $pro['jumlah'] - $ab['jumlah'];
        mysqli_query($con, "UPDATE produk SET jumlah = '$sisa' WHERE id_p = '$pro[id_p]'");
        $status = "OBAT SUDAH DIAMBIL";
        mysqli_query($con, "INSERT INTO history_kasir (no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,diskon,sub_total,id_kk,jenis,status,ket,penginput,kategori,tgl_visit) SELECT no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,diskon,sub_total,id_kk,jenis,status,ket,penginput,kategori,tgl_visit FROM kasir_sementara WHERE id = '$ab[id]'");
        mysqli_query($con, "DELETE FROM kasir_sementara WHERE id = '$ab[id]'");
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