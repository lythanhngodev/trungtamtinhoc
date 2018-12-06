<?php
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
require_once "../../__.php";
$ketqua = array('trangthai' => 0, 'thongbao' => '' ); 
if (!isset($_SESSION['_token']) || empty($_SESSION['_token'])) {
	echo json_encode($ketqua);
	die();
}
$_token = $_SESSION['_token'];
if (isset($_POST['khoahoc']) && !empty($_POST['khoahoc']) && isset($_POST['bhv']) && !empty($_POST['bhv']) && isset($_POST['_token']) && !empty($_POST['_token'])) {
	if ($_token==$_POST['_token']) {
		$_SESSION['_token']=_token(256);
		$kn = new clsKetnoi();
		$bhv = $_POST['bhv'];

		// Chuẩn hóa chuôi
		for ($i=0; $i < count($bhv); $i++) {
		    for ($j=0; $j < count($bhv[$i]); $j++) {
		    	$bhv[$i][$j] = mysqli_real_escape_string($kn->conn,$bhv[$i][$j]);
		    }
		}
		///////////////////////////////////////
		for ($i=0; $i < count($bhv)-1; $i++) {
		    for ($j=$i+1; $j < count($bhv); $j++) {
		        $listFullName = array($bhv[$i][1]." ".$bhv[$i][2],$bhv[$j][1]." ".$bhv[$j][2]);
		        $listFullName2 = sortFullName($listFullName);
		        if ($listFullName[0]!=$listFullName2[0]) {
		            $temp = $bhv[$i];
		            $bhv[$i] = $bhv[$j];
		            $bhv[$j] = $temp;
		        }
		    }
		}
		///////////////////////////////////////
		$khoahoc = trim(mysqli_real_escape_string($kn->conn,$_POST['khoahoc']));
		$tenkhoahoc = trim(mysqli_real_escape_string($kn->conn,$_POST['tenkhoahoc']));
		$stt_lop = 0;
		$tenlopngan[$stt_lop] = $bhv[0][9];
		for ($i=1; $i < count($bhv); $i++) { 
			$ktlop = 0;
			for ($j=0; $j < count($tenlopngan); $j++) { 
				if ($tenlopngan[$j]==$bhv[$i][9]) {
					$ktlop = 1;
					break;
				}
			}
			if ($ktlop==0) {
				$tenlopngan[++$stt_lop]=$bhv[$i][9];
			}
		}
		for ($i=0; $i < count($tenlopngan); $i++) { 
	    	$tenlop = "CB"; // thieu 3
	    	switch (strlen($tenlopngan[$i])) {
	    		case 1:
	    			$tenlop.="00".substr($tenlopngan[$i], 0, strlen($tenlopngan[$i])-1);
	    			break;
	    		case 2:
	    			$tenlop.="0".substr($tenlopngan[$i], 0, strlen($tenlopngan[$i])-1);
	    			break;
	    		default:
	    			$tenlop.=substr($tenlopngan[$i], 0, strlen($tenlopngan[$i])-1);
	    			break;
	    	}
	    	switch (strlen($tenkhoahoc)) {
	    		case 1:
	    			$tenlop.="K00".$tenkhoahoc;
	    			break;
	    		case 2:
	    			$tenlop.="K0".$tenkhoahoc;
	    			break;
	    		default:
	    			$tenlop.="K".$tenkhoahoc;
	    			break;
	    	}
			// xử lý lớp học
			$chuoi_them_lop = "INSERT INTO lop(MALOP, TENLOP) VALUES ('".$tenlop."','".$tenlop."');";
			$qr_them_lop = $kn->adddata($chuoi_them_lop);
			// xử lý khóa học , lớp
			$qr_lop = "SELECT IDL FROM lop WHERE TENLOP = '".$tenlop."' LIMIT 0,1;";
			$qr_idlop = $kn->query($qr_lop);
			$rs_idlop = mysqli_fetch_array($qr_idlop);
			$idlop = $rs_idlop[0];
			if (!($kn->tontai("SELECT * FROM khoahoc_lop WHERE IDKH = '$khoahoc' AND IDL = '$idlop'"))) {
				$chuoi_them_khoa_hoc_lop = "INSERT INTO khoahoc_lop(IDKH, IDL) VALUES ('$khoahoc','$idlop');";
				$qr_them_khoa_hoc_lop = $kn->adddata($chuoi_them_khoa_hoc_lop);
			}
		}
		$dem_hocvien=0;
		for ($i=0; $i < count($bhv); $i++) {
			$MSSV = $bhv[$i][0];
			$HO = $bhv[$i][1];
			$TEN = $bhv[$i][2];
			$CMND = $bhv[$i][3];
			$NGAYSINH = $bhv[$i][4];
			$GIOITINH = $bhv[$i][5];
			$NOISINH = $bhv[$i][6];
			$SDT = $bhv[$i][7];
			///////////////////////////////
			$GHICHU = $bhv[$i][8];

	    	$tenlop = "CB"; // thieu 3
	    	switch (strlen($bhv[$i][9])) {
	    		case 1:
	    			$tenlop.="00".substr($bhv[$i][9], 0, strlen($bhv[$i][9])-1);
	    			break;
	    		case 2:
	    			$tenlop.="0".substr($bhv[$i][9], 0, strlen($bhv[$i][9])-1);
	    			break;
	    		default:
	    			$tenlop.=substr($bhv[$i][9], 0, strlen($bhv[$i][9])-1);
	    			break;
	    	}
	    	switch (strlen($tenkhoahoc)) {
	    		case 1:
	    			$tenlop.="K00".$tenkhoahoc;
	    			break;
	    		case 2:
	    			$tenlop.="K0".$tenkhoahoc;
	    			break;
	    		default:
	    			$tenlop.="K".$tenkhoahoc;
	    			break;
	    	}
			$qr_hocvien= "INSERT INTO hocvien(MSSV,HO,TEN,CMND,NGAYSINH,GIOITINH,NOISINH,SDT,GHICHU) VALUES ('$MSSV','$HO','$TEN','$CMND','$NGAYSINH','$GIOITINH','$NOISINH','$SDT','$GHICHU');";
			if (strlen($CMND)==0) {
				$qr_hocvien= "INSERT INTO hocvien(MSSV,HO,TEN,CMND,NGAYSINH,GIOITINH,NOISINH,SDT,GHICHU) VALUES ('$MSSV','$HO','$TEN',NULL,'$NGAYSINH','$GIOITINH','$NOISINH','$SDT','$GHICHU');";
			}
			$them_hocvien = $kn->adddata($qr_hocvien);

			$qr_hocvien_qr = "SELECT IDHV FROM hocvien WHERE CMND = '$CMND' LIMIT 0,1;";
			$qr_idhocvien_qr = $kn->query($qr_hocvien_qr);
			$rs_idhocvien_qr = mysqli_fetch_array($qr_idhocvien_qr);
			$idhocvien_qr = $rs_idhocvien_qr[0];

			$qr_lop = "SELECT IDL FROM lop WHERE TENLOP = '".$tenlop."' LIMIT 0,1;";
			$qr_idlop = $kn->query($qr_lop);
			$rs_idlop = mysqli_fetch_array($qr_idlop);
			$idlop = $rs_idlop[0];
			if ($idlop > 0) {
				if (!($kn->tontai("SELECT * FROM hocvien_lop WHERE IDHV = '$idhocvien_qr' AND IDL = '$idlop'"))) {
					$them_hocvien_lop = $kn->adddata("INSERT INTO hocvien_lop(IDL,IDHV,THOIGIANTHEM) VALUES ('$idlop','$idhocvien_qr','".time()."');");
					//echo "INSERT INTO hocvien_lop(IDL,IDHV,THOIGIANTHEM) VALUES ('$idlop','$idhocvien_qr','".time()."');";
				}
			}
		}
		$ketqua['thongbao'] = "Đã nhập thành công học viên";
		$ketqua['trangthai'] = 1;
		echo json_encode($ketqua);
		die();
	}
	else{
		$ketqua['thongbao'] = 'Bạn đã thao tác dư liệu này rồi';
		$_SESSION['_token']=_token(256);
		echo json_encode($ketqua);
		die();
	}
}
else{
	$ketqua['thongbao'] = 'Có lỗi xảy ra, vui lòng load lại trang';
	$_SESSION['_token']=_token(256);
	echo json_encode($ketqua);
	die();
}
 ?>}
