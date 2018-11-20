<?php 
	sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
	require_once "../../__.php";
	$kq = array(
		'trangthai'=>0
	);
	if (isset($_POST['lophoc']) && !empty($_POST['lophoc'])) {
		$kn = new clsKetnoi();
		$lophoc = mysqli_real_escape_string($kn->conn,$_POST['lophoc']);
		$diengiai = mysqli_real_escape_string($kn->conn,$_POST['diengiai']);
		$khoahoc = intval($_POST['khoahoc']);
		$kiemtra = $kn->adddata("INSERT INTO lop (TENLOP) VALUES ('$lophoc');");
		if ($kiemtra>0) {
			$idl = mysqli_insert_id($kn->conn);
			if ($khoahoc!=0) {
				$kiemtra = $kn->adddata("INSERT INTO khoahoc_lop (IDKH, IDL, DIENGIAI) VALUES ('$khoahoc','$idl','$diengiai');");
				if ($kiemtra>0) {
				$kq['trangthai']=1;
				echo json_encode($kq);
				die();
				}
			}
			$kq['trangthai']=1;
			echo json_encode($kq);
			die();
		}
		else
			echo json_encode($kq);
	}
	else echo json_encode($kq);
	exit();
 ?>