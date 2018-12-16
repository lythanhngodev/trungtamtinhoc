<?php
require_once '__.php';
function laydotthi(){
	$kn = new clsKetnoi();
	$query = "SELECT DISTINCT vwD.TENDS,sha2(sha2(vwD.IDDS,256),224) AS IDDS, vwD.TUNGAY, vwD.DENNGAY FROM vwdiemthi vwD ORDER BY vwD.TUNGAY DESC, TENDS DESC;";
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
function layhinhthongbao($id){
    $kn = new clsKetnoi();
    $query = "SELECT * FROM thongbao_hinhanh WHERE IDBV='$id' ORDER BY IDTBBV ASC;";
    $result = $kn->query($query);
    return $result;
}
function idtudong($sokytu){
    $bangchucai = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $matkhauduoctao = array();
    $chieudaimang = strlen($bangchucai) - 1;
    for ($i = 0; $i < $sokytu; $i++) {
        $n = rand(0, $chieudaimang);
        $matkhauduoctao[] = $bangchucai[$n];
    }
    return implode($matkhauduoctao); //turn the array into a string
}
?>
<?php 
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
 ?>
