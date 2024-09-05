<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
$db = new DB();
?>
  
  <div class="row">
  <div class="col-sm-6">
  <div class="widget-box">
  <div class="widget-header">
  <h4 class="widget-title">REKAP DATA TRANSAKSI</h4>

  <span class="widget-toolbar">
  <a href="#" data-action="collapse">
  <i class="ace-icon fa fa-chevron-up"></i>
  </a>
  </span>
  </div>

  <div class="widget-body">
  <div class="widget-main">
  <form method="POST" action="report-transaksi-view" target="_blank">
 

  <label for="timepicker1">Pilih Tahun</label>
  <div class="input-group col-sm-10">
  <select name='tahun' class='form-control' data-placeholder='Click to Choose...' required='required'>
<?php
 $tahun_penilaian = $db->getRows('tahun_penilaian',array('order_by'=>'id_tahun_penilaian DESC'));
    // Tampilkan data tabel yang dipilih
    foreach($tahun_penilaian ? $tahun_penilaian : [] as $r){ extract($r);
		echo"<option value='$id_tahun_penilaian'>$nama_tahun_penilaian</option>";
	}
 ?>
  </select>
 
  </div>
  <hr />
							
						
  <div class='clearfix form-actions'>
  <div class='col-md-offset-4 col-md-6'>
  <button class='btn btn-info' type='submit'>
  <i class='ace-icon fa fa-check bigger-110'></i>
  Submit
  </button>
  </div>
  </div>

   </form>
   
  </div>
  </div>
  </div>
  </div>

  

  
  </div>

  

<?php
  
}
?>
