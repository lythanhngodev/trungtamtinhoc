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
$hoanthanh='';
$qr_hv = $kn->query("SELECT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,ds.TENDS,dh.DIEMLT,dh.DIEMTH,dh.TONGDIEM,dh.SBD,dh.IDPT,dh.IDDS,dh.GHICHUD,ds.HOANTHANH FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$danhsach' ORDER BY dh.SBD ASC;"); ?>
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
            <th>Ghi chú</th>
        </tr>
    </thead>
    <tbody>
<?php
$stt = 0;
while ($row = mysqli_fetch_assoc($qr_hv)) { ?>
    	<tr>
    		<td ly='stt' class="text-center" idpt="<?php echo $row['IDPT'] ?>" idds="<?php echo $row['IDDS'] ?>" idhv="<?php echo $row['IDHV'] ?>" sbd="<?php echo $row['SBD'] ?>"><?php echo (++$stt);$tends=$row['TENDS'];$hoanthanh=$row['HOANTHANH']; ?></td>
            <td ly='stt' class="text-center"><?php echo $row['SBD'] ?></td>
    		<td ly='stt'><?php echo $row['HO']." ".$row['TEN'] ?></td>
            <td ly='stt' class="text-center"><?php echo $row['NGAYSINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['GIOITINH'] ?></td>
            <td ly='stt' class="text-center"><?php echo $row['NOISINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['MSSV'] ?></td>
    		<td class="text-center lt"><?php echo $row['DIEMLT'] ?></td>
            <td class="text-center th"><?php echo $row['DIEMTH'] ?></td>
            <td><?php echo $row['GHICHUD'] ?></td>
        </tr>
<?php } ?>
    </tbody>
    <center>
        <div class="form-group col-md-3">
            <label><b>Danh sách thi sinh:</b> <i><?php echo $tends; ?></i></label>
        </div>
    </center>
    <center><div class="col-md-12 khungbtn">

        <?php if ($hoanthanh=='0') { ?>
        <a class='btn btn-warning xuatthongtin' href='./ex/ExcelXuatFileNhapDiem.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất file nhập điểm</a>
        <?php } ?>
        <a class='btn btn-warning xuatthongtin' href='./ex/ExcelKetQuaThi.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất kết quả</a>
        <a class='btn btn-warning xuatthongtin' href='./ex/ExceldanhsachDat.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất DS đạt</a>
        <a class='btn btn-warning xuatthongtin' href='./ex/ExceldanhsachKhongDat.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất DS không đạt</a>
        <?php if ($hoanthanh=='0') { ?>
        <br><br>
        <input type="file" id="dulieufile"> <button class="btn btn-dark" id="diemexcel">Nhập điểm từ Excel</button><br><br>
        <button class='btn btn-dark luubangdiem'><i class='fas fa-save'></i> Lưu bảng điểm</button>
        <?php } ?>

    </div>
    <br>
    </center>
</table>
<center><div class="col-md-12 khungbtn">

    <?php if ($hoanthanh=='0') { ?>
    <a class='btn btn-warning xuatthongtin' href='./ex/ExcelXuatFileNhapDiem.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất file nhập điểm</a>
    <?php } ?>
    <a class='btn btn-warning xuatthongtin' href='./ex/ExcelKetQuaThi.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất kết quả</a>
    <a class='btn btn-warning xuatthongtin' href='./ex/ExceldanhsachDat.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất DS đạt</a>
    <a class='btn btn-warning xuatthongtin' href='./ex/ExceldanhsachKhongDat.php?idds=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất DS không đạt</a>
        <?php if ($hoanthanh=='0') { ?>
        <br><br>
        <button class='btn btn-dark luubangdiem'><i class='fas fa-save'></i> Lưu bảng điểm</button>
        <?php } ?>
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