<?php 
	require_once "../__.php";
	$kq = array(
		'trangthai'=>0
	);
	session_start();
	if (isset($_POST['khoahoc']) && !empty($_POST['khoahoc'])) {
		$kn = new clsKetnoi();
		$khoahoc = mysqli_real_escape_string($kn->conn,$_POST['khoahoc']);
		$batdau = mysqli_real_escape_string($kn->conn,$_POST['batdau']);
		$ketthuc = mysqli_real_escape_string($kn->conn,$_POST['ketthuc']);
		$kiemtra = $kn->adddata("INSERT INTO khoahoc (TENKHOA,TGBATDAU,TGKETTHUC) VALUES ('$khoahoc','$batdau','$ketthuc');");
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