<?php 
$json = file_get_contents("https://ems.vlute.edu.vn/api/sinhvien/1");
$row = json_decode($json, TRUE);
 ?>
 <table border="1" style="border-collapse: collapse;">
 	<tr>
 		<th>ID</th>
 		<th>MASV</th>
 		<th>HO</th>
 		<th>TEN</th>
 		<th>MA LOP CN</th>
 		<th>KHOAHOC</th>
 	</tr>
 	<?php 
for ($i=0; $i < count($row); $i++) { ?>
 	<tr>
 		<td><?php echo $row[$i]['id'] ?></td>
 		<td><?php echo $row[$i]['maSV'] ?></td>
 		<td><?php echo $row[$i]['ho'] ?></td>
 		<td><?php echo $row[$i]['ten'] ?></td>
 		<td><?php echo $row[$i]['maLopCN'] ?></td>
 		<td><?php echo $row[$i]['khoaHoc'] ?></td>
 	</tr>
<?php }
 ?>

 </table>