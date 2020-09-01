<?
include "ver_login.php";

$busca = isset($_GET["busca"]) ? $_GET["busca"] : "";
$por = isset($_GET["por"]) ? $_GET["por"] : "";

if ($busca != ""){
  if($por == ""){
    $buscar = "nome";
  }elseif($por == "nome"){
    $buscar = "nome";
  }elseif($por == "username"){
    $buscar = "username";
  }else{
    $buscar = "nome";
  }
  
  if ($buscar == "nome"){
    $sql = "SELECT * FROM user WHERE nome LIKE '%".$busca."%' OR sobrenome LIKE '%".$busca."%';";
  }else{
    $sql = "SELECT * FROM user WHERE username LIKE '%".$busca."%';";
  }
  
  $exe = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
  $contar = mysqli_num_rows($exe);
}

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
    <td colspan="4" align="center" valign="top"> <form name="busca" method="get" action="busca.php">
        <table width="570" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="28">&nbsp;</td>
            <td width="514">&nbsp;</td>
            <td width="28">&nbsp;</td>
          </tr>
          <tr> 
            <td><img src="<? echo $end_objetos; ?>arquivos/images/ponta_esq_busca.gif" width="28" height="30"></td>
            <td height="30" align="center" bgcolor="#EEEEEE" class="texto_gran">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="8%" align="center" class="texto_gran">Busca:</td>
                  <td width="43%" align="center"> <input name="busca" type="text" class="form" size="40" value="<? echo $busca; ?>"> 
                  </td>
                  <td width="14%" align="center"> 
                    <input type="submit" class="form" value="Buscar">
                  </td>
                  <td width="35%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="22%" align="right"> <input name="por" type="radio" value="nome"<? if ($por != "username"){ echo " checked"; } ?>> 
                        </td>
                        <td width="22%" class="texto">Nome</td>
                        <td width="11%" align="right" class="texto"> <input type="radio" name="por" value="username"<? if ($por == "username"){ echo " checked"; } ?>> 
                        </td>
                        <td width="45%" class="texto">Username</td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
            <td align="right"><img src="<? echo $end_objetos; ?>arquivos/images/ponta_dir_busca.gif" width="28" height="30"></td>
          </tr>
          <tr> 
            <td colspan="3"> <table width="570" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="5" bgcolor="#EEEEEE">&nbsp;</td>
                  <td width="560" height="200" align="center" valign="top" class="texto_gran"> 
                    <? if ($busca == ""){ ?>
                    <table width="500" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td align="center" class="texto_gran">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" class="texto_gran">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td align="center" class="texto_gran">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td align="center" class="texto_gran">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="100" align="center" background="<? echo $end_objetos; ?>arquivos/images/fundo_busca.gif" class="texto_gran"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="23%">&nbsp;</td>
                              <td width="77%" class="texto_gran">Busque por seus amigos cadastrados 
                                no <? echo $nome_site; ?></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
				    <? } else { ?>
                    <table width="500" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td height="50" colspan="2" class="titulo"><table width="500" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="100"><img src="<? echo $end_objetos; ?>arquivos/images/resultado_busca.gif" width="170" height="30"></td>
                              <td width="400" align="center" background="<? echo $end_objetos; ?>arquivos/images/fundo_resultado.gif"><font class="texto_gran">Buscando 
                                por: </font><font class="texto"><? echo $buscar; ?></font></td>
                            </tr>
                          </table></td>
                      </tr>
                      <? if ($contar != 0){
					  while ($listar = mysqli_fetch_assoc($exe)){ 
					  
					  $nome_busca = str_replace($busca, "<b>".$busca."</b>", $listar["nome"]);
					  $sobrenome_busca = str_replace($busca, "<b>".$busca."</b>", $listar["sobrenome"]);
					  
					  ?>
                      <tr> 
                        <td height="17" colspan="2"><font class="texto_gran">Nome:</font> 
                          <font class="texto">
						  <? echo $nome_busca." ".$sobrenome_busca; ?></font></td>
                      </tr>
                      <tr> 
                        <td height="17" colspan="2" class="texto"><font class="texto_gran"><? echo $nome_site; ?>:</font> 
                         
						  <a href="<? echo "usuarios.php?nome=".$listar["username"]; ?>" target="_blank" title="http://<? 
							
							if($link_usuario == 0){
								$des_link_usuario = $listar["username"].".".$dominio;
							}else{
								$des_link_usuario = $url_site."/".$listar["username"];
							} echo $des_link_usuario;
							
						  ?>">
						  
						  <font color="#000000">http://<? echo $des_link_usuario; ?></font></a></td>
                      </tr>
                      <tr> 
                        <td colspan="2"><hr size="1"></td>
                      </tr>
                      <?	 } ?>
                      <tr align="right"> 
                        <td colspan="2" class="texto"><? echo $contar." "; if ($contar == 1){ echo "resultado 
                          encontrado"; } else { echo "resultados 
                          encontrados"; } ?></td>
                      </tr>
                      <?
					 }else{ ?>
                      <tr valign="bottom"> 
                        <td colspan="2" align="center" class="texto_gran">&nbsp;</td>
                      </tr>
                      <tr valign="bottom"> 
                        <td colspan="2" align="center" class="texto_gran"><hr size="1"></td>
                      </tr>
                      <tr valign="bottom"> 
                        <td colspan="2" align="center" class="texto_gran"><font color="#0000FF">Nenhum 
                          resultado encontrado para:</font></td>
                      </tr>
                      <tr> 
                        <td height="25" colspan="2" align="center" class="titulo"><? echo $busca; ?></td>
                      </tr>
                      <? } ?>
                    </table> 
                    <? } ?>
                  </td>
                  <td width="5" bgcolor="#EEEEEE">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_03.gif" width="28" height="20"></td>
            <td bgcolor="#EEEEEE" class="texto" align="center"><font color="#CCCCCC">&copy; 
              2006 <? echo $nome_site." ".$criador; ?></font></td>
            <td align="right"><img src="<? echo $end_objetos; ?>arquivos/images/borda_adm_04.gif" width="28" height="20"></td>
          </tr>
        </table>
      </form></td>
  </tr>
  <tr> 
    <td colspan="5"> 
      <? include "rodape.php" ?>
    </td>
  </tr>
</table>
</body>
</html>
