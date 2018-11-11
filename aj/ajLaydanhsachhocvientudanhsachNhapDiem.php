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
$qr_hv = $kn->query("SELECT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,ds.TENDS,dh.DIEMLT,dh.DIEMTH,dh.TONGDIEM,dh.SBD,dh.IDPT,dh.IDDS FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$danhsach';"); ?>
<table id="banglophoc" class="table table-hover table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr class="text-center">
        	<th>STT</th>
            <th>SBD</th>
            <th>Họ &amp; Tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Nơi sinh</th>
            <th>MSSV</th>
            <th>Điểm LT</th>
            <th>Điểm TH</th>
            <th>Tổng điểm</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
<?php
$stt = 0;
while ($row = mysqli_fetch_assoc($qr_hv)) { ?>
    	<tr>
    		<td ly='stt' class="text-center" idpt="<?php echo $row['IDPT'] ?>" idds="<?php echo $row['IDDS'] ?>" idhv="<?php echo $row['IDHV'] ?>" sbd="<?php echo $row['SBD'] ?>"><?php echo (++$stt);$tends=$row['TENDS'] ?></td>
            <td ly='stt' class="text-center"><?php echo $row['SBD'] ?></td>
    		<td ly='stt'><?php echo $row['HO']." ".$row['TEN'] ?></td>
            <td ly='stt' class="text-center"><?php echo $row['NGAYSINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['GIOITINH'] ?></td>
            <td ly='stt' class="text-center"><?php echo $row['NOISINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['MSSV'] ?></td>
    		<td class="text-center lt"><?php echo $row['DIEMLT'] ?></td>
            <td class="text-center th"><?php echo $row['DIEMTH'] ?></td>
            <td class="text-center td"><?php echo $row['TONGDIEM'] ?></td>
            <td ly='stt'></td>
        </tr>
<?php } ?>
    </tbody>
    <center>
        <div class="form-group col-md-3">
            <label><b>Danh sách thi sinh:</b> <i><?php echo $tends; ?></i></label>
        </div>
    </center>
    <center><div class="col-md-12 khungbtn">
        <button class='btn btn-dark luubangdiem'><i class='fas fa-save'></i> Lưu bảng điểm</button>
        <a class='btn btn-warning xuatthongtin' href='./ex/ExcelKetQuaThi.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất kết quả</a>
    </div>
    </center>
</table>
<center><div class="col-md-12 khungbtn">
    <button class='btn btn-dark luubangdiem'><i class='fas fa-save'></i> Lưu bảng điểm</button>
    <a class='btn btn-warning xuatthongtin' href='./ex/ExcelKetQuaThi.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất kết quả</a>
</div>
</center>
<?php 
$qr_pt = $kn->query("SELECT DISTINCT IDPT,TENGOINHO,TENTHUCTE,NGAYTHI FROM danhsachphongthi WHERE IDDS='$danhsach';");
$chuoi = '';
while ($row=mysqli_fetch_assoc($qr_pt)) {
    $chuoi.="<option value='".$row['IDPT']."'>Phòng ".$row['TENTHUCTE']." - ".$row['TENGOINHO']."</option>";
}
 ?>
<script type="text/javascript">
    $("#chonphongthi option[value!='0']").map(function() {
        $(this).remove();
    });
    $("#chonphongthi").append("<?php echo $chuoi; ?>");
</script>