<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<?php
	require_once "m.khoahoc.php"; 
	function laydanhsachdangkyduthi(){
		$kn = new clsKetnoi();
		$query = "SELECT * FROM danhsachdangkyduthi WHERE HOANTHANH=b'0' ORDER BY IDDS DESC;";
		$result = $kn->query($query);
		return $result;
	}
 ?>