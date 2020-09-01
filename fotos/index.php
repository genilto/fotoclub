<?
require_once "ver_login.php";

$sql_usuarios = "SELECT * FROM user ORDER BY id DESC LIMIT 2";
$executa_usuarios = mysqli_query($conexao, $sql_usuarios) or die (mysqli_error($conexao));
$contar_usuarios = mysqli_num_rows($executa_usuarios);

$sql_visitas = "SELECT * FROM contador ORDER BY acessos DESC LIMIT 2";
$executa_visitas = mysqli_query($conexao, $sql_visitas) or die (mysqli_error($conexao));
$contar_visitas = mysqli_num_rows($executa_visitas);

?>
<html>
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
    <td colspan="4" align="center" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="65%" valign="top">
		   <table width="390" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="51%" align="center" valign="top"> 
                  <table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_01.gif" width="28" height="20"></td>
                      <td width="104" align="center" bgcolor="#EEEEEE" class="texto_gran">&Uacute;ltimos 
                        Criados</td>
                      <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_02.gif" width="28" height="20"></td>
                    </tr>
                    <tr> 
                      <td colspan="3"><table width="160" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="5" bgcolor="#EEEEEE">&nbsp;</td>
                            <td><table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
                                <? 
					if ($contar_usuarios != "0"){
					while ($listar_usuarios = mysqli_fetch_assoc($executa_usuarios)){ 
					 ?>
                                <tr class="texto"> 
                                  <td width="188" align="center" class="texto">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td align="center" class="texto">
								  <a href="usuarios.php?nome=<? echo $listar_usuarios["username"]; ?>" title="http://<? 
									if($link_usuario == 0){
										$des_link_usuario = $listar_usuarios["username"].".".$dominio;
									}else{
										$des_link_usuario = $url_site."/".$listar_usuarios["username"];
									}
									echo $des_link_usuario; ?>">
									
								  <? if ($listar_usuarios["foto"] == "sem_foto_pessoal.gif"){ ?>
      <img src="<? echo $end_objetos; ?>arquivos/images/<? echo $listar_usuarios["foto"]; ?>" border="2" class="img_padrao">
      <? } else { ?>
      <img src="<? echo $listar_usuarios["username"]."/".$listar_usuarios["foto"]; ?>" border="2" class="img_padrao"> 
      <? } ?>
	  </a>
								  
								  <br> 
                                    <a href="usuarios.php?nome=<? echo $listar_usuarios["username"]; ?>" title="http://<? 
									if($link_usuario == 0){
										$des_link_usuario = $listar_usuarios["username"].".".$dominio;
									}else{
										$des_link_usuario = $url_site."/".$listar_usuarios["username"];
									}
									echo $des_link_usuario; ?>">
									
									<font color="#000000"><? echo $listar_usuarios["nome"]; ?></font></a></td>
                                
								</tr>
                                <tr class="texto"> 
                                  <td align="center" class="texto">&nbsp;</td>
                                </tr>

                                <tr class="texto"> 
                                  <td> <hr size="1"></td>
                                </tr>
                                <? }
					} else {?>
					<tr class="texto"> 
                                  <td height="100" align="center">Nenhum cadastrado</td>
                                </tr>
							<? }	?>
                              </table></td>
                            <td width="5" bgcolor="#EEEEEE">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_03.gif" width="28" height="20"></td>
                      <td width="104" bgcolor="#EEEEEE">&nbsp;</td>
                      <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_04.gif" width="28" height="20"></td>
                    </tr>
                  </table>
                </td>
                <td width="49%" align="center" valign="top"> 
                  <table width="160" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_01.gif" width="28" height="20"></td>
                      <td width="104" align="center" bgcolor="#EEEEEE" class="texto_gran">Mais 
                        visitados </td>
                      <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_02.gif" width="28" height="20"></td>
                    </tr>
                    <tr> 
                      <td colspan="3"><table width="160" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="5" bgcolor="#EEEEEE">&nbsp;</td>
                            <td><table width="140" border="0" align="center" cellpadding="0" cellspacing="0">
                                <? 
								if ($contar_visitas != 0){
					while ($listar_visitas = mysqli_fetch_assoc($executa_visitas)){ 
					$sql_visitados = "SELECT * FROM user WHERE username = '".$listar_visitas["user"]."'";
					$executa_visitados = mysqli_query($conexao, $sql_visitados) or die (mysqli_error($conexao));
					$listar_visitados = mysqli_fetch_assoc($executa_visitados);
					
					$sql_contar_visitados = "SELECT * FROM contador WHERE user = '".$listar_visitados["username"]."'";
					$rs = mysqli_query($conexao, $sql_contar_visitados) or die (mysqli_error($conexao));
					$contar_visitados = mysqli_fetch_assoc($rs);
					 ?>
                                <tr class="texto"> 
                                  <td width="188" align="center" class="texto">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td align="center" class="texto">
			 <a href="usuarios.php?nome=<? echo $listar_visitados["username"]; ?>" title="http://<? 
									if($link_usuario == 0){
										$des_link_usuario = $listar_visitados["username"].".".$dominio;
									}else{
										$des_link_usuario = $url_site."/".$listar_visitados["username"];
									}
									echo $des_link_usuario; ?>">
									
								  <? if ($listar_visitados["foto"] == "sem_foto_pessoal.gif"){ ?>
      <img src="<? echo $end_objetos; ?>arquivos/images/<? echo $listar_visitados["foto"]; ?>" border="2" class="img_padrao">
      <? } else { ?>
      <img src="<? echo $listar_visitados["username"]."/".$listar_visitados["foto"]; ?>" border="2" class="img_padrao"> 
      <? } ?>
	  </a>
								  
								  <br> 
                                    <a href="usuarios.php?nome=<? echo $listar_visitados["username"]; ?>" title="http://<? 
									if($link_usuario == 0){
										$des_link_usuario = $listar_visitados["username"].".".$dominio;
									}else{
										$des_link_usuario = $url_site."/".$listar_visitados["username"];
									}
									echo $des_link_usuario; ?>"><font color="#000000"><? echo $listar_visitados["nome"]; ?></font></a><br> (<? echo $contar_visitados["acessos"]; if ($contar_visitados["acessos"] == 1){ echo " visita"; } else { echo " visitas"; } ?>)</td>
                                </tr>
                                <tr class="texto"> 
                                  <td align="center" class="texto">&nbsp;</td>
                                </tr>
                                <tr class="texto"> 
                                  <td> <hr size="1"></td>
                                </tr>
                                <? } 
								} else{ ?>
								<tr class="texto"> 
                                  <td height="100" align="center">Ninguém recebeu 
                                    visitas</td>
                                </tr>
								<? } ?>
                              </table> </td>
                            <td width="5" bgcolor="#EEEEEE">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_03.gif" width="28" height="20"></td>
                      <td width="104" bgcolor="#EEEEEE">&nbsp;</td>
                      <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_04.gif" width="28" height="20"></td>
                    </tr>
                  </table>
                  
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </td>
          <td width="35%" align="center" valign="top"><table width="200" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_01.gif" width="28" height="20"></td>
                <td width="144" align="center" bgcolor="#EEEEEE" class="texto_gran">Fotolog <? echo $nome_site; ?>?!?!?</td>
                <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_02.gif" width="28" height="20"></td>
              </tr>
              <tr> 
                <td colspan="3"><table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="5" bgcolor="#EEEEEE">&nbsp;</td>
                      <td width="190"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr valign="top"> 
                            <td height="300" colspan="3" class="texto">&nbsp;&nbsp;&Eacute; 
                              o mais novo e o melhor &aacute;lbum de fotos da 
                              internet, &eacute; muito f&aacute;cil de usar e 
                              qualquer pessoa pode se cadastrar gratuitamente 
                              e sem qualquer complica&ccedil;&atilde;o.<br> <br> 
                              &nbsp; Depois de cadastrado o usu&aacute;rio poder&aacute; 
                              postar suas fotos para que todo mundo possa v&ecirc;-las 
                              e comentar sobre elas. E ainda ter&aacute; direito 
                              a comentarios, not&iacute;cias e links ilimitados.<br> 
                              <br>
                              &nbsp; Experimente você também deste serviço gratuito. 
                              E se você gostar indique este site a seus amigos.
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      <td width="5" bgcolor="#EEEEEE">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_03.gif" width="28" height="20"></td>
                <td width="144" bgcolor="#EEEEEE">&nbsp;</td>
                <td width="28" height="20"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_04.gif" width="28" height="20"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="5"> 
      <? include "rodape.php" ?>
    </td>
  </tr>
</table>
</body>
</html>
