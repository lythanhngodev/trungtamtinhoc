<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<?php 
$data = array();
if ($handle = opendir('../backup')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
        	array_push($data, explode(".",$entry)[0]);
        }
    }
    closedir($handle);
}
 ?>
<div class="background-container">
	<div class="row">
		<div class="col-md-8" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
	                <h4>PHỤC HỒI DỮ LIỆU</h4>
	                <h6>Phục hồi dữ liệu hệ thống</h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-8" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
		          <div class="form-group">
		            <label>Tên nhân viên</label>
		            <select class="form-control" id="phienban">
		            	<option value="">--Chọn bản backup--</option>
					<?php 
					for ($i=count($data)-1; $i >= 0; $i--) { 
						echo "<option value='".$data[$i]."'>Ngày ".sosangngay($data[$i])."</option>";
					}
					 ?>
		            </select>
		          </div>
		          <div class="form-group" style="text-align: center;">
		            <hr>
		            <button class="btn btn-primary" id="btn-phuchoi">Phục hồi dữ liệu</button>
		          </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../lab/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/select2.css">
<script type="text/javascript">
$(function(){
	$('#phienban').select2({
	  width: '100%'
	});
})
$(document).on('click','#btn-phuchoi',function(){
	if (!$('#phienban').val()) {
		tbdanger('Chưa chọn phiên bản backup');
		return false;
	}
	var ck = confirm('Bạn có chắc chắn phục hồi dữ liệu? Dữ liệu hiện tại sẽ mất');
	if (ck) {
		$.ajax({
			url: 'aj/ajPhucHoiDuLieu.php',
			type: 'POST',
			data: {
				file:$('#phienban').val(),
			},
		    beforeSend: function() {
		        tbinfo('Đang hồi phục dữ liệu');
		    },
			success: function (data) {
				tban();
				tbsuccess('Phục hồi dữ liệu thành công');
			},
			error: function(){
				tbdanger('Lỗi, Vui lòng thử lại!');
			}
		});
	}
})
</script>