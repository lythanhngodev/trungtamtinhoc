<?php
include_once "../ec/PHPExcel.php";
$file = $_FILES['file']['tmp_name'];
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$listWorkSheets = $objReader->listWorksheetNames($file);
$danhsach = null;
for($s=0;$s<count($listWorkSheets);$s++){
    $objReader->setLoadSheetsOnly($listWorkSheets[$s]);
    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
    $hightsRow = $objExcel->setActiveSheetIndex()->getHighestRow();
    $tennganlop = $sheetData[1]['K'];
    $ghichulop = $sheetData[1]['M'];
    $tensheet = $listWorkSheets[$s];
    for ($i=3; $i <=$hightsRow; $i++) { 
    	$mssv = trim($sheetData[$i]['B']);
    	$ho = trim($sheetData[$i]['C']);
        $ten = trim($sheetData[$i]['D']);
        $cmnd = trim($sheetData[$i]['E']);
        $ngaysinh = trim($sheetData[$i]['F']);
        $gioitinh = trim($sheetData[$i]['G']);
        $noisinh = trim($sheetData[$i]['H']);
        $sdt = trim($sheetData[$i]['I']);
        $sobienlai = trim($sheetData[$i]['J']);
        $ngaybienlai = trim($sheetData[$i]['K']);
        $ghichu = trim($sheetData[$i]['L']);
        if ($ten=='' || $cmnd=='' || empty($ten) || empty($cmnd) || $ten=='null' || $cmnd=='null')
            continue;
        $t_ds = [$mssv,$ho,$ten,$cmnd,$ngaysinh,$gioitinh,$noisinh,$sdt,$sobienlai,$ngaybienlai,$ghichu,$tennganlop,$ghichulop,$tensheet];
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
?>
<table id="banglophoc" class="table table-hover table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr class="text-center">
        	<th>STT</th>
            <th>MSSV</th>
            <th>Họ &amp; Tên lót</th>
            <th>Tên</th>
            <th>Số CMND</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Nơi sinh</th>
            <th>Số điện thoại</th>
            <th>Mã số biên lai</th>
            <th>Ngày ghi biên lai</th>
            <th>Ghi chú</th>
            <th>Lớp</th>
            <th>ĐĐ/TG học</th>
            <th>Sheet</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $stt=1;
    for ($i=0; $i < count($danhsach); $i++) { ?>
    	<tr>
    		<td class="text-center" ly='stt'><?php echo $stt; ?></td>
    		<td><?php echo $danhsach[$i][0]; ?></td>
    		<td><?php echo $danhsach[$i][1]; ?></td>
    		<td><?php echo $danhsach[$i][2]; ?></td>
    		<td><?php echo $danhsach[$i][3]; ?></td>
    		<td class="text-right"><?php echo $danhsach[$i][4]; ?></td>
    		<td class="text-center"><?php echo $danhsach[$i][5]; ?></td>
    		<td><?php echo $danhsach[$i][6]; ?></td>
    		<td><?php echo $danhsach[$i][7]; ?></td>
    		<td class="text-center"><?php echo $danhsach[$i][8]; ?></td>
    		<td class="text-right"><?php echo $danhsach[$i][9]; ?></td>
    		<td><?php echo $danhsach[$i][10]; ?></td>
    		<td class="text-center"><?php echo $danhsach[$i][11]; ?></td>
    		<td><?php echo $danhsach[$i][12]; ?></td>
            <td ly='stt'><?php echo $danhsach[$i][13]; ?></td>
            <td ly='stt'><a class="xoadong text-danger"><u>Xóa</u></a></td>
    	</tr>
    	<?php $stt++;} ?>
    </tbody>
<center><div class="col-md-12">
    <button class="btn btn-success luuthongtin"><i class="fas fa-check"></i> Lưu thông tin</button>
</div>
</center>
</table>
<hr>
<center><div class="col-md-12">
    <button class="btn btn-success luuthongtin"><i class="fas fa-check"></i> Lưu thông tin</button>
</div>
</center>
<script type="text/javascript">
    $('#banglophoc').DataTable({
	  "scrollY": "300px",
	  "scrollCollapse": true,
	  "paging": false,
	  "scrollX": true,
      "ordering": false
	});
</script>