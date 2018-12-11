<?php
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
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
    for ($i=9; $i <=$hightsRow; $i++) { 
    	$sbd = trim($sheetData[$i]['A']);
        if ($sbd=='CHỦ TỊCH HỘI ĐỒNG THI') {
            break;
        }
        $sbd = trim($sheetData[$i]['B']);
        $lythuyet = trim($sheetData[$i]['I']);
        $thuchanh = trim($sheetData[$i]['K']);
        $lythuyet = floatval($lythuyet);
        $thuchanh = floatval($thuchanh);
        if ($sbd=='' || empty($sbd) || $sbd=='null' || $sbd=='NULL')
            continue;
        $t_ds = [$sbd,$lythuyet,$thuchanh];
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