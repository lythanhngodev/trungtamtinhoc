<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<style type="text/css">
	#banglophoc input[type=text]{
	    border: 1px solid #2d93ff;
	    background: #f3f9ff;
	}
.ui-autocomplete { position: absolute; cursor: default;z-index:999999 !important;} 
</style>
<style type="text/css">
	.onhap{
		width: 160px !important;
	}
	.form-control:focus{
		color: #495057 !important;
	    background-color: #fff !important;
	    border-color: #bbb !important;
	    outline: 0 !important;
	    box-shadow: none !important;
	}
	#bangphancong td{
		padding: 6px !important;
	}
</style>
<div class="background-container container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
	                <h4>NHẬP HỌC VIÊN</h4>
	                <h6>Nhập học viên vào cơ sở dữ liệu</h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12" style="padding: 0">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">

						<div class="form-group col-md-4" style="float: left;">
							<label><b>Chọn file Excel</b></label>
							<input type="file" class="form-control" id="fileexcel">
						</div>
						<div class="form-group col-md-4" style="float: left;">
							<label style="width: 100%"><b>Lấy dữ liệu từ Excel</b></label>
							<button class="btn btn-dark" id="laydulieu">Lấy dữ liệu</button><br>
							<a href="../lab/e/mau-excel-0.xlsx" class="text-link text-dark"><i><u>Tải xuống file mẫu</u></i></a>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="col-md-12">
			<br>
			<div class="card">
				<center><br>
					<div class="form-group col-md-3" id="khungkhoahoc">
						<label><b>Chọn khoá học</b><br><i>Chọn khóa học cho các học viên này</i></label>
						<select class="form-control" id="chonkhoahoc">
							<option value="0">--- Chọn khoá học ---</option>
							<option value="taokhoahoc">++ Tạo nhanh khóa mới ++</option>
							<?php 
							$kh = laykhoahoc();
							while ($row = mysqli_fetch_assoc($kh)) { ?>
							<option value="<?php echo $row['IDKH'] ?>"><?php echo $row['TENKHOA'] ?></option>
							<?php }
							 ?>
						</select>
					</div>	
				</center>
				<div class="card-body" id="khunghocvien">
	                <table id="banglophoc" class="table table-hover display nowrap" style="width: 100%">
	                    <thead>
					        <tr class="text-center">
					        	<th>STT</th>
					            <th>MSSV</th>
					            <th>Họ &amp; Tên lót</th>
					            <th>Tên</th>
					            <th>Số CMND</th>
					            <th>Ngày sinh</th>
					            <th>Giới tính</th>
					            <th>Nơi sinh</th>
					            <th>Số điện thoại</th>
					            <th>Mã số biên lai</th>
					            <th>Ngày ghi biên lai</th>
					            <th>Ghi chú</th>
					            <th>Lớp</th>
					            <th>ĐĐ/TG học</th>
					        </tr>
	                    </thead>
	                    <tbody>
	                    </tbody>
	                </table>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				    Xem Hướng dẫn &amp; Lưu ý
				  </button>
					<div class="collapse" id="collapseExample">
						<hr>
					    <ol>
					    	<li><b><i>File Excel:</i></b>
					    		<dl>
					    			<dd>- Ở mỗi file dữ liệu tương ứng 1 khóa học</dd>
					    			<dd>- Vui lòng sắp xếp theo tên học viên ở các sheet theo thứ tự <b>A-Z</b></dd>
					    		</dl>
					    	</li>
					    	<li><b><i>Thao tác trên bảng học viên</i></b>
					    		<dl>
					    			<dd>- Để chỉnh sửa thông tin học viên nhấp chuột vào ô cần chỉnh sữa. Hoàn thành chỉnh sửa bằng cách ấn phím <b>Enter</b></dd>	
					    		</dl>
					    	</li>
					    </ol>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalthemkhoahoc" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="modalphanconggiangday" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Phân công giảng dạy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<table id="bangphancong" class="table table-bordered">
      	</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" id="btnphanconggiangday">Lưu Học viên &amp; Phân công</button>
      </div>
    </div>
  </div>
</div>
<div id="dialog" title="Thông báo lỗi" class="dialog">
  <p>Phát hiện: <b><span id="loicmnd" class="text-danger"></span></b> học viên có số CMND trùng nhau. Hệ thống đã tô <b class="text-danger"> ĐỎ</b> các số CMND trùng nhau. Vui lòng kiểm tra lại thông tin.</p>
</div>


<link rel="stylesheet" type="text/css" href="../lab/css/datatables.min.css">
<script src="../lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../lab/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/select2.css">
<script type="text/javascript" src="../lab/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/jquery-ui.min.css">
<script type="text/javascript">

</script>
<script type="text/javascript">
document.getElementById('hocvien').classList.add("active");
document.getElementById('nhaphocvien').classList.add("active");
$("#dialog").hide();
$(document).ready(function() {
    $('#banglophoc').DataTable({
	  "scrollY": "300px",
	  "scrollCollapse": true,
	  "paging": false,
	  "scrollX": true,
	  "ordering": false
	});
} );
$('#chonkhoahoc').select2({
  width: '100%'
});

$(document).on('click','#banglophoc td',function(){
	 $(this).css('background-color','#fff');
	var td = $(this);
	$('#banglophoc').find('td').find('input[type=text]').map(function(){
		if(td.find('input[type=text]')!=$(this)){
			var input = $(this).val();
			$(this).parent().html(input);
		}
	});
	if($(td).attr('ly')=='stt'){
		return 0;
	}else if($(td).find('input[type=text]').attr('ly')!='onhap'){
		var chuoi = '';
		chuoi = $(td).text().trim();
		$(td).html("<input type='text' ly='onhap' class='form-control onhap'>");
		$(td).find('input[type=text]').focus().val(chuoi);
	}
});
$(document).on('keyup','input[type=text]',function(e){
    if(e.keyCode == 13)
    {
		var input = $(this).val();
		$(this).parent().html(input);
    }
});
$(document).on('click','#banglophoc .xoadong',function(){
	$("#banglophoc").DataTable().row( $(this).parents('tr') ).remove().draw();
});
$(document).on('change','#chonkhoahoc',function(){
	if ($(this).val()=='taokhoahoc') {
		$('#modalthemkhoahoc').modal('show');
	}
});
$(document).on('click','#btnthemkhoahoc',function(){
	var khoahoc = $('#tenkhoahoc').val();
	var batdau = $('#batdau').val();
	var ketthuc = $('#ketthuc').val();
	if (jQuery.isEmptyObject(khoahoc)) {
		tbdanger('Nhập tên khoá học');
		return;
	}
	$.ajax({
		url: 'aj/ajThemnhanhkhoahoc.php',
		type: 'POST',
		data: {
			khoahoc:khoahoc,
			batdau:batdau,
			ketthuc:ketthuc
		},
		success: function (data) {
			$('#khungkhoahoc').empty();
			$('#khungkhoahoc').html(data);
		},
		error: function(){
			tbdanger('Lỗi, Vui lòng thử lại!');
		}
	});
});

$(document).on('click','.luuthongtin',function(){
	var khoahoc = $('#chonkhoahoc').val();
	$("#banglophoc").DataTable().search("").draw();
	if (jQuery.isEmptyObject(khoahoc)||khoahoc=='0'||khoahoc=='taokhoahoc') {
		tbdanger('Vui lòng chọn khóa học');
		return 0;
	}
	$('#banglophoc').find('input[type=text]').map(function(){
		if(find('input[type=text]')!=$(this)){
			var input = $(this).val();
			$(this).parent().html(input);
		}
	});
	var bhv = [];      
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  $(this).find('td:not(:first,:last)').each(function(i, col) {
	      cols.push($(this).text().trim());
	  });
	  bhv.push(cols);
	});
	if (jQuery.isEmptyObject(bhv)) {
		tbdanger('Danh sách học viên rỗng');
		return 0;
	}
	// kiểm tra CMND
	var banghvloi = [];
	for(var o = 0; o < bhv.length; o++){
		var kiemtra = 0;
		for(var p = o+1; p < bhv.length-1; p++){
			if(bhv[o][3]==bhv[p][3] && o!=p){
				kiemtra = 1;
				banghvloi.push(bhv[p][3]);
			}
		}
	}
	var demloicmnd = 0;
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  $(this).find('td:not(:first,:last)').each(function(i, col) {
		for(var o = 0; o < banghvloi.length; o++){
	      if($(this).text().trim()==banghvloi[0]){
	      	$(this).css('background-color','red');
	      	++demloicmnd;
	      }
		}
	  });
	});
	$('#loicmnd').text('0');
	if (demloicmnd>0) {
		$('#loicmnd').text(demloicmnd);
		$( "#dialog" ).dialog();
		tbdanger("Ôi! Lỗi");
		return 0;
	}
	$.ajax({
		url: 'aj/ajNhapthanhvienvaocsdl.php',
		type: 'POST',
		data: {
			khoahoc:khoahoc,
			bhv:bhv,
			tenkhoahoc: $("#chonkhoahoc option:selected").text().trim(),
			_token: '<?php echo $_SESSION['_token']; ?>'
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
				tbsuccess(kq.thongbao);
				setTimeout(function(){
			        location.reload();
			    }, 3000);
			}
			else{
				tbdanger(kq.thongbao);
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

$(document).on('click','#laydulieu',function(){
	var file_data = $('#fileexcel').prop('files')[0];
	if (jQuery.isEmptyObject(file_data)) {return 0;}
	var type = file_data.type;
	var match = ["application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
	if (type==match[0] || type==match[1]) {
	    var form_data = new FormData();
	    //thêm files vào trong form data
	    form_data.append('file', file_data);
        $.ajax({
            url: './aj/ajLaydulieusheethocvien.php', // gửi đến file upload.php
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            data: form_data,
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
            beforeSend: function () {
                tbinfo("Vui lòng chờ...");
            },
		    complete: function () {
		        $("#daluot").css("width","0%");
		    },
            success: function(data){
            	tban();
            	tbsuccess('Tải xong');
				$('#khungphancong').empty();
            	$('#khunghocvien').html(data);
			    $('#banglophoc').DataTable({
				  "scrollY": "300px",
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