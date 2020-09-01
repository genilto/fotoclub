<? 
$sql_ver = "SELECT * FROM acessos_site";
$executa_ver = mysqli_query($conexao, $sql_ver) or die (mysqli_error($conexao));
$contar_ver = mysqli_num_rows($executa_ver);
$listar_ver = mysqli_fetch_assoc($executa_ver);

if($login_type_outros == 0){
	//verifica se há um cookie
	if(isset($HTTP_COOKIE_VARS['ip_user'])){
		if ($HTTP_COOKIE_VARS['ip_user'] != ""){
			$gravar_contador = "não";
		}else{
			$gravar_contador = "sim";
		}
	}else{
		$gravar_contador = "sim";
	}
}else{
	//verifica se há um cookie
	if(isset($_COOKIE['ip_user'])){
		if ($_COOKIE['ip_user'] != ""){
			$gravar_contador = "não";
		}else{
			$gravar_contador = "sim";
		}
	}else{
		$gravar_contador = "sim";
	}
}
if($gravar_contador == "sim"){
	//ve se já tem acessos, se não tiver grava um
	if ($contar_ver == 0){ 
		$sql_contar = "INSERT INTO `acessos_site` ( `acessos` ) 
           	             VALUES (1);";
    }else{
		//se tiver acrescenta + um
		$acessos = $listar_ver["acessos"]+1;
		$sql_contar = "UPDATE acessos_site SET
					  acessos = ".$acessos."
					   WHERE id = ".$listar_ver["id"];
	}
    mysqli_query($conexao, $sql_contar) or die (mysqli_error($conexao));
	//cria um cookie com o ip do usuario
	setcookie("ip_user", $_SERVER['REMOTE_ADDR']);
} 
echo $HTTP_COOKIE_VARS["ip_user"];
?> 
