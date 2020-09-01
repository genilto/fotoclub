<? include "valida.php";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
$login = isset($_POST["login"]) ? $_POST["login"] : "";
$senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
$nova_senha = isset($_POST["nova_senha"]) ? $_POST["nova_senha"] : "";
$confirma_nova_senha = isset($_POST["confirma_nova_senha"]) ? $_POST["confirma_nova_senha"] : "";
$status = "";

if ($acao == "mudar"){
  if ($login == ""){
    $status = "Preencha seu login";
  }elseif($senha == ""){
    $status = "Preencha sua senha";
  }elseif($nova_senha == ""){
    $status = "Preencha sua nova senha";
  }elseif($nova_senha != $confirma_nova_senha){
    $status = "A senha e a confirmação de senha são diferentes";
  }else{
    $sql = "SELECT * FROM administrador WHERE senha = '".$senha."'";
    $executa = mysqli_query($conexao, $sql) or die ("Ver senha: ".mysqli_error($conexao));
    $contar = mysqli_num_rows($executa);
    $listar = mysqli_fetch_assoc($executa);

    if ($contar == 0){
      $status = "A senha está incorreta";
    } else {

      //faz o update
      $sql_update = "UPDATE administrador SET login = '".$login."', senha = '".$nova_senha."'  WHERE id =".$listar["id"]." LIMIT 1;";
      //$sql_update = "UPDATE usuarios SET login = 'geniltoz', senha = 'testez' WHERE id = 1 LIMIT 1 ; ";

      mysqli_query($conexao, $sql_update) or die ("update: ".mysqli_error($conexao));
      $status = "Dados editados com sucesso!";
    }
  }
}

$sql = "SELECT * FROM administrador";
$executa = mysqli_query($conexao, $sql) or die ("listar: ".mysqli_error($conexao));
$listar = mysqli_fetch_assoc($executa);

?>
<html>
<head>
<title><? echo $titulo_adm; ?></title>
<link href="<? echo $end_objetos_adm; ?>padrao.css" rel="stylesheet" type="text/css">
<? echo "<script language=\"JavaScript\" type=\"text/javascript\">";
include $end_objetos_adm."script.js";
echo "</script>";
?>
</head>

<body bgcolor="#EEEEEE">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="form">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <? if ($status != ""){ ?>
        <tr align="center"> 
          <td colspan="2" class="form"><? echo $status; ?></td>
        </tr>
        <? } ?>
        <tr> 
          <td width="40%">&nbsp;</td>
          <td width="60%" class="titulo">&nbsp;</td>
        </tr>
        <tr align="center"> 
          <td colspan="2" class="titulo"><img src="<? echo $end_objetos; ?>arquivos/images/lista.gif" width="21" height="7"><font color="#0000FF">P&aacute;gina 
            para troca de senha</font></td>
        </tr>
        <tr> 
          <td colspan="2"><form name="form1" method="post" action="senha.php?acao=mudar" onSubmit="javascript:disable(this);">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td align="right" class="texto">Login:</td>
                  <td><input name="login" type="text" class="form" id="login2" size="30" maxlength="30" value="<? echo $listar["login"]; ?>"></td>
                </tr>
                <tr> 
                  <td align="right" class="texto">Senha antiga:</td>
                  <td><input name="senha" type="password" class="form" id="senha" size="30"></td>
                </tr>
                <tr> 
                  <td align="right" class="texto">Nova senha:</td>
                  <td><input name="nova_senha" type="password" class="form" id="nova_senha" size="30"></td>
                </tr>
                <tr> 
                  <td align="right" class="texto">Confirma&ccedil;&atilde;o de 
                    senha:</td>
                  <td><input name="confirma_nova_senha" type="password" class="form" id="confirma_nova_senha" size="30"></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr align="center"> 
                  <td colspan="2"> <input name="sendBtn" type="submit" class="form" value="Enviar"> 
                    <input name="button" type="button" class="form" onClick="javascript:window.close();" value="Cancelar"> 
                  </td>
                </tr>
              </table>
            </form></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
