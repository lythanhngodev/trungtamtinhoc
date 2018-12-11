<?php 
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
    $kq = array(
        'trangthai'=>0
    );
if (!isset($_POST['bhv']) || empty($_POST['bhv'])) {
    echo json_encode($kq);
    die();
}
require_once '../../__.php';
$kn = new clsKetnoi();
$idpk = $_POST['iddt'];
$bhv = $_POST['bhv'];
$tg = time();
$dem=0;
$kn->deletedata("DELETE FROM danhsachphuckhao_hocvien WHERE IDPK = '$idpk';");
// Chuẩn hóa chuôi
for ($i=0; $i < count($bhv); $i++) {
    for ($j=0; $j < count($bhv[$i]); $j++) {
    	$bhv[$i][$j] = mysqli_real_escape_string($kn->conn,$bhv[$i][$j]);
    }
}
for ($i=0; $i < count($bhv); $i++) { 
    $hoi="INSERT INTO danhsachphuckhao_hocvien(IDPK,IDDKTHV,THILT,THITH,SOBIENLAIPK,PHIPK,NGAYBIENLAIPK) VALUES ('$idpk','".$bhv[$i][0]."',b'".$bhv[$i][1]."',b'".$bhv[$i][2]."','".$bhv[$i][3]."','".intval($bhv[$i][4])."','".$bhv[$i][5]."');";
    if (mysqli_query($kn->conn,$hoi)===TRUE){
        $dem++;
    }
}
if ($dem>0) {
    $kq['trangthai'] = 1;
    echo json_encode($kq);
    die();
}
echo json_encode($kq);
die();
?>
