<?php require_once '_xl_.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VLUTE CI - Trang thông tin đào tạo tin học Đại học Sư phạm Kỹ thuật Vĩnh Long</title>
  <meta name="description" content="VLUTE CI - Quản lý thông tin đào tạo tin học Đại học Sư phạm Kỹ thuật Vĩnh Long">
  <?php require_once 'header.php'; ?>
</head>
<body class="sidebar-mini skin-yellow-light">
<div class="wrapper">
  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a class="logo" href="/">
        <span class="logo-mini"><img src="/lab/i/vlute_icon36.png" /></span>
        <span class="logo-lg"><img src="/lab/i/vlute_icon36.png" /> <b>VLUTE CI</b></span>
    </a>
    <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="./ad">Đăng nhập</a>
                        </li>
                    </ul>
                </div>
            </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
            <a href="/">
                <i class="fa fa-bullhorn"></i> <span>Thông báo từ trung tâm</span>
            </a>
        </li>
        <li class=" treeview">
          <a href="#"><i class="fa fa-search"></i> <span>Tra cứu thông tin</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="LichThi.php"><i class="fa fa-calendar"></i> Lịch thi HV</a></li>
            <li><a href="DiemThi.php"><i class="fa fa-graduation-cap"></i> Điểm thi</a></li>
            <li><a href="TraCuuVanBang.php"><i class="fa fa-graduation-cap"></i> Tra cứu văn bằng</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-3 col-sm-2 col-lg-3"></div>
          <div class="form-group col-md-6 col-sm-8 col-lg-6">
              <div class="input-group">
                  <input id="tukhoa" name="tukhoa" type="text" class="form-control" placeholder="Từ khóa tìm kiếm ...">
                  <div class="input-group-btn">
                      <button class="btn btn-success" id="xemdiem"><i class="fa fa-search"></i> Tra cứu</button>
                  </div>
              </div>
          </div>
          <div class="col-md-3 col-sm-2 col-lg-3"></div>
        </div>

        <div class="row" id="khungthongbao"></div>
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
<?php require_once 'footer.php'; ?>
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<div id="xemhinh" style="position: fixed;top: 0;left: 0;right: 0;width: 100%;height: 100%;background-color: #212121;z-index: 99999999999;display: none;">
  <div style="position: fixed;top: 0;right: 0;" id="donghinh"><i class="fa fa-times" style="font-size: 18pt;border-radius: 35px;color: #fff;padding: 5px 7px;"></i></div>
  <div class="cthinh" style="width: 100%;float: left;text-align: center;">
  </div>
  <div style="margin: 0.22rem;position: fixed;bottom: 0;width: 100%;">
    <ul id="danhsachhinh" style="overflow-x: scroll;user-select: none;"></ul>
  </div>
</div>
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="/lte/bower_components/jquery/dist/jquery.min.js?v=<?php echo time(); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/lte/bower_components/bootstrap/dist/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
<!-- AdminLTE App -->
<script src="/lte/dist/js/adminlte.min.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript" src="/lab/js/jquery-ui.min.js" defer="defer"></script>
<link rel="stylesheet" type="text/css" href="/lab/css/jquery-ui.min.css">
 <script type="text/javascript">
function showhinh(_h){
  var width=$(window).width(),height=$(window).height();
  var pic_real_width;
  var pic_real_height;
  var tmpImg = new Image();
  tmpImg.src=_h; //or  document.images[i].src;
  pic_real_width=tmpImg.width;
  pic_real_height=tmpImg.height;
  $('.cthinh').html("<img src='"+_h+"'>");
  $('#xemhinh').show(200);
  // trường hợp 1
  // màn hình ngang // hình show dọc
  if ((width>height)&&(pic_real_height>=pic_real_width)) {
    $('.cthinh img').css('height',height+'px');
  }else
  // màn hình ngang // hình show ngang
  if ((width>height)&&(pic_real_height<pic_real_width)) {
    if (pic_real_width-pic_real_height <=400) {
      $('.cthinh img').css('width','55%');
    }
      else
    $('.cthinh img').css('width','60%');
  }else
  // màn hình dọc // hình dọc
  if ((width<height)&&(pic_real_height>=pic_real_width)) {
    $('.cthinh img').css('width',width+'px');
    $('.cthinh img').css('margin-top',(($(window).height()-$('.cthinh img').height())/2)+'px');
  }
  // màn hình dọc // hình ngang
  else{
    $('.cthinh img').css('width',width+'px');
    $('.cthinh img').css('margin-top',(($(window).height()-$('.cthinh img').height())/2)+'px');
  }
}
$(document).on('click','.hinhcon',function(){
  var _t = $(this);
  var _mh = [];
  _t.parent('a').parent('div').find('.hinhcon').each(function(){
    _mh.push(encodeURI($(this).attr('data')));
  });
   $('#danhsachhinh').empty();
  $.each(_mh,function(){
    $('#danhsachhinh').append("<a><div class=\"hinhconct\" style=\"background-image:url('"+this+"')\" data=\""+this+"\"></div></a>");
  });
  showhinh(_t.attr('data'));
  
});
$(document).on('click','.hinhconct',function(){
  showhinh($(this).attr('data'));
});
$(document).ready(function(){
  $( "#tukhoa" ).autocomplete({
      source: function( request, response ) {
          $.ajax({
              dataType: "json",
              type : 'POST',
              url: 'api/ajTimthongbao.php',
              data: {key:$('#tukhoa').val()},
              success: function(data) {
                  $('#tukhoa').removeClass('ui-autocomplete-loading');  
                  response( $.map( data, function(item) {
                    return {
                        label: item.TENTB,
                        value: item.TENTB
                    }
                  }));
              },
              error: function(data) {
                  $('#tukhoa').removeClass('ui-autocomplete-loading');  
              }
          });
      },
      minLength: 3,
      select: function (event, ui) {}
  });
  $.ajax({
    url: 'api/ajLay8ThongBao.php',
    success: function (data) {
      $('#khungthongbao').append(data);
    },
    error: function(){
      tbdanger('Không thể tải thông báo');
    }
  });
});
$(document).keyup(function(e) {
     if (e.key === "Escape") { // escape key maps to keycode `27`
        $('#xemhinh').hide(150);
    }
});
$(document).on('click','#donghinh',function(e) {
        $('#xemhinh').hide(150);
});
 </script>
 <script type="text/javascript">(function(){var t;(t=jQuery).bootstrapGrowl=function(s,e){var a,o,l;switch(e=t.extend({},t.bootstrapGrowl.default_options,e),(a=t("<div>")).attr("class","bootstrap-growl alert"),e.type&&a.addClass("alert-"+e.type),e.allow_dismiss&&(a.addClass("alert-dismissible"),a.append('<button  class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&#215;</span><span class="sr-only">Close</span></button>')),a.append(s),e.top_offset&&(e.offset={from:"top",amount:e.top_offset}),l=e.offset.amount,t(".bootstrap-growl").each(function(){return l=Math.max(l,parseInt(t(this).css(e.offset.from))+t(this).outerHeight()+e.stackup_spacing)}),(o={position:"body"===e.ele?"fixed":"absolute",margin:0,"z-index":"9999",display:"none"})[e.offset.from]=l+"px",a.css(o),"auto"!==e.width&&a.css("width",e.width+"px"),t(e.ele).append(a),e.align){case"center":a.css({left:"50%","margin-left":"-"+a.outerWidth()/2+"px"});break;case"left":a.css("left","20px");break;default:a.css("right","20px")}return a.fadeIn(),e.delay>0&&a.delay(e.delay).fadeOut(function(){return t(this).alert("close")}),a},t.bootstrapGrowl.default_options={ele:"body",type:"info",offset:{from:"top",amount:20},align:"right",width:250,delay:4e3,allow_dismiss:!0,stackup_spacing:10}}).call(this);</script><script type="text/javascript">function tbinfo(mess){$.bootstrapGrowl('<i class="fa fa-spinner fa-spin"></i>  '+mess, {type: 'info',delay: 2000});}function tbsuccess(mess){$.bootstrapGrowl('<i class="fa fa-check"></i>  '+mess, {type: 'success',delay: 2000});}function tbdanger(mess){$.bootstrapGrowl('<i class="fa fa-times"></i>  '+mess, {type: 'danger',delay: 2000});}function tban(){$('.bootstrap-growl').remove();}</script>
  <script type="text/javascript">var __ltn_ = document.createElement('link');__ltn_.rel = 'stylesheet';__ltn_.href = 'lte/bower_components/font-awesome/css/font-awesome.min.css';__ltn_.type = 'text/css';var __gl = document.getElementsByTagName('link')[0];__gl.parentNode.insertBefore(__ltn_, __gl);</script>
</body>
</html>