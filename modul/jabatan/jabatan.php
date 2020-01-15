<?php

$aksi="modul/jabatan/aksi_jabatan.php";

switch($_GET[act]){
	default:
	$tampil=mysql_query("select * from jabatan order by id_jab DESC");
	echo "<h2 class='head'>DATA JABATAN PEGAWAI</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=jabatan&act=input';\">
	</div>
	<table class='tabel'>
	<thead>
  <tr>
    <td>No</td>
    <td>Id Jabatan</td>
    <td>Jabatan</td>
	<td>Control</td>
  </tr>
  </thead>";
  $no=1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td>$no</td>
    <td>$dt[id_jab]</td>
    <td>$dt[n_jab]</td>
	<td><span><a href='?module=jabatan&act=edit&id=$dt[id_jab]'>Edit</a></span><span>
	<a href=\"$aksi?module=jabatan&act=hapus&id=$dt[id_jab]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a></span></td>
  </tr>";
  $no++;
  }
echo "  
</table>
	";
	
	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Jabatan</h2>
	<form action='$aksi?module=jabatan&act=input' method='post'>
	<table class='tabelform'>
	<tr>
	<td>ID JABATAN</td><td>:</td><td><input class='input' name='id' type='text' value=".kdauto(jabatan,J)."></td>
	</tr>
	<tr>
	<td>JABATAN</td><td>:</td><td><input class='input' name='nama' type='text'></td>
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
	$edit=mysql_query("select * from jabatan where id_jab='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2>Entry Data Jabatan</h2>
	<form action='$aksi?module=jabatan&act=edit' method='post'>
	<table>
	<tr>
	<td>ID BAGIAN</td><td>:</td><td><input class='input' name='id' type='text' value='$data[id_jab]'></td>
	</tr>
	<tr>
	<td>NAMA BAGIAN</td><td>:</td><td><input class='input' name='nama' type='text' value='$data[n_jab]'></td>
	</tr>
	<tr>
	<td></td><td></td><td><input type=submit value=Update>
	<input type=button value=Batal onclick=self.history.back()>
	</td>
	</tr>
	</table>
	</form>";
	break;
	
}


?>