<?php require_once "__.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Trang quản trị | Quản lý điểm Đại học Sư phạm Kỹ thuật Vĩnh Long</title>
    <base href="<?php echo $ttth['HOST']; ?>">
    <link rel="stylesheet" href="./lab/css/bootstrap.min.css">
    <link rel="stylesheet" href="./lab/css/style.css">
    <script type="text/javascript" src="./lab/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./lab/js/fontawesome-all.min.js"></script>
</head>
<body>
	<!-- MENU -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                <li class="nav-item" id="hocvien">
                    <a class="nav-link" href="?p=hocvien">Học viên</a>
                </li>
                <li class="nav-item" id="tochucthi">
                    <a class="nav-link" href="#">Tổ chức thi</a>
                </li>
                <li class="nav-item" id="ketqua">
                    <a class="nav-link" href="#">Kết quả</a>
                </li>
                <li class="nav-item dropdown" id="taikhoan">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tài khoản
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Thông tin tài khoản</a>
                        <a class="dropdown-item" href="#">Đổi mật khẩu</a>
                        <a class="dropdown-item" href="#">Đăng xuất</a>
                    </div>
                </li>
	            <li class="nav-item active" style="float: right;position:  absolute;right: 0;">
	                <a class="nav-link" href="#">Xin chào: <?php echo "Lý"; ?></a>
	            </li>
	        </ul>
	    </div>
	</nav>
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
				default:
					# code...
					break;
			}
		} ?>
	</div>
</body>
<script type="text/javascript">
(function(){var c;c=jQuery;c.bootstrapGrowl=function(f,a){var b,e,d;a=c.extend({},c.bootstrapGrowl.default_options,a);b=c("<div>");b.attr("class","bootstrap-growl alert");a.type&&b.addClass("alert-"+a.type);a.allow_dismiss&&(b.addClass("alert-dismissible"),b.append('<button class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&#215;</span><span class="sr-only">Close</span></button>'));b.append(f);a.top_offset&&(a.offset={from:"top",amount:a.top_offset});d=a.offset.amount;c(".bootstrap-growl").each(function(){return d= Math.max(d,parseInt(c(this).css(a.offset.from))+c(this).outerHeight()+a.stackup_spacing)});e={position:"body"===a.ele?"fixed":"absolute",margin:0,"z-index":"9999",display:"none"};e[a.offset.from]=d+"px";b.css(e);"auto"!==a.width&&b.css("width",a.width+"px");c(a.ele).append(b);switch(a.align){case "center":b.css({left:"50%","margin-left":"-"+b.outerWidth()/2+"px"});break;case "left":b.css("left","20px");break;default:b.css("right","20px")}b.fadeIn();0<a.delay&&b.delay(a.delay).fadeOut();};c.bootstrapGrowl.default_options={ele:"body",type:"info",offset:{from:"top",amount:20},align:"right",width:250,delay:4E3,allow_dismiss:!0,stackup_spacing:10}}).call(this);</script>
<script type="text/javascript">
    function tbinfo(mess){
        $.bootstrapGrowl('<i class="fa fa-spinner fa-spin"></i>  '+mess, {
            type: 'info',
            delay: 2000
        });
    }
    function tbsuccess(mess){
        $.bootstrapGrowl('<i class="fa fa-check"></i>  '+mess, {
            type: 'success',
            delay: 2000
        });
    }
    function tbdanger(mess){
        $.bootstrapGrowl('<i class="fa fa-close"></i>  '+mess, {
            type: 'danger',
            delay: 2000
        });
    }
</script>

</html>