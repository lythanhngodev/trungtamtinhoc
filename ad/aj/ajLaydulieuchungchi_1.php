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
        $t_ds = [(++$stt),$hoten,$ngaysinh,$noisinh,$sohieu,$sovaoso,$ngayvaoso,$tracnghiem,$thuchanh,$sbd,$ghichu,-1]; // -1 là IDHV
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
/*
for ($i=0; $i < count($danhsach); $i++) {
    $hoten = explode(" ",$danhsach[$i][1]);
    $ten = $hoten[count($hoten)-1];
    $ho = trim(substr($danhsach[$i][1], 0,strlen($danhsach[$i][1])-strlen($ten)));
    $kn->adddata("INSERT INTO hocvien(HO,TEN,NGAYSINH,NOISINH) VALUES ('".$ho."','".$ten."','".$danhsach[$i][2]."','".$danhsach[$i][3]."');");
}*/
for ($i=0; $i < count($danhsach); $i++) {
    $hoten = explode(" ",$danhsach[$i][1]);
    $ten = $hoten[count($hoten)-1];
    $ho = trim(substr($danhsach[$i][1], 0,strlen($danhsach[$i][1])-strlen($ten)));
    $hoi = $kn->query("SELECT IDHV FROM hocvien WHERE HO='".$ho."' AND TEN = '".$ten."' AND NGAYSINH='".$danhsach[$i][2]."' AND NOISINH='".$danhsach[$i][3]."' LIMIT 0,1;");
    $row = mysqli_fetch_array($hoi);
    $danhsach[$i][11] = $row[0];
}
for ($i=0; $i < count($danhsach); $i++) {
    if ($danhsach[$i][11]>0) {
        $kn->adddata("INSERT INTO danhsachdangkyduthi_hocvien(IDDS,IDHV,DIEMLT,DIEMTH,TONGDIEM,SOGHISO,SOHIEU,GHICHUCC,NGAYVAOSO) VALUES('11','".$danhsach[$i][11]."','".$danhsach[$i][7]."','".$danhsach[$i][8]."','".($danhsach[$i][7]+$danhsach[$i][8])."', '".$danhsach[$i][5]."','".$danhsach[$i][4]."','".$danhsach[$i][10]."','".$danhsach[$i][6]."');");   
    }
}
?>
<table id="banglophoc" class="table table-hover display nowrap table-bordered" style="width: 100%">
    <thead>
        <tr style="text-align: center;">
            <th>TT</th>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Nơi sinh</th>
            <th>Số hiệu</th>
            <th>Số vào sổ</th>
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
        <th class="text-center"><?php echo $danhsach[$i][10] ?></th>
    </tr>
<?php
}
?>
    </tbody>
    <center>
        <div class="form-group col-md-3">
            <label><b>Danh sách học viên được cấp chứng chỉ</b></label>
        </div>
<div class="col-md-12 khungbtn">
    <button class='btn btn-dark luuthongtin'><i class='fas fa-save'></i> Lưu thông tin</button>
</div><br>
    </center>
</table>