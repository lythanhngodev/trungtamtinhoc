<?php 
	sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
	require_once "../../__.php";
	$kq = array(
		'trangthai'=>0
	);
	if (isset($_POST['dotthi']) && !empty($_POST['dotthi'])) {
		$kn = new clsKetnoi();
		$id = intval($_POST['dotthi']);
		$kiemtra = $kn->editdata("UPDATE danhsachdangkyduthi SET HOANTHANH=b'0' WHERE IDDS='$id';");
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