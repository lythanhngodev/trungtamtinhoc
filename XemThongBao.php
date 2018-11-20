<?php require_once '_xl_.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Xem thông báo | VLUTE-CI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <base href="http://localhost:8888/">
  <link rel="shortcut icon" href="/lab/i/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/lab/i/favicon.ico" type="image/x-icon">
  <meta name="description" content="VLUTE-CI | Quản lý thông tin đào tạo tin học Đại học Sư phạm Kỹ thuật Vĩnh Long">
  <meta name="keywords" content="VLUTE, VLUTE-CI, Trung tâm tin học, lịch thi, tra cứu điểm, thông báo ,lythanhngodev">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/lte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/lte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="/lte/dist/css/skins/skin-yellow-light.min.css">
  <!-- Google Font -->
</head>
<body class="sidebar-mini skin-yellow-light">
<div class="wrapper">
  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a class="logo" href="/">
        <span class="logo-mini"><img src="/lab/i/vlute_icon36.png" /></span>
        <span class="logo-lg"><img src="/lab/i/vlute_icon36.png" /> <b>VLUTE</b> CI</span>
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
            <a href="ThongBao.php">
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
            <li><a href="TKBHocVien.php">TKB hoc viên</a></li>
            <li><a href="TKBGiangVien.php">TKB giảng viên</a></li>
            <li><a href="LichThi.php">Lịch thi HV</a></li>
            <li><a href="DiemThi.php">Điểm thi</a></li>
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
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Phiên bản: 20.11.18
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="#">Ngô Thanh Lý</a> </strong>(Faculty of Information Technology 2014)
  </footer>
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
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
 </script>
   <script type="text/javascript">var __ltn_ = document.createElement('link');__ltn_.rel = 'stylesheet';__ltn_.href = 'lte/bower_components/font-awesome/css/font-awesome.min.css';__ltn_.type = 'text/css';var __gl = document.getElementsByTagName('link')[0];__gl.parentNode.insertBefore(__ltn_, __gl);</script>
</body>
</html>