<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  include "../../config/koneksi.php";
  // initial database
  $db = new DB();
  $tblName = 'kompetensi';
  $halamane = $_GET['halamane'];
  $act    = $_GET['act'];
  // declare variable post
  $id_kompetensi   = trim(htmlspecialchars($_POST['id_kompetensi']));
  $nama_kompetensi = trim(htmlspecialchars($_POST['nama_kompetensi']));
  $id_kategori  = trim(htmlspecialchars($_POST['id_kategori']));
	
  // Input data kompetensi
  if ($halamane=='kompetensi' AND $act=='input'){	
	//get last insert auto number
    $Last_No = $db->last_inserted('id_kompetensi','kompetensi');
    $kode_kompetensi=$db->buatkode($Last_No, 'KO', 3);
	  
    $kompetensiData = array(
            'id_kompetensi'  =>  $kode_kompetensi,
            'nama_kompetensi' => $nama_kompetensi,
            'id_kategori'  => $id_kategori
			);
    $insert = $db->insert($tblName,$kompetensiData);
    header("location:../../kompetensi-view");
  }

  // Update data kompetensi
  elseif ($halamane=='kompetensi' AND $act=='update'){
    $kompetensiData = array(
            'nama_kompetensi' => $nama_kompetensi,
            'id_kategori'  => $id_kategori
			);
    $condition = array('id_kompetensi' => $id_kompetensi);
    $update = $db->update($tblName,$kompetensiData,$condition);
    header("location:../../kompetensi-view");
  }

  // Hapus data kompetensi
  elseif ($halamane=='kompetensi' AND $act=='hapus'){
	$decrypted_txt = $db->encrypt_decrypt('decrypt', $_GET['id']);
    $condition = array('id_kompetensi' => $decrypted_txt);
    $delete = $db->delete($tblName,$condition);
       header("location:kompetensi-view");
  }

}
?>
