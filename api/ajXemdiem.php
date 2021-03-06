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
$key = mysqli_real_escape_string($kn->conn,strip_tags($_POST['d']));
if (strlen($key)==0) {
    die();
}
$hk = mysqli_real_escape_string($kn->conn,strip_tags($_POST['k']));
$sql = "SELECT DISTINCT * FROM vwDiemThi WHERE BINARY (sha2(sha2(IDHV,256),224) = '$key') AND BINARY (sha2(sha2(IDDS,256),224)='$hk') LIMIT 0,1;";
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
                    <tr class="text-center"><td colspan="4" style="width: 100%;"><h3>BẢNG ĐIỂM TIN HỌC</h3></td></tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" style="border-left: 3px solid #f29c24;background-color: #ecf6ff;padding: 0.2rem 1rem;"><h5>THÔNG TIN THÍ SINH</h5></td>
                    </tr>
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
                        <td colspan="4" style="border-left: 3px solid #f29c24;background-color: #ecf6ff;padding: 0.2rem 1rem;"><h5>CHI TIẾT ĐIỂM THI</h5></td>
                    </tr>
                    <tr>
                        <th class="text-center">Điểm lý thuyết</th>
                        <th class="text-center">Điểm thực hành</th>
                        <th class="text-center">Tổng Điểm</th>
                        <th class="text-center">Kết quả</th>
                    </tr>
                    <tr class="text-center">
                    <?php 
                        $diemlt = 0;
                        if ($row['THILT']==1) {
                            $diemlt = $row['DIEMLTPK'];
                        }else{
                            $diemlt = $row['DIEMLT'];
                        }
                        $diemth = 0;
                        if ($row['THITH']==1) {
                            $diemth = $row['DIEMTHPK'];
                        }
                        else{
                            $diemth = $row['DIEMTH'];
                        }
                        if(($row['DIEMLT']==null && $row['DIEMTH'] == null)){
                     ?>
                            <th class="text-center">-</th>
                            <th class="text-center">-</th>
                            <th class="text-center">-</th>
                            <th class="text-danger text-center">-</th>
                    <?php }else{ ?>
                        <th class="text-center"><?php echo number_format($diemlt,1) ?></th>
                        <th class="text-center"><?php echo number_format($diemth,1) ?></th>
                        <th class="text-center"><?php echo number_format(($diemlt+$diemth),1) ?></th>
                        <th class="text-danger text-center">
                            <?php 
                                if(($row['DIEMLT']==null && $row['DIEMTH'] == null)) 
                                    echo 'CHƯA THI'; 
                                else if($diemlt>=5 && $diemth>=5)
                                    echo 'ĐẠT';
                                else
                                    echo "KHÔNG ĐẠT"; ?>
                            </th>
                    <?php } ?>
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