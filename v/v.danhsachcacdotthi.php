<div class="background-container">
	<div class="row">
		<div class="col-md-8" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
	                <h4>DANH SÁCH CÁC ĐỢT THI</h4>
	                <h6>Danh sách các đợt thi</h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-8" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
	                <table id="bangkhoahoc" class="table table-hover" >
	                    <thead>
	                        <tr>
	                            <th class="text-center">TT</th>
	                            <th>Tên đợt thi</th>
	                            <th class="text-center">Thời gian tạo</th>
	                            <th class="text-center">Trong khóa học</th>
	                            <th>#</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                    $khoahoc = laydanhsachdotthi();
	                    $stt = 1;
	                    while ($row = mysqli_fetch_assoc($khoahoc)) { ?>
	                        <tr>
	                            <td class="text-center"><?php echo $stt; ?></td>
	                            <td ly="<?php echo $row['IDDS'] ?>"><?php echo $row['TENDS']; ?></td>
	                            <td class="text-center"><?php echo date('d-m-Y',$row['TG']); ?></td>
	                            <td class="text-center"><?php echo $row['TENKHOA']; ?></td>
	                            <td><bunton class="btn btn-sm btn-dark sua"><i class="fas fa-pencil-alt"></i></bunton>&ensp;<bunton class="btn btn-sm btn-dark xoa"><i class="fas fa-times"></i></bunton></td>
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
      		<label>Tên danh sách đợt thi</label>
      		<input type="text" id="suatendanhsach" class="form-control" placeholder="Nhập tên danh sách ...">
      	</div>

      	<input type="text" id="suaidds" hidden="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
        <button type="button" class="btn btn-primary" id="btnsuakhoahoc">Điều chỉnh</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalxoa" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger">Điều gì xảy ra khi xóa danh sách đợt thi?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Khi xóa <span><b id="xoatendanhsach"></b></span>, ngoài việc xóa danh sách này hệ thống còn xóa các học viên có tên trong danh sách, các thông tin phòng thi và điểm (nếu có).</label>
      	</div>
      	<input type="text" id="xoaidds" hidden="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
        <button type="button" class="btn btn-danger" id="btnxoakhoahoc">Có, Xóa</button>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="./lab/css/datatables.min.css">
<script src="./lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./lab/js/bootstrap.min.js"></script>

<script type="text/javascript">
document.getElementById('tochucthi').classList.add("active");
document.getElementById('danhsachcacdotthi').classList.add("active");
$(document).ready(function() {
    $('#bangkhoahoc').DataTable();
} );

$(document).on('click','.sua',function(){
	$('#suatendanhsach').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
	$('#suaidds').val($(this).parent('td').parent('tr').find('td:nth-child(2)').attr('ly').trim());
	$('#modalsua').modal('show');
});
$(document).on('click','.xoa',function(){
	$('#xoatendanhsach').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
	$('#xoaidds').val($(this).parent('td').parent('tr').find('td:nth-child(2)').attr('ly').trim());
	$('#modalxoa').modal('show');
});
$(document).on('click','#btnsuakhoahoc',function(){
	var tends = $('#suatendanhsach').val();
	if (jQuery.isEmptyObject(tends)) {
		tbdanger('Nhập tên khoá học');
		return;
	}
	$.ajax({
		url: 'aj/ajSuadanhsachdotthi.php',
		type: 'POST',
		data: {
			tends:tends,
			id:$('#suaidds').val().trim()
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
$(document).on('click','#btnxoakhoahoc',function(){
	$.ajax({
		url: 'aj/ajXoadanhsachdotthi.php',
		type: 'POST',
		data: {
			id:$('#xoaidds').val().trim()
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
				$('#modalxoa').modal('hide');
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