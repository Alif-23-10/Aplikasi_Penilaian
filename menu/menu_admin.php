 <!--DASHBOARD-->
	<li class='<?php echo"$h_active"; ?>'><a href='home'><i class='menu-icon fa fa-home'></i><span class='menu-text'> Home </span></a><b class='arrow'></b></li>
  <!--MASTER-->
    <li class="<?php echo"$master_active_open"; ?>"><a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-database"></i><span class="menu-text"> Master </span><b class="arrow fa fa-angle-down"></b></a>
    <b class="arrow"></b>
    <ul class="submenu">
    <li class="<?php echo"$master_user_active"; ?>"><a href="user-view"><i class="menu-icon fa fa-caret-right"></i>User Account</a><b class="arrow"></b></li>
    <li class="<?php echo"$master_karyawan_active"; ?>"><a href="karyawan-view"><i class="menu-icon fa fa-caret-right"></i>Data karyawan</a><b class="arrow"></b></li>
    <li class="<?php echo"$master_tahun_penilaian_active"; ?>"><a href="tahun_penilaian-view"><i class="menu-icon fa fa-caret-right"></i>Tahun Penilaian</a><b class="arrow"></b></li>
    <li class="<?php echo"$master_kategori_active"; ?>"><a href="kategori-view"><i class="menu-icon fa fa-caret-right"></i>Kategori Kinerja</a><b class="arrow"></b></li>
    <li class="<?php echo"$master_kompetensi_active"; ?>"><a href="kompetensi-view"><i class="menu-icon fa fa-caret-right"></i>Kompetensi</a><b class="arrow"></b></li>
    <li class="<?php echo"$master_rating_active"; ?>"><a href="rating-view"><i class="menu-icon fa fa-caret-right"></i>Performance Rating</a><b class="arrow"></b></li>
         </ul>
    </li>
	
	<!--Transaksi-->
    <li class="<?php echo"$transaksi_active_open"; ?>"><a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-book"></i><span class="menu-text"> Transaksi </span><b class="arrow fa fa-angle-down"></b></a>
    <b class="arrow"></b>
    <ul class="submenu">
	<li class="<?php echo"$transaksi_mutasi_active"; ?>"><a href="mutasi-view"><i class="menu-icon fa fa-caret-right"></i>Mutasi</a><b class="arrow"></b></li>
	<li class="<?php echo"$transaksi_transaksi_active"; ?>"><a href="transaksi-view"><i class="menu-icon fa fa-caret-right"></i>Transaksi</a><b class="arrow"></b></li>
    </ul>
    </li>
	
	<!--Laporan-->
    <li class="<?php echo"$laporan_active_open"; ?>"><a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-bar-chart-o"></i><span class="menu-text"> Laporan </span><b class="arrow fa fa-angle-down"></b></a>
    <b class="arrow"></b>
    <ul class="submenu">
	<li class="<?php echo"$laporan_laporan_active"; ?>"><a href="report-transaksi"><i class="menu-icon fa fa-caret-right"></i>Laporan</a><b class="arrow"></b></li>
    </ul>
    </li>
  