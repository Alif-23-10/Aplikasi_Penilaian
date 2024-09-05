<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
 // Initialing koneksi database
  $db = new DB();
?>

    <div class="row">
	<div class='col-xs-12'>
    <div class="alert alert-block alert-success">
    <button type="button" class="close" data-dismiss="alert">
    <i class="ace-icon fa fa-times"></i>
    </button>
	
	<p><strong>
			
    <span class="black"><script language=JavaScript>var d = new Date();
    var hour = d.getHours();
    if (hour < 11) { document.write('Selamat pagi <?php echo $_SESSION['namauser']; ?>,'); }
    else { if (hour < 15) { document.write('Selamat siang <?php echo $_SESSION['namauser']; ?>,'); }
    else { if (hour < 19) { document.write('Selamat sore <?php echo $_SESSION['namauser']; ?>,'); }
    else { if (hour <= 23) { document.write('Selamat malam <?php echo $_SESSION['namauser']; ?>,'); }
    }}}</script></span></strong>
	Silahkan pilih menu yang tersedia untuk mengelola konten ini
	</p>
	
	<p>Download manual book pengguna sistem</p>
	<p><button class="btn btn-sm btn-success">Download</button></p>
    </div>
    </div>
    </div><!-- /.row -->
            

<?php } ?>
