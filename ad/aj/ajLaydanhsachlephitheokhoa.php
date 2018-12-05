<?php 
sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
if (!isset($_POST['khoahoc']) || empty($_POST['khoahoc'])) {
	echo "Không có thông tin";
	die();
}
require_once '../../__.php';
$kn = new clsKetnoi();
$khoahoc = intval($_POST['khoahoc']);
$tenkhoa = '';
$qr_hv = $kn->query("SELECT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.NOISINH, hv.CMND, hv.MSSV,kh.TENKHOA,khl.IDL,hvl.HOCPHI,hvl.MASOBIENLAI,hvl.NGAYGHIBIENLAI,hvl.IDHVL FROM khoahoc kh LEFT JOIN khoahoc_lop khl ON kh.IDKH=khl.IDKH LEFT JOIN lop l ON khl.IDL=l.IDL LEFT JOIN hocvien_lop hvl ON l.IDL=hvl.IDL LEFT JOIN hocvien hv ON hvl.IDHV=hv.IDHV WHERE khl.IDKH='$khoahoc'"); ?>
<table id="banglophoc" class="table table-hover table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr class="text-center">
            <th>STT</th>
            <th>MSSV</th>
            <th>Họ &amp; Tên</th>
            <th>Số CMND</th>
            <th>Ngày sinh</th>
            <th>Nơi sinh</th>
            <th>Học phí</th>
            <th>Số biên lai</th>
            <th>Ngày biên lai</th>
        </tr>
    </thead>
    <tbody>
<?php
$stt = 0;
while ($row = mysqli_fetch_assoc($qr_hv)) { ?>
    	<tr>
    		<td ly='stt' idhvl="<?php echo $row['IDHVL']; ?>" class="text-center"><?php echo (++$stt);$tenkhoa=$row['TENKHOA'] ?></td>
            <td ly='stt' class="text-center"><?php echo $row['MSSV'] ?></td>
    		<td ly='stt'><?php echo $row['HO']." ".$row['TEN'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['CMND'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['NGAYSINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['NOISINH'] ?></td>
    		<td class="text-center"><?php echo $row['HOCPHI'] ?></td>
    		<td class="text-center"><?php echo $row['MASOBIENLAI'] ?></td>
    		<td class="text-center"><?php echo $row['NGAYGHIBIENLAI'] ?></td>
        </tr>
<?php } ?>
    </tbody>
    <center>
        <div class="col-md-12">
            <h4 class="text-center">Danh sách tình hình đóng học phí khóa <?php echo $tenkhoa ?></h4><br>
        </div>
    </center>
</table>
<center><div class="col-md-12 khungbtn">
    <button class="btn btn-success luuthongtin"><i class="fas fa-check"></i> Lưu danh sách</button>
</div>
</center>