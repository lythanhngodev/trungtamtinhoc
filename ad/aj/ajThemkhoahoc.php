<?php 
	sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
	require_once "../../__.php";
	$kq = array(
		'trangthai'=>0
	);
	if (isset($_POST['khoahoc']) && !empty($_POST['khoahoc'])) {
		$kn = new clsKetnoi();
		$khoahoc = mysqli_real_escape_string($kn->conn,$_POST['khoahoc']);
		$batdau = mysqli_real_escape_string($kn->conn,$_POST['batdau']);
		$ketthuc = mysqli_real_escape_string($kn->conn,$_POST['ketthuc']);
		$loaikhoa = mysqli_real_escape_string($kn->conn,$_POST['loaikhoa']);
		$kiemtra = $kn->adddata("INSERT INTO khoahoc (TENKHOA,TGBATDAU,TGKETTHUC,LOAIKHOA) VALUES ('$khoahoc','$batdau','$ketthuc','$loaikhoa');");
		if ($kiemtra>0) {
			$kq['trangthai']=1;
			echo json_encode($kq);
		}
		else
			echo json_encode($kq);
	}
	else echo json_encode($kq);
	exit();
 ?>