<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<?php 
	function laykhoahoc(){
		$kn = new clsKetnoi();
		$query = "SELECT kh.IDKH,kh.TENKHOA,kh.TGBATDAU,kh.TGKETTHUC,kh.HOANTHANH, (SELECT COUNT(*) FROM khoahoc_lop kl WHERE kl.IDKH=kh.IDKH) as 'SOLOP' from khoahoc kh ORDER BY kh.IDKH DESC;";
		$result = $kn->query($query);
		return $result;
	}
 ?>