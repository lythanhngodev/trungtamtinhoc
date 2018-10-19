<div class="background-container">
	<div class="row">
		<div class="col-12">
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
		<div class="col-md-12">
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
	                            <th>#</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                    $khoahoc = laykhoahoc();
	                    $stt = 1;
	                    while ($row = mysqli_fetch_assoc($khoahoc)) { ?>
	                        <tr>
	                            <td class="text-center"><?php echo $stt; ?></td>
	                            <td ly="<?php echo $row['IDKH'] ?>"><?php echo $row['TENKHOA']; ?></td>
	                            <td class="text-center" ly="<?php echo $row['TGBATDAU'] ?>"><?php echo date_format(date_create_from_format('Y-m-d', $row['TGBATDAU']), 'd/m/Y'); ?></td>
	                            <td class="text-center" ly="<?php echo $row['TGKETTHUC'] ?>"><?php echo date_format(date_create_from_format('Y-m-d', $row['TGKETTHUC']), 'd/m/Y'); ?></td>
	                            <td class="text-center"><?php echo "0"; ?></td>
	                            <td><bunton class="btn btn-sm btn-dark sua"><i class="fas fa-pencil-alt"></i></bunton>&ensp;<bunton class="btn btn-sm btn-dark"><i class="fas fa-times"></i></bunton></td>
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
      	<input type="text" id="suaidkh" hidden="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
        <button type="button" class="btn btn-dark" id="btnsuakhoahoc"><i class="fas fa-check"></i> Điều chỉnh</button>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="./lab/css/datatables.min.css">
<script src="./lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./lab/js/bootstrap.min.js"></script>
<script type="text/javascript">
document.getElementById('khoahoc').classList.add("active");
$(document).ready(function() {
    $('#bangkhoahoc').DataTable();
} );
$(document).on('click','#btnthemkhoahoc',function(){
	var khoahoc = $('#tenkhoahoc').val();
	var batdau = $('#batdau').val();
	var ketthuc = $('#ketthuc').val();
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
			ketthuc:ketthuc
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
		}
	});
});
$(document).on('click','.sua',function(){
	$('#suatenkhoahoc').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
	$('#suaidkh').val($(this).parent('td').parent('tr').find('td:nth-child(2)').attr('ly').trim());
	$('#suabatdau').val($(this).parent('td').parent('tr').find('td:nth-child(3)').attr('ly').trim());
	$('#suaketthuc').val($(this).parent('td').parent('tr').find('td:nth-child(4)').attr('ly').trim());
	$('#modalsua').modal('show');
});
$(document).on('click','#btnsuakhoahoc',function(){
	var khoahoc = $('#suatenkhoahoc').val();
	var batdau = $('#suabatdau').val();
	var ketthuc = $('#suaketthuc').val();
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
			id:$('#suaidkh').val().trim()
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
		}
	});
});
</script>