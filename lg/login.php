<?php 
  header("X-Frame-Options: DENY");
  header("Content-Security-Policy: frame-ancestors 'none'", false);
	require_once '../__.php';
	session_start();
	$kn = new clsKetnoi();
	/*
   if(isset($_POST['g-recaptcha-response'])){
      $captcha = $_POST['g-recaptcha-response'];
   }
   if(!$captcha){
      $kn->golink($ttth['HOST']."/lg");
   }else{
      $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfUIoQUAAAAAI5BJ0dByFpYklozdetE4RU5Acsb&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
      if($response.success == false){
         $kn->golink($ttth['HOST']."/lg");
      } // nguoc lại không phai ro bot
   }*/
	if (!isset($_SESSION['_us']) || !isset($_SESSION['_pa'])) {
		if (!isset($_SESSION['_idus']) || !isset($_SESSION['_idpa'])) {
			$kn->golink($ttth['HOST']."/lg");
			die();
		}else{
			$_idus=$_SESSION['_idus'];
			$_idpa=$_SESSION['_idpa'];
			if (isset($_POST[$_idus]) && isset($_POST[$_idpa])) {
		    	if($kn->checklogin($_POST[$_idus], $_POST[$_idpa])!="admin")
		    		$kn->golink($ttth['HOST']."/lg");
		        else if($kn->checklogin($_POST[$_idus], $_POST[$_idpa])=="admin"){
		        	$_SESSION['_us'] = $_POST[$_idus];
		        	$_SESSION['_pa'] = md5($_POST[$_idpa]);
		            $kn->golink($ttth['HOST']."/ad");
		            die();
		        }
			}
			else{
				$kn->golink($ttth['HOST']."/lg");
				die();
			}
		}
	}else{
    	if($kn->checklogin($_SESSION['_us'], $_SESSION['_pa'])!="admin")
    		$kn->golink($ttth['HOST']."/lg");
        else if($kn->checklogin($_SESSION['_us'], $_SESSION['_pa'])=="admin"){
            $kn->golink($ttth['HOST']."/ad");
            die();
        }
	}
 ?>