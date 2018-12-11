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
	                <h4>ĐÁNH SỐ BÁO DANH &amp; ĐIỀU CHỈNH THÔNG TIN THÍ SINH</h4>
	                <h6>Đánh số báo danh cho thí sinh theo từng đợt thi</h6>
	                <h6>Điều chỉnh thông tin thí sinh (họ tên, ngày sinh, ...)</h6>
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
<link rel="stylesheet" type="text/css" href="../lab/css/datatables.min.css">
<script src="../lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../lab/js/select2.full.min.js"></script>
<script type="text/javascript" src="../lab/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/select2.css">
<link rel="stylesheet" type="text/css" href="../lab/css/jquery-ui.min.css">
<script type="text/javascript">
document.getElementById('tochucthi').classList.add("active");
document.getElementById('danhsobaodanh').classList.add("active");
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
$(document).on('keyup','input[type=text]',function(e){
    if(e.keyCode == 13)
    {
		var input = $(this).val();
		$(this).parent().html(input);
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
$(document).on('change','#chondanhsach',function(){
	if($(this).val()=='0'){
		$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
		$('#khunghocvien').empty();
		return 0;
	}
	idds = $(this).val();
	$.ajax({
		url: 'aj/ajExLaydanhsachsobaodanh.php',
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
$(document).on('click','#danhsotudong',function(){
	var sbd = [];   
	var tiento = 'K';
	var sokhoa=1;
	if (!jQuery.isEmptyObject($('#sokhoa').val())) {
		sokhoa = parseInt($('#sokhoa').val());
		if (sokhoa<0||sokhoa>999) {
			tbdanger('Số kháo chỉ nhập lớn hơn 0 và bé hơn 999');
			return 0;
		}
	} 
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  $(this).find('td:nth-child(3)').each(function(i, col) {
	      if(!jQuery.isEmptyObject($(this).text().trim())){
	      	sbd.push(parseInt($(this).text().split('CB')[1]));
	      	tiento=$(this).text().split('CB')[0];
	      }
	  });
	});
	var sobatdau=0;
	if (!jQuery.isEmptyObject(sbd)) {
		sbd=sbd.sort(function(a,b){return b-a});
		sobatdau = sbd[0];
	}
	// tạo tiền tố
	if (sokhoa.toString().length==3) {
		tiento+=sokhoa.toString();
	}else if (sokhoa.toString().length==2){
		tiento+='0'+sokhoa.toString();
	}else if (sokhoa.toString().length==1){
		tiento+='00'+sokhoa.toString();
	}
	// đánh số báo danh cho ô trống
	var sbddadanh=0;
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  $(this).find('td:nth-child(3)').each(function(i, col) {
	      if(jQuery.isEmptyObject($(this).text().trim())){
	      	var soke = '';
	      	++sobatdau;
			if (sobatdau.toString().length==3) {
				soke+=sobatdau.toString();
			}else if (sobatdau.toString().length==2){
				soke+='0'+sobatdau.toString();
			}else if (sobatdau.toString().length==1){
				soke+='00'+sobatdau.toString();
			}
	      	$(this).text(tiento+'CB'+soke);
	      	$(this).css('background','yellow');
	      	sbddadanh++;
	      }
	  });
	});
	tbsuccess('Đã đánh '+sbddadanh+' SBD');
});
$(document).on('click','#resetsbd',function(){
	$("#banglophoc").DataTable().search("").draw();
	$('#banglophoc').find('input[type=text]').map(function(){
		if(find('input[type=text]')!=$(this)){
			var input = $(this).val();
			$(this).parent().html(input);
		}
	});
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  $(this).find('td:nth-child(3)').each(function(i, col) {
	      if(!jQuery.isEmptyObject($(this).attr('sbd'))){
	      	$(this).text($(this).attr('sbd'));
	      	$(this).css('background','none');
	      }else{
	      	$(this).text('');
	      	$(this).css('background','red');
	      }
	      
	  });
	});
});
$(document).on('click','#deletesbd',function(){
	$("#banglophoc").DataTable().search("").draw();
	$('#banglophoc').find('input[type=text]').map(function(){
		if(find('input[type=text]')!=$(this)){
			var input = $(this).val();
			$(this).parent().html(input);
		}
	});
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  $(this).find('td:nth-child(3)').each(function(i, col) {
      	$(this).text('');
      	$(this).css('background','red');
	  });
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
	  $(this).find('td:nth-child(3)').each(function(i, col) {
	      if($(this).text().trim()==''){
	      	$(this).css('background','red');
	      }else{
	      	$(this).css('background','none');
	      }
	  });
	});
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  $(this).find('td:not(:first)').each(function(i, col) {
	      cols.push($(this).text().trim());
	  });
	  bhv.push(cols);
	});
	var rongsbd=0;
	jQuery.map(bhv,function(i){
		if(i[1]=='' || jQuery.isEmptyObject(i[1])) ++rongsbd;
	});
	if (rongsbd>0) {
		tbdanger('Còn '+rongsbd+' thí sinh chưa có SBD');
		return 0;
	}
	var sbdtest = bhv[0][1].split('CB')[0];
	for(var i=1;i<bhv.length;i++){
		if (sbdtest!=bhv[i][1].split('CB')[0]) {
			tbdanger('SBD đánh chưa đồng bộ, kiểm tra lại');
			return 0;
		}
	}
	$.ajax({
		url: 'aj/ajLuusobaodanh.php',
		type: 'POST',
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