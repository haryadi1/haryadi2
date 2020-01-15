<?php 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";

$module=$_GET['module'];
$act=$_GET['act'];


if($module=='bagian' AND $act=='input' ){
	mysql_query("insert into bagian set id_bag='$_POST[id]', n_bag='$_POST[nama]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='bagian' AND $act=='edit' ){
	mysql_query("update bagian set n_bag='$_POST[nama]' where id_bag='$_POST[id]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='bagian' AND $act=='hapus' ){
	mysql_query("delete from bagian where id_bag='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>