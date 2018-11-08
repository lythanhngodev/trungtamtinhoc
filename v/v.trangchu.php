<div class="background-container container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
	                <h4>PHẦN MỀM QUẢN LÝ TRUNG TÂM TIN HỌC - VLUTE</h4>
	                <hr>
	                <h6>
					    <?php
					    /* This sets the $time variable to the current hour in the 24 hour clock format */
					    $time = date("H");
					    /* Set the $timezone variable to become the current timezone */
					    $timezone = date("e");
					    /* If the time is less than 1200 hours, show good morning */
					    if ($time < "12") {
					        echo "Chào buổi sáng";
					    } else
					    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
					    if ($time >= "12" && $time < "14") {
					        echo "Chào buổi trưa";
					    } else
					    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
					    if ($time >= "14" && $time < "17") {
					        echo "Chào buổi chiều";
					    } else
					    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
					    if ($time >= "17" && $time < "19") {
					        echo "Chào buổi tối";
					    } else
					    /* Finally, show good night if the time is greater than or equal to 1900 hours */
					    if ($time >= "19") {
					        echo "Chúc ngủ ngon";
					    }
					    ?>
	                </h6>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		        <div class="col-md-3">
					<center>
			            <div class="card" style="background-color: #fff !important;">
			              <div class="card-body">
			                <a href="?p=hocvien" class="col-12"><img src="./lab/i/hocvien.png"></a>
			              </div>
			              <div class="card-header">
			                <h4>Học viên</h4>
			              </div>
			            </div>
					</center>
		        </div>
		        <div class="col-md-3">
					<center>
			            <div class="card" style="background-color: #fff !important;">
			              <div class="card-body">
			                <a href="?p=thisinhphongthi" class="col-12"><img src="./lab/i/hoso.png"></a>
			              </div>
			              <div class="card-header">
			                <h4>Phòng thi</h4>
			              </div>
			            </div>
					</center>
		        </div>
		        <div class="col-md-3">
					<center>
			            <div class="card" style="background-color: #fff !important;">
			              <div class="card-body">
			                <a href="?p=nhaphocvien" class="col-12"><img src="./lab/i/nhaphocvien.png"></a>
			              </div>
			              <div class="card-header">
			                <h4>Nhập học viên</h4>
			              </div>
			            </div>
					</center>
		        </div>
		        <div class="col-md-3">
					<center>
			            <div class="card" style="background-color: #fff !important;">
			              <div class="card-body">
			                <a href="?p=diem" class="col-12"><img src="./lab/i/bangdiem.png"></a>
			              </div>
			              <div class="card-header">
			                <h4>Điểm</h4>
			              </div>
			            </div>
					</center>
		        </div>
			</div>	
</div>
<div style="position: fixed;margin-bottom: 0;left: 0;right:0;bottom: 0;height: 20px;width: 100%;background: #232323;color: #adadad;line-height: 20px;font-size: 90%;padding-left: 1rem;font-family: monospace;text-align: center;">© Copyright of Ngô Thanh Lý (Faculty of Information Technology 2014) | Phone: (+84) 794 967 197</div>
<script type="text/javascript" src="./lab/js/bootstrap.min.js"></script>