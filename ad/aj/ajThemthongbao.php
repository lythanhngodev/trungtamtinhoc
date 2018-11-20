<?php 
	sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
	require_once "../../__.php";
	$kq = array(
		'trangthai'=>0
	);
	if (isset($_POST['ten']) && !empty($_POST['ten'])) {
		$kn = new clsKetnoi();
		$ten = mysqli_real_escape_string($kn->conn,$_POST['ten']);
		$mota = mysqli_real_escape_string($kn->conn,$_POST['mota']);
		$noidung = mysqli_real_escape_string($kn->conn,$_POST['noidung']);
	    $noidung = str_replace('&ensp;',' ',$noidung);
	    $noidung = str_replace('&nbsp;',' ',$noidung);
		$nguoidang = $_SESSION['_tencb'];
		$link = $kn->to_slug($ten);
		$sql = "
			INSERT INTO thongbao (TENTB, MOTA, NOIDUNG, NGAYDANG, NGUOIDANG,LINK) VALUES ('$ten','$mota','$noidung','".date('Y/m/d')."','$nguoidang','$link');
		";
		if ($kn->query($sql)) {
			$kq['trangthai']=1;
			echo json_encode($kq);
			exit();
		}
	}
	else echo json_encode($kq);
	exit();
 ?>