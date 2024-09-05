<?php
session_start();
  include "../../config/koneksi.php";

// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
	 $db = new DB();
	 
	$th=$db->getRows('tahun_penilaian',array('where'=>array('id_tahun_penilaian'=>$_POST['tahun']),'return_type'=>'single'));
?>
<html>
<head>
<title> :: LAPORAN DATA PENILAIAN KARYAWAN</title>
<link href="halaman/hal_report/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>

	<center>
	<h2> LAPORAN DATA PENILAIAN KARYAWAN </h2>
	<p><?php echo"Tahun : $th[nama_tahun_penilaian]";?></p>
	</center>
	<?php
	if($_POST['tahun'] !==''){
	$transaksi = $db->getRows('mutasi',array('where'=>array('id_tahun_penilaian'=>$_POST['tahun'])),array('order_by'=>'id_karyawan DESC'));
	}
	
	echo"<table class='table-list' width='100%' border='0' cellspacing='1' cellpadding='2'>
    <thead>
    <tr>
	<td bgcolor='#F5F5F5'>#</td>
	<td bgcolor='#F5F5F5' width='20%'>Nama Karyawan</td>
    <td bgcolor='#F5F5F5'>Average Rating</td>
    <td bgcolor='#F5F5F5'>Weighted/ Bobot  (%)</td>
    <td bgcolor='#F5F5F5'>Score  / Skor (Weighted  x Rating)</td>
    </tr>
    </thead>
    <tbody>"; 
            
    $no = 1;
    // Tampilkan data tabel yang dipilih
    foreach($transaksi ? $transaksi : [] as $r){  extract($r);
	$k=$db->getRows('karyawan',array('where'=>array('id_karyawan'=>$id_karyawan),'return_type'=>'single'));
	$summ=$db->GetSumRating($id_karyawan,$_POST['tahun']);
	//$avg=$db->GetAverage($yang_dinilai,$penilai,$id_tahun_penilaian);
    echo "
    <tr>
    <td class='center'>$no</td>
    <td class='center'>$k[nama_karyawan]</td>
    <td class='center'>".round($db->GetAverage2($id_karyawan,$_POST['tahun']),2)."</td>
    <td class='center'>".$db->GetSum()."</td>
    <td class='center'>$summ</td>
    
                            
    </tr>"; $no++;
    }
    echo"
	</tbody>
    </table>";
	?>
	</body>
	</html>
	<?php
	}
	?>