<?php 
sleep(1);
if (!isset($_POST['khoahoc']) || empty($_POST['khoahoc'])) {
	echo "Không có thông tin";
	die();
}
require_once '../../__.php';
$kn = new clsKetnoi();
$khoahoc = intval($_POST['khoahoc']);
$tends = '';
$qr_hv = $kn->query("SELECT DISTINCT kh.IDKH,kh.TENKHOA,l.IDL,l.MALOP,pc.TENCB,pc.TUNGAY,pc.DENNGAY,pc.BUOIDAY,pc.DIADIEM FROM lop l LEFT JOIN khoahoc_lop kl ON l.IDL=kl.IDL LEFT JOIN khoahoc kh ON kl.IDKH=kh.IDKH LEFT JOIN phanconggiangday pc ON pc.MALOP=l.MALOP WHERE kh.IDKH='$khoahoc' ORDER BY l.MALOP ASC"); ?>
<table id="bangphancong" class="table table-hover display nowrap table-bordered" style="width: 100%">
    <thead>
        <tr style="text-align: center;">
            <th>Mã lớp</th>
            <th>GV giảng dạy</th>
            <th>Từ ngày</th>
            <th>Đến ngày</th>
            <th>Buổi dạy</th>
            <th>Địa điểm</th>
        </tr>
    </thead>
    <tbody>
<?php
$stt = 0;
while ($row = mysqli_fetch_assoc($qr_hv)) { ?>
    	<tr>
    		<td ly='stt' class="text-center" malop="<?php echo $row['MALOP'] ?>"><?php echo $row['MALOP'];$tends=$row['TENKHOA'] ?></td>
            <td><input type="text" class="form-control aucanbo" value="<?php echo $row['TENCB'] ?>"></td>
    		<td><input type="text" class="form-control ngayday" value="<?php echo $row['TUNGAY'] ?>"></td>
            <td><input type="text" class="form-control ngayday" value="<?php echo $row['DENNGAY'] ?>"></td>
            <td><input type="text" class="form-control aubuoiday" value="<?php echo $row['BUOIDAY'] ?>"></td>
    		<td><input type="text" class="form-control audiadiem" value="<?php echo $row['DIADIEM'] ?>"></td>
        </tr>
<?php } ?>
    </tbody>
    <center>
        <div class="form-group col-md-3">
            <label><b>Phân công giảng dạy khóa:</b> <i><?php echo $tends; ?></i></label>
        </div>
        <div class="col-md-12 khungbtn">
            <button class='btn btn-dark luuphancong'><i class='fas fa-save'></i> Lưu bảng phân công</button>
        </div>
        <br>
    </center>
</table>
<center><div class="col-md-12 khungbtn">
    <button class='btn btn-dark luuphancong'><i class='fas fa-save'></i> Lưu bảng phân công</button>
</div>
</center>