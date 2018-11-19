<?php 
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
	$tenfile = "Danh sach the du thi $tenlop";
	$qr_k = $kn->query("SELECT kh.TENKHOA FROM danhsachdangkyduthi dk LEFT JOIN khoahoc kh ON dk.IDKH=kh.IDKH WHERE IDDS = '$idds' LIMIT 0,1;");
	$row_k = mysqli_fetch_assoc($qr_k);
	$tenkhoahoc = $row_k['TENKHOA'];
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
            size: 29.7cm 21cm;
            margin: 2cm 2cm 2cm 2cm;
        }
        div.Section1 { page:Section1;}
        p{
        	margin: 0.3cm 0cm 0.3cm 0cm;
        }
    </style>
</head>
<body style="width: 25.7cm">
	<div class="Section1">
<?php 
$qr_ds = $kn->query("SELECT * FROM danhsachphongthi WHERE IDDS = '$idds';");
$tong = mysqli_num_rows($qr_ds);

$qr_ds = $kn->query("SELECT DISTINCT pt.IDPT,pt.TENTHUCTE,pt.NGAYTHI,kh.TENKHOA FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV LEFT JOIN danhsachphongthi pt ON dh.IDDS=pt.IDDS AND dh.IDPT=pt.IDPT LEFT JOIN khoahoc kh ON ds.IDKH=kh.IDKH WHERE dh.IDDS='$idds';");
$mangphong = null;
while ($row = mysqli_fetch_assoc($qr_ds)) {
	$mangphong[]=[$row['TENTHUCTE'],$row['NGAYTHI'],$row['TENKHOA']];
}

$stt = 1;
for ($i=0; $i < $tong ; $i++) { ?>
		<br style="page-break-before: always;">
		<div style="margin: 0;box-shadow: 0;font-size: 18px;">
			<table id="bangheader" border="1" style="border-collapse: collapse;width: 100%;">
				<tr>
					<td style="text-align: center;width: 20mm"><img src="<?php echo $ttth['HOST'] ?>ex/logo.png" width="70" height="70"></td>
					<th style="font-size: 18.5px;text-align: center;">DANH SÁCH CẤP THẺ DỰ THI</th>
					<td style="padding-left: 5mm;width: 54mm;">Mã số: BM-IC-15-00<br>Ngày hiệu lực: 04/7/2018<br>Lần soát xét: 00 <br>Trang: <?php echo ($i+1)."/".($tong); ?></td>
				</tr>
			</table>
			<?php if($i==0){ ?>
			<p style="text-align: center;font-size: 20px;"><b>KỲ THI CẤP CHỨNG CHỈ ỨNG DỤNG CÔNG NGHỆ THÔNG TIN CƠ BẢN</b></p>
			<p style="text-align: center;">Khoá <?php echo $tenkhoahoc; ?>, ngày thi <?php echo date_format(date_create_from_format('Y-m-d', $mangphong[$i][1]), 'd/m/Y') ?> </p>
		<?php } else echo "<br><br>" ?>
			<table border="1" style="width: 100%;border-collapse: collapse;">
				<tr style="background-color: #d9d9d9;text-align: center;">
					<th>STT</th>
					<th>SBD</th>
					<th colspan="2">Họ tên</th>
					<th>Ngày sinh</th>
					<th>Giới tính</th>
					<td><b>Nơi sinh</b><br><i>(Tỉnh/TP)</i></td>
					<td><b>Số CMND</b><br><i>(hoặc mã số<br>giấy tờ đăng ký)</i></td>
					<th>Phòng thi</th>
					<th>Ngày thi</th>
					<th>Ký nhận</th>
				</tr>
				<?php 
				$qr_hv = $kn->query("SELECT DISTINCT dh.SBD,hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,hv.SDT,hv.MASOBIENLAI,hv.NGAYGHIBIENLAI,hv.GHICHU,ds.TENTHUCTE FROM danhsachdangkyduthi_hocvien dh LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV LEFT JOIN danhsachphongthi ds ON dh.IDPT=ds.IDPT  WHERE dh.IDDS='$idds' ORDER BY dh.SBD ASC LIMIT ".($i*20).", 20;");
				while ($r = mysqli_fetch_assoc($qr_hv)) { ?>
				<tr>
					<td style="text-align: center;"><?php echo $stt; ?></td>
					<td style="text-align: center;"><?php echo $r['SBD']; ?></td>
					<td style="padding-left: 0.3cm"><?php echo $r['HO'] ?></td>
					<td style="padding-left: 0.3cm"><?php echo $r['TEN'] ?></td>
					<td style="text-align: center;"><?php echo $r['NGAYSINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['GIOITINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['NOISINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['CMND'] ?></td>
					<td style="text-align: center;"><?php echo $r['TENTHUCTE'] ?></td>
					<td style="text-align: center;"></td>
					<td style="text-align: center;"></td>
				</tr>
				<?php ++$stt; } ?>
			</table>
		</div>
<?php }
?>
<p><b><i>Danh sách có: <?php echo (--$stt); ?> thí sinh đăng ký dự thi</i></b></p>
	<table style="width:100%;">
		<tr>
			<td colspan="3" style="text-align: right;padding-right: 0.2cm;margin-bottom: 0.5cm;">Vĩnh Long, ngày ... tháng ... năm ...... <br></td>
		</tr>
		<tr style="text-align: center;">
			<td><b>Hiệu trưởng</b></td>
			<td><b>Giams đốc Trung tâm</b></td>
			<td><b>Người lập bảng</b></td>
		</tr>
	</table>
	</div>
</body>
</html>