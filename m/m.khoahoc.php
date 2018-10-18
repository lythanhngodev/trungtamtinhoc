<?php 
	function laykhoahoc(){
		$kn = new clsKetnoi();
		$query = "SELECT * from khoahoc;";
		$result = $kn->query($query);
		return $result;
	}
 ?>