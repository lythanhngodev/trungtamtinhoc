<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<div class="background-container">
	<div class="row">
		<div class="col-md-8" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
	                <h4>KHOÁ HỌC</h4>
	                <h6>Các khoá học đã và đang mở</h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-8" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
					<div class="col-md-12">
						<button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#modalthem"><i class="fa fa-plus"></i> Thêm mới</button>
					</div>
					<br>
	                <table id="bangkhoahoc" class="table table-hover" >
	                    <thead>
	                        <tr>
	                            <th class="text-center">TT</th>
	                            <th>Tên khoá học</th>
	                            <th class="text-center">TG Bắt đầu</th>
	                            <th class="text-center">TG Kết thúc</th>
	                            <th class="text-center">Tổng Lớp</th>
	                            <th class="text-center">Loại khóa</th>
	                            <th>Học phí</th>
	                            <th>#</th>
	                            <th>Khóa</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                    $khoahoc = laykhoahoc_all();
	                    $stt = 1;
	                    while ($row = mysqli_fetch_assoc($khoahoc)) { ?>
	                        <tr>
	                            <td class="text-center"><?php echo $stt; ?></td>
	                            <td ly="<?php echo $row['IDKH'] ?>"><?php echo $row['TENKHOA']; ?></td>
	                            <td class="text-center" ly="<?php echo $row['TGBATDAU'] ?>"><?php echo date_format(date_create_from_format('Y-m-d', $row['TGBATDAU']), 'd/m/Y'); ?></td>
	                            <td class="text-center" ly="<?php echo $row['TGKETTHUC'] ?>"><?php echo date_format(date_create_from_format('Y-m-d', $row['TGKETTHUC']), 'd/m/Y'); ?></td>
	                            <td class="text-center"><?php echo $row['SOLOP']; ?></td>
	                            <td class="text-center"><?php echo $row['LOAIKHOA']; ?></td>
	                            <td class="text-center"><a class="btn btn-sm btn-warning" href="ex/xuatdanhsachhocphi.php?khoa=<?php echo $row['IDKH'] ?>" target="_blank"><i class="fas fa-file-word"></i></a></td>
	                            <td><bunton class="btn btn-sm btn-dark sua"><i class="fas fa-pencil-alt"></i></bunton>&ensp;<bunton class="btn btn-sm btn-dark"><i class="fas fa-times"></i></bunton></td>
	                            <td>
	                            	<?php if($row['HOANTHANH']==1){ ?>
	                            		<bunton class="btn btn-sm btn-danger mokhoa" ltn="<?php echo $row['IDKH'] ?>"><i class="fas fa-lock"></i></bunton>
		                            <?php }else{ ?>
		                            	<bunton class="btn btn-sm btn-success khoa" ltn="<?php echo $row['IDKH'] ?>"><i class="fas fa-lock-open"></i></bunton>
		                            <?php } ?>
	                            </td>
	                        </tr>
	                    <?php ++$stt;} ?>
	                    </tbody>
	                </table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalthem" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm khoá học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Tên khoá học</label>
      		<input type="text" id="tenkhoahoc" class="form-control" placeholder="Nhập tên khoá học ...">
      	</div>
      	<div class="form-group">
      		<label>Thời gian bắt đầu</label>
      		<input type="date" id="batdau" class="form-control">
      	</div>
      	<div class="form-group">
      		<label>Thời gian kết thúc</label>
      		<input type="date" id="ketthuc" class="form-control">
      	</div>
      	<div class="form-group">
      		<label>Loại khóa học</label>
      		<select id="loaikhoa" class="form-control">
      			<?php 
      			$loaikhoa = layloaikhoa();
      			while ($row = mysqli_fetch_assoc($loaikhoa)) { ?>
      			<option value="<?php echo $row['TENLK'] ?>"><?php echo $row['TENLK'] ?></option>
      			<?php } ?>
      		</select>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
        <button type="button" class="btn btn-dark" id="btnthemkhoahoc"><i class="fas fa-check"></i> Thêm</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalsua" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Điều chỉnh khoá học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Tên khoá học</label>
      		<input type="text" id="suatenkhoahoc" class="form-control" placeholder="Nhập tên khoá học ...">
      	</div>
      	<div class="form-group">
      		<label>Thời gian bắt đầu</label>
      		<input type="date" id="suabatdau" class="form-control">
      	</div>
      	<div class="form-group">
      		<label>Thời gian kết thúc</label>
      		<input type="date" id="suaketthuc" class="form-control">
      	</div>
      	<div class="form-group">
      		<label>Loại khóa học</label>
      		<select id="sualoaikhoa" class="form-control">
      			<?php 
      			$loaikhoa = layloaikhoa();
      			while ($row = mysqli_fetch_assoc($loaikhoa)) { ?>
      			<option value="<?php echo $row['TENLK'] ?>"><?php echo $row['TENLK'] ?></option>
      			<?php } ?>
      		</select>
      	</div>
      	<input type="text" id="suaidkh" hidden="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
        <button type="button" class="btn btn-primary" id="btnsuakhoahoc">Điều chỉnh</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalkhoa" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger">Điều gì xảy ra khi khóa khóa học?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Khi khóa <span><b id="xoatendanhsach"></b></span>, chỉ có thể xem thông tin liên quan khóa học, nhưng không được thao tác dữ liệu liên quan khóa.</label>
      	</div>
      	<input type="text" id="khoaid" hidden="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
        <button type="button" class="btn btn-danger" id="btnkhoakhoahoc">Có, Khóa</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalmokhoa" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger">Điều gì xảy ra khi mở khóa khóa học?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Khi mở khóa <span><b id="mokhoaten"></b></span>, được thao tác dữ liệu liên quan khóa.</label>
      	</div>
      	<input type="text" id="mokhoaid" hidden="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
        <button type="button" class="btn btn-danger" id="btnmokhoakhoahoc">Có, Mở khóa</button>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="../lab/css/datatables.min.css">
<script src="../lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>

<script type="text/javascript">
document.getElementById('khoahoc').classList.add("active");
$(document).ready(function() {
    $('#bangkhoahoc').DataTable();
} );

$(document).on('click','#btnthemkhoahoc',function(){
	var khoahoc = $('#tenkhoahoc').val();
	var batdau = $('#batdau').val();
	var ketthuc = $('#ketthuc').val();
	var loaikhoa = $('#loaikhoa').val();
	if (jQuery.isEmptyObject(khoahoc)) {
		tbdanger('Nhập tên khoá học');
		return;
	}
	$.ajax({
		url: 'aj/ajThemkhoahoc.php',
		type: 'POST',
		data: {
			khoahoc:khoahoc,
			batdau:batdau,
			ketthuc:ketthuc,
			loaikhoa:loaikhoa
		},
		xhr: function () {
	        var xhr = new window.XMLHttpRequest();
	        //Download progress
	        xhr.upload.addEventListener("progress", function (evt) {
	            if (evt.lengthComputable) {
	                var percentComplete = evt.loaded / evt.total;
	                $("#daluot").css("width",(Math.round(percentComplete * 100) + "%"));
	            }
	        }, false);
	        return xhr;
	    },
		success: function (data) {
			var kq = $.parseJSON(data);
			if (kq.trangthai) {
				$('#modalthem').modal('hide');
				tbsuccess('Đã thêm khoá học');
				setTimeout(function(){
			        location.reload();
			    }, 2000);
			}
			else{
				tbdanger('Lỗi!, Vui lòng thử lại sau');
			}
		},
	    complete: function () {
		        $("#daluot").css("width","0%");
		},
		error: function(){
			tbdanger('Lỗi, Vui lòng thử lại!');
		}
	});
});
$(document).on('click','.sua',function(){
	$('#suatenkhoahoc').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
	$('#suaidkh').val($(this).parent('td').parent('tr').find('td:nth-child(2)').attr('ly').trim());
	$('#suabatdau').val($(this).parent('td').parent('tr').find('td:nth-child(3)').attr('ly').trim());
	$('#suaketthuc').val($(this).parent('td').parent('tr').find('td:nth-child(4)').attr('ly').trim());
	$('#sualoaikhoa').val($(this).parent('td').parent('tr').find('td:nth-child(6)').text().trim()).change();
	$('#modalsua').modal('show');
});
$(document).on('click','#btnsuakhoahoc',function(){
	var khoahoc = $('#suatenkhoahoc').val();
	var batdau = $('#suabatdau').val();
	var ketthuc = $('#suaketthuc').val();
	var loaikhoa = $('#sualoaikhoa').val();
	if (jQuery.isEmptyObject(khoahoc)) {
		tbdanger('Nhập tên khoá học');
		return;
	}
	$.ajax({
		url: 'aj/ajSuakhoahoc.php',
		type: 'POST',
		data: {
			khoahoc:khoahoc,
			batdau:batdau,
			ketthuc:ketthuc,
			id:$('#suaidkh').val().trim(),
			loaikhoa:loaikhoa
		},
		xhr: function () {
	        var xhr = new window.XMLHttpRequest();
	        //Download progress
	        xhr.upload.addEventListener("progress", function (evt) {
	            if (evt.lengthComputable) {
	                var percentComplete = evt.loaded / evt.total;
	                $("#daluot").css("width",(Math.round(percentComplete * 100) + "%"));
	            }
	        }, false);
	        return xhr;
	    },
		success: function (data) {
			var kq = $.parseJSON(data);
			if (kq.trangthai) {
				$('#modalsua').modal('hide');
				tbsuccess('Đã điều chỉnh khoá học');
				setTimeout(function(){
			        location.reload();
			    }, 2000);
			}
			else{
				tbdanger('Lỗi!, Vui lòng thử lại sau');
			}
		},
	    complete: function () {
		        $("#daluot").css("width","0%");
		},
		error: function(){
			tbdanger('Lỗi, Vui lòng thử lại!');
		}
	});
});
$(document).on('click','.khoa',function(){
	$('#xoatendanhsach').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
	$('#khoaid').val($(this).attr('ltn'));
	$('#modalkhoa').modal('show');
});
$(document).on('click','.mokhoa',function(){
	$('#mokhoaten').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
	$('#mokhoaid').val($(this).attr('ltn'));
	$('#modalmokhoa').modal('show');
});
$(document).on('click','#btnkhoakhoahoc',function(){
	$.ajax({
		url: 'aj/ajKhoakhoahoc.php',
		type: 'POST',
		data: {
			khoahoc:$('#khoaid').val()
		},
		xhr: function () {
	        var xhr = new window.XMLHttpRequest();
	        //Download progress
	        xhr.upload.addEventListener("progress", function (evt) {
	            if (evt.lengthComputable) {
	                var percentComplete = evt.loaded / evt.total;
	                $("#daluot").css("width",(Math.round(percentComplete * 100) + "%"));
	            }
	        }, false);
	        return xhr;
	    },
		success: function (data) {
			var kq = $.parseJSON(data);
			if (kq.trangthai) {
				$('#modalkhoa').modal('hide');
				tbsuccess('Đã khóa khoá học');
				setTimeout(function(){
			        location.reload();
			    }, 2000);
			}
			else{
				tbdanger('Lỗi!, Vui lòng thử lại sau');
			}
		},
	    complete: function () {
		        $("#daluot").css("width","0%");
		},
		error: function(){
			tbdanger('Lỗi, Vui lòng thử lại!');
		}
	});
});
$(document).on('click','#btnmokhoakhoahoc',function(){
	$.ajax({
		url: 'aj/ajMoKhoakhoahoc.php',
		type: 'POST',
		data: {
			khoahoc:$('#mokhoaid').val()
		},
		xhr: function () {
	        var xhr = new window.XMLHttpRequest();
	        //Download progress
	        xhr.upload.addEventListener("progress", function (evt) {
	            if (evt.lengthComputable) {
	                var percentComplete = evt.loaded / evt.total;
	                $("#daluot").css("width",(Math.round(percentComplete * 100) + "%"));
	            }
	        }, false);
	        return xhr;
	    },
		success: function (data) {
			var kq = $.parseJSON(data);
			if (kq.trangthai) {
				$('#modalmokhoa').modal('hide');
				tbsuccess('Đã mở khóa khoá học');
				setTimeout(function(){
			        location.reload();
			    }, 2000);
			}
			else{
				tbdanger('Lỗi!, Vui lòng thử lại sau');
			}
		},
	    complete: function () {
		        $("#daluot").css("width","0%");
		},
		error: function(){
			tbdanger('Lỗi, Vui lòng thử lại!');
		}
	});
});
</script>