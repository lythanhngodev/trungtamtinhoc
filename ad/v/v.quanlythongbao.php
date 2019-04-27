<?php if (!isset($checkpage)) {echo "<h2>Đâu dễ phá vậy</2>";die();} ?>
<style type="text/css">
input[type="checkbox"]{
		 transform: scale(1.5);
	}
</style>
<div class="background-container">
	<div class="row">
		<div class="col-md-10" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
	                <h4>QUẢN LÝ THÔNG BÁO</h4>
	                <h6>Quản lý các thông báo của trung tâm</h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-10" style="margin: 0 auto;">
			<div class="card">
				<div class="card-body">
					<div class="col-md-12">
						<a class="btn btn-dark btn-sm" href="?p=themthongbao" ><i class="fa fa-plus"></i> Thêm mới</a>
					</div>
					<br>
              <table id="banglophoc" class="table table-hover table-bordered" >
                  <thead>
                      <tr>
                      	<th style="width: 90px;">Hiển thị</th>
                          <th class="text-center" style="width: 70px;">TT</th>
                          <th>Tên thông báo</th>
                          <th >Mô tả</th>
                          <th style="width: 120px;">Ngày đăng</th>
                          <th style="width: 100px;">#</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
                  $thongbao = laythongbao();
                  $stt = 1;
                  while ($row = mysqli_fetch_assoc($thongbao)) { ?>
                      <tr>
                      	<td class="text-center">
                      	<?php if ($row['HIENTHI']==0) {
                      		echo "<input type='checkbox' checked='checked' />";
                      	}else{
                      		echo "<input type='checkbox' />";
                      	}
                      	 ?></td>
                          <td class="text-center"><?php echo $stt; ?></td>
                          <td ><?php echo $row['TENTB']; ?></td>
                          <td ><?php echo $row['MOTA']; ?></td>
                          <td><?php echo $row['NGAYDANG'] ?></td>
                          <td><center><a class="btn btn-sm btn-dark" href="?p=suathongbao&id=<?php echo $row['IDBV'] ?>"><i class="fas fa-pencil-alt"></i></a>&ensp;<button class="btn btn-sm btn-dark xoathongbao" ly='<?php echo $row['IDBV'] ?>'><i class="fas fa-times"></i></button></center></td>
                      </tr>
                  <?php ++$stt;} ?>
                  </tbody>
              </table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalthem" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm lớp học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Tên lớp học</label>
      		<input type="text" id="tenlophoc" class="form-control" placeholder="Nhập tên lớp học ...">
      	</div>
      	<div class="form-group">
      		<label>Thuộc khoá học</label>
      		<select id="themkhoahoc" class="form-control">
      			<option value="0">--- Chọn khoá học ---</option>
      			<?php 
      			$khoahoc = laykhoahoc();
      			while ($row = mysqli_fetch_assoc($khoahoc)) { ?>
      			<option value="<?php echo $row['IDKH'] ?>">Khoá <?php echo $row['TENKHOA'] ?></option>
      			<?php } ?>
      		</select>
      	</div>
      	<div class="form-group">
      		<label>Diễn giải</label>
      		<input type="text" id="diengiai" class="form-control" placeholder="Nhập diễn giải ...">
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
        <button type="button" class="btn btn-dark" id="btnthemlophoc"><i class="fas fa-check"></i> Thêm</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalsua" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Điều chỉnh lớp học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Tên lớp học</label>
      		<input type="text" id="suatenlophoc" class="form-control" placeholder="Nhập tên lớp học ...">
      	</div>
      	<div class="form-group">
      		<label>Thuộc khoá học</label>
      		<select id="suakhoahoc" class="form-control" disabled="disabled" >
      			<option value="0">--- Chọn khoá học ---</option>
      			<?php 
      			$khoahoc = laykhoahoc();
      			while ($row = mysqli_fetch_assoc($khoahoc)) { ?>
      			<option value="<?php echo $row['IDKH'] ?>">Khoá <?php echo $row['TENKHOA'] ?></option>
      			<?php } ?>
      		</select>
      	</div>
      	<div class="form-group">
      		<label>Diễn giải</label>
      		<input type="text" id="suadiengiai" class="form-control" placeholder="Nhập diễn giải ...">
      	</div>
      	<input type="text" id="suaidl" hidden="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
        <button type="button" class="btn btn-primary" id="btnsualophoc">Điều chỉnh</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalxoa" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger">Điều gì xảy ra khi xóa thông báo?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Khi xóa <span><b id="xoatenbaiviet"></b></span>, thông báo sẽ xóa vĩnh viễn khỏi hệ thống. Bạn có chắc xóa nó?</label>
      	</div>
      	<input type="text" id="xoaidbv" hidden="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
        <button type="button" class="btn btn-danger" id="btnxoabaibao">Có, Xóa</button>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="../lab/css/datatables.min.css">
<script src="../lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lab/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../lab/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="../lab/css/select2.css">
<script type="text/javascript">
document.getElementById('thongbao').classList.add("active");
document.getElementById('quanlythongbao').classList.add("active");
$(document).ready(function() {
    $('#banglophoc').DataTable();
} );
$('#themkhoahoc, #suakhoahoc').select2({
  placeholder: '--- Chọn khoá học ---',
  width: '100%'
});
$(document).on('click','#btnxoabaibao',function(){
	$.ajax({
		url: 'aj/ajXoathongbao.php',
		type: 'POST',
		data: {
			id:$('#xoaidbv').val()
		},
		success: function (data) {
			var kq = $.parseJSON(data);
			if (kq.trangthai) {
				$('#modalxoa').modal('hide');
				tbsuccess('Đã xóa thông báo');
				setTimeout(function(){
			        location.reload();
			    }, 2000);
			}
			else{
				tbdanger('Lỗi!, Vui lòng thử lại sau');
			}
		},
		error: function(){
			tbdanger('Lỗi, Vui lòng thử lại!');
		}
	});
});
$(document).on('click','.xoathongbao', function(){
	$('#xoaidbv').val(($(this).attr('ly')));
	$('#xoatenbaiviet').text($(this).parent('center').parent('td').parent('tr').find('td:nth-child(3)').text().trim());
	$('#modalxoa').modal('show');
});
</script>