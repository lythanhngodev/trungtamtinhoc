<?php 
sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
if (!isset($_POST['danhsach']) || empty($_POST['danhsach'])) {
	echo "Không có thông tin";
	die();
}
require_once '../../__.php';
$kn = new clsKetnoi();
$danhsach = intval($_POST['danhsach']);
$tends = '';
$qr_hv = $kn->query("SELECT DISTINCT dh.IDDKTHV,dh.SBD,CONCAT(hv.HO,' ',hv.TEN) AS HOTEN, hv.NGAYSINH, hv.CMND, hv.MSSV, pk.TENPK,dk.THILT,dk.THITH,dk.SOBIENLAIPK,dk.PHIPK,dk.NGAYBIENLAIPK
FROM danhsachphuckhao_hocvien dk
    LEFT JOIN danhsachphuckhao pk ON dk.IDPK=pk.IDPK
    LEFT JOIN danhsachdangkyduthi_hocvien dh ON dh.IDDKTHV=dk.IDDKTHV
    LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dk.IDPK='$danhsach' ORDER BY dh.SBD ASC;"); ?>
<table id="banglophoc" class="table table-hover table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr class="text-center">
            <th hidden="hidden">Mã</th>
            <th class="text-danger">LT</th>
            <th class="text-danger">TH</th>
            <th>SBD</th>
            <th>Họ tên</th>
            <th>CMND</th>
            <th>Số BL</th>
            <th>Tiền PK</th>
            <th>Ngày BL</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
<?php
while ($row = mysqli_fetch_assoc($qr_hv)) { ?>
    	<tr>
            <td hidden="hidden"><?php echo $row['IDDKTHV'];$tends=$row['TENPK'] ?></td>
            <td ly='stt'><input type="checkbox" <?php if($row['THILT']==1) echo "checked='checked'" ?>></td>
            <td ly='stt'><input type="checkbox" <?php if($row['THITH']==1) echo "checked='checked'" ?>></td>
    		<td ly='stt'><?php echo $row['SBD'] ?></td>
            <td ly='stt'><?php echo $row['HOTEN'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['CMND'] ?></td>
            <td class="text-center"><?php echo $row['SOBIENLAIPK'] ?></td>
            <td class="text-center"><?php echo $row['PHIPK'] ?></td>
            <td class="text-center"><?php echo $row['NGAYBIENLAIPK'] ?></td>
    		<td ly='stt'><span class="text-danger xoadong">xóa</span></td>

<?php } ?>
    	</tr>
    </tbody>
<center>
    <div class="form-group col-md-3">
        <label><b>Danh sách:</b> <i><?php echo $tends; ?></i></label>
    </div>
</center>
</table>
<center><div class="col-md-12 khungbtn">
    <button class='btn btn-success luuthongtin'><i class='fas fa-save'></i> Lưu danh sách</button>
</div>
</center>