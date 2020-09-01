<?php
include "config.php";

if($login_type == 0){
//Verifica se usuário esta logado
	if (isset($_SESSION["login_administrador"]) && isset($_SESSION["senha_administrador"])) {
    	$login_administrador = $_SESSION["login_administrador"];
    	$senha_administrador = $_SESSION["senha_administrador"];
	}else{
		unset ($_SESSION["login_administrador"]);
		unset ($_SESSION["senha_administrador"]);
		header("Location: login.php");
		exit();
	}
	if(!empty($login_administrador) || !empty($senha_administrador)){

		$sql = "SELECT * FROM administrador WHERE login = '".$login_administrador."';";
		$resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
		$contar = mysqli_num_rows($resultado);
		$listar = mysqli_fetch_assoc($resultado);
	
		if ($contar > 0){
   			if ($senha_administrador != md5($listar["senha"])){
				unset ($_SESSION["login_administrador"]);
				unset ($_SESSION["senha_administrador"]);
				header("Location: login.php?lugar=".$_SERVER['PHP_SELF']);
				exit();
			} 
		}else{
			unset ($_SESSION["login_administrador"]);
			unset ($_SESSION["senha_administrador"]);
			header("Location: login.php");
			exit();
		}
	}else{
		unset ($_SESSION["login_administrador"]);
		unset ($_SESSION["senha_administrador"]);
		header("Location: login.php");
		exit();
	}
}elseif($login_type == 1){
//Verifica outro tipo de sessão

	if (isset($_SESSION["login_administrador"]) && isset($_SESSION["senha_administrador"])) {
    	$login_administrador = $_SESSION["login_administrador"];
    	$senha_administrador = $_SESSION["senha_administrador"];
	}else{
		unset ($_SESSION["login_administrador"]);
		unset ($_SESSION["senha_administrador"]);
		header("Location: login.php");
		exit();
	}
	if(!empty($login_administrador) || !empty($senha_administrador)){

		$sql = "SELECT * FROM administrador WHERE login = '".$login_administrador."';";
		$resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
		$contar = mysqli_num_rows($resultado);
		$listar = mysqli_fetch_assoc($resultado);
	
		if ($contar > 0){
   			if ($senha_administrador != md5($listar["senha"])){
				unset ($_SESSION["login_administrador"]);
				unset ($_SESSION["senha_administrador"]);
				header("Location: login.php?lugar=".$_SERVER['PHP_SELF']);
				exit();
			} 
		}else{
			unset ($_SESSION["login_administrador"]);
			unset ($_SESSION["senha_administrador"]);
			header("Location: login.php");
			exit();
		}
	}else{
		unset ($_SESSION["login_administrador"]);
		unset ($_SESSION["senha_administrador"]);
		header("Location: login.php");
		exit();
	}

}elseif($login_type == 2){
//Verifica se está logado usando cookie 1

	if (isset($_COOKIE["login_administrador"]) && isset($_COOKIE["senha_administrador"])) {
    	$login_administrador = $_COOKIE["login_administrador"];
    	$senha_administrador = $_COOKIE["senha_administrador"];
	}else{
		setcookie("login_administrador");
		setcookie("senha_administrador");
		header("Location: login.php");
		exit();
	}
	if(!empty($login_administrador) || !empty($senha_administrador)){

		$sql = "SELECT * FROM administrador WHERE login = '".$login_administrador."';";
		$resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
		$contar = mysqli_num_rows($resultado);
		$listar = mysqli_fetch_assoc($resultado);
	
		if ($contar > 0){
   			if ($senha_administrador != md5($listar["senha"])){
				setcookie("login_administrador");
				setcookie("senha_administrador");
				header("Location: login.php?lugar=".$_SERVER['PHP_SELF']);
				exit();
			} 
		}else{
			setcookie("login_administrador");
			setcookie("senha_administrador");
			header("Location: login.php");
			exit();
		}
	}else{
		setcookie("login_administrador");
		setcookie("senha_administrador");
		header("Location: login.php");
		exit();
	}
}else{
//Verifica se está logado usando cookie 1

	if (isset($_COOKIE["login_administrador"]) && isset($_COOKIE["senha_administrador"])) {
    	$login_administrador = $_COOKIE["login_administrador"];
    	$senha_administrador = $_COOKIE["senha_administrador"];
	}else{
		setcookie("login_administrador");
		setcookie("senha_administrador");
		header("Location: login.php");
		exit();
	}
	if(!empty($login_administrador) || !empty($senha_administrador)){

		$sql = "SELECT * FROM administrador WHERE login = '".$login_administrador."';";
		$resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
		$contar = mysqli_num_rows($resultado);
		$listar = mysqli_fetch_assoc($resultado);
	
		if ($contar > 0){
   			if ($senha_administrador != md5($listar["senha"])){
				setcookie("login_administrador");
				setcookie("senha_administrador");
				header("Location: login.php?lugar=".$_SERVER['PHP_SELF']);
				exit();
			} 
		}else{
			setcookie("login_administrador");
			setcookie("senha_administrador");
			header("Location: login.php");
			exit();
		}
	}else{
		setcookie("login_administrador");
		setcookie("senha_administrador");
		header("Location: login.php");
		exit();
	}

}
?>