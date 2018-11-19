<?php
include_once "../ec/PHPExcel.php";
require_once "../__.php";
$file = $_FILES['file']['tmp_name'];
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$listWorkSheets = $objReader->listWorksheetNames($file);
$danhsach = null;
for($s=0;$s<count($listWorkSheets);$s++){
    $objReader->setLoadSheetsOnly($listWorkSheets[$s]);
    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
    $hightsRow = $objExcel->setActiveSheetIndex()->getHighestRow();
    for ($i=9; $i <=$hightsRow; $i++) { 
    	$sbd = trim($sheetData[$i]['B']);
        if ($sbd=='CHỦ TỊCH HỘI ĐỒNG THI') {
            break;
        }
        $lythuyet = trim($sheetData[$i]['I']);
        $thuchanh = trim($sheetData[$i]['J']);
        $ghichu = trim($sheetData[$i]['M']);
        $lythuyet = floatval($lythuyet);
        $thuchanh = floatval($thuchanh);
        if ($sbd=='' || empty($sbd) || $sbd=='null' || $sbd=='NULL')
            continue;
        $t_ds = [$sbd,$lythuyet,$thuchanh,$ghichu];
        $danhsach[] = $t_ds;
    }
}
for ($i=0; $i < count($danhsach); $i++) {
	for ($j=0; $j < count($danhsach[$i]); $j++) { 
		if ($danhsach[$i][$j]=='null' || $danhsach[$i][$j]=='NULL') {
			$danhsach[$i][$j]='0';
            if ($j==3) {
               $danhsach[$i][$j]='';
            }
		}
	}

}
echo json_encode($danhsach);
?>