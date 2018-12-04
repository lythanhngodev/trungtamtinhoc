<?php require_once '_xl_.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tra cứu văn bằng - VLUTE CI</title>
  <meta name="description" content="VLUTE CI - Quản lý thông tin đào tạo tin học Đại học Sư phạm Kỹ thuật Vĩnh Long">
  <link rel="stylesheet" type="text/css" href="/lab/css/datatables.min.2.css">
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
        <li>
            <a href="/">
                <i class="fa fa-bullhorn"></i> <span>Thông báo từ trung tâm</span>
            </a>
        </li>
        <li class=" active treeview menu-open">
          <a href="#"><i class="fa fa-search"></i> <span>Tra cứu thông tin</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu" style="display: block;">
            <li><a href="LichThi.php"><i class="fa fa-calendar"></i> Lịch thi HV</a></li>
            <li><a href="DiemThi.php"><i class="fa fa-graduation-cap"></i> Điểm thi</a></li>
            <li class="active"><a href="TraCuuVanBang.php"><i class="fa fa-graduation-cap"></i> Tra cứu văn bằng</a></li>
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
    <section class="content container-fluid">
      <section class="content-header">
          <h1>
              Tra cứu chứng chỉ tin học
          </h1>
      </section>
    </section>
    <section class="content">
        <div class="row">
            <div class="form-group col-md-4">
                <div class="input-group">
                    <input id="tukhoa" type="text" class="form-control" placeholder="CMND, Số báo danh, Họ tên ...">
                    <div class="input-group-btn">
                        <button class="btn btn-success" id="xemchungchi"><i class="fa fa-search"></i> Tra cứu</button>
                    </div>
                </div>
            </div>
            <!--
            <div class="form-group col-md-12">
                <input id="sovaoso" name="sovaoso" type="text" class="form-control" placeholder="Số vào sổ ...">
            </div>
            <div class="form-group col-md-12">
                <input id="ngayvaoso" name="ngayvaoso" type="text" class="form-control" placeholder="Ngày vào sổ ...">
            </div>
            <div class="form-group col-md-12">
                <div class="input-group">
                    <button class="btn btn-success" id="xemlich"><i class="fa fa-search"></i> Tra cứu</button>
                </div>
            </div>-->
        </div>
        <div class="box box-solid" id="khungthongtin">
            <!-- /.box-body -->
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
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="/lte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/lab/js/datatables.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/lte/dist/js/adminlte.min.js"></script>
 <script type="text/javascript">
$(document).on('click','#xemchungchi',function(){
  $('#khungthongtin').empty();
  $.ajax({
    url: 'api/ajXemchungchi.php',
    type: 'POST',
    beforeSend: function () { tbinfo("Đang tra cứu..."); },
    data: { s:$('#tukhoa').val()},
    success: function (data) {
      tban();
      (jQuery.isEmptyObject(data)) ? tbdanger('Không có dữ liệu') : tbsuccess('Tải xong');
      $('#khungthongtin').html(data);
          $('#tabledata').DataTable();
    },
    error: function(){
      tbdanger('Không tìm thấy dữ liệu!');
    }
  });
});
$(document).on('click','#xemchitiet',function(){
  $.ajax({
    url: 'api/ajXemchungchichitiet.php',
    type: 'POST',
    data: { s:$(this).attr('ltn')},
    success: function (data) {
      tban();
      (jQuery.isEmptyObject(data)) ? tbdanger('Không có dữ liệu') : tbsuccess('Tải xong');
      $('#khungthongtin').html(data);
          $('#tabledata').DataTable();
    },
    error: function(){
      tbdanger('Không tìm thấy dữ liệu!');
    }
  });
});
 </script>
 <?php require_once 'script.php' ?>
</body>
</html>