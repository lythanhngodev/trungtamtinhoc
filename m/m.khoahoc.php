<?php 
	function laykhoahoc(){
		$kn = new clsKetnoi();
		$query = "SELECT * from khoahoc ORDER BY IDKH DESC;";
		$result = $kn->query($query);
		return $result;
	}
 ?>