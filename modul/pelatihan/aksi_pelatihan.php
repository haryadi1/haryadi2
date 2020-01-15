<?php 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";
include "../../config/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

if($module=='pegawai' AND $act=='hapus' ){ 
	mysql_query("delete from pegawai where nip='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}

if($module=='pelatihan' AND $act=='input' ){
	$tl="$_POST[thp]-$_POST[bp]-$_POST[tp]";
	mysql_query("insert into pelatihan set nip='$_POST[nip]',
										   tgl_pelatihan='$tl',
										   topik_pelatihan='$_POST[topik]',
										   penyelenggara='$_POST[pl]',
										   hasil_pelatihan='$_POST[hp]'
										   ");
	header('location:../../media.php?module='.$module);
}

elseif($module=='pelatihan' AND $act=='edit' ){
    $tl="$_POST[thp]-$_POST[bp]-$_POST[tp]";
	mysql_query("update pelatihan set 	   tgl_pelatihan='$tl',
										   topik_pelatihan='$_POST[topik]',
										   penyelenggara='$_POST[pl]',
										   hasil_pelatihan='$_POST[hp]'
										   where id_pelatihan='$_POST[id]'
										   ");
	header('location:../../media.php?module='.$module);
}

elseif($module=='pelatihan' AND $act=='hapus' ){
	mysql_query("delete from pelatihan where id_pelatihan = '$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>