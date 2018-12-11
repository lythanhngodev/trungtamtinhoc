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
$qr_hv = $kn->query("SELECT dh.IDDKTHV,hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,ds.TENDS,dh.SBD,dh.GHICHUDIEUCHINH FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$danhsach'"); ?>
<table id="banglophoc" class="table table-hover table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr class="text-center">
        	<th>STT</th>
            <th hidden="hidden">IDDKTHV</th>
            <th>SBD</th>
            <th hidden="hidden">IDHV</th>
            <th style="text-align:left;">Họ</th>
            <th style="text-align:left;">Tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Nơi sinh</th>
            <th>Số CMND</th>
            <th>MSSV</th>
            <th>Ghi chú điều chỉnh</th>
        </tr>
    </thead>
    <tbody>
<?php
$stt = 0;$demsbd=0;
$hv=null;
while ($row=mysqli_fetch_assoc($qr_hv)) {
    $hv[]=$row;
}
for ($i=0; $i < count($hv)-1; $i++) {
    for ($j=$i+1; $j < count($hv); $j++) {
        $listFullName = array($hv[$i]['HO']." ".$hv[$i]['TEN'],$hv[$j]['HO']." ".$hv[$j]['TEN']);
        $listFullName2 = sortFullName($listFullName);
        if ($listFullName[0]!=$listFullName2[0]) {
            $temp = $hv[$i];
            $hv[$i] = $hv[$j];
            $hv[$j] = $temp;
        }
    }
}
for($i = 0; $i < count($hv); $i++) { ?>
    	<tr>
    		<td class="text-center"><?php echo (++$stt);$tends=$hv[$i]['TENDS'] ?></td>
            <td hidden="hidden"><?php echo $hv[$i]['IDDKTHV'] ?></td>
            <td class="text-center" sbd='<?php echo $hv[$i]['SBD'] ?>' <?php if (strlen($hv[$i]['SBD'])>0) {
                echo 'ly="stt"';
                ++$demsbd;
            }else{echo 'style="background-color:red;"';} ?>><?php echo $hv[$i]['SBD'] ?></td>
            <td hidden="hidden"><?php echo $hv[$i]['IDHV'] ?></td>
    		<td><?php echo $hv[$i]['HO'] ?></td>
    		<td><?php echo $hv[$i]['TEN'] ?></td>
            <td class="text-center"><?php echo $hv[$i]['GIOITINH'] ?></td>
    		<td class="text-center"><?php echo $hv[$i]['NGAYSINH'] ?></td>
    		<td class="text-center"><?php echo $hv[$i]['NOISINH'] ?></td>
    		<td class="text-center"><?php echo $hv[$i]['CMND'] ?></td>
    		<td class="text-center"><?php echo $hv[$i]['MSSV'] ?></td>
    		<td class="text-center"><?php echo $hv[$i]['GHICHUDIEUCHINH'] ?></td>
<?php } ?>
    	</tr>
    </tbody>
<center>
    <div class="form-group col-md-3">
        <label><b>Danh sách thí sinh:</b> <i><?php echo $tends; ?></i></label>
    </div>
</center>
<div class="form-group col-md-12">
    <label>Thí sinh chưa có SBD sẽ được tô <span class="text-danger"><b>Đỏ</b></span> ở cột SBD bên dưới</label><br>
    <label class="text-danger">Phần mềm sẽ dựa vào ô <b>số khóa</b> để đánh tự động SBD</label><br>
    Nhập số khóa (VD: <b><span class="text-danger">10,15,15,...</b>) <input type="number" width="50" id="sokhoa">
    <button class="btn btn-primary" id="danhsotudong">Đánh số báo danh</button>&ensp;<button class="btn btn-danger" id="resetsbd">Reset số báo danh</button>&ensp;<button class="btn btn-danger" id="deletesbd">Xóa hết số báo danh</button><br>
    <label>SBD sau khi đánh được tô màu vàng.</label><br>
</div>
</table>
<center><div class="col-md-12 khungbtn">
    <button class="btn btn-success luuthongtin"><i class="fas fa-check"></i> Lưu thông tin</button>
</div>
</center>
