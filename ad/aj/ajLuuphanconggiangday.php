<?php
sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
require_once "../../__.php";
$ketqua = array('trangthai' => 0, 'thongbao' => '' ); 
$kn = new clsKetnoi();
$bhv = $_POST['bpc'];
// Cập nhật thông tin học viên
$qr_hocvien="";
// Chuẩn hóa chuôi
for ($i=0; $i < count($bhv); $i++) {
    for ($j=0; $j < count($bhv[$i]); $j++) {
    	$bhv[$i][$j] = mysqli_real_escape_string($kn->conn,$bhv[$i][$j]);
    }
}
for ($i=0; $i < count($bhv); $i++) {
	$MALOP = $bhv[$i][0];
	$CANBO = $bhv[$i][1];
	$SOTIET = $bhv[$i][2];
	$TU = $bhv[$i][3];
	$DEN = $bhv[$i][4];
	$BUOI = $bhv[$i][5];
	$DIADIEM = $bhv[$i][6];
	$qr_hocvien.="DELETE FROM phanconggiangday WHERE MALOP IN (SELECT MALOP FROM phanconggiangday WHERE MALOP='$MALOP');";
	$qr_hocvien.= "INSERT INTO phanconggiangday(MALOP,TUNGAY, DENNGAY, TENCB, BUOIDAY, DIADIEM,SOTIET) VALUES ('$MALOP','$TU','$DEN','$CANBO','$BUOI','$DIADIEM','$SOTIET');";
}
mysqli_multi_query($kn->conn,$qr_hocvien);
$ketqua['thongbao'] = "Đã lưu";
$ketqua['trangthai'] = 1;
echo json_encode($ketqua);
die();
 ?>}
