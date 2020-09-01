<?php
 require_once "ver_login.php"; 
?>
<html>
<head>
<title><? echo $titulo ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
</head>
<body topmargin="0" leftmargin="0">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center"> 
    <td colspan="3"><img src="<? echo $end_objetos; ?>arquivos/images/testar_username_top.gif" width="300" height="28"></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?
	$username = isset($_GET["v"]) ? $_GET["v"] : "";
	if ($username == ""){
	?>
<tr align="center"> 
    <td colspan="3" class="texto_gran">Por favor digite algum valor a ser testado.</td>
  </tr>
 <?
	}elseif(!preg_match('/^[a-z0-9._]*$/i', $username)){
?>
<tr align="center"> 
    <td colspan="3" class="texto_gran">Formato de username inv&aacute;lido.</td>
  </tr>
<?
	}elseif(strlen($username) < 3){
?>
<tr align="center"> 
    <td colspan="3" class="texto_gran">Username muito curto, deve conter no mínimo 3 caracteres.</td>
  </tr>
<?
	}else{ 
		$sql = "SELECT * FROM user WHERE username = '".$username."'";
		$ver = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
    $contar = mysqli_num_rows($ver);
	
		if ($contar == 0){
?>
  <tr align="center"> 
    <td colspan="3" class="texto_gran">Username <font color="#FF0000"><? echo $username ?></font> 
      está disponível, você poderá registrá-lo agora.</td>
  </tr>
  <?
}
else{
?>
  <tr align="center"> 
    <td colspan="3" class="texto_gran">Username <font color="#FF0000"><? echo $username ?></font> 
      já está sendo usado por outra pessoa, por favor escolha outro.</td>
  </tr>
  <?
  }
}
?> 
 <tr> 
    <td colspan="3" class="titulo">&nbsp;</td>
  </tr>
  <tr align="center"> 
    <td colspan="3" class="titulo"><a href="javascript:window.close();">Fechar 
      janela</a></td>
  </tr>
</table>
</body>
</html>
