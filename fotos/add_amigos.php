<? include "ver_login.php";

$nome = isset($_GET["nome"]) ? $_GET["nome"] : "";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
$username = isset($_POST["username"]) ? $_POST["username"] : "";
$senha = isset($_POST["senha"]) ? $_POST["senha"] : "";

if($acao == "logar"){
	if ($username == ""){
		$status = "Você tem que preencher seu username<br>";
	}elseif ($senha == ""){
		$status = "Você tem que preencher sua senha";
	}else{
		$sql = "SELECT * FROM user WHERE username = '".$username."';";
		$executa = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
		$contar = mysqli_num_rows($executa);
		$listar = mysqli_fetch_assoc($executa);

		if ($contar == 0){//verifica se existe usuario
			$status = "Este usuário não existe";
		}else{
			if ($senha != $listar["senha"]){//verifica senha
				$status = "A senha está incorreta";
			}else{
				if($login_type == 0){
					$HTTP_SESSION_VARS["login_usuario"] = $username;
					$HTTP_SESSION_VARS["senha_usuario"] = md5($senha);
				}elseif($login_type == 1){
					$_SESSION["login_usuario"] = $username;
					$_SESSION["senha_usuario"] = md5($senha);
				}else{
					setcookie("login_usuario", $username);
					setcookie("senha_usuario", md5($senha));
				}
				header("Location: add_amigos.php?acao=adicionar&nome=".$nome);
				exit();
			}
		}
	}
}elseif($acao == "adicionando"){
	if ($nome == ""){
		$status = "Escolha um amigo para adicionar";
  		$acao = "outros";
	}else{
  
		$sql_ver_amigo = "SELECT * FROM user WHERE username = '".$nome."'";
		$exe_ver_amigo = mysqli_query($conexao, $sql_ver_amigo) or die (mysqli_error($conexao));
		$contar_ver_amigo = mysqli_num_rows($exe_ver_amigo);
		$listar_ver_amigo = mysqli_fetch_assoc($exe_ver_amigo);
	  
		if ($contar_ver_amigo == 0){
			$status = "Não há nenhum usuário com username \"".$nome."\"";
			$acao = "outros";
		}else{
			$sql_amigos = "SELECT * FROM amigos WHERE user = '".$login_usuario."' and amigo = '".$listar_ver_amigo["username"]."'";
			$exe_amigos = mysqli_query($conexao, $sql_amigos) or die (mysqli_error($conexao));
			$contar_amigos = mysqli_num_rows($exe_amigos);
		
			if ($contar_amigos != 0){
				$status = "O usuário ".$listar_ver_amigo["nome"]." já está adicionado";
				$acao = "outros";
			}elseif($listar_ver_amigo["username"] == $login_usuario){
				$status = "Você não pode adicionar você mesmo!";
				$acao = "outros";
  			}else{
	  			$sql_insert = "INSERT INTO amigos (user, amigo) VALUES ('".$login_usuario."', '".$listar_ver_amigo["username"]."');";
				mysqli_query($conexao, $sql_insert) or die (mysqli_error($conexao));
	  			$status = "Amigo adicionado com sucesso!";
				$complemento = $listar_ver_amigo["nome"]." ".$listar_ver_amigo["sobrenome"]." agora faz parte da sua lista de amigos!";
	  			$acao = "outros";
			}
		}
	}
}

$sql_amigo = "SELECT u.nome
					,u.sobrenome
					,c.titulo
			    FROM user u
				 	,config c
			   WHERE u.username = c.user
			     AND u.username = '".$nome."';";
				 
$exe_amigo = mysqli_query($conexao, $sql_amigo) or die (mysqli_error($conexao));
$listar_amigo = mysqli_fetch_assoc($exe_amigo);

 ?>
<html>
<head>
<title><? echo $titulo; ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
</head>
<body topmargin="0" leftmargin="0"<? if($logado != "sim"){ echo " onLoad=document.logar.username.focus();"; } ?>>
<? if($logado != "sim"){ ?>
<form name="logar" method="post" action="add_amigos.php?acao=logar&nome=<? echo $nome; ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="2" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/fotoclubelogo_cep_correios.gif" width="100" height="67"></td>
    </tr>
    <tr> 
      <td height="10" colspan="2" align="center"></td>
    </tr>
    <tr> 
      <td colspan="2" align="center" bgcolor="#EEEEEE" class="titulo"> 
        <? if($status == ""){ 
	  										echo "Voc&ecirc; n&atilde;o est&aacute; logado!";
										}else{
											echo $status;
										}?>
      </td>
    </tr>
    <tr> 
      <td height="10" colspan="2"></td>
    </tr>
    <tr> 
      <td height="20" colspan="2" align="center" class="texto">Para adicionar 
        <strong>"<? echo $listar_amigo["nome"]." ".$listar_amigo["sobrenome"]; ?>"</strong> 
        a sua lista de amigos voc&ecirc; deve se identificar:</td>
    </tr>
    <tr> 
      <td height="10" colspan="2"></td>
    </tr>
    <tr> 
      <td width="38%" height="25" align="right" class="texto">Username:</td>
      <td width="62%"><input name="username" type="text" class="form" id="username2" value="<? echo $username; ?>" size="25" maxlength="15"></td>
    </tr>
    <tr> 
      <td height="25" align="right" class="texto">Senha:</td>
      <td><input name="senha" type="password" class="form" id="senha2" size="25" maxlength="30"></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td class="texto">&gt; <a href="javascript:abre('esqueceu_senha.php', 'senha', 'width=400, height=200');" title="Recuperar senha">Esqueceu 
        a senha?</a></td>
    </tr>
    <tr align="center" bgcolor="#EEEEEE"> 
      <td height="25" colspan="2" class="texto"><a href="javascript:favoritos('http://<? echo $nome.".".$dominio; ?>', '<? echo $listar_amigo["titulo"]; ?>');">Adicionar 
        aos favoritos do IE.</a></td>
    </tr>
    <tr>
      <td colspan="2" height="10"></td>
    </tr>
    <tr> 
      <td colspan="2" align="center"> <input name="entrar" type="image" id="entrar" src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Logar" width="89" height="29" border="0"> 
        &nbsp;<a href="javascript:window.close();"><img src="<? echo $end_objetos; ?>arquivos/images/botao_sair.gif" alt="Fechar" width="89" height="29" border="0"></a>&nbsp;</td>
    </tr>
  </table>
</form>
<? }else{
		if($acao == "adicionar" || $acao == ""){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="100%" colspan="2" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/fotoclubelogo_cep_correios.gif" width="100" height="67"></td>
  </tr>
  <tr> 
    <td height="10" colspan="2" align="right" class="texto"><a href="add_amigos.php?acao=logout" title="Efetua Logout e fecha janela">Logout</a></td>
  </tr>
  <tr>
    <td height="30" colspan="2" align="center" bgcolor="#EEEEEE" class="titulo"><? echo $listar["nome"]." ".$listar["sobrenome"]; ?>:</td>
  </tr>
  <tr> 
    <td height="25" colspan="2" align="center" bgcolor="#CCCCCC" class="titulo"> 
      <p>Voc&ecirc; deseja adicionar <strong><? echo $listar_amigo["nome"]." ".$listar_amigo["sobrenome"]; ?></strong> 
        &agrave; sua lista de amigos?</p></td>
  </tr>
  <tr> 
    <td height="10" colspan="2"></td>
  </tr>
  <tr> 
    <td height="10" colspan="2" align="center"> <a href="add_amigos.php?acao=adicionando&nome=<? echo $nome; ?>"> 
      <img src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="OK" width="89" height="29" border="0"></a> 
      &nbsp; <a href="javascript:window.close();"> <img src="<? echo $end_objetos; ?>arquivos/images/botao_sair.gif" alt="Fechar" width="89" height="29" border="0"> 
      </a></td>
  </tr>
  <tr> 
    <td height="10" colspan="2"></td>
  </tr>
  <tr align="center" bgcolor="#EEEEEE"> 
    <td height="25" colspan="2" class="texto"><a href="javascript:favoritos('http://<? echo $nome.".".$dominio; ?>', '<? echo $listar_amigo["titulo"]; ?>');">Adicionar 
      tamb&eacute;m aos favoritos do IE.</a></td>
  </tr>
  <tr> 
    <td colspan="2" height="10"></td>
  </tr>
  <tr> 
    <td colspan="2" align="center"> &nbsp;&nbsp;</td>
  </tr>
</table>
<? }elseif($acao == "outros"){ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="100%" colspan="2" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/fotoclubelogo_cep_correios.gif" width="100" height="67"></td>
  </tr>
  <tr> 
    <td height="10" colspan="2" align="right" class="texto"><a href="add_amigos.php?acao=logout" title="Efetua Logout e fecha janela">Logout</a></td>
  </tr>
  <tr> 
    <td colspan="2" align="center" bgcolor="#EEEEEE" class="titulo"><? echo $status; ?></td>
  </tr>
  <tr> 
    <td height="10" colspan="2"></td>
  </tr>
  <tr> 
    <td height="10" colspan="2" align="center" class="texto"><? echo $complemento; ?></td>
  </tr>
  <tr> 
    <td height="10" colspan="2"></td>
  </tr>
  <tr align="center" bgcolor="#EEEEEE"> 
    <td height="25" colspan="2" class="texto"><a href="javascript:favoritos('http://<? echo $nome.".".$dominio; ?>', '<? echo $listar_amigo["titulo"]; ?>');">Adicionar 
      tamb&eacute;m aos favoritos do IE.</a></td>
  </tr>
  <tr> 
    <td colspan="2" height="10"></td>
  </tr>
  <tr> 
    <td colspan="2" align="center"> &nbsp;<a href="javascript:window.close();" title="Fecha janela"><img src="<? echo $end_objetos; ?>arquivos/images/botao_sair.gif" alt="Fechar" width="89" height="29" border="0"></a>&nbsp;</td>
  </tr>
</table>
<? }else{ ?>
<? if($acao == "logout"){

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

?>
 <script>
	window.close();
</script>
  <?
		}
	}
}

//mysqli_close($conexao);

?>
</body>
</html>
