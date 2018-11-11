<?php 
	sleep(1);
	require_once "../__.php";
	$kq = array(
		'trangthai'=>0
	);
	session_start();
	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$kn = new clsKetnoi();
		$id = intval($_POST['id']);
		$kiemtra = $kn->deletedata("DELETE FROM danhsachdangkyduthi WHERE IDDS='$id';");
		if ($kiemtra>0) {
			$kq['trangthai']=1;
			$kn->deletedata("DELETE FROM danhsachdangkyduthi_hocvien WHERE IDDS='$id';");
			echo json_encode($kq);
		}
		else
			echo json_encode($kq);
	}
	else echo json_encode($kq);
	exit();
 ?>