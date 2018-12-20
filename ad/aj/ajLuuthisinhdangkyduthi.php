<?php 
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
    $kq = array(
        'trangthai'=>0
    );
if (!isset($_POST['bhv']) || empty($_POST['bhv']) || !isset($_POST['idds']) || empty($_POST['idds'])) {
    echo json_encode($kq);
    die();
}
require_once '../../__.php';
$kn = new clsKetnoi();
$idds = $_POST['idds'];
$bhv = $_POST['bhv'];
$dem=0;
$stt = 1;
// Chuẩn hóa chuôi
for ($i=0; $i < count($bhv); $i++) {
    for ($j=0; $j < count($bhv[$i]); $j++) {
    	$bhv[$i][$j] = mysqli_real_escape_string($kn->conn,$bhv[$i][$j]);
    }
}
// lấy danh sách thí sinh từ csdl
$str = "SELECT IDDKTHV,IDDS,IDHV FROM danhsachdangkyduthi_hocvien WHERE IDDS='$idds'";
$dulieu = $kn->query($str);
$mangdl = null;
while ($row = mysqli_fetch_assoc($dulieu)) {
	$mangdl[]=$row;
}
$khongcsdl = null;
// có trong csdl nhưng ko có trong danh sách
for ($i=0; $i < count($mangdl); $i++) { 
	$kt = 0;
	for ($j=0; $j < count($bhv); $j++) { 
		if ($mangdl[$i]['IDHV']==$bhv[$j][0]) {
			$kt++;
		}
	}
	if ($kt==0) {
		$kn->deletedata("DELETE FROM danhsachdangkyduthi_hocvien WHERE IDDS = '$idds' AND IDHV = '".$mangdl[$i]['IDHV']."';");
		$dem++;
	}
}


$str = "SELECT IDDKTHV,IDDS,IDHV FROM danhsachdangkyduthi_hocvien WHERE IDDS='$idds'";
$dulieu = $kn->query($str);
$mangdl = null;
while ($row = mysqli_fetch_assoc($dulieu)) {
	$mangdl[]=$row;
}
$khongcsdl = null;
// có trong danh sách nhưng không có trong csdl
for ($i=0; $i < count($bhv); $i++) { 
	$kt = 0;
	for ($j=0; $j < count($mangdl); $j++) { 
		if ($bhv[$i][0]==$mangdl[$j]['IDHV']) {
			$kt++;
		}
	}
	if ($kt==0) {
		// trường hợp KHÔNG có trong csdl
	    $hoi="INSERT INTO danhsachdangkyduthi_hocvien(IDDS,IDHV,GHICHU) VALUES ('$idds','".$bhv[$i][0]."','".$bhv[$i][1]."');";
	    if (mysqli_query($kn->conn,$hoi)===TRUE){
	        $dem++;$stt++;
	    }
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
