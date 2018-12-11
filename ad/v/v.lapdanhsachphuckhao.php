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
	                <h4>LẬP DANH SÁCH PHÚC KHẢO</h4>
	                <h6>Quản lý thông tin phúc khảo của thí sinh</h6>
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
						<label><b>Chọn đợt thi</b></label>
						<select class="form-control" id="lochocvien">
							<option value="0">--- Chọn đợt thi ---</option>
							<?php 
							$kh = laydanhsachdangkyduthi();
							while ($row = mysqli_fetch_assoc($kh)) { ?>
							<option value="<?php echo $row['IDDS'] ?>"><?php echo $row['TENDS']." - ".$row['LOAITHI'] ?></option>
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
					<div class="form-group col-md-12" id="khungchondanhsach" style="float: left;">
						<label><b>Đợt phúc khảo</b></label>
						<select class="form-control" id="chondanhsach">
							<option value="0">--- Chọn đợt phúc khảo ---</option>
							<option value="taodotthi">+++ Tạo đợt phúc khảo +++</option>
							<?php 
							$ds = laydanhsachphuckhao();
							while ($row = mysqli_fetch_assoc($ds)) { ?>
							<option value="<?php echo $row['IDPK'] ?>"><?php echo $row['TENPK'].' - '.$row['LOAITHI'] ?></option>
							<?php }
							 ?>
						</select>
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
<div class="modal fade" id="modaltaophuckhao" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tạo đợt phúc khảo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Tên đợt phúc khảo</label>
      		<input type="text" id="tendot" class="form-control" placeholder="Nhập tên đợt phúc khảo ...">
      	</div>
		<div class="form-group">
      		<label>Phúc khảo trong đợt thi</label>
			<select class="form-control" id="dotthichon">
				<?php 
				$ds = laydanhsachdangkyduthi();
				while ($row = mysqli_fetch_assoc($ds)) { ?>
				<option value="<?php echo $row['IDDS'] ?>"><?php echo $row['TENDS']." ".$row['LOAITHI'] ?></option>
				<?php }
				 ?>
			</select>
      	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" id="btnthemphuckhao"><i class="fas fa-check"></i> Thêm</button>
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
document.getElementById('phuckhao').classList.add("active");
document.getElementById('lapdanhsachphuckhao').classList.add("active");
$(document).ready(function() {
    $('#banglophoc').DataTable({
	  "scrollY": "300px",
	  "scrollCollapse": true,
	  "paging": false,
	  "scrollX": true,
	  "ordering": false
	});
} );

$('#chonkhoahoc, #chondanhsach, #dotthichon, #lochocvien').select2({
  width: '100%'
});
$(document).on('click','#banglophoc .xoadong',function(){
      $("#banglophoc").DataTable().row( $(this).parents('tr') ).remove().draw();
});
$(document).on('click','#banghocvien td',function(){
	var td = $(this);
	$('#banghocvien').find('td').find('input[type=text]').map(function(){
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
$(document).on('change','#lochocvien',function(){
	var danhsach = $('#lochocvien').val();
	$.ajax({
		url: 'aj/ajLaydanhthisinhdotthi.php',
		type: 'POST',
		beforeSend: function () {
                tbinfo("Vui lòng chờ...");
        },
		data: {
			danhsach:danhsach
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
			$('#khungchonhocvien').empty();
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
$(document).on('click','#checkall',function(){
	if($(this).is(':checked')){
		$('input[type="checkbox"]').each(function(){
			(!jQuery.isEmptyObject($(this).attr('chonhet')))?$(this).prop('checked',true):'';
		});
	}
	else{
		$('input[type="checkbox"]').each(function(){
			(!jQuery.isEmptyObject($(this).attr('chonhet')))?$(this).prop('checked',false):'';
		});
	}
});
$(document).on('click','.themvaokhoathi',function(){
	if ($('#banglophoc').length==0) {
		tbdanger('Lỗi! Vui lòng chọn đợt thi ở cột kế bên trước');
		return 0;
	}
	var bpk = []; // bảng phuc khảo   
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  $(this).find('td:first').each(function(i, col) {
	      	bpk.push($(this).text());
	  });
	});

	var bc = [];  // bảng chọn
	$('#banghocvien').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  $(this).find('td,input').each(function(i, col) {
	  	if ($(this).is(':checkbox') && !jQuery.isEmptyObject($(this).attr('chonhet')) && $(this).is(':checked')) {
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(2)').text());
	      	($(this).parent('td').parent('tr').find('td:nth-child(3)').find('input[type=checkbox]').is(':checked'))?
	      		cols.push(1):cols.push(0);
	      	($(this).parent('td').parent('tr').find('td:nth-child(4)').find('input[type=checkbox]').is(':checked'))?
	      		cols.push(1):cols.push(0);
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(5)').text());
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(6)').text());
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(7)').text());
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(8)').text());
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(9)').text());
	      	cols.push($(this).parent('td').parent('tr').find('td:nth-child(10)').text());
	      	bc.push(cols);
	  	}
	  });
	});
	var oo = [];
	for(var i=0;i<bc.length;i++){
		var kthv = 0;
		for(var j of bpk){
			(bc[i][0]==j)?kthv=1:'';
		}
		(kthv==0) ? oo.push(bc[i]) : '';
	}
	var t = $('#banglophoc').dataTable();
	oo.map(function(data){
	    var row = t.fnGetNodes(
	    	t.fnAddData(
	    		[data[0],
	    		(data[1])?"<input type='checkbox' checked='checked'>":"<input type='checkbox'>",
	    		(data[2])?"<input type='checkbox' checked='checked'>":"<input type='checkbox'>",
	    		data[3],
	    		data[4],
	    		data[5],data[6],
	    		data[7],
	    		data[8],
	    		'<span class="text-danger xoadong">xóa</span>']));
	    $(row).find('td:nth-child(1)').attr('hidden','hidden'); // ẩn IDDKTHV
	    $(row).find('td:nth-child(2)').attr('ly','stt');
	    $(row).find('td:nth-child(3)').attr('ly','stt');
	});
});
$(document).on('click','#btnthemphuckhao',function(){
	var tendot = $('#tendot').val();
	var dotthichon = $('#dotthichon').val();
	if (jQuery.isEmptyObject(tendot)) {
		tbdanger('Chưa nhập tên đợt phúc khảo');
		return 0;
	}
	$('#khungchondanhsach').empty();
	$.ajax({
		url: 'aj/ajTaodotphuckhao.php',
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
			dotthi:dotthichon
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
		tbdanger('Chưa chọn đợt phúc khảo');
		return 0;
	}
	var bhv=[];
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
		var cols=[];
	  $(this).find('td').first().each(function(i, col) {
	      	cols.push($(this).parent('tr').find('td:nth-child(1)').text());
	      	($(this).parent('tr').find('td:nth-child(2)').find('input[type=checkbox]').is(':checked'))?
	      		cols.push(1):cols.push(0);
	      	($(this).parent('tr').find('td:nth-child(3)').find('input[type=checkbox]').is(':checked'))?
	      		cols.push(1):cols.push(0);
	      	cols.push($(this).parent('tr').find('td:nth-child(7)').text());
	      	cols.push($(this).parent('tr').find('td:nth-child(8)').text());
	      	cols.push($(this).parent('tr').find('td:nth-child(9)').text());
	  });
	  bhv.push(cols);
	});
	if (jQuery.isEmptyObject(bhv)) {
		tbdanger('Danh sách học viên rỗng');
		return 0;
	}
	$.ajax({
		url: 'aj/ajLuuthisinhphuckhao.php',
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
			iddt:dotthi
		},
		success: function (data) {
			tban();
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
		$('#khunghocvien').empty();
		return 0;
	}
	if($(this).val()=='taodotthi'){
		$('#khunghocvien').empty();
		$('#modaltaophuckhao').modal('show');
		return 0;
	}
	$.ajax({
		url: 'aj/ajLaydanhsachthisingphuckhao.php',
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
		},
	    complete: function () {
		    $('#banglophoc').DataTable({
			  "scrollY": "300px",
			  "scrollCollapse": true,
			  "paging": false,
			  "scrollX": true,
			  "ordering": false
			});
		        $("#daluot").css("width","0%");
		},
		error: function(){
			tbdanger('Lỗi, Vui lòng thử lại!');
		}
	});
});
</script>