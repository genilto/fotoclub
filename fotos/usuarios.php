<? 
include "ver_login.php";

$foto = isset($_GET["foto"]) ? $_GET["foto"] : "";
$nome = isset($_GET["nome"]) ? $_GET["nome"] : "";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";

include "contador.php";

$status_comentario = isset($_GET["status_com"]) ? $_GET["status_com"] : "";
$local_pagina = "usuarios";

if ($nome == ""){
	header("Location: erro.php?erro=no_user");
}else{

	$sql_user = "SELECT * FROM user WHERE username = \"".$nome."\"";
	$executa_user = mysqli_query($conexao, $sql_user) or die ("<b>usuarios.php</b><br> ".mysqli_error($conexao));
	$listar_user = mysqli_fetch_assoc($executa_user);
	$contar_user = mysqli_num_rows($executa_user);

  if ($contar_user == 0){
    header("Location: erro.php?erro=no_user&nome=".$nome);
  }

  $sql_conf = "SELECT * FROM config WHERE user = \"".$nome."\"";
  $executa_conf = mysqli_query($conexao, $sql_conf) or die ("<b>usuarios.php</b><br> ".mysqli_error($conexao));
  $listar_conf = mysqli_fetch_assoc($executa_conf);

  $cor_lados = $listar_conf["cor_lados"];
  $cor_meio = $listar_conf["cor_meio"];
  $cor_tit = $listar_conf["cor_tit"];
  $fonte_tit = $listar_conf["fonte_tit"];
  $cor_links = $listar_conf["cor_links"];
  $cor_comentario = $listar_conf["cor_comentario"];
  $foto_pessoal = $listar_user["foto"];
  $titulo_conf = $listar_conf["titulo"];

  if ($foto == ""){
    $sql_foto = "SELECT * FROM fotos WHERE user = \"".$nome."\" ORDER BY id DESC;";
  }else{
    $sql_foto = "SELECT * FROM fotos WHERE user = \"".$nome."\" and id = ".$foto.";";
  }
  $executa_foto = mysqli_query($conexao, $sql_foto) or die ("<b>usuarios.php</b><br> ".mysqli_error($conexao));
  $listar_foto = mysqli_fetch_assoc($executa_foto);
  $contar_foto = mysqli_num_rows($executa_foto);

  $id_foto = $listar_foto["id"];
  $foto_name = $listar_foto["foto"];
  $comentario_foto = $listar_foto["comentario"];
  $data_foto = $listar_foto["data"];

  $sql_com = "SELECT * FROM comentarios WHERE user = \"".$nome."\" and foto = '".$id_foto."' ORDER BY id DESC;";
  $executa_com = mysqli_query($conexao, $sql_com) or die ("<b>usuarios.php</b><br> ".mysqli_error($conexao));
  $contar_com = mysqli_num_rows($executa_com);
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
              <tr align="center" class="texto"> 
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr align="center"> 
                <td colspan="2"><font size="2" color="<? echo $cor_tit; ?>" face="<? echo $fonte_tit; ?>, Verdana, Arial"><b><? echo $titulo_conf; ?></b></font></td>
              </tr>
              <tr align="center" class="texto"> 
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr align="center"> 
                <td colspan="2" class="texto_gran"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="center" class="texto_gran"> 
                        <? if ($contar_foto == "0"){ echo "<img src=\"".$end_objetos."arquivos/images/sem_foto.gif\">"; } else { echo "<img src=\"".$nome."/images/".$foto_name."\">"; } ?>
                      </td>
                    </tr>
                    <? if ($contar_foto == "0"){ ?>
                    <tr> 
                      <td align="center" class="texto"><font color="<? echo $cor_comentario; ?>">Sem foto no momento</font></td>
                    </tr>
                    <? } else{ ?>
                    <tr> 
                      <td align="center" class="texto_gran"> <font color="<? echo $cor_tit; ?>"><? echo $data_foto; ?></font> 
                      </td>
                    </tr>
                    <tr> 
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td class="texto_gran"> <font color="<? echo $cor_comentario; ?>"><? echo wordwrap(nl2br($comentario_foto), 60, "\n", 1); ?></font> 
                            </td>
                          </tr>
                        </table></td>
                    </tr>
                    <? } ?>
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2" class="titulo"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td colspan="2" class="td">Coment&aacute;rios desta foto:</td>
                    </tr>
                    <tr> 
                      <td width="20%">&nbsp;</td>
                      <td width="80%">&nbsp;</td>
                    </tr>
                    <? if ($contar_com == "0"){ ?>
                    <tr> 
                      <td colspan="2" align="center" class="texto"><font color="<? echo $cor_comentario; ?>">Nenhum 
                        coment&aacute;rio encontrado</font></td>
                    </tr>
                    <? }else{ 
					while($listar_com = mysqli_fetch_assoc($executa_com)){?>
                    <tr> 
                      <td colspan="2" class="texto_gran"><font color="<? echo $cor_comentario; ?>">Em 
                        <? echo $listar_com["data"]; ?> </font><? if($listar_com["email"] != ""){ echo "<a href=\"mailto:".$listar_com["email"]."\">"; } echo "<font color=\"".$cor_tit."\">".$listar_com["nome"]."</font>"; if($listar_com["email"] != ""){ echo "</a>"; } ?> 
                        <font color="<? echo $cor_comentario; ?>">comentou:</font></td>
                    </tr>
                    <tr> 
                      <td colspan="2" valign="top"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td class="texto"><font color="<? echo $cor_comentario; ?>"> 
                              <? echo wordwrap(nl2br($listar_com["comentario"]), 60, "\n", 1); ?></font></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td colspan="2"><hr align="center" width="100%" size="1" color="<? echo $cor_comentario; ?>"></td>
                    </tr>
                    <? } 
					}?>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2"> 
                  <? if ($contar_foto == "0"){ echo "&nbsp;"; } else{ ?>
                  <form name="comentario" method="post" action="add_comentario.php?nome=<? echo $nome; ?>&foto=<? echo $id_foto; ?>" onSubmit="return valida_comentario(this);">
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr align="center"> 
                        <td colspan="2" class="td"><font color="#000000">Deixe 
                          seu coment&aacute;rio:</font></td>
                      </tr>
                      <tr class="texto"> 
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <? if ($status_comentario != ""){ ?>
                      <tr align="center"> 
                        <td colspan="2" class="texto_gran"><font color="<? echo $cor_comentario; ?>"> 
                          <? if ($status_comentario == "ok"){ echo "Dados cadastrados com sucesso!"; } else { echo "Preencha seu nome e seu comentário."; } ?>
                          </font></td>
                      </tr>
                      <? } ?>
                      <tr class="texto"> 
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td align="right" class="texto"><font color="<? echo $cor_comentario; ?>">Nome:</font></td>
                        <td><input name="nome_comentario" type="text" class="form" id="nome_comentario2" size="30" maxlength="40"></td>
                      </tr>
                      <tr> 
                        <td align="right" class="texto"><font color="<? echo $cor_comentario; ?>">E-mail:</font></td>
                        <td><input name="email_comentario" type="text" class="form" id="email_comentario" size="50" maxlength="50"></td>
                      </tr>
                      <tr> 
                        <td align="right" valign="top" class="texto"><font color="<? echo $cor_comentario; ?>">Coment&aacute;rio:</font></td>
                        <td><textarea name="comentario_comentario" cols="35" rows="4" class="form" id="comentario_comentario"></textarea></td>
                      </tr>
                      <tr align="center"> 
                        <td height="25" colspan="2"> <input name="sendBtn" type="submit" class="form" id="sendBtn" value="Enviar"></td>
                      </tr>
                    </table>
                  </form>
                  <? } ?>
                </td>
              </tr>
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
