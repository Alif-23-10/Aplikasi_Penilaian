<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
   // Initialing koneksi database
  $db = new DB();
  $aksi = "halaman/hal_rating/aksi_rating.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil rating
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
    <th width='5%' class='center'>No</th>
    <th class='center'>Kode Rating</th>
    <th class='center'>Rating</th>
    <th class='center'>Keterangan</th>
    <th></th>
    </tr>
    </thead>
    <tbody>"; 
    
	$no=1;
    // Pilih tabel di database
    $rating = $db->getRows('rating',array('order_by'=>'id_rating DESC'));
    // Tampilkan data tabel yang dipilih
    foreach($rating ? $rating : [] as $r){
	$encrypted_txt = $db->encrypt_decrypt('encrypt', $r['id_rating']);
    
    echo "<tr>
    <td><center>$no</center></td>
    <td class='center'>$r[id_rating]</td>
    <td class='center'>$r[nilai_rating]</td>
    <td>$r[keterangan]</td>                                  
                   
    <td>
	<center>
    <div class='hidden-sm hidden-xs action-buttons'>                              
    <a class='green' href='edit-rating-$encrypted_txt'><i class='ace-icon fa fa-pencil bigger-130'></i></a>
	<a onclick=\"return confirm('Are sure want to delete this data ??')\" class='red' href='hapus-rating-$encrypted_txt'>
    <i class='ace-icon fa fa-trash-o bigger-130'></i></a>
    </div>

    <div class='hidden-md hidden-lg'>
    <div class='inline pos-rel'>
    <button class='btn btn-minier btn-yellow dropdown-toggle' data-toggle='dropdown' data-position='auto'>
    <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
    </button>
	
    <ul class='dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close'>
    
	<li><a href='edit-rating-$encrypted_txt' class='tooltip-success' data-rel='tooltip' title='Edit'>
    <span class='green'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>
    </li>
	
	<li><a onclick=\"return confirm('Are sure want to delete this data ??')\" href='hapus-rating-$encrypted_txt' class='tooltip-error' data-rel='tooltip' title='Delete'>
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
    case "tambahrating":
     
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
    <form class='form-horizontal' method=\"POST\" action=\"$aksi?halamane=rating&act=input\">

   
    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='name'>Rating:</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='name' name='nilai_rating' class='input-sm col-xs-12 col-sm-8' required='required' maxlength='2'/>
    </div>
    </div>
    </div>


    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='name'>Keterangan :</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='keterangan' name='keterangan' class='input-sm col-xs-12 col-sm-8' required='required' maxlength='50'/>
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
    case "editrating":
	//ambil data yang akan di edit
	$decrypted_txt = $db->encrypt_decrypt('decrypt', $_GET['id']);
    $r  = $db->getRows('rating',array('where'=>array('id_rating'=>$decrypted_txt),'return_type'=>'single'));
    
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
    <form class='form-horizontal' method=\"POST\" action=\"$aksi?halamane=rating&act=update\">
                            
    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='phone'>Kode rating:</label>

    <div class='col-xs-12 col-sm-9'>
    <div class='input-group'>
    <span class='input-group-addon'>
    <i class='ace-icon fa fa-key'></i>
    </span>
	
    <input type=\"text\" name=\"id_rating\" required='required' value='$decrypted_txt' readonly='yes' class='input-sm'>
    </div>
    </div>
    </div>


	<div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='name'>Rating:</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='name' name='nilai_rating' class='input-sm col-xs-12 col-sm-8' required='required' value='$r[nilai_rating]' maxlength='2'/>
    </div>
    </div>
    </div>


    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='name'>keterangan :</label>
    <div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='keterangan' name='keterangan' class='input-sm col-xs-12 col-sm-8' required='required' maxlength='50' value='$r[keterangan]'/>
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
