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
  $tblName = 'tahun_penilaian';
  $halamane = $_GET['halamane'];
  $act    = $_GET['act'];
  // declare variable post
  $id_tahun_penilaian   = trim(htmlspecialchars($_POST['id_tahun_penilaian']));
  $nama_tahun_penilaian = trim(htmlspecialchars($_POST['nama_tahun_penilaian']));
  $keterangan  = trim(htmlspecialchars($_POST['keterangan']));
	
  // Input data tahun_penilaian
  if ($halamane=='tahun_penilaian' AND $act=='input'){	
	//get last insert auto number
    $Last_No = $db->last_inserted('id_tahun_penilaian','tahun_penilaian');
    $kode_tahun_penilaian=$db->buatkode($Last_No, 'TA', 3);
	  
    $tahun_penilaianData = array(
            'id_tahun_penilaian'  =>  $kode_tahun_penilaian,
            'nama_tahun_penilaian' => $nama_tahun_penilaian,
            'keterangan'  => $keterangan
			);
    $insert = $db->insert($tblName,$tahun_penilaianData);
    header("location:../../tahun_penilaian-view");
  }

  // Update data tahun_penilaian
  elseif ($halamane=='tahun_penilaian' AND $act=='update'){
    $tahun_penilaianData = array(
            'nama_tahun_penilaian' => $nama_tahun_penilaian,
            'keterangan'  => $keterangan
			);
    $condition = array('id_tahun_penilaian' => $id_tahun_penilaian);
    $update = $db->update($tblName,$tahun_penilaianData,$condition);
    header("location:../../tahun_penilaian-view");
  }

  // Hapus data tahun_penilaian
  elseif ($halamane=='tahun_penilaian' AND $act=='hapus'){
	$decrypted_txt = $db->encrypt_decrypt('decrypt', $_GET['id']);
    $condition = array('id_tahun_penilaian' => $decrypted_txt);
    $delete = $db->delete($tblName,$condition);
       header("location:tahun_penilaian-view");
  }

}
?>
