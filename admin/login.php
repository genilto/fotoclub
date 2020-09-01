<? include "config.php";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
$info = isset($_GET["info"]) ? $_GET["info"] : "";
$status = "";

$login = "";
$senha = "";

if ($acao == "logar"){
	$login = $_POST["login"];
  $senha = $_POST["senha"];

	if ($login == ""){
		$status = "Preencha o campo usuário";
		$acao = "";
	}elseif($senha == ""){
		$status = "Preencha sua senha";
		$acao = "";
	}else{
		$sql = "SELECT * FROM administrador WHERE login = '".$login."'";
		$exe = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
		$listar = mysqli_fetch_assoc($exe);
		$contar = mysqli_num_rows($exe);

		if ($contar == 0){
			$status = "Usuário inválido";
			$acao = "";
		}elseif($listar["senha"] != $senha){
			$status = "Senha inválida";
			$acao = "";
	   }else{
			if($login_type == 0){
				$_SESSION["login_administrador"] = $login;
    		$_SESSION["senha_administrador"] = md5($senha);
			}elseif($login_type == 1){
				$_SESSION["login_administrador"] = $login;
				$_SESSION["senha_administrador"] = md5($senha);
			}else{
				setcookie("login_administrador", $login);
				setcookie("senha_administrador", md5($senha));
			}
			header("Location: index.php");
			exit();
	 	}
	}
}
?>
<html>
<head>
<title><? echo $titulo_adm; ?></title>
<link href="<? echo $end_objetos_adm; ?>padrao.css" rel="stylesheet" type="text/css">
<script src="../fotolog/script.js"></script>
</head>
<body bgcolor="#EEEEEE" onLoad="document.form_login.login.focus();">
<? if ($acao == ""){ ?>
<form name="form_login" method="post" action="login.php?acao=logar" onSubmit="javascript:disable(this);">
  <? if ($info != ""){ ?>
  <? } ?>
  <table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            
      <td colspan="2" align="center"><a href="../fotolog/index.php"><img src="<? echo $end_objetos; ?>arquivos/images/fotoclubelogo_adm.gif" alt="http://<? echo $url_site; ?>" width="200" height="133" border="0"></a></td>
          </tr>
          <tr> 
            
      <td height="17" colspan="2" align="center"  bgcolor="#CCCCCC" class="titulo">Acesso 
        restrito ao sistema</td>
          </tr>
          <tr> 
            
      <td height="25"  align="right" class="texto_gran">Usuário:</td>
            <td ><input name="login" type="text" class="form" size="25"<? echo " value=\"".$login."\""; ?>></td>
          </tr>
          <tr> 
            
      <td height="20"  align="right" class="texto_gran">Senha:</td>
            <td ><input name="senha" type="password" class="form" size="25" ></td>
          </tr>
          <? if ($status != "" || $info != ""){ ?>
          <tr> 
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td colspan="2" height="10"></td>
                </tr>
                <tr> 
                  <td align="right"><img src="<? echo $end_objetos; ?>arquivos/images/lista.gif" width="21" height="7"></td>
                  <td class="titulo"><font color="#FF0000"><? echo $status.$info ?></font></td>
                </tr>
                <tr> 
                  <td colspan="2" height="10"></td>
                </tr>
              </table></td>
          </tr>
          <? } ?>
          
    <tr align="center" valign="bottom"> 
      <td height="30" colspan="2"> 
        <input name="sendBtn" type="submit" class="form" value="Entrar">
        <input name="submit2" type="button" class="form" value="Cancelar" onClick="javascript:window.location='<? echo $end_objetos_adm; ?>index.php';"> </td>
          </tr>
          <tr> 
            <td colspan="2" align="center">&nbsp;</td>
          </tr>
        </table>
</form>

<? } ?>
</body>
</html>