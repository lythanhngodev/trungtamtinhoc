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
	$my_dump = $gcof_bk['my_dump'];
	$filename= date('d-m-Y---H-i-s', time()).'.sql';
	$dir = dirname(__FILE__) .'\\..\\backup\\'.$filename;
	exec("{$my_dump} --user={$user} --password={$pass} --host={$host} --port={$port} --add-drop-database --add-drop-table --dump-date {$database} --result-file={$dir} 2>&1", $output);
	if (empty($output)){
		echo "ThanhCong";
	}
	?>