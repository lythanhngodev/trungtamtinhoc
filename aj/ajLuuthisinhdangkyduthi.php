<?php 
sleep(1);
if (!isset($_POST['bhv']) || empty($_POST['bhv']) || !isset($_POST['tendanhsach']) || empty($_POST['tendanhsach'])) { ?>
<script type="text/javascript">tbdanger('Có lỗi trong quá trình xử lý, vui lòng thử lại!');</script>
<?php die(); }
require_once '../__.php';
$kn = new clsKetnoi();
$tendanhsach = $_POST['tendanhsach'];
$tendanhsach = mysqli_real_escape_string($kn->conn,$tendanhsach);
$bhv = $_POST['bhv'];
$khoahoc = $_POST['khoahoc'];
$tenkh = intval($_POST['tenkh']);
$tg = time();
$them_danhsach = $kn->adddata("INSERT INTO danhsachdangkyduthi(TENDS,TG,IDKH) VALUES ('$tendanhsach','$tg','$khoahoc');");
$query = $kn->query("SELECT IDDS FROM danhsachdangkyduthi WHERE TENDS='$tendanhsach' AND TG = '$tg' LIMIT 0,1");
$rs = mysqli_fetch_assoc($query);
$idds = $rs['IDDS'];
$dem=0;
$stt = 1;
for ($i=0; $i < count($bhv); $i++) { 
    if ($kn->tontai("SELECT * FROM danhsachdangkyduthi_hocvien WHERE IDDS='$idds' AND IDHV='".$bhv[$i][0]."';"))
        $dem++;
    else{
    	// xử lý số báo danh
    	$skhoa = "K"; // thieu 3
    	switch (strlen($tenkh)) {
    		case 1:
    			$skhoa.="00".$tenkh;
    			break;
    		case 2:
    			$skhoa.="0".$tenkh;
    			break;
    		default:
    			$skhoa.=$tenkh;
    			break;
    	}
    	$sso = "CB"; // thieu 3
    	switch (strlen($stt)) {
    		case 1:
    			$sso.="00".$stt;
    			break;
    		case 2:
    			$sso.="0".$stt;
    			break;
    		default:
    			$sso.=$stt;
    			break;
    	}
    	$sbd = $skhoa.$sso;
        $hoi="INSERT INTO danhsachdangkyduthi_hocvien(IDDS,IDHV,SBD) VALUES ('$idds','".$bhv[$i][0]."','$sbd');";
        if (mysqli_query($kn->conn,$hoi)===TRUE){
            $dem++;$stt++;
        }
    }
}
if ($dem>0) { ?>

<script type="text/javascript">
    $('.khungbtn').empty();
    $('.khungbtn').html("<a class='btn btn-warning xuatthongtin' href='./ex/xuatthisinhdangkyduthi.php?idds=<?php echo $idds ?>' target='_blank'><i class='fas fa-file-word'></i> Xuất danh sách</a>");
</script>
<?php 
die();}
?>
