<?php 
	sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
	require_once "../../__.php";

	if (isset($_POST['khoahoc']) && !empty($_POST['khoahoc'])) {
		$kn = new clsKetnoi();
		$khoahoc = mysqli_real_escape_string($kn->conn,$_POST['khoahoc']);
		$batdau = mysqli_real_escape_string($kn->conn,$_POST['batdau']);
		$ketthuc = mysqli_real_escape_string($kn->conn,$_POST['ketthuc']);
		$kiemtra = $kn->adddata("INSERT INTO khoahoc (TENKHOA,TGBATDAU,TGKETTHUC) VALUES ('$khoahoc','$batdau','$ketthuc');");
		$khoc = $kn->query("SELECT * FROM khoahoc WHERE HOANTHANH=b'0' ORDER BY IDKH DESC;");
		$option = "<label><b>Chọn khoá học</b></label><select class='form-control' id='chonkhoahoc'><option value='0'>--- Chọn khoá học ---</option><option value='taokhoahoc'>++ Tạo nhanh khóa mới ++</option>";
		while ($row = mysqli_fetch_assoc($khoc)) {
			$option.="<option value='".$row['IDKH']."'>".$row['TENKHOA']."</option>";
		}
		echo $option."</select>";
		if ($kiemtra>0) { ?>
			<script type="text/javascript">tbsuccess('Đã thêm khoá học');$('#modalthemkhoahoc').modal('hide');$('#chonkhoahoc').select2({width: '100%'});</script>
		<?php }
		else{ ?>
			<script type="text/javascript">tbdanger('Chưa thêm khoá học, kiểm tra lại');</script>
		<?php }
	}
 ?>