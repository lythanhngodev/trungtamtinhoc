<?php 
	include_once("../../__.php");
	if (!isset($_POST['idds']) || empty($_POST['idds'])) {
	    echo "Không tìm thấy thông tin, vui lòng thử lại!";
	    die();
	}
	$kn = new clsKetnoi();
	$idds = intval($_POST['idds']);
	$qr_l = $kn->query("SELECT dk.TENDS, kh.TENKHOA FROM danhsachdangkyduthi dk LEFT JOIN khoahoc kh ON dk.IDKH=kh.IDKH WHERE IDDS = '$idds' LIMIT 0,1;");
	$row = mysqli_fetch_assoc($qr_l);
	$tenlop = $row['TENDS'];
	$khoahoc = $row['TENKHOA'];
	$tenfile = "Danh sach phong thi $tenlop";
	$ao = $_POST['ao'];
	$thuc = $_POST['thuc'];
	$ngaythi = $_POST['ngaythi'];
	$tong = count($ao);
	$kn->deletedata("DELETE FROM danhsachphongthi WHERE IDDS = '$idds';");
	$hs = 0;
	$idpt = [];
	for ($i=0; $i < $tong; $i++) { 
		$kn->adddata("INSERT INTO danhsachphongthi(IDDS,TENGOINHO,TENTHUCTE,NGAYTHI) VALUES ('$idds','".$ao[$i]."','".$thuc[$i]."','".$ngaythi[$i]."');");
		++$hs;
	}
	$phongthi = $kn->query("SELECT IDPT FROM danhsachphongthi WHERE IDDS = '$idds' ORDER BY IDPT ASC;");
	$phong;
	$sttp=-1;
	while ($row=mysqli_fetch_assoc($phongthi)) {
		$phong[++$sttp] = $row['IDPT'];
	}
	$h_hv = $kn->query("SELECT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,ds.TENDS, dh.SBD FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$idds';");
	$ds_hv=null;
	while ($row=mysqli_fetch_assoc($h_hv)) {
		$ds_hv[]=$row;
	}
	if (count($ds_hv)==0) {
		echo "Đợt thi này chưa có thí sinh nào.";
		die();
	}
#############
	for ($i=0; $i < count($ds_hv)-1; $i++) {
	    for ($j=$i+1; $j < count($ds_hv); $j++) {
	        $listFullName = array($ds_hv[$i]['HO']." ".$ds_hv[$i]['TEN'],$ds_hv[$j]['HO']." ".$ds_hv[$j]['TEN']);
	        $listFullName2 = sortFullName($listFullName);
	        if ($listFullName[0]!=$listFullName2[0]) {
	            $temp = $ds_hv[$i];
	            $ds_hv[$i] = $ds_hv[$j];
	            $ds_hv[$j] = $temp;
	        }
	    }
	}
	for ($i=0; $i < count($ds_hv); $i++) {
		#xử lý số báo danh
		$skhoa = "K"; // thieu 3
		switch (strlen($khoahoc)) {
			case 1:
				$skhoa.="00".$khoahoc;
				break;
			case 2:
				$skhoa.="0".$khoahoc;
				break;
			default:
				$skhoa.=$khoahoc;
				break;
		}
		$sso = "CB"; // thieu 3
		switch (strlen($i+1)) {
			case 1:
				$sso.="00".($i+1);
				break;
			case 2:
				$sso.="0".($i+1);
				break;
			default:
				$sso.=($i+1);
				break;
		}
		$sbd = $skhoa.$sso;
		$kn->editdata("UPDATE danhsachdangkyduthi_hocvien SET SBD = '$sbd' WHERE IDDS='$idds' AND IDHV='".$ds_hv[$i]['IDHV']."'");
	}
 ?>
 <?php
	 header("Content-Type: application/vnd.ms-word");
	 header("Expires: 0");
	 header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	 header("content-disposition: attachment;filename=$tenfile.doc");
?>

<html>
<head>
    <style>
        p.MsoFooter, li.MsoFooter, div.MsoFooter{
            margin: 0cm;
            margin-bottom: 0001pt;
            mso-pagination:widow-orphan;
            font-size: 12.0 pt;
            text-align: right;
        }
        @page Section1{
            size: 21cm 29.7cm;
            margin: 1.5cm 1.5cm 1.5cm 1.5cm;
        }
        div.Section1{ page:Section1;}
        p{
        	margin: 0.3cm 0cm 0.3cm 0cm;
        }
    </style>
</head>
<body style="width: 26.7cm">
	<div class="Section1">
<?php 
$stt = 1;
for ($i=0; $i < $tong ; $i++) { 
	$stt=1; ?>
		<br style="page-break-before: always;">
		<div style="margin: 0;box-shadow: 0;font-size: 18px;">
			<table border="1" style="border-collapse: collapse;width: 100%;">
				<tr>
					<td style="text-align: center;width: 20mm"><img src="<?php echo $ttth['HOST'] ?>ex/logo.png" width="70" height="70" /></td>
					<td style="font-size: 18px;text-align: center;"><b>DANH SÁCH THÍ SINH PHÒNG THI</b><br><i>(Hồ sơ phòng thi, HS-IC-01)</i></td>
					<td style="padding-left: 5mm;width: 45mm;">Mã số: BM-IC-07-00<br>Ngày hiệu lực: 04/7/2018<br>Lần soát xét: 00</td>
				</tr>
			</table>
			<p style="text-align: center;font-size: 20px;"><b>KỲ THI CẤP CHỨNG CHỈ ỨNG DỤNG CÔNG NGHỆ THÔNG TIN CƠ BẢN</b></p>
			<p style="text-align: center;">Khoá ........, ngày thi <?php echo date_format(date_create_from_format('Y-m-d', $ngaythi[$i]), 'd/m/Y') ?> </p>
			<table border="1" style="width: 100%;border-collapse: collapse;background-color: #b3b3b3;">
				<tr style="padding-left: 0.5cm;font-size: 16pt;">
					<td style="padding-left: 0.5cm;text-align: left !important;"><b>Chứng chỉ ứng dụng CNTT cơ bản</b></td>
					<td rowspan="2" style="padding-left: 0.5cm;text-align: left !important;"><b>PHÒNG THI: <?php echo ($i+1)."<br><span style='font-size:14pt;'>(Phòng thực tế: ".$thuc[$i].")</span>"; ?></b></td>
				</tr>
				<tr style="text-align: left;padding-left: 0.5cm;font-size: 20px;">
					<td style="padding-left: 0.5cm;"><b>Ngày thi: <?php echo date_format(date_create_from_format('Y-m-d', $ngaythi[$i]), 'd/m/Y') ?></b></td>
				</tr>
			</table>
			<table border="1" style="width: 100%;border-collapse: collapse;">
				<tr style="background-color: #d9d9d9;text-align: center;">
					<th>STT</th>
					<th style="width: 3cm;">SBD</th>
					<td><b>Số CMND</b></td>
					<th>Họ tên</th>
					<th>Ngày sinh</th>
					<th style="width: 1.5cm;">Giới tính</th>
					<td><b>Nơi sinh</b><br><i>(Tỉnh/TP)</i></td>
					<th>Ghi chú</th>
				</tr>
				<?php 
				$qr = $kn->query("SELECT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,ds.TENDS, dh.SBD,dh.GHICHU FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$idds' ORDER BY dh.SBD ASC LIMIT ".($i*20).", 20;");
				while ($r = mysqli_fetch_assoc($qr)) { ?>
				<tr>
					<td style="text-align: center;"><?php echo $stt; ?></td>
					<td style="text-align: center;"><?php echo $r['SBD'] ?></td>
					<td style="text-align: center;"><?php echo $r['CMND'] ?></td>
					<td style="padding-left: 0.3cm"><?php echo $r['HO']." ".$r['TEN'] ?></td>
					<td style="text-align: center;"><?php echo $r['NGAYSINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['GIOITINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['NOISINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['GHICHU'] ?></td>
					<?php 
					$kn->editdata("UPDATE danhsachdangkyduthi_hocvien SET IDPT='".$phong[$i]."' WHERE IDDS='$idds' AND IDHV='".$r['IDHV']."';");
					 ?>
				</tr>
				<?php ++$stt; } ?>
			</table>
			<p><i>Phòng thi <b><?php echo ($i+1); ?></b> có <b><?php echo ($stt-1); ?></b> thí sinh.</i></p>
			<table style="width:100%;">
				<tr>
					<td colspan="3" style="text-align: right;padding-right: 0.2cm;margin-bottom: 0.5cm;">Vĩnh Long, ngày ... tháng ... năm ......</td>
				</tr>
				<tr style="text-align: center;">
					<td style="width: 12cm;"></td>
					<td><b>CHỦ TỊCH HỘI ĐỒNG THI</b><br><i>(Ký và ghi rõ họ tên)</i></td>
				</tr>
			</table>
		</div>
<?php }
?>
	</div>
</body>
</html>
