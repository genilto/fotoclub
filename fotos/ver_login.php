<?
require_once "conexao.php";
$logado = "sim";

if($login_type == 0){
	//Verifica se o usuario esta logado usando sessoes 1
	if (isset($HTTP_SESSION_VARS["login_usuario"]) && isset($HTTP_SESSION_VARS["senha_usuario"])) {
    	$login_usuario = $HTTP_SESSION_VARS["login_usuario"];
    	$senha_usuario = $HTTP_SESSION_VARS["senha_usuario"];
	}else{
		$logado = "não";
	} 

	if(!empty($login_usuario) || !empty($senha_usuario)){
		$sql = "SELECT * FROM user WHERE username = '".$login_usuario."';";
		$resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
		$contar = mysqli_num_rows($resultado);
		$listar = mysqli_fetch_assoc($resultado);
		
		if ($contar > 0){
			if ($senha_usuario != md5($listar["senha"])){
				unset ($HTTP_SESSION_VARS["login_usuario"]);
				unset ($HTTP_SESSION_VARS["senha_usuario"]);
				$logado = "não";
			} 
		}else{
			unset ($HTTP_SESSION_VARS["login_usuario"]);
			unset ($HTTP_SESSION_VARS["senha_usuario"]);
			$logado = "não";
		}
	}else{
		$logado = "não";
	}
}elseif($login_type == 1){
	//Verifica se o usuario esta logado usando sessoes 2
	
	if (isset($_SESSION["login_usuario"]) && isset($_SESSION["senha_usuario"])) {
    	$login_usuario = $_SESSION["login_usuario"];
    	$senha_usuario = $_SESSION["senha_usuario"];
	}else{
		$logado = "não";
	} 
	
	if(!empty($login_usuario) || !empty($senha_usuario)){
		$sql = "SELECT * FROM user WHERE username = '".$login_usuario."';";
		$resultado = mysqli_query($conexao, $sql) or die ("<b>ver_login.php</b><br> ".mysqli_error($conexao));
		$contar = mysqli_num_rows($resultado);
		$listar = mysqli_fetch_assoc($resultado);
		
		if ($contar > 0){
			if ($senha_usuario != md5($listar["senha"])){
				unset ($_SESSION["login_usuario"]);
				unset ($_SESSION["senha_usuario"]);
				$logado = "não";
			} 
		}else{
			unset ($_SESSION["login_usuario"]);
			unset ($_SESSION["senha_usuario"]);
			$logado = "não";
		}
	}else{
		$logado = "não";
	}
}else{
	if($login_type == 2){
		//Verifica se o usuario esta logado usando cookies
		if (isset($HTTP_COOKIE_VARS["login_usuario"]) && isset($HTTP_COOKIE_VARS["senha_usuario"])) {
			$login_usuario = $HTTP_COOKIE_VARS["login_usuario"];
			$senha_usuario = $HTTP_COOKIE_VARS["senha_usuario"];
		}else{
			$logado = "não";
		} 
	}else{
		//Verifica se o usuario esta logado usando cookies
		if (isset($_COOKIE["login_usuario"]) && isset($_COOKIE["senha_usuario"])) {
			$login_usuario = $_COOKIE["login_usuario"];
			$senha_usuario = $_COOKIE["senha_usuario"];
		}else{
			$logado = "não";
		}
	}
	if(!empty($login_usuario) || !empty($senha_usuario)){
		$sql = "SELECT * FROM user WHERE username = '".$login_usuario."';";
		$resultado = mysqli_query($conexao, $sql) or die ("<b>ver_login.php</b><br> ".mysqli_error($conexao));
		$contar = mysqli_num_rows($resultado);
		$listar = mysqli_fetch_assoc($resultado);
		
		if ($contar > 0){
			if ($senha_usuario != md5($listar["senha"])){
				setcookie("login_usuario");
				setcookie("senha_usuario");
				$logado = "não";
			} 
		}else{
			setcookie("login_usuario");
			setcookie("senha_usuario");
			$logado = "não";
		}
	}else{
		$logado = "não";
	}
}
?>