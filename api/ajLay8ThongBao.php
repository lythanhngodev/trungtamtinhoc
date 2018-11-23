<?php
  require_once '../_xl_.php'; 
  $tb = laythongbao();
  while ($ro = mysqli_fetch_assoc($tb)) { ?>
<style type="text/css">
.baicohinhanh .hinhcon{
    width: 100px;
    height: 100px;
    float: left;
    background-position: center;
    background-size: cover;
    border-radius: 10px;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    position: relative;
}
.hinhconct{
    width: 80px;
    height: 80px;
    float: left;
    background-position: center;
    background-size: cover;
    border-radius: 10px;
    margin-right: 1rem;
}
#danhsachhinh{
  padding: 0;
  margin: 0;
  white-space: nowrap;
}
#danhsachhinh a,.baicohinhanh a{
  display: inline-table;
  text-decoration: none;
  text-align: center;
}

    </style>
<div class="row" style="margin: 0;">
  <div class="col-md-3 col-sm-2 col-lg-3"></div>
    <div class="col-md-6 col-sm-8 col-lg-6">
      <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <span class="username" style="margin-left: 0;"><a href="XemThongBao.php?id=<?php echo $ro['IDBV'] ?>&link=<?php echo $ro['LINK'] ?>"><?php echo $ro['TENTB']; ?></a></span>
                <span class="description" style="margin-left: 0;"><i class='fa fa-comments'></i>&ensp;<?php echo $ro['NGUOIDANG'] ?>&ensp;&ensp;<?php echo "<i class='fa fa-calendar'></i>&ensp;".date_format(date_create_from_format('Y/m/d', $ro['NGAYDANG']), 'd-m-Y'); ?>&ensp;&ensp;<i class="fa fa-eye"></i>&ensp;<?php echo $ro['LUOTXEM'] ?></span>
              </div>
              <!-- /.user-block -->
            </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- post text -->
          <p><?php echo $ro['MOTA']; ?></p>
          <div class="baicohinhanh" style="float: left;margin: 0.22rem;bottom: 0;width: 100%;white-space: nowrap;overflow: auto;">
              <?php $hinh = layhinhthongbao($ro['IDBV']);
              while ($r=mysqli_fetch_assoc($hinh)) { ?>
                <a><div class="hinhcon" style="background-image:url('<?php echo $ttth['HOST']."/".$r['HINHANH'] ?>')" data="<?php echo $ttth['HOST']."/".$r['HINHANH'] ?>"></div></a>
              <?php } ?>
          </div>
          <a class="pull-right text-muted" href="XemThongBao.php?id=<?php echo $ro['IDBV'] ?>&link=<?php echo $ro['LINK'] ?>">Xem thêm</a>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  <div class="col-md-3 col-sm-2 col-lg-3"></div>
</div>
  <?php } ?>