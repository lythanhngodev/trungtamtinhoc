<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<?php
	require_once "m.khoahoc.php"; 
	function laythongbao(){
		$kn = new clsKetnoi();
		$query = "SELECT * FROM thongbao ORDER BY IDBV DESC;";
		$result = $kn->query($query);
		return $result;
	}
 ?>