<?php 
	sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
	require_once "../../__.php";
	$kq = array(
		'trangthai'=>0
	);
	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$kn = new clsKetnoi();
		$ten = mysqli_real_escape_string($kn->conn,$_POST['ten']);
		$tdn = mysqli_real_escape_string($kn->conn,$_POST['tdn']);
		$mail = mysqli_real_escape_string($kn->conn,$_POST['mail']);
		$id = intval($_POST['id']);
		if ($kn->editdata("UPDATE taikhoan SET HT='$ten', TDN='$tdn', MAIL ='$mail' WHERE IDTK='$id'")) {
			$kq['trangthai']=1;
			echo json_encode($kq);
		}
		else
			echo json_encode($kq);
	}
	else echo json_encode($kq);
	exit();
 ?>