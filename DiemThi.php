<?php require_once '_xl_.php'; ?>
<?php 
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
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tra cứu điểm | VLUTE-CI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <base href="http://localhost:8888/">
  <link rel="shortcut icon" href="/lab/i/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/lab/i/favicon.ico" type="image/x-icon">
  <meta name="description" content="VLUTE-CI | Quản lý thông tin đào tạo tin học Đại học Sư phạm Kỹ thuật Vĩnh Long">
  <meta name="keywords" content="VLUTE, VLUTE-CI, Trung tâm tin học, lịch thi, tra cứu điểm, lythanhngodev">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/lte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="/lte/dist/css/skins/skin-yellow-light.min.css">
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
            <li><a href="TKBHocVien.php">TKB hoc viên</a></li>
            <li><a href="TKBGiangVien.php">TKB giảng viên</a></li>
            <li><a href="LichThi.php">Lịch thi HV</a></li>
            <li class="active"><a href="DiemThi.php">Điểm thi</a></li>
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
              Tra cứu điểm thi
          </h1>
      </section>
    </section>
    <section class="content">
        <div class="row">
            <div class="form-group col-md-4">
                <div class="input-group">
                    <input id="tukhoa" name="tukhoa" type="text" class="form-control" placeholder="CMND, Số báo danh, Họ tên ...">
                    <div class="input-group-btn">
                        <button class="btn btn-success" id="xemdiem"><i class="fa fa-search"></i> Tra cứu</button>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <select class="form-control" id="hocky">
                  <?php 
                  $dotthi = laydotthi();
                  while ($row = mysqli_fetch_assoc($dotthi)) { ?>
                    <option value="<?php echo $row['IDDS'] ?>"><?php echo $row['TENDS'].'  ( '.date_format(date_create_from_format('Y-m-d', $row['TUNGAY']), 'd/m/Y').' đến '.date_format(date_create_from_format('Y-m-d', $row['DENNGAY']), 'd/m/Y')." )" ?></option>
                  <?php }
                   ?>
                </select>
            </div>
            <input type="hidden" id="idso" name="idso" value="" />
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
              url: 'api/ajDiemHocVien.php',
              data: {key:$('#tukhoa').val()},
              success: function(data) {
                  $('#tukhoa').removeClass('ui-autocomplete-loading');  
                  response( $.map( data, function(item) {
                    return {
                        label: item.CMND + ' - ' + item.HOTEN,
                        value: item.IDHV
                    }
                  }));
              },
              error: function(data) {
                  $('#tukhoa').removeClass('ui-autocomplete-loading');  
              }
          });
      },
      minLength: 4,
      select: function (event, ui) {
          $('#idso').val(ui.item.value);
          $('#tukhoa').val(ui.item.label);
          return false;
      },
  });
});
$(document).on('click','#xemdiem',function(){
  $('#khungthongtin').empty();
  $.ajax({
    url: 'api/ajXemdiem.php',
    type: 'POST',
    beforeSend: function () { tbinfo("Đang tra cứu..."); },
    data: { d:$('#idso').val(),k:$('#hocky').val()},
    success: function (data) {
      tban();
      tbsuccess('Tải xong');
      $('#khungthongtin').html(data);
    },
    error: function(){
      tbdanger('Không tìm thấy dữ liệu!');
    }
  });
});
 </script>
 <script type="text/javascript">(function(){var t;(t=jQuery).bootstrapGrowl=function(s,e){var a,o,l;switch(e=t.extend({},t.bootstrapGrowl.default_options,e),(a=t("<div>")).attr("class","bootstrap-growl alert"),e.type&&a.addClass("alert-"+e.type),e.allow_dismiss&&(a.addClass("alert-dismissible"),a.append('<button  class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&#215;</span><span class="sr-only">Close</span></button>')),a.append(s),e.top_offset&&(e.offset={from:"top",amount:e.top_offset}),l=e.offset.amount,t(".bootstrap-growl").each(function(){return l=Math.max(l,parseInt(t(this).css(e.offset.from))+t(this).outerHeight()+e.stackup_spacing)}),(o={position:"body"===e.ele?"fixed":"absolute",margin:0,"z-index":"9999",display:"none"})[e.offset.from]=l+"px",a.css(o),"auto"!==e.width&&a.css("width",e.width+"px"),t(e.ele).append(a),e.align){case"center":a.css({left:"50%","margin-left":"-"+a.outerWidth()/2+"px"});break;case"left":a.css("left","20px");break;default:a.css("right","20px")}return a.fadeIn(),e.delay>0&&a.delay(e.delay).fadeOut(function(){return t(this).alert("close")}),a},t.bootstrapGrowl.default_options={ele:"body",type:"info",offset:{from:"top",amount:20},align:"right",width:250,delay:4e3,allow_dismiss:!0,stackup_spacing:10}}).call(this);</script><script type="text/javascript">function tbinfo(mess){$.bootstrapGrowl('<i class="fa fa-spinner fa-spin"></i>  '+mess, {type: 'info',delay: 2000});}function tbsuccess(mess){$.bootstrapGrowl('<i class="fa fa-check"></i>  '+mess, {type: 'success',delay: 2000});}function tbdanger(mess){$.bootstrapGrowl('<i class="fa fa-times"></i>  '+mess, {type: 'danger',delay: 2000});}function tban(){$('.bootstrap-growl').remove();}</script>
    <script type="text/javascript">var __ltn_ = document.createElement('link');__ltn_.rel = 'stylesheet';__ltn_.href = 'lte/bower_components/font-awesome/css/font-awesome.min.css';__ltn_.type = 'text/css';var __gl = document.getElementsByTagName('link')[0];__gl.parentNode.insertBefore(__ltn_, __gl);</script>
</body>
</html>