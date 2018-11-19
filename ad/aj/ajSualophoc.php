<?php 
	sleep(1);
	require_once "../../__.php";
	$kq = array(
		'trangthai'=>0
	);
	if (isset($_POST['lophoc']) && !empty($_POST['lophoc'])) {
		$kn = new clsKetnoi();
		$lophoc = mysqli_real_escape_string($kn->conn,$_POST['lophoc']);
		$diengiai = mysqli_real_escape_string($kn->conn,$_POST['diengiai']);
		$id = intval($_POST['idl']);
		if ($kn->editdata("UPDATE lop SET TENLOP='$lophoc', DIENGIAI='$diengiai' WHERE IDL='$id'")) {
			$kq['trangthai']=1;
			echo json_encode($kq);
		}
		else
			echo json_encode($kq);
	}
	else echo json_encode($kq);
	exit();
 ?>