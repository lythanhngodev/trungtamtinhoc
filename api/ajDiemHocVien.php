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
if (!isset($_POST['key'])) {
	echo "Không có thông tin";
	die();
}
require_once '../__.php';
$kn = new clsKetnoi();
$key = mysqli_real_escape_string($kn->conn,$_POST['key']);
$sql = "
	SELECT DISTINCT HOTEN, CMND, MSSV,IDHV,SBD FROM vwDiemThi WHERE CMND like '%".$key."%'
	UNION
	SELECT DISTINCT HOTEN, CMND, MSSV,IDHV,SBD FROM vwDiemThi WHERE MSSV like '%".$key."%'
	UNION
	SELECT DISTINCT HOTEN, CMND, MSSV,IDHV,SBD FROM vwDiemThi WHERE HOTEN like '%".$key."%'
	UNION
	SELECT DISTINCT HOTEN, CMND, MSSV,IDHV,SBD FROM vwDiemThi WHERE SBD like '%".$key."%' ORDER BY SBD DESC LIMIT 0,50;
";
$danhsach = $kn->query($sql);
$ds = null;
while ($row = mysqli_fetch_assoc($danhsach)) {
	$ds[]=$row;
}
echo json_encode($ds);
 ?>