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
$qr_hv = $kn->query("SELECT DISTINCT dk.IDPKHV,dh.IDDKTHV,dh.SBD,CONCAT(hv.HO,' ',hv.TEN) AS HOTEN, hv.NGAYSINH, hv.CMND, hv.MSSV, hv.NOISINH,pk.TENPK,dk.THILT,dk.THITH,dk.SOBIENLAIPK,dk.PHIPK,dk.NGAYBIENLAIPK,dk.DIEMLTPK,dk.DIEMTHPK,dh.DIEMLT,dh.DIEMTH,ds.HOANTHANH
FROM danhsachphuckhao_hocvien dk
    LEFT JOIN danhsachphuckhao pk ON dk.IDPK=pk.IDPK
    LEFT JOIN danhsachdangkyduthi_hocvien dh ON dh.IDDKTHV=dk.IDDKTHV
    LEFT JOIN danhsachdangkyduthi ds ON ds.IDDS=dh.IDDS
    LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dk.IDPK='$danhsach' ORDER BY dh.SBD ASC;"); ?>
<table id="banglophoc" class="table table-hover table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr class="text-center">
        	<th>STT</th>
            <th>SBD</th>
            <th>Họ &amp; Tên</th>
            <th>Ngày sinh</th>
            <th>Nơi sinh</th>
            <th>MSSV</th>
            <th>Điểm LT trước PK</th>
            <th>Điểm LT sau PK</th>
            <th>Điểm TH trước PK</th>
            <th>Điểm TH sau PK</th>
        </tr>
    </thead>
    <tbody>
<?php
$stt = 0;
while ($row = mysqli_fetch_assoc($qr_hv)) { ?>
    	<tr>
    		<td ly='stt' class="text-center"  idpkhv="<?php echo $row['IDPKHV'] ?>"><?php echo (++$stt);$tends=$row['TENPK'];$hoanthanh=$row['HOANTHANH']; ?></td>
            <td ly='stt' class="text-center"><?php echo $row['SBD'] ?></td>
    		<td ly='stt'><?php echo $row['HOTEN'] ?></td>
            <td ly='stt' class="text-center"><?php echo $row['NGAYSINH'] ?></td>
            <td ly='stt' class="text-center"><?php echo $row['NOISINH'] ?></td>
    		<td ly='stt' class="text-center"><?php echo $row['MSSV'] ?></td>
    		<td ly='stt' class="text-center lt"><?php echo $row['DIEMLT'] ?></td>
            <td class="text-center lt"><?php echo $row['DIEMLTPK'] ?></td>
            <td ly='stt' class="text-center th"><?php echo $row['DIEMTH'] ?></td>
            <td class="text-center th"><?php echo $row['DIEMTHPK'] ?></td>
        </tr>
<?php } ?>
    </tbody>
    <center>
        <div class="form-group col-md-3">
            <label><b>Danh sách thi sinh:</b> <i><?php echo $tends; ?></i></label>
        </div>
    </center>
    <center><div class="col-md-12 khungbtn">
        <a class='btn btn-warning xuatthongtin' href='./ex/ExcelXuatDSChamPK.php?idpk=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất DS chấm PK</a>
        <?php if ($hoanthanh=='0') { ?>
        <a class='btn btn-warning xuatthongtin' href='./ex/ExcelXuatFileNhapDiemPK.php?idpk=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất file nhập điểm PK</a>
        <?php } ?>

        <a class='btn btn-warning xuatthongtin' href='./ex/ExcelXuatKetQuaPK.php?idpk=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất kết quả PK</a>
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
    <a class='btn btn-warning xuatthongtin' href='./ex/ExcelXuatDSChamPK.php?idpk=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất DS chấm PK</a>
    <?php if ($hoanthanh=='0') { ?>
    <a class='btn btn-warning xuatthongtin' href='./ex/ExcelXuatFileNhapDiemPK.php?idpk=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất file nhập điểm PK</a>
    <?php } ?>
    <a class='btn btn-warning xuatthongtin' href='./ex/ExcelXuatKetQuaPK.php?idpk=<?php echo $danhsach ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất kết quả PK</a>
    
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