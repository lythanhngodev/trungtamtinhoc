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
$tg = time();
//$them_danhsach = $kn->query("SELECT kh.TENKHOA FROM danhsachdangkyduthi dk LEFT JOIN khaohoc kh ON dk.IDKH=kh.IDKH WHERE dk.IDDS = '$idds';");
$dem=0;
$stt = 1;
$kn->deletedata("DELETE FROM danhsachdangkyduthi_hocvien WHERE IDDS = '$idds';");
for ($i=0; $i < count($bhv); $i++) { 
	// xử lý số báo danh
    /*
	$skhoa = "K"; // thieu 3
	switch (strlen($tenkh)) {
		case 1:
			$skhoa.="00".$tenkh;
			break;
		case 2:
			$skhoa.="0".$tenkh;
			break;
		default:
			$skhoa.=$tenkh;
			break;
	}
	$sso = "CB"; // thieu 3
	switch (strlen($stt)) {
		case 1:
			$sso.="00".$stt;
			break;
		case 2:
			$sso.="0".$stt;
			break;
		default:
			$sso.=$stt;
			break;
	}
	$sbd = $skhoa.$sso;*/
    $hoi="INSERT INTO danhsachdangkyduthi_hocvien(IDDS,IDHV,GHICHU) VALUES ('$idds','".$bhv[$i][0]."','".$bhv[$i][1]."');";
    if (mysqli_query($kn->conn,$hoi)===TRUE){
        $dem++;$stt++;
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
