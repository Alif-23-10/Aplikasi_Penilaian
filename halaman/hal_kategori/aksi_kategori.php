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
  $tblName = 'kategori';
  $halamane = $_GET['halamane'];
  $act    = $_GET['act'];
  // declare variable post
  $id_kategori   = trim(htmlspecialchars($_POST['id_kategori']));
  $nama_kategori = trim(htmlspecialchars($_POST['nama_kategori']));
  $bobot = trim(htmlspecialchars($_POST['bobot']));
	
  // Input data kategori
  if ($halamane=='kategori' AND $act=='input'){	
	//get last insert auto number
    $Last_No = $db->last_inserted('id_kategori','kategori');
    $kode_kategori=$db->buatkode($Last_No, 'KR', 3);
	  
    $kategoriData = array(
            'id_kategori'  =>  $kode_kategori,
            'nama_kategori' => $nama_kategori,
            'bobot' => $bobot
			);
    $insert = $db->insert($tblName,$kategoriData);
    header("location:../../kategori-view");
  }

  // Update data kategori
  elseif ($halamane=='kategori' AND $act=='update'){
    $kategoriData = array(
            'nama_kategori' => $nama_kategori,
            'bobot' => $bobot
			);
    $condition = array('id_kategori' => $id_kategori);
    $update = $db->update($tblName,$kategoriData,$condition);
    header("location:../../kategori-view");
  }

  // Hapus data kategori
  elseif ($halamane=='kategori' AND $act=='hapus'){
	$decrypted_txt = $db->encrypt_decrypt('decrypt', $_GET['id']);
    $condition = array('id_kategori' => $decrypted_txt);
    $delete = $db->delete($tblName,$condition);
       header("location:kategori-view");
  }

}
?>
