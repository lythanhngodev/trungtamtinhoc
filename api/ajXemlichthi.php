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
$ds = mysqli_real_escape_string($kn->conn,strip_tags($_POST['d']));
$idhv = mysqli_real_escape_string($kn->conn,strip_tags($_POST['s']));
if (strlen($idhv)==0) {
    die();
}
$sql = "SELECT DISTINCT * FROM vwLichThi WHERE BINARY (sha2(sha2(IDDS,256),224)='$ds') AND BINARY (sha2(sha2(IDHV,256),224)='$idhv');";
$danhsach = $kn->query($sql);
$row = mysqli_fetch_assoc($danhsach);
if (count($row)==0) {
    die();
}
?>
<div class="box box-solid" id="HPDetail" style="display: none;">
    <div class="box-body table-responsive no-padding">    
        <div class="box-header with-border" style="min-width: 500px;width: 100%;">
            <img class="pull-left" src="/lab/i/vlute_icon36.png"><span class="text-blue">TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG<br><span class="text-sm">www.vlute.edu.vn</span></span>
        </div>    
    <div class="box-body">        
        <table class="table" style="min-width: 500px;">
            <thead>
                <tr class="text-center"><td colspan="8"><h3>LỊCH THI TIN HỌC</h3></td></tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4">Số báo danh: <b class="text-primary"><?php echo $row['SBD'] ?></b></td>
                </tr>
                <tr>
                    <th>Tên thí sinh</th>
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
                    <th rowspan="2">Ngày thi</th>
                    <td rowspan="2">
                        <?php $date1=date_create($row['NGAYTHI']);$date2=date_create(date('Y-m-d'));$diff=date_diff($date1,$date2);$songay = intval($diff->format("%R%a"));
                        if ($row['NGAYTHI']==NULL) {echo "...";}
                        else
                        if ($songay<0) {echo date_format(date_create_from_format('Y-m-d', $row['NGAYTHI']), 'd/m/Y')."<br><b class='label label-info'>còn ".abs($songay)." ngày<b>";}
                        else
                        if ($songay==0) {echo date_format(date_create_from_format('Y-m-d', $row['NGAYTHI']), 'd/m/Y')."&ensp;<b class='label label-success'>hôm nay</b>";}
                        else
                        if ($songay>0) {echo date_format(date_create_from_format('Y-m-d', $row['NGAYTHI']), 'd/m/Y')."&ensp;<b class='label label-danger'>đã thi</b>";}
                         ?>
                    </td>
                    <th>Giờ thi lý thuyết</th>
                    <td><?php echo ($row['GIOLT']==NULL)?'...':$row['GIOLT'] ?></td>
                </tr>
                <tr>
                    <th>Giờ thi thực hành</th>
                    <td><?php echo ($row['GIOTH']==NULL)?'...':$row['GIOTH'] ?></td>
                </tr>
                <tr>
                    <th>Địa điểm</th>
                    <td colspan="3"><?php echo 'Phòng thi số <b>'.(($row['TENGOINHO']==NULL)?'...':$row['TENGOINHO']).'</b> ( Phòng thực tế <b>'.(($row['TENGOINHO']==NULL)?'...':$row['TENTHUCTE']).'</b> )'; ?></td>
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