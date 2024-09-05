<?php
include "../../config/koneksi.php";
$db = new DB();

$username = $db->anti_injection($_POST['username']);
$password = $db->anti_injection($_POST['password']);

 $r  = $db->getRows('user',array('where'=>array('username'=>$username,'password'=>$password),'return_type'=>'single'));
 $ketemu  = $db->getRows('user',array('where'=>array('username'=>$username,'password'=>$password),'return_type'=>'count'));

if ($ketemu > 0){
    session_start();

    // bikin variabel session
    $_SESSION['username']    = $r['id_user'];
    $_SESSION['passuser']    = $r['password'];
    $_SESSION['namauser']    = $r['nama_user'];
    $_SESSION['leveluser']   = $r['level'];
      
    // bikin id_session yang unik dan mengupdatenya agar slalu berubah 
    // agar user biasa sulit untuk mengganti password Administrator 
    $sid_lama = session_id();
    session_regenerate_id();
    $sid_baru = session_id();

    header("location:home");
  }
  else{
     header("location:login-failed");
  }

?>
