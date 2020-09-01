<? include "valida_user.php";
$id = $_GET["id"];
$data_foto = $_GET["data_foto"];

$sql = "SELECT * FROM comentarios WHERE id = ".$id;
$executa = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
$listar = mysqli_fetch_assoc($executa);
?>
<html>
<head>
<title><? echo $titulo; ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
</head>

<body topmargin="0" leftmargin="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="25" colspan="2" bgcolor="#99CC99" class="titulo">Coment&aacute;rio 
      foto: <? echo $data_foto; ?></td>
  </tr>
  <tr> 
    <td height="30" align="right" class="texto_gran">Nome:</td>
    <td class="texto">&nbsp;<? echo $listar["nome"]; ?></td>
  </tr>
  <tr bgcolor="#EEEEEE"> 
    <td height="30" align="right" class="texto_gran">E-mail:</td>
    <td class="texto">&nbsp;<? echo $listar["email"]; ?></td>
  </tr>
  <tr> 
    <td height="30" align="right" class="texto_gran">Coment&aacute;rio:</td>
    <td class="texto">&nbsp;<? echo wordwrap($listar["comentario"], 40, "\n", 1); ?></td>
  </tr>
  <tr align="center" class="texto">
    <td colspan="2" class="texto_gran">&nbsp;</td>
  </tr>
  <tr align="center"> 
    <td colspan="2" class="texto_gran"><a href="javascript:window.close();"><img src="<? echo $end_objetos; ?>arquivos/images/botao_sair.gif" alt="Fechar" width="89" height="29" border="0"></a></td>
  </tr>
</table>
</body>
</html>
