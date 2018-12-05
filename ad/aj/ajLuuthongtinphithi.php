<?php
sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
require_once "../../__.php";
$ketqua = array('trangthai' => 0, 'thongbao' => '' ); 
$kn = new clsKetnoi();
$bhv = $_POST['bhv'];
// Cập nhật thông tin học viên
$qr_hocvien="";
for ($i=0; $i < count($bhv); $i++) {
	$idhvl = $bhv[$i][0];
	$idhvl = mysqli_real_escape_string($kn->conn,$idhvl);
	$sotien = $bhv[$i][1];
	$sotien = mysqli_real_escape_string($kn->conn,$sotien);
	$sobienlai = $bhv[$i][2];
	$sobienlai = mysqli_real_escape_string($kn->conn,$sobienlai);
	$ngayghibienlai = $bhv[$i][3];
	$ngayghibienlai = mysqli_real_escape_string($kn->conn,$ngayghibienlai);
	if (strlen($sotien)==0) {
		$qr_hocvien.= "UPDATE danhsachdangkyduthi_hocvien SET PHITHI=NULL,SOBIENLAITHI='$sobienlai',NGAYBIENLAITHI='$ngayghibienlai' WHERE IDDKTHV='$idhvl';";
	}else{
		$qr_hocvien.= "UPDATE danhsachdangkyduthi_hocvien SET PHITHI='$sotien',SOBIENLAITHI='$sobienlai',NGAYBIENLAITHI='$ngayghibienlai' WHERE IDDKTHV='$idhvl';";
	}
}
mysqli_multi_query($kn->conn,$qr_hocvien);
$ketqua['thongbao'] = "Đã lưu thông tin";
$ketqua['trangthai'] = 1;
echo json_encode($ketqua);
die();
 ?>}
