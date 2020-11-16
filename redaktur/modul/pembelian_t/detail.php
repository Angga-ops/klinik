<?php

include "../../../config/koneksi.php";

if($_POST['id']) {
        $id = $_POST['id'];
        // mengambil data berdasarkan id
        $tampil     = mysqli_query($con,"SELECT * FROM beli WHERE id = $id");
        while($data = mysqli_fetch_array($tampil)){
         ?>
            <table class="table">
                <tr>
                    <td>Nomor Faktur</td>
                    <td>:</td>
                    <td><?php echo $data['no_fak']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal beli</td>
                    <td>:</td>
                    <td><?php echo $data['tgl_beli']; ?></td>
                </tr>
                <tr>
                    <td>Suplier</td>
                    <td>:</td>
                    <td><?php $q1 = mysqli_query($con,"SELECT *FROM suplier WHERE id_sup='$data[id_sup]'"); 
                    $k = mysqli_fetch_array($q1); ?>
                    <?php echo $k['nama_sup']; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>:</td>
                    <td><?php echo $data['total']; ?></td>
                </tr>
                <tr>
                    <td>Pembayaran</td>
                    <td>:</td>
                    <td><?php echo $data['pembayaran']; ?></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td><?php echo $data['ket']; ?></td>
                </tr>
                <tr>
                    <td>Bukti Bayar</td>
                    <td>:</td>
                    <td><?php
                        if ( $data['bukti_bayar'] == '') {
                            echo "Belum Dibayar";
                        }else{
                            echo '<a href="'.$url.'/bukti_bayar/'.$data['bukti_bayar'].'"><img src="'.$url.'/bukti_bayar/'.$data['bukti_bayar'].'" width="100px" height="100px"></a>';
                        }?>
                        </td>
                </tr>
            </table>
            <h5><b>Item : </b></h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Gambar Produk</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Tanggal Beli</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $tampil     = mysqli_query($con,"Select * From history_beli_t where no_fak='$data[no_fak]'");
                    $no = 1;
                    while($data = mysqli_fetch_array($tampil)){
                ?>
                <tr class="gradeX">
                 <?php $q1 = mysqli_query($con,"SELECT *FROM produk_master WHERE nama_produk='$data[nama_brg]'"); 
                 $k = mysqli_fetch_array($q1); ?>
                 <td><?php
                        if ( $k['gambar'] == '') {
                            echo "Belum Ada Gambar";
                        }else{
                            echo '<center><a href="'.$url.'/gambar_produk/'.$k['gambar'].'"><img src="'.$url.'/gambar_produk/'.$k['gambar'].'" width="40px" height="40px"></a></center>';
                        }?></td>
                 <td><?php echo $data['nama_brg']; ?></td>
                 <td><?php echo $data['kd_brg']; ?></td>
                 <td><?php echo $data['jumlah']?></td>
                 <td><?php echo $data['hrg']?></td>
                 <td><?php echo $data['tgl_beli']?></td>
                </tr>
        <?php
            }
        ?>
                  </tbody> 
            </table>
        <?php 
 
        }
    }

?>