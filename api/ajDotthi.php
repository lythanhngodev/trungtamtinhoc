<?php 
error_reporting(0);
require_once '../_xl_.php';
$danhsach = laydotthi();
$ds = null;
while ($row = mysqli_fetch_row($danhsach)) {
	$ds[]=$row;
}
for ($i=0; $i < count($ds); $i++) { 
    for ($j=0; $j < count($ds[$i]); $j++) { 
        if ($ds[$i][$j]==null) {
            $ds[$i][$j] = '';
        }
    }
    $ds[$i][2]=date_format(date_create_from_format('Y-m-d', $ds[$i][2]), 'd/m/Y');
    $ds[$i][3]=date_format(date_create_from_format('Y-m-d', $ds[$i][3]), 'd/m/Y');
}
echo json_encode($ds);
 ?>