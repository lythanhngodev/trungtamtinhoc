<?php 
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
$qr_hv = $kn->query("SELECT dh.IDDKTHV,hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,ds.TENDS,dh.SBD,dh.SOBIENLAITHI FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$danhsach' ORDER BY dh.SBD ASC, dh.IDDKTHV ASC"); ?>
<table id="banghocvien" class="table table-hover table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr class="text-center">
            <th style="width: 40px;"><input type="checkbox" class="text-center" id="checkall" chonhet='chonhet'></th>
            <th hidden="hidden">IDDKTHV</th>
            <th class="text-danger">LT</th>
            <th class="text-danger">TH</th>
            <th>SBD</th>
            <th style="text-align:left;">Họ tên</th>
            <th>CMND</th>
            <th>Số BL</th>
            <th>Tiền PK</th>
            <th>Ngày BL</th>
        </tr>
    </thead>
    <tbody>
<?php
$stt = 0;$demsbd=0;
$hv=null;
while ($row=mysqli_fetch_assoc($qr_hv)) {
    $hv[]=$row;
}
for($i = 0; $i < count($hv); $i++) { ?>
    	<tr>
            <td ly='stt' class="text-center"><input type="checkbox" class="text-center" chonhet='chonhet'></td>
            <td hidden="hidden"><?php echo $hv[$i]['IDDKTHV'] ?></td> <?php $tends=$hv[$i]['TENDS'] ?>
            <td ly='stt' class="text-center"><input type="checkbox"></td>
            <td ly='stt' class="text-center"><input type="checkbox"></td>
            <td class="text-center" sbd='<?php echo $hv[$i]['SBD'] ?>' <?php if (strlen($hv[$i]['SBD'])>0) {
                echo 'ly="stt"';
                ++$demsbd;
            }else{echo 'style="background-color:red;"';} ?>><?php echo $hv[$i]['SBD'] ?></td>
    		<td ly='stt'><?php echo $hv[$i]['HO']." ".$hv[$i]['TEN'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $hv[$i]['CMND'] ?></td>
    		<td class="text-center"></td>
    		<td class="text-center"></td>
            <td class="text-center"></td>
<?php } ?>
    	</tr>
    </tbody>
<center>
    <div class="form-group col-md-12">
        <label><b>Danh sách thí sinh:</b> <i><?php echo $tends; ?></i></label>
    </div>
</center>
</table>
<center><div class="col-md-12 khungbtn">
    <button class="btn btn-primary themvaokhoathi"><i class="fas fa-arrow-right"></i></button>
</div>
<br>
</center>