<?php
/**
 * Aplikasi Pegawai Sederhana
 *
 * @file function.php
 * @author Andrew Hutauruk | http://blizze.wordpress.com
 * @date 17 Aug 2012 23:40
 */

# Panggil file config.php
require( dirname(__FILE__).'/config.php' );

# Fungsi untuk menyimpan data pegawai
function simpan_data_pegawai() {
	# tampung data kesalahan
	$salah = array();
	$dir = "photo";
	
	# tangkap data-data yang dimasukkan dari form
	$nama = bersihkan( $_POST['nama'] );
	$alamat = bersihkan( $_POST['alamat'] );
	$gaji = bersihkan( $_POST['gaji'] );
	$kode = bersihkan( $_POST['kode'] );
	$sex = $_POST['sex'];
	$status = $_POST['status'];
	$jabatan = $_POST['jabatan'];
	$filename = $_FILES['photo']['name'];
	$tmp_name = $_FILES['photo']['tmp_name'];
	$filesize = $_FILES['photo']['size'];
	$filetype = $_FILES['photo']['type'];
	
	$image_name = strtolower(str_replace(' ', '-', $filename));
	$image_ext = substr($image_name, strrpos($image_name, '.'));
	$image_ext = str_replace('.', '', $image_ext);
	$image_name = preg_replace("/\.[^.\s]{3,4}$/", "", $image_name);
	$new_image_name = $kode.'.'.$image_ext;
	
	# validasi data lalu simpan data kesalahan dlm bentuk array, jika ada
	if( empty( $nama ) ) {
		$salah[] = '- Pasti Anda manusia dan punya nama, yang benar aja...';
	}
	if( empty( $alamat ) ) {
		$salah[] = '- Masa ga punya tempat tinggal, isi dulu donk...';
	}
	if( empty( $gaji ) ) {
		$salah[] = '- Emang lu kerja ga mau dibayar, isi besar gajilah...';
	}
	if( empty( $kode ) ) {
		$salah[] = '- Isi kode biar Anda nampak unik dan antik coy...';
	}
	
	# jika tidak ada kesalahan
	if( !count( $salah ) ) {
		
		# cek jika sudah ada pegawai yang memiliki kode pegawai yang sama
		if( itung_jumlahnya( hajar_coy( "SELECT * FROM pegawai WHERE kode='$kode'" ) ) == 0 ) {
			hajar_coy( "INSERT INTO pegawai VALUES( '', '$kode', '$nama', '$alamat', '$gaji', '$sex', '$status', '$jabatan', '$new_image_name', '".time()."' )" );
			move_uploaded_file($_FILES['photo']['tmp_name'], $dir . "/" . $new_image_name);
		} else {
			$salah[] = '- Sorry ya, kode pegawai ini sudah ada yang punya coy...';
		}
	}
	
	# jika ada kesalahan simpan aja di dalam session
	if( count( $salah ) ) {
		$_SESSION['pesan']['kesalahan-tambah-data'] = implode( '<br>', $salah );
	}
	
	# jika terjadi kesalahan kirimkan ke halaman semula sebaliknya kirimkan ke daftar pegawai
	if( count( $salah ) ) {
		header( "Location: ".URL."/?option=tambah-pegawai" );
	} else {
		header( "Location: ".URL."/?option=data-pegawai" );
	}
	exit;
} /* Akhir dari fungsi menyimpan data pegawai baru */

# Fungsi untuk mengubah data pegawai
function update_data_pegawai() {
	# tampung data kesalahan
	$salah = array();	
	$dir = "photo";	
	# tangkap data-data yang dimasukkan dari form
	$nama = bersihkan( $_POST['nama'] );
	$alamat = bersihkan( $_POST['alamat'] );
	$gaji = bersihkan( $_POST['gaji'] );
	$kode = bersihkan( $_POST['kode'] );
	$sex = $_POST['sex'];
	$status = $_POST['status'];
	$jabatan = $_POST['jabatan'];
	$filename = $_FILES['photo']['name'];
	$tmp_name = $_FILES['photo']['tmp_name'];
	$filesize = $_FILES['photo']['size'];
	$filetype = $_FILES['photo']['type'];	
	$image_name = strtolower(str_replace(' ', '-', $filename));
	$image_ext = substr($image_name, strrpos($image_name, '.'));
	$image_ext = str_replace('.', '', $image_ext);
	$image_name = preg_replace("/\.[^.\s]{3,4}$/", "", $image_name);
	$new_image_name = $kode.'.'.$image_ext;
	# validasi data lalu simpan data kesalahan dlm bentuk array, jika ada
	if( empty( $nama ) ) {
		$salah[] = '- Pasti Anda manusia dan punya nama, yang benar aja...';
	}
	if( empty( $alamat ) ) {
		$salah[] = '- Masa ga punya tempat tinggal, isi dulu donk...';
	}
	if( empty( $gaji ) ) {
		$salah[] = '- Emang lu kerja ga mau dibayar, isi besar gajilah...';
	}
	if( empty( $kode ) ) {
		$salah[] = '- Isi kode biar Anda nampak unik dan antik coy...';
	}
	# jika tidak ada kesalahan
	if( !count( $salah ) ) {		
		$sql = uraikan(hajar_coy("SELECT * FROM pegawai WHERE kode='{$kode}'"));
		$sex = ($sex != '') ? $sex : $sql['sex'];
		$jabatan = ($jabatan != '') ? $jabatan : $sql['jabatan'];
		$status = ($status != '') ? $status : $sql['status'];
		$new_image_name = ($filename != '') ? $new_image_name : $sql['photo'];
		hajar_coy( "UPDATE pegawai SET kode='$kode', nama='$nama', alamat='$alamat', gaji='$gaji', sex='$sex', status='$status', jabatan='$jabatan', photo='$new_image_name' WHERE kode='$kode'" );
		move_uploaded_file($_FILES['photo']['tmp_name'], $dir . "/" . $new_image_name);
	}
	# jika ada kesalahan simpan aja di dalam session
	if( count( $salah ) ) {
		$_SESSION['pesan']['kesalahan-ubah-data'] = implode( '<br>', $salah );
	}
	# jika terjadi kesalahan kirimkan ke halaman semula sebaliknya kirimkan ke daftar pegawai
	if( count( $salah ) ) {
		header( "Location: ".URL."/?option=edit-pegawai&kode=$kopeg" );
	} else {
		header( "Location: ".URL."/?option=data-pegawai" );
	}
	exit;
} /* Akhir dari fungsi menyimpan data pegawai baru */

# FUngsi untuk menghapus data pegawai
function hapus_data_pegawai() {
	$dir = "photo";
	$kode = isset( $_GET['kode'] ) ? $_GET['kode'] : '';
	$sql = uraikan(hajar_coy("SELECT * FROM pegawai WHERE kode='{$kode}'"));
	$ext = substr($sql['photo'], strrpos($sql['photo'], '.'));	
	$ext = str_replace('.', '', $ext);
	if(file_exists("{$dir}/{$kode}.{$ext}")){
		unlink("{$dir}/{$kode}.{$ext}");
	}
	hajar_coy( "DELETE FROM pegawai WHERE kode='$kode'" );
	header( "Location: ".URL."/?option=data-pegawai" );
	exit;
}

# Fungsi untuk mencari kode pegawia terbesar dari table pegawai
function cari_terbesar( $kode ) {
	$query = uraikan( hajar_coy( "SELECT MAX(kode) AS terbesar FROM pegawai" ) );
	$kode = $query['terbesar'];
	if( $kode ) {
		$terbesar = substr( $query['terbesar'], 0, 7 );
		$terbesar++;
	} else {
		$terbesar = 'PEG0001';
	}
	return $terbesar;
}

# Fungsi untuk memformat nilai angka ke dalam rupiah
function ubah_ke_rupiah( $id ) {
	return number_format( $id, 0, ", ", "." );
}

# Fungsi untuk membuat form tambah pegawai dengan fungsi-fungsi buatan
function tambah_data_pegawai() {
	echo "<div class=\"box\">\n";
	echo "<h1>TAMBAH DATA PEGAWAI</h1>";
	
	# cek jika ada terjadi kesalahan selama penambahan data
	if( isset( $_SESSION['pesan']['kesalahan-tambah-data'] ) ) {
		echo "<p class=\"err\"><b>Pesan Kesalahan :</b><br>".$_SESSION['pesan']['kesalahan-tambah-data']."</p>";
		unset( $_SESSION['pesan']['kesalahan-tambah-data'] );
	}
	$kode = cari_terbesar('kode');
	echo "	<form method=\"post\" action=\"\" autocomplete=\"off\" enctype=\"multipart/form-data\">\n";
	echo "		Kode Pegawai:<br><input type=\"text\" name=\"kode\" value=\"{$kode}\"><br>\n";
	echo "		Nama Pegawai:<br><input type=\"text\" name=\"nama\" placeholder=\"Isi nama lengkap pegawai...\"><br>\n";
	echo "		Alamat Pegawai:<br><input type=\"text\" name=\"alamat\" placeholder=\"Isi alamat lengkap pegawai...\"><br>\n";
	echo "		Gaji Utama Pegawai:<br><input type=\"text\" name=\"gaji\" placeholder=\"Isi gaji utama pegawai...\"><br>\n";
	echo "		Jenis Kelamin:<br><select name=\"sex\"><option value=\"0\" selected\">Pilih jenis kelamin</option>\n";
	echo "			<option value=\"Laki-Laki\">Laki-Laki</option><option value=\"Perempuan\">Perempuan</option>\n";
	echo "		</select><br>\n";
	echo "		Status Menikah:<br><select name=\"status\"><option value=\"0\" selected\">Pilih status pernikahan</option>\n";
	echo "			<option value=\"Menikah\">Menikah</option><option value=\"Lajang\">Lajang</option><option value=\"3\">Bercerai</option>\n";
	echo "		</select><br>\n";
	echo "		Jabatan:<br><select name=\"jabatan\"><option value=\"0\" selected\">Pilih jabatan</option>\n";
	echo "			<option value=\"Manajer\">Manajer</option><option value=\"Direktur\">Direktur</option><option value=\"Supervisor\">Supervisor</option><option value=\"Leader\">Leader</option><option value=\"Teknisi\">Teknisi</option><option value=\"Operator\">Operator</option><option value=\"Programmer\">Programmer</option><option value=\"Analis\">Analis</option>\n";
	echo "		</select><br>\n";
	echo "		Photo Karyawan: &nbsp; <input type=\"file\" name=\"photo\" size=\"90\"><br><br>\n";
	echo "		<input type=\"submit\" name=\"action\" value=\"Simpan Data Pegawai\"><br>\n";
	echo "	</form>\n";
	echo "</div>\n";
}

# Fungsi untuk mengubah data pegawai
function ubah_data_pegawai() {
	$kode = isset( $_GET['kode'] ) ? $_GET['kode'] : '';
	$sql = uraikan( hajar_coy( "SELECT * FROM pegawai WHERE kode='$kode'" ) );

	echo "<div class=\"box\">\n";
	echo "<h1>Ubah Data Pegawai</h1>";
	if( isset( $_SESSION['pesan']['kesalahan-ubah-data'] ) ) {
		echo "<p class=\"err\"><b>Pesan Kesalahan :</b><br>".$_SESSION['pesan']['kesalahan-ubah-data']."</p>";
		unset( $_SESSION['pesan']['kesalahan-ubah-data'] );
	}

	echo "	<form method=\"post\" action=\"\" autocomplete=\"off\" enctype=\"multipart/form-data\">\n";
	echo "		Kode Pegawai:<br><input type=\"text\" name=\"kode\" value=\"{$sql['kode']}\"><br>\n";
	echo "		Nama Pegawai:<br><input type=\"text\" name=\"nama\" placeholder=\"Isi nama lengkap pegawai...\" value=\"{$sql['nama']}\"><br>\n";
	echo "		Alamat Pegawai:<br><input type=\"text\" name=\"alamat\" placeholder=\"Isi alamat lengkap pegawai...\" value=\"{$sql['alamat']}\"><br>\n";
	echo "		Gaji Utama Pegawai:<br><input type=\"text\" name=\"gaji\" placeholder=\"Isi gaji utama pegawai...\" value=\"{$sql['gaji']}\"><br>\n";
	echo "		Jenis Kelamin:<br><select name=\"sex\"><option value=\"0\" selected\">Pilih jenis kelamin</option>\n";
	echo "			<option value=\"Laki-Laki\">Laki-Laki</option><option value=\"Perempuan\">Perempuan</option>\n";
	echo "		</select><br>\n";
	echo "		Status Menikah:<br><select name=\"status\"><option value=\"0\" selected\">Pilih status pernikahan</option>\n";
	echo "			<option value=\"Menikah\">Menikah</option><option value=\"Lajang\">Lajang</option><option value=\"3\">Bercerai</option>\n";
	echo "		</select><br>\n";
	echo "		Jabatan:<br><select name=\"jabatan\"><option value=\"0\" selected\">Pilih jabatan</option>\n";
	echo "			<option value=\"Manajer\">Manajer</option><option value=\"Direktur\">Direktur</option><option value=\"Supervisor\">Supervisor</option><option value=\"Leader\">Leader</option><option value=\"Teknisi\">Teknisi</option><option value=\"Operator\">Operator</option><option value=\"Programmer\">Programmer</option><option value=\"Analis\">Analis</option>\n";
	echo "		</select><br>\n";
	echo "		<div class=\"edit_photo_box\">\n";
	echo "			<div class=\"photo_box\">\n";
	if(file_exists("photo/{$sql['photo']}")){
		$photo = "<img src=\"".URL."/photo/{$sql['photo']}\" class=\"photo\" alt=\"{$sql['photo']}\">";
	} else {
		$photo = "<img src=\"".URL."/photo/noname.jpg\" class=\"photo\">";
	}
	echo "				{$photo}\n";
	echo "			</div>\n";
	echo "			<div class=\"photo_input\">Photo Karyawan:<br><input type=\"file\" name=\"photo\" size=\"90\"></div>\n";
	echo "			<div class=\"clear\"></div>\n";
	echo "		</div>\n";
	echo "		<input type=\"submit\" name=\"action\" value=\"Ubah Data Pegawai\"><br>\n";
	echo "	</form>\n";
	echo "</div>\n";
}

# Fungsi untuk menampilkan daftar pegawai
function tampilkan_pegawai() {
	$jumlah_data_per_halaman = 7;
	if(isset($_GET['page'])){ $nomor_halaman = $_GET['page'];} 
	else { $nomor_halaman = 1; }
	$offset = ($nomor_halaman - 1) * $jumlah_data_per_halaman;		
	$sql = hajar_coy( "SELECT * FROM pegawai ORDER BY kode ASC LIMIT $offset,$jumlah_data_per_halaman" );
	$jumlah_data_pegawai = itung_jumlahnya(hajar_coy("SELECT * FROM pegawai"));	
	echo "<div class=\"box\">\n";
	echo "<h1>Daftar Pegawai</h1>";
	echo "<table border=\"0\">";
	echo "<tr class=\"top_tr\">";
	echo "	<td width=\"40\">Photo</td>\n";
	echo "	<td width=\"150\">Nama</td>\n";
	echo "	<td width=\"150\">Alamat</td>\n";
	echo "	<td width=\"100\">Gaji Utama</td>\n";
	echo "	<td width=\"100\">Status</td>\n";
	echo "	<td width=\"100\">Jabatan</td>\n";
	echo "	<td width=\"70\">Sex</td>\n";
	echo "	<td width=\"50\">Aksi</td>\n";
	echo "</tr>";	
	if( itung_jumlahnya( $sql ) == 0 ) {
		echo "<tr style=\"height:150px; border-bottom:1px dotted #CC780C;\">";
		echo "	<td colspan=\"8\" align=\"center\" style=\"color:#FF0000; \">Belum ada data pegawai saat ini. Silahkan segera update database ppegawai ini.<br><a href=\"".URL."/?option=tambah-pegawai\">Klik disini untuk menambah data pegawai</a></td>";
		echo "</tr>";
	} else {
		$a = 0;
		while( $row = uraikan( $sql ) ) {
			if( $a == 0 ) { $bg = "#FCFADE"; $a = 1; }
			else{ $bg = "#FCF7AB"; $a = 0; }
			
			if(file_exists("photo/{$row['photo']}")){
				$photo = "<img src=\"".URL."/photo/{$row['photo']}\" class=\"photo\" alt=\"{$row['photo']}\">";
			} else {
				$photo = "<img src=\"".URL."/photo/noname.jpg\" class=\"photo\">";
			}
			echo "<tr bgcolor=\"$bg\" onmouseover=\"bgColor='#FFFF55'\" onmouseout=\"bgColor='$bg'\">";
			echo "	<td align=\"center\">{$photo}</td>";
			echo "	<td><span style=\"font-size:12px; \">Kode: <a href=\"".URL."/?option=detail-pegawai&kode={$row['kode']}\">{$row['kode']}</a></span><br>{$row['nama']}</td>";
			echo "	<td>{$row['alamat']}</td>";
			echo "	<td>Rp ".ubah_ke_rupiah( $row['gaji'] )."</td>";
			echo "	<td>{$row['status']}</td>";
			echo "	<td>{$row['jabatan']}</td>";
			echo "	<td>{$row['sex']}</td>";
			echo "	<td><a href=\"".URL."/?option=edit-pegawai&kode={$row['kode']}\" title=\"Klik untuk mengubah data pegawai\"><img src=\"".URL."/b_edit.png\" alt=\"\"> &nbsp; <a href=\"".URL."/?option=delete-pegawai&kode={$row['kode']}\" onclick=\"return hapus('".$row['kode']."')\" title=\"Klik untuk menghapus data pegawai\"><img src=\"".URL."/b_drop.png\"></a></td>";
			echo "</tr>";
		}		
	}
	echo "</table>";	
	$jumlah_data = uraikan( hajar_coy("SELECT COUNT(*) AS jumlah FROM pegawai") );
	$total_halaman = ceil($jumlah_data['jumlah'] / $jumlah_data_per_halaman);
	
	echo "<p class=\"paging\">\n";
	echo "Halaman: &nbsp; ";
	$showpage = 0;
	if($nomor_halaman > 1){ echo "<a href=\"".URL."/?option=data-pegawai&page=".($nomor_halaman-1)."\">&larr; Prev</a>\n"; }
	for($page = 1; $page <= $total_halaman; $page++){
		if((($page >= $nomor_halaman - 3) && ($page <= $nomor_halaman + 3)) || ($page == 1) || ($page == $total_halaman)){
			if(($showpage == 1) && ($page != 2)) echo "...";
			if(($showpage != ($total_halaman-1)) && ($page == $total_halaman)) echo "...";
			if($page == $nomor_halaman) echo "<span class=\"current\">{$page}</span>";
			else echo "<a href=\"".URL."/?option=data-pegawai&page={$page}\">{$page}</a>";
			$showpage = $page;
		}
	}
	if($nomor_halaman < $total_halaman){ echo "<a href=\"".URL."/?option=data-pegawai&page=".($nomor_halaman+1)."\">&rarr; Next</a>\n"; }
	echo "</p>\n";
	
	echo "</div>\n";
}

function detail_pegawai($kode){
	$sql = uraikan(hajar_coy("SELECT * FROM pegawai WHERE kode='{$kode}'"));
	echo "<div class=\"box\">\n";
	echo "	<h1>Pegawai: {$sql['nama']} - {$sql['kode']}</h1>\n";
	echo "	<div class=\"box_info\">\n";
	echo "		<table class=\"tinfo\">\n";
	echo "		<tr class=\"t\"><td width=\"150\">Nama Lengkap</td><td width=\"300\"> : &nbsp; {$sql['nama']}</td></tr>\n";
	echo "		<tr class=\"b\"><td>Kode Pegawai</td><td> : &nbsp; {$sql['kode']}</td></tr>\n";
	echo "		<tr class=\"t\"><td>Alamat Lengkap</td><td> : &nbsp; {$sql['alamat']}</td></tr>\n";
	echo "		<tr class=\"b\"><td>Gaji Utama</td><td> : &nbsp; Rp ".ubah_ke_rupiah( $sql['gaji'] )."</td></tr>\n";
	echo "		<tr class=\"t\"><td>Jenis Kelamin</td><td> : &nbsp; {$sql['sex']}</td></tr>\n";
	echo "		<tr class=\"b\"><td>Jabatan</td><td> : &nbsp; {$sql['jabatan']}</td></tr>\n";
	echo "		<tr class=\"t\"><td>Status Pernikahan</td><td> : &nbsp; {$sql['status']}</td></tr>\n";
	echo "		</table>\n";
	echo "	</div>\n";
	echo "	<div class=\"box_photo\">\n";
	if(file_exists("photo/{$sql['photo']}")){
		$photo = "<img src=\"".URL."/photo/{$sql['photo']}\" alt=\"{$sql['photo']}\">";
	} else {
		$photo = "<img src=\"".URL."/photo/noname.jpg\">";
	}
	echo "{$photo}";
	
	echo "	</div>\n";
	echo "	<div class=\"clear\"></div>\n";
	echo "</div>\n";
}

?>