<?php
//error_reporting(0);
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta charset="utf-8" />
  <title> Administrator </title>

  <meta name="description" content="Static &amp; Dynamic Tables" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

  <!-- bootstrap & fontawesome -->
  <link rel="stylesheet" href="assets/css/bootstrap.css" />
  <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

  <!-- page specific plugin styles -->
  <link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
  <link rel="stylesheet" href="assets/css/chosen.min.css" />
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />

  <!-- text fonts -->
  <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

  <!-- ace styles -->
  <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

  <!--[if lte IE 9]>
  <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
  <![endif]-->
  <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
  <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

  <!--[if lte IE 9]>
  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
  <![endif]-->

  <!-- inline styles related to this page -->

  <!-- ace settings handler -->
  <script src="assets/js/ace-extra.min.js"></script>

  <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

  <!--[if lte IE 8]>
  <script src="assets/js/html5shiv.min.js"></script>
  <script src="assets/js/respond.min.js"></script>
  <![endif]-->

  </head>

  <body class="no-skin">

  <div id="navbar" class="navbar navbar-default ace-save-state">
  <div class="navbar-container ace-save-state" id="navbar-container">
  <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
  <span class="sr-only">Toggle sidebar</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  </button>

  <div class="navbar-header pull-left">
  <a href="?halamane=beranda" class="navbar-brand"><small><?php print "".strtoupper("PERFORMANCE APPRAISAL")."";?></small></a>
  </div>

  <div class="navbar-buttons navbar-header pull-right" role="navigation">
  <ul class="nav ace-nav">
  
  

  <li class="light-blue dropdown-modal">
  <a data-toggle="dropdown" href="#" class="dropdown-toggle">
  <img class="nav-user-photo" src="assets/images/avatars/avatar2.png" alt="Jason's Photo" />
  <span class="user-info">
  <small>Welcome,</small>
  <?php echo"$_SESSION[namauser]"; ?>
  </span>
  <i class="ace-icon fa fa-caret-down"></i>
  </a>

  <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
  <li><a href="#"><i class="ace-icon fa fa-user"></i>Profile</a></li>
  <li class="divider"></li>
  <li><a href="logout"><i class="ace-icon fa fa-power-off"></i>Logout</a></li>
  </ul>
  </li>

  </ul>
  </div>
  </div><!-- /.navbar-container -->
  </div>

  <!-- start .nav-list -->

  <div class="main-container ace-save-state" id="main-container">
  <script type="text/javascript">
  try{ace.settings.loadState('main-container')}catch(e){}
  </script>

  <div id="sidebar" class="sidebar responsive ace-save-state">
  <script type="text/javascript">
  try{ace.settings.loadState('sidebar')}catch(e){}
  </script>

  <!-- \.nav-list -->
  <ul class="nav nav-list">
  <?php include "menu/menu_active.php";?>
  
  <!--LEVEL ADMIN-->
  <?php  
  if ($_SESSION['leveluser']=='admin'){include "menu/menu_admin.php";} 
  //Jika level ada user
  else {include "menu/menu_user.php";}   
  ?> 
  
  </ul>
  <!-- /.nav-list -->

  <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
  <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
  </div>
  </div>

  <!--isi dari halaman conten -->
  <div class="main-content">
  <div class="main-content-inner">
  <div class="breadcrumbs ace-save-state" id="breadcrumbs">
  
  <ul class="breadcrumb">
  <li><i class="ace-icon fa fa-home home-icon"></i><a href="home">Home</a></li>
  <li><a href="#"><?php echo"".strtoupper($_GET['halamane'])."";?></a></li>
  <li class="active">
  <?php if ($act==''){ echo"View Data";}
  else{echo"$act";}
  ?></li>
  </ul><!-- /.breadcrumb -->

  <!--<div class="nav-search" id="nav-search">
  <form class="form-search">
  <span class="input-icon">
  <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
  <i class="ace-icon fa fa-search nav-search-icon"></i>
  </span>
  </form>
  </div><!-- /.nav-search -->
  </div>

  <div class="page-content">
  <div class="ace-settings-container" id="ace-settings-container">
  <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
  <i class="ace-icon fa fa-cog bigger-130"></i>
  </div>

  <div class="ace-settings-box clearfix" id="ace-settings-box">
  <div class="pull-left width-50">
  

  <div class="ace-settings-item">
  <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
  <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
  </div>

  <div class="ace-settings-item">
  <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
  <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
  </div>

  <div class="ace-settings-item">
  <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
  <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
  </div>

  
  </div><!-- /.pull-left -->

  </div><!-- /.ace-settings-box -->
  </div><!-- /.ace-settings-container -->

  <div class="page-header">
  
  </div><!-- /.page-header -->

  <div class="row">
  <div class="col-xs-12">
  <!-- PAGE CONTENT BEGINS -->
  
  <?php include "content.php"; ?>

  <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
  </div><!-- /.row -->
  </div><!-- /.page-content -->
  </div>
  </div><!-- /.main-content -->
  <!--Akhir isi dari halaman conten -->

  <div class="footer">
  <div class="footer-inner">
  <div class="footer-content">
  <span class="bigger-120">
  <span class="blue bolder"><?php print date('Y');?> &copy; <a href='https://goo.gl/qLz5V4' target='_blank'>www.sixghakreasi.com</a></span> 
  </span>

  </div>
  </div>
  </div>

  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
  <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
  </a>
  </div><!-- /.main-container -->

  <!-- basic scripts -->

  <!--[if !IE]> -->
  <script src="assets/js/jquery-2.1.4.min.js"></script>

  <!-- <![endif]-->

  <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
  <script type="text/javascript">
  if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
  </script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- page specific plugin scripts -->
  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
  <script src="assets/js/dataTables.buttons.min.js"></script>
  <script src="assets/js/buttons.flash.min.js"></script>
  <script src="assets/js/buttons.html5.min.js"></script>
  <script src="assets/js/buttons.print.min.js"></script>
  <script src="assets/js/buttons.colVis.min.js"></script>
  <script src="assets/js/dataTables.select.min.js"></script>

  <!-- ace scripts -->
  <script src="assets/js/ace-elements.min.js"></script>
  <script src="assets/js/ace.min.js"></script>



  <script src="assets/js/jquery-ui.custom.min.js"></script>
  <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
  <script src="assets/js/chosen.jquery.min.js"></script>
  <script src="assets/js/bootstrap-datepicker.min.js"></script>
  <script src="assets/js/spinbox.min.js"></script>
  
  <script src="assets/js/bootstrap-timepicker.min.js"></script>
  <script src="assets/js/moment.min.js"></script>
  <script src="assets/js/daterangepicker.min.js"></script>
  <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
  <script src="assets/js/bootstrap-colorpicker.min.js"></script>
  <script src="assets/js/jquery.knob.min.js"></script>
  <script src="assets/js/autosize.min.js"></script>
  <script src="assets/js/jquery.inputlimiter.min.js"></script>
  <script src="assets/js/jquery.maskedinput.min.js"></script>
  <script src="assets/js/bootstrap-tag.min.js"></script>

  <script>
  $(function () {
  $("#dynamic-table1").DataTable();
  });

  //datepicker plugin
  //link
  $('.date-picker').datepicker({
  autoclose: true,
  todayHighlight: true
  })
  //show datepicker when clicking on the icon
  .next().on(ace.click_event, function(){
  $(this).prev().focus();
  });

  if(!ace.vars['touch']) {
  $('.chosen-select').chosen({
  allow_single_deselect:true
  

  }); 
  //resize the chosen on window resize
  
  $(window)
  .off('resize.chosen')
  .on('resize.chosen', function() {
  $('.chosen-select').each(function() {
  var $this = $(this);
  $this.next().css({'width': $this.parent().width()});
  })
  }).trigger('resize.chosen');
  //resize chosen on sidebar collapse/expand
  $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
  if(event_name != 'sidebar_collapsed') return;
  $('.chosen-select').each(function() {
  var $this = $(this);
  $this.next().css({'width': $this.parent().width()});
  })
  });
  
  
  $('#chosen-multiple-style .btn').on('click', function(e){
  var target = $(this).find('input[type=radio]');
  var which = parseInt(target.val());
  if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
  else $('#form-field-select-4').removeClass('tag-input-style');
  });

  /////////
  $('#modal-form input[type=file]').ace_file_input({
  style:'well',
  btn_choose:'Drop files here or click to choose',
  btn_change:null,
  no_icon:'ace-icon fa fa-cloud-upload',
  droppable:true,
  thumbnail:'large'
  });
   
   /////////Custom File Input
   $('#id-input-file-1 , #id-input-file-2').ace_file_input({
       no_file:'No File ...',
       btn_choose:'Choose',
       btn_change:'Change',
       droppable:false,
       onchange:null,
       thumbnail:false //| true | large
       //whitelist:'gif|png|jpg|jpeg'
       //blacklist:'exe|php'
       //onchange:''
       //
      });
      
  }
   
</script>
  </body>
</html>

<?php } ?>
