<?php 
	require_once '../__.php';
	session_start();
	$kn = new clsKetnoi();
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