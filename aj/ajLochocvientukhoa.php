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
$qr_hv = $kn->query("SELECT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,kh.TENKHOA,l.TENLOP, kh.IDKH FROM khoahoc kh LEFT JOIN khoahoc_lop khl ON kh.IDKH=khl.IDKH LEFT JOIN lop l ON khl.IDL=l.IDL LEFT JOIN hocvien_lop hvl ON l.IDL=hvl.IDL LEFT JOIN hocvien hv ON hvl.IDHV=hv.IDHV WHERE khl.IDKH='$khoahoc' AND hvl.CAMTHI=b'0' ORDER BY l.TENLOP ASC;"); ?>
<table id="banghocvien" class="table table-hover table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr class="text-center">
        	<th style="width: 40px;"><input type="checkbox" class="text-center checkall" checked="checked"></th>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Lớp</th>
            <th>Số CMND</th>
            <th>MSSV</th>
        </tr>
    </thead>
    <tbody>
<?php
$stt = 0;
while ($row = mysqli_fetch_assoc($qr_hv)) { ?>
    	<tr>
    		<td ly='stt' idhv="<?php echo $row['IDHV'] ?>" khoa="<?php echo $row['TENKHOA'] ?>" class="text-center"><input type="checkbox" class="text-center" checked></td>
    		<td ly='stt'><?php echo $row['HO']." ".$row['TEN'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['NGAYSINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['GIOITINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['TENLOP'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['CMND'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['MSSV'] ?></td>
        </tr>
<?php } ?>
    </tbody>
</table>
<center><div class="col-md-12 khungbtn">
    <button class="btn btn-primary themvaokhoathi"><i class="fas fa-arrow-right"></i></button>
</div>
<br>
</center>