<?php
include_once "../ec/PHPExcel.php";
require_once "../../__.php";
$file = $_FILES['file']['tmp_name'];
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$listWorkSheets = $objReader->listWorksheetNames($file);
$danhsach = null;
for($s=0;$s<count($listWorkSheets);$s++){
    $objReader->setLoadSheetsOnly($listWorkSheets[$s]);
    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
    $hightsRow = $objExcel->setActiveSheetIndex()->getHighestRow();
    for ($i=2; $i <=$hightsRow; $i++) { 
    	$ho = trim($sheetData[$i]['B']);
        $ten = trim($sheetData[$i]['C']);
        $ngaysinh = trim($sheetData[$i]['D']);
        $gioitinh = trim($sheetData[$i]['E']);
        $noisinh = trim($sheetData[$i]['F']);
        $cmnd = trim($sheetData[$i]['G']);
        $mssv = trim($sheetData[$i]['H']);
        $ghichu = trim($sheetData[$i]['I']);
        if ($ten=='' || $cmnd=='' || empty($ten) || empty($cmnd) || $ten=='null' || $cmnd=='null')
            continue;
        $t_ds = [$ho,$ten,$ngaysinh,$gioitinh,$noisinh,$cmnd,$mssv,$ghichu,-1];
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
$kn = new clsKetnoi();
for ($i=0; $i < count($danhsach); $i++) {
    $kn->adddata("INSERT INTO hocvien(HO,TEN,NGAYSINH,GIOITINH,NOISINH,CMND,MSSV,GHICHU) VALUES ('".$danhsach[$i][0]."','".$danhsach[$i][1]."','".$danhsach[$i][2]."','".$danhsach[$i][3]."','".$danhsach[$i][4]."','".$danhsach[$i][5]."','".$danhsach[$i][6]."','".$danhsach[$i][7]."');");
}
for ($i=0; $i < count($danhsach); $i++) {
    $hoi = $kn->query("SELECT IDHV FROM hocvien WHERE CMND='".$danhsach[$i][5]."' AND TEN = '".$danhsach[$i][1]."'");
    $row = mysqli_fetch_array($hoi);
    $danhsach[$i][8] = $row[0];
}
echo json_encode($danhsach);
?>