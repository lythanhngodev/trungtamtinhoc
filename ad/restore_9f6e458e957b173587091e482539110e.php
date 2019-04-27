<?php 
	error_reporting(0);
	include_once "../__.php";
	$gcof_bk=parse_ini_file('../lythanhngo.config.ltn');
	if (!isset($_GET['key']) || empty($_GET['key'])) {
		die();
	}
	$kn = new clsKetnoi();
	// kiểm tra key
	if (!($kn->tontai("SELECT * FROM keyxacminh WHERE keyxacminh.`KEY` = '".$_GET['key']."'"))) {
		die();
	}
	$database = $gcof_bk['db_name'];
	$user = $gcof_bk['db_user'];
	$pass = $gcof_bk['db_password'];
	$host = 'localhost';
	$port = $gcof_bk['db_port'];
	$my_sql = $gcof_bk['my_sql'];
	$filename= time().'.sql';
	$dir = dirname(__FILE__) .'\\..\\backup\\'.$_GET['file'];

	exec("{$my_sql} -h {$host} -u {$user} -p{$pass} {$database} < $dir");
	echo "ThanhCong";
 ?>