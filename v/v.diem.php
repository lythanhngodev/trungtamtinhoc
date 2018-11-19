<style type="text/css">
	#banglophoc input[type=text]{
	    border: 1px solid #2d93ff;
	    background: #f3f9ff;
	}
	.xoadong{
		cursor: pointer;
	}
	.odiem{
		background-color: #e1ffe3 !important;
	}
</style>
<div class="background-container container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
	                <h4>ĐIỂM THI</h4>
	                <h6>Thông tin điểm thi học viên</h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<center><br>
					<div class="form-group col-md-3" style="float:left;">
						<label><b>Các đợt thi đã tạo</b></label>
						<select class="form-control" id="chondanhsach">
							<option value="0">--- Chọn danh sách ---</option>
							<?php 
							$ds = laydanhsachdangkyduthi();
							while ($row = mysqli_fetch_assoc($ds)) { ?>
							<option value="<?php echo $row['IDDS'] ?>"><?php echo $row['TENDS'] ?></option>
							<?php }
							 ?>
						</select>
					</div>
					<div class="form-group col-md-3" id="khungphongthi" style="float:left;">
						<label><b>Chọn phòng thi</b></label>
						<select class="form-control" id="chonphongthi">
							<option value="0">--- Chọn phòng thi ---</option>
						</select>
					</div>
				</center>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body" id="khunghocvien">
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
<link rel="stylesheet" type="text/css" href="./lab/css/datatables.min.css">
<script src="./lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./lab/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="./lab/css/select2.css">
<script type="text/javascript" src="./lab/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="./lab/css/jquery-ui.min.css">
<script type="text/javascript">
document.getElementById('ketqua').classList.add("active");
document.getElementById('diem').classList.add("active");
$(document).ready(function() {
    $('#banglophoc').DataTable({
	  "scrollY": "300px",
	  "scrollCollapse": true,
	  "paging": false,
	  "scrollX": true,
	  "ordering": false
	});
} );

<?php 
$ds = laydanhsachdangkyduthi();
$_ds = [];
$_stt = 0;
while ($row = mysqli_fetch_assoc($ds)) {
	$_ds[$_stt] = $row['TENDS'];
	++$_stt;
} ?>

var danhsach = <?php echo json_encode($_ds) ?>;
$('#chonphongthi, #chondanhsach').select2({
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
		$(td).html("<input type='text' ly='onhap' class='form-control odiem onhap'>");
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
$(document).on('click','.luubangdiem',function(){
	$('#banglophoc').find('input[type=text]').map(function(){
		if(find('input[type=text]')!=$(this)){
			var input = $(this).val();
			$(this).parent().html(input);
		}
	});
	var bhv = [];       
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  var demhv = 0;
	  $(this).find('td').each(function(i, col) {
	  	if (demhv==0) {
	  		cols.push($(this).attr('idpt'));cols.push($(this).attr('idds'));cols.push($(this).attr('idhv'));cols.push($(this).attr('sbd'));
	  	}
	  	if(demhv>6){
	  		cols.push($(this).text().trim());
	  	}
	  	++demhv;
	  });
	  bhv.push(cols);
	});
	if (jQuery.isEmptyObject(bhv)) {
		tbdanger('Danh sách học viên rỗng');
		return 0;
	}
	$.ajax({
		url: 'aj/ajLuubangdiem.php',
		type: 'POST',
		beforeSend: function () {
                tbinfo("Vui lòng chờ...");
            },
		data: {
			bhv:bhv
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
				tban();
				tbsuccess('Đã lưu');
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
$(document).on('change','#chondanhsach',function(){
	if($(this).val()=='0'){
		$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
		$('#khunghocvien').empty();
		return 0;
	}
	var danhsach = $(this).val();
	$.ajax({
		url: 'aj/ajLaydanhsachhocvientudanhsachNhapDiem.php',
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
			$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
			$('#khunghocvien').empty();
			$('#khunghocvien').html(data);
			$('#khunghocvien').show( 'fold', {percent: 50}, 567 );
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
$(document).on('change','#chonphongthi',function(){
	if ($(this).val()=='0') {
		$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
		$('#khunghocvien').empty();
		return 0;
	}else{
	$.ajax({
		url: 'aj/ajLaydanhsachhocvientuPhongThiNhapDiem.php',
		type: 'POST',
		beforeSend: function () {
                tbinfo("Vui lòng chờ...");
            },
		data: {
			phongthi:$(this).val()
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
			$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
			$('#khunghocvien').empty();
			$('#khunghocvien').html(data);
			$('#khunghocvien').show( 'fold', {percent: 50}, 567 );
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
	}
});
$(document).on('click','#diemexcel',function(){
	var file_data = $('#dulieufile').prop('files')[0];
	if (jQuery.isEmptyObject(file_data)) {tbdanger('Chưa file nào được chọn');return 0;}
	var type = file_data.type;
	var match = ["application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
	if (type==match[0] || type==match[1]) {
	    var form_data = new FormData();
	    form_data.append('file', file_data);
        $.ajax({
            url: './aj/ajNhapdiemtuExcel.php',
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
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var demhv = 0;
	  var co = 0;
	  $(this).find('td:not(:first)').each(function(i, col) {
	  	if (demhv==0) {
	  		for(var n=0;n<d.length;n++){
	  			if ($(this).text()==d[n][0]) {
	  				$(this).parent('tr').find('td:nth-child(8)').text(d[n][1]);
	  				$(this).parent('tr').find('td:nth-child(9)').text(d[n][2]);
	  				$(this).parent('tr').find('td:nth-child(10)').text(d[n][3]);
	  			}
	  		}
	  	}
	  	demhv++;
	  });
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