<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<?php 
	if (!isset($_GET['id'])) {
		echo "Không có thông tin";
		die();
	}
	require_once './m/m.suathongbao.php';
	$id = intval($_GET['id']);
	if ($id==0) {
		echo "Không có thông tin";
		die();
	}
	$thongbao = laythongbao($id);
	$tb = mysqli_fetch_assoc($thongbao);
	if (count($tb)==0) {
		echo "Không có thông tin";
		die();
	}else{
		require_once './v/v.suathongbao.php';
	}
 ?>