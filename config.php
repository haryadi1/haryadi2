<?php
/**
 * Aplikasi Pegawai Sederhana
 *
 * @file config.php
 * @author Andrew Hutauruk | http://blizze.wordpress.com
 * @date 17 Aug 2012 23:40
 */

mysqli_connect( 'localhost', 'root', '','db_pegawai' );
mysqli_select_db( 'db_pegawai' );

/**
 * Fungsi sederhana untuk mempersingkat penulisan kdoe program
 * Bersifat opsional, tetap bisa menggunakan fungsi PHP pada umumnya
 */
function hajar_coy( $query ) { return mysqli_query( $query ); }
function itung_jumlahnya( $query ) { return mysqli_num_rows( $query ); }
function uraikan( $query ) { return mysqli_fetch_array( $query ); }
function bersihkan( $query ) { return mysqli_real_escape_string( $query ); }

define( 'URL', 'http://localhost/pegawai' );
define( 'NAME', 'Aplikasi Data Pegawai Sederhana' );
$option = isset( $_GET['option'] ) ? $_GET['option'] : '';
$action = isset( $_POST['action'] ) ? $_POST['action'] : '';

?>