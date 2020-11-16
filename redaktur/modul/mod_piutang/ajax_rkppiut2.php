<?php 
include "../../conf/koneksi.php";

$id = $_GET["id"];

$now = date("Y-m-d");
               
$cb = (empty($_POST["cabang"]))? "" : "AND id_cb = ".$_POST["cabang"];

$nama = (empty($_POST["nama"]))? "" : "AND id_cus IN (SELECT id_cus FROM customer WHERE nama_m LIKE '%".$_POST["nama"]."%')";

//pencarian tanggal
$tgl = (empty($_POST["tgl1"]))? " tgl_mulai <= '$now'" : " tgl_mulai >= '".$_POST["tgl1"]."' AND tgl_mulai <= '".$_POST["tgl2"]."'"; 

$qlau = mysqli_query($conn,"SELECT * FROM nota WHERE $tgl AND stts_pss NOT IN ('Share Pelunasan') AND stts_byr IS NULL $nama $cb ORDER BY no_nota DESC, id_cb ASC LIMIT $_POST[limit],20");

echo "SELECT * FROM nota WHERE $tgl AND stts_pss NOT IN ('Share Pelunasan') AND stts_byr IS NULL $nama $cb ORDER BY no_nota DESC, id_cb ASC LIMIT $_POST[limit],20";

$json = "";
$baris = 0;
while($hasil = mysqli_fetch_assoc($qlau)){

 
 $emp = mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama_ky FROM karyawan WHERE id_ky = (SELECT id_ky FROM users WHERE id_prim = '".$hasil["id_kasir"]."')"));

  $cus = mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama_m AS nama, telp_m AS hp FROM customer WHERE id_cus = '".$hasil['id_cus']."'"));

  $det = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id_mode,qty,pcs,hrg_sub FROM nota_detail WHERE id_nota = '".$hasil['id_nota']."'"));

  $mode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM mode WHERE id_mode = '".$det['id_mode']."'"));

  $cb = mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama_cb FROM cabang WHERE id_cb = '".$hasil['id_cb']."'"));

  $detail = mysqli_fetch_array(mysqli_query($conn,"SELECT nota.*, SUM(nota_detail.qty) AS berat, SUM(nota_detail.pcs) AS potong, 
                   SUM(nota_detail.dis_plus) AS potongan, mode.kode_mode, mode.mode, mode.satuan_mode, mode.hrg_mode FROM nota 
   INNER JOIN nota_detail ON nota.id_nota = nota_detail.id_nota INNER JOIN mode ON nota_detail.id_mode = mode.id_mode WHERE nota.id_nota = '".$hasil['id_nota']."'"));
   
   $tot = ($det['hrg_sub']);
   $dsk = $tot * ($hasil['diskon_member']/100);
   $tagihan = number_format($tot - $dsk,0,",",".");

   $status = ($hasil["stts_pss"] == "Pelunasan" || $hasil["stts_pss"] == "Share Pelunasan")? "Lunas" : "Belum Lunas";

  echo "
  <tr>
  <td>".$status."</td>
  <td>".$hasil['no_nota']."</td>
  <td>".$cb['nama_cb']."</td>
  <td>".$emp['nama_ky']."</td>
  <td>".$cus['nama']." (".$cus['hp'].")</td>
  <td>Rp ".$tagihan."</td>
  <td>".$mode['mode']." <br/> ".$det['qty']." kg / ".$det['pcs']." Pcs </td>
  <td>".(strftime("%d %B %Y",strtotime($hasil['tgl_mulai'])))."</td>
  <td>".(strftime("%d %B %Y",strtotime($hasil['tgl_selesai'])))."</td>
  <td>Rp ".number_format($mode['hrg_mode'],0,",",".")."</td>
  <td>Rp ".number_format($tot,0,",",".")."</td>
  <td>Rp ".number_format($dsk,0,",",".")."</td>
  </tr>
  ";

  $total = $total + $tot;
  $baris++;
  

}
  

  
  ?>

<tr style="display: none"><td><input type="text" class="tagihan" value = "<?php echo $total; ?>" /><input type="text" class="baris" value = "<?php echo $baris; ?>" /></td></tr>