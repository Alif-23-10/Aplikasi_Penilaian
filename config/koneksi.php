<?php
class DB{
	private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "penilaian";
	
    public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            try{
                $conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUsername, $this->dbPassword);
                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db = $conn;
            }catch(PDOException $e){
                die("Failed to connect with MySQL: " . $e->getMessage());
            }
        }
    }

    public function getmyDB()
        {
        if ($this->db instanceof PDO)
            {
            return $this->db;
            }
        }
    
    /*
     * Returns rows from the database based on the conditions
     * @param string name of the table
     * @param array select, where, order_by, limit and return_type conditions
     */
    public function getRows($table,$conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$table;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by']; 
        }
        
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit']; 
        }
        
        $query = $this->db->prepare($sql);
        $query->execute();
        
        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = $query->rowCount();
                    break;
                case 'single':
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    break;
                default:
                    $data = '';
            }
        }else{
            if($query->rowCount() > 0){
                $data = $query->fetchAll();
            }
        }
        return !empty($data)?$data:false;
    }
    
    /*
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function insert($table,$data){
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;
   /*          if(!array_key_exists('created',$data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            } */

            $columnString = implode(',', array_keys($data));
            $valueString = ":".implode(',:', array_keys($data));
            $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";
            $query = $this->db->prepare($sql);
            foreach($data as $key=>$val){
                 $query->bindValue(':'.$key, $val);
            }
            $insert = $query->execute();
            return $insert?$this->db->lastInsertId():false;
        }else{
            return false;
        }
    }
    
    /*
     * Update data into the database
     * @param string name of the table
     * @param array the data for updating into the table
     * @param array where condition on updating data
     */
    public function update($table,$data,$conditions){
        if(!empty($data) && is_array($data)){
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
/*             if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            } */
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."='".$val."'";
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
            $query = $this->db->prepare($sql);
            $update = $query->execute();
            return $update?$query->rowCount():false;
        }else{
            return false;
        }
    }
    
    /*
     * Delete data from the database
     * @param string name of the table
     * @param array where condition on deleting data
     */
    public function delete($table,$conditions){
        $whereSql = '';
        if(!empty($conditions)&& is_array($conditions)){
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $sql = "DELETE FROM ".$table.$whereSql;
        $delete = $this->db->exec($sql);
        return $delete?$delete:false;
    }

     
     // Mengambil data terakhir disimpan]
  	public function last_inserted($column,$table){
 		$gid = $this->db->prepare("SELECT MAX(".$column.") as maxGroup FROM ".$table);
 			$gid->execute();
 		$last = $gid->fetch(PDO::FETCH_ASSOC);
 	return $last['maxGroup'];
 	}
	
	 // Mengambil data terakhir disimpan]
  	public function LastInsertedCondistion($column,$table,$field,$value){
 		$gid = $this->db->prepare("SELECT MAX(".$column.") as maxGroup FROM ".$table." WHERE ".$field." ='$value' ");
 			$gid->execute();
 		$last = $gid->fetch(PDO::FETCH_ASSOC);
 	return $last['maxGroup'];
 	}
	

 	 // Membuat Kode urut otomatis
   	public function buatkode($nomor_terakhir, $kunci, $jumlah_karakter = 0){
    $nomor_baru = intval(substr($nomor_terakhir, strlen($kunci))) + 1;
    $nomor_baru_plus_nol = str_pad($nomor_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
    $kode = $kunci . $nomor_baru_plus_nol;
    return $kode;
	}
	

    // fungsi untuk menghindari injeksi dari user yang jahil
    public function anti_injection($data){
    $filter  = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
    return $filter;
	}
	
	//Fungsi encrypsi dan Decrypsi
	function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'Sixghakreasi';
    $secret_iv = 'Sixghakreasi iv';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
	}
	
	
	///Get data user
	public function GetRowUser(){
	$sth = $this->db->prepare("SELECT* FROM user WHERE id_user NOT IN('US000','US0000')");
	$sth->execute();
	$result = $sth->fetchAll();
	return !empty($result)?$result:false;
	}
	
	///Get data Level 
	public function GetRowLevel(){
	$sth = $this->db->prepare("SELECT* FROM level");
	$sth->execute();
	$result = $sth->fetchAll();
	return !empty($result)?$result:false;
	}
	
	
  // select Distinct table
  //$gid = $this->db->prepare("SELECT MAX(".$column.") as maxGroup FROM ".$table." WHERE ".$field." ='$value' ");
	public function SelectDist($field,$table){
	$sth = $this->db->prepare("SELECT DISTINCT ".$field." FROM ".$table."");
	$sth->execute();
	$result = $sth->fetchAll();
	return !empty($result)?$result:false;
	}
	
	
	
	//Fungsi untuk menampilkan angka kedalam format mata uang rupiah
	function format_rupiah($angka){
	$rupiah=number_format($angka,0,',','.');
	return $rupiah;
	}

	//Fungsi kekata angka ke ejaan huruf
	function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = $this->kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = $this->kekata($x/10)." puluh". $this->kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . $this->kekata($x - 100);
    } else if ($x <1000) {
        $temp = $this->kekata($x/100) . " ratus" . $this->kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . $this->kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = $this->kekata($x/1000) . " ribu" . $this->kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = $this->kekata($x/1000000) . " juta" . $this->kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = $this->kekata($x/1000000000) . " milyar" . $this->kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = $this->kekata($x/1000000000000) . " trilyun" . $this->kekata(fmod($x,1000000000000));
    }     
        return $temp;
}
 
	//Fungsi terbilang
	function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim($this->kekata($x));
    } else {
        $hasil = trim($this->kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}

	// Format Tanggal Indonesia 
	function tanggal_indo($tanggal){
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

//fungsi pindah halaman
function jump_to($page){
   if (!headers_sent()){
      header("Location:$page");
      exit();
   }else{
      echo "<meta http-equiv=refresh content=0;URL=$page>";
      exit();
   }
}


//fungsi Convert number to month name 
function number_to_month($number){
	$monthNum = $number;
	$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
	return $monthName; // Output: May
}

//Get data transaksi 
	public function GetDataTransaksi($decrypted_txt,$decrypted_txt2){
	$sth = $this->db->prepare("SELECT * FROM transaksi a 
									   JOIN karyawan b ON b.id_karyawan=a.id_karyawan
									   JOIN tahun_penilaian c ON c.id_tahun_penilaian=b.id_tahun_penilaian_aktif
									   JOIN kompetensi d ON d.id_kompetensi=a.id_kompetensi
									   JOIN kategori e ON e.id_kategori=d.id_kategori
									   WHERE a.id_karyawan='$decrypted_txt' AND a.id_tahun_penilaian='$decrypted_txt2'
									   ORDER BY id_transaksi DESC");
	$sth->execute();
	$result = $sth->fetchAll();
	return !empty($result)?$result:false;
	}
	
	///Get data transaksi between date
	public function GetDataTransaksiByYear($year){
	$sth = $this->db->prepare("SELECT* FROM transaksi a 
									   JOIN karyawan b ON b.id_karyawan=a.id_karyawan
									   JOIN tahun_penilaian c ON c.id_tahun_penilaian=b.id_tahun_penilaian_aktif
									   WHERE a.id_tahun_penilaian =  '$year'");
	$sth->execute();
	$result = $sth->fetchAll();
	return !empty($result)?$result:false;
	}
	
	
	//truncate table
	public function TruncateTable($NamaTabel){
	//Our SQL statement. This will empty / truncate the table "videos"
	$sql = "TRUNCATE TABLE `$NamaTabel";
	//Prepare the SQL query.
	$statement = $this->db->prepare($sql);
	//Execute the statement.
	$statement->execute();
	
 	}
	
	//Fungsi untuk menampilkan angka kedalam format mata uang rupiah
	function format_desimal($angka){
	$rupiah=number_format($angka,1,'.',',');
	return $rupiah;
	}
	
	
	public function GetAverage($karyawan,$kategori,$tahunpenilaian){
        $query = $this->db->prepare("SELECT AVG(`rating`) FROM `transaksi` WHERE `id_karyawan` = '$karyawan' AND `id_kategori` = '$kategori' AND `id_tahun_penilaian` = '$tahunpenilaian' AND rating <>''" );
        //$query->bindValue(3, $karyawan,$kategori,$tahunpenilaian);

        try{ $query->execute();   

        $total = $query->fetch(PDO::FETCH_NUM);
        $summ = $total[0]; // 0 is the first array. here array is only one.
        return $summ; 

        } catch(PDOException $e){
            die($e->getMessage());
        }   
		}
		
		public function GetAverage2($karyawan,$tahunpenilaian){
        $query = $this->db->prepare("SELECT AVG(`rating`) FROM `transaksi` WHERE `id_karyawan` = '$karyawan' AND `id_tahun_penilaian` = '$tahunpenilaian' AND rating <>''" );
        //$query->bindValue(3, $karyawan,$kategori,$tahunpenilaian);

        try{ $query->execute();   

        $total = $query->fetch(PDO::FETCH_NUM);
        $summ = $total[0]; // 0 is the first array. here array is only one.
        return $summ; 

        } catch(PDOException $e){
            die($e->getMessage());
        }   
		}
		
	public function GetSum(){
        $query = $this->db->prepare("SELECT SUM(`bobot`) FROM kategori" );
        //$query->bindValue(3, $karyawan,$kategori,$tahunpenilaian);

        try{ $query->execute();   

        $total = $query->fetch(PDO::FETCH_NUM);
        $summ = $total[0]; // 0 is the first array. here array is only one.
        return $summ; 

        } catch(PDOException $e){
            die($e->getMessage());
        }   
		}
	
	public function GetSumRating($data1,$data2){
        $query = $this->db->prepare("SELECT SUM(`rating`) FROM transaksi WHERE id_karyawan='$data1' AND id_tahun_penilaian='$data2'" );
        //$query->bindValue(3, $karyawan,$kategori,$tahunpenilaian);

        try{ $query->execute();   

        $total = $query->fetch(PDO::FETCH_NUM);
        $summ = $total[0]; // 0 is the first array. here array is only one.
        return $summ; 

        } catch(PDOException $e){
            die($e->getMessage());
        }   
		}
	

}

?>
