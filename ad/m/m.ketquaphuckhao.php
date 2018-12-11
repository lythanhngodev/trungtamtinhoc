<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<?php
	require_once "m.khoahoc.php"; 
	function laydanhsachphuckhao(){
		$kn = new clsKetnoi();
		$query = "SELECT pk.IDPK,pk.TENPK,pk.IDDS,ds.TENDS,ds.LOAITHI FROM danhsachphuckhao pk LEFT JOIN danhsachdangkyduthi ds ON pk.IDDS=ds.IDDS ORDER BY IDPK DESC;";
		$result = $kn->query($query);
		return $result;
	}
 ?>