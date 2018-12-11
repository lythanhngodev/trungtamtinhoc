<?php 
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
    $kq = array(
        'trangthai'=>0,
        'thongbao' =>'Có lỗi, vui lòng thửu lại'
    );
if (!isset($_POST['bhv']) || empty($_POST['bhv'])) {
    echo json_encode($kq);
    die();
}
require_once '../../__.php';
$kn = new clsKetnoi();
$bhv = $_POST['bhv'];
$tg = time();
$dem=0;
// Chuẩn hóa chuôi
for ($i=0; $i < count($bhv); $i++) {
    for ($j=0; $j < count($bhv[$i]); $j++) {
    	$bhv[$i][$j] = mysqli_real_escape_string($kn->conn,$bhv[$i][$j]);
    }
}
// Kiểm tra trùng số báo danh
$trungsbd=0;
$mangtrungsbd = null;
for ($i=0; $i < count($bhv); $i++) { 
    if ($kn->tontai("SELECT IDDKTHV FROM danhsachdangkyduthi_hocvien WHERE SBD='".$bhv[$i][1]."' AND IDDKTHV != '".$bhv[$i][0]."'")) {
    	++$trungsbd;
    	$mangtrungsbd[$trungsbd] = $bhv[$i][1];
    }
}
if ($trungsbd>0) {
	$kq['thongbao'] = 'Phát hiện bị trùng SBD '.json_encode($mangtrungsbd).', kiểm tra lại';
	echo json_encode($kq);
	die();
}

// Cập nhật số báo danh
for ($i=0; $i < count($bhv); $i++) { 
	$hoi = "
		UPDATE danhsachdangkyduthi_hocvien
		SET
			SBD = NULL,
			GHICHUDIEUCHINH = '".$bhv[$i][10]."'
		WHERE IDDKTHV = '".$bhv[$i][0]."';
	";
    if (strlen($bhv[$i][1])>0) {
    	$hoi = "
    	UPDATE danhsachdangkyduthi_hocvien
    	SET
    		SBD = '".$bhv[$i][1]."',
    		GHICHUDIEUCHINH = '".$bhv[$i][10]."'
    	WHERE IDDKTHV = '".$bhv[$i][0]."';
    	";
    }
    if (mysqli_query($kn->conn,$hoi)===TRUE){
        $dem++;
    }
}
// Cập nhật thông tin học viên
for ($i=0; $i < count($bhv); $i++) { 
	$ho=$bhv[$i][3];
	$ten=$bhv[$i][4];
	$gioitinh=$bhv[$i][5];
	$ngaysinh=$bhv[$i][6];
	$noisinh=$bhv[$i][7];
	$cmnd=$bhv[$i][8];
	$mssv=$bhv[$i][9];
	$idhv = $bhv[$i][2];
	$qr_hocvien= "UPDATE hocvien
	SET 
		MSSV='$mssv',
		HO='$ho',
		TEN='$ten',
		CMND='$cmnd',
		NGAYSINH='$ngaysinh',
		GIOITINH='$gioitinh',
		NOISINH='$noisinh'
	WHERE
		IDHV = '$idhv';";
    if (strlen($cmnd)==0) {
	$qr_hocvien= "UPDATE hocvien
		SET 
			MSSV='$mssv',
			HO='$ho',
			TEN='$ten',
			CMND=NULL,
			NGAYSINH='$ngaysinh',
			GIOITINH='$gioitinh',
			NOISINH='$noisinh'
		WHERE
			IDHV = '$idhv';";
    }
    mysqli_query($kn->conn,$qr_hocvien);
}
if ($dem>0) {
    $kq['trangthai'] = 1;
    $kq['thongbao'] = 'Đã đánh số báo danh';
    echo json_encode($kq);
    die();
}
echo json_encode($kq);
die();
?>
