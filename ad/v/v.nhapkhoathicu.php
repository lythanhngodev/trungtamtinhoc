<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<style type="text/css">
	#banglophoc input[type=text]{border: 1px solid #2d93ff;background: #f3f9ff;}
	.xoadong{cursor: pointer;}
	#banglophoc td, #banghocvien td {padding-left: 6px !important;}
</style>
<div class="background-container container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
	                <h4>NHẬP THÔNG TIN CÁC KHÓA THI CŨ</h4>
	                <h6>Nhập thông tin các khóa thi cũ</h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="form-group col-md-6" id="khungchondanhsach" style="float: left;">
						<label><b>Đợt thi</b></label>
						<select class="form-control" id="chondanhsach">
							<option value="0">--- Chọn danh sách ---</option>
							<option value="taodotthi">+++ Tạo đợt thi mới +++</option>
							<?php 
							$ds = laydanhsachdangkyduthi();
							while ($row = mysqli_fetch_assoc($ds)) { ?>
							<option value="<?php echo $row['IDDS'] ?>"><?php echo $row['TENDS'] ?></option>
							<?php }
							 ?>
						</select>
					</div>
					<div class="form-group col-md-6" style="float: left;">
						<label style="width: 100%;float: left;"><b>Nhập từ Excel</b></label>
						<input type="file" id="dulieufile" class="form-control" style="width: 70%;float: left;"> 
						<button class="btn btn-dark" id="laydulieu" style="width: 25%;float: left;margin-left: 4px;">Nhập</button><br>
						<a href="../lab/e/mau-excel-2.xlsx" class="text-link text-dark" style="float: right;"><i><u>Tải xuống file mẫu</u></i></a>
					</div>
					<div id="khunghocvien">
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				    Xem Hướng dẫn &amp; Lưu ý
				  </button>
					<div class="collapse" id="collapseExample">
						<hr>
					    <ol>
					    	<li><b><i>Đối với thí sinh bị cấm thi:</i></b>
					    		<dl>
					    			<dd>- Thí sinh bị cấm thi sẽ không hiện ra ở danh sách này.</dd>
					    		</dl>
					    	</li>
					    </ol>
					</div>
				</div>
			</div>
			<br>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaltaodotthi" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tạo đợt thi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Tên đợt thi</label>
      		<input type="text" id="tendot" class="form-control" placeholder="Nhập tên đợt thi ...">
      	</div>
		<div class="form-group">
      		<label>Chọn khóa học</label>
			<select class="form-control" id="khoahocchon">
				<?php 
				$ds = laykhoahoc();
				while ($row = mysqli_fetch_assoc($ds)) { ?>
				<option value="<?php echo $row['IDKH'] ?>"><?php echo $row['TENKHOA'] ?></option>
				<?php }
				 ?>
			</select>
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
        <button type="button" class="btn btn-dark" id="btnthemdotthi"><i class="fas fa-check"></i> Thêm</button>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="../lab/css/datatables.min.css">
<script src="../lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../lab/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/select2.css">
<script type="text/javascript" src="../lab/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/jquery-ui.min.css">
<script type="text/javascript">
document.getElementById('nhapkhoathicu').classList.add("active");

$('#chonkhoahoc, #chondanhsach').select2({
  width: '100%'
});
$(document).on('click','#banglophoc .xoadong',function(){
      $("#banglophoc").DataTable().row( $(this).parents('tr') ).remove().draw();
});
$(document).on('click','#btnthemdotthi',function(){
	var tendot = $('#tendot').val();
	var batdau = $('#batdau').val();
	var ketthuc = $('#ketthuc').val();
	var khoahoc = $('#khoahocchon').val();
	if (jQuery.isEmptyObject(tendot)) {
		tbdanger('Chưa nhập tên đợt thi');
		return 0;
	}
	$('#khungchondanhsach').empty();
	$.ajax({
		url: 'aj/ajTaodotthi.php',
		type: 'POST',
		beforeSend: function () {
                tbinfo("Vui lòng chờ...");
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
		data: {
			tendot:tendot,
			batdau:batdau,
			ketthuc:ketthuc,
			khoahoc: khoahoc
		},
		success: function (data) {
			$('#khungchondanhsach').html(data);
		},
	    complete: function () {
		        $("#daluot").css("width","0%");
		},
		error: function(){
			tbdanger('Lỗi, Vui lòng thử lại!');
		}
	});
});
$(document).on('change','#chondanhsach',function(){
	if($(this).val()=='0'){
		$('#khunghocvien').hide( 367 );
		$('#khunghocvien').empty();
		return 0;
	}
	if($(this).val()=='taodotthi'){
		$('#khunghocvien').hide( 367 );
		$('#khunghocvien').empty();
		$('#modaltaodotthi').modal('show');
		return 0;
	}
});
$(document).on('click','#laydulieu',function(){
	$('#khunghocvien').empty();
	if ($('#chondanhsach').val()=='taodotthi' || $('#chondanhsach').val()=='0') {
		tbdanger('Chưa chọn đợt thi');
		return 0;
	}
	if (jQuery.isEmptyObject($('#chondanhsach').val())) {
		tbdanger('Chưa chọn đợt thi');
		return 0;
	}
	var file_data = $('#dulieufile').prop('files')[0];
	if (jQuery.isEmptyObject(file_data)) {tbdanger('Chưa file nào được chọn');return 0;}
	var type = file_data.type;
	var match = ["application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
	if (type==match[0] || type==match[1]) {
	    var form_data = new FormData();
	    form_data.append('file', file_data);
	    form_data.append('dotthi',$('#chondanhsach').val());
        $.ajax({
            url: './aj/ajLaydulieudangkythicu.php', // gửi đến file upload.php
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            data: form_data,
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
            beforeSend: function () {
                tbinfo("Vui lòng chờ...");
            },
		    complete: function () {
		        $("#daluot").css("width","0%");
		    },
            success: function(data){
            	tban();
            	tbsuccess('Tải xong');
            	$('#khunghocvien').html(data);
			    $('#banglophoc').DataTable({
				  "scrollY": "400px",
				  "scrollCollapse": true,
				  "paging": false,
				  "scrollX": true,
				  "ordering": false
				});
            },
            error: function () {
                tbdanger('Không thể tải file');
            }
        });
	}
	else{
		tbdanger('Vui lòng chọn định dạng Excel');
	}
});
</script>