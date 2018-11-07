<?php 
	include_once("../__.php");
	if (!isset($_GET['idds']) || empty($_GET['idds'])) {
	    echo "Không tìm thấy thông tin, vui lòng thử lại!";
	    die();
	}
	$kn = new clsKetnoi();
	$idds = intval($_GET['idds']);
	$qr_l = $kn->query("SELECT TENDS FROM danhsachdangkyduthi WHERE IDDS = '$idds' LIMIT 0,1;");
	$row = mysqli_fetch_assoc($qr_l);
	$tenlop = $row['TENDS'];
	$tenfile = "DS anh phong thi $tenlop";
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
$qr_hv = $kn->query("SELECT DISTINCT pt.IDPT,pt.TENTHUCTE,pt.NGAYTHI,kh.TENKHOA FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV LEFT JOIN danhsachphongthi pt ON dh.IDDS=pt.IDDS AND dh.IDPT=pt.IDPT LEFT JOIN khoahoc kh ON ds.IDKH=kh.IDKH WHERE dh.IDDS='$idds';");
$demdong = mysqli_num_rows($qr_hv);
$demdong*=20;
$mangphong = null;
while ($row = mysqli_fetch_assoc($qr_hv)) {
	$mangphong[]=[$row['TENTHUCTE'],$row['NGAYTHI'],$row['TENKHOA']];
}
$stt = 1;
for ($i=0; $i < ceil($demdong/20) ; $i++) { 
	$stt=1;
	$trang = 1;
	$tongtrang = 0;
	if ($i==(ceil($demdong/20)-1)) {
		switch ($demdong-($i*20)) {
			case 17: case 18 : case 19:
				$tongtrang=3;
				break;
			case 9: case 10 : case 11:case 12: case 13 : case 14: case 15: case 16 :
				$tongtrang=2;
				break;
			default:
				$tongtrang=1;
				break;
		}
	}else{
		$tongtrang=3;
	}
	 ?>
		<br style="page-break-before: always;">
		<div style="margin: 0;box-shadow: 0;font-size: 12px;">
			<table border="1" style="border-collapse: collapse;width: 100%;">
				<tr>
					<td style="text-align: center;width: 20mm"><img src="<?php echo $ttth['HOST'] ?>ex/logo.png" width="70" height="70" /></td>
					<td style="font-size: 18.5px;text-align: center;"><b>DANH SÁCH ẢNH PHÒNG THI<br><i>(Hồ sơ phòng thi, HS-IC-01)</i></td>
					<td style="padding-left: 5mm;width: 55mm;">Mã số: BM-IC-09-00<br>Ngày hiệu lực: 04/7/2018<br>Lần soát xét: 00<br>Trang: <?php echo $trang."/".$tongtrang; ?></td>
				</tr>
			</table>
			<p style="text-align: center;font-size: 18px;"><b>KỲ THI CẤP CHỨNG CHỈ ỨNG DỤNG CÔNG NGHỆ THÔNG TIN .............</b></p>
			<p style="text-align: center;font-size: 16px">Khoá <?php echo $mangphong[$i][2] ?>, ngày thi <?php echo date_format(date_create_from_format('Y-m-d', $mangphong[$i][1]), 'd/m/Y') ?> </p>
			<table border="1" style="width: 100%;border-collapse: collapse;background-color: #b3b3b3;">
				<tr style="padding-left: 0.5cm;font-size: 20px;">
					<td style="padding-left: 0.5cm;text-align: left !important;"><b>Chứng chỉ ứng dụng CNTT ...............</b></td>
					<td rowspan="2" style="padding-left: 0.5cm;text-align: left !important;"><b>PHÒNG THI: <?php echo $mangphong[$i][0]; ?></b></td>
				</tr>
				<tr style="text-align: left;padding-left: 0.5cm;font-size: 20px;">
					<td style="padding-left: 0.5cm;"><b>Ngày thi: <?php echo date_format(date_create_from_format('Y-m-d', $mangphong[$i][1]), 'd/m/Y') ?></b></td>
				</tr>
			</table>
				<?php 
				$qr = $kn->query("SELECT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,ds.TENDS, dh.SBD FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$idds' LIMIT ".($i*20).", 20;");
				$cot = 1;
				while ($r = mysqli_fetch_assoc($qr)) {
					if ($cot ==1) { ?>
						<table border="1" style="width: 100%;border-collapse: collapse;font-size: 15px;">
					<?php }
					if ($cot==1 || $cot ==5) {
						echo "<tr>"; ?>
						<td style="text-align: center;width: 4cm;"><?php echo "<b>".$r['SBD']."</b><br>".$r['CMND']."<br><b>".$r['HO']." ".$r['TEN']."<b><br>".$r['NGAYSINH']; ?></td>
					<?php }elseif ($cot==2 || $cot ==6) { ?>
						<td style="text-align: center;width: 4cm;"><?php echo "<b>".$r['SBD']."</b><br>".$r['CMND']."<br><b>".$r['HO']." ".$r['TEN']."<b><br>".$r['NGAYSINH']; ?></td>
				<?php }elseif ($cot==3 || $cot==7) { ?>
						<td style="text-align: center;width: 4cm;"><?php echo "<b>".$r['SBD']."</b><br>".$r['CMND']."<br><b>".$r['HO']." ".$r['TEN']."<b><br>".$r['NGAYSINH']; ?></td>
				<?php }elseif ($cot==4 || $cot==8) { ?>
						<td style="text-align: center;width: 4cm;"><?php echo "<b>".$r['SBD']."</b><br>".$r['CMND']."<br><b>".$r['HO']." ".$r['TEN']."<b><br>".$r['NGAYSINH']; ?></td>
						</tr>
						<tr>
							<td style="width: 4cm;height: 6cm;"></td>
							<td style="width: 4cm;height: 6cm;"></td>
							<td style="width: 4cm;height: 6cm;"></td>
							<td style="width: 4cm;height: 6cm;"></td>
						</tr>
					<?php 
					if ($cot == 8) { ++$trang; ?>
					</table>
						<br style="page-break-before: always;">
						<table border="1" style="border-collapse: collapse;width: 100%;">
							<tr>
								<td style="text-align: center;width: 20mm"><img src="<?php echo $ttth['HOST'] ?>ex/logo.png" width="70" height="70" /></td>
								<td style="font-size: 18.5px;text-align: center;"><b>DANH SÁCH ẢNH PHÒNG THI<br><i>(Hồ sơ phòng thi, HS-IC-01)</i></td>
								<td style="padding-left: 5mm;width: 55mm;">Mã số: BM-IC-09-00<br>Ngày hiệu lực: 04/7/2018<br>Lần soát xét: 00<br>Trang: <?php echo $trang."/".$tongtrang; ?></td>
							</tr>
						</table><br><br>
				<?php  $cot=0;}
				}
					++$stt;$cot++; }

				if (($cot-1)<4) {
					for ($j=0; $j < 4-($cot-1); $j++) { ?>
						<td style="text-align: center;width: 4cm;"></td>
					<?php }
					echo "</tr>"; ?>
						<tr>
							<td style="width: 4cm;height: 6cm;"></td>
							<td style="width: 4cm;height: 6cm;"></td>
							<td style="width: 4cm;height: 6cm;"></td>
							<td style="width: 4cm;height: 6cm;"></td>
						</tr>
					</table>
				<?php
				}
				if (($cot-1)<8 && ($cot-1)>=5) {
					for ($j=0; $j < 4-(($cot-1)-4); $j++) { ?>
						<td style="text-align: center;width: 4cm;"></td>
					<?php }
					echo "</tr>"; ?>
						<tr>
							<td style="width: 4cm;height: 6cm;"></td>
							<td style="width: 4cm;height: 6cm;"></td>
							<td style="width: 4cm;height: 6cm;"></td>
							<td style="width: 4cm;height: 6cm;"></td>
						</tr>
					</table>
				<?php
				}
					 ?>
			</table>
			<p style="font-size: 16px;">Phòng thi <?php echo $mangphong[$i][0] ?> có <?php echo ($stt-1); ?> thí sinh</p>
			<table style="width:100%;">
				<tr>
					<td colspan="2" style="text-align: right;padding-right: 0.2cm;margin-bottom: 0.5cm;font-size: 16px">Vĩnh Long, ngày ...... tháng ...... năm ......</td>
				</tr>
				<tr style="text-align: center;">
					<td></td>
					<td style="width: 7cm;"><b>NGƯỜI LẬP DANH SÁCH</b><br><i>(Ký và ghi rõ họ tên)</i></td>
				</tr>
			</table>
		</div>
<?php }
?>
	</div>
</body>
</html>
