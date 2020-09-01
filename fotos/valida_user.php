<?php
require_once "conexao.php";
$opcao_pagina = "adm";

if($login_type == 0){
	if (isset($HTTP_SESSION_VARS["login_usuario"]) && isset($HTTP_SESSION_VARS["senha_usuario"])) {
		$login_usuario = $HTTP_SESSION_VARS["login_usuario"];
		$senha_usuario = $HTTP_SESSION_VARS["senha_usuario"];
	}else{
		header("Location: login.php?status=no_login");
		exit();
	}
	if(!empty($login_usuario) || !empty($senha_usuario)){

		$sql = "SELECT * FROM user WHERE username = '".$login_usuario."';";
		$resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
		$contar = mysqli_num_rows($resultado);
		$listar = mysqli_fetch_assoc($resultado);
		
		if ($contar == 1){
			
			if ($senha_usuario != md5($listar["senha"])){
				unset ($HTTP_SESSION_VARS["login_usuario"]);
				unset ($HTTP_SESSION_VARS["senha_usuario"]);
				header("Location: login.php?status=no_login");
				exit();
	 		} 
		}else{
			unset ($HTTP_SESSION_VARS["login_usuario"]);
			unset ($HTTP_SESSION_VARS["senha_usuario"]);
			header("Location: login.php?status=no_login");
			exit();
		}
	}else{
		header("Location: login.php?status=no_login");
		exit();
	}
}elseif($login_type == 1){
	// Valida se usuario esta logado usando sessao 2
	if (isset($_SESSION["login_usuario"]) && isset($_SESSION["senha_usuario"])) {
		$login_usuario = $_SESSION["login_usuario"];
		$senha_usuario = $_SESSION["senha_usuario"];
	}else{
		header("Location: login.php?status=no_login");
		exit();
	}
	if(!empty($login_usuario) || !empty($senha_usuario)){

		$sql = "SELECT * FROM user WHERE username = '".$login_usuario."';";
		$resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
		$contar = mysqli_num_rows($resultado);
		$listar = mysqli_fetch_assoc($resultado);
		
		if ($contar == 1){
			
			if ($senha_usuario != md5($listar["senha"])){
				unset ($_SESSION["login_usuario"]);
				unset ($_SESSION["senha_usuario"]);
				header("Location: login.php?status=no_login");
				exit();
	 		} 
		}else{
			unset ($_SESSION["login_usuario"]);
			unset ($_SESSION["senha_usuario"]);
			header("Location: login.php?status=no_login");
			exit();
		}
	}else{
		header("Location: login.php?status=no_login");
		exit();
	}
}else{
	if($login_type == 2){
		//Valida se usuario esta logado utilizando cookies 1
		if (isset($HTTP_COOKIE_VARS["login_usuario"]) && isset($HTTP_COOKIE_VARS["senha_usuario"])) {
			$login_usuario = $HTTP_COOKIE_VARS["login_usuario"];
			$senha_usuario = $HTTP_COOKIE_VARS["senha_usuario"];
		}else{
			header("Location: login.php?status=no_login");
			exit();
		}
	}else{
		//Valida se usuario esta logado utilizando cookies 2
		if (isset($_COOKIE["login_usuario"]) && isset($_COOKIE["senha_usuario"])) {
			$login_usuario = $_COOKIE["login_usuario"];
			$senha_usuario = $_COOKIE["senha_usuario"];
		}else{
			header("Location: login.php?status=no_login");
			exit();
		}
	}
	if(!empty($login_usuario) || !empty($senha_usuario)){

		$sql = "SELECT * FROM user WHERE username = '".$login_usuario."';";
		$resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
		$contar = mysqli_num_rows($resultado);
		$listar = mysqli_fetch_assoc($resultado);
		
		if ($contar == 1){
			
			if ($senha_usuario != md5($listar["senha"])){
				setcookie("login_usuario");
				setcookie("senha_usuario");
				header("Location: login.php?status=no_login");
				exit();
	 		} 
		}else{
			setcookie("login_usuario");
			setcookie("senha_usuario");
			header("Location: login.php?status=no_login");
			exit();
		}
	}else{
		header("Location: login.php?status=no_login");
		exit();
	}
}

$logado = "sim";
?>