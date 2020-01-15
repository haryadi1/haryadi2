<?php 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";

$module=$_GET['module'];
$act=$_GET['act'];


if($module=='kjb' AND $act=='input' ){
	$tm=explode(" ",$_POST['tmt']);
	$tm1=$tm[0];
	$ambil_kode=mysql_query("select * from k_jabatan where nip='$_POST[nip]'");
	if(mysql_num_rows($ambil_kode)>0){ 
	mysql_query("update k_jabatan set nip='$_POST[nip]',
										  masa_kerja='$tm1',
										  keterangan='$_POST[ket]'
										  where idkjb='$_POST[idkjb]',");
	$jbb=mysql_query("select * from jabatan where id_jab='$_POST[jabatan]'");
	$jab=mysql_fetch_array($jbb);
	mysql_query("insert into h_jabatan set idkjb='$_POST[idkjb]', 
										jab_old='$_POST[jbt]' , 
										tgl_ajb='$_POST[tgawl]',
										jabatan_baru='$jab[n_jab]',
										tgl_kjb=now()");
										
	mysql_query("update pegawai set id_jab='$_POST[jabatan]' where nip='$_POST[nip]'");
	header('location:../../media.php?module='.$module);
	
	} else {
	mysql_query("insert into k_jabatan set idkjb='$_POST[idkjb]',
										 nip='$_POST[nip]',
										 masa_kerja='$tm1',
										 keterangan='$_POST[ket]'");
	$jbb=mysql_query("select * from jabatan where id_jab='$_POST[jabatan]'");
	$jab=mysql_fetch_array($jbb);
	mysql_query("insert into h_jabatan set idkjb='$_POST[idkjb]', 
										jab_old='$_POST[jbt]' , 
										tgl_ajb='$_POST[tgawl]',
										jabatan_baru='$jab[n_jab]',
										tgl_kjb=now()");
										
	mysql_query("update pegawai set id_jab='$_POST[jabatan]' where nip='$_POST[nip]'");
	header('location:../../media.php?module='.$module);
	}
}


?>