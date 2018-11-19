<?php 
	include_once("../__.php");
	if (!isset($_GET['idl']) || empty($_GET['idl'])) {
	    echo "Không tìm thấy thông tin, vui lòng thử lại!";
	    die();
	}
	$kn = new clsKetnoi();
	$idl = intval($_GET['idl']);
	$qr_l = $kn->query("SELECT l.TENLOP,kh.TENKHOA,kh.TGBATDAU,kh.TGKETTHUC,l.CBGD,l.PHONG FROM lop l LEFT JOIN khoahoc_lop khl ON l.IDL=khl.IDL LEFT JOIN khoahoc kh ON khl.IDKH=kh.IDKH WHERE l.IDL = '$idl';");
	$row = mysqli_fetch_assoc($qr_l);
	$tenlop = $row['TENLOP'];
	$tenfile = "Danh sach lop $tenlop";
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
		<div style="margin: 0;box-shadow: 0;font-size: 18px;">
			<p style="text-align: center;font-size: 24px;"><b>DANH SÁCH HỌC VIÊN</b></p>
			<p style="text-align: center;"><b>LỚP KỸ NĂNG SỬ DỤNG CÔNG NGHỆ THÔNG TIN CƠ BẢN</b></p>
			<p style="text-align: center;">Khoá <?php echo $row['TENKHOA'] ?>, từ ngày <?php echo date('d/m/Y',strtotime($row['TGBATDAU'])) ?> đến ngày <?php echo date('d/m/Y',strtotime($row['TGKETTHUC'])) ?></p>
			<p style="text-align: center;">Mã lớp: <?php echo $row['TENLOP'] ?>, CBGD: <?php echo $row['CBGD'] ?>, Phòng: <?php echo $row['PHONG'] ?></p>
			<p style="text-align: center;"><i>(Kèm theo quyết định số ..../QĐ-ĐHSPKTVL-TTNNTH ngày ..... tháng .... năm .......)</i></p>
			<table border="1" style="width: 100%;border-collapse: collapse;">
				<tr style="background-color: #d9d9d9;text-align: center;">
					<th>STT</th>
					<th>Họ và Tên</th>
					<th>Ngày sinh</th>
					<th>Giới tính</th>
					<td><b>Nơi sinh</b><br><i>(Tỉnh/TP)</i></td>
					<th>Ghi chú</th>
				</tr>
				<?php 
				$qr_hv = $kn->query("SELECT hv.HO,hv.TEN,hv.NGAYSINH,hv.GIOITINH,hv.NOISINH,hv.GHICHU FROM hocvien_lop hvl LEFT JOIN hocvien hv On hvl.IDHV = hv.IDHV WHERE hvl.IDL = '$idl';");
				$stt = 1;
				while ($r = mysqli_fetch_assoc($qr_hv)) { ?>
				<tr>
					<td style="text-align: center;"><?php echo $stt; ?></td>
					<td style="padding-left: 0.3cm"><?php echo $r['HO']." ".$r['TEN'] ?></td>
					<td style="text-align: center;"><?php echo $r['NGAYSINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['GIOITINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['NOISINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['GHICHU'] ?></td>
				</tr>
				<?php ++$stt; } ?>
			</table>
			<p><i>Danh sách có <b><?php echo ($stt-1); ?></b> học viên.</i></p>
			<table style="width:100%;font-size: 14pt;">
				<tr style="text-align: center;">
					<td></td>
					<td style="width: 4cm;"><b>Hiệu trưởng</b></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>