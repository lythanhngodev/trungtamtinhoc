<?php
/*Created by Pham Van Cong*/
/* Hàm function c_convert_vi($str)
	 * Bước 1
		- Kiểm tra xem từ trong câu có chứa dấu hay không, 
		- Nếu từ có chứa dấu (huyền, sắc, hỏi, ngã, nặng) thì thêm ký tự số (1, 2, 3 , 4, 5) vào sau mỗi từ
	 * Bước 2
		- Loại bỏ dấu
	 * Bước 3
		- Thay thế chuỗi bằng chuỗi mã hóa
	*/	
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
	
	//Test lại nhé
	$listFullName = array('Huỳnh Thái An','Nguyễn Thị Huyền An','Huỳnh Thái An','Lê Hoàng An');
	echo "First:";
	print_r($listFullName);
	echo "<br>";
	echo "After:";
	$listFullName = sortFullName($listFullName);
	print_r($listFullName);
?>