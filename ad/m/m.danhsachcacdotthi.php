<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<?php
	require_once "m.khoahoc.php"; 
	
	function laydanhsachdotthi(){
		$kn = new clsKetnoi();
		$query = "SELECT DISTINCT * FROM danhsachdangkyduthi ds WHERE HOANTHANH=b'0' ORDER BY IDDS DESC;";
		echo "SELECT DISTINCT * FROM danhsachdangkyduthi ds WHERE HOANTHANH=b'0' ORDER BY IDDS DESC;";
		$result = $kn->query($query);
		return $result;
	}
	function laydanhsachdotthi_all(){
		$kn = new clsKetnoi();
		$query = "SELECT DISTINCT * FROM danhsachdangkyduthi ds ORDER BY IDDS DESC;";
		$result = $kn->query($query);
		return $result;
	}
 ?>