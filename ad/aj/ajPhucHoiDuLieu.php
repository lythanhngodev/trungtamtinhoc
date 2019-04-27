<?php 
sleep(1);
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$gcof_bk=parse_ini_file('../../lythanhngo.config.ltn');
if (!isset($_SESSION['_checkpage']) || (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')) {echo "<h2>Đâu dễ phá vậy</2>";die();}
require_once "../../__.php";
$ketqua = array('trangthai' => 0, 'thongbao' => '' ); 
$database = $gcof_bk['db_name'];
$user = $gcof_bk['db_user'];
$pass = $gcof_bk['db_password'];
$host = 'localhost';
$port = $gcof_bk['db_port'];
$my_sql = $gcof_bk['my_sql'];
$filename= time().'.sql';
$dir = dirname(__FILE__) .'\\..\\..\\backup\\'.$_POST['file'];

exec("{$my_sql} -h {$host} -u {$user} -p{$pass} {$database} < $dir");

 ?>

