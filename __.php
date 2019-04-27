<?php 
$ttth = array(
	'HOST' => '',
	'HOSTCON' => ''
);

$gcof=parse_ini_file('lythanhngo.config.ltn');
$ttth['HOST'] = $gcof['h_name'];
$ttth['HOSTCON'] = $gcof['h_name_con'];

date_default_timezone_set('Asia/Ho_Chi_Minh');

error_reporting(0);

class clsKetnoi
{
	protected $conf;
	public $conn;
	private $maychu; 
	private $tendangnhap;
	private $matkhau;
	private $csdl;
	private $host; 
	function __construct()
	{
        global $gcof;
        $this->conf =& $gcof;
        $this->maychu = $this->conf['db_sever'];
        $this->tendangnhap = $this->conf['db_user'];
        $this->matkhau = $this->conf['db_password'];
        $this->csdl = $this->conf['db_name'];
        $this->host = $this->conf['h_name'];
		$this->conn=mysqli_connect($this->maychu, $this->tendangnhap, $this->matkhau);
		mysqli_select_db($this->conn, $this->csdl);
		mysqli_query($this->conn, "SET character_set_results=utf8");
		mb_language('uni');
		mb_internal_encoding('UTF-8');
		mysqli_query($this->conn, "set names 'utf8'");
	}
	function query($string){
		return mysqli_query($this->conn,$string);
	}
	function adddata($string){
		$qr = $this->query($string);
		$id = mysqli_insert_id($this->conn);
		return $id;
	}
	function editdata($string){
		if($this->query($string))
			return true;
		else
			return false;
	}
	function deletedata($string){
		if($this->query($string))
			return true;
		else
			return false;
	}
	function tontai($string){
		$qr = $this->query($string);
		$count = mysqli_num_rows($qr);
		if ($count>0)
			return true;
		else return false;
	}
	function golink($link){
		while (ob_get_status()) 
		{
		    ob_end_clean();
		}
		header("Location: $link");
	}
	function checklogin($tdn,$mk){
		$mk=strip_tags(md5($mk));
		$tdn=mysqli_real_escape_string($this->conn,strip_tags($tdn));
		if (!($this->tontai("SELECT * FROM taikhoan WHERE (BINARY TDN='$tdn') and (BINARY MK='$mk')"))) {
			ob_start();
			$this->golink($this->host."/lg");
		}
		else{
			$qr = $this->query("SELECT Q FROM taikhoan WHERE (BINARY TDN='$tdn') and (BINARY MK='$mk')");
			$result = mysqli_fetch_assoc($qr);
			return $result['Q'];
			}
		return "-1";
	}
	function checklogin_session($tdn,$mk){
		$mk=mysqli_real_escape_string($this->conn,strip_tags($mk));
		$tdn=mysqli_real_escape_string($this->conn,strip_tags($tdn));
		if (!($this->tontai("SELECT * FROM taikhoan WHERE (BINARY TDN='$tdn') and (BINARY MK='$mk')"))) {
			ob_start();
			$this->golink($this->host."/lg");
		}
		else{
			$qr = $this->query("SELECT Q FROM taikhoan WHERE (BINARY TDN='$tdn') and (BINARY MK='$mk')");
			$result = mysqli_fetch_assoc($qr);
			return $result['Q'];
			}
		return "-1";
	}
	function to_slug($str) {
	    $str = trim(mb_strtolower($str));
	    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
	    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
	    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
	    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
	    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
	    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
	    $str = preg_replace('/(đ)/', 'd', $str);
	    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
	    $str = preg_replace('/([\s]+)/', '-', $str);
	    $str = str_replace(' ', '', $str);
	    return $str;
	}
    function __destruct() {
        mysqli_close($this->conn);
    }
}
function chuoingaunhien($sokytu){
    $bangchucai = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $matkhauduoctao = array();
    $chieudaimang = strlen($bangchucai) - 1;
    for ($i = 0; $i < $sokytu; $i++) {
        $n = rand(0, $chieudaimang);
        $matkhauduoctao[] = $bangchucai[$n];
    }
    return implode($matkhauduoctao); //turn the array into a string
}
function chuoingaunhien_dacbiet($sokytu){
    $bangchucai = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_';
    $matkhauduoctao = array();
    $chieudaimang = strlen($bangchucai) - 1;
    for ($i = 0; $i < $sokytu; $i++) {
        $n = rand(0, $chieudaimang);
        $matkhauduoctao[] = $bangchucai[$n];
    }
    return implode($matkhauduoctao); //turn the array into a string
}
function chuoiid($sokytu){
    $bangchucai = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $matkhauduoctao = array();
    $chieudaimang = strlen($bangchucai) - 1;
    for ($i = 0; $i < $sokytu; $i++) {
        $n = rand(0, $chieudaimang);
        $matkhauduoctao[] = $bangchucai[$n];
    }
    return implode($matkhauduoctao); //turn the array into a string
}
function convert_number_to_words( $number )
{
	$hyphen = ' ';
	$conjunction = '  ';
	$separator = ' ';
	$negative = 'âm ';
	$decimal = ' phẩy ';
	$dictionary = array(
		0 => 'Không',
		1 => 'Một',
		2 => 'Hai',
		3 => 'Ba',
		4 => 'Bốn',
		5 => 'Năm',
		6 => 'Sáu',
		7 => 'Bảy',
		8 => 'Tám',
		9 => 'Chín',
		10 => 'Mười',
		11 => 'Mười một',
		12 => 'Mười hai',
		13 => 'Mười ba',
		14 => 'Mười bốn',
		15 => 'Mười năm',
		16 => 'Mười sáu',
		17 => 'Mười bảy',
		18 => 'Mười tám',
		19 => 'Mười chín',
		20 => 'Hai mươi',
		30 => 'Ba mươi',
		40 => 'Bốn mươi',
		50 => 'Năm mươi',
		60 => 'Sáu mươi',
		70 => 'Bảy mươi',
		80 => 'Tám mươi',
		90 => 'Chín mươi',
		100 => 'trăm',
		1000 => 'ngàn',
		1000000 => 'triệu',
		1000000000 => 'tỷ',
		1000000000000 => 'nghìn tỷ',
		1000000000000000 => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ'
	);

	if( !is_numeric( $number ) )
	{
		return false;
	}

	if( ($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX )
	{
		// overflow
		trigger_error( 'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING );
		return false;
	}

	if( $number < 0 )
	{
		return $negative . convert_number_to_words( abs( $number ) );
	}

	$string = $fraction = null;

	if( strpos( $number, '.' ) !== false )
	{
		list( $number, $fraction ) = explode( '.', $number );
	}

	switch (true)
	{
		case $number < 21:
			$string = $dictionary[$number];
			break;
		case $number < 100:
			$tens = ((int)($number / 10)) * 10;
			$units = $number % 10;
			$string = $dictionary[$tens];
			if( $units )
			{
				$string .= $hyphen . $dictionary[$units];
			}
			break;
		case $number < 1000:
			$hundreds = $number / 100;
			$remainder = $number % 100;
			$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
			if( $remainder )
			{
				$string .= $conjunction . convert_number_to_words( $remainder );
			}
			break;
		default:
			$baseUnit = pow( 1000, floor( log( $number, 1000 ) ) );
			$numBaseUnits = (int)($number / $baseUnit);
			$remainder = $number % $baseUnit;
			$string = convert_number_to_words( $numBaseUnits ) . ' ' . $dictionary[$baseUnit];
			if( $remainder )
			{
				$string .= $remainder < 100 ? $conjunction : $separator;
				$string .= convert_number_to_words( $remainder );
			}
			break;
	}

	if( null !== $fraction && is_numeric( $fraction ) )
	{
		$string .= $decimal;
		$words = array( );
		foreach( str_split((string) $fraction) as $number )
		{
			$words[] = $dictionary[$number];
		}
		$string .= implode( ' ', $words );
	}

	return ucfirst(strtolower($string));
}
function _token($sokytu){
    $bangchucai = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $matkhauduoctao = array();
    $chieudaimang = strlen($bangchucai) - 1;
    for ($i = 0; $i < $sokytu; $i++) {
        $n = rand(0, $chieudaimang);
        $matkhauduoctao[] = $bangchucai[$n];
    }
    return implode($matkhauduoctao); //turn the array into a string
}
function c_convert_vi($str) {
	/*Bước 1*/
	$map = array('1'=>array('à','ằ','ầ','è','ề','ì','ù','ừ','ò','ờ','ồ','ỳ'),
				'2'=>array('á','ắ','ấ','é','ế','í','ú','ứ','ó','ớ','ố','ý'),
				'3'=>array('ả','ẳ','ẩ','ẻ','ể','ỉ','ủ','ử','ỏ','ở','ổ','ỷ'),
				'4'=>array('ã','ẵ','ẫ','ẽ','ễ','ĩ','ũ','ữ','õ','ỡ','ỗ','ỹ'),
				'5'=>array('ạ','ặ','ậ','ẹ','ệ','ị','ụ','ự','ọ','ợ','ộ','ỵ')
				);
	$arrStr = explode(" ", $str);//Tach xau ngan cach nhau boi dau cach (" ")
	$tmpStr = "";
	
	for($i=0; $i<count($arrStr); $i++) {
		$subStr = $arrStr[$i];
		$tmpStr .= $subStr;
		$exist = false;
		foreach($map as $key => $subMap) {
			foreach ($subMap as $val) {
				if(strpos($subStr, $val) !== false) {//ton tai
					//Them key vao cuoi xau con
					$tmpStr .= $key;
					$exist = true;
					break;
				}
			}
			if($exist) {
				$exist = false;
				break;
			}
		}
		$tmpStr .= ' ';
	}
	$str = $tmpStr;
	/*Bước 2*/
	$map2 = array('à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a',	'ạ' => 'a',
				'ằ' => 'ă',	'ắ' => 'ă',	'ẳ' => 'ă',	'ẵ' => 'ă',	'ặ' => 'ă',
				'ầ' => 'â',	'ấ' => 'â',	'ẩ' => 'â',	'ẫ' => 'â',	'ậ' => 'â',		
				'è' => 'e',	'é' => 'e',	'ẻ' => 'e',	'ẽ' => 'e',	'ẹ' => 'e',
				'ề' => 'ê',	'ế' => 'ê',	'ể' => 'ê',	'ễ' => 'ê',	'ệ' => 'ê',
				'ì' => 'i',	'í' => 'i',	'ỉ' => 'i',	'ĩ' => 'i',	'ị' => 'i',
				'ò' => 'o',	'ó' => 'o',	'ỏ' => 'o',	'õ' => 'o',	'ọ' => 'o',	
				'ồ' => 'ô',	'ố' => 'ô',	'ổ' => 'ô',	'ỗ' => 'ô',	'ộ' => 'ô',		
				'ờ' => 'ơ',	'ớ' => 'ơ',	'ở' => 'ơ',	'ỡ' => 'ơ',	'ợ' => 'ơ',
				'ù' => 'u',	'ú' => 'u',	'ủ' => 'u',	'ũ' => 'u',	'ụ' => 'u',	
				'ừ' => 'ư', 'ứ' => 'ư',	'ử' => 'ư',	'ữ' => 'ư',	'ự' => 'ư',
				'ỳ' => 'y',	'ý' => 'y',	'ỷ' => 'y',	'ỹ' => 'y',	'ỵ' => 'y',								
	
				'À' => 'A', 'Á' => 'A', 'Ả' => 'A', 'Ã' => 'A',	'Ạ' => 'A',
				'Ằ' => 'Ă',	'Ắ' => 'Ă',	'Ẳ' => 'Ă',	'Ẵ' => 'Ă',	'Ặ' => 'Ă',
				'Ầ' => 'Â',	'Ấ' => 'Â',	'Ẩ' => 'Â',	'Ẫ' => 'Â',	'Ậ' => 'Â',		
				'È' => 'E',	'É' => 'E',	'Ẻ' => 'E',	'Ẽ' => 'E',	'Ẹ' => 'E',
				'Ề' => 'Ê',	'Ế' => 'Ê',	'Ể' => 'Ê',	'Ễ' => 'Ê',	'Ệ' => 'Ê',
				'Ì' => 'I',	'Í' => 'I',	'Ỉ' => 'I',	'Ĩ' => 'I',	'Ị' => 'I',
				'Ò' => 'O',	'Ó' => 'O',	'Ỏ' => 'O',	'Õ' => 'O',	'Ọ' => 'O',	
				'Ồ' => 'Ô',	'Ố' => 'Ô',	'Ổ' => 'Ô',	'Ỗ' => 'Ô',	'Ộ' => 'Ô',		
				'Ờ' => 'Ơ',	'Ớ' => 'Ơ',	'Ở' => 'Ơ',	'Ỡ' => 'Ơ',	'Ợ' => 'Ơ',
				'Ù' => 'U',	'Ú' => 'U',	'Ủ' => 'U',	'Ũ' => 'U',	'Ụ' => 'U',	
				'Ừ' => 'Ư', 'Ứ' => 'Ư',	'Ử' => 'Ư',	'Ữ' => 'Ư',	'Ự' => 'Ư',
				'Ỳ' => 'Y',	'Ý' => 'Y',	'Ỷ' => 'Y',	'Ỹ' => 'Y',	'Ỵ' => 'Y',
	);
	$keys2 = array_keys($map2);
	$vals2 = array_values($map2);
	$str = str_replace($keys2, $vals2, $str);
	/*Bước 3*/
	$map3 = array('a' => 'a0', 'ă' => 'a1',	'â' => 'a2',
				'e' => 'e0', 'ê' => 'e1',
				'o' => 'o0', 'ô' => 'o1', 'ơ' => 'o2',
				'u' => 'u0', 'ư' => 'u1',
				'đ' => 'dx',	
				
				'A' => 'A0', 'Ă' => 'A1', 'Â' => 'A2',
				'E' => 'E0', 'Ê' => 'E1',
				'O' => 'O0', 'Ô' => 'O1', 'Ơ' => 'O2',
				'U' => 'U0', 'Ư' => 'U1',
				'Đ' => 'Dx',
	);			
	$key3s = array_keys($map3);
	$val3s = array_values($map3);
	$str = str_replace($key3s, $val3s, $str);
	return $str;
}
//Hàm sắp xếp theo tên và Họ đệm
function sortArr($data) {
	//echo "vaoday";
	
	$firstName = array();
	$lastName = array();
  	foreach ($data as $key => $row) {	  		
		  $firstName[$key]  = $row['firstname'];//Họ đệm
		  $lastName[$key]  = $row['lastname'];//Tên		 			  	
  	}
  if(!empty($firstName) && !empty($lastName)) {
	//echo "vaotiep";
	  array_multisort($lastName, SORT_ASC, $firstName, SORT_ASC, $data);
	}
  return $data;
}
	
	//Hàm loại bỏ một phần tử trong mảng theo key
function traverseArray(&$array, $keys)
{ 
    foreach($array as $key=>&$value)
    { 
        if(is_array($value))
        { 
            traverseArray($value, $keys); 
        }else{
            if(in_array($key, $keys)){
                unset($array[$key]);
            }
        } 
    }
}
	//Hàm sắp xếp một mảng chứa họ tên đầy đủ
function sortFullName($listFullName=array()) {
	if(empty($listFullName)) return $listFullName;//Neu mảng trống thì trả về ngay và luôn
	$tmpListFullName = array();		
	foreach ($listFullName as $fullName) {			
		$tmpFullName = explode(" ", $fullName);//Tách họ tên đầy đủ thành các từ ngăn cách nhau bởi dấu cách, trả về một mảng
		$tmpLastName = $tmpFullName[count($tmpFullName)-1];//Tên
		$tmpFirstName = mb_substr($fullName, 0, mb_strlen($fullName) - mb_strlen($tmpLastName)-mb_strlen(" "));//Họ đệm
		$tmpLastName = c_convert_vi($tmpLastName);//Chuyển Tên sang mã mới
		$tmpFirstName = c_convert_vi($tmpFirstName);//Chuyển Họ đêm sang mã mới
		$tmpListFullName[] = array("fullname"=>$fullName, "firstname"=>$tmpFirstName, "lastname"=>$tmpLastName) ;			
	}
	$listFullName = sortArr($tmpListFullName);//Sắp xếp theo Tên, Họ đệm
	traverseArray($listFullName, array('firstname', 'lastname'));//Xóa phần từ firstname và lastname trong mảng listFullName
	$tmp = array();
	foreach($listFullName as $fullName) {
		$tmp[] = $fullName['fullname'];
	}
	return $tmp;
}
//mysqli_free_result($qr);
 ?>