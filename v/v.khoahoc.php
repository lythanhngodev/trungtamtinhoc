<div class="background-container">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
	                    <center><h3>KHOÁ HỌC</h3></center>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="col-md-12">
						<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#basicExampleModal"><i class="fa fa-plus"></i> Thêm mới</button>
					</div>
					<br>
	                <table id="bangkhoahoc" class="table table-hover" >
	                    <thead>
	                        <tr>
	                            <th class="text-center">TT</th>
	                            <th>Tên khoá học</th>
	                            <th class="text-center">Tổng Lớp</th>
	                            <th>#</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                    $khoahoc = laykhoahoc();
	                    $stt = 1;
	                    while ($row = mysqli_fetch_assoc($khoahoc)) { ?>
	                        <tr>
	                            <td class="text-center"><?php echo $stt; ?></td>
	                            <td><?php echo $row['TENKHOA']; ?></td>
	                            <td class="text-center"><?php echo "0"; ?></td>
	                            <td><bunton class="btn btn-sm btn-primary">Sửa</bunton>&ensp;<bunton class="btn btn-sm btn-danger">Xoá</bunton></td>
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
<div class="modal fade" id="basicExampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm khoá học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Tên khoá học</label>
      		<input type="text" class="form-control">
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
        <button type="button" class="btn btn-primary">Hoàn tất</button>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="./lab/css/datatables.min.css">
<script src="./lab/js/datatables.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#bangkhoahoc').DataTable();
} );
</script>