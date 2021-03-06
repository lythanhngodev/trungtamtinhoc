<?php require_once "../__.php";
function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/( )+/s',         // shorten multiple whitespace sequences
        '/(\n)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );
    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}
ob_start("sanitize_output");
require_once '_ckl.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>PHẦN MỀM QUẢN LÝ TRUNG TÂM TIN HỌC - VLUTE</title>
    <?php
    /*try {
      header("X-Frame-Options: DENY");
      header("Content-Security-Policy: frame-ancestors 'none'", false);
    } catch (Exception $e) {
        
    }*/
     ?>
    <base href="<?php echo $ttth['HOST']."/ad/"; ?>">
    <link rel="shortcut icon" href="../lab/i/favicon.ico" />
    <link rel="stylesheet" href="../lab/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lab/css/style.css">
    <script type="text/javascript" src="../lab/js/jquery-3.3.1.min.js"></script>
    <script async="async" type="text/javascript" src="../lab/js/fontawesome-all.min.js" defer="defer"></script>
    <style type="text/css">*{user-select: none;}</style>
<?php 
$_SESSION['_token'] = _token(256);
$checkpage = $_SESSION['_token'];
$_SESSION['_checkpage'] = $_SESSION['_token'];
$xacthuc = _token(234);
 ?>
</head>
<body>
	<!-- MENU -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #563d7c !important;">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand" href="#">
              <img src="./ex/logo.png" width="30" height="30">
            </a>
	        <ul class="navbar-nav mr-auto">
	            <li class="nav-item" id="khoahoc">
	                <a class="nav-link" href="?p=khoahoc&_token=<?php echo $xacthuc ?>">Khoá học</a>
	            </li>
                <li class="nav-item" id="lophoc">
                    <a class="nav-link" href="?p=lophoc&_token=<?php echo $xacthuc ?>">Lớp học</a>
                </li>
                <li class="nav-item dropdown" id="hocvien">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Học viên
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="hocvien1" href="?p=hocvien&_token=<?php echo $xacthuc ?>">Học viên</a>
                        <a class="dropdown-item" id="nhaphocvien" href="?p=nhaphocvien&_token=<?php echo $xacthuc ?>">Nhập học viên từ Excel</a>
                    </div>
                </li>
                <li class="nav-item dropdown" id="lephi">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Lệ phí
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="lephihoc" href="?p=lephihoc&_token=<?php echo $xacthuc ?>">Lệ phí học</a>
                        <a class="dropdown-item" id="lephithi" href="?p=lephithi&_token=<?php echo $xacthuc ?>">Lệ phí thi</a>
                    </div>
                </li>
                <li class="nav-item" id="phanconggiangday">
                    <a class="nav-link" href="?p=phanconggiangday&_token=<?php echo $xacthuc ?>">PC giảng dạy</a>
                </li>
                <li class="nav-item dropdown" id="tochucthi">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tổ chức thi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="danhsachcacdotthi" href="?p=danhsachcacdotthi&_token=<?php echo $xacthuc ?>">Danh sách các đợt thi</a>
                        <a class="dropdown-item" id="thisinhdangkyduthi" href="?p=thisinhdangkyduthi&_token=<?php echo $xacthuc ?>">Lập DS thí sinh đăng ký dự thi</a>
                        <a class="dropdown-item" id="thisinhphongthi" href="?p=thisinhphongthi&_token=<?php echo $xacthuc ?>">Quản lý phòng thi</a>
                        <a class="dropdown-item" id="danhsobaodanh" href="?p=danhsobaodanh&_token=<?php echo $xacthuc ?>">Đánh số báo danh &amp; Điều chỉnh thí sinh</a>
                    </div>
                </li>
                <li class="nav-item dropdown" id="phuckhao">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Phúc khảo
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="lapdanhsachphuckhao" href="?p=lapdanhsachphuckhao&_token=<?php echo $xacthuc ?>">Lập DS phúc khảo</a>
                        <a class="dropdown-item" id="ketquaphuckhao" href="?p=ketquaphuckhao&_token=<?php echo $xacthuc ?>">Kết quả phúc khảo</a>
                    </div>
                </li>
                <li class="nav-item dropdown" id="ketqua">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kết quả
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="diem" href="?p=diem&_token=<?php echo $xacthuc ?>">Kết quả thi</a>
                        
                    </div>
                </li>
                <li class="nav-item dropdown" id="capchungchi">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Chứng chỉ
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="denghicapchungchi" href="?p=denghicapchungchi&_token=<?php echo $xacthuc ?>">DS đề nghị cấp chứng chỉ</a>
                        <a class="dropdown-item" id="nhapchungchi" href="?p=nhapchungchi&_token=<?php echo $xacthuc ?>">Nhập chứng chỉ</a>
                    </div>
                </li>
                <li class="nav-item dropdown" id="thongbao">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Thông báo
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="themthongbao" href="?p=themthongbao&_token=<?php echo $xacthuc ?>">Thêm thông báo</a>
                        <a class="dropdown-item" id="quanlythongbao" href="?p=quanlythongbao&_token=<?php echo $xacthuc ?>">Quản lý thông báo</a>
                    </div>
                </li>
                <li class="nav-item dropdown" id="taikhoan">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tài khoản
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="thongtintaikhoan" href="?p=thongtintaikhoan&_token=<?php echo $xacthuc ?>">Thông tin tài khoản</a>
                        <a class="dropdown-item" id="dangxuat" href="./lo.php?_token=<?php echo $xacthuc ?>">Đăng xuất</a>
                    </div>
                </li>
                <li class="nav-item dropdown" id="nhapkhoathicu">
                    <a class="nav-link" href="?p=nhapkhoathicu&_token=<?php echo $xacthuc ?>">
                        <span class="badge badge-warning">Nhập khóa thi cũ</span>
                    </a>
                </li>
	        </ul>
	    </div>
	</nav>
    <div class="progress" style="border-radius: 0;height: 5px;background: transparent;z-index: 999999;position: fixed;top: 0;left: 0;right: 0;">
        <div class="progress-bar" id="daluot" style="background: rgb(195, 175, 226); width: 0%;"></div>
    </div>
	<div class="container-fluid"><br>
		<?php if (isset($_GET['p']) && !empty($_GET['p'])) {
			switch ($_GET['p']) {
				case 'khoahoc':
					require './c/c.khoahoc.php';
					break;
				case 'lophoc':
                    require './c/c.lophoc.php';
                    break;
                case 'hocvien':
                    require './c/c.hocvien.php';
                    break;
                case 'nhaphocvien':
                    require './c/c.nhaphocvien.php';
                    break;
                case 'thisinhdangkyduthi':
                    require './c/c.thisinhdangkyduthi.php';
                    break;
                case 'thisinhphongthi':
                    require './c/c.thisinhphongthi.php';
                    break;
                case 'diem':
                    require './c/c.diem.php';
                    break;
                case 'danhsachcacdotthi':
                    require_once './c/c.danhsachcacdotthi.php';
                    break;
                case 'denghicapchungchi':
                    require_once './c/c.denghicapchungchi.php';
                    break;
                case 'phanconggiangday':
                    require_once './c/c.phanconggiangday.php';
                    break;
                case 'themthongbao':
                    require_once './c/c.themthongbao.php';
                    break;
                case 'quanlythongbao':
                    require_once './c/c.quanlythongbao.php';
                    break;
                case 'suathongbao':
                    require_once './c/c.suathongbao.php';
                    break;
                case 'nhapkhoathicu':
                    require_once './c/c.nhapkhoathicu.php';
                    break;
                case 'thongtintaikhoan':
                    require_once './c/c.thongtintaikhoan.php';
                    break;
                case 'nhapchungchi':
                    require_once './c/c.nhapchungchi.php';
                    break;
                case 'lephihoc':
                    require_once './c/c.lephihoc.php';
                    break;
                case 'lephithi':
                    require_once './c/c.lephithi.php';
                    break;
                case 'danhsobaodanh':
                    require_once './c/c.danhsobaodanh.php';
                    break;
                case 'lapdanhsachphuckhao':
                    require_once './c/c.lapdanhsachphuckhao.php';
                    break;
                case 'ketquaphuckhao':
                    require_once './c/c.ketquaphuckhao.php';
                    break;
                case 'phuchoi':
                    require_once './c/c.phuchoi.php';
                    break;
				default:
					require './c/c.trangchu.php';
					break;
			}
		}else{
                require './c/c.trangchu.php';
            }
         ?>
	</div>
<div style="position: fixed;margin-bottom: 0;left: 0;right:0;bottom: 0;height: 16px;width: 100%;background: #000;color: #fff;line-height: 16px;font-size: 90%;padding-left: 1rem;font-family: monospace;text-align: center;">© Copyright of Ngô Thanh Lý (FIT 2014)</div>
</body>
<script type="text/javascript">(function(){var t;(t=jQuery).bootstrapGrowl=function(s,e){var a,o,l;switch(e=t.extend({},t.bootstrapGrowl.default_options,e),(a=t("<div>")).attr("class","bootstrap-growl alert"),e.type&&a.addClass("alert-"+e.type),e.allow_dismiss&&(a.addClass("alert-dismissible"),a.append('<button  class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&#215;</span><span class="sr-only">Close</span></button>')),a.append(s),e.top_offset&&(e.offset={from:"top",amount:e.top_offset}),l=e.offset.amount,t(".bootstrap-growl").each(function(){return l=Math.max(l,parseInt(t(this).css(e.offset.from))+t(this).outerHeight()+e.stackup_spacing)}),(o={position:"body"===e.ele?"fixed":"absolute",margin:0,"z-index":"9999",display:"none"})[e.offset.from]=l+"px",a.css(o),"auto"!==e.width&&a.css("width",e.width+"px"),t(e.ele).append(a),e.align){case"center":a.css({left:"50%","margin-left":"-"+a.outerWidth()/2+"px"});break;case"left":a.css("left","20px");break;default:a.css("right","20px")}return a.fadeIn(),e.delay>0&&a.delay(e.delay).fadeOut(function(){return t(this).alert("close")}),a},t.bootstrapGrowl.default_options={ele:"body",type:"info",offset:{from:"top",amount:20},align:"right",width:250,delay:4e3,allow_dismiss:!0,stackup_spacing:10}}).call(this);</script><script type="text/javascript">function tbinfo(mess){$.bootstrapGrowl('<i class="fa fa-spinner fa-spin"></i>  '+mess, {type: 'info',delay: 6000});}function tbsuccess(mess){$.bootstrapGrowl('<i class="fa fa-check"></i>  '+mess, {type: 'success',delay: 3000});}function tbdanger(mess){$.bootstrapGrowl('<i class="fa fa-times"></i>  '+mess, {type: 'danger',delay: 3000});}function tban(){$('.bootstrap-growl').remove();}</script>
</html>

