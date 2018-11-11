<?php 
sleep(1);
if (!isset($_POST['danhsach']) || empty($_POST['danhsach'])) {
	echo "Không có thông tin";
	die();
}
require_once '../__.php';
$kn = new clsKetnoi();
$danhsach = intval($_POST['danhsach']);
$tends = '';
$qr_hv = $kn->query("SELECT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,ds.TENDS FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$danhsach'"); ?>
<table id="banglophoc" class="table table-hover table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr class="text-center">
        	<th>STT</th>
            <th>Họ</th>
            <th>Tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Nơi sinh</th>
            <th>Số CMND</th>
            <th>MSSV</th>
            <th>Ghi chú</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
<?php
$stt = 0;
while ($row = mysqli_fetch_assoc($qr_hv)) { ?>
    	<tr>
    		<td ly='stt' class="text-center"><?php echo (++$stt);$tends=$row['TENDS'] ?></td>
    		<td ly='stt'><?php echo $row['HO'] ?></td>
    		<td ly='stt'><?php echo $row['TEN'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['NGAYSINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['GIOITINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['NOISINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['CMND'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['MSSV'] ?></td>
    		<td ly='stt'></td>
    		<td ly='stt'></td>

<?php } ?>
    	</tr>
    </tbody>
<center>
    <div class="form-group col-md-3">
        <label><b>Danh sách:</b> <i><?php echo $tends; ?></i></label>
    </div>
</center>
<center><div class="col-md-12 khungbtn">
    <a class='btn btn-warning xuatthongtin' href='./ex/xuatthisinhdangkyduthi.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất danh sách</a>
</div>
<br>
</center>
</table>
<center><div class="col-md-12 khungbtn">
    <a class='btn btn-warning xuatthongtin' href='./ex/xuatthisinhdangkyduthi.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất danh sách</a>
</div>
</center>