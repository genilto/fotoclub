<?
include "conf.php";
$cor = $_GET["cor"];
?>
<html>
<head>
<title><? echo $titulo; ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#333333">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="65">
	
	<table width="100%" height="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" bgcolor="<? echo $cor; ?>">
        <tr>
    <td align="center" class="titulo"><? if ($cor == ""){ echo "<font color=\"#00FF00\">Sem cor</font>"; } ?></td>
  </tr>
</table>

</td>
  </tr>
  <tr>
    <td align="center" class="texto_gran"><a href="javascript:window.close();" title="Fechar"><font color="#FFFFFF">Fechar</font></a></td>
  </tr>
</table>
</body>
</html>
