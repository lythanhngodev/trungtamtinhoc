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
	                <h4>LỆ PHÍ HỌC</h4>
	                <h6>Quản lý lệ phí, học phí học viên theo khóa</h6>
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
						<div class="col-md-12"><p>(*) Sau khi nhập dữ liệu học phí từ Excel vui lòng chọn mục khóa học bên dưới để xem chi tiết học phí.</p></div>
					<div class="form-group col-md-3" style="float: left;">
						<label><b>Chọn khoá học</b></label>
						<select class="form-control" id="chonkhoahoclay">
							<option value="0">--- Chọn khoá học ---</option>
							<?php 
							$kh = laykhoahoc();
							while ($row = mysqli_fetch_assoc($kh)) { ?>
							<option value="<?php echo $row['IDKH'] ?>"><?php echo $row['TENKHOA'] ?></option>
							<?php }
							 ?>
						</select>
					</div>
						<div class="form-group col-md-4" style="float: left;">
							<label><b>Chọn file Excel</b></label>
							<input type="file" class="form-control" id="fileexcel">
						</div>
						<div class="form-group col-md-4" style="float: left;">
							<label style="width: 100%"><b>Lấy dữ liệu từ Excel</b></label>
							<button class="btn btn-dark" id="laydulieu">Lấy dữ liệu</button><br>
							<a href="../lab/e/mau-excel-4.xlsx" class="text-link text-dark"><i><u>Tải xuống file mẫu</u></i></a>
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
						<label><b>Xem chi tiết học phí từ khóa học</b></label>
						<select class="form-control" id="chonkhoahoc">
							<option value="0">--- Chọn khoá học ---</option>
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
					            <th>Họ &amp; Tên</th>
					            <th>Số CMND</th>
					            <th>Ngày sinh</th>
					            <th>Giới tính</th>
					            <th>Học phí</th>
					            <th>Số biên lai</th>
					            <th>Ngày biên lai</th>
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
document.getElementById('lephi').classList.add("active");
document.getElementById('lephihoc').classList.add("active");
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
	if($(this).val()=='0'){
		$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
		$('#khunghocvien').empty();
		return 0;
	}
	var khoahoc = $(this).val();
	$.ajax({
		url: 'aj/ajLaydanhsachlephitheokhoa.php',
		type: 'POST',
		beforeSend: function () {
                tbinfo("Vui lòng chờ...");
            },
		data: {
			khoahoc:khoahoc
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
			$('#khunghocvien').hide('fold',{percent: 50},500);
			$('#khunghocvien').empty();
			$('#khunghocvien').html(data);
			$('#khunghocvien').show('fold',{percent: 50},800);
		    $('#banglophoc').DataTable({
			  "scrollY": "400px",
			  "scrollCollapse": true,
			  "paging": false,
			  "scrollX": true,
			  "ordering": false
			});
		},
	    complete: function () {
		        $("#daluot").css("width","0%");
		},
		error: function(){
			tbdanger('Lỗi, Vui lòng thử lại!');
		}
	});
});

$(document).on('click','.luuthongtin',function(){
	$("#banglophoc").DataTable().search("").draw();
	$('#banglophoc').find('input[type=text]').map(function(){
		if(find('input[type=text]')!=$(this)){
			var input = $(this).val();
			$(this).parent().html(input);
		}
	});
	var bhv = [];      
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  var demcot=1;
	  $(this).find('td').each(function(i, col) {
	      if (demcot==1) {
	      	cols.push($(this).attr('idhvl'));
	      }
	      else{
	      	if (demcot>6) {
	      		cols.push($(this).text().trim());
	      	}
	      }
	      demcot++;
	  });
	  bhv.push(cols);
	});
	if (jQuery.isEmptyObject(bhv)) {
		tbdanger('Danh sách học viên rỗng');
		return 0;
	}
	$.ajax({
		url: 'aj/ajLuuthongtinhocphi.php',
		type: 'POST',
		data: {
			bhv:bhv,
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
	var khoahoc = $('#chonkhoahoclay').val();
	if (khoahoc=='0') {
		tbdanger('Chưa chọn khóa học');
		return;
	}
	var file_data = $('#fileexcel').prop('files')[0];
	if (jQuery.isEmptyObject(file_data)) {return 0;}
	var type = file_data.type;
	var match = ["application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
	if (type==match[0] || type==match[1]) {
	    var form_data = new FormData();
	    //thêm files vào trong form data
	    form_data.append('file', file_data);
	    form_data.append('khoahoc', khoahoc);
        $.ajax({
            url: './aj/ajLaydulieuhocphi.php', // gửi đến file upload.php
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
				var kq = $.parseJSON(data);
				if (kq.trangthai) {
					tbsuccess(kq.thongbao);
				}
				else{
					tbdanger(kq.thongbao);
				}
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