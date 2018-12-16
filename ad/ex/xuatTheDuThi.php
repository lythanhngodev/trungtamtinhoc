<?php 
session_start();
if (!isset($_SESSION['_checkpage'])) {echo "<h2>Đâu dễ phá vậy</2>";die();}
	include_once("../../__.php");
	if (!isset($_POST['idds']) || empty($_POST['idds'])) {
	    echo "Không tìm thấy thông tin, vui lòng thử lại!";
	    die();
	}
	$kn = new clsKetnoi();
	$idds = intval($_POST['idds']);
	$qr_l = $kn->query("SELECT TENDS FROM danhsachdangkyduthi WHERE IDDS = '$idds' LIMIT 0,1;");
	$row = mysqli_fetch_assoc($qr_l);
	$tenlop = $row['TENDS'];
	$tenfile = "The du thi $tenlop";
	$qr_k = $kn->query("SELECT kh.TENKHOA FROM danhsachdangkyduthi dk LEFT JOIN khoahoc kh ON dk.IDKH=kh.IDKH WHERE IDDS = '$idds' LIMIT 0,1;");
	$row_k = mysqli_fetch_assoc($qr_k);
	$tenkhoahoc = $row_k['TENKHOA'];
	$ngayky = $_POST['ngaythangnamky'];
	
	$ngayketqua = $_POST['ngayketquathi'];
	if (empty($ngayky)||empty($ngayketqua)) {
		echo "Chưa điền đủ thông tin!";
		die();
	}
	$mangngayky = explode('-',$ngayky);
 ?>
<html>
<head>
    <style>
    	*{
    		padding:0;
    		margin: 0;
    	}
		.khungtheduthi{
			width: 19cm;
			height: 13.3cm;
			border: 3px solid;
			float: left;
		}
		.bangtieude{
			font-size: 11pt;
			text-align: center;
			width: 100%;
			border: none;
			float: left;
			margin-top: 0.2cm;
		}
		.giua{
			text-align: center;
		}
		.mucde{
			width: 100%;
			float: left;
		}
		.hinhanh{
			width: 4cm;
			height: 6cm;
			border: 1px solid #212121;
			margin: 0 auto;
		}
		.cothinh,.cotthongtin{
			float: left;
		}
		.cothinh{
			width: 5cm;
			text-align: center;
		}
		.cotthongtin{
			width: 14cm;
			line-height: 19pt;
			margin-top:0.3cm;
		}
		.bangthongtin{
			width: 100%;
			font-size: 13pt;

		}
		.banggiothi{
			width: 13.5cm;
			border: 1px solid;
			border-collapse: collapse;
		}
		.banggiothi th, .banggiothi td{
			border: 1px solid;
			text-align: center;
		}
		.xam{
			background-color: #d9d9d9;
		}
		.xamhon{
			background-color: #bfbfbf;
		}
		.khungngaythang{
			width: 100%;
			float: left;
		}
		.ngaythang{
			text-align: right;
			padding-right: 0.5cm;
		}
		.chutich{
			text-align: right;
			padding-right: 1cm;
		}
		.khungchuy{
			width: 12cm;
			float: left;
			font-size: 12pt;
			margin-left: 0.3cm;
		}
		.noidungchuy{
			font-size: 11pt;
			padding-left: 0.5cm;
			text-align: justify;
		}
		.cach{
			width: 100%;
			float: left;
			height: 0.4cm;
		}

    </style>
</head>
<body>
<?php 
$qr_ds = $kn->query("
SELECT DISTINCT dh.SBD,CONCAT(hv.IDHV,hv.HO,' ',hv.TEN) AS HOTEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,hv.SDT,hv.MASOBIENLAI,hv.NGAYGHIBIENLAI,hv.GHICHU,ds.TENTHUCTE,ds.TENGOINHO,ds.GIOLT,ds.GIOTH,ds.NGAYTHI,dst.TUNGAY,dst.DENNGAY,kh.TENKHOA 
FROM danhsachdangkyduthi_hocvien dh 
	LEFT JOIn danhsachdangkyduthi dst ON dh.IDDS=dst.IDDS
	LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV 
	LEFT JOIN danhsachphongthi ds ON dh.IDPT=ds.IDPT
	LEFT JOIN khoahoc kh ON dst.IDKH=kh.IDKH  
WHERE dh.IDDS='$idds'
;"); $stt=1;
while ($row = mysqli_fetch_assoc($qr_ds)) { ?>
	<?php if (1) {
		echo "<div style='page-break-before:auto'>&nbsp;</div>";
	} ?>
	<div class="khungtheduthi">
		<table class="bangtieude">
			<tr>
				<td>TRƯỜNG ĐẠI HỌC SƯ PHẠM KỸ THUẬT VĨNH LONG</td>
				<td>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
			</tr>
			<tr>
				<th><u>TRUNG TÂM TIN HỌC</u></th>
				<td><u>Độc lập – Tự do – Hạnh phúc</u></td>
			</tr>
		</table>
		<div class="mucde">
			<h2 class="giua">THẺ DỰ THI</h2>
			<h4 class="giua">KỲ THI CẤP CHỨNG CHỈ ỨNG DỤNG CÔNG NGHỆ THÔNG TIN CƠ BẢN</h4>
			
			<?php 
			if ($row['TUNGAY'] != $row['DENNGAY']) {?>
			<h4 class="giua"><i>Khóa <?php echo $row['TENKHOA'] ?>, ngày thi từ <?php echo $row['TUNGAY'] ?> đến <?php echo $row['DENNGAY'] ?></i></h4>
			<?php } else{
			 ?>
			 <h4 class="giua"><i>Khóa <?php echo $row['TENKHOA'] ?>, ngày <?php echo $row['TUNGAY'] ?></i></h4>
			<?php } ?>
		</div>
		<div class="cothinh">
			<div class="hinhanh">
				<div style="padding-top: 2.5cm;">Ảnh<br>4x6</div>
			</div>
		</div>
		<div class="cotthongtin">
			<table class="bangthongtin">
				<tr>
					<td>Số báo danh: <b><?php echo $row['SBD'] ?></b></td>
					<td>Số CMND: <b><?php echo $row['CMND'] ?></b></td>
				</tr>
				<tr>
					<td colspan="2">Họ tên: <b><?php echo $row['HOTEN'] ?></b></td>
				</tr>
				<tr>
					<td>Ngày sinh: <b><?php echo $row['NGAYSINH'] ?></b></td>
					<td>Giới tính: <b><?php echo $row['GIOITINH'] ?></b></td>
				</tr>
				<tr>
					<td colspan="2">Nơi sinh: <b><?php echo $row['NOISINH'] ?></b></td>
				</tr>
				<tr>
					<td colspan="2">Tên chứng chỉ: <b>Ứng dụng Công nghệ thông tin cơ bản</b></td>
				</tr>
				<tr>
					<td colspan="2">
						<table class="banggiothi" border="1">
							<tr class="xam">
								<th class="xamhon">Thông tin thi</th>
								<th>Thời gian thi</th>
								<th>Phòng thi</th>
							</tr>
							<tr>
								<th class="xam">Lý thuyết</th>
								<td><?php echo $row['GIOLT'] ?>, ngày <?php echo $row['NGAYTHI'] ?></td>
								<td>Phòng <?php echo $row['TENGOINHO'] ?> (<?php echo $row['TENTHUCTE'] ?>)</td>
							</tr>
							<tr>
								<th class="xam">Thực hành</th>
								<td><?php echo $row['GIOTH'] ?>, ngày <?php echo $row['NGAYTHI'] ?></td>
								<td>Phòng <?php echo $row['TENGOINHO'] ?> (<?php echo $row['TENTHUCTE'] ?>)</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<div class="khungngaythang">
			<p class="ngaythang"><i>Vĩnh Long, ngày <?php echo $mangngayky[2] ?> tháng <?php echo $mangngayky[1] ?> năm <?php echo $mangngayky[0] ?></i></p>
			<p class="chutich"><b>CHỦ TỊCH HỘI ĐỒNG THI</b></p>
		</div>
		<div class="khungchuy">
			<p><i><b>Chú ý:</b></i></p>
			<p class="noidungchuy"><i>-&ensp;&ensp;Thí sinh có mặt tại phòng thi 30 phút trước khi thời gian thi bắt đầu, khi đi thi mang theo giấy CMND hoặc giấy tờ khác có kèm ảnh.</i></p>
			<p class="noidungchuy"><i>-&ensp;&ensp;Kết quả thi có sau ngày <?php echo date_format(date_create_from_format('Y-m-d', $ngayketqua), 'd/m/Y') ?>.</i></p>
			<p class="noidungchuy"><i>-&ensp;&ensp;Chứng chỉ Ứng dụng Công nghệ thông tin cơ bản có sau 90 ngày kể từ ngày thi và nhận tại phòng Đào tạo của Trường (mang theo thẻ dự thi khi nhận chứng chỉ). </i></p>
		</div>
	</div>
<?php 
++$stt;
} ?>
</body>
<script type="text/javascript">
	window.print();
	window.close();
</script>
</html>