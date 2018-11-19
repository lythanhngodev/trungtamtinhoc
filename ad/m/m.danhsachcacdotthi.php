<?php
	require_once "m.khoahoc.php"; 
	
	function laydanhsachdotthi(){
		$kn = new clsKetnoi();
		$query = "SELECT DISTINCT ds.IDDS,ds.TENDS,ds.TUNGAY,ds.DENNGAY FROM danhsachdangkyduthi ds";
		$result = $kn->query($query);
		return $result;
	}
 ?>