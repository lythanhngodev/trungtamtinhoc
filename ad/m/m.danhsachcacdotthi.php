<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<?php
	require_once "m.khoahoc.php"; 
	
	function laydanhsachdotthi(){
		$kn = new clsKetnoi();
		$query = "SELECT DISTINCT ds.IDDS,ds.TENDS,ds.TUNGAY,ds.DENNGAY,ds.LOAITHI FROM danhsachdangkyduthi ds ORDER BY IDDS DESC;";
		$result = $kn->query($query);
		return $result;
	}
 ?>