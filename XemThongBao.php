<?php require_once '_xl_.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Xem thông báo - VLUTE CI</title>
  <meta name="description" content="VLUTE CI - Quản lý thông tin đào tạo tin học Đại học Sư phạm Kỹ thuật Vĩnh Long">
  <?php require_once 'header.php'; ?>
</head>
<body class="sidebar skin-yellow-light">
<div class="wrapper">
  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a class="logo" href="/">
                <?php 
                $path = $ttth['HOST']."/lab/i/vlute_icon36.png";
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/'.$type.';base64,'.base64_encode($data); ?>
        <span class="logo-mini"><img src="<?php echo $base64 ?>" /></span>
        <span class="logo-lg"><img src="<?php echo $base64 ?>" /> <b>VLUTE CI</b></span>
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
            <li><a href="LichThi"><i class="fa fa-calendar"></i> Lịch thi HV</a></li>
            <li><a href="DiemThi"><i class="fa fa-graduation-cap"></i> Điểm thi</a></li>
            <li><a href="TraCuuVanBang"><i class="fa fa-graduation-cap"></i> Tra cứu văn bằng</a></li>
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
                        $delay=200;
                        while ($r=mysqli_fetch_assoc($hinh)) { ?>
                          <a><div class="hinhcon animated fadeInRight" style="background-image:url('<?php echo $ttth['HOST']."/_thumbs/".$r['HINHANH'] ?>');animation-delay: <?php echo $delay;$delay+=80; ?>ms;" data="<?php echo $ttth['HOST']."/".$r['HINHANH'] ?>"></div></a>
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
<div id="xemhinh">
  <div style="position: fixed;top: 0;right: 0;" id="donghinh"><i class="fa fa-times" style="font-size: 18pt;border-radius: 35px;color: #212121;padding: 5px 7px;" tooltip="Đóng cửa sổ"></i></div>
  <div class="cthinh" id="hinhct" style="text-align: center;margin: 1em 0;display: table-cell;vertical-align: middle;">
    <img src="" id="hinhanhct" style="display: block;margin: 0 auto;">
  </div>
  <div style="position: fixed;bottom: 0;width: 100%;height: 85px;">
    <ul id="danhsachhinh"></ul>
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
$(document).keyup(function(e) {
     if (e.key === "Escape") { // escape key maps to keycode `27`
        $('#xemhinh').fadeOut(350);
    }
});
$(document).on('click','#donghinh',function(e) {
        $('#xemhinh').fadeOut(350);
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
 </script>
 <?php require_once 'script.php' ?>
</body>
</html>