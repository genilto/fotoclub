<? include "valida.php"; ?>
<html>
<head>
<title><? echo $titulo_adm; ?></title>
<? echo "<script language=\"JavaScript\" type=\"text/javascript\">
";
include $end_objetos_adm."script.js";

echo "</script>";

$id = $_GET["id"];

if ($id != ""){
$sql = "SELECT * FROM user WHERE id = ".$id;
	   $exe = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
	   $listar = mysqli_fetch_assoc($exe);
	   $contar = mysqli_num_rows($exe);
}
?>
<link href="<? echo $end_objetos_adm; ?>padrao.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#EEEEEE">
<? if ($id == ""){ ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" class="form"><p class="titulo">Escolha um usuário</p>
      <p><a href="javascript:window.close();"><img src="<? echo $end_objetos; ?>arquivos/images/botao_sair.gif" alt="Fecha a janela" width="89" height="29" border="0"></a></p></td>
  </tr>
</table>
<? }else{ ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" class="form"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="30" align="right" class="texto_gran">Nome:</td>
          <td>&nbsp;</td>
          <td class="texto"><? echo $listar["nome"]." ".$listar["sobrenome"]; ?></td>
        </tr>
        <tr> 
          <td height="30" align="right" class="texto_gran">E-mail:</td>
          <td>&nbsp;</td>
          <td class="texto"><? echo $listar["email"]; ?></td>
        </tr>
        <tr> 
          <td width="34%" height="30" align="right" class="texto_gran">Usu&aacute;rio:</td>
          <td width="2%">&nbsp;</td>
          <td width="64%" class="texto"><? echo $listar["username"]; ?></td>
        </tr>
        <tr> 
          <td height="30" align="right" class="texto_gran">Senha:</td>
          <td>&nbsp;</td>
          <td class="texto"><? echo $listar["senha"]; ?></td>
        </tr>
        <tr> 
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td><a href="javascript:window.close();"><img src="<? echo $end_objetos; ?>arquivos/images/botao_sair.gif" alt="Fecha a janela" width="89" height="29" border="0"></a></td>
        </tr>
      </table></td>
  </tr>
</table>
<? } ?>
</body>
</html>
