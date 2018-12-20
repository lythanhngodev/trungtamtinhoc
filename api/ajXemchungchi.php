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
require_once '../__.php';
$kn = new clsKetnoi();
$key = mysqli_real_escape_string($kn->conn,strip_tags($_POST['s']));
if (strlen($key)==0) {
    die();
}
$sql = "
    SELECT DISTINCT HOTEN,NGAYSINH,SOHIEU,SOGHISO,NGAYVAOSO, sha2(sha2(IDDKTHV,256),224) AS 'IDDKTHV' FROM vwChungChi WHERE HOTEN like '%".$key."%'
    UNION
    SELECT HOTEN,NGAYSINH,SOHIEU,SOGHISO,NGAYVAOSO, sha2(sha2(IDDKTHV,256),224) AS 'IDDKTHV' FROM vwChungChi WHERE CMND like '%".$key."%'
    UNION
    SELECT HOTEN,NGAYSINH,SOHIEU,SOGHISO,NGAYVAOSO, sha2(sha2(IDDKTHV,256),224) AS 'IDDKTHV' FROM vwChungChi WHERE SBD like '%".$key."%'
    UNION
    SELECT HOTEN,NGAYSINH,SOHIEU,SOGHISO,NGAYVAOSO, sha2(sha2(IDDKTHV,256),224) AS 'IDDKTHV' FROM vwChungChi WHERE SOGHISO like '%".$key."%'
    UNION
    SELECT HOTEN,NGAYSINH,SOHIEU,SOGHISO,NGAYVAOSO, sha2(sha2(IDDKTHV,256),224) AS 'IDDKTHV' FROM vwChungChi WHERE SOHIEU like '%".$key."%'
    UNION
    SELECT HOTEN,NGAYSINH,SOHIEU,SOGHISO,NGAYVAOSO, sha2(sha2(IDDKTHV,256),224) AS 'IDDKTHV' FROM vwChungChi WHERE NGAYVAOSO like '%".$key."%'
";
$danhsach = $kn->query($sql);
$row = mysqli_fetch_assoc($danhsach);
if (count($row)==0) {
    die();
}
$danhsach = $kn->query($sql);
?>
<div class="box box-solid" id="HPDetail" style="display: none;">
    <div class="box-body table-responsive no-padding">    
        <div class="box-header with-border">
            <img class="pull-left" src="/lab/i/vlute_icon36.png"><span class="text-blue">TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG<br><span class="text-sm">www.vlute.edu.vn</span></span>
        </div>    
        <div class="box-body">        
            <table class="table table-hover table-bordered" id="tabledata" style="width: 100%;box-shadow: rgb(191, 191, 191) 0px 0px 6px 0px;border-radius: 15px;margin-top: 1rem;">
                <thead>
                    <tr>
                        <th>Họ và tên</th>
                        <th>Ngày sinh</th>
                        <th>Số hiệu</th>
                        <th>Số vào sổ</th>
                        <th>Ngày vào sổ</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($row = mysqli_fetch_assoc($danhsach)) { ?>
                    <tr>
                        <td><?php echo $row['HOTEN'] ?></td>
                        <td class="text-center"><?php echo $row['NGAYSINH'] ?></td>
                        <td class="text-center"><?php echo $row['SOHIEU'] ?></td>
                        <td class="text-center"><?php echo $row['SOGHISO'] ?></td>
                        <td class="text-center"><?php echo $row['NGAYVAOSO'] ?></td>
                        <td class="text-center"><a class="btn btn-sm btn-default xemchitiet" ltn="<?php echo $row['IDDKTHV'] ?>"><i class="fa fa-graduation-cap"></i></a></td>
                    </tr>
                    <?php }
                     ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer with-border">
            <span class="text-danger">(*) Nếu có sai sót vui lòng liên hệ Trung tâm tin học để được điều chỉnh</span>
        </div>   
    </div>
</div>
<script type="text/javascript">$(function(){$('#HPDetail').show(500);});</script>