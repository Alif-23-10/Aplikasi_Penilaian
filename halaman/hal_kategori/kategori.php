<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
   // Initialing koneksi database
  $db = new DB();
  $aksi = "halaman/hal_kategori/aksi_kategori.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil kategori
    default:
    echo"<div class='row'>
    <div class='col-xs-12'>
    <div class='widget-box'>
    <div class='widget-header'>
    <h4 class='widget-title'>".str_replace("_"," ",strtoupper("form data $_GET[halamane]"))."</h4>
    <div class='widget-toolbar'>
	<button class='btn btn-minier btn-success' onclick=window.location.href=\"add-$_GET[halamane]\"><i class='ace-icon glyphicon glyphicon-plus'></i>Add Data</button>
    <a href='#' data-action='collapse'><i class='ace-icon fa fa-chevron-up'></i></a>
	     
    </div>
    </div>
    <div class='widget-body'>
    <div class='widget-main'>";

    echo"<table id='dynamic-table1' class='table table-striped table-bordered table-hover'>
    <thead>
    <tr>
    <th width='5%'>No</th>
    <th>Kode Kategori</th>
    <th>Kategori</th>
    <th>Weighted/ Bobot  (%)</th>
    <th></th>
    </tr>
    </thead>
    <tbody>"; 
    
	$no=1;
    // Pilih tabel di database
    $kategori = $db->getRows('kategori',array('order_by'=>'id_kategori DESC'));
    // Tampilkan data tabel yang dipilih
    foreach($kategori ? $kategori : [] as $r){
	$encrypted_txt = $db->encrypt_decrypt('encrypt', $r['id_kategori']);
    
    echo "<tr>
    <td><center>$no</center></td>
    <td>$r[id_kategori]</td>
    <td>$r[nama_kategori]</td>                               
    <td>$r[bobot]</td>                               
                   
    <td>
	<center>
    <div class='hidden-sm hidden-xs action-buttons'>                              
    <a class='green' href='edit-kategori-$encrypted_txt'><i class='ace-icon fa fa-pencil bigger-130'></i></a>
	<a onclick=\"return confirm('Are sure want to delete this data ??')\" class='red' href='hapus-kategori-$encrypted_txt'>
    <i class='ace-icon fa fa-trash-o bigger-130'></i></a>
    </div>

    <div class='hidden-md hidden-lg'>
    <div class='inline pos-rel'>
    <button class='btn btn-minier btn-yellow dropdown-toggle' data-toggle='dropdown' data-position='auto'>
    <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
    </button>
	
    <ul class='dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close'>
    
	<li><a href='edit-kategori-$encrypted_txt' class='tooltip-success' data-rel='tooltip' title='Edit'>
    <span class='green'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>
    </li>
	
	<li><a onclick=\"return confirm('Are sure want to delete this data ??')\" href='hapus-kategori-$encrypted_txt' class='tooltip-error' data-rel='tooltip' title='Delete'>
    <span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
    </li>
    
	</ul>
    </div>
    </div>
	</center>
    </td>
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
	
	//form tambah data
    case "tambahkategori":
     
    echo" <div class='row'>
    <div class='col-xs-12'>
    <div class='widget-box'>
    <div class='widget-header'>
    <h4 class='widget-title'>".str_replace("_"," ",strtoupper("form Tambah Data $_GET[halamane]"))."</h4>

    <div class='widget-toolbar'>
    <a href='#' data-action='collapse'>
    <i class='ace-icon fa fa-chevron-up'></i>
    </a>
    </div>
    </div>

    <div class='widget-body'>
    <div class='widget-main'>
    <form class='form-horizontal' method=\"POST\" action=\"$aksi?halamane=kategori&act=input\">

   
    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='name'>Kategori:</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='name' name='nama_kategori' class='input-sm col-xs-12 col-sm-8' required='required'/>
    </div>
    </div>
    </div>


	<div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='Bobot'>Weighted/ Bobot  (%):</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='bobot' name='bobot' class='input-sm col-xs-12 col-sm-8' required='required' maxlength='2'/>
    </div>
    </div>
    </div>
	
	
     
    <div class='form-actions'>
    <button class='btn btn-info' type='submit'>
    <i class='ace-icon fa fa-check bigger-110'></i>
    Submit
    </button>
	
	&nbsp; &nbsp; &nbsp;
    <button class='btn' type='reset' onclick=\"self.history.back()\">
    <i class='ace-icon fa fa-undo bigger-110'></i>
    Reset
    </button>
                               
    </div>
    </form>

    </div>
    </div>
    </div>
    </div><!-- /.span -->
    </div>";
      
    break;
    
	//form ubah data
    case "editkategori":
	//ambil data yang akan di edit
	$decrypted_txt = $db->encrypt_decrypt('decrypt', $_GET['id']);
    $r  = $db->getRows('kategori',array('where'=>array('id_kategori'=>$decrypted_txt),'return_type'=>'single'));
    
	echo" <div class='row'>
    <div class='col-xs-12'>
    <div class='widget-box'>
    <div class='widget-header'>
    <h4 class='widget-title'>".str_replace("_"," ",strtoupper("form Ubah Data $_GET[halamane]"))."</h4>
	
	<div class='widget-toolbar'>
    <a href='#' data-action='collapse'>
    <i class='ace-icon fa fa-chevron-up'></i>
    </a>
    </div>
    </div>

    <div class='widget-body'>
    <div class='widget-main'>
    <form class='form-horizontal' method=\"POST\" action=\"$aksi?halamane=kategori&act=update\">
                            
    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='phone'>Kode kategori:</label>

    <div class='col-xs-12 col-sm-9'>
    <div class='input-group'>
    <span class='input-group-addon'>
    <i class='ace-icon fa fa-key'></i>
    </span>
	
    <input type=\"text\" name=\"id_kategori\" required='required' value='$decrypted_txt' readonly='yes' class='input-sm'>
    </div>
    </div>
    </div>


	<div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='name'>Kategori:</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='name' name='nama_kategori' class='input-sm col-xs-12 col-sm-8' required='required' value='$r[nama_kategori]'/>
    </div>
    </div>
    </div>
	
	<div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='Bobot'>Weighted/ Bobot  (%):</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='bobot' name='bobot' class='input-sm col-xs-12 col-sm-8' required='required' value='$r[bobot]' maxlength='2'/>
    </div>
    </div>
    </div>

               

	<div class='form-actions'>
    <button class='btn btn-info' type='submit'>
    <i class='ace-icon fa fa-check bigger-110'></i>
    Submit
    </button>

    &nbsp; &nbsp; &nbsp;
    
	<button class='btn' type='reset' onclick=\"self.history.back()\">
    <i class='ace-icon fa fa-undo bigger-110'></i>
    Reset
    </button>
                               
    </div>
	</form>


                            
    </div>
    </div>
    </div>
    </div><!-- /.span -->
    </div>";
      
    break;  
  }
}    
?>
