<?php require_once '_xl_.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VLUTE CI - Center for Informatics</title>
  <meta name="description" content="VLUTE CI - Center for Informatics">
  <?php require_once 'header.php'; ?>
  <style type="text/css">#footer{display: none;}</style>
</head>
<body class="sidebar skin-yellow-light">
<div class="wrapper" id="wrapper">
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
            <li><a href="LichThi"><i class="fa fa-calendar"></i> Lịch thi HV</a></li>
            <li><a href="DiemThi"><i class="fa fa-graduation-cap"></i> Điểm thi</a></li>
            <li><a href="TraCuuVanBang"><i class="fa fa-graduation-cap"></i> Tra cứu chứng chỉ</a></li>
          </ul>
        </li>
        <li>
            <a href="/ad">
                <i class="fa fa-key"></i><span>Đăng nhập</span>
            </a>
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
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3 col-sm-2 col-lg-3"></div>
            <div class="form-group col-md-6 col-sm-8 col-lg-6">
                <span class="linknhanh"><a href="LichThi">Lịch thi</a></span>
                <span class="linknhanh"><a href="DiemThi">Điểm thi</a></span>
                <span class="linknhanh"><a href="TraCuuVanBang">Tìm chứng chỉ</a></span>
            </div>
            <div class="col-md-3 col-sm-2 col-lg-3"></div>
          </div>
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
<div id="xemhinh">
  <div style="position: fixed;top: 0;right: 0;" id="donghinh"><i class="fa fa-times" style="font-size: 18pt;border-radius: 35px;color: #212121;padding: 5px 7px;" tooltip="Đóng cửa sổ"></i></div>
  <div class="cthinh" id="hinhct" style="text-align: center;margin: 1em 0;display: table-cell;vertical-align: middle;">
    <img src="" id="hinhanhct" style="display: block;margin: 0 auto;">
  </div>
  <div style="position: fixed;bottom: 0;width: 100%;height: 85px;">
    <ul id="danhsachhinh"></ul>
  </div>
</div>
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="/lte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/lte/bower_components/bootstrap/dist/js/bootstrap.min.js" defer="defer" ></script>
<!-- AdminLTE App -->
<script src="/lte/dist/js/adminlte.min.js" defer="defer" ></script>
<script type="text/javascript" src="/lab/js/jquery-ui.min.js" defer="defer"></script>
<link rel="stylesheet" type="text/css" href="/lab/css/jquery-ui.min.css">
 <script type="text/javascript">
  var sotb = 2;
document.getElementById('hinhct').style.width = window.innerWidth+'px';
document.getElementById('hinhct').style.height = window.innerHeight+'px';
document.getElementById('hinhanhct').style.maxWidth = window.innerWidth+'px';
document.getElementById('hinhanhct').style.maxHeight = window.innerHeight+'px';
function showhinh(_h){
  var width=$(window).width(),height=$(window).height();
  var pic_real_width;
  var pic_real_height;
  var tmpImg = new Image();
  tmpImg.src=_h;
  pic_real_width=tmpImg.width;
  pic_real_height=tmpImg.height;
  $('.cthinh').fadeOut(0);
  $('.cthinh img').attr('src',_h);
  $('#xemhinh,.cthinh').fadeIn(350);
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
  $(document).find('.hinhconct').each(function(){
    if (_t.attr('data')==$(this).attr('data')) {$(this).css('border','2px solid #FF9800')}
  });
});
$(document).on('click','.hinhconct',function(){
  showhinh($(this).attr('data'));
  var _t=$(this).attr('data');
  $(document).find('.hinhconct').each(function(){
    {$(this).css('border','none')}
  });
  $(document).find('.hinhconct').each(function(){
    if (_t==$(this).attr('data')) {$(this).css('border','2px solid #FF9800')}
  });
});
var clickan = false;
$(document).on('click','.cthinh',function(){
  if (!clickan) {
    $('#danhsachhinh').fadeOut(350);
    clickan=true;
  }else{
    $('#danhsachhinh').fadeIn(350);
    clickan=false;
  }
});
$(document).ready(function(){
  $( "#tukhoa" ).autocomplete({
      source: function( request, response ) {
          $.ajax({
              dataType: "json",
              type : 'POST',
              url: 'ly_api_ttb',
              data: {key:$('#tukhoa').val()},
              success: function(data) { 
                  response( $.map( data, function(item) {
                    return {
                        label: item.TENTB,
                        value: item.TENTB
                    }
                  }));
              },
              error: function(data) {
                tbdanger('Lỗi kết nối');
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
        $('#xemhinh').fadeOut(350);
    }
});
$(document).on('click','#donghinh',function(e) {
        $('#xemhinh').fadeOut(350);
});
$(window).scroll(function() {
   if($(window).scrollTop() + $(window).height() == $(document).height()) {
      $.ajax({
        url: 'api/ajLayThemThongBao.php',
        type: 'POST',
        data: {so:sotb},
        success: function (data) {
          if (!jQuery.isEmptyObject(data)) {
            $('#khungthongbao').append(data);
            ++sotb;
          }
          else{
            tbinfo('Hết thông báo');
          }
        },
        error: function(){
          tbdanger('Không thể tải thông báo');
        }
      });
   }
});
 </script>
 <?php require_once 'script.php' ?>
</body>
</html>