<?php
	//halaman home view
    if ($_GET['halamane']=='home'){ 
    $h_active="active";
    } 
    //halaman user view
	if ($_GET['halamane']=='user'){ 
    $master_active_open="active open";
    $master_user_active="active";
    }
	
	
	 //halaman karyawan view
	if ($_GET['halamane']=='karyawan'){ 
    $master_active_open="active open";
    $master_karyawan_active="active";
    }
	
	 //halaman kategori view
	if ($_GET['halamane']=='kategori'){ 
    $master_active_open="active open";
    $master_kategori_active="active";
    }
	
	 //halaman kompetensi view
	if ($_GET['halamane']=='kompetensi'){ 
    $master_active_open="active open";
    $master_kompetensi_active="active";
    }
	
	//halaman performance_rating view
	if ($_GET['halamane']=='rating'){ 
    $master_active_open="active open";
    $master_rating_active="active";
    }
	
	 //halaman tahun_penilaian view
	if ($_GET['halamane']=='tahun_penilaian'){ 
    $master_active_open="active open";
    $master_tahun_penilaian_active="active";
    }
	
	 //halaman transaksi view
	if ($_GET['halamane']=='transaksi' AND $act==''){ 
    $transaksi_active_open="active open";
    $transaksi_transaksi_active="active";
    }
	
	 //halaman rekap transaksi
	if ($_GET['halamane']=='transaksi' AND $act=='rekap-transaksi'){ 
    $transaksi_active_open="active open";
    $transaksi_transaksi_active="active";
    }
	
	 //halaman add transaksi
	if ($_GET['halamane']=='transaksi' AND $act=='tambahtransaksi'){ 
    $transaksi_active_open="active open";
    $transaksi_transaksi_active="active";
    }
	
		 //halaman mutasi view
	if ($_GET['halamane']=='transaksi' AND $act=='mutasi'){ 
    $transaksi_active_open="active open";
    $transaksi_mutasi_active="active";
    }
	
	 //halaman Laporan view
	if ($_GET['halamane']=='report'){ 
    $laporan_active_open="active open";
    $laporan_laporan_active="active";
    }
	
	
	

?>