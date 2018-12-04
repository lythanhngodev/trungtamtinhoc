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
	$tenfile = "DS de nghi cap chung chi $tenlop";
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
        	mso-first-header: fh1;
        }
    </style>
</head>
<body style="width: 26.7cm">
	<div class="Section1">
<?php 
$qr_hv = $kn->query("SELECT DISTINCT pt.IDPT,pt.TENTHUCTE,pt.NGAYTHI,kh.TENKHOA,hv.IDHV FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV LEFT JOIN danhsachphongthi pt ON dh.IDDS=pt.IDDS AND dh.IDPT=pt.IDPT LEFT JOIN khoahoc kh ON ds.IDKH=kh.IDKH WHERE dh.IDDS='$idds';");
$demdong = mysqli_num_rows($qr_hv);
$mangphong = null;
while ($row = mysqli_fetch_assoc($qr_hv)) {
	$mangphong[]=[$row['TENTHUCTE'],$row['NGAYTHI'],$row['TENKHOA']];
}?>
<br style="page-break-before: always;">
<div style="margin: 0;box-shadow: 0;font-size: 12px;">
	<table border="1" style="border-collapse: collapse;width: 100%;">
		<tr>
			<td style="text-align: center;width: 20mm"><img src="<?php echo $ttth['HOST'] ?>ex/logo.png" width="70" height="70" /></td>
			<td style="font-size: 18.5px;text-align: center;"><b>GIẤY ĐỀ NGHỊ<br>CẤP CHỨNG CHỈ ỨNG DỤNG<br>CÔNG NGHỆ THÔNG TIN</b></td>
			<td style="padding-left: 5mm;width: 55mm;">Mã số: BM-IC-26-00<br>Ngày hiệu lực: 04/7/2018<br>Lần soát xét: 00<br>Trang: .../...</td>
		</tr>
	</table>
	<br>
	<table style="font-size: 13pt;">
		<tr>
			<td style="width: 3cm;text-align: right;">Kính gửi:</td>
			<th>- Thầy hiệu trưởng</th>
		</tr>
		<tr>
			<td></td>
			<th>- Phòng đào tạo</th>
		</tr>
	</table>
<p style="text-align: center;font-size: 14pt;"><b>NỘI DUNG ĐỀ NGHỊ</b></p>
<p style="text-align: justify;text-indent:1.0cm;font-size: 13pt;line-height: 1.5pt;">Căn cứ Quyết định số 1785/QĐ-LĐTBXH ngày 21/11/2013 của Bộ trưởng Bộ Lao động – Thương binh và Xã hội về việc quy định chức năng, nhiệm vụ và cơ cấu tổ chức của trường Đại học Sư Phạm Kỹ Thuật Vĩnh Long;</p>
<p style="text-align: justify;text-indent:1.0cm;font-size: 13pt;line-height: 1.5pt;">Căn cứ Thông tư liên tịch số 17/2016/TTLT-BGDĐT-BTTTT ngày 21/6/2016 của Bộ Giáo dục và Đào Tạo, Bộ Thông tin và Truyền thông về việc Quy định tổ chức thi và cấp chứng chỉ ứng dụng công nghệ thông tin (sau đây gọi tắt là Thông tư 17/2016/TTLT-BGDĐT-BTTTT);</p>
<p style="text-align: justify;text-indent:1.0cm;font-size: 13pt;line-height: 1.5pt;">Căn cứ Thông tư số 03/2014/TT-BTTTT ngày 11/3/2014 của Bộ Thông tin và Truyền thông về việc Quy định chuẩn kỹ năng sử dụng công nghệ thông tin;</p>
<p style="text-align: justify;text-indent:1.0cm;font-size: 13pt;line-height: 1.5pt;">Căn cứ Quyết định số 135/QĐ-ĐHSPKTVL, ngày 24/8/2017 của Hiệu trưởng trường Đại học Sư phạm Kỹ thuật Vĩnh Long về việc thành lập Trung tâm Ngoại ngữ - Tin học.</p>
<p style="text-align: justify;text-indent:1.0cm;font-size: 13pt;line-height: 1.5pt;">Căn cứ Quyết định số …/QĐ-ĐHSPKTVL-NNTH, ngày …/…/…… của Hiệu trưởng trường Đại học Sư phạm Kỹ thuật Vĩnh Long về việc thành lập Hội đồng thi và các Ban trực thuộc Hội đồng thi “Kỳ thi cấp Chứng chỉ ứng dụng Công nghệ thông tin Khóa…”;</p>
<p style="text-align: justify;text-indent:1.0cm;font-size: 13pt;line-height: 1.5pt;">
Căn cứ kết quả thi và kết quả phúc khảo của Kỳ thi cấp Chứng chỉ ứng dụng Công nghệ thông tin được tổ chức vào ngày …/..../…… tại trường Đại học Sư phạm Kỹ thuật Vĩnh Long;</p>
<p style="text-align: justify;text-indent:1.0cm;font-size: 13pt;line-height: 1.5pt;">Nay Trung tâm Tin học kính đề nghị Hiệu trưởng và Phòng Đào Tạo xét công nhận danh sách gồm … thí sinh có kết quả thi đạt yêu cầu cấp Chứng chỉ ứng dụng Công nghệ thông tin. Trong đó có … thí sịnh đạt yêu cầu cấp Chứng chỉ ứng dụng Công nghệ thông tin cơ bản và … thí sinh đạt yêu cầu cấp Chứng chỉ ứng dụng Công nghệ thông tin nâng cao (có danh sách đính kèm).</p>
<p style="text-align: justify;text-indent:1.0cm;font-size: 13pt;line-height: 1.5pt;">Rất mong nhận được sự xét duyệt của Hiệu trưởng và Phòng Đào Tạo.</p>
<p style="text-align: justify;text-indent:1.0cm;font-size: 13pt;line-height: 1.5pt;">Xin chân thành cảm ơn./.
</p>
<table style="width:100%;font-size: 13pt;">
	<tr>
		<td colspan="3" style="text-align: right;padding-right: 0.2cm;margin-bottom: 0.5cm;font-size: 13pt">Vĩnh Long, ngày ...... tháng ...... năm ......</td>
	</tr>
	<tr style="text-align: center;">
		<td><b>Hiệu trưởng</b></td>
		<td><b>Phòng Đào Tạo</b></td>
		<td><b>Giám đốc trung tâm</b></td>
	</tr>
</table>
</div>
<?php 
$stt = 1; ?>
		<br style="page-break-before: always;">
		<div style="margin: 0;box-shadow: 0;font-size: 12px;">
			<p style="text-align: center;font-size: 14pt;"><b>DANH SÁCH THÍ SINH ĐẠT YÊU CẦU<br>CẤP CHỨNG CHỈ ỨNG DỤNG CÔNG NGHỆ THÔNG TIN .................</b></p>
			<p style="text-align: center;font-size: 14pt">Khoá <?php echo $mangphong[0][2] ?>, ngày thi <?php echo date_format(date_create_from_format('Y-m-d', $mangphong[0][1]), 'd/m/Y') ?> </p>
			<p style="text-align: center;font-size: 12pt;"><i>(Kèm theo giấy đề nghị cấp Chứng chỉ ứng dụng Công nghệ thông tin (cơ bản/nâng cao) Khóa <?php echo $mangphong[0][2] ?>)</i></p>
			<table border="1" style="width: 100%;border-collapse: collapse;font-size: 16px;">
				<tr style="background-color: #d9d9d9;text-align: center;">
					<th style="width: 1.1cm;" rowspan="2">STT</th>
					<th style="width: 2.3cm;" rowspan="2">SBD</th>
					<th rowspan="2">Họ tên</th>
					<th style="width: 2.1cm;" rowspan="2">Ngày<br>sinh</th>
					<th style="width: 1.2cm;" rowspan="2">Giới<br>tính</th>
					<th style="width: 1.3cm;" rowspan="2">Nơi sinh</th>
					<th style="width: 1.9cm;" rowspan="2">MSSV</th>
					<th style="width: 1.5cm;" colspan="2">Điểm thi</th>
					<th style="width: 1.3cm;" rowspan="2">Tổng điểm</th>
				</tr>
				<tr style="background-color: #d9d9d9;text-align: center;">
					<th>LT</th>
					<th>TH</th>
				</tr>
				<?php 
				$qr = $kn->query("SELECT DISTINCT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,ds.TENDS,dh.DIEMLT,dh.DIEMTH,dh.TONGDIEM,dh.SBD,dh.IDPT,dh.IDDS FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$idds' AND !(dh.DIEMLT >= 5.0 AND dh.DIEMTH >=5.0)");
				while ($r = mysqli_fetch_assoc($qr)) { ?>
				<tr>
					<td style="text-align: center;"><?php echo $stt; ?></td>
					<td style="text-align: center;"><?php echo $r['SBD'] ?></td>
					<td style="padding-left: 0.2cm"><?php echo $r['HO']." ".$r['TEN'] ?></td>
					<td style="text-align: center;"><?php echo $r['NGAYSINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['GIOITINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['NOISINH'] ?></td>
					<td style="text-align: center;"><?php echo $r['MSSV'] ?></td>
					<td style="text-align: center;"><?php echo number_format($r['DIEMLT'],1,".",",") ?></td>
					<td style="text-align: center;"><?php echo number_format($r['DIEMTH'],1,".",",") ?></td>
					<td style="text-align: center;"><?php echo number_format($r['TONGDIEM'],1,".",",") ?></td>
				</tr>
				<?php ++$stt; } ?>
			</table>
		</div>
		<br>
		<table style="width:100%;font-size: 13pt;">
			<tr style="text-align: center;">
				<td style="width: 33.33%"><b></b></td>
				<td style="width: 33.33%"><b></b></td>
				<td style="width: 33.33%"><b>Giám đốc trung tâm</b></td>
			</tr>
		</table>
	</div>
</body>
</html>
