<?php 
sleep(1);
if (!isset($_POST['lophoc']) || empty($_POST['lophoc'])) {
	echo "Không có thông tin";
	die();
}
require_once '../__.php';
$kn = new clsKetnoi();
$lophoc = intval($_POST['lophoc']);
$qr_hv = $kn->query("SELECT DISTINCT dh.SBD,hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,hv.SDT,hv.MASOBIENLAI,hv.NGAYGHIBIENLAI,hv.GHICHU,hvl.CAMTHI,dk.IDDS FROM hocvien_lop hvl LEFT JOIN hocvien hv ON hvl.IDHV=hv.IDHV LEFT JOIN khoahoc_lop kl ON hvl.IDL=kl.IDL LEFT JOIN danhsachdangkyduthi dk ON kl.IDKH=dk.IDKH LEFT JOIN danhsachdangkyduthi_hocvien dh ON dk.IDDS=dh.IDDS AND hv.IDHV=dh.IDHV WHERE hvl.IDL='$lophoc'"); ?>
<table id="banglophoc" class="table table-hover table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr class="text-center">
            <th class="text-danger">CẤM THI</th>
            <th>TT</th>
            <th>SBD</th>
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
            <td ly="stt" class="text-center" mahv="<?php echo $row['IDHV'] ?>" idds="<?php echo $row['IDDS'] ?>"><input type="checkbox" <?php if ($row['CAMTHI']=='1') {
                echo "checked='checked'";
            } ?>></td>
    		<td ly='stt' class="text-center"><?php echo (++$stt);?></td>
            <td ly='stt' class="text-center"><?php echo $row['SBD'] ?></td>
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