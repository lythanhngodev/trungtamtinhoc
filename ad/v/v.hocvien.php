<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<style type="text/css">
	input[type="checkbox"]{
		    transform: scale(2);
	}
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
</style>
<div class="background-container container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
	                <h4>HỌC VIÊN</h4>
	                <h6>Các học viên hiện có hồ sơ ở trung tâm</h6>
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
							<label><b>Chọn khoá học</b></label>
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
						<div class="form-group col-md-4" style="float: left;">
							<label><b>Chọn lớp học</b></label>
							<select class="form-control" id="chonlophoc">
								<option value="0">--- Chọn lớp học ---</option>
								<?php 
								$lh = laylophoc();
								while ($row = mysqli_fetch_assoc($lh)) { ?>
								<option value="<?php echo $row['IDL'] ?>"><?php echo $row['TENLOP'] ?></option>
								<?php }
								 ?>
							</select>
						</div>
						<div class="form-group col-md-4" style="float: left;">
							<label><b>Xem kết quả</b></label><br>
							<button class="btn btn-dark" id="xemhocvien">Xem danh sách học viên</button>
						</div>
						<div class="form-group col-md-4" style="float: left;">
							<label><b>Xem tất cả học viên</b></label><br>
							<button class="btn btn-dark" id="xemtatcahocvien">Xem tất cả học viên</button>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="col-md-12">
			<br>
			<div class="card">
				<div class="col-md-12">
					<table class="table" border="0">
						<tr>
							<th colspan="2">THÔNG TIN CHUNG</th>
						</tr>
						<tr>
							<th style="width: 100px;">Khóa học:</th>
							<td id="tenkhoahoc"></td>
						</tr>
						<tr>
							<th>Lớp học:</th>
							<td id="tenlophoc"></td>
						</tr>
					</table>
				</div>
				<div class="card-body" id="khunghocvien">
	                <table id="banglophoc" class="table table-hover" style="width: 100%;">
	                    <thead>
	                        <tr  class="text-center">
	                        	<th>#</th>
	                            <th>TT</th>
	                            <th>SBD</th>
	                            <th>MSSV</th>
	                            <th>Họ</th>
	                            <th>Tên</th>
	                            <th>CMND</th>
	                            <th>Ngày sinh</th>
	                            <th>Giới tính</th>
	                            <th>Nơi sinh</th>
	                            <th>SĐT</th>
	                            <th>Số biên lai</th>
	                            <th>Ngày biên lai</th>
	                            <th>Ghi chú</th>
	                        </tr>
	                    </thead>
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
					    	<li><b><i>Thao tác trên bảng học viên</i></b>
					    		<dl>
					    			<dd>- Để chỉnh sửa thông tin học viên nhấp chuột vào ô cần chỉnh sữa. Hoàn thành chỉnh sửa bằng cách ấn phím <b>Enter</b></dd>	
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
<link rel="stylesheet" type="text/css" href="../lab/css/datatables.min.css">
<script src="../lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../lab/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/select2.css">
<script type="text/javascript" src="../lab/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/jquery-ui.min.css">
<?php 
$khoahoc = laykhoahoc();
$kh = [];
$_stt=0;
while ($row=mysqli_fetch_assoc($khoahoc)) {
	$kh[$_stt]=$row['IDKH'];
	++$_stt;
}
$lophoc = laylophoc();
$lh = [];
$_stt=0;
while ($row=mysqli_fetch_assoc($lophoc)) {
	$lh[$_stt]=[$row['IDL'],$row['IDKH'],$row['TENLOP']];
	++$_stt;
}
 ?>
<script type="text/javascript">
document.getElementById('hocvien').classList.add("active");
document.getElementById('hocvien1').classList.add("active");
var khoahoc = <?php echo json_encode($kh) ?>;
var lophoc = <?php echo json_encode($lh) ?>;

$(document).ready(function() {
    $('#banglophoc').DataTable({
	  "scrollY": "400px",
	  "scrollCollapse": true,
	  "paging": false,
	  "scrollX": true,
	  "ordering": false,
	  "LengthMenu": false
	});
} );
$('#chonlophoc, #chonkhoahoc').select2({
  width: '100%'
});
$(document).on('change','#chonkhoahoc',function(){
	$("#chonlophoc option[value!='0']").map(function() {
	    $(this).remove();
	});
	var kh = $(this).val();
	lophoc.map(function(c){
		if (kh==c[1]) {
			$('#chonlophoc').append("<option value='"+c[0]+"'>"+c[2]+"</option>");
		}
	});
});
$(document).on('click','#xemhocvien',function(){
	$('#tenkhoahoc,#tenlophoc').text('');
	var khoahoc = $('#chonkhoahoc').val();
	var lophoc = $('#chonlophoc').val();
	if (jQuery.isEmptyObject(lophoc) || lophoc=='0') {
		tbdanger('Chưa chọn lớp học');
		return 0;
	}
	$('#tenkhoahoc').text(($('#chonkhoahoc').val()!='0') ? $('#chonkhoahoc :selected').text() : '');
	$('#tenlophoc').text(($('#chonlophoc').val()!='0') ? $('#chonlophoc :selected').text() : '');
	$.ajax({
		url: 'aj/ajLaydanhsachhocvien.php',
		type: 'POST',
		beforeSend: function () {
                tbinfo("Vui lòng chờ...");
        },
		data: {
			lophoc:lophoc
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
			tban();
			tbsuccess('Tải xong');
			$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
			$('#khunghocvien').empty();
			$('#khunghocvien').show( 'fold', {percent: 50}, 567 );
			$('#khunghocvien').html(data);
		    $('#banglophoc').DataTable({
			  "scrollY": "450px",
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
$(document).on('click','#xemtatcahocvien',function(){
	$.ajax({
		url: 'aj/ajLaytatcahocvien.php',
		type: 'POST',
		beforeSend: function () {
                tbinfo("Vui lòng chờ...");
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
			tban();
			tbsuccess('Tải xong');
			$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
			$('#khunghocvien').empty();
			$('#khunghocvien').show( 'fold', {percent: 50}, 567 );
			$('#khunghocvien').html(data);
		    $('#banglophoc').DataTable({
	    		"aLengthMenu": [15,20,40,50,100],
			  "scrollX": true
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
	  var dem = 0;
	  $(this).find('td').each(function(i, col) {
	  	if (dem==0) {
	  		cols.push($(this).attr('mahv'));
	  		cols.push($(this).attr('idds'));
	  		var dau = "0";
	  		if ($(this).find('input').is(':checked')) {dau="1"}
	  			cols.push(dau);
	  	}else{
	      cols.push($(this).text().trim());
	  	}
	  	dem++;
	  });
	  bhv.push(cols);
	});
	if (jQuery.isEmptyObject(bhv)) {
		tbdanger('Danh sách học viên rỗng');
		return 0;
	}

	$.ajax({
		url: 'aj/ajLuuhocvienvaocsdl.php',
		type: 'POST',
		data: {
			bhv:bhv,
			lop:$('#chonlophoc').val(),
			_token: '<?php echo $_SESSION['_token']; ?>'
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
				tbsuccess(kq.thongbao);
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
$(document).on('click','.luutatcathongtin',function(){
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
	  $(this).find('td').each(function(i, col) {
	      cols.push($(this).text().trim());
	  });
	  bhv.push(cols);
	});
	if (jQuery.isEmptyObject(bhv)) {
		tbdanger('Danh sách học viên rỗng');
		return 0;
	}

	$.ajax({
		url: 'aj/ajCapnhatthongtinhocvien.php',
		type: 'POST',
		data: {
			bhv:bhv,
			_token: '<?php echo $_SESSION['_token']; ?>'
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
				tbsuccess(kq.thongbao);
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
</script>