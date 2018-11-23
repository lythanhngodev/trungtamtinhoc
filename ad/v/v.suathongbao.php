<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<script src="../lab/ckeditor/ckeditor.js"></script>
<script src="../lab/ckfinder/ckfinder.js"></script> 
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
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
	                <h4>Sửa thông báo</h4>
	                <h6>Sửa thông báo dành cho mọi người</h6>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
                  <div class="col-md-12">
                        <div class="form-group">
                            <label for="tags" class="font-weight-bold" >
                                Tên thông báo</label>
                            <input type='text' class="form-control" id="tenthongbao" value="<?php echo $tb['TENTB'] ?>">
                        </div>
                  </div>
                  <div class="col-md-12">
                        <div class="form-group">
                            <label for="tags" class="font-weight-bold" >
                                Mô tả ngắn thông báo</label>
                            <textarea class="form-control" rows="5" id="motathongbao"><?php echo $tb['MOTA'] ?></textarea>
                        </div>
                  </div>
                  <div class="col-md-12">
                        <div class="form-group">
                            <label for="tags" class="font-weight-bold" >
                                Hình ảnh đính kèm</label>
                            <div class="row col-md-12" id="khunghinh">
                            <?php $hinh = layhinhthongbao($tb['IDBV']);
                            while ($r=mysqli_fetch_assoc($hinh)) { ?>
								<div class="hinhcon" style="background-image:url('<?php echo $ttth['HOST']."/".$r['HINHANH'] ?>')" data="<?php echo $r['HINHANH'] ?>"><i class="fa fa-times"></i></div>
                            <?php } ?>
                            </div>
                            <div class="row col-md-12" style="margin-top:1rem;">
								<div class="hinhanh" onclick="return duyetfile()">+</div>
                            </div>
                        </div>
                  </div>
                  <div class="col-md-12">
                        <div class="form-group">
                            <label for="tags" class="font-weight-bold" >
                                Nội dung tóm tắt</label>
                            <textarea class="form-control" rows="5" id="noidungthongbao"><?php echo $tb['NOIDUNG'] ?></textarea>
                        </div>
                  </div>
                  <hr>
                  <center><button class="btn btn-primary" id="luuthongbao">Lưu thông báo</button></center>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
<script type="text/javascript">
    CKEDITOR.replace( 'noidungthongbao', {
      filebrowserBrowseUrl : '../lab/ckfinder/ckfinder.html',
      filebrowserImageBrowseUrl : '../lab/ckfinder/ckfinder.html?type=Images',
      filebrowserFlashBrowseUrl : '../lab/ckfinder/ckfinder.html?type=Flash',
      filebrowserImageUploadUrl : '../lab/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
      filebrowserFlashUploadUrl : '../lab/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
</script>
<script src="../lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../lab/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/jquery-ui.min.css">
<script type="text/javascript">
document.getElementById('thongbao').classList.add("active");

$(document).on('click','#luuthongbao',function(){
	var tenthongbao = $('#tenthongbao').val();
	var motathongbao = $('#motathongbao').val();
	var	hinhanha = [];
	$('#khunghinh').find('div').each(function(){
		hinhanha.push(encodeURI($(this).attr('data')));
	});
	var noidungthongbao = CKEDITOR.instances['noidungthongbao'].getData();
	if (jQuery.isEmptyObject(tenthongbao)||jQuery.isEmptyObject(motathongbao)) {
		tbdanger('Vui lòng điền đầy đủ thông tin');
		return 0;
	}
	$.ajax({
		url: 'aj/ajSuathongbao.php',
		type: 'POST',
		data: {
			ten:tenthongbao,
			mota:motathongbao,
			noidung:noidungthongbao,
			id:'<?php echo $tb['IDBV'] ?>',
			hinh:hinhanha
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
$(document).on('click','#khunghinh .hinhcon .fa-times',function(){
	$(this).parent('.hinhcon').hide(500);
	var t = $(this);
	setTimeout(function(){
	        t.parent('.hinhcon').remove()
	    }, 500);
	});
</script>
<script type="text/javascript">
var finder = new CKFinder();
function duyetfile() {
    finder.selectActionFunction = SetFileField;
    finder.popup();
}
function SetFileField(fileUrl) {
    var host = "<?php echo $ttth['HOST']; ?>/";
    host = host.substr(0,host.lastIndexOf("\/"));
    var link = fileUrl.substr(host.length+1,fileUrl.length-host.length);
    var kt = 0;
	var div = "<div class='hinhcon' style=\"background-image:url('"+fileUrl+"')\" data='"+link+"'><i class='fa fa-times'></i></div>";
	$('#khunghinh').find('div').each(function(){
		($(this).attr('data')==link)?kt=1:'';
	});
	(kt==0)?$('#khunghinh').append(div):tbdanger('Bạn đã chọn hình này rồi');
}
</script>