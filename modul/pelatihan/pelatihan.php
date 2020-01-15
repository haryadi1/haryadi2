<?php

$aksi="modul/pelatihan/aksi_pelatihan.php";

function nilai($var){
	if($var>=60 and $var<65 ){
		echo "Buruk";
	}
	else if($var>=65 and $var<=75 ){
		echo "Cukup Baik";
	}
	else if($var>75 and $var<=85 ){
		echo "Baik";
	}
	
	else if($var>85 and $var<=95 ){
		echo "Sangat Baik";
	} 
	else {
		echo "N/A";
	}
	
}

switch($_GET[act]){
	default:
	$tampil=mysql_query("select * from pelatihan order by id_pelatihan");
	echo "<h2 class='head'>DATA PELATIHAN PEGAWAI</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=pelatihan&act=input';\">
	</div>
	<table class='tabel'>
	<thead>
  <tr>
    <td>Nip</td>
    <td>Nama Pelatihan</td>
	<td>Tgl Pelatihan</td>
	<td>Hasil Pelatihan</td>
	<td>Control</td>
  </tr>
  </thead>";
  $no=1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td>$dt[nip]</td>
    <td>$dt[topik_pelatihan]</td>
	<td>".tgl_indo($dt['tgl_pelatihan'])."</td>
	<td>";nilai($dt['hasil_pelatihan']); echo "</td>
	<td><span><a href='?module=pelatihan&act=edit&id=$dt[id_pelatihan]'>Edit</a></span><span>
	<a href=\"$aksi?module=pelatihan&act=hapus&id=$dt[id_pelatihan]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a></span>
	</td>
  </tr>";
  $no++;
  }
echo "  
</table>
	";
	
	break;
	
	case "input":
	echo "<h2 class='head'>Entry Data Pelatihan</h2>
	<form action='$aksi?module=pelatihan&act=input' method='post' enctype='multipart/form-data' >
	<table class='tabelform tabpad'>
	<tr>
	<td>Nip</td><td>:</td><td>"; 
	ambilNip(nip);
	echo "</td>
	</tr>
	<tr>
	<td>Tanggal Pelatihan</td><td>:</td><td>";
	$now =  date("Y");
			$saiki = 2000;
	combotgl(1, 31, tp, 0);
	combonamabln(1,12,bp,0);
	combothn(2000, $now, thp, $now);
	echo "
	</td>
	</tr>
	
	<tr>
	<td>Topik Pelatihan</td><td>:</td><td><input class='input' name='topik' type='text'></td>
	</tr>
	
	<tr>
	<td>Penyelenggara</td><td>:</td><td><input class='input' name='pl' type='text'></td>
	</tr>
	
	<tr>
	<td>Hasil Pelatihan</td><td>:</td><td><input class='input' name='hp' type='text'></td>
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
	$ambil=mysql_query("select * from pelatihan");
	$ed=mysql_fetch_array($ambil);
	echo "<h2 class='head'>Edit Data Pelatihan</h2>
	<form action='$aksi?module=pelatihan&act=edit' method='post' enctype='multipart/form-data' >
	<input type='hidden' name='id' readonly value='$ed[id_pelatihan]' >
	<table class='tabelform tabpad'>
	<tr>
	<td>Nip</td><td>:</td><td> <input type='text' name='nip' readonly value='$ed[nip]' >"; 
	echo "</td>
	</tr>
	<tr>
	<td>Tanggal Pelatihan</td><td>:</td><td>";
	$tg=explode("-",$ed['tgl_pelatihan']);
	$tpt=$tg[0];
	$tpb=$tg[1];
	$tph=$tg[2];
	$now =  date("Y");
			$saiki = 2000;
	combotgl(1, 31, tp, $tph);
	combonamabln(1,12,bp,$tpb);
	combothn(2000, $now, thp, $tpt);
	echo "
	</td>
	</tr>
	
	<tr>
	<td>Topik Pelatihan</td><td>:</td><td><input class='input' name='topik' type='text' value='$ed[topik_pelatihan]'></td>
	</tr>
	
	<tr>
	<td>Penyelenggara</td><td>:</td><td><input class='input' name='pl' type='text' value='$ed[penyelenggara]'></td>
	</tr>
	
	<tr>
	<td>Hasil Pelatihan</td><td>:</td><td><input class='input' name='hp' type='text' value='$ed[hasil_pelatihan]'></td>
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
	
}


?>