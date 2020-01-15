<?php

$aksi="modul/bagian/aksi_bagian.php";

switch($_GET[act]){
	default:
	$tampil=mysql_query("select * from bagian order by id_bag DESC");
	echo "<h2 class='head'>DATA BAGIAN PEGAWAI</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=bagian&act=input';\">
	</div>
	<table class='tabel'>
	<thead>
  <tr>
    <td>No</td>
    <td>Id Bagian</td>
    <td>Nama Bagian</td>
	<td>Control</td>
  </tr>
  </thead>";
  $no=1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td>$no</td>
    <td>$dt[id_bag]</td>
    <td>$dt[n_bag]</td>
	<td><span><a href='?module=bagian&act=edit&id=$dt[id_bag]'>Edit</a></span><span>
	<a href=\"$aksi?module=bagian&act=hapus&id=$dt[id_bag]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a></span></td>
  </tr>";
  $no++;
  }
echo "  
</table>
	";
	
	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Bagian</h2>
	<form action='$aksi?module=bagian&act=input' method='post'>
	<table class='tabelform'>
	<tr>
	<td>ID BAGIAN</td><td>:</td><td><input class='input' name='id' type='text' value=".kdauto(bagian,B)."></td>
	</tr>
	<tr>
	<td>NAMA BAGIAN</td><td>:</td><td><input class='input' name='nama' type='text'></td>
	</tr>
	<tr>
	<td></td><td></td><td><input type=submit value=Simpan>
	<input type=button value=Batal onclick=self.history.back()>
	</td>
	</tr>
	</table>
	</form>
	";
	break;
	
	case "edit":
	$edit=mysql_query("select * from bagian where id_bag='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2>Entry Data Bagian</h2>
	<form action='$aksi?module=bagian&act=edit' method='post'>
	<table>
	<tr>
	<td>ID BAGIAN</td><td>:</td><td><input class='input' name='id' type='text' value='$data[id_bag]'></td>
	</tr>
	<tr>
	<td>NAMA BAGIAN</td><td>:</td><td><input class='input' name='nama' type='text' value='$data[n_bag]'></td>
	</tr>
	<tr>
	<td></td><td></td><td><input type=submit value=Update>
	<input type=button value=Batal onclick=self.history.back()>
	</td>
	</tr>
	</table>
	</form>";
	break;
	
	case "hapus":
	
	break;
}


?>