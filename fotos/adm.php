<? 
include "valida_user.php";
$local_pagina = "administracao"; 

$sql_user = "SELECT * FROM user WHERE username = '".$login_usuario."'";
$executa_user = mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));
$listar_user = mysqli_fetch_assoc($executa_user);

$sql_fotos = "SELECT * FROM fotos WHERE user = '".$login_usuario."' ORDER BY id DESC";
$sql_noticias = "SELECT * FROM noticias WHERE user = '".$login_usuario."'";
$sql_links = "SELECT * FROM links WHERE user = '".$login_usuario."'";
$sql_amigos = "SELECT * FROM amigos WHERE user = '".$login_usuario."'";
$sql_contador = "SELECT * FROM contador WHERE user = '".$login_usuario."'";
$sql_online = "SELECT DISTINCT ip FROM online WHERE nome = '".$login_usuario."'";

$executa_fotos = mysqli_query($conexao, $sql_fotos) or die (mysqli_error($conexao));
$executa_noticias = mysqli_query($conexao, $sql_noticias) or die (mysqli_error($conexao));
$executa_links = mysqli_query($conexao, $sql_links) or die (mysqli_error($conexao));
$executa_amigos = mysqli_query($conexao, $sql_amigos) or die (mysqli_error($conexao));
$executa_contador = mysqli_query($conexao, $sql_contador) or die (mysqli_error($conexao));
$executa_online = mysqli_query($conexao, $sql_online) or die (mysqli_error($conexao));

$contar_fotos = mysqli_num_rows($executa_fotos);
$contar_noticias = mysqli_num_rows($executa_noticias);
$contar_links = mysqli_num_rows($executa_links);
$contar_amigos = mysqli_num_rows($executa_amigos);
$listar_contador = mysqli_fetch_assoc($executa_contador);
$contar_online = mysqli_num_rows($executa_online);

$listar_fotos = mysqli_fetch_assoc($executa_fotos);

if($link_usuario == 0){
	$des_link_usuario = $login_usuario.".".$dominio;
}else{
	$des_link_usuario = $url_site."/".$login_usuario;
}
	
?><html>
<head>
<title><? echo $titulo ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
<LINK REL="SHORTCUT ICON" HREF="<? echo $end_objetos; ?>arquivos/images/icon.gif">
</head>

<body topmargin="0" leftmargin="0">
<? include "topo.php"; ?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="138" valign="top"> 
      <? include "menu.php"; ?>
    </td>
    <td width="614" colspan="4" align="center" valign="top"> 
	
	<table width="550" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="3" align="center" class="titulo">&nbsp;</td>
        </tr>
        <tr> 
          <td height="30" colspan="3" class="titulo" align="center" background="<? echo $end_objetos; ?>arquivos/images/barra_adm.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="1%">&nbsp;</td>
                <td width="68%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="center" valign="middle" class="titulo"><font color="#000000">Administra&ccedil;&atilde;o 
                        do <? echo $nome_site; ?></font></td>
                    </tr>
                  </table></td>
                <td width="31%" align="center" valign="middle" class="texto_gran"><font color="#FFFFFF"><? echo $listar_user["nome"]; ?></font></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td colspan="3" align="center"> 
            <? include "menu_adm.php"; ?>
          </td>
        </tr>
		</table>
		
      <table width="600" align="center" cellpadding="0" cellspacing="0">
        <tr class="texto"> 
          <td width="166" height="12" align="center">&nbsp;</td>
          <td width="296">&nbsp;</td>
          <td width="150">&nbsp;</td>
        </tr>
        <tr> 
          <td colspan="2" valign="top"> 
            <table width="410" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_01.gif" width="28" height="20"></td>
                <td width="354" align="center" bgcolor="#EEEEEE" class="texto_gran">O 
                  que eu fa&ccedil;o aqui?</td>
                <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_02.gif" width="28" height="20"></td>
              </tr>
              <tr> 
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5" bgcolor="#EEEEEE">&nbsp;</td>
                      <td height="250" align="center" valign="top" class="texto"> 
                        <table width="350" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td class="texto">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td class="texto"><p>&nbsp;Ol&aacute; <? echo $listar_user["nome"]." ".$listar_user["sobrenome"]; ?>, 
                                est&aacute; &eacute; sua p&aacute;gina de configura&ccedil;&atilde;o 
                                de sua p&aacute;gina de fotos <? echo $nome_site; ?>.</p>
                              <p>&nbsp;Aqui voc&ecirc; poder&aacute; postar suas 
                                fotos, links preferidos, not&iacute;cias, achar 
                                amigos que tenham cadastro aqui e tamb&eacute;m 
                                poder&aacute; definir as cores e fontes de seu 
                                fotolog.</p>
                              <p><font class="texto_gran">Sua p&aacute;gina de 
                                fotos &eacute;:</font><br>
                                <a href="usuarios.php?nome=<? echo $login_usuario; ?>" title="http://<? echo $des_link_usuario; ?>"><font color="#000000">http://<? echo $des_link_usuario; ?></font></a></p>
                              <p><font class="texto_gran">P&aacute;gina de login:</font><br>
                                <a href="login.php" title="Login"><font color="#000000">http://<? echo $url_site; ?>/login.php 
                                </font> </a></p>
                              <p>&nbsp;</p></td>
                          </tr>
                          <tr> 
                            <td align="center" class="texto_gran">Divirta-se...</td>
                          </tr>
                        </table>
                      </td>
                      <td width="5" bgcolor="#EEEEEE">&nbsp;</td>
                    </tr>
                  </table> </td>
              </tr>
              <tr> 
                <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_03.gif" width="28" height="20"></td>
                <td width="354" bgcolor="#EEEEEE">&nbsp;</td>
                <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_04.gif" width="28" height="20"></td>
              </tr>
            </table>
          </td>
          <td valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#99CC99">
              <tr> 
                <td><img src="<? echo $end_objetos; ?>arquivos/images/borda_menu.gif" width="150" height="20"></td>
              </tr>
              <tr class="texto">
                <td align="center" class="texto_gran">&nbsp;</td>
              </tr>
              <tr> 
                <td align="center" class="texto_gran">&Uacute;ltima postada</td>
              </tr>
              <tr> 
                <td align="center"><img src="<? if ($contar_fotos == "0"){ echo $end_objetos."arquivos/images/sem_foto_peq.gif"; } else{ echo $login_usuario."/thumbs/".$listar_fotos["thumb"]; } ?>" border="2"></td>
              </tr>
              <tr> 
                <td align="center" class="texto"> 
                  <? if ($contar_fotos == "0"){ echo "sem fotos"; } else { echo $listar_fotos["data"]; } ?>
                </td>
              </tr>
              <tr class="texto"> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="<? echo $end_objetos; ?>arquivos/images/barra_estatisticas.gif" width="150" height="20"></td>
              </tr>
              <tr> 
                <td><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr class="texto"> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td width="72%" height="15" class="texto">Total fotos:</td>
                      <td width="28%" class="texto_gran"><? echo $contar_fotos; ?></td>
                    </tr>
                    <tr> 
                      <td height="15" class="texto">Total not&iacute;cias</td>
                      <td class="texto_gran"><? echo $contar_noticias; ?></td>
                    </tr>
                    <tr> 
                      <td height="15" class="texto">Total links:</td>
                      <td class="texto_gran"><? echo $contar_links; ?></td>
                    </tr>
                    <tr> 
                      <td height="15" class="texto">Total amigos:</td>
                      <td class="texto_gran"><? echo $contar_amigos; ?></td>
                    </tr>
                    <tr> 
                      <td height="15" class="texto">Total acessos:</td>
                      <td class="texto_gran"> 
                        <? if ($listar_contador["acessos"] == ""){ echo "0"; } else{ echo $listar_contador["acessos"]; } ?>
                      </td>
                    </tr>
                    <tr> 
                      <td height="15" class="texto">Online agora:</td>
                      <td class="texto_gran"><? echo $contar_online; ?></td>
                    </tr>
                    <tr> 
                      <td class="texto">&nbsp;</td>
                      <td class="texto_gran">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr class="texto"> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="<? echo $end_objetos; ?>arquivos/images/borda_menu_adm_baixo.gif" width="150" height="20"></td>
              </tr>
            </table></td>
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