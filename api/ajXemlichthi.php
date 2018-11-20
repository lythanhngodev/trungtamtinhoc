<?php 
error_reporting(0);
if (!isset($_POST['d'])) {
	echo "Không có thông tin";
	die();
}
require_once '../__.php';
$kn = new clsKetnoi();
$ds = intval($_POST['d']);
$idhv = intval($_POST['s']);
if (strlen($idhv)==0) {
    die();
}
$sql = "SELECT DISTINCT * FROM vwLichThi WHERE BINARY (IDDS='$ds') AND BINARY (IDHV='$idhv');";
$danhsach = $kn->query($sql);
$row = mysqli_fetch_assoc($danhsach);
/*if (count($row)==0) {
    die();
}*/
?>
<div class="box box-solid" id="HPDetail" style="display: none;">
    <div class="box-body table-responsive no-padding">    
        <div class="box-header with-border">
            <img class="pull-left" src="/lab/i/vlute_icon36.png"><span class="text-blue">TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG<br><span class="text-sm">www.vlute.edu.vn</span></span>
        </div>    
    <div class="box-body">        
        <table class="table">
            <thead>
                <tr class="text-center"><td colspan="8"><h3>LỊCH THI TIN HỌC</h3></td></tr>
            </thead>
            <tbody>
                <tr>
                    <th>Tên học viên</th>
                    <td><?php echo $row['HOTEN'] ?></td>
                    <th>Số báo danh</th>
                    <td><?php echo $row['SBD'] ?></td>
                </tr>
                <tr>
                    <th>Số CMND</th>
                    <td><?php echo $row['CMND'] ?></td>
                    <th>Đợt thi</th>
                    <td><?php echo $row['TENDS'] ?></td>
                </tr>
                <tr>
                    <th>Ngày thi</th>
                    <td>
<?php 
$date1=date_create($row['NGAYTHI']);
$date2=date_create(date('Y-m-d'));
$diff=date_diff($date1,$date2);
$songay = intval($diff->format("%R%a"));
if ($songay<0) {
    echo date_format(date_create_from_format('Y-m-d', $row['NGAYTHI']), 'd/m/Y')." <b class='label label-info'>đếm ngược ".$songay." ngày<b>";
}
if ($songay==0) {
    echo date_format(date_create_from_format('Y-m-d', $row['NGAYTHI']), 'd/m/Y')." <b class='label label-success'>hôm nay</b>";
}
if ($songay>0) {
    echo date_format(date_create_from_format('Y-m-d', $row['NGAYTHI']), 'd/m/Y')." <b class='label label-danger'>đã thi</b>";
}
 ?>
                    </td>
                    <th>Địa điểm</th>
                    <td><?php echo 'Phòng thi số '.$row['TENGOINHO'].' ( <b>'.$row['TENTHUCTE'].'</b> )'; ?></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>
<script type="text/javascript">$(function(){$('#HPDetail').show(500);});</script>