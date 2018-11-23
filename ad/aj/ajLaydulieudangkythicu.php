<?php
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
include_once "../ec/PHPExcel.php";
require_once "../../__.php";
$file = $_FILES['file']['tmp_name'];
$idds = intval($_POST['dotthi']);
if ($idds<=0) {
    echo "Chưa chọn đợt thi";
    die();
}
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$listWorkSheets = $objReader->listWorksheetNames($file);
$danhsach = null;
for($s=0;$s<count($listWorkSheets);$s++){
    $objReader->setLoadSheetsOnly($listWorkSheets[$s]);
    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
    $hightsRow = $objExcel->setActiveSheetIndex()->getHighestRow();
    for ($i=2; $i <=$hightsRow; $i++) { 
    	$sbd = trim($sheetData[$i]['B']);
        $ho = trim($sheetData[$i]['C']);
        $ten = trim($sheetData[$i]['D']);
        $ngaysinh = trim($sheetData[$i]['E']);
        $gioitinh = trim($sheetData[$i]['F']);
        $noisinh = trim($sheetData[$i]['G']);
        $cmnd = trim($sheetData[$i]['H']);
        $mssv = trim($sheetData[$i]['I']);
        $mabienlai = trim($sheetData[$i]['J']);
        $ngaybienlai = trim($sheetData[$i]['K']);
        $sotien = trim($sheetData[$i]['L']);
        $ghichu = trim($sheetData[$i]['M']);
        if ($ten=='' || $cmnd=='' || empty($ten) || empty($cmnd) || $ten=='null' || $cmnd=='null' || $sbd=='' || empty($sbd) || $sbd=='null')
            continue;
        $t_ds = [$sbd,$ho,$ten,$ngaysinh,$gioitinh,$noisinh,$cmnd,$mssv,$mabienlai,$ngaybienlai,$sotien,$ghichu,-1]; // -1 là IDHV
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
    $kn->adddata("INSERT INTO hocvien(HO,TEN,NGAYSINH,GIOITINH,NOISINH,CMND,MSSV) VALUES ('".$danhsach[$i][1]."','".$danhsach[$i][2]."','".$danhsach[$i][3]."','".$danhsach[$i][4]."','".$danhsach[$i][5]."','".$danhsach[$i][6]."','".$danhsach[$i][7]."');");
}
for ($i=0; $i < count($danhsach); $i++) {
    $hoi = $kn->query("SELECT IDHV FROM hocvien WHERE CMND='".$danhsach[$i][6]."' AND TEN = '".$danhsach[$i][2]."'");
    $row = mysqli_fetch_array($hoi);
    $danhsach[$i][12] = $row[0];
}
for ($i=0; $i < count($danhsach); $i++) {
    $kn->adddata("INSERT INTO danhsachdangkyduthi_hocvien(IDDS,IDHV,SBD,SOBIENLAITHI,NGAYBIENLAITHI,PHITHI,GHICHU) VALUES ('".$idds."','".$danhsach[$i][12]."','".$danhsach[$i][0]."','".$danhsach[$i][8]."','".$danhsach[$i][9]."','".str_replace(",","",$danhsach[$i][10])."','".$danhsach[$i][11]."');");
}
?>
<table id="banglophoc" class="table table-hover display nowrap table-bordered" style="width: 100%">
    <thead>
        <tr style="text-align: center;">
            <th>TT</th>
            <th>SBD</th>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Nơi sinh</th>
            <th>CMND</th>
            <th>MSSV</th>
            <th>Mã BL</th>
            <th>Ngày BL</th>
            <th>Số tiền</th>
            <th>Ghi chú</th>
        </tr>
    </thead>
    <tbody>
<?php
$stt = 0;
for ($i=0; $i < count($danhsach); $i++) {
    if ($danhsach[$i][12]!=-1) { ?>
    <tr> 
        <td><?php echo ++$stt; ?></td>
        <td><?php echo $danhsach[$i][0] ?></td>
        <td><?php echo $danhsach[$i][1]." ".$danhsach[$i][2] ?></td>
        <td><?php echo $danhsach[$i][3] ?></td>
        <td><?php echo $danhsach[$i][4] ?></td>
        <td><?php echo $danhsach[$i][5] ?></td>
        <td><?php echo $danhsach[$i][6] ?></td>
        <td><?php echo $danhsach[$i][7] ?></td>
        <td><?php echo $danhsach[$i][8] ?></td>
        <td><?php echo $danhsach[$i][9] ?></td>
        <td><?php echo $danhsach[$i][10] ?></td>
        <td><?php echo $danhsach[$i][11] ?></td>
    </tr>
<?php }
}
?>
    </tbody>
    <center>
        <div class="form-group col-md-3">
            <label><b>Danh sách học viên đã thêm</b></label>
        </div>
    </center>
</table>