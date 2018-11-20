<?php 
	sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
	require_once "../../__.php";
	$kq = array(
		'trangthai'=>0
	);
	if (isset($_POST['tends']) && !empty($_POST['tends'])) {
		$kn = new clsKetnoi();
		$tends = mysqli_real_escape_string($kn->conn,$_POST['tends']);
		$id = intval($_POST['id']);
		$kiemtra = $kn->editdata("UPDATE danhsachdangkyduthi SET TENDS='$tends' WHERE IDDS='$id';");
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