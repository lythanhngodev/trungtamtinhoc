<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<style type="text/css">
	#banglophoc input[type=text]{
	    border: 1px solid #2d93ff;
	    background: #f3f9ff;
	}
.ui-autocomplete { position: absolute; cursor: default;z-index:999999 !important;} 
</style>
<style type="text/css">
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
	                <h4>PHÂN CÔNG GIẢNG DẠY</h4>
	                <h6>Phân công giảng dạy theo từng khóa</h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<center><br>
					<div class="form-group col-md-3" id="khungkhoahoc">
						<label><b>Chọn khoá học</b><br><i>Chọn khóa học cho các học viên này</i></label>
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
				<div class="card-body" id="khungphancong">
	                <table id="bangphancong" class="table table-hover display nowrap" style="width: 100%">
	                    <thead>
							<tr style="text-align: center;">
								<th>Mã lớp</th>
								<th>GV giảng dạy</th>
					            <th>Từ ngày</th>
					            <th>Đến ngày</th>
								<th>Buổi dạy</th>
								<th>Địa điểm</th>
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
					    	<li><b><i>Thao tác trên bảng phân công</i></b>
					    		<dl>
					    			<dd>- Để chỉnh sửa thông tin nhấp chuột vào ô cần chỉnh sữa. Hoàn thành chỉnh sửa bằng cách ấn phím <b>Enter</b></dd>	
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

<link rel="stylesheet" type="text/css" href="../lab/css/datatables.min.css">
<script src="../lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../lab/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/select2.css">
<script type="text/javascript" src="../lab/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/jquery-ui.min.css">
<script type="text/javascript">
<?php 
$cb = laydanhsachcanbo();
$_cb = [];
$_stt = -1;
while ($row = mysqli_fetch_assoc($cb)) {
	$_cb[++$_stt] = $row['TENCB'];
}
$dsp = laydanhsachphong();
$_dsp = [];
$_sttp = 0;
while ($rowp = mysqli_fetch_assoc($dsp)) {
	$_dsp[$_sttp] = $rowp['DIADIEM'];
	++$_sttp;
}
$cbbd = laydanhsachbuoiday();
$_dsbd = [];
$_sttbd = -1;
while ($rowbd = mysqli_fetch_assoc($cbbd)) {
	$_dsbd[++$_sttbd] = $rowbd['BUOIDAY'];
}
?>
</script>
<script type="text/javascript">
var canbo = <?php echo json_encode($_cb) ?>;
var diadiem = <?php echo json_encode($_dsp) ?>;
var buoiday = <?php echo json_encode($_dsbd) ?>;
document.getElementById('phanconggiangday').classList.add("active");
$(document).ready(function() {
    $('#bangphancong').DataTable({
	  "scrollCollapse": true,
	  "paging": false,
	});
} );
$('#chonkhoahoc').select2({
  width: '100%'
});
$(document).on('keyup','input[type=text]',function(e){
    if(e.keyCode == 13)
    {
		var input = $(this).val();
		$(this).parent().html(input);
    }
});
$(document).on('focus','.aucanbo',function(){
  $(this).autocomplete({
   minLength: 2,
   source: canbo
    });
});
$(document).on('focus','.aubuoiday',function(){
  $(this).autocomplete({
   minLength: 2,
   source: buoiday
    });
});
$(document).on('focus','.audiadiem',function(){
  $(this).autocomplete({
   minLength: 2,
   source: diadiem
    });
});
$(document).on('click','.luuphancong',function(){
	var bpc = [];      
	$('#bangphancong').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  $(this).find('td:first').each(function(i, col) {
	      cols.push($(this).attr('malop').trim());
	  });
	  $(this).find('td:not(:first)').each(function(i, col) {
	      cols.push($(this).find('input').val().trim());
	  });
	  bpc.push(cols);
	});
	$.ajax({
		url: 'aj/ajLuuphanconggiangday.php',
		type: 'POST',
		data: {
			bpc:bpc
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
$(document).on('change','#chonkhoahoc',function(){
	var khoahoc = $(this).val();
	$.ajax({
		url: 'aj/ajLaydanhsachphancong.php',
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
			$('#khungphancong').hide(500);
			$('#khungphancong').empty();
			$('#khungphancong').show(567);
			$('#khungphancong').html(data);
		    $('#banglophoc').DataTable({
			  "scrollCollapse": true,
			  "paging": false,
			  "ordering": false
			});
			$( ".ngayday" ).datepicker();
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