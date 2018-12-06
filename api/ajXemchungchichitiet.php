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
$key = mysqli_real_escape_string($kn->conn,$_POST['s']);
if (strlen($key)==0) {
    die();
}
$sql = "
    SELECT DISTINCT HOTEN,NGAYSINH,SOHIEU,SOGHISO,NGAYVAOSO,GIOITINH,NOISINH,DIEMLT,DIEMTH,TENDS,sha2(sha2(IDDKTHV,256),224) AS 'IDDKTHV' FROM vwChungChi cc WHERE sha2(SHA2(IDDKTHV,256),224)='$key';
";
$danhsach = $kn->query($sql);
$row = mysqli_fetch_assoc($danhsach);
if (count($row)==0) {
    die();
}
?>
<div id="hinhanh" style="width: 100%;max-width:500px;height: 325px;font-family: sans-serif;border-radius: 10px;background-image: url('./lab/i/khung.png');padding-top: 15px;background-size: cover;background-position: center;">
    <table style="text-align: center;width:100%;font-size: 15px;margin-top: 30px;border-radius: 10px;">
        <tr>
            <th style="padding: 4px 0px;color: #00a65a;text-transform: uppercase;font-size: 17px;">Chứng chỉ tin học ứng dụng cơ bản</th>
        </tr>
        <tr>
            <td style="padding: 0px 0px"><i class="fa fa-graduation-cap text-danger"></i></td>
        </tr>
        <tr>
            <th style="padding: 4px 0px"><b style="color: #f29c24;text-transform: uppercase;font-size: 20px"><?php echo $row['HOTEN'] ?></b></th>
        </tr>
        <tr>
            <td style="padding: 4px 0px"><!--Giới tính: <b style="color: #f29c24"><?php echo $row['GIOITINH'] ?></b>&ensp;-&ensp;-->Ngày sinh: <b style="color: #f29c24;font-size: 17px"><?php echo date_format(date_create_from_format('d/m/Y', $row['NGAYSINH']), 'd/m/Y') ?></b>&ensp;-&ensp;Nơi sinh: <b style="color: #f29c24;font-size: 17px"><?php echo $row['NOISINH'] ?></b></td>
        </tr>
        <tr>
            <td style="padding: 4px 0px">Đợt thi: <b style="color: #f29c24;font-size: 17px"><?php echo $row['TENDS'] ?></b></td>
        </tr>
        <tr>
            <td style="padding: 4px 0px">Điểm LT: <b style="color: #f29c24;font-size: 17px"><?php echo $row['DIEMLT'] ?></b>&ensp;-&ensp;Điểm TH: <b style="color: #f29c24;font-size: 17px"><?php echo $row['DIEMTH'] ?></b></td>
        </tr>
        <tr>
            <td style="padding: 4px 0px">Kết quả: <b style="color: #f29c24;font-size: 17px">Đạt</b></td>
        </tr>
        <tr>
            <td style="padding: 4px 0px">Số: <b style="color: #f29c24;font-size: 17px"><?php echo $row['SOHIEU'] ?></b>&ensp;-&ensp;Vào sổ ngày: <b style="color: #f29c24;font-size: 17px"><?php echo $row['NGAYVAOSO'] ?></b></td>
        </tr>
    </table>
</div>