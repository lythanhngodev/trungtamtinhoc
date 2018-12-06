<?php
sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
require_once "../../__.php";
$ketqua = array('trangthai' => 0, 'thongbao' => '' ); 
if (!isset($_SESSION['_token']) || empty($_SESSION['_token'])) {
	echo json_encode($ketqua);
	die();
}
$_token = $_SESSION['_token'];
if (isset($_POST['bhv']) && !empty($_POST['bhv']) && isset($_POST['_token']) && !empty($_POST['_token'])) {
	if ($_token==$_POST['_token']) {
		$_SESSION['_token']=_token(256);
		$kn = new clsKetnoi();
		$bhv = $_POST['bhv'];
		// Chuẩn hóa chuôi
		for ($i=0; $i < count($bhv); $i++) {
		    for ($j=0; $j < count($bhv[$i]); $j++) {
		    	$bhv[$i][$j] = mysqli_real_escape_string($kn->conn,$bhv[$i][$j]);
		    }
		}
		// Cập nhật thông tin học viên
		for ($i=0; $i < count($bhv); $i++) {
			$MSSV = $bhv[$i][5];
			$HO = $bhv[$i][6];
			$TEN = $bhv[$i][7];
			$CMND = $bhv[$i][8];
			$NGAYSINH = $bhv[$i][9];
			$GIOITINH = $bhv[$i][10];
			$NOISINH = $bhv[$i][11];
			$SDT = $bhv[$i][12];
			$MASOBIENLAI = $bhv[$i][13];
			$NGAYGHIBIENLAI = $bhv[$i][14];
			$GHICHU = $bhv[$i][15];
			$qr_hocvien= "UPDATE hocvien
			SET 
				MSSV='$MSSV',
				HO='$HO',
				TEN='$TEN',
				CMND='$CMND',
				NGAYSINH='$NGAYSINH',
				GIOITINH='$GIOITINH',
				NOISINH='$NOISINH',
				SDT='$SDT',
				MASOBIENLAI='$MASOBIENLAI',
				NGAYGHIBIENLAI='$NGAYGHIBIENLAI',
				GHICHU='$GHICHU'
			WHERE
				IDHV = '".$bhv[$i][0]."'
				;";
			if (strlen($CMND)==0) {
				$qr_hocvien= "UPDATE hocvien
				SET 
					MSSV='$MSSV',
					HO='$HO',
					TEN='$TEN',
					CMND=NULL,
					NGAYSINH='$NGAYSINH',
					GIOITINH='$GIOITINH',
					NOISINH='$NOISINH',
					SDT='$SDT',
					MASOBIENLAI='$MASOBIENLAI',
					NGAYGHIBIENLAI='$NGAYGHIBIENLAI',
					GHICHU='$GHICHU'
				WHERE
					IDHV = '".$bhv[$i][0]."'
					;";
			}
			$kn->editdata($qr_hocvien);
		}
		$ketqua['thongbao'] = "Đã lưu thông tin học viên";
		$ketqua['trangthai'] = 1;
		echo json_encode($ketqua);
		die();
	}
	else{
		$ketqua['thongbao'] = 'Bạn đã thao tác dư liệu này rồi';
		$_SESSION['_token']=_token(256);
		echo json_encode($ketqua);
		die();
	}
}
else{
	$ketqua['thongbao'] = 'Có lỗi xảy ra, vui lòng load lại trang';
	$_SESSION['_token']=_token(256);
	echo json_encode($ketqua);
	die();
}
 ?>}
