<? include "ver_login.php";
$nome = $_GET["nome"];
include "contador.php"; 
$local_pagina = "perfil";

if ($nome == ""){
  echo "<script>window.location=\"erro.php?erro=no_user\"</script>";
} else {

  $sql_user = "SELECT * FROM user WHERE username = \"".$nome."\"";
  $executa_user = mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));
  $listar_user = mysqli_fetch_assoc($executa_user);
  $contar_user = mysqli_num_rows($executa_user);

  if ($contar_user == "0"){
    echo "<script>window.location=\"erro.php?erro=no_user&nome=".$nome."\"</script>";
  }

  $sql_conf = "SELECT * FROM config WHERE user = \"".$nome."\"";
  $executa_conf = mysqli_query($conexao, $sql_conf) or die (mysqli_error($conexao));
  $listar_conf = mysqli_fetch_assoc($executa_conf);

  $cor_lados = $listar_conf["cor_lados"];
  $cor_meio = $listar_conf["cor_meio"];
  $cor_tit = $listar_conf["cor_tit"];
  $fonte_tit = $listar_conf["fonte_tit"];
  $cor_links = $listar_conf["cor_links"];
  $cor_comentario = $listar_conf["cor_comentario"];
  $foto_pessoal = $listar_user["foto"];
  $titulo_conf = $listar_conf["titulo"];

  $sql_links = "SELECT * FROM links WHERE user = \"".$nome."\" ORDER BY id DESC";
  $executa_links = mysqli_query($conexao, $sql_links) or die (mysqli_error($conexao));
  $contar_links = mysqli_num_rows($executa_links);
}
?>

<html>
<head>
<title><? echo $titulo_conf; ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
</head>

<body bgcolor="<? echo $fundo ?>" topmargin="0" leftmargin="0">
<? include "topo_usuarios.php"; ?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="750" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<? echo $cor_lados; ?>">
        <tr> 
          <td><img src="<? echo $end_objetos; ?>arquivos/images/usuarios_03.gif" width="150" height="20"></td>
          <td width="450" bgcolor="#1B8D08"><? include "menu_cima_fotos.php"; ?></td>
          <td><img src="<? echo $end_objetos; ?>arquivos/images/usuarios_05.gif" width="150" height="20"></td>
        </tr>
        <tr> 
          <td width="150" valign="top"><? include "menu_esq_fotos.php"; ?></td>
          <td height="500" valign="top" bgcolor="<? echo $cor_meio; ?>"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr class="texto"> 
                <td width="28%">&nbsp;</td>
                <td width="72%">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="2" align="center"><font size="2" color="<? echo $cor_tit; ?>" face="<? echo $fonte_tit; ?>"><b>Links 
                  de <? echo $listar_user["nome"]." ".$listar_user["sobrenome"]; ?></b></font></td>
              </tr>
              <tr class="texto"> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td align="right" class="texto_gran"><font color="<? echo $cor_comentario; ?>">Total: 
                  <? echo $contar_links; ?> links</font></td>
              </tr>
              <? if ($contar_links != "0"){
			  while($listar_links = mysqli_fetch_assoc($executa_links)){ ?>
              <tr> 
                <td colspan="2" class="texto_gran"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="texto">
					  
					  <font color="<? echo $cor_comentario; ?>" class="texto_gran">
					  <? echo $listar_links["nome"]; ?>:</font>&nbsp;
					  <a href="http://<? echo $listar_links["link"]; ?>" title="http://<? echo $listar_links["link"]; ?>" target="_blank"><font color="<? echo $cor_comentario; ?>">http://<? echo $listar_links["link"]; ?></font></a></td>
  </tr>
</table>
</td>
              </tr>
              <tr class="texto"> 
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <? }
			  } else{ ?>
              <tr> 
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr align="center"> 
                <td colspan="2" class="titulo"><font color="<? echo $cor_comentario; ?>">Nenhum 
                  link encontrado!</font></td>
              </tr>
              <? } ?>
            </table></td>
          <td width="150" valign="top"><? include "menu_dir_fotos.php"; ?></td>
        </tr>
        <tr> 
          <td><img src="<? echo $end_objetos; ?>arquivos/images/bordas3.gif" width="150" height="20"></td>
          <td bgcolor="#1B8D08" class="texto" align="center"><? echo $rodape_site; ?></td>
          <td><img src="<? echo $end_objetos; ?>arquivos/images/bordas4.gif" width="150" height="20"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
