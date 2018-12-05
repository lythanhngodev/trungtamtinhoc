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
	SELECT DISTINCT HOTEN, CMND, MSSV,sha2(sha2(IDHV,256),224),SBD FROM vwDiemThi WHERE CMND like '%".$key."%'
	UNION
	SELECT DISTINCT HOTEN, CMND, MSSV,sha2(sha2(IDHV,256),224),SBD FROM vwDiemThi WHERE MSSV like '%".$key."%'
	UNION
	SELECT DISTINCT HOTEN, CMND, MSSV,sha2(sha2(IDHV,256),224),SBD FROM vwDiemThi WHERE HOTEN like '%".$key."%'
	UNION
	SELECT DISTINCT HOTEN, CMND, MSSV,sha2(sha2(IDHV,256),224),SBD FROM vwDiemThi WHERE SBD like '%".$key."%' ORDER BY SBD DESC LIMIT 0,50;
";
$danhsach = $kn->query($sql);
$ds = null;
while ($row = mysqli_fetch_row($danhsach)) {
	$ds[]=$row;
}
for ($i=0; $i < count($ds); $i++) { 
    for ($j=0; $j < count($ds[$i]); $j++) { 
        if ($ds[$i][$j]==null) {
            $ds[$i][$j] = '';
        }
    }
}
echo json_encode($ds);
 ?>