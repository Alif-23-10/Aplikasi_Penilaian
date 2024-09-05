<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session

else{
  include "config/koneksi.php";
  include "config/library.php";

 // Home (Beranda)
  if ($_GET['halamane']=='home'){ 
      include "halaman/hal_beranda/home.php"; 
  }

 // Error 404
  elseif ($_GET['halamane']=='error_404'){               
      include "halaman/hal_beranda/404.php";
    
  }


  // User
  elseif ($_GET['halamane']=='user'){
    if ($_SESSION['leveluser']=='admin'){
      include "halaman/hal_user/user.php";
    }
  }
  
  
  // karyawan
  elseif ($_GET['halamane']=='karyawan'){
    if ($_SESSION['leveluser']=='admin'){
      include "halaman/hal_karyawan/karyawan.php";
    }
  }
  
    // tahun_penilaian
  elseif ($_GET['halamane']=='tahun_penilaian'){
    if ($_SESSION['leveluser']=='admin'){
      include "halaman/hal_tahun_penilaian/tahun_penilaian.php";
    }
  }
  
  // kategori
  elseif ($_GET['halamane']=='kategori'){
    if ($_SESSION['leveluser']=='admin'){
      include "halaman/hal_kategori/kategori.php";
    }
  }
  
  // kompetensi
  elseif ($_GET['halamane']=='kompetensi'){
    if ($_SESSION['leveluser']=='admin'){
      include "halaman/hal_kompetensi/kompetensi.php";
    }
  }
  
    // kompetensi
  elseif ($_GET['halamane']=='rating'){
    if ($_SESSION['leveluser']=='admin'){
      include "halaman/hal_rating/rating.php";
    }
  }
     // transaksi
  elseif ($_GET['halamane']=='transaksi'){
    if ($_SESSION['leveluser']=='admin'){
      include "halaman/hal_transaksi/transaksi.php";
    }
  }
  
   // Report
  elseif ($_GET['halamane']=='report'){
    if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
      include "halaman/hal_report/report.php";
    }
  }
  
  
   

   else{
    echo "<p>Halaman Tidak Tersedia.</p>";
  }


  // Apabila halaman tidak ditemukan
 
}
?>
