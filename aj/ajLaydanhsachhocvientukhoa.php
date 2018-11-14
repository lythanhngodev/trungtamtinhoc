<?php 
sleep(1);
if (!isset($_POST['khoahoc']) || empty($_POST['khoahoc'])) {
	echo "Không có thông tin";
	die();
}
require_once '../__.php';
$kn = new clsKetnoi();
$khoahoc = intval($_POST['khoahoc']);
$tenkhoa = '';
$qr_hv = $kn->query("SELECT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,kh.TENKHOA FROM khoahoc kh LEFT JOIN khoahoc_lop khl ON kh.IDKH=khl.IDKH LEFT JOIN lop l ON khl.IDL=l.IDL LEFT JOIN hocvien_lop hvl ON l.IDL=hvl.IDL LEFT JOIN hocvien hv ON hvl.IDHV=hv.IDHV WHERE khl.IDKH='$khoahoc' AND hvl.CAMTHI=b'0'"); ?>
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
    		<td ly='stt' mahv="<?php echo $row['IDHV'] ?>" khoahoc="<?php echo $khoahoc; ?>" class="text-center"><?php echo (++$stt);$tenkhoa=$row['TENKHOA'] ?></td>
    		<td ly='stt'><?php echo $row['HO'] ?></td>
    		<td ly='stt'><?php echo $row['TEN'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['NGAYSINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['GIOITINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['NOISINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['CMND'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['MSSV'] ?></td>
    		<td ly='stt'></td>
    		<td ly='stt'><a class="xoadong text-danger"><u>Xóa</u></a></td>
        </tr>
<?php } ?>
    </tbody>
</table>
<center><div class="col-md-12 khungbtn">
    <button class="btn btn-success luuthongtin"><i class="fas fa-check"></i> Lưu danh sách</button>
</div>
</center>