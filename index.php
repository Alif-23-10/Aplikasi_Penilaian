	<!DOCTYPE html>
	<html lang="en">
	<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Login System</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-part2.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
	</head>

	<body class="login-layout blur-login">
    <div class="main-container">
    <div class="main-content">
    <div class="row">
    <div class="col-sm-10 col-sm-offset-1">
    <div class="login-container">
    <div class="center">
    <h2>
    <i class="ace-icon fa fa-money blue"></i>
    <span class="red">SIXGHA</span>
    <span class="white" id="id-text2"> KREASI</span>
    </h2>
    <?php
    // mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['id']) ? $_GET['id'] : ''; 
    if($act=='error'){
    echo"<div class='alert alert-danger hidden-sm hidden-xs'>
    <button type='button' class='close' data-dismiss='alert'>
    <i class='ace-icon fa fa-times'></i>
    </button>
     Login Gagal! Username & Password salah.
    </div>";
    }

    ?>
    </div>

    <div class="space-6"></div>

    <div class="position-relative">
    <div id="login-box" class="login-box visible widget-box no-border">
    <div class="widget-body">
    <div class="widget-main">
    <h4 class="header blue lighter bigger">
    <i class="ace-icon fa fa-key green"></i>
    Masuk Dengan Akun Anda
    </h4>

    <div class="space-6"></div>

    <form id="login" name="login" method="POST" action="login"> 
    <fieldset>
    <label class="block clearfix">
    <span class="block input-icon input-icon-right">
    <input type="text" class="form-control" placeholder="Username" name="username" required="required"/>
    <i class="ace-icon fa fa-user"></i>
    </span>
    </label>

    <label class="block clearfix">
    <span class="block input-icon input-icon-right">
    <input type="password" class="form-control" placeholder="Password" name="password" id="password" required="required"/>
    <i class="ace-icon fa fa-lock"></i>
    </span>
    </label>

    <div class="space"></div>

    <div class="clearfix">
    <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
    <i class="ace-icon fa fa-key"></i>
    <span class="bigger-110">Login</span>
    </button>
    </div>

    <div class="space-4"></div>
    </fieldset>
    </form>

    

    
    </div><!-- /.widget-main -->

    <div class="toolbar clearfix">
    <center>
    <div>
    <a class="forgot-password-link">
     <?php print date('Y');?> &copy; <a class="white" href='https://goo.gl/qLz5V4' target='_blank'>www.sixghakreasi.com</a>
    </a>
    </div>
    </center>

     
    </div>
    </div><!-- /.widget-body -->
    </div><!-- /.login-box -->

    

    
    </div><!-- /.position-relative -->

    
    </div>
    </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.main-content -->
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

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
    jQuery(function($) {
     $(document).on('click', '.toolbar a[data-target]', function(e) {
    e.preventDefault();
    var target = $(this).data('target');
    $('.widget-box.visible').removeClass('visible');//hide others
    $(target).addClass('visible');//show target
     });
    });
    
    
    
    //you don't need this, just used for changing background
    jQuery(function($) {
     $('#btn-login-dark').on('click', function(e) {
    $('body').attr('class', 'login-layout');
    $('#id-text2').attr('class', 'white');
    $('#id-company-text').attr('class', 'blue');
    
    e.preventDefault();
     });
     $('#btn-login-light').on('click', function(e) {
    $('body').attr('class', 'login-layout light-login');
    $('#id-text2').attr('class', 'grey');
    $('#id-company-text').attr('class', 'blue');
    
    e.preventDefault();
     });
     $('#btn-login-blur').on('click', function(e) {
    $('body').attr('class', 'login-layout blur-login');
    $('#id-text2').attr('class', 'white');
    $('#id-company-text').attr('class', 'light-blue');
    
    e.preventDefault();
     });
     
    });
    </script>
	</body>
	</html>
