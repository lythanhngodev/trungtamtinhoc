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
	                <h4>THÍ SINH ĐĂNG KÝ DỰ THI</h4>
	                <h6>Lập danh sách thí sinh đăng ký dự thi</h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="form-group col-md-6" id="khungkhoahoc">
						<label><b>Chọn khoá học</b></label>
						<select class="form-control" id="lochocvien">
							<option value="0">--- Chọn khoá học ---</option>
							<?php 
							$kh = laykhoahoc();
							while ($row = mysqli_fetch_assoc($kh)) { ?>
							<option value="<?php echo $row['IDKH'] ?>"><?php echo $row['TENKHOA'] ?></option>
							<?php }
							 ?>
						</select>
					</div>
				</div>
				<div id="khungchonhocvien"></div>
			</div>
		</div>
		<div class="col-md-6">
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
							<option value="<?php echo $row['IDDS'] ?>"><?php echo $row['TENDS'].' - '.$row['LOAITHI'] ?></option>
							<?php }
							 ?>
						</select>
					</div>
					<div class="form-group col-md-6" style="float: left;">
						<label style="width: 100%;float: left;"><b>Nhập từ Excel</b></label>
						<input type="file" id="dulieufile" class="form-control" style="width: 70%;float: left;"> 
						<button class="btn btn-dark" id="laydulieu" style="width: 25%;float: left;margin-left: 4px;">Nhập</button><br>
						<a href="./lab/e/mau-excel-1.xlsx" class="text-link text-dark" style="float: right;"><i><u>Tải xuống file mẫu</u></i></a>
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
      	<div class="form-group">
      		<label>Loại đợt thi</label>
      		<select id="loaithi" class="form-control">
      			<?php 
      			$loaikhoa = layloaikhoa();
      			while ($row = mysqli_fetch_assoc($loaikhoa)) { ?>
      			<option value="<?php echo $row['TENLK'] ?>"><?php echo $row['TENLK'] ?></option>
      			<?php } ?>
      		</select>
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
document.getElementById('tochucthi').classList.add("active");
document.getElementById('thisinhdangkyduthi').classList.add("active");
$(document).ready(function() {
    $('#banglophoc').DataTable({
	  "scrollY": "300px",
	  "scrollCollapse": true,
	  "paging": false,
	  "scrollX": true,
	  "ordering": false
	});
} );

$('#chonkhoahoc, #chondanhsach, #khoahocchon, #lochocvien').select2({
  width: '100%'
});
$(document).on('click','#banglophoc .xoadong',function(){
      $("#banglophoc").DataTable().row( $(this).parents('tr') ).remove().draw();
});
$(document).on('change','#lochocvien',function(){
	var khoahoc = $('#lochocvien').val();
	$.ajax({
		url: 'aj/ajLochocvientukhoa.php',
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
			tban();
			tbsuccess('Tải xong');
			$('#khungchonhocvien').hide(367);
			$('#khungchonhocvien').empty();
			$('#khungchonhocvien').show(667 );
			$('#khungchonhocvien').html(data);
		    $('#banghocvien').DataTable({
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
$(document).on('change','#chonkhoahoc',function(){
	if ($(this).val()=='0') {
		$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
		$('#khunghocvien').empty();
		return 0;
	}else{
	$.ajax({
		url: 'aj/ajLaydanhsachhocvientukhoa.php',
		type: 'POST',
		data: {
			khoahoc:$(this).val()
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
		beforeSend: function () {
                tbinfo("Vui lòng chờ...");
            },
		success: function (data) {
			$('#khunghocvien').hide( 367 );
			$('#khunghocvien').empty();
			$('#khunghocvien').html(data);
			$('#khunghocvien').show( 667 );
		    $('#banglophoc').DataTable({
			  "scrollY": "300px",
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
	}
});
$(document).on('click','.checkall',function(){
	if($(this).is(':checked')){
		$('[type="checkbox"]').each(function(){
			$(this).prop('checked',true);
		});
	}
	else{
		$('[type="checkbox"]').each(function(){
			$(this).prop('checked',false);
		});
	}
});
$(document).on('click','.themvaokhoathi',function(){
	if ($('#banglophoc').length==0) {
		tbdanger('Lỗi! Vui lòng chọn đợt thi ở cột kế bên trước');
		return 0;
	}
	var bhv = [];
	var dulieu = $('#banglophoc').DataTable().rows().data();
	dulieu.map(function(d){
		bhv.push(d[0]);
	});

	var bc = [];      
	$('#banghocvien').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  $(this).find('td:first,input').each(function(i, col) {
	      if ($(this).is(':checked')) {
	      	cols.push($(this).parent('td').attr('idhv'));
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(2)').text());
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(3)').text());
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(4)').text());
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(6)').text());
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(7)').text());
	      	cols.push($(this).parent('td').attr('khoa'));
	      	bc.push(cols);
          }
	  });
	});
	var oo = [];
	for(var i=0;i<bc.length;i++){
		var kthv = 0
		for(var j=0;j<bhv.length;j++){
			if (bc[i][0]==bhv[j]) {
				kthv = 1;
			}
		}
		(kthv==0) ? oo.push(bc[i]) : "";
	}
	var t = $('#banglophoc').dataTable();
	oo.map(function(data){
	    var row = t.fnGetNodes(t.fnAddData([data[0],data[1],data[2],data[3],data[4],data[5],'HVTTK'+data[6],'<span class="text-danger xoadong">xóa</span>']));
	    $(row).find('td:nth-child(1)').attr('hidden','hidden');
	});
});
$(document).on('click','#btnthemdotthi',function(){
	var tendot = $('#tendot').val();
	var batdau = $('#batdau').val();
	var ketthuc = $('#ketthuc').val();
	var khoahoc = $('#khoahocchon').val();
	var loaithi = $('#loaithi').val();
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
			khoahoc: khoahoc,
			loaithi:loaithi
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
$(document).on('click','.luuthongtin',function(){
	$("#banglophoc").DataTable().search("").draw();
	var dotthi = $('#chondanhsach').val();
	if (jQuery.isEmptyObject(dotthi)) {
		tbdanger('Chưa chọn đợt thi');
		return 0;
	}
	var bhv = [];
	var dulieu = $('#banglophoc').DataTable().rows().data();
	dulieu.map(function(d){
		var dong = [];dong.push(d[0]);dong.push(d[6]);
		bhv.push(dong);
	});
	if (jQuery.isEmptyObject(bhv)) {
		tbdanger('Danh sách học viên rỗng');
		return 0;
	}
	$.ajax({
		url: 'aj/ajLuuthisinhdangkyduthi.php',
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
			bhv:bhv,
			idds:dotthi
		},
		success: function (data) {
			var kq = $.parseJSON(data);
			if (kq.trangthai) {
				tbsuccess('Đã lưu');
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
	$.ajax({
		url: 'aj/ajLaydanhsachhocvientudanhsach.php',
		type: 'POST',
		beforeSend: function () {
                tbinfo("Vui lòng chờ...");
            },
		data: {
			danhsach:$(this).val()
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
			$('#khunghocvien').html(data);
		    $('#banglophoc').DataTable({
			  "scrollY": "300px",
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
$(document).on('click','#laydulieu',function(){
	if (!$('#banglophoc').length) {
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
        $.ajax({
            url: './aj/ajLaydulieudangkythi.php', // gửi đến file upload.php
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
            	var d = $.parseJSON(data);
            	if ($.isEmptyObject(d)) {
            		tbdanger('File không có dữ liệu');
            	}else{
            		console.log(d);
					var bhv = [];
					var dulieu = $('#banglophoc').DataTable().rows().data();
					dulieu.map(function(d){
						bhv.push(d[0]);
					});
					var oo = [];
					for(var i=0;i<d.length;i++){
						var kthv = 0
						for(var j=0;j<bhv.length;j++){
							if (d[i][8]==bhv[j]) {
								kthv = 1;
							}
						}
						(kthv==0) ? oo.push(d[i]) : "";
					}
					var t = $('#banglophoc').dataTable();
					oo.map(function(data){
					    var row = t.fnGetNodes(t.fnAddData([data[8],data[0]+' '+data[1],data[2],data[3],data[5],data[6],data[7],'<span class="text-danger xoadong">xóa</span>']));
					    $(row).find('td:nth-child(1)').attr('hidden','hidden');
					});
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