<?php 
$ttth = array(
	'HOST' => 'http://localhost/trungtamtinhoc/'
);
date_default_timezone_set('Asia/Ho_Chi_Minh');
class clsKetnoi
{
	public $conn;
	private $maychu='localhost:3309';
	private $tendangnhap='root';
	private $matkhau='1234:)))';
	private $csdl='ttth';
	private $host="http://localhost/trungtamtinhoc/";
	function __construct()
	{
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
		if (!($this->tontai("SELECT * FROM taikhoan WHERE (BINARY TDN='$tdn') and (BINARY MK='$mk')"))) {
			ob_start();
			$this->golink($ttth['HOST']."Login");
		}
		else{
			$qr = $this->query("SELECT * FROM taikhoan WHERE (BINARY TDN='$tdn') and (BINARY MK='$mk')");
			$result = mysqli_fetch_assoc($qr);
			switch ($result['Q']) {
				case 'admin':
					$this->golink($this->host."Admin");
					break;
				case 'nhanvien':
					$this->golink($this->host."Nhanvien");
					break;
				default:
					$this->golink($this->host."Login");
					break;
			}
		}
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
//mysqli_free_result($qr);
 ?>