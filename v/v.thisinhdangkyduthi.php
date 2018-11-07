<style type="text/css">
	#banglophoc input[type=text]{
	    border: 1px solid #2d93ff;
	    background: #f3f9ff;
	}
	.xoadong{
		cursor: pointer;
	}
</style>
<div class="background-container container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
	                <h4>THÍ SINH ĐĂNG KÝ DỰ THI</h4>
	                <h6>Lập danh sách thí sinh đăng ký dự thi</h6>
	                <h6 class="text-danger">Thí sinh sẽ được đánh số báo danh tự động sau khi tạo danh sách</h6>
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
						<label><b>Danh sách đã có trước đây</b></label>
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
					<div class="form-group col-md-3" id="khungkhoahoc" style="float:left;">
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

<?php 
$ds = laydanhsachdangkyduthi();
$_ds = [];
$_stt = 0;
while ($row = mysqli_fetch_assoc($ds)) {
	$_ds[$_stt] = $row['TENDS'];
	++$_stt;
} ?>

var danhsach = <?php echo json_encode($_ds) ?>;
$('#chonkhoahoc, #chondanhsach').select2({
  width: '100%'
});
$(document).on('click','#banglophoc .xoadong',function(){
  $(this).parents('tr').remove();
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
		beforeSend: function () {
                tbinfo("Vui lòng chờ...");
            },
		data: {
			khoahoc:$(this).val()
		},
		success: function (data) {
			$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
			$('#khunghocvien').empty();
			$('#khunghocvien').html(data);
			$('#khunghocvien').show( 'fold', {percent: 50}, 567 );
		}
	});
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
		$(td).html("<input type='text' ly='onhap' class='form-control'>");
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
	$('#banglophoc').find('input[type=text]').map(function(){
		if(find('input[type=text]')!=$(this)){
			var input = $(this).val();
			$(this).parent().html(input);
		}
	});
	var tendanhsach = $('#tendanhsach').val();
	if (jQuery.isEmptyObject(tendanhsach)) {
		return 0;
	}
	var ktds = 0;
	danhsach.map(function(v){
		if (v==tendanhsach) {
			tbdanger('Tên danh sách đã tồn tại!');
			ktds=1;
			return 0;
		}
	});
	if (ktds==1) {
		return 0;
	}
	var bhv = [];  
	var khoahoc = '';        
	$('#banglophoc').find('tr:not(:first)').each(function(i, row) {
	  var cols = [];
	  var demhv = 0;
	  $(this).find('td:not(:last)').each(function(i, col) {
	  	if (demhv==0) {cols.push($(this).attr('mahv'));khoahoc=$(this).attr('khoahoc');++demhv;}
	  });
	  bhv.push(cols);
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
		data: {
			bhv:bhv,
			tendanhsach:tendanhsach,
			tenkh:$('#chonkhoahoc :selected').text(),
			khoahoc:khoahoc
		},
		success: function (data) {
			$('body').append(data);
		}
	});
});
$(document).on('change','#chondanhsach',function(){
	if($(this).val()=='0'){
		$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
		$('#khunghocvien').empty();
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
		success: function (data) {
			$('#khunghocvien').hide( 'fold', {percent: 50}, 567 );
			$('#khunghocvien').empty();
			$('#khunghocvien').html(data);
			$('#khunghocvien').show( 'fold', {percent: 50}, 567 );
		}
	});
});
</script>