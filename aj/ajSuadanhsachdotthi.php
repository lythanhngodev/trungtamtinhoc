<?php 
	sleep(1);
	require_once "../__.php";
	$kq = array(
		'trangthai'=>0
	);
	session_start();
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