<?
include "config.php";

if($login_type == 0){
	$_SESSION = array();
	session_destroy();
}elseif($login_type == 1){
	$_SESSION = array();
	session_destroy();
}else{
	setcookie("login_administrador");
	setcookie("senha_administrador");
}
header("Location: login.php?info=Sua saída foi realizada com sucesso!");
?>