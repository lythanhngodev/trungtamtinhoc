<?php
sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
require_once "../../__.php";
$ketqua = array('trangthai' => 0, 'thongbao' => '' ); 
if (isset($_POST['bhv']) && !empty($_POST['bhv']) && isset($_POST['_token']) && !empty($_POST['_token'])) {
		$kn = new clsKetnoi();
		$bhv = $_POST['bhv'];
		// Cập nhật thông tin học viên
		for ($i=0; $i < count($bhv); $i++) {
			$MSSV = $bhv[$i][2];
			$HO = $bhv[$i][3];
			$TEN = $bhv[$i][4];
			$CMND = $bhv[$i][5];
			$NGAYSINH = $bhv[$i][6];
			$GIOITINH = $bhv[$i][7];
			$NOISINH = $bhv[$i][8];
			$SDT = $bhv[$i][9];
			$MASOBIENLAI = $bhv[$i][10];
			$NGAYGHIBIENLAI = $bhv[$i][11];
			$GHICHU = $bhv[$i][12];
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
				IDHV = '".$bhv[$i][1]."'
				;";
			$sua_hocvien = $kn->editdata($qr_hocvien);
		}
		$ketqua['thongbao'] = "Đã lưu thông tin học viên";
		$ketqua['trangthai'] = 1;
		echo json_encode($ketqua);
		die();
}
else{
	$ketqua['thongbao'] = 'Có lỗi xảy ra, vui lòng load lại trang';
	die();
}
 ?>}
