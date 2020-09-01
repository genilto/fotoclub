<? 
$nome_usuario_online = isset($_GET["nome"]) ? $_GET["nome"] : "";
$timestamp = time(); 
$timeout = time()-300;

$sql_insere = "INSERT INTO online (timestamp, nome, ip, pagina) VALUES ('".$timestamp."', '".$nome_usuario_online."', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['PHP_SELF']."')";
$sql_deleta = "DELETE FROM online WHERE timestamp < ".$timeout;

if (isset($local_pagina_pra_contar) && $local_pagina_pra_contar == "topo"){
	$sql_conta = "SELECT DISTINCT ip FROM online";
}else{
	$sql_conta = "SELECT DISTINCT ip FROM online WHERE pagina = '".$_SERVER['PHP_SELF']."'";
}

$result = mysqli_query($conexao, $sql_insere) or die ("<b>online.php</b><br> ".mysqli_error($conexao));
$result = mysqli_query($conexao, $sql_deleta)or die ("<b>online.php</b><br> ".mysqli_error($conexao));
$result = mysqli_query($conexao, $sql_conta) or die("<b>online.php</b><br> ".mysqli_error($conexao));

$usuarios_online = mysqli_num_rows($result); 

//mysqli_close($conexao);

if (isset($local_pagina_pra_contar) && $local_pagina_pra_contar == "topo"){
	if ($usuarios_online == 1){
		$escreve = "usuário online";
	}else{
		$escreve = "usuários online";
	}
}else{
	if ($usuarios_online == 1){
		$escreve = "usuário online nesta página";
	}else{
		$escreve = "usuários online nesta página";
	}
}
echo "<font class=\"texto_gran\">".$usuarios_online."</font> ".$escreve; 
?> 
