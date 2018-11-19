<?php
	require_once "m.khoahoc.php";
	function laydanhsachdangkyduthi(){
		$kn = new clsKetnoi();
		$query = "SELECT * FROM danhsachdangkyduthi;";
		$result = $kn->query($query);
		return $result;
	}
 ?>