<? 
$status = "";

include "valida_user.php"; 

$local_pagina = "adm_pagina";
$pagina_nome = "Configurando página";

$acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
$modo = isset($_POST["modo"]) ? $_POST["modo"] : "";

if ($acao == "editar"){
	$sql_user = "SELECT * FROM user WHERE username = '".$login_usuario."'";
	$executa_user = mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));
	$listar_user = mysqli_fetch_assoc($executa_user);

	$sql_config  = "SELECT * FROM config WHERE user = '".$login_usuario."'";
	$executa_config = mysqli_query($conexao, $sql_config) or die (mysqli_error($conexao));
	$listar_config = mysqli_fetch_assoc($executa_config);
	$id_config = $listar_config["id"];

	$titulo = $_POST["titulo"];
	$codigo_lados = $_POST["codigo_lados"];
	$codigo_meio = $_POST["codigo_meio"];
	$codigo_tit = $_POST["codigo_tit"];
	$codigo_links = $_POST["codigo_links"];
	$codigo_texto = $_POST["codigo_texto"];
	$fonte_tit = $_POST["fonte_tit"];

	//Verfica se os dados obrigatorios foram preenchidos
	if ($titulo == ""){
		$status = "Preencha o campo t&iacute;tulo!";
		$acao = "";
	}elseif ($codigo_lados == ""){
		$status = "Preencha a cor de fundo dos menus!";
		$acao = "";
	}elseif ($codigo_meio == ""){
		$status = "Preencha a cor de fundo do conte&uacute;do!";
		$acao = "";
	}elseif ($codigo_tit == ""){
		$status = "Preencha a cor do t&iacute;tulo!";
		$acao = "";
	}elseif ($codigo_links == ""){
		$status = "Preencha a cor dos links!";
		$acao = "";
	}elseif ($codigo_texto == ""){
		$status = "Preencha a cor do texto!";
		$acao = "";
	}elseif ($fonte_tit == ""){
		$status = "Escolha uma fonte para o t&iacute;tulo!";
		$acao = "";
	}else{
		$sql_edita = "UPDATE `config` SET
 							 `titulo` = '".htmlspecialchars($titulo)."',
							 `cor_lados` = '".$codigo_lados."', 
							 `cor_meio` = '".$codigo_meio."',
							 `fonte_tit` = '".$fonte_tit."',
							 `cor_tit` = '".$codigo_tit."',
							 `cor_comentario` = '".$codigo_texto."',
							 `cor_links` = '".$codigo_links."'
			  WHERE `id` = ".$id_config.";";
			  
		mysqli_query($conexao, $sql_edita) or die (mysqli_error($conexao));
		if(mysqli_affected_rows($conexao) > 0){
			$status = "As altera&ccedil;&otilde;es foram salvas com sucesso!";
		}else{
			$status = "N&atilde;o houve modifica&ccedil;&otilde;es!";	
		}	
		$acao = "";
	}
}
if($modo == "ajax"){

	echo $status;
	
}else{

	$sql_dados_pessoais = "SELECT * FROM user WHERE username = '".$login_usuario."';";
	$executa_dados_pessoais = mysqli_query($conexao, $sql_dados_pessoais) or die (mysqli_error($conexao));
	$listar_dados_pessoais = mysqli_fetch_assoc($executa_dados_pessoais);
	
	$nome_user = $listar_dados_pessoais["nome"];
	$sobrenome_user = $listar_dados_pessoais["sobrenome"];
	
	$sql_user = "SELECT * FROM config WHERE user = '".$login_usuario."'";
	$executa_user = mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));
	$listar_user = mysqli_fetch_assoc($executa_user);
	
	$sql_fontes = "SELECT * FROM fontes ORDER BY fonte ASC";
	$executa_fontes = mysqli_query($conexao, $sql_fontes);

	//inicia_sessao_js("script.js;ajax.js;funcoes.js;adm_pagina.js");
?>
<html>
<head>
<title><? echo $titulo ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<!--
<script src="include_js.php"></script>
-->
<script src="script.js"></script>
<script src="ajax.js"></script>
<script src="funcoes.js"></script>
<script src="adm_pagina.js"></script>

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
			<form action="adm_pagina.php" method="post" name="pagina" onSubmit="return salva(this.titulo, this.codigo_lados, this.codigo_meio, this.codigo_tit, this.codigo_links, this.codigo_texto, this.fonte_tit);">
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
                          do <? echo $nome_site; ?>: </font><font color="#0000FF"><a title="<? echo $pagina_nome; ?>" href="usuarios.php?nome=<? echo $login_usuario; ?>"><font color="#0000FF"><? echo $pagina_nome; ?></font></a></font></td>
                      </tr>
                    </table></td>
                  <td width="31%" align="center" valign="middle" class="texto_gran"><font color="#FFFFFF"><? echo $nome_user ?></font></td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td colspan="3" align="center"> 
              <? include "menu_adm.php"; ?>
            </td>
          </tr>
          <tr>
            <td height="25" colspan="3" class="texto_gran">Preencha abaixo as 
              cores e fontes de sua p&aacute;gina de fotos (Melhor funcionamento em Internet Explorer 5 ou superior) :</td>
          </tr>
          <tr id="status_tr">
            <td colspan="3" align="center"><table width="100%" cellpadding="0" cellspacing="0">
                <tr> 
                  <td width="524" align="center" class="td" id="status_td"></td>
                  <td width="24" align="center" class="td" id="fecha_status" onMouseOver="mostra_mao(this);" onClick="mostrar('status_tr', false);" title="Ocultar">X</td>
                </tr>
				<tr> 
                  <td colspan="2" height="2" bgcolor="#000000"></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table width="550" border="0" cellspacing="0" cellpadding="0">
          <tr bgcolor="#EEEEEE"> 
            <td width="8%" height="30" align="right" class="texto">T&iacute;tulo:</td>
            <td width="39%" class="texto"> 
              <input name="titulo" id="titulo" type="text" class="form" size="40" maxlength="50" value="<? echo $listar_user["titulo"]; ?>" onKeyUp="javascript:carrega_titulo();"></td>
            <td width="22%" height="30" align="right" class="texto">Fonte do T&iacute;tulo: 
            </td>
            <td width="31%"> 
              <select name="fonte_tit" id="fonte_tit" class="form" onChange="javascript:carrega_titulo();">
                <? 
				  $fonte = $listar_user["fonte_tit"];
				  while ($listar_fontes = mysqli_fetch_assoc($executa_fontes)){
				  
				  if ($fonte == $listar_fontes["fonte"]){
				  $sel = "selected";
				  }else{
				  $sel = "";
				  }
                      echo "<option ".$sel." value=\"".$listar_fontes["fonte"]."\">".$listar_fontes["fonte"]."</option>
					  ";
					 } 
					  ?>
              </select> </td>
          </tr>
        </table>
        <table width="550">
        <tr class="texto_gran" id="camada_pagina"> 
          <td align="center">
              <table width="550" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr align="center"> 
                  <td colspan="2" class="texto"><img src="<? echo $end_objetos; ?>arquivos/images/pagina/topo.gif" width="550" height="53"></td>
                </tr>
                <tr> 
                  <td colspan="2" align="right" class="texto"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="20%" align="center" valign="top" id="menu_esq"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td><img src="<? echo $end_objetos; ?>arquivos/images/pagina/menu_usuario.gif" width="110" height="12"></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td align="center" class="texto"> <font id="fonte_links_esq"><strong>Links</strong></font></td>
                          </tr>
                          <tr> 
                            <td align="center" class="texto"><a href="javascript:select_color('pagina.codigo_links');"><font id="fonte_links_esq_link">::Alterar cor::</font></a></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td align="center" class="texto"><a href="javascript:select_color('pagina.codigo_lados');"><font id="fonte_links_esq_baixo">::Alterar 
                              cor de fundo::</font></a></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                        <td width="74%" align="center" valign="top" id="conteudo"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td height="52" align="center"><font id="texto_titulo" size="2">&nbsp;</font><br>
                                <a href="javascript:select_color('pagina.codigo_tit');"><font id="texto_titulo_link" size="1" face="Verdana, Arial, Helvetica, sans-serif">::Alterar cor::</font></a></td>
                            </tr>
                            <tr> 
                              <td height="30" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/sem_foto_peq.gif" width="100" height="75"></td>
                            </tr>
                            <tr> 
                              <td height="50" align="center" class="texto">
							  <font id="fonte_comentario">Descri&ccedil;&atilde;o 
                                da foto e coment&aacute;rios</font>
								
								<br>
								<a href="javascript:select_color('pagina.codigo_texto');">
								<font id="fonte_comentario_link">::Alterar 
                                cor::</font></a>
								
								<br><br>
                                <a href="javascript:select_color('pagina.codigo_meio');"><font id="fonte_comentario_link_fundo">::Alterar 
                                cor de fundo::</font></a></td>
                            </tr>
                            <tr>
                              <td align="center" class="texto">
							    <input name="modo"             id="modo"             type="hidden" value="nao_ajax">	
								<input name="acao"             id="acao"             type="hidden" value="editar">
							    <input name="codigo_lados"     id="codigo_lados"     type="hidden" value="<? echo $listar_user["cor_lados"]; ?>">
							    <input name="codigo_meio"      id="codigo_meio"      type="hidden" value="<? echo $listar_user["cor_meio"]; ?>">
                                <input name="codigo_tit"       id="codigo_tit"       type="hidden" value="<? echo $listar_user["cor_tit"]; ?>">
								<input name="codigo_links"     id="codigo_links"     type="hidden" value="<? echo $listar_user["cor_links"]; ?>">
                                <input name="codigo_texto"     id="codigo_texto"     type="hidden" value="<? echo $listar_user["cor_comentario"]; ?>"></td>
                            
							</tr>
                          </table></td>
                        <td width="6%" align="center" valign="top" id="menu_dir"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td><img src="<? echo $end_objetos; ?>arquivos/images/pagina/menu_usuario.gif" width="110" height="12"></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td align="center" class="texto"> <font id="fonte_links_dir"><strong>Links</strong></font></td>
                          </tr>
                          <tr> 
                            <td align="center" class="texto"><a href="javascript:select_color('pagina.codigo_links');"><font id="fonte_links_dir_link">::Alterar 
                              cor::</font></a></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td align="center" class="texto"><a href="javascript:select_color('pagina.codigo_lados');"><font id="fonte_links_dir_baixo">::Alterar 
                              cor de fundo::</font></a></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr align="center"> 
                  <td colspan="2" class="texto"><img src="<? echo $end_objetos; ?>arquivos/images/pagina/rodape.gif" width="550" height="17"></td>
                </tr>
              </table>
          </td>
        </tr>
		</table>
		<table width="550" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td colspan="2" align="center" class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td height="25" colspan="2" align="center" class="texto"> <input name="envia" type="image" id="botao_salvar" src="<? echo $end_objetos; ?>arquivos/images/botao_salvar.gif" alt="Salvar alterações" width="89" height="29" border="0"> 
              &nbsp; <a href="usuarios.php?nome=<? echo $login_usuario; ?>"><img src="<? echo $end_objetos; ?>arquivos/images/ver_fotos.gif" alt="Ver minha p&aacute;gina de fotos" width="89" height="29" border="0"></a></td>
          </tr>
        </table>
      </form>
	   </td>
  </tr>
  <tr> 
    <td colspan="5"> 
      <? include "rodape.php" ?>
    </td>
  </tr>
</table>
<script>
	if("<? echo $status; ?>" == ""){
		mostrar('status_tr', false);
	}else{
		conteudo('status_td', "<? echo $status; ?>");
	}
	carrega_titulo();
	carrega_comentario();
	carrega_cores();
</script>
</body>
</html>
<? } ?>