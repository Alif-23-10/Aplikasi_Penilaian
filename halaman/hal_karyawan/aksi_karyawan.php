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
  $tblName = 'karyawan';
  $halamane = $_GET['halamane'];
  $act    = $_GET['act'];
  // declare variable post
  $id_karyawan   = trim(htmlspecialchars($_POST['id_karyawan']));
  $nama_karyawan = trim(htmlspecialchars($_POST['nama_karyawan']));
  $alamat  = trim(htmlspecialchars($_POST['alamat']));
  $id_tahun_ajaran_aktif  = trim(htmlspecialchars($_POST['id_tahun_ajaran']));
	
  // Input data karyawan
  if ($halamane=='karyawan' AND $act=='input'){	
	//get last insert auto number
    $Last_No = $db->last_inserted('id_karyawan','karyawan');
    $kode_karyawan=$db->buatkode($Last_No, 'K', 3);
	//Input data karyawan  
    $karyawanData = array(
            'id_karyawan'   =>  $kode_karyawan,
            'nama_karyawan' => $nama_karyawan,
            'alamat'     => $alamat);
    $insert = $db->insert($tblName,$karyawanData);
	
	
    header("location:../../karyawan-view");
  }

  // Update data karyawan
  elseif ($halamane=='karyawan' AND $act=='update'){
    $karyawanData = array(
            'nama_karyawan' => $nama_karyawan,
            'alamat'  => $alamat);	
    $condition = array('id_karyawan' => $id_karyawan);
    $update = $db->update($tblName,$karyawanData,$condition);
    header("location:../../karyawan-view");
  }

  // Hapus data karyawan
  elseif ($halamane=='karyawan' AND $act=='hapus'){
	$decrypted_txt = $db->encrypt_decrypt('decrypt', $_GET['id']);
    $condition = array('id_karyawan' => $decrypted_txt);
    $delete = $db->delete($tblName,$condition);
       header("location:karyawan-view");
  }

}
?>
