<?php
require_once '__.php';
function laydotthi(){
	$kn = new clsKetnoi();
	$query = "SELECT DISTINCT vwD.TENDS,vwD.IDDS, vwD.TUNGAY, vwD.DENNGAY FROM vwdiemthi vwD;";
	$result = $kn->query($query);
	return $result;
}
// lấy ra 8 bài đăng gần đây
function laythongbao(){
	$kn = new clsKetnoi();
	$query = "SELECT DISTINCT * FROM thongbao WHERE HIENTHI = b'0' ORDER BY IDBV DESC LIMIT 0,8;";
	$result = $kn->query($query);
	return $result;
}
function xemthongbao($id){
	$kn = new clsKetnoi();
	$query = "SELECT DISTINCT * FROM thongbao WHERE HIENTHI = b'0' AND IDBV = '$id';";
	$result = $kn->query($query);
	return $result;
}
?>