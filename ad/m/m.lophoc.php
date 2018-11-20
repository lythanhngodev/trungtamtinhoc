<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<?php
	require_once "m.khoahoc.php"; 
	function laylophoc(){
		$kn = new clsKetnoi();
		$query = "SELECT l.IDL, l.TENLOP, kh.IDKH, kh.TENKHOA,l.DIENGIAI FROM lop l LEFT JOIN khoahoc_lop kl ON l.IDL = kl.IDL LEFT JOIN khoahoc kh ON kl.IDKH = kh.IDKH ORDER BY l.IDL DESC;";
		$result = $kn->query($query);
		return $result;
	}
 ?>