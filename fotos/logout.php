<?
include "conf.php";

if($login_type == 0){

	$HTTP_SESSION_VARS = array();
	session_destroy();

}elseif($login_type == 1){

	$_SESSION = array();
	session_destroy();

}else{

	setcookie("login_usuario");
	setcookie("senha_usuario");

}

header("Location: login.php?status=logout_ok");
?>