<?php
	session_start();
	require_once "../__.php";
    $kn = new clsKetnoi();
    $idgv="";
    $hotengv="";
    if (isset($_SESSION['_us']) && isset($_SESSION['_pa']) && !empty($_SESSION['_us']) && !empty($_SESSION['_pa'])) {
    	if($kn->checklogin_session($_SESSION['_us'], $_SESSION['_pa'])!="admin")
    		$kn->golink($ttth['HOST']."/lg");
        else if($kn->checklogin_session($_SESSION['_us'], $_SESSION['_pa'])=="admin"){
            $sql = $kn->query("SELECT * FROM taikhoan WHERE (BINARY TDN='".$_SESSION['_us']."') and (BINARY MK='".$_SESSION['_pa']."') LIMIT 0,1");
            $row = mysqli_fetch_assoc($sql);
            $hotengv = $row['HT'];
            $idgv = $row['IDTK'];
            $_SESSION['_tencb'] = $hotengv;
        }
    }
    else{
    	$kn->golink($ttth['HOST']."/lg");
    }
?>