<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
   // Initialing koneksi database
  $db = new DB();
  $aksi = "halaman/hal_user/aksi_user.php";

  // mengatasi variabel yang belum di definisikan (notice undefined index)
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 

  switch($act){
    // Tampil User
    default:
    echo"<div class='row'>
    <div class='col-xs-12'>
    <div class='widget-box'>
    <div class='widget-header'>
    <h4 class='widget-title'>".strtoupper("form data $_GET[halamane]")."</h4>
    <div class='widget-toolbar'>
	<button class='btn btn-minier btn-success' onclick=window.location.href=\"add-user\"><i class='ace-icon glyphicon glyphicon-plus'></i>Add Data</button>
    <a href='#' data-action='collapse'><i class='ace-icon fa fa-chevron-up'></i></a>
	     
    </div>
    </div>
    <div class='widget-body'>
    <div class='widget-main'>";

    echo"<table id='dynamic-table1' class='table table-striped table-bordered table-hover'>
    <thead>
    <tr>
    <th class='center'>No</th>
    <th>ID User</th>
    <th>Username</th>
    <th>Nama User</th>
    <th class='hidden-480'>Level</th>
    <th></th>
    </tr>
    </thead>
    <tbody>"; 
    
	$no=1;
    // Pilih tabel di database
    $user = $db->GetRowUser();
    // Tampilkan data tabel yang dipilih
    foreach($user ? $user : [] as $r){
	$encrypted_txt = $db->encrypt_decrypt('encrypt', $r['id_user']);
    extract($r);        
    echo "<tr>
    <td class='center'>$no</td>
    <td>$id_user</td>
    <td>$username</td>
    <td>$nama_user</td>
    <td class='hidden-480'>$level</td>
                           
    <td>
    <div class='hidden-sm hidden-xs action-buttons'>                              
    <a class='green' href='edit-user-$encrypted_txt'><i class='ace-icon fa fa-pencil bigger-130'></i></a>
	<a onclick=\"return confirm('Are sure want to delete this data ??')\" class='red' href='hapus-user-$encrypted_txt'>
    <i class='ace-icon fa fa-trash-o bigger-130'></i></a>
    </div>

    <div class='hidden-md hidden-lg'>
    <div class='inline pos-rel'>
    <button class='btn btn-minier btn-yellow dropdown-toggle' data-toggle='dropdown' data-position='auto'>
    <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
    </button>
	
    <ul class='dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close'>
    
	<li><a href='edit-user-$encrypted_txt' class='tooltip-success' data-rel='tooltip' title='Edit'>
    <span class='green'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></span></a>
    </li>
	
	<li><a onclick=\"return confirm('Are sure want to delete this data ??')\" href='hapus-user-$encrypted_txt' class='tooltip-error' data-rel='tooltip' title='Delete'>
    <span class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i></span></a>
    </li>
    
	</ul>
    </div>
    </div>
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
    case "tambahuser":
     
    echo" <div class='row'>
    <div class='col-xs-12'>
    <div class='widget-box'>
    <div class='widget-header'>
    <h4 class='widget-title'>".strtoupper("Form Tambah $_GET[halamane]")."</h4>

    <div class='widget-toolbar'>
    <a href='#' data-action='collapse'>
    <i class='ace-icon fa fa-chevron-up'></i>
    </a>
    </div>
    </div>

    <div class='widget-body'>
    <div class='widget-main'>
    <form class='form-horizontal' method=\"POST\" action=\"$aksi?halamane=user&act=input\">

    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='phone'>User ID:</label>

    <div class='col-xs-12 col-sm-9'>
    <div class='input-group'>
    <span class='input-group-addon'>
    <i class='ace-icon fa fa-key'></i>
    </span>

    <input type=\"text\" name=\"id_user\" required='required' value='NEW-DOC' readonly='yes' class='input-sm'>
    </div>
    </div>
    </div>



    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='name'>Nama User:</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='name' name='nama_user' class='input-sm col-xs-12 col-sm-8' required='required'/>
    </div>
    </div>
    </div>
	

    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='name'>Username :</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='username' name='username' class='input-sm col-xs-12 col-sm-8' required='required' maxlength='12'/>
    </div>
    </div>
    </div>
	

    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='password'>Password:</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='password' name='password' id='password' class='input-sm col-xs-12 col-sm-4' required='required'/>
    </div>
    </div>
    </div>


    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='state'>Level</label>

    <div class='col-xs-12 col-sm-9'>
    <select id='state' name='level' class='select2' data-placeholder='Click to Choose...' required='required'>
    <option value=\"0\" selected>- Pilih Level -</option>";
    // Pilih tabel di database
    $level = $db->GetRowLevel();
    // Tampilkan data tabel yang dipilih
    foreach($level ? $level : [] as $r){  
    echo "<option value='$r[level]'>$r[level]</option>";
    }
    echo "</select>
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
    case "edituser":
	//ambil data yang akan di edit
	$decrypted_txt = $db->encrypt_decrypt('decrypt', $_GET['id']);
    $r  = $db->getRows('user',array('where'=>array('id_user'=>$decrypted_txt),'return_type'=>'single'));
    
	echo"<div class='row'>
    <div class='col-xs-12'>
    <div class='widget-box'>
    <div class='widget-header'>
    <h4 class='widget-title'>".strtoupper("Form Ubah $_GET[halamane]")."</h4>
	
	<div class='widget-toolbar'>
    <a href='#' data-action='collapse'>
    <i class='ace-icon fa fa-chevron-up'></i>
    </a>
    </div>
    </div>

    <div class='widget-body'>
    <div class='widget-main'>
    <form class='form-horizontal' method=\"POST\" action=\"$aksi?halamane=user&act=update\">
                            
    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='phone'>User ID:</label>

    <div class='col-xs-12 col-sm-9'>
    <div class='input-group'>
    <span class='input-group-addon'>
    <i class='ace-icon fa fa-key'></i>
    </span>
	
    <input type=\"text\" name=\"id_user\" required='required' value='$decrypted_txt' readonly='yes' class='input-sm'>
    </div>
    </div>
    </div>


	<div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='name'>Nama User:</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='name' name='nama_user' class='input-sm col-xs-12 col-sm-8' required='required' value='$r[nama_user]'/>
    </div>
    </div>
    </div>


    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='name'>Username :</label>
    <div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='text' id='username' name='username' class='input-sm col-xs-12 col-sm-8' required='required' maxlength='12' value='$r[username]'/>
    </div>
    </div>
    </div>



    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='password'>Password:</label>
	<div class='col-xs-12 col-sm-9'>
    <div class='clearfix'>
    <input type='password' name='password' id='password' class='input-sm col-xs-12 col-sm-4' required='required' value='$r[password]'/>
    </div>
    </div>
    </div>
                          

    <div class='form-group'>
    <label class='control-label col-xs-12 col-sm-3 no-padding-right' for='state'>State</label>
    <div class='col-xs-12 col-sm-9'>
    <select id='state' name='level' class='select2' data-placeholder='Click to Choose...' required='required'>"; 
    if ($r['level']==0){
    echo "<option value=\"0\" selected>- Pilih Level -</option>";
    }   
    // Pilih tabel di database
    $level = $db->GetRowLevel();
    // Tampilkan data tabel yang dipilih
    foreach($level ? $level : [] as $w){  
          
    if ($r['level']==$w['level']){
    echo "<option value=\"$w[level]\" selected>$w[level]</option>";
    }
    else{
    echo "<option value=\"$w[level]\">$w[level]</option>";
    }
    }

    echo "</select>
    
	</div>
    </div>
	<div class='space-2'></div>

                             

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
