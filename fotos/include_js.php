<?
include "conf.php";
$include = "N";

//Verifica $HTTP_COOKIE_VARS
if (isset($HTTP_COOKIE_VARS["exibir_js"])) {
   	$exibir_js = $HTTP_COOKIE_VARS["exibir_js"];
	if($exibir_js != ""){
		$include = "S";
	}
}else{
	//Verifica $HTTP_COOKIE_VARS
	if (isset($_COOKIE["exibir_js"])) {
   		$exibir_js = $_COOKIE["exibir_js"];
		if($exibir_js != ""){
			$include = "S";
		}
	}
}
setcookie("exibir_js");

if($include == "S"){
	
	$scripts = explode(";", $exibir_js);
	foreach($scripts as $nom_script){
		include $nom_script;
	}

}else{

	echo "alert('Não foi possível carregar o javascript.\\nSe o problema persistir por favor contate\\no administrador do sistema.');\n";
	echo "alert('$exibir_js');\n";
	echo "window.location='login.php';";

	/*
	include "script.js";	
	include "ajax.js";
	include "chat.js";
	include "funcoes.js";
	*/
}
?>