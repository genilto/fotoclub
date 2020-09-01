<? include "ver_login.php";

if($logado == "sim"){
	header("Location:adm.php");
	exit;
}
   
$status = isset($_GET["status"]) ? $_GET["status"] : "";
$username = isset($_POST["username"]) ? strtolower($_POST["username"]) : "";
$senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
$erros = "";
$erro_user = "";
$local_retorno = isset($_GET["local"]) ? $_GET["local"] : "";

if ($acao == "logar"){
	if ($username == ""){
		$erros = $erros."Você tem que preencher seu username<br>";
	}

	if ($senha == ""){
		$erros = $erros."Você tem que preencher sua senha";
	}
	
	if ($erros == ""){
		$erro_user = "";
		
		$sql = "SELECT * FROM user WHERE username = '".$username."';";
		$executa = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
		$contar = mysqli_num_rows($executa);
		$listar = mysqli_fetch_assoc($executa);

		if ($contar == "0"){//verifica se existe usuario
			$erro_user = $erro_user."O usuário não existe";
		}else{
			if ($senha != $listar["senha"]){//verifica senha
				$erro_user = $erro_user."A senha está incorreta";
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
				if($local_retorno == "chat"){
					header("Location: chat.php");
				}else{
					header("Location: adm.php");
				}
				exit();
			}
		}
	}
}
?>
<html>
<head>
<title><? echo $titulo ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
<LINK REL="SHORTCUT ICON" HREF="<? echo $end_objetos; ?>arquivos/images/icon.gif">
</head>

<body topmargin="0" leftmargin="0" <? if ($logado == "não") { echo "onLoad=\"document.login.username.focus();\""; } ?>>
<? include "topo.php"; ?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="138" valign="top"> 
      <? include "menu.php"; ?>
    </td>
    <td colspan="4" align="center" valign="top"> <table width="95%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <? if ($erros != "" || $erro_user != "" || $status == "no_login" || $status == "logout_ok" || $status == "no_chat"){ ?>
        <tr align="center"> 
          <td colspan="3" class="td"> 
            <? 	if ($erros != "") { 
					echo $erros; 
				} 
				if ($erro_user != "") { 
					echo $erro_user; 
				} 
				if ($status == "no_login") { 
					echo "Você precisa se logar para ter acesso a essa página"; 
				}elseif ($status == "logout_ok") { 
					echo "Sua saída foi realizada com sucesso!"; 
				}elseif ($status == "no_chat") {
					$local_retorno = "chat";
					echo "Para participar do Chat ".$nome_site.", você precisa estar logado!"; 
				} ?>
          </td>
        </tr>
        <? } ?>
        <tr> 
          <td colspan="3" class="titulo">.: Login</td>
        </tr>
        <tr> 
          <td colspan="3" class="texto">Para poder se logar no site e administrar 
            seu fotolog, voc&ecirc; precisa informar nos campos abaixo seu username 
            e sua senha. Se voc&ecirc; n&atilde;o est&aacute; cadastrado <a href="cadastro.php" title="Cadastre-se">clique 
            aqui</a> e cadastre-se gratuitamente.</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr align="center"> 
          <td colspan="3"><img src="<? echo $end_objetos; ?>arquivos/images/barra_login.gif" width="548" height="31"></td>
        </tr>
        <tr align="center"> 
          <td colspan="3"><form name="login" method="post" action="login.php?acao=logar&local=<? echo $local_retorno; ?>" onSubmit="return valida_login();">
              <table width="530" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td width="149" rowspan="6" background="<? echo $end_objetos; ?>arquivos/images/chave.gif">&nbsp;</td>
                </tr>
                <tr> 
                  <td width="208">&nbsp;</td>
                  <td width="173">&nbsp;</td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Username:</td>
                  <td><input name="username" type="text" class="form" id="username" value="<? echo $username; ?>" size="25" maxlength="15"></td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Senha:</td>
                  <td><input name="senha" type="password" class="form" id="senha" size="25" maxlength="30"></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td class="texto">&gt; <a href="javascript:abre('esqueceu_senha.php', 'senha', 'width=400, height=200');">Esqueceu 
                    a senha?</a></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr align="center"> 
                  <td colspan="3"><span class="texto_gran">Problemas para logar?</span><br> 
                    <span class="texto">Se voc&ecirc; estiver tendo qualquer tipo 
                    de problema, <a href="contato.php" title="Contate o administrador"><font color="#0000FF">Clique 
                    aqui </font></a> e entre em<br>
                    contato com o administrador do site.</span></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr align="center"> 
                  <td colspan="3"> <input name="entrar" type="image" id="entrar" src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Entrar" width="89" height="29" border="0"> 
                    &nbsp;<a href="javascript:history.back();"><img src="<? echo $end_objetos; ?>arquivos/images/voltar.gif" alt="Voltar" width="89" height="29" border="0"></a>&nbsp;<a href="cadastro.php"><img src="<? echo $end_objetos; ?>arquivos/images/cadastre_se.gif" alt="Cadastre-se" width="89" height="29" border="0"></a></td>
                </tr>
              </table>
            </form></td>
        </tr>
	</table>
</td>
  </tr>
  <tr> 
    <td colspan="5"> 
      <? include "rodape.php" ?>
    </td>
  </tr>
</table>
</body>
</html>