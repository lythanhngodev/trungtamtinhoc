<?php
sleep(1);
session_start();
require_once "../__.php";
$ketqua = array('trangthai' => 0, 'thongbao' => '' ); 
$kn = new clsKetnoi();
$bhv = $_POST['bpc'];
// Cập nhật thông tin học viên
$qr_hocvien="";
for ($i=0; $i < count($bhv); $i++) {
	$MALOP = $bhv[$i][0];
	$CANBO = $bhv[$i][1];
	$TU = $bhv[$i][2];
	$DEN = $bhv[$i][3];
	$BUOI = $bhv[$i][4];
	$DIADIEM = $bhv[$i][5];
	$qr_hocvien.="DELETE FROM phanconggiangday WHERE MALOP IN (SELECT MALOP FROM phanconggiangday WHERE MALOP='$MALOP');";
	$qr_hocvien.= "INSERT INTO phanconggiangday(MALOP,TUNGAY, DENNGAY, TENCB, BUOIDAY, DIADIEM) VALUES ('$MALOP','$TU','$DEN','$CANBO','$BUOI','$DIADIEM');";
}
mysqli_multi_query($kn->conn,$qr_hocvien);
$ketqua['thongbao'] = "Đã lưu";
$ketqua['trangthai'] = 1;
echo json_encode($ketqua);
die();
 ?>}
