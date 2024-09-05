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
  $tblName = 'user';
  $halamane = $_GET['halamane'];
  $act    = $_GET['act'];
  // declare variable post
  $id_user   = trim(htmlspecialchars($_POST['id_user']));
  $nama_user = trim(htmlspecialchars($_POST['nama_user']));
  $password  = trim(htmlspecialchars($_POST['password']));
  $username  = trim(htmlspecialchars($_POST['username']));
  $level  = trim(htmlspecialchars($_POST['level']));
	
  // Input data user
  if ($halamane=='user' AND $act=='input'){	
	//get last insert auto number
    $Last_No = $db->last_inserted('id_user','user');
    $kode_user=$db->buatkode($Last_No, 'US', 3);
	  
    $userData = array(
            'id_user'   =>  $kode_user,
            'nama_user' => $nama_user,
            'password'  => $password,
            'username'  => $username,
            'level'     => $level);
    $insert = $db->insert($tblName,$userData);
    header("location:../../user-view");
  }

  // Update data user
  elseif ($halamane=='user' AND $act=='update'){
    $userData = array(
            'id_user'   =>  $id_user,
            'nama_user' => $nama_user,
            'password'  => $password,
            'username'  => $username,
            'level'     => $level);
    $condition = array('id_user' => $id_user);
    $update = $db->update($tblName,$userData,$condition);
    header("location:../../user-view");
  }

  // Hapus data user
  elseif ($halamane=='user' AND $act=='hapus'){
	$decrypted_txt = $db->encrypt_decrypt('decrypt', $_GET['id']);
    $condition = array('id_user' => $decrypted_txt);
    $delete = $db->delete($tblName,$condition);
       header("location:user-view");
  }

}
?>
