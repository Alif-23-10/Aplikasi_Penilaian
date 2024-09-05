<?php
 // Initialing koneksi database
  include "../../config/koneksi.php";
  $db = new DB();

if(isset($_POST['btnrekap'])){
 $encrypted_txt = $db->encrypt_decrypt('encrypt', $_POST['id_karyawan']);
 $encrypted_txt2 = $db->encrypt_decrypt('encrypt', $_POST['id_tahun_penilaian']);
 $db->jump_to("rekap-transaksi-$encrypted_txt-$encrypted_txt2");
}


?>