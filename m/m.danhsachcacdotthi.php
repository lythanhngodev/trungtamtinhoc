<?php
	require_once "m.khoahoc.php"; 
	
	function laydanhsachdotthi(){
		$kn = new clsKetnoi();
		$query = "SELECT DISTINCT ds.IDDS,ds.TENDS,ds.TG,kh.TENKHOA FROM danhsachdangkyduthi ds LEFT JOIN khoahoc kh ON ds.IDKH=kh.IDKH;";
		$result = $kn->query($query);
		return $result;
	}
 ?>