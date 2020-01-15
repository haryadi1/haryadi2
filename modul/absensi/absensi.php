<?php

$aksi="modul/absensi/aksi_absensi.php";
date_default_timezone_set("Asia/Jakarta");

function masuk($var){
	if($var=='Y'){
		$status="Sudah";
		return $status;
	}
	else if($var=='N'){
		$status="Belum";
		return $status;
	}
}

function keterangan($var){
	if($var=='I'){
		$status="IZIN";
		return $status;
	}
	else if($var=='S'){
		$status="SAKIT";
		return $status;
	}
	else if($var=='M'){
		$status="HADIR";
		return $status;
	} else {
		$status="-";
		return $status;
	}
}

function kehadiran($var){
	if($var=='I'){
		$status="Tidak Masuk";
		return $status;
	}
	else if($var=='S'){
		$status="Tidak Masuk";
		return $status;
	}
	else if($var=='M'){
		$status="Masuk";
		return $status;
	} else {
		$status="-";
		return $status;
	}
}

switch($_GET[act]){
	default:
	$nip=$_SESSION['namauser'];
	$tgl= date('Y-m-d');
	$per=explode('-',$tgl);
	$bln=$per[1];
	$thn=$per[0];
	$waktu= date ('H:i:s');
	$tampil=mysql_query("select * from absensi,pegawai where 
						 pegawai.nip=absensi.nip and Month(absensi.tanggal_absen)='$bln' 
						 and Year(absensi.tanggal_absen)='$thn'
						 and pegawai.nip='$nip'
						 order by absensi.tanggal_absen,absensi.id_absensi ASC ");
	
	echo "<div class='center'><h2 class='head'>Absensi Pegawai</h2></div>
	<form action='$aksi?module=absensi&act=masuk' method='POST' >
	<div class='cent'>
	<div class='absensi'>".tgl_indo($tgl)."</div>
		<table>
		<tr>
		<td>NIP</td><td>:</td><td><input type=text name=nip></td><td></td>
		</tr>
		<tr>
		<td>Password</td><td>:</td><td><input type=password name=pwd><input type=hidden name=tgl value='$tgl'></td><td></td>
		</tr>
		<tr>
		<td>Jam Masuk</td><td>:</td><td><input type=text name=jam value='$waktu' readonly></td>
		</tr>
		<tr>
		<td colspan='3'><input type=submit value=MASUK name=masuk>
		<input type=submit value=IZIN  name=izin>
		<input type=submit value=SAKIT name=sakit>
		</td>
		</tr>
		</table>
		
	</div>
	</form>";
	$konv=tgl_indo($tgl);
	$k=explode(' ',$konv);
	$bull=$k[1];
	$thh=$k[2];
	echo"
	<div>Periode : $bull $thh</div>
	<table class='tabel'>
	<thead>
  <tr>
    <td>Tanggal</td>
	<td>Absen Masuk</td>
	<td>Absen Keluar</td>
	<td>Kehadiran</td>
	<td>Keterangan</td>
	<td>Control</td>
  </tr>
  </thead>";
  $no=1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td>".tgl_indo($dt['tanggal_absen'])."</td>
	<td>".masuk($dt['status_masuk'])."</td>
	<td>".masuk($dt['status_keluar'])."</td>
    <td>".kehadiran($dt['ket'])."</td>
    <td>".keterangan($dt['ket'])."</td>
	<td><span><a href='$aksi?module=absensi&act=keluar&id=$dt[id_absensi]'>Keluar</a></span></td>
  </tr>";
  $no++;
  }
echo "  
</table>
	";
	
	break;
	
	
	
	
	
}


?>