<?php
	session_start();
	require_once "../__.php";
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	$gcof_bk=parse_ini_file('../lythanhngo.config.ltn');
    $kn = new clsKetnoi();
    if (isset($_SESSION['_us']) && isset($_SESSION['_pa']) && !empty($_SESSION['_us']) && !empty($_SESSION['_pa'])) {
    	if($kn->checklogin_session($_SESSION['_us'], $_SESSION['_pa'])!="admin")
    		$kn->golink($ttth['HOST']."/lg");
        else if($kn->checklogin_session($_SESSION['_us'], $_SESSION['_pa'])=="admin"){
            $sql = $kn->query("SELECT * FROM taikhoan WHERE (BINARY TDN='".$_SESSION['_us']."') and (BINARY MK='".$_SESSION['_pa']."') LIMIT 0,1");
			$database = $gcof_bk['db_name'];
			$user = $gcof_bk['db_user'];
			$pass = $gcof_bk['db_password'];
			$host = 'localhost';
			$port = $gcof_bk['db_port'];
			$my_dump = $gcof_bk['my_dump'];
			$filename= time().'.sql';
			$dir = dirname(__FILE__) .'\\..\\backup\\'.$filename;
			exec("{$my_dump} --user={$user} --password={$pass} --host={$host} --port={$port} --add-drop-database --add-drop-table --dump-date {$database} --result-file={$dir} 2>&1", $output);
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>BACKUP DỮ LIỆU</title>
			</head>
			<body>
				<?php if (empty($output)) {?>
					<h1>Sao lưu thành công!</h1>
					Tên file: <b><?php echo $filename; ?></b></a><br>
					<a href="..">Trở về</a>
				<?php }?>
			</body>
			</html>
			<?php
        }
    }
    else{
    	echo "<h1>Cảnh báo!!!</h1><h2>Truy cập trái phép</h2>";
    }
?>
