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
  $tblName = 'transaksi';
  $halamane = $_GET['halamane'];
  $act    = $_GET['act'];
  
 
  $tanggal = date("Y-m-d H:i:s");

 if ($halamane=='transaksi' AND $act=='mutasi'){	
    // declare variable post
  $id_karyawan  = trim(htmlspecialchars($_POST['id_karyawan']));
  if (!empty($_POST['id_tahun_penilaian'])){
    $tag_lokasi = $_POST['id_tahun_penilaian'];
    $tag=implode(',',$tag_lokasi);
  }

  
   //hitung jumlah kompetensi
	$jumlah = count($tag_lokasi);
	for($i=0; $i<$jumlah; $i++){
	$urut = $i+1;
	$nilai_angka = $_POST['id_tahun_penilaian'][$i];
  
	//cek apakah sudah ada di temp
	$cekKode  = $db->getRows('mutasi',array('where'=>array('id_tahun_penilaian'=>$nilai_angka,'id_karyawan'=>$id_karyawan),'return_type'=>'count'));
	//Jika sudah maka no action
    if ($cekKode>0){
	//no action
	} else {
	//Masukkan ke tabel user akes lokasi yg di centang
	if(trim($nilai_angka) !=""){
   //Input data Mutasi
	$MutasiData = array('id_tahun_penilaian' => $nilai_angka,'id_karyawan'=> $id_karyawan);
    $insert = $db->insert('mutasi',$MutasiData);
	} //end masukkan data   	
	} //end check
    } //end hitung jumlah kompetensi

    header("location:../../mutasi-view");
  }
  
  
  elseif ($halamane=='transaksi' AND $act=='update'){
	//hitung jumlah form yang dikirim
	$jumlah = count($_POST['kompetensi']);
	$id_karyawan	= $_POST['id_karyawan'];
	$id_tahun_penilaian	= $_POST['id_tahun_penilaian'];
	//looping data kompetesi
	for($i=0; $i<$jumlah; $i++){
	$urut	= $i+1;
	//declare variable not array
	$kompetensi	= $_POST['kompetensi'][$i];
	$rating	= $_POST['rating'][$i];
	
	//Cek apakah sudah ada didatabase transaksi atau belum ?
	$cek=$db->getRows('transaksi',array('where'=>array('id_karyawan'=>$id_karyawan,'id_tahun_penilaian'=>$id_tahun_penilaian,'id_kompetensi'=>$kompetensi),'return_type'=>'count'));
	if ($cek >0){
	//update data jika data sudah ada di tabel transaksi
	$UpdateData = array('rating' => $rating);
    $condition = array('id_karyawan' => $id_karyawan,'id_kompetensi'=>$kompetensi,'id_tahun_penilaian'=>$id_tahun_penilaian);
    $update = $db->update($tblName,$UpdateData,$condition);
	
	} else {
	//Input data jika data belum ada di tabel transaksi
	$MutasiData = array('id_karyawan'=>$id_karyawan,'id_kompetensi'=>$kompetensi,'id_tahun_penilaian'=>$id_tahun_penilaian,'rating'=>$rating);
    $insert = $db->insert($tblName,$MutasiData);	
	} //end check
	
	
	
	}//end looping data kompetesi
   $encrypt_txt = $db->encrypt_decrypt('encrypt', $id_karyawan);
   $encrypt_txt2 = $db->encrypt_decrypt('encrypt', $id_tahun_penilaian);
   
   header("location:../../rekap-transaksi-".$encrypt_txt."-".$encrypt_txt2."");
   }

 

 
}
?>
