<? 
include "valida_user.php"; 

$local_pagina = "adm_amigos";
$pagina_nome = "Meus amigos";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
$id = isset($_GET["id"]) ? $_GET["id"] : "";

$sql_user = "SELECT * FROM user WHERE username = '".$login_usuario."'";
$executa_user = mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));
$listar_user = mysqli_fetch_assoc($executa_user);

$busca = isset($_GET["busca"]) ? $_GET["busca"] : "";
$por = isset($_GET["por"]) ? $_GET["por"] : "";
$acao_busca = "nao_mostra";
$status = "";
$cor = "";

if($acao == "adicionando"){
if ($id == ""){
  $status = "Escolha um amigo para adicionar";
  $acao = "buscando";
}else{
  
  $sql_ver_amigo = "SELECT * FROM user WHERE id = '".$id."'";
  $exe_ver_amigo = mysqli_query($conexao, $sql_ver_amigo) or die (mysqli_error($conexao));
  $contar_ver_amigo = mysqli_num_rows($exe_ver_amigo);
  $listar_ver_amigo = mysqli_fetch_assoc($exe_ver_amigo);
  
  if ($contar_ver_amigo == 0){
    $status = "Não há nenhum usuário com id ".$id;
    $acao = "buscando";
  }else{
   $sql_amigos = "SELECT * FROM amigos WHERE user = '".$login_usuario."' and amigo = '".$listar_ver_amigo["username"]."'";
   $exe_amigos = mysqli_query($conexao, $sql_amigos) or die (mysqli_error($conexao));
   $contar_amigos = mysqli_num_rows($exe_amigos);
  if ($contar_amigos != 0){
    $status = "O usuário ".$listar_ver_amigo["nome"]." já está adicionado";
    $acao = "buscando";
  }elseif($listar_ver_amigo["username"] == $login_usuario){
	  $status = "Você não pode adicionar você mesmo!";
	  $acao = "buscando";
  }else{
	  $sql_insert = "INSERT INTO amigos (user, amigo) VALUES ('".$login_usuario."', '".$listar_ver_amigo["username"]."');";
	mysqli_query($conexao, $sql_insert) or die (mysqli_error($conexao));
	  $status = "Amigo adicionado com sucesso!";
	  $acao = "buscando";
	}
  }
 }
}elseif($acao == "deletar"){
  if ($id == ""){
    $status = "Escolha um amigo para deletar";
    $acao = "";
  }else{
    $sql_del = "DELETE FROM amigos WHERE id = '".$id."' and user = '".$login_usuario."'";
    mysqli_query($conexao, $sql_del) or die (mysqli_error($conexao));
    $status = "Amigo deletado com sucesso!";
    $acao = "";
 }
}
if ($acao == "buscando"){
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
  
  $acao = "adicionar";
  $acao_busca = "mostra";
 }else{
 $acao = "";
 }
}
$sql_amigos = "SELECT * FROM amigos WHERE user = '".$login_usuario."' ORDER BY id DESC;";
$exe_amigos = mysqli_query($conexao, $sql_amigos) or die (mysqli_error($conexao));
$contar_amigos = mysqli_num_rows($exe_amigos);

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
    <td width="614" colspan="4" align="center" valign="top"> 
	<table width="550" border="0" cellpadding="0" cellspacing="0">
        <tr align="center"> 
          <td colspan="3" class="titulo">&nbsp;</td>
        </tr>
        <tr> 
          <td height="30" colspan="3" class="titulo" align="center" background="<? echo $end_objetos; ?>arquivos/images/barra_adm.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="1%">&nbsp;</td>
                <td width="68%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="center" valign="middle" class="titulo"><font color="#000000">Administra&ccedil;&atilde;o 
                        do <? echo $nome_site; ?>: <font color="#0000FF">
						<a title="<? echo $pagina_nome; ?>" href="amigos.php?nome=<? echo $login_usuario; ?>"><font color="#0000FF"><? echo $pagina_nome; ?></font></a></font></font></td>
                    </tr>
                  </table></td>
                <td width="31%" align="center" valign="middle" class="texto_gran"><font color="#FFFFFF"><? echo $listar_user["nome"]; ?></font></td>
              </tr>
            </table></td>
        </tr>
        <tr align="center"> 
          <td colspan="3"> 
            <? include "menu_adm.php"; ?>
          </td>
        </tr>
        <tr> 
          <td colspan="3" align="center">
		  <? if ($status != ""){ ?>
		    <table width="500" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
              <tr> 
                <td align="center" class="td"><? echo $status; ?></td>
              </tr>
            </table> 
			<? } 
			if ($acao == "adicionar") { ?>
            <form name="add_amigos" method="get" action="adm_amigos.php">
		 <input type="hidden" name="acao" value="buscando">
		      <table width="550" border="0" cellspacing="0" cellpadding="0">
                <tr class="texto"> 
                  <td width="28">&nbsp;</td>
                  <td width="514" align="right">&nbsp;</td>
                  <td width="28">&nbsp;</td>
                </tr>
                <tr> 
                  <td><img src="<? echo $end_objetos; ?>arquivos/images/ponta_esq_busca.gif" width="28" height="30"></td>
                  <td height="30" align="center" bgcolor="#EEEEEE" class="texto_gran"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="13%" align="center" class="texto_gran">Adicionar:</td>
                        <td width="46%" align="center"> <input name="busca" type="text" class="form" size="40" value="<? echo $busca; ?>"> 
                        </td>
                        <td width="11%" align="center"> <input type="submit" class="form" value="Adicionar"> 
                        </td>
                        <td width="30%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                  <td colspan="3"> <table width="550" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="5" bgcolor="#EEEEEE">&nbsp;</td>
                        <td width="560" height="200" align="center" valign="top" class="texto_gran"> 
                          <? if ($acao_busca == "nao_mostra"){ ?>
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
                              <td height="100" align="center" background="<? echo $end_objetos; ?>arquivos/images/fundo_add_amigos.gif" class="texto_gran">Encontre 
                                e adicione seus amigos no <? echo $nome_site; ?></td>
                            </tr>
                          </table>
                          <? } else { ?>
                          <table width="500" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td height="50" colspan="2" class="titulo"><table width="500" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="100"><img src="<? echo $end_objetos; ?>arquivos/images/resultado_add_amigos.gif" width="170" height="30"></td>
                                    <td width="400" align="center" background="<? echo $end_objetos; ?>arquivos/images/fundo_resultado.gif"><font class="texto_gran">Buscando 
                                      por: </font><font class="texto"><? echo $buscar; ?></font></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <? if ($contar != 0){
					  while ($listar = mysqli_fetch_assoc($exe)){ ?>
                            <tr> 
                              <td height="17"><font class="texto_gran">Nome:</font> 
                                <font class="texto"><? echo $listar["nome"]." ".$listar["sobrenome"]; ?></font></td>
                              <td rowspan="2" class="texto_gran"><a href="adm_amigos.php?acao=adicionando&id=<? echo $listar["id"]; ?>&busca=<? echo $busca; ?>&por=<? echo $por; ?>" title="Adicionar <? echo $listar["nome"]; ?>"><font color="#0000FF">+ 
                                Adicionar</font></a></td>
                            </tr>
                            <tr> 
                              <td height="17" class="texto"><font class="texto_gran"><? echo $nome_site; ?>:</font> 
                                <a href="<? echo "usuarios.php?nome=".$listar["username"]; ?>" target="_blank" title="http://<? 
								if($link_usuario == 0){
									$des_link_usuario = $listar["username"].".".$dominio;
								}else{
									$des_link_usuario = $url_site."/".$listar["username"];
								}
								echo $des_link_usuario;
								?>"><font color="#000000">http://<? echo $des_link_usuario; ?></font></a></td>
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
                              <td align="center" class="texto_gran">&nbsp;</td>
                              <td align="center" class="texto_gran">&nbsp;</td>
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
                          <table width="500" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td align="right"> <input type="button" class="form" value="Cancelar" onClick="javascript:window.location='adm_amigos.php';"> 
                              </td>
                            </tr>
                          </table></td>
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
                <tr> 
                  <td colspan="3">&nbsp;</td>
                </tr>
              </table>
			</form>
			<? }elseif($acao == ""){ ?>
            <table width="550" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="20" class="texto_gran">Confira todos os amigos que 
                  voc&ecirc; adicionou:</td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="center" class="texto_gran">&nbsp;</td>
                      <td class="texto_gran">&nbsp;</td>
                      <td align="center" class="texto">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td width="3%" align="center" bgcolor="#99CC99" class="texto_gran">
					  <img src="<? echo $end_objetos; ?>arquivos/images/comentarios.gif" width="15" height="15"></td>
                      <td width="88%" bgcolor="#99CC99" class="texto_gran">Nome 
                        do amigo</td>
                      <td width="9%" align="center" bgcolor="#99CC99" class="texto">excluir</td>
                    </tr>
                    <? if ($contar_amigos != 0){
					  while($listar_amigos = mysqli_fetch_assoc($exe_amigos)){ 
					  if ($cor == "#FFFFFF"){ $cor = "#EEEEEE"; } else { $cor = "#FFFFFF"; }?>
                    <tr> 
                      <td align="center" bgcolor="<? echo $cor; ?>"><img src="<? echo $end_objetos; ?>arquivos/images/lista.gif" width="21" height="7"></td>
                      <td height="20" bgcolor="<? echo $cor; ?>" class="texto"><? echo $listar_amigos["amigo"]; ?></td>
                      <td align="center" bgcolor="<? echo $cor; ?>"><a href="adm_amigos.php?id=<? echo $listar_amigos["id"]; ?>&acao=deletar" title="Deletar amigo" onClick="return valida_confirma();"><img src="<? echo $end_objetos; ?>arquivos/images/<? if ($cor == "#FFFFFF"){ echo "lixo.gif"; }else {echo "lixo2.gif"; } ?>" width="16" height="16" border="0"></a></td>
                    </tr>
                    <? } 
					} else{ ?>
                    <tr align="center"> 
                      <td height="30" colspan="3" class="texto_gran">Nenhum amigo 
                        adicionado!</td>
                    </tr>
                    <? } ?>
                    <tr> 
                      <td>&nbsp;</td>
                      <td align="right" class="texto">Total de amigos: &nbsp;</td>
                      <td class="texto_gran"> <? echo $contar_amigos; ?></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td class="texto_gran"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="5%"><img src="<? echo $end_objetos; ?>arquivos/images/inserir_link.gif" width="20" height="20"></td>
                      <td width="95%" class="texto_gran"><a href="adm_amigos.php?acao=adicionar"><font color="#0000FF">Adicionar 
                        amigo</font></a></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="texto_gran">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table> 
            <? } ?>
          </td>
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
