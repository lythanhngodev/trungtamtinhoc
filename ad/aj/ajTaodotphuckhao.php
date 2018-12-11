<?php 
	sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
	require_once "../../__.php";
	if (isset($_POST['tendot']) && !empty($_POST['tendot'])) {
		$kn = new clsKetnoi();
		$tendot = mysqli_real_escape_string($kn->conn,$_POST['tendot']);
		$dotthi = intval($_POST['dotthi']);
		$kiemtra = $kn->adddata("INSERT INTO danhsachphuckhao (TENPK,IDDS) VALUES ('$tendot','$dotthi');");
		$dotphuckhao = $kn->query("SELECT pk.IDPK,pk.TENPK,ds.LOAITHI FROM danhsachphuckhao pk LEFT JOIN danhsachdangkyduthi ds ON pk.IDDS=ds.IDDS ORDER BY IDPK DESC;");
		$option = "<label><b>Đợt phúc khảo</b></label><select class='form-control' id='chondanhsach'><option value='0'>--- Chọn đợt phúc khảo ---</option><option value='taodotthi'>++ Tạo đợt phúc khảo ++</option>";
		while ($row = mysqli_fetch_assoc($dotphuckhao)) {
			$option.="<option value='".$row['IDPK']."'>".$row['TENPK'].' - '.$row['LOAITHI']."</option>";
		}
		echo $option."</select>";
		if ($kiemtra>0) { ?>
			<script type="text/javascript">tbsuccess('Đã tạo danh sách phúc khảo');$('#modaltaophuckhao').modal('hide');$('#chondanhsach').select2({width: '100%'});</script>
		<?php }
		else{ ?>
			<script type="text/javascript">tbdanger('Chưa tạo được, kiểm tra lại');</script>
		<?php }
	}
 ?>