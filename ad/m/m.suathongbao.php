<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<?php
	require_once "m.khoahoc.php"; 
	function laythongbao($id){
		$kn = new clsKetnoi();
		$query = "SELECT * FROM thongbao WHERE IDBV='$id' ORDER BY IDBV DESC;";
		$result = $kn->query($query);
		return $result;
	}
	function layhinhthongbao($id){
		$kn = new clsKetnoi();
		$query = "SELECT * FROM thongbao_hinhanh WHERE IDBV='$id' ORDER BY IDTBBV ASC;";
		$result = $kn->query($query);
		return $result;
	}
 ?>