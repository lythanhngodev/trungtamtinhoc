<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<div class="background-container">
	<div class="row">
		<div class="col-md-8" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
	                <h4>LỚP HỌC</h4>
	                <h6>Các lớp học đã và đang mở</h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-8" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
	                <table id="banglophoc" class="table table-hover" >
	                    <thead>
	                        <tr>
	                            <th class="text-center">TT</th>
	                            <th>Tên lớp học</th>
	                            <th class="text-center">Thuộc khoá học</th>
	                            <th>Diễn giải</th>
	                            <th style="width: 80px;">#</th>
	                            <th style="width: 80px;">DS lớp</th>
	                            <th style="width: 100px;">Phiếu điểm</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                    $lophoc = laylophoc();
	                    $stt = 1;
	                    while ($row = mysqli_fetch_assoc($lophoc)) { ?>
	                        <tr>
	                            <td class="text-center"><?php echo $stt; ?></td>
	                            <td ly="<?php echo $row['IDL'] ?>"><?php echo $row['TENLOP']; ?></td>
	                            <td ly="<?php echo $row['IDKH'] ?>" class="text-center"><?php echo $row['TENKHOA']; ?></td>
	                            <td><?php echo $row['DIENGIAI'] ?></td>
	                            <td class="text-center"><bunton class="btn btn-sm btn-dark sua"><i class="fas fa-pencil-alt"></i></bunton></td>
	                            <td><center><a class="btn btn-sm btn-warning" href="ex/xuatdanhsachlop.php?idl=<?php echo $row['IDL'] ?>" target="_blank"><i class="fas fa-file-word"></i></a></center></td>
	                            <td><center><a class="btn btn-sm btn-warning" href="ex/xuatphieudiem.php?idl=<?php echo $row['IDL'] ?>" target="_blank"><i class="fas fa-file-excel"></i></a></center></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Thêm lớp học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Tên lớp học</label>
      		<input type="text" id="tenlophoc" class="form-control" placeholder="Nhập tên lớp học ...">
      	</div>
      	<div class="form-group">
      		<label>Thuộc khoá học</label>
      		<select id="themkhoahoc" class="form-control">
      			<option value="0">--- Chọn khoá học ---</option>
      			<?php 
      			$khoahoc = laykhoahoc();
      			while ($row = mysqli_fetch_assoc($khoahoc)) { ?>
      			<option value="<?php echo $row['IDKH'] ?>">Khoá <?php echo $row['TENKHOA'] ?></option>
      			<?php } ?>
      		</select>
      	</div>
      	<div class="form-group">
      		<label>Diễn giải</label>
      		<input type="text" id="diengiai" class="form-control" placeholder="Nhập diễn giải ...">
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
        <button type="button" class="btn btn-dark" id="btnthemlophoc"><i class="fas fa-check"></i> Thêm</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalsua" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Điều chỉnh lớp học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Tên lớp học</label>
      		<input type="text" id="suatenlophoc" class="form-control" placeholder="Nhập tên lớp học ...">
      	</div>
      	<div class="form-group">
      		<label>Thuộc khoá học</label>
      		<select id="suakhoahoc" class="form-control" disabled="disabled" >
      			<option value="0">--- Chọn khoá học ---</option>
      			<?php 
      			$khoahoc = laykhoahoc();
      			while ($row = mysqli_fetch_assoc($khoahoc)) { ?>
      			<option value="<?php echo $row['IDKH'] ?>">Khoá <?php echo $row['TENKHOA'] ?></option>
      			<?php } ?>
      		</select>
      	</div>
      	<div class="form-group">
      		<label>Diễn giải</label>
      		<input type="text" id="suadiengiai" class="form-control" placeholder="Nhập diễn giải ...">
      	</div>
      	<input type="text" id="suaidl" hidden="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
        <button type="button" class="btn btn-primary" id="btnsualophoc">Điều chỉnh</button>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="../lab/css/datatables.min.css">
<script src="../lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../lab/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/select2.css">
<script type="text/javascript">
document.getElementById('lophoc').classList.add("active");
$(document).ready(function() {
    $('#banglophoc').DataTable();
} );
$('#themkhoahoc, #suakhoahoc').select2({
  placeholder: '--- Chọn khoá học ---',
  width: '100%'
});
$(document).on('click','#btnthemlophoc',function(){
	var lophoc = $('#tenlophoc').val();
	var khoahoc = $('#themkhoahoc').val();
	var diengiai = $('#diengiai').val();
	if (jQuery.isEmptyObject(lophoc)) {
		tbdanger('Nhập tên lớp học');
		return;
	}
	if (jQuery.isEmptyObject(khoahoc)||khoahoc==0) {
		tbdanger('Chọn khoá học');
		return;
	}
	$.ajax({
		url: 'aj/ajThemlophoc.php',
		type: 'POST',
		data: {
			lophoc:lophoc,
			khoahoc:khoahoc,
			diengiai:diengiai
		},
		success: function (data) {
			var kq = $.parseJSON(data);
			if (kq.trangthai) {
				$('#modalthem').modal('hide');
				tbsuccess('Đã thêm lớp học');
				setTimeout(function(){
			        location.reload();
			    }, 2000);
			}
			else{
				tbdanger('Lỗi!, Vui lòng thử lại sau');
			}
		},
		error: function(){
			tbdanger('Lỗi, Vui lòng thử lại!');
		}
	});
});
$(document).on('click','.sua',function(){
	$('#suatenlophoc').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
	$('#suaidl').val($(this).parent('td').parent('tr').find('td:nth-child(2)').attr('ly').trim());
	$('#suakhoahoc').val($(this).parent('td').parent('tr').find('td:nth-child(3)').attr('ly').trim()).change();
	$('#suadiengiai').val($(this).parent('td').parent('tr').find('td:nth-child(4)').text().trim());
	$('#modalsua').modal('show');
});
$(document).on('click','#btnsualophoc',function(){
	var lophoc = $('#suatenlophoc').val();
	if (jQuery.isEmptyObject(lophoc)) {
		tbdanger('Nhập tên lớp học');
		return;
	}
	$.ajax({
		url: 'aj/ajSualophoc.php',
		type: 'POST',
		data: {
			lophoc:lophoc,
			diengiai:$('#suadiengiai').val().trim(),
			idl: $('#suaidl').val()
		},
		xhr: function () {
	        var xhr = new window.XMLHttpRequest();
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
				tbsuccess('Đã điều chỉnh');
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