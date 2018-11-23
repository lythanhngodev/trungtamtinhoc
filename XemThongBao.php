<?php require_once '_xl_.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Xem thông báo - VLUTE CI</title>
  <meta name="description" content="VLUTE CI - Quản lý thông tin đào tạo tin học Đại học Sư phạm Kỹ thuật Vĩnh Long">
  <?php require_once 'header.php'; ?>
<style type="text/css">
.baicohinhanh .hinhcon{
    width: 100px;
    height: 100px;
    float: left;
    background-position: center;
    background-size: cover;
    border-radius: 10px;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    position: relative;
}
.hinhconct{
    width: 80px;
    height: 80px;
    float: left;
    background-position: center;
    background-size: cover;
    border-radius: 10px;
    margin-right: 1rem;
}
#danhsachhinh{
  padding: 0;
  margin: 0;
  white-space: nowrap;
}
#danhsachhinh a,.baicohinhanh a{
  display: inline-table;
  text-decoration: none;
  text-align: center;
}

    </style>
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
    <section class="content container-fluid">
      <section class="content-header text-center">
          <h1>
              Xem chi tiết thông báo
          </h1>
      </section>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row" id="khungthongbao">
          <div class="col-md-2 col-sm-1 col-lg-2"></div>
          <div class="col-md-8 col-sm-10 col-lg-8">
            <?php 
            if (!isset($_GET['id'])) {
              echo "Không tìm thấy thông báo";
            }else{
              $baibao = xemthongbao(intval($_GET['id']));
              while ($ro=mysqli_fetch_assoc($baibao)) { ?>
              <div class="col-12">
                <div class="box box-widget">
                  <div class="box-header with-border">
                    <div class="user-block">
                      <span class="username" style="margin-left: 0;"><a><?php echo $ro['TENTB']; ?></a></span>
                      <span class="description" style="margin-left: 0;"><i class='fa fa-comments'></i>&ensp;<?php echo $ro['NGUOIDANG'] ?>&ensp;&ensp;<?php echo "<i class='fa fa-calendar'></i>&ensp;".date_format(date_create_from_format('Y/m/d', $ro['NGAYDANG']), 'd-m-Y'); ?>&ensp;&ensp;<i class="fa fa-eye"></i>&ensp;<?php echo $ro['LUOTXEM'] ?></span>
                    </div>
                    <!-- /.user-block -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- post text -->
                    <p><?php echo $ro['MOTA']; ?></p>
                    <div class="baicohinhanh" style="float: left;margin: 0.22rem;bottom: 0;width: 100%;white-space: nowrap;overflow: auto;">
                        <?php $hinh = layhinhthongbao($ro['IDBV']);
                        while ($r=mysqli_fetch_assoc($hinh)) { ?>
                          <a><div class="hinhcon" style="background-image:url('<?php echo $ttth['HOST']."/".$r['HINHANH'] ?>')" data="<?php echo $ttth['HOST']."/".$r['HINHANH'] ?>"></div></a>
                        <?php } ?>
                    </div>
                    <hr>
                    <div>
                      <?php echo $ro['NOIDUNG']; ?>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>
              <?php }
            } ?>
          </div>
          <div class="col-md-2 col-sm-1 col-lg-2"></div>
        </div>

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
<div id="xemhinh" style="position: fixed;top: 0;left: 0;right: 0;width: 100%;height: 100%;background-color: #212121;z-index: 99999999999;display: none;">
  <div style="position: fixed;top: 0;right: 0;" id="donghinh"><i class="fa fa-times" style="font-size: 18pt;border-radius: 35px;color: #fff;padding: 5px 7px;"></i></div>
  <div class="cthinh" style="width: 100%;float: left;text-align: center;">
  </div>
  <div style="margin: 0.22rem;position: fixed;bottom: 0;width: 100%;">
    <ul id="danhsachhinh" style="overflow-x: scroll;user-select: none;"></ul>
  </div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="/lte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/lte/dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="/lab/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="/lab/css/jquery-ui.min.css">
 <script type="text/javascript">
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
});
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
$(document).keyup(function(e) {
     if (e.key === "Escape") { // escape key maps to keycode `27`
        $('#xemhinh').hide(150);
    }
});
$(document).on('click','#donghinh',function(e) {
        $('#xemhinh').hide(150);
});
 </script>
   <script type="text/javascript">var __ltn_ = document.createElement('link');__ltn_.rel = 'stylesheet';__ltn_.href = 'lte/bower_components/font-awesome/css/font-awesome.min.css';__ltn_.type = 'text/css';var __gl = document.getElementsByTagName('link')[0];__gl.parentNode.insertBefore(__ltn_, __gl);</script>
</body>
</html>