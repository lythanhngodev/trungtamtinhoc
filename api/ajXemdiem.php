<?php 
error_reporting(0);
function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/( )+/s',         // shorten multiple whitespace sequences
        '/(\n)+/s',         // shorten multiple whitespace sequences
        '/(\t)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );
    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}
ob_start("sanitize_output");
if (!isset($_POST['d'])) {
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
if (count($row)==0) {
    die();
}
?>
<div class="box box-solid" id="HPDetail" style="display: none;">
    <div class="box-body table-responsive no-padding">    
        <div class="box-header with-border">
            <img class="pull-left" src="/lab/i/vlute_icon36.png"><span class="text-blue">TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG<br><span class="text-sm">www.vlute.edu.vn</span></span>
        </div>    
        <div class="box-body">        
            <table class="table">
                <thead>
                    <tr class="text-center"><td colspan="4" style="width: 100%;"><h3>BẢNG ĐIỂM TIN HỌC</h3></td></tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" style="border-left: 3px solid #f29c24;background-color: #ecf6ff;padding: 0.2rem 1rem;"><h5>THÔNG TIN HỌC VIÊN</h5></td>
                    </tr>
                    <tr>
                        <td colspan="4">Số báo danh: <b class="text-primary"><?php echo $row['SBD'] ?></b></td>
                    </tr>
                    <tr>
                        <th>Tên học viên</th>
                        <td><?php echo $row['HOTEN'] ?></td>
                        <th>Giới tính</th>
                        <td><?php echo $row['GIOITINH'] ?></td>
                    </tr>
                    <tr>
                        <th>Ngày sinh</th>
                        <td><?php echo $row['NGAYSINH'] ?></td>
                        <th>Nơi sinh</th>
                        <td><?php echo $row['NOISINH'] ?></td>
                    </tr>
                    <tr>
                        <th>Số CMND</th>
                        <td><?php echo substr( $row['CMND'],  0, strlen($row['CMND'])-3 )."xxx"; ?></td>
                        <th>Đợt thi</th>
                        <td><?php echo $row['TENDS'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border-left: 3px solid #f29c24;background-color: #ecf6ff;padding: 0.2rem 1rem;"><h5>CHI TIẾT ĐIỂM THI</h5></td>
                    </tr>
                    <tr>
                        <th class="text-center">Điểm lý thuyết</th>
                        <th class="text-center">Điểm thực hành</th>
                        <th class="text-center">Tổng Điểm</th>
                        <th class="text-center">Kết quả</th>
                    </tr>
                    <tr class="text-center">
                        <th class="text-center"><?php echo $row['DIEMLT'] ?></th>
                        <th class="text-center"><?php echo $row['DIEMTH'] ?></th>
                        <th class="text-center"><?php echo $row['TONGDIEM'] ?></th>
                        <th class="text-danger text-center"><?php if($row['DIEMLT']>=5 && $row['DIEMTH']>=5) echo 'ĐẠT'; else echo 'KHÔNG ĐẠT'; ?></th>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Ghi chú:&ensp;</b> <span><?php echo $row['GHICHUD'] ?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer with-border">
            <span class="text-danger">(*) Nếu có sai sót vui lòng liên hệ Trung tâm tin học để được điều chỉnh</span>
        </div>   
    </div>
</div>
<script type="text/javascript">$(function(){$('#HPDetail').show(500);});</script>