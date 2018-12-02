<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<div class="background-container">
	<div class="row">
		<div class="col-md-8" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
	                <h4>THÔNG TIN TÀI KHOẢN</h4>
	                <h6>Thông tin về tài khoản của bạn</h6>
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
		            <input type="text" class="form-control" id="sten" placeholder="Họ và tên" value="<?php echo $hotengv ?>">
		          </div>
		          <div class="form-group">
		            <label>Tên đăng nhập</label>
		            <input type="text" class="form-control" id="stdn" placeholder="Tên đăng nhập" value="<?php echo $tdn ?>">
		          </div>
		          <div class="form-group">
		            <label>Địa chỉ mail</label>
		            <input type="text" class="form-control" id="smail" placeholder="Địa chỉ mail" value="<?php echo $mail ?>">
		          </div>
		          <div class="form-group" style="text-align: center;">
		            <hr>
		            <button class="btn btn-primary" id="btn-sua">Lưu thông tin</button>
		          </div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<hr>
	<br>
	<div class="row">
		<div class="col-md-8" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
	                <h4>BẢO MẬT</h4>
	                <h6>Thay đổi mật khẩu</h6>
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
		            <label>Mật khẩu cũ</label>
		            <input type="password" class="form-control" id="smkc" placeholder="Mật khẩu cũ">
		          </div>
		          <div class="form-group">
		            <label>Mật khẩu mới</label>
		            <input type="password" class="form-control" id="smkm" placeholder="Mật khẩu mới">
		          </div>
		          <div class="form-group">
		            <label>Xác nhận mật khẩu mới</label>
		            <input type="password" class="form-control" id="smkm2" placeholder="Xác nhận mật khẩu mới">
		          </div>
		          <div class="form-group" style="text-align: center;">
		            <hr>
		            <button class="btn btn-primary" id="btn-doimatkhau">Đổi mật khẩu</button>
		          </div>
				</div>
			</div>
		</div>
	</div>
	<br>
</div>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>

<script type="text/javascript">
document.getElementById('thongtintaikhoan').classList.add("active");
$(document).on('click','#btn-sua',function(){
	var sten = $('#sten').val();
	var stdn = $('#stdn').val();
	var smail = $('#smail').val();
	if (jQuery.isEmptyObject(sten)) {
		tbdanger('Nhập tên');
		return;
	}
	if (jQuery.isEmptyObject(stdn)) {
		tbdanger('Nhập tên đăng nhập');
		return;
	}
	if (jQuery.isEmptyObject(smail)) {
		tbdanger('Nhập mail');
		return;
	}
	$.ajax({
		url: 'aj/ajSuathongtintaikhoan.php',
		type: 'POST',
		data: {
			ten:sten,
			tdn:stdn,
			mail:smail,
			id:'<?php echo $idgv ?>'
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
			console.log(data);
			if (kq.trangthai) {
				tbsuccess('Đã điều chỉnh thông tin');
				setTimeout(function(){
			        location.reload();
			    }, 2000);
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
$(document).on('click','#btn-doimatkhau',function(){
	var smkc = $('#smkc').val();
	var smkm = $('#smkm').val();
	var smkm2 = $('#smkm2').val();
	if (jQuery.isEmptyObject(smkc)) {
		tbdanger('Nhập mật khẩu cũ');
		return;
	}
	if (jQuery.isEmptyObject(smkm)) {
		tbdanger('Nhập mật khẩu mới');
		return;
	}
	if (jQuery.isEmptyObject(smail)) {
		tbdanger('Nhập mật khẩu xác nhận');
		return;
	}
	if (smkm!=smkm2) {
		tbdanger('Mật khẩu xác nhận chưa chính xác');
		return;
	}
	$.ajax({
		url: 'aj/ajSuamatkhau.php',
		type: 'POST',
		data: {
			mkc:smkc,
			mkm:smkm2,
			id:'<?php echo $idgv ?>'
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
				tbsuccess('Đã điều chỉnh mật khẩu');
				setTimeout(function(){
			        location.reload();
			    }, 2000);
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
</script>