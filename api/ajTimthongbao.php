<?php 
error_reporting(0);
if (!isset($_POST['key'])) {
	echo "Không có thông tin";
	die();
}
require_once '../__.php';
$kn = new clsKetnoi();
$key = mysqli_real_escape_string($kn->conn,$_POST['key']);
$sql = "
	SELECT DISTINCT TENTB FROM thongbao WHERE TENTB like '%".$key."%' ORDER BY IDBV DESC LIMIT 0,10;
";
$danhsach = $kn->query($sql);
$ds = null;
while ($row = mysqli_fetch_assoc($danhsach)) {
	$ds[]=$row;
}
echo json_encode($ds);
 ?>