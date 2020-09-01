<? 
if ($nome != ""){  
	
	$sql_user = "SELECT * FROM user WHERE username = '".$nome."'";
	$executa_user = mysqli_query($conexao, $sql_user) or die ("<b>contador.php</b><br> ".mysqli_error($conexao));
	$contar_user = mysqli_num_rows($executa_user);
	
	if ($contar_user > 0){

		//verifica total de acessos do usuario
		$sql_ver = "SELECT * FROM contador WHERE user = '".$nome."'";
		$executa_ver = mysqli_query($conexao, $sql_ver) or die ("<b>contador.php</b><br>".mysqli_error($conexao));
		$contar_ver = mysqli_num_rows($executa_ver);
		$listar_ver = mysqli_fetch_assoc($executa_ver);
  
	  	if($login_type_outros == 0){
			//verifica se há um cookie
			if(isset($HTTP_COOKIE_VARS["ip_contador"]) && isset($HTTP_COOKIE_VARS["user_contador"])){
				$ip_cookie = $HTTP_COOKIE_VARS["ip_contador"];
				$user_cookie = $HTTP_COOKIE_VARS["user_contador"];
			}
		}else{
			//verifica se há um cookie
			if(isset($_COOKIE["ip_contador"]) && isset($_COOKIE["user_contador"])){
				$ip_cookie = $_COOKIE["ip_contador"];
				$user_cookie = $_COOKIE["user_contador"];
			}
		}
	
		if(!empty($ip_cookie) && !empty($user_cookie)){
			if ($user_cookie != $nome){
				$gravar_contador = "sim";
			}else{
				$gravar_contador = "não";
		  	}
		}else{
			$gravar_contador = "sim";
		}
		
		if ($gravar_contador == "sim"){
			//ve se já tem acessos, se não tiver grava um
			if ($contar_ver == 0){ 
				$sql_contar = "INSERT INTO `contador` (`user`, `acessos` )
												VALUES('".$nome."', 1 )	";
	
			}else{
				//se tiver acrescenta + um
			   $acessos = $listar_ver["acessos"]+1;
			   $sql_contar = "UPDATE contador 
			   					 SET acessos = ".$acessos."
					           WHERE id = ".$listar_ver["id"];
			}
			mysqli_query($conexao, $sql_contar) or die ("<b>contador.php</b><br>".mysqli_error($conexao));
			//cria um cookie com o ip do usuario
			setcookie("ip_contador", $_SERVER['REMOTE_ADDR']);
			setcookie("user_contador", $nome);
		} 
	}
}
?> 
