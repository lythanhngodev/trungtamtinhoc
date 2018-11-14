<?php
	require_once "m.khoahoc.php"; 
	function laylophoc(){
		$kn = new clsKetnoi();
		$query = "SELECT l.IDL, l.TENLOP, kh.IDKH, kh.TENKHOA,l.DIENGIAI FROM lop l LEFT JOIN khoahoc_lop kl ON l.IDL = kl.IDL LEFT JOIN khoahoc kh ON kl.IDKH = kh.IDKH ORDER BY l.IDL DESC;";
		$result = $kn->query($query);
		return $result;
	}
	function laydanhsachcanbo(){
		$kn = new clsKetnoi();
		$query = "SELECT DISTINCT TENCB FROM phanconggiangday ORDER BY TENCB ASC;";
		$result = $kn->query($query);
		return $result;
	}
	function laydanhsachphong(){
		$kn = new clsKetnoi();
		$query = "SELECT DISTINCT DIADIEM FROM phanconggiangday ORDER BY DIADIEM ASC;";
		$result = $kn->query($query);
		return $result;
	}
	function laydanhsachbuoiday(){
		$kn = new clsKetnoi();
		$query = "SELECT DISTINCT BUOIDAY FROM phanconggiangday ORDER BY BUOIDAY ASC;";
		$result = $kn->query($query);
		return $result;
	}
 ?>