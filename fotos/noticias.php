<? include "ver_login.php";
$nome = $_GET["nome"];
include "contador.php"; 
$id = $_GET["id"];
$local_pagina = "noticias";

if ($nome == ""){
echo "<script>window.location=\"erro.php?erro=no_user\"</script>";
}
else{

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

if ($id != ""){
$sql_not = "SELECT * FROM noticias WHERE user = \"".$nome."\" and id = ".$id;
}else{
$sql_not = "SELECT * FROM noticias WHERE user = \"".$nome."\" ORDER BY id DESC";
}
$executa_not = mysqli_query($conexao, $sql_not) or die (mysqli_error($conexao));
$contar_not = mysqli_num_rows($executa_not);
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
          <td height="500" valign="top" bgcolor="<? echo $cor_meio; ?>">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr class="texto"> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="2" align="center"><font size="2" color="<? echo $cor_tit; ?>" face="<? echo $fonte_tit; ?>"><b>Not&iacute;cias 
                  de <? echo $listar_user["nome"]." ".$listar_user["sobrenome"]; ?></b></font></td>
              </tr>
              <tr class="texto"> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="2"> 
                  <? if ($id == ""){ ?>
                  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr> 
                      <td align="right" class="texto_gran">
					  <font color="<? echo $cor_comentario; ?>">Total: <? echo $contar_not; ?>  
                        </font></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
			  <?
			  if ($contar_not == "0"){ ?>
			  
			  <tr class="texto">
                <td colspan="2" class="titulo" align="center"><font color="<? echo $cor_comentario; ?>">Nenhuma notícia encontrada</font></td>
              </tr>
			  
			  <? } ?>
              <tr class="texto">
                <td colspan="2">&nbsp;</td>
              </tr>
			  
              <? if ($id == ""){ 
			  while ($listar_not = mysqli_fetch_assoc($executa_not)){
			  ?>
              <tr> 
                <td colspan="2"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td><font color="<? echo $cor_comentario; ?>" class="texto_gran">I</font><font color="<? echo $cor_comentario; ?>" class="texto_gran">nclus&atilde;o: 
                        </font><font color="<? echo $cor_comentario; ?>" class="texto"><? echo $listar_not["data"]; ?></font></td>
                    </tr>
                    <tr> 
                      <td class="texto"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="5%"><img src="<? echo $end_objetos; ?>arquivos/images/lista.gif" width="21" height="7"></td>
                            <td width="95%" class="texto"><a href="noticias.php?nome=<? echo $nome; ?>&id=<? echo $listar_not["id"]; ?>"><font color="<? echo $cor_comentario; ?>"> 
                              <? echo $listar_not["titulo"]; ?></font></a></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr class="texto"> 
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <? } 
			  }else{
			  $listar_not = mysqli_fetch_assoc($executa_not); ?>
              <tr> 
                <td colspan="2"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td align="center" class="texto_gran"><font color="<? echo $cor_comentario; ?>"><? echo $listar_not["titulo"]; ?></font></td>
                    </tr>
                    <tr> 
                      <td align="center" class="texto"><font color="<? echo $cor_comentario; ?>">(<? echo $listar_not["data"]; ?>)</font></td>
                    </tr>
                  </table></td>
              </tr>
              <tr class="texto"> 
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="2"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td class="texto">&nbsp;&nbsp;<font color="<? echo $cor_comentario; ?>"><? echo wordwrap(nl2br($listar_not["noticia"]), 60, "<br>", 1); ?></font></td>
                    </tr>
                  </table></td>
              </tr>
              <tr class="texto"> 
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr class="texto"> 
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="2" align="right"> <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr> 
                      <td align="right" class="texto_gran"><a href="noticias.php?nome=<? echo $nome; ?>" title="Mostrar todas"> 
                        <font color="<? echo $cor_comentario; ?>"> Mostrar Todas 
                        </font> </a> </td>
                    </tr>
                    <tr>
                      <td align="right" class="texto_gran">&nbsp;</td>
                    </tr>
                  </table></td>
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
