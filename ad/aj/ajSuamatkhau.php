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
		$mkc = mysqli_real_escape_string($kn->conn,$_POST['mkc']);
		$mkc = md5($mkc);
		$mkm = mysqli_real_escape_string($kn->conn,$_POST['mkm']);
		$mkm = md5($mkm);
		$id = intval($_POST['id']);
		if ($kn->editdata("UPDATE taikhoan SET MK='$mkm' WHERE IDTK='$id' AND BINARY MK = '$mkc';")) {
	    	if($kn->checklogin_session($_SESSION['_us'], $mkm)!="admin"){
	    		echo json_encode($kq);
	    		die();
	    	}
	        else if($kn->checklogin_session($_SESSION['_us'], $mkm)=="admin"){
	        	$_SESSION['_pa'] = $mkm;
				$kq['trangthai']=1;
				echo json_encode($kq);
				die();
	        }
				$kq['trangthai']=1;
				echo json_encode($kq);
				die();
		}
		else
			echo json_encode($kq);
			die();
	}
	else echo json_encode($kq);
	exit();
 ?>