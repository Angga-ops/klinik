<?php

include "../../../config/koneksi.php";

if($_POST['id']) {
        $id = $_POST['id'];
        // mengambil data berdasarkan id
        $tampil     = mysql_query("SELECT * FROM beli_k WHERE id = $id");
        while($data = mysql_fetch_array($tampil)){
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
                    <td><?php $q1 = mysql_query("SELECT *FROM suplier WHERE id_sup='$data[id_sup]'"); 
                    $k = mysql_fetch_array($q1); ?>
                    <?php echo $k['nama_sup']; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>:</td>
                    <td><?php echo $data['total']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Tempo</td>
                    <td>:</td>
                    <td style="color: #ff0000;"><?php echo $data['tgl_tempo']; ?></td>
                </tr>
                <tr>
                    <td>Bukti Bayar</td>
                    <td>:</td>
                    <td><a href="<?php echo $url;?>/bukti_bayar/<?php echo $data['bukti_bayar']; ?>"><img src="<?php echo $url;?>/bukti_bayar/<?php echo $data['bukti_bayar']; ?>" width="100px" height="100px"></a></td>
                </tr>
            </table>
            <h5><b>Item : </b></h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Tanggal Beli</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $tampil     = mysql_query("Select * From history_beli_k where no_fak='$data[no_fak]'");
                    $no = 1;
                    while($data = mysql_fetch_array($tampil)){
                ?>
                <tr class="gradeX">
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