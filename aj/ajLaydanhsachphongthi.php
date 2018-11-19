<?php 
#sleep(1);
if (!isset($_POST['danhsach']) || empty($_POST['danhsach']) || !isset($_POST['tong']) || empty($_POST['tong'])) {
	echo "";
	die();
}
require_once '../__.php';
$kn = new clsKetnoi();
$danhsach = intval($_POST['danhsach']);
$tong = intval($_POST['tong']);
$tenkhoa = '';
$qr_ds = $kn->query("SELECT IDDS,TENGOINHO,TENTHUCTE,NGAYTHI FROM danhsachphongthi WHERE IDDS = '$danhsach'");
$stt = mysqli_num_rows($qr_ds);
$so=1;
if ($stt==0) {
    for($i=0;$i<$tong;$i++){ ?>
        <tr><td><input type='text' class='form-control text-center' name="ao[]" value="<?php echo $so; ?>" required="required" readonly="readonly" /></td><td><input type='text' class='form-control' name="thuc[]" required="required" /></td><td><input type='date' class='form-control' name="ngaythi[]" required="required" /></td></tr>
<?php ++$so;}
    die();
}
$so=1;
while ($row = mysqli_fetch_assoc($qr_ds)) { ?>
<tr>
    <td><input type='text' class='form-control text-center' value='<?php echo $row['TENGOINHO']; ?>' name="ao[]" required="required" readonly="readonly" /></td>
    <td><input type='text' class='form-control' value='<?php echo $row['TENTHUCTE']; ?>' name="thuc[]" required="required" /></td>
    <td><input type='date' class='form-control' name="ngaythi[]" required="required" value="<?php echo $row['NGAYTHI']; ?>" /></td>
</tr>
<?php  }die(); ?>
