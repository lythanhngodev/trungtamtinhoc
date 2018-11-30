<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<style type="text/css">
	#banglophoc input[type=text]{
	    border: 1px solid #2d93ff;
	    background: #f3f9ff;
	}
	.xoadong{
		cursor: pointer;
	}
	#bangphongthi td{
		padding: 4px !important;
	}
</style>
<div class="background-container container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
	                <h4>QUẢN LÝ PHÒNG THI &AMP; THÍ SINH</h4>
	                <h6>Lập danh sách phòng thi cho thí sinh đã đăng ký dự thi</h6>
	                <h6>Xuất word các tài liệu có liên quan</h6>
	                <h6 class="text-danger">Thí sinh sẽ được đánh số báo danh tự động sau khi tạo phòng thi</h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<center><br>
					<div class="form-group col-md-3">
						<label><b>Chọn danh sách thí sinh đã đã đăng ký thi</b></label>
						<select class="form-control" id="chondanhsach">
							<option value="0">--- Chọn danh sách ---</option>
							<?php 
							$ds = laydanhsachdangkyduthi();
							while ($row = mysqli_fetch_assoc($ds)) { ?>
							<option value="<?php echo $row['IDDS'] ?>"><?php echo $row['TENDS'].' - '.$row['LOAITHI'] ?></option>
							<?php }
							 ?>
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
<div class="modal fade" id="modallapphongthi" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  	<form action="./ex/xuatdanhsachphongthi.php" method="POST" target="_blank">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lập phòng thi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Từ <b><span id="sohocvien"></span></b> học viên chia làm <b><span id="sophong"></span></b> phòng.</p>
        <p>Vui lòng điền đầy đủ thông tin các phòng bên dưới</p>
        <p class="text-danger">Khi tạo danh sách SBD thí sinh sẽ được đánh lại từ đầu và đánh tự động.</p>
      	<table class="table table-bordered" id="bangphongthi">
      		<tr>
      			<th>Tên phòng gợi nhớ</th>
      			<th>Tên phòng thực tế</th>
      		</tr>
      	</table>
      	<input type="text" hidden="hidden" name="idds" id="iddanhsach">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning" id="btnxuatdanhsachphongthi"><i class="fas fa-file-word"></i> Lưu &amp; Xuất DS phòng thi</button>
      </div>
      </form>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="../lab/css/datatables.min.css">
<script src="../lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../lab/js/select2.full.min.js"></script>
<script type="text/javascript" src="../lab/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/select2.css">
<link rel="stylesheet" type="text/css" href="../lab/css/jquery-ui.min.css">
<script type="text/javascript">
document.getElementById('tochucthi').classList.add("active");
document.getElementById('thisinhphongthi').classList.add("active");
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
}

?>
var danhsach = <?php echo json_encode($_ds) ?>;

$('#chondanhsach').select2({
  width: '100%'
});
var idds ='';
$(document).on('change','#chondanhsach',function(){
	if($(this).val()=='0'){
		$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
		$('#khunghocvien').empty();
		return 0;
	}
	idds = $(this).val();
	$.ajax({
		url: 'aj/ajExLaydanhsachhocvientudanhsach.php',
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
			tban();
			tbsuccess('Đã tải');
			$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
			$('#khunghocvien').empty();
			$('#khunghocvien').show( 'fold', {percent: 50}, 867 );
			$('#khunghocvien').html(data);
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
$(document).on('click','.xuatdanhsachphongthi',function(){
	$('#bangphongthi').empty();
	var bhv = [];      
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  var dem = 0;
	  $(this).find('td').each(function(i, col) {
	      cols.push($(this).text().trim());
	  });
	  bhv.push(cols);
	});
	var tong = Math.ceil(bhv.length/20);
	var tt = 1;
	$('#sohocvien').text(bhv.length);
	$('#sophong').text(tong);
	$('#iddanhsach').val(idds);
	$.ajax({
		url: 'aj/ajLaydanhsachphongthi.php',
		type: 'POST',
		data: {
			danhsach:idds,
			tong:tong
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
			$('#bangphongthi').empty();
			$('#bangphongthi').append("<tr class='text-center'><th>Số TT phòng</th><th>Tên phòng thực tế</th><th>Ngày thi</th></tr>");
			$('#bangphongthi').append(data);
		},
	    complete: function () {
		        $("#daluot").css("width","0%");
		},
		error: function(){
			tbdanger('Lỗi, Vui lòng thử lại!');
		}
	});
	$('#modallapphongthi').modal('show');
});
$(document).on('click','#btnxuatdanhsachphongthi',function(){

});
</script>