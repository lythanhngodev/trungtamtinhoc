<style type="text/css">
	#banglophoc input[type=text]{
	    border: 1px solid #2d93ff;
	    background: #f3f9ff;
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

							<button class="btn btn-primary" id="laydulieu">Lấy dữ liệu</button>
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
						<label><b>Chọn khoá học</b></label>
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
					</div><hr style="width: 30%;">		
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
					<button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				    Xem Hướng dẫn &amp; Lưu ý
				  </button>
					<div class="collapse" id="collapseExample">
						<hr>
					    <ol>
					    	<li><b><i>File Excel:</i></b>
					    		<dl>
					    			<dd>- Ở mỗi sheet dữ liệu tương ứng 1 lớp học</dd>
					    			<dd>- Tên mỗi sheet tương ứng tên lớp</dd>
					    			<dd>- Vui lòng sắp xếp theo tên học viên ở các sheet theo thứ tự <b>A-Z</b></dd>
					    			<dd>- Ở mỗi sheet vị trí cố định của mỗi ô chính là cơ sở để hệ thống truy xuất dữ liệu, theo dõi bảng quy ước sau:<br>
					    				<table class="table table-bordered" style="width: 400px;">
					    					<tr style="background: #f1f1f1;">
					    						<th>Vị trí ô</th>
					    						<th>Ý nghĩa</th>
					    					</tr>
					    					<tr>
					    						<th>K1</th>
					    						<td>Tên lớp học</td>
					    					</tr>
					    					<tr>
					    						<th>M1</th>
					    						<td>Phòng học &amp; Thời gian học, ghi chú</td>
					    					</tr>
					    				</table>
					    			</dd>
					    		</dl>
					    	</li>
					    	<li><b><i>Thao tác trên bảng học viên</i></b>
					    		<dl>
					    			<dd>- Để chỉnh sửa thoogn tin học viên nhấp chuột vào ô cần chỉnh sữa. Haonfh thành chỉnh sửa bằng cách ấn phím <b>Enter</b></dd>	
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

<link rel="stylesheet" type="text/css" href="./lab/css/datatables.min.css">
<script src="./lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./lab/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="./lab/css/select2.css">

<script type="text/javascript">
document.getElementById('hocvien').classList.add("active");
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
		$(td).html("<input type='text' ly='onhap' class='form-control'>");
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
  $(this).parents('tr').remove();
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
		}
	});
});

$(document).on('click','.luuthongtin',function(){
	var bhv = [];          
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  $(this).find('td:not(:last)').each(function(i, col) {
	      cols.push($(this).text());
	  });
	  bhv.push(cols);
	});
	/*
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
		}
	});*/
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
	var khoahoc = $('#suakhoahoc').val();
	if (jQuery.isEmptyObject(lophoc)) {
		tbdanger('Nhập tên lớp học');
		return;
	}
	if (jQuery.isEmptyObject(khoahoc)||khoahoc==0) {
		tbdanger('Chọn khoá học');
		return;
	}
	$.ajax({
		url: 'aj/ajSualophoc.php',
		type: 'POST',
		data: {
			lophoc:lophoc,
			khoahoc:khoahoc,
			idl: $('suaidl').val()
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
		}
	});
});
$(document).on('click','#laydulieu',function(){
	var file_data = $('#fileexcel').prop('files')[0];
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
            beforeSend: function () {
                tbinfo("Vui lòng chờ...");
            },
            success: function(data){
            	$('#khunghocvien').empty();
            	$('#khunghocvien').html(data);
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