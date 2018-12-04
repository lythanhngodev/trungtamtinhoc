<?php 
error_reporting(0);
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
$qr_hv = $kn->query("SELECT DISTINCT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,hv.SDT,hv.MASOBIENLAI,hv.NGAYGHIBIENLAI,hv.GHICHU,hvl.CAMTHI FROM hocvien_lop hvl LEFT JOIN hocvien hv ON hvl.IDHV=hv.IDHV LEFT JOIN khoahoc_lop kl ON hvl.IDL=kl.IDL WHERE kl.IDKH='$khoahoc'"); ?>
<table id="banglophoc" class="table table-hover table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr class="text-center">
            <th class="text-danger" hidden="hidden">CẤM THI</th>
            <th>TT</th>
            <th hidden="hidden">SBD</th>
            <th>MSSV</th>
            <th>Họ</th>
            <th>Tên</th>
            <th>CMND</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Nơi sinh</th>
            <th>SĐT</th>
            <th>Số biên lai</th>
            <th>Ngày biên lai</th>
            <th>Ghi chú</th>
        </tr>
    </thead>
    <tbody>
<?php
$stt = 0;
while ($row = mysqli_fetch_assoc($qr_hv)) { ?>
    	<tr>
            <td ly="stt" class="text-center" mahv="<?php echo $row['IDHV'] ?>" hidden="hidden"><input type="checkbox" <?php if ($row['CAMTHI']=='1') {
                echo "checked='checked'";
            } ?>></td>
    		<td ly='stt' class="text-center"><?php echo (++$stt);?></td>
            <td ly='stt' class="text-center" hidden="hidden"></td>
    		<td class="text-center"><?php echo $row['MSSV'] ?></td>
            <td><?php echo $row['HO'] ?></td>
    		<td><?php echo $row['TEN'] ?></td>
            <td class="text-center"><?php echo $row['CMND'] ?></td>
    		<td class="text-center"><?php echo $row['NGAYSINH'] ?></td>
    		<td class="text-center"><?php echo $row['GIOITINH'] ?></td>
    		<td class="text-center"><?php echo $row['NOISINH'] ?></td>
    		<td class="text-center"><?php echo $row['SDT'] ?></td>
    		<td class="text-center"><?php echo $row['MASOBIENLAI'] ?></td>
            <td class="text-center"><?php echo $row['NGAYGHIBIENLAI'] ?></td>
    		<td class="text-center"><?php echo $row['GHICHU'] ?></td>

<?php } ?>
    	</tr>
    </tbody>
</table>
<center><div class="col-md-12 khungbtn">
    <button class="btn btn-success luuthongtin"><i class="fas fa-check"></i> Lưu thông tin</button>
</div>
<br>
</center>