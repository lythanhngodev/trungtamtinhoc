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
    SELECT DISTINCT HOTEN,NGAYSINH,SOHIEU,SOGHISO,NGAYVAOSO,GIOITINH,NOISINH,DIEMLT,DIEMTH,TENDS,sha1(IDDKTHV) AS 'IDDKTHV' FROM vwChungChi cc WHERE SHA1(IDDKTHV)='$key';
";
$danhsach = $kn->query($sql);
$row = mysqli_fetch_assoc($danhsach);
if (count($row)==0) {
    die();
}
?>
<div id="hinhanh" style="width: 100%;max-width:500px;height: 325px;font-family: sans-serif;border-radius: 10px;background-image: url('./lab/i/khung.png');padding-top: 20px;background-size: cover;background-position: center;">
    <table style="text-align: center;width:100%;font-size: 16px;margin-top: 30px;border-radius: 10px;">
        <tr>
            <th style="padding: 4px 0px;color: #00a65a;text-transform: uppercase;">Chứng chỉ tin học ứng dụng cơ bản</th>
        </tr>
        <tr>
            <td style="padding: 0px 0px">-----oOo-----</td>
        </tr>
        <tr>
            <th style="padding: 4px 0px"><b style="color: #f29c24;text-transform: uppercase;"><?php echo $row['HOTEN'] ?></b></th>
        </tr>
        <tr>
            <td style="padding: 4px 0px"><!--Giới tính: <b style="color: #f29c24"><?php echo $row['GIOITINH'] ?></b>&ensp;-&ensp;-->Ngày sinh: <b style="color: #f29c24"><?php echo date_format(date_create_from_format('d/m/Y', $row['NGAYSINH']), 'd/m/Y') ?></b>&ensp;-&ensp;Nơi sinh: <b style="color: #f29c24"><?php echo $row['NOISINH'] ?></b></td>
        </tr>
        <tr>
            <td style="padding: 4px 0px">Đợt thi: <b style="color: #f29c24"><?php echo $row['TENDS'] ?></b></td>
        </tr>
        <tr>
            <td style="padding: 4px 0px">Kết quả: <b style="color: #f29c24">Đạt</b></td>
        </tr>
        <tr>
            <td style="padding: 4px 0px">Số hiệu: <b style="color: #f29c24"><?php echo $row['SOHIEU'] ?></b>&ensp;-&ensp;Vào sổ ngày: <b style="color: #f29c24"><?php echo $row['NGAYVAOSO'] ?></b></td>
        </tr>
    </table>
</div>