<?php
sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
require_once "../../__.php";
$ketqua = array('trangthai' => 0, 'thongbao' => '' );
function lamtron($so){
	$so = floatval($so);
	if ($so-intval($so)>=0.75) {
		return ceil($so);
	}
	if ($so-intval($so)>=0.25 && $so-intval($so)<0.75) {
		return ((ceil($so)-1)+0.5);
	}
	if ($so==0) {
		return 0;
	}
	else return ($so);
}
if (isset($_POST['bhv']) && !empty($_POST['bhv'])) {
	$kn = new clsKetnoi();
	$bhv = $_POST['bhv'];
	// Cập nhật thông tin học viên
	// Chuẩn hóa chuôi
	for ($i=0; $i < count($bhv); $i++) {
	    for ($j=0; $j < count($bhv[$i]); $j++) {
	    	$bhv[$i][$j] = mysqli_real_escape_string($kn->conn,$bhv[$i][$j]);
	    }
	}
	for ($i=0; $i < count($bhv); $i++) {
		$IDPT = $bhv[$i][0];
		$IDDS = $bhv[$i][1];
		$IDHV = $bhv[$i][2];
		$SBD = $bhv[$i][3];
		$DIEMLT=$bhv[$i][4];
		$DIEMTH=$bhv[$i][5];
		$GHICHUD = $bhv[$i][6];
		if (strlen($DIEMLT)==0)
			$DIEMLT = 0;
		else
			$DIEMLT = floatval($DIEMLT);

		if (strlen($DIEMTH)==0)
			$DIEMTH = 0;
		else
			$DIEMTH = floatval($DIEMTH);
		$DIEMLT = lamtron($DIEMLT);
		$DIEMTH = lamtron($DIEMTH);
		$qr_diem= "UPDATE danhsachdangkyduthi_hocvien
		SET 
			DIEMLT='$DIEMLT',
			DIEMTH='$DIEMTH',
			TONGDIEM='".($DIEMLT+$DIEMTH)."',
			GHICHUD='$GHICHUD'
		WHERE
			IDHV = '$IDHV' AND
			SBD = '$SBD'
			;";
		$kn->editdata($qr_diem);
	}
	$ketqua['thongbao'] = "Đã lưu";
	$ketqua['trangthai'] = 1;
	echo json_encode($ketqua);
	die();
}
else{
	$ketqua['thongbao'] = 'Có lỗi xảy ra, vui lòng load lại trang';
	echo json_encode($ketqua);
	die();
}
 ?>}
