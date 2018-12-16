<?php 
#sleep(1);
session_start();
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
if (!isset($_POST['danhsach']) || empty($_POST['danhsach']) || !isset($_POST['tong']) || empty($_POST['tong'])) {
	echo "";
	die();
}
require_once '../../__.php';
$kn = new clsKetnoi();
$danhsach = intval($_POST['danhsach']);
$tong = intval($_POST['tong']);
$tenkhoa = '';
$qr_ds = $kn->query("SELECT IDDS,TENGOINHO,TENTHUCTE,NGAYTHI,GIOLT,GIOTH FROM danhsachphongthi WHERE IDDS = '$danhsach'");
$stt = mysqli_num_rows($qr_ds);
$so=1;
if ($stt==0) {
    for($i=0;$i<$tong;$i++){ ?>
        <tr>
        	<td><input type='text' class='form-control text-center' name="ao[]" value="<?php echo $so; ?>" required="required" readonly="readonly" /></td>
        	<td><input type='text' class='form-control' name="thuc[]" required="required" /></td>
        	<td><input type='text' class='form-control' name="giolt[]" /></td>
        	<td><input type='date' class='form-control' name="gioth[]" /></td>
        	<td><input type='text' class='form-control ongaythi' name="ngaythi[]" required="required" /></td>
        </tr>
<?php ++$so;}
    die();
}
$so=1;
while ($row = mysqli_fetch_assoc($qr_ds)) { ?>
<tr>
    <td><input type='text' class='form-control text-center' value='<?php echo $row['TENGOINHO']; ?>' name="ao[]" required="required" readonly="readonly" /></td>
    <td><input type='text' class='form-control' value='<?php echo $row['TENTHUCTE']; ?>' name="thuc[]" required="required" /></td>
    <td><input type='text' class='form-control' value='<?php echo $row['GIOLT']; ?>' name="giolt[]" /></td>
    <td><input type='text' class='form-control' name="gioth[]" value="<?php echo $row['GIOTH']; ?>" /></td>
    <td><input type='text' class='form-control ongaythi' name="ngaythi[]" value="<?php echo $row['NGAYTHI']; ?>"required="required" /></td>
</tr>
<?php  } ?>
<script type="text/javascript">
	$('.ongaythi').datepicker({ dateFormat: 'yy-mm-dd' });
</script>
<?php
die(); ?>
