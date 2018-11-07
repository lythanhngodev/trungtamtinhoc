<?php
session_start();
require_once "../__.php";
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
		$khoahoc = mysqli_real_escape_string($kn->conn,$_POST['khoahoc']);
		
		$stt_lop = 0;
		$tenlopngan[$stt_lop] = array($bhv[0][11],$bhv[0][13]);
		for ($i=1; $i < count($bhv); $i++) { 
			$ktlop = 0;
			for ($j=0; $j < count($tenlopngan); $j++) { 
				if ($tenlopngan[$j][1]==$bhv[$i][13]) {
					$ktlop = 1;
					break;
				}
			}
			if ($ktlop==0) {
				$tenlopngan[++$stt_lop]=array($bhv[$i][11],$bhv[$i][13]);
			}
		}
		for ($i=0; $i < count($tenlopngan); $i++) { 
			// xử lý lớp học
			$chuoi_them_lop = "INSERT INTO lop(MALOP, TENLOP) VALUES ('".$tenlopngan[$i][0]."','".$tenlopngan[$i][1]."');";
			$qr_them_lop = $kn->adddata($chuoi_them_lop);
			// xử lý khóa học , lớp
			$qr_lop = "SELECT IDL FROM lop WHERE TENLOP = '".$tenlopngan[$i][1]."' LIMIT 0,1;";
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
			$MASOBIENLAI = $bhv[$i][8];
			$NGAYGHIBIENLAI = $bhv[$i][9];
			$GHICHU = $bhv[$i][10];
			$qr_hocvien= "INSERT INTO hocvien(MSSV,HO,TEN,CMND,NGAYSINH,GIOITINH,NOISINH,SDT,MASOBIENLAI,NGAYGHIBIENLAI,GHICHU) VALUES ('$MSSV','$HO','$TEN','$CMND','$NGAYSINH','$GIOITINH','$NOISINH','$SDT','$MASOBIENLAI','$NGAYGHIBIENLAI','$GHICHU');";
			$them_hocvien = $kn->adddata($qr_hocvien);

			$qr_hocvien_qr = "SELECT IDHV FROM hocvien WHERE CMND = '$CMND' LIMIT 0,1;";
			$qr_idhocvien_qr = $kn->query($qr_hocvien_qr);
			$rs_idhocvien_qr = mysqli_fetch_array($qr_idhocvien_qr);
			$idhocvien_qr = $rs_idhocvien_qr[0];

			$qr_lop = "SELECT IDL FROM lop WHERE TENLOP = '".$bhv[$i][13]."' LIMIT 0,1;";
			$qr_idlop = $kn->query($qr_lop);
			$rs_idlop = mysqli_fetch_array($qr_idlop);
			$idlop = $rs_idlop[0];
			if ($idlop > 0) {
				if (!($kn->tontai("SELECT * FROM hocvien_lop WHERE IDHV = '$idhocvien_qr' AND IDL = '$idlop'"))) {
					$them_hocvien_lop = $kn->adddata("INSERT INTO hocvien_lop(IDL,IDHV,THOIGIANTHEM) VALUES ('$idlop','$idhocvien_qr','".time()."')");
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
