<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['_checkpage'])) {echo "<h2>Đâu dễ phá vậy</2>";die();}
	include_once("../../__.php");
	if (!isset($_GET['idds']) || empty($_GET['idds'])) {
	    echo "Không tìm thấy thông tin, vui lòng thử lại!";
	    die();
	}
	$kn = new clsKetnoi();
	$idds = intval($_GET['idds']);
	$qr_l = $kn->query("SELECT TENDS FROM danhsachdangkyduthi WHERE IDDS = '$idds' LIMIT 0,1;");
	$row = mysqli_fetch_assoc($qr_l);
	$tenlop = $row['TENDS'];
	$tenfile = "DS thi ly thuyet $tenlop";
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
$qr_hv = $kn->query("SELECT DISTINCT pt.IDPT,pt.TENTHUCTE,pt.NGAYTHI,kh.TENKHOA FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV LEFT JOIN danhsachphongthi pt ON dh.IDDS=pt.IDDS AND dh.IDPT=pt.IDPT LEFT JOIN khoahoc kh ON ds.IDKH=kh.IDKH WHERE dh.IDDS='$idds' ORDER BY pt.IDPT ASC;");
$demdong = mysqli_num_rows($qr_hv);
$mangphong = null;
while ($row = mysqli_fetch_assoc($qr_hv)) {
	$mangphong[]=[$row['TENTHUCTE'],$row['NGAYTHI'],$row['TENKHOA']];
}
$stt = 1;
for ($i=0; $i < $demdong ; $i++) { 
	$stt=1; ?>
		<br style="page-break-before: always;">
		<div style="margin: 0;box-shadow: 0;font-size: 12px;">
			<table border="1" style="border-collapse: collapse;width: 100%;">
				<tr>
					<td style="text-align: center;width: 20mm"><img src="<?php echo $ttth['HOST'] ?>/ex/logo.png" width="70" height="70" /></td>
					<td style="font-size: 18.5px;text-align: center;"><b>DANH SÁCH THÍ<br>DỰ THI LÝ THUYẾT</b><br><i>(Hồ sơ phòng thi, HS-IC-01)</i></td>
					<td style="padding-left: 5mm;width: 55mm;">Mã số: BM-IC-10-00<br>Ngày hiệu lực: 04/7/2018<br>Lần soát xét: 00</td>
				</tr>
			</table>
			<p style="text-align: center;font-size: 18px;"><b>KỲ THI CẤP CHỨNG CHỈ ỨNG DỤNG CÔNG NGHỆ THÔNG TIN CƠ BẢN</b></p>
			<p style="text-align: center;font-size: 16px">Khoá <?php echo $mangphong[$i][2] ?>, ngày thi <?php echo date_format(date_create_from_format('Y-m-d', $mangphong[$i][1]), 'd/m/Y') ?> </p>
			<table border="1" style="width: 100%;border-collapse: collapse;background-color: #b3b3b3;">
				<tr style="padding-left: 0.5cm;font-size: 20px;">
					<td style="padding-left: 0.5cm;text-align: left !important;"><b>Chứng chỉ ứng dụng CNTT cơ bản</b></td>
					<td rowspan="2" style="padding-left: 0.5cm;text-align: left !important;"><b>PHÒNG THI: <?php echo $mangphong[$i][0] ?></b></td>
				</tr>
				<tr style="text-align: left;padding-left: 0.5cm;font-size: 20px;">
					<td style="padding-left: 0.5cm;"><b>Ngày thi: <?php echo date_format(date_create_from_format('Y-m-d', $mangphong[$i][1]), 'd/m/Y') ?></b></td>
				</tr>
			</table>
			<table border="1" style="width: 100%;border-collapse: collapse;font-size: 15px;">
				<tr style="background-color: #d9d9d9;text-align: center;">
					<th style="width: 1.2cm;">STT</th>
					<th style="width: 2.2cm;">SBD</th>
					<th>Họ tên</th>
					<th style="width: 2cm;">Ngày sinh</th>
					<th style="width: 1.5cm;">Giới tính</th>
					<th style="width: 1.2cm;">Mã đề</th>
					<th style="width: 1.1cm;">Máy</th>
					<th style="width: 1.1cm;">Điểm</th>
					<th style="width: 1.5cm;">Ký tên</th>
					<th style="width: 1.6cm;">Ghi chú</th>
				</tr>
				<?php 
				$qr = $kn->query("SELECT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,ds.TENDS, dh.SBD FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$idds' ORDER BY dh.SBD LIMIT ".($i*20).", 20;");
				while ($r = mysqli_fetch_assoc($qr)) { ?>
				<tr>
					<td style="text-align: center;"><?php echo $stt; ?></td>
					<td style="text-align: center;"><?php echo $r['SBD'] ?></td>
					<td style="padding-left: 0.2cm"><?php echo $r['HO']." ".$r['TEN'] ?></td>
					<td style="text-align: center;"><?php echo $r['NGAYSINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['GIOITINH'] ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="text-align: center;"></td>
				</tr>
				<?php ++$stt; } ?>
			</table>
			<p style="font-size: 16px;">Phòng thi <?php echo $mangphong[$i][0] ?> có <?php echo ($stt-1); ?> thí sinh</p>
			<p style="font-size: 16px;">Số thí sinh dự thi: ...... Số thí sinh vắng: ......</p>
			<p style="font-size: 16px;">Hoàn tất ghi nhận kết quả vào lúc...... giờ.... phút, ngày..... tháng.... năm............</p>
			<table style="width:100%;">
				<tr>
					<td colspan="3" style="text-align: right;padding-right: 0.2cm;margin-bottom: 0.5cm;font-size: 16px">Vĩnh Long, ngày ...... tháng ...... năm ......</td>
				</tr>
				<tr style="text-align: center;">
					<td><b>Giám thị coi thi</b></td>
					<td><b>Kỹ thuật viên</b></td>
					<td><b>Cán bộ vào phách</b></td>
				</tr>
			</table>
		</div>
<?php }
?>
	</div>
</body>
</html>
