<?php 
	sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
	require_once "../../__.php";
	if (isset($_POST['tendot']) && !empty($_POST['tendot'])) {
		$kn = new clsKetnoi();
		$tendot = mysqli_real_escape_string($kn->conn,$_POST['tendot']);
		$batdau = mysqli_real_escape_string($kn->conn,$_POST['batdau']);
		$ketthuc = mysqli_real_escape_string($kn->conn,$_POST['ketthuc']);
		$khoahoc = mysqli_real_escape_string($kn->conn,$_POST['khoahoc']);
		$loaithi = mysqli_real_escape_string($kn->conn,$_POST['loaithi']);
		$kiemtra = $kn->adddata("INSERT INTO danhsachdangkyduthi (TENDS,TUNGAY,DENNGAY,IDKH,LOAITHI) VALUES ('$tendot','$batdau','$ketthuc','$khoahoc','$loaithi');");
		$khoc = $kn->query("SELECT * FROM danhsachdangkyduthi ORDER BY IDDS DESC;");
		$option = "<label><b>Chọn danh sách</b></label><select class='form-control' id='chondanhsach'><option value='0'>--- Chọn khoá học ---</option><option value='taodotthi'>++ Tạo mới đợt thi ++</option>";
		while ($row = mysqli_fetch_assoc($khoc)) {
			$option.="<option value='".$row['IDDS']."'>".$row['TENDS'].' - '.$row['LOAITHI']."</option>";
		}
		echo $option."</select>";
		if ($kiemtra>0) { ?>
			<script type="text/javascript">tbsuccess('Đã tạo danh sách');$('#modaltaodotthi').modal('hide');$('#chondanhsach').select2({width: '100%'});</script>
		<?php }
		else{ ?>
			<script type="text/javascript">tbdanger('Chưa tạo danh sách, kiểm tra lại');</script>
		<?php }
	}
 ?>