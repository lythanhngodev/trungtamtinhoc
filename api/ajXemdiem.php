<?php 
error_reporting(0);

if (!isset($_POST['d'])) {
	echo "Không có thông tin";
	die();
}
require_once '../__.php';
$kn = new clsKetnoi();
$key = mysqli_real_escape_string($kn->conn,$_POST['d']);
if (strlen($key)==0) {
    die();
}
$hk = intval($_POST['k']);
$sql = "SELECT DISTINCT * FROM vwDiemThi WHERE BINARY (IDHV = '$key') AND BINARY (IDDS='$hk') LIMIT 0,1;";
$danhsach = $kn->query($sql);
$row = mysqli_fetch_assoc($danhsach);
?>
<div class="box box-solid" id="HPDetail" style="display: none;">
    <div class="box-body table-responsive no-padding">    
        <div class="box-header with-border">
            <img class="pull-left" src="/lab/i/vlute_icon36.png"><span class="text-blue">TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG<br><span class="text-sm">www.vlute.edu.vn</span></span>
        </div>    
        <div class="box-body">        
            <table class="table">
                <thead>
                    <tr class="text-center"><td colspan="8"><h3>BẢNG ĐIỂM TIN HỌC</h3></td></tr>
                    <tr>
                        <th class="text-center">Họ &amp; Tên</th>
                        <th class="text-center">Số CMND</th>
                        <th class="text-center">MSSV</th>
                        <th class="text-center">Điểm lý thuyết</th>
                        <th class="text-center">Điểm thực hành</th>
                        <th class="text-center">Tổng Điểm</th>
                        <th class="text-center">Kết quả</th>
                        <th class="text-center">Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td><?php echo $row['HOTEN']; ?></td>
                        <td><?php echo $row['CMND'] ?></td>
                        <td><?php echo $row['MSSV'] ?></td>
                        <th class="text-center"><?php echo $row['DIEMLT'] ?></th>
                        <th class="text-center"><?php echo $row['DIEMTH'] ?></th>
                        <th class="text-center"><?php echo $row['TONGDIEM'] ?></th>
                        <th class="text-danger text-center"><?php if($row['DIEMLT']>=5 && $row['DIEMTH']>=5) echo 'ĐẠT'; else echo 'KHÔNG ĐẠT'; ?></th>
                        <td><?php echo $row['GHICHUD'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">$(function(){$('#HPDetail').show(500);});</script>