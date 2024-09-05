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
  $tblName = 'rating';
  $halamane = $_GET['halamane'];
  $act    = $_GET['act'];
  // declare variable post
  $id_rating   = trim(htmlspecialchars($_POST['id_rating']));
  $nilai_rating = trim(htmlspecialchars($_POST['nilai_rating']));
  $keterangan  = trim(htmlspecialchars($_POST['keterangan']));
	
  // Input data rating
  if ($halamane=='rating' AND $act=='input'){	
	//get last insert auto number
    $Last_No = $db->last_inserted('id_rating','rating');
    $kode_rating=$db->buatkode($Last_No, 'R', 3);
	  
    $ratingData = array(
            'id_rating'  =>  $kode_rating,
            'nilai_rating' => $nilai_rating,
            'keterangan'  => $keterangan
			);
    $insert = $db->insert($tblName,$ratingData);
    header("location:../../rating-view");
  }

  // Update data rating
  elseif ($halamane=='rating' AND $act=='update'){
    $ratingData = array(
            'nilai_rating' => $nilai_rating,
            'keterangan'  => $keterangan
			);
    $condition = array('id_rating' => $id_rating);
    $update = $db->update($tblName,$ratingData,$condition);
    header("location:../../rating-view");
  }

  // Hapus data rating
  elseif ($halamane=='rating' AND $act=='hapus'){
	$decrypted_txt = $db->encrypt_decrypt('decrypt', $_GET['id']);
    $condition = array('id_rating' => $decrypted_txt);
    $delete = $db->delete($tblName,$condition);
       header("location:rating-view");
  }

}
?>
