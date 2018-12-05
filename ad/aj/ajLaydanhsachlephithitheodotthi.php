<?php 
sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
if (!isset($_POST['dotthi']) || empty($_POST['dotthi'])) {
	echo "Không có thông tin";
	die();
}
require_once '../../__.php';
$kn = new clsKetnoi();
$dotthi = intval($_POST['dotthi']);
$tenkhoa = '';
$qr_hv = $kn->query("SELECT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.NOISINH, hv.CMND, hv.MSSV,dh.PHITHI,dh.SOBIENLAITHI,dh.NGAYBIENLAITHI,dh.IDDKTHV, dk.TENDS FROM danhsachdangkyduthi_hocvien dh LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV LEFT JOIN danhsachdangkyduthi dk ON dh.IDDS=dk.IDDS WHERE dh.IDDS='$dotthi';"); ?>
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
    		<td ly='stt' iddkthv="<?php echo $row['IDDKTHV']; ?>" class="text-center"><?php echo (++$stt);$tenkhoa=$row['TENDS'] ?></td>
            <td ly='stt' class="text-center"><?php echo $row['MSSV'] ?></td>
    		<td ly='stt'><?php echo $row['HO']." ".$row['TEN'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['CMND'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['NGAYSINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['NOISINH'] ?></td>
    		<td class="text-center"><?php echo $row['PHITHI'] ?></td>
    		<td class="text-center"><?php echo $row['SOBIENLAITHI'] ?></td>
    		<td class="text-center"><?php echo $row['NGAYBIENLAITHI'] ?></td>
        </tr>
<?php } ?>
    </tbody>
    <center>
        <div class="col-md-12">
            <h4 class="text-center">Danh sách tình hình đóng lệ phí thi <?php echo $tenkhoa ?></h4><br>
        </div>
    </center>
</table>
<center><div class="col-md-12 khungbtn">
    <button class="btn btn-success luuthongtin"><i class="fas fa-check"></i> Lưu danh sách</button>
</div>
</center>