<?php
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
include_once "../ec/PHPExcel.php";
require_once "../../__.php";
$ketqua = array('trangthai' => 0, 'thongbao' => 'Không thể nhập được lệ phí thi, thử lại sau' );
$file = $_FILES['file']['tmp_name'];
$dotthi = intval($_POST['dotthi']);
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$listWorkSheets = $objReader->listWorksheetNames($file);
$danhsach = null;
$kn = new clsKetnoi();
for($s=0;$s<count($listWorkSheets);$s++){
    $objReader->setLoadSheetsOnly($listWorkSheets[$s]);
    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
    $hightsRow = $objExcel->setActiveSheetIndex()->getHighestRow();
    for ($i=4; $i <=$hightsRow; $i++) { 
        $cmnd = trim($sheetData[$i]['D']);
        $cmnd = mysqli_real_escape_string($kn->conn,$cmnd);
        $sotien = trim($sheetData[$i]['E']);
        $sotien = mysqli_real_escape_string($kn->conn,$sotien);
        $sobienlai = trim($sheetData[$i]['F']);
        $sobienlai = mysqli_real_escape_string($kn->conn,$sobienlai);
        $ngayghibienlai = trim($sheetData[$i]['G']);
        $ngayghibienlai = mysqli_real_escape_string($kn->conn,$ngayghibienlai);
        if ($cmnd=='' || empty($cmnd) || $cmnd=='null')
            continue;
        $t_ds = [$cmnd,$sotien,$sobienlai,$ngayghibienlai,-1];
        $danhsach[] = $t_ds;
    }
}
for ($i=0; $i < count($danhsach); $i++) {
	for ($j=0; $j < count($danhsach[$i]); $j++) { 
		if ($danhsach[$i][$j]=='null' || $danhsach[$i][$j]=='NULL') {
			$danhsach[$i][$j]='';
		}
	}
}
for ($i=0; $i < count($danhsach); $i++) {
    $idhvl = $kn->query("SELECT dh.IDDKTHV FROM danhsachdangkyduthi_hocvien dh LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$dotthi' AND hv.CMND = '".$danhsach[$i][0]."' LIMIT 0,1;");
    $rid = mysqli_fetch_assoc($idhvl);
    $id = $rid['IDDKTHV'];
    if ($id>0) {
        $danhsach[$i][4] = $id;
    }
}

$demthanhcong=0;
for ($i=0; $i < count($danhsach); $i++) {
    if ($danhsach[$i][4]>0) {
        if (strlen($danhsach[$i][1])==0) {
            $kn->editdata("UPDATE danhsachdangkyduthi_hocvien SET PHITHI=NULL,SOBIENLAITHI='".$danhsach[$i][2]."',NGAYBIENLAITHI='".$danhsach[$i][3]."' WHERE IDDKTHV='".$danhsach[$i][4]."';");
        }else{
            $kn->editdata("UPDATE danhsachdangkyduthi_hocvien SET PHITHI='".$danhsach[$i][1]."',SOBIENLAITHI='".$danhsach[$i][2]."',NGAYBIENLAITHI='".$danhsach[$i][3]."' WHERE IDDKTHV='".$danhsach[$i][4]."';");
        }
        ++$demthanhcong;
    }
}
if ($demthanhcong>0) {
    $ketqua['trangthai']=1;
    $ketqua['thongbao']='Đã nhập thành công lệ phí thi';
    echo json_encode($ketqua);
    exit();
}
else{
    echo json_encode($ketqua);
    exit();
}
?>