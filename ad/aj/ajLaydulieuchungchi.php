<?php
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
include_once "../ec/PHPExcel.php";
require_once "../../__.php";
$file = $_FILES['file']['tmp_name'];
$kn = new clsKetnoi();
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$listWorkSheets = $objReader->listWorksheetNames($file);
$danhsach = null;
for($s=0;$s<count($listWorkSheets);$s++){
    $objReader->setLoadSheetsOnly($listWorkSheets[$s]);
    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
    $hightsRow = $objExcel->setActiveSheetIndex()->getHighestRow();
    $stt=0;
    for ($i=4; $i <=$hightsRow; $i++) { 
    	$hoten = trim($sheetData[$i]['B']);
        $ngaysinh = trim($sheetData[$i]['C']);
        $ngaysinh = mysqli_real_escape_string($kn->conn,$ngaysinh);
        $noisinh = trim($sheetData[$i]['D']);
        $noisinh = mysqli_real_escape_string($kn->conn,$noisinh);
        $sohieu = trim($sheetData[$i]['E']);
        $sohieu = mysqli_real_escape_string($kn->conn,$sohieu);
        $sovaoso = trim($sheetData[$i]['F']);
        $sovaoso = mysqli_real_escape_string($kn->conn,$sovaoso);
        $ngayvaoso = trim($sheetData[$i]['G']);
        $tracnghiem = trim($sheetData[$i]['H']);
        $thuchanh = trim($sheetData[$i]['I']);
        $sbd = trim($sheetData[$i]['J']);
        $ghichu = trim($sheetData[$i]['K']);
        if ($hoten=='' || empty($hoten) ||  $hoten=='null')
            continue;
        $t_ds = [(++$stt),$hoten,$ngaysinh,$noisinh,$sohieu,$sovaoso,$ngayvaoso,$tracnghiem,$thuchanh,$sbd,$ghichu]; // -1 là IDHV
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
    $kn->editdata("
        UPDATE danhsachdangkyduthi_hocvien
        SET
            SOGHISO = '".$danhsach[$i][5]."',
            SOHIEU = '".$danhsach[$i][4]."',
            NGAYVAOSO = '".$danhsach[$i][6]."',
            GHICHUCC = '".$danhsach[$i][10]."'
        WHERE
            SBD = '".$danhsach[$i][9]."'
    ");
}
die();
?>
<table id="banglophoc" class="table table-hover display nowrap table-bordered" style="width: 100%">
    <thead>
        <tr style="text-align: center;">
            <th>TT</th>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Nơi sinh</th>
            <th>Số hiệu</th>
            <th>Ngày vào sổ</th>
            <th>Điểm LT</th>
            <th>Điểm TH</th>
            <th>Số báo danh</th>
            <th>Ghi chú</th>
        </tr>
    </thead>
    <tbody>
<?php
for ($i=0; $i < count($danhsach); $i++) { ?>
    <tr> 
        <td><?php echo $danhsach[$i][0] ?></td>
        <td><?php echo $danhsach[$i][1] ?></td>
        <td class="text-center"><?php echo $danhsach[$i][2] ?></td>
        <td class="text-center"><?php echo $danhsach[$i][3] ?></td>
        <td class="text-center"><?php echo $danhsach[$i][4] ?></td>
        <td class="text-center"><?php echo $danhsach[$i][5] ?></td>
        <td class="text-center"><?php echo $danhsach[$i][6] ?></td>
        <td class="text-center"><?php echo $danhsach[$i][7] ?></td>
        <td class="text-center"><?php echo $danhsach[$i][8] ?></td>
        <th class="text-center"><?php echo $danhsach[$i][9] ?></th>
    </tr>
<?php
}
?>
    </tbody>
    <center>
        <div class="form-group col-md-3">
            <label><b>Danh sách học viên được cấp chứng chỉ</b></label>
        </div>
    </center>
</table>