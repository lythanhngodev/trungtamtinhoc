<?php require_once "__.php";
function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/( )+/s',         // shorten multiple whitespace sequences
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
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>PHẦN MỀM QUẢN LÝ TRUNG TÂM TIN HỌC - VLUTE</title>
    <base href="<?php echo $ttth['HOST']; ?>">
    <link rel="stylesheet" href="./lab/css/bootstrap.min.css">
    <link rel="stylesheet" href="./lab/css/style.css">
    <script type="text/javascript" src="./lab/js/jquery-3.3.1.min.js"></script>
    <script async="async" type="text/javascript" src="./lab/js/fontawesome-all.min.js"></script>
<?php 
session_start();
$_SESSION['_token'] = _token(256);
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
	            <li class="nav-item" id="trangchu">
	                <a class="nav-link" href="#">Trang chủ</a>
	            </li>
	            <li class="nav-item" id="khoahoc">
	                <a class="nav-link" href="?p=khoahoc">Khoá học</a>
	            </li>
                <li class="nav-item" id="lophoc">
                    <a class="nav-link" href="?p=lophoc">Lớp học</a>
                </li>
                <li class="nav-item dropdown" id="hocvien">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Học viên
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="hocvien1" href="?p=hocvien">Học viên</a>
                        <a class="dropdown-item" id="nhaphocvien" href="?p=nhaphocvien">Nhập học viên từ Excel</a>
                    </div>
                </li>
                <li class="nav-item dropdown" id="tochucthi">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tổ chức thi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="danhsachcacdotthi" href="?p=danhsachcacdotthi">Danh sách các đợt thi</a>
                        <a class="dropdown-item" id="thisinhdangkyduthi" href="?p=thisinhdangkyduthi">Lập DS thí sinh đăng ký dự thi</a>
                        <a class="dropdown-item" id="thisinhphongthi" href="?p=thisinhphongthi">Quản lý phòng thi</a>
                        <a class="dropdown-item" href="#">DS đề nghị cấp chứng chỉ</a>
                        <a class="dropdown-item" href="#">DS nộp lệ phí cấp chứng chỉ</a>

                    </div>
                </li>
                <li class="nav-item dropdown" id="ketqua">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kết quả
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="diem" href="?p=diem">Kết quả thi</a>

                    </div>
                </li>
                <li class="nav-item dropdown" id="capchungchi">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Cấp chứng chỉ
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">DS đề nghị cấp chứng chỉ</a>
                        <a class="dropdown-item" href="#">DS nộp lệ phí cấp chứng chỉ</a>
                    </div>
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
				default:
					require './c/c.trangchu.php';
					break;
			}
		}else{
                require './c/c.trangchu.php';
            }
         ?>
	</div>
</body>
<script type="text/javascript">(function(){var t;(t=jQuery).bootstrapGrowl=function(s,e){var a,o,l;switch(e=t.extend({},t.bootstrapGrowl.default_options,e),(a=t("<div>")).attr("class","bootstrap-growl alert"),e.type&&a.addClass("alert-"+e.type),e.allow_dismiss&&(a.addClass("alert-dismissible"),a.append('<button  class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&#215;</span><span class="sr-only">Close</span></button>')),a.append(s),e.top_offset&&(e.offset={from:"top",amount:e.top_offset}),l=e.offset.amount,t(".bootstrap-growl").each(function(){return l=Math.max(l,parseInt(t(this).css(e.offset.from))+t(this).outerHeight()+e.stackup_spacing)}),(o={position:"body"===e.ele?"fixed":"absolute",margin:0,"z-index":"9999",display:"none"})[e.offset.from]=l+"px",a.css(o),"auto"!==e.width&&a.css("width",e.width+"px"),t(e.ele).append(a),e.align){case"center":a.css({left:"50%","margin-left":"-"+a.outerWidth()/2+"px"});break;case"left":a.css("left","20px");break;default:a.css("right","20px")}return a.fadeIn(),e.delay>0&&a.delay(e.delay).fadeOut(function(){return t(this).alert("close")}),a},t.bootstrapGrowl.default_options={ele:"body",type:"info",offset:{from:"top",amount:20},align:"right",width:250,delay:4e3,allow_dismiss:!0,stackup_spacing:10}}).call(this);</script><script type="text/javascript">function tbinfo(mess){$.bootstrapGrowl('<i class="fa fa-spinner fa-spin"></i>  '+mess, {type: 'info',delay: 2000});}function tbsuccess(mess){$.bootstrapGrowl('<i class="fa fa-check"></i>  '+mess, {type: 'success',delay: 2000});}function tbdanger(mess){$.bootstrapGrowl('<i class="fa fa-times"></i>  '+mess, {type: 'danger',delay: 2000});}function tban(){$('.bootstrap-growl').remove();}</script>
</html>