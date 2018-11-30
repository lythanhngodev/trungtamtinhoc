<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<?php 
	function laykhoahoc(){
		$kn = new clsKetnoi();
		$query = "SELECT kh.IDKH,kh.TENKHOA,kh.TGBATDAU,kh.TGKETTHUC,kh.HOANTHANH, kh.LOAIKHOA,(SELECT COUNT(*) FROM khoahoc_lop kl WHERE kl.IDKH=kh.IDKH) as 'SOLOP' from khoahoc kh ORDER BY kh.IDKH DESC;";
		$result = $kn->query($query);
		return $result;
	}
	function layloaikhoa(){
		$kn = new clsKetnoi();
		$query = "SELECT DISTINCT * FROM loaikhoa ORDER BY IDLK DESC;";
		$result = $kn->query($query);
		return $result;
	}
 ?>