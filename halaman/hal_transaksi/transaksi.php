<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
   // Initialing koneksi database
  $db = new DB();
  $aksi = "halaman/hal_transaksi/aksi_transaksi.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
	$act = isset($_GET['act']) ? $_GET['act'] : ''; 

	switch($act){
    // Tampil transaksi
    default:

	echo"<div class='row'>
    <div class='col-xs-12'>
    <div class='widget-box'>
    <div class='widget-header'>
    <h4 class='widget-title'>Form Mutasi karyawan</h4>
    <div class='widget-toolbar'>
    <a href='#' data-action='collapse'>
    <i class='ace-icon fa fa-chevron-up'></i>
    </a>
    </div>
    </div>
    <div class='widget-body'>
    <div class='widget-main'>
	
	<table id='dynamic-table1' class='table table-striped table-bordered table-hover'>
    <thead>
    <tr>
    <th width='5%' class='center'>No</th>
    <th>Kode karyawan</th>
    <th>Nama karyawan</th>
    <th class='center'>Periode Penilaian</th>
    <th class='hidden-480'></th>
    </tr>
    </thead>
    <tbody>"; 
    
	$no=1;
    // Pilih tabel di database
    $transaksi = $db->SelectDist('id_karyawan','transaksi');
    // Tampilkan data tabel yang dipilih
    foreach($transaksi ? $transaksi : [] as $r){
	$s  = $db->getRows('karyawan',array('where'=>array('id_karyawan'=>$r['id_karyawan']),'return_type'=>'single'));
	$t  = $db->getRows('tahun_penilaian',array('where'=>array('id_tahun_penilaian'=>$s['id_tahun_penilaian_aktif']),'return_type'=>'single'));
    echo "<tr>
    <td><center>$no</center></td>
    <td>$r[id_karyawan]</td>
    <td>$s[nama_karyawan]</td>
    <td class='center'><form name='jump' method='post' action='jump-to'>
	<input type='hidden' name='id_karyawan' value='$r[id_karyawan]'/>";
	 echo'<select name="id_tahun_penilaian" class="input-sm" required="required">';

    // Pilih tabel di database
    $tahun_penilaian = $db->getRows('tahun_penilaian',array('order_by'=>'id_tahun_penilaian ASC'));
    // Tampilkan data tabel yang dipilih
    foreach($tahun_penilaian ? $tahun_penilaian : [] as $w){  
          
    if ($s['id_tahun_penilaian_aktif']==$w['id_tahun_penilaian']){
    echo "<option value=\"$w[id_tahun_penilaian]\" selected>$w[nama_tahun_penilaian]</option>";
    }
    else{
    echo "<option value=\"$w[id_tahun_penilaian]\">$w[nama_tahun_penilaian]</option>";
    }
    }

      echo "</select></td>
    <td class='hidden-480'><input type='submit' class='btn btn-minier btn-danger' name='btnrekap' value='Rekaptulasi' /></form></td>  
    
    </tr>";
    $no++;
    }
    echo "</tbody>
    </table>
	
   </div>
    </div>
    </div>
    </div><!-- /.span -->
    </div>";
    break;
	
	//rekap transaksi
	case "rekap-transaksi":
	// Pilih tabel di database
	 $decrypted_txt = $db->encrypt_decrypt('decrypt', $_GET['id']);
	 $decrypted_txt2 = $db->encrypt_decrypt('decrypt', $_GET['s']);
	$s  = $db->getRows('karyawan',array('where'=>array('id_karyawan'=>$decrypted_txt),'return_type'=>'single'));
	$t  = $db->getRows('tahun_penilaian',array('where'=>array('id_tahun_penilaian'=>$decrypted_txt2),'return_type'=>'single'));
	echo" <div class='row'>
    <div class='col-xs-12'>
    <div class='widget-box'>
    <div class='widget-header'>
    <h4 class='widget-title'>Form Penilaian : $s[nama_karyawan] # $t[nama_tahun_penilaian]</h4>
    <div class='widget-toolbar'>
    <a href='#' data-action='collapse'>
    <i class='ace-icon fa fa-chevron-up'></i>
    </a>
    </div>
    </div>
    <div class='widget-body'>
    <div class='widget-main'>

  	<div class='row'>";
	$sum=0;
    //$transaksi = $db->GetDataTransaksi($decrypted_txt,$decrypted_txt2);
	$kategori = $db->getRows('kategori',array('order_by'=>'id_kategori DESC'));
    // Tampilkan data tabel yang dipilih
	$row  = $db->getRows('transaksi',array('where'=>array('id_karyawan'=>$decrypted_txt,'id_tahun_penilaian'=>$decrypted_txt2),'return_type'=>'count'));
	if ($row >0){ 
	$no=1;
	echo"<form method='POST' action='$aksi?halamane=transaksi&act=update'>";
	echo"<input type='hidden' name='id_karyawan' value='$decrypted_txt'/>";
	echo"<input type='hidden' name='id_tahun_penilaian' value='$decrypted_txt2'/>";
	echo"<table border='1' class='table table-bordered'>
	<tr>
    <th height='50'>NO</th>
    <th class='center'>KRITERIA KINERJA</th>
    <th>Rating</th>
    <th class='center'>Average Rating</th>
    <th class='center'>Bobot  (%)</th>
    <th class='center'>Score  / Skor </th>
    <th class='center'> Catatan khusus (wajib  diisi utk nilai 5,4,2,1, NA)</th></tr>";
    foreach($kategori ? $kategori : [] as $kategori){ extract($kategori);
	//$encrypt_txt = $db->encrypt_decrypt('encrypt', $r['id_transaksi']);
	$count  = $db->getRows('kompetensi',array('where'=>array('id_kategori'=>$id_kategori),'return_type'=>'count'));
	$count=$count+1;
	//get average nilai
	$average  = $db->GetAverage($decrypted_txt,$id_kategori,$decrypted_txt2);
	$score=$average*$bobot;
	//$sum = isset($sum) ? $sum : ''; 
	
	$sum+= $score;
	
	echo"<tr>
    <td rowspan='$count' class='center'>$no</td>
    <td bgcolor='#F5F5F5'>$nama_kategori</td>
    <td bgcolor='#F5F5F5'></td>
    <td rowspan='$count' class='center'>".round($average,2)."</td>
    <td rowspan='$count' class='center'>$bobot</td>
    <td rowspan='$count' class='center'>".round($score,2)."</td>
    <td rowspan='$count'></td>
	</tr>";
	
	
	$kompetensi = $db->getRows('kompetensi',array('where'=>array('id_kategori'=>$id_kategori)));
	foreach($kompetensi ? $kompetensi : [] as $kompetensi){ extract($kompetensi);
	echo"<input type='hidden' name='kompetensi[]' value='$id_kompetensi'/>";
	$s=$db->getRows('transaksi',array('where'=>array('id_karyawan'=>$decrypted_txt,'id_tahun_penilaian'=>$decrypted_txt2,'id_kompetensi'=>$id_kompetensi),'return_type'=>'single'));
	echo"<tr>
    <td>$nama_kompetensi</td>
    <td><select name='rating[]' class='input-sm' required='required' onChange='this.form.submit()'>";
	if ($id_tahun_ajaran==0){
    echo "<option value='' selected>0</option>";
    }  
    // Pilih tabel di database
    $rating = $db->getRows('rating',array('order_by'=>'id_rating ASC'));
    // Tampilkan data tabel yang dipilih
    foreach($rating ? $rating : [] as $w){  
          
    if ($s['rating']==$w['nilai_rating']){
    echo "<option value=\"$w[nilai_rating]\" selected>$w[nilai_rating]</option>";
    }else{
    echo "<option value=\"$w[nilai_rating]\">$w[nilai_rating]</option>";}
    }

      echo "</select></td>
	</tr>";  
	} //kompetensi masing kategori
  
  	
	$no++;
	} //kategori
	
	//get average nilai
	//$average  = $db->GetSum();
	echo"<tr>
    <th colspan='4'>TOTAL SCORE</th>
    <th class='center'>".$db->GetSum()."</th>
    <th class='center'>".round($sum,2)."</th>
    <th class='center'></th></tr>";
	echo"</table>";
	echo'</form>';
	
	} else {
	echo"<div class='col-xs-12 col-sm-12 pricing-box'><p>Maaf belum ada rekaptulasi transaksi di periode yang dipilih</p></div>";
	}
	
  	
  	echo"</div>
  	</div><!-- PAGE CONTENT ENDS -->
	
	</div>
    </div>
    </div>
    </div><!-- /.span -->
    </div>";
	
	
	
	break;
	
	//form mutasi tahun ajaran
    case "mutasi":
	//$SqlQuery1 = $db->TruncateTable('mutasi_temp');
	//$SqlQuery2 = $db->insert_temp_mutasi();
	 echo" <div class='row'>
    <div class='col-xs-12'>
    <div class='widget-box'>
    <div class='widget-header'>
    <h4 class='widget-title'>Form Mutasi karyawan</h4>
    <div class='widget-toolbar'>
    <a href='#' data-action='collapse'>
    <i class='ace-icon fa fa-chevron-up'></i>
    </a>
    </div>
    </div>
    <div class='widget-body'>
    <div class='widget-main'>
	
	 <table id='dynamic-table1' class='table table-striped table-bordered table-hover'>
    <thead>
    <tr>
    <th width='5%'>No</th>
    <th>Kode karyawan</th>
    <th>Nama karyawan</th>
    <th>Alamat</th>
    <th>Tahun Ajaran</th>
    </tr>
    </thead>
    <tbody>"; 
    
	$no=1;
    // Pilih tabel di database
    $karyawan = $db->getRows('karyawan',array('order_by'=>'id_karyawan DESC'));
    // Tampilkan data tabel yang dipilih
    foreach($karyawan ? $karyawan : [] as $r){
    echo "<tr>
    <td><center>$no</center></td>
    <td>$r[id_karyawan]</td>
    <td>$r[nama_karyawan]</td>
    <td>$r[alamat]</td>              
    <td><form method=\"POST\" action='$aksi?halamane=transaksi&act=mutasi'>
	<input type='hidden' name='id_karyawan' value='$r[id_karyawan]'/>";
	//Tampilkan tahun ajaran
	$no=1;
	//$mutasi_temp = $db->getRows('mutasi_temp',array('where'=>array('id_karyawan'=>$r['id_karyawan'])),array('order_by'=>'id_tahun_penilaian ASC'));
	$tahun_penilaian = $db->getRows('tahun_penilaian',array('order_by'=>'id_tahun_penilaian ASC'));
    foreach($tahun_penilaian ? $tahun_penilaian : [] as $t){
	$px  = $db->getRows('mutasi',array('where'=>array('id_tahun_penilaian'=>$t['id_tahun_penilaian'],'id_karyawan'=>$r['id_karyawan']),'return_type'=>'count'));
	if ($px >0){
	echo"<input name='id_tahun_penilaian[]' type='checkbox' class='ace' disabled='' checked/><span class='lbl'> $t[nama_tahun_penilaian]</span>";	
	} else {
	echo"<input name='id_tahun_penilaian[]' type='checkbox' class='ace' onchange='this.form.submit()' value='$t[id_tahun_penilaian]'/><span class='lbl'> $t[nama_tahun_penilaian]</span>";
	}
	
	
	}
	echo"</form></td>              
    </tr>";
    $no++;
    }
    echo "</tbody>
	
    </table>
	
	</div>
    </div>
    </div>
    </div><!-- /.span -->
    </div>";
      
	break;
 
	
  }
}    
?>
