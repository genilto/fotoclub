<? 
include "valida_user.php"; 
$local_pagina = "adm_links";
$pagina_nome = "Meus links";

$status = isset($_GET["status"]) ? $_GET["status"] : "";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$nome_link = isset($_POST["nome"]) ? $_POST["nome"] : "";
$link_link = isset($_POST["link"]) ? $_POST["link"] : "";
$cor = "";

if($acao == "deletar"){ 
			$sql_del = "DELETE FROM links WHERE user = '".$login_usuario."' and id = ".$id;
			$executa_del = mysqli_query($conexao, $sql_del) or die (mysqli_error($conexao));
			$status = "deleta_ok";
			$acao = "";
}
elseif($acao == "editando"){
if ($nome_link == ""){
$status = "sem_nome";
$acao = "editar";
}else{
if ($link_link == ""){
$status = "sem_link";
$acao = "editar";
  }else{
$sql_edita = "UPDATE links SET 
              nome = '".htmlspecialchars($nome_link)."',
			  link = '".htmlspecialchars($link_link)."'
              WHERE id = ".$id;
			 
			$executa_edita = mysqli_query($conexao, $sql_edita) or die (mysqli_error($conexao));
			$status = "edita_ok";
			$acao = "";
			}
	  }
}
elseif($acao == "inserindo"){
if ($nome_link == ""){
$status = "sem_nome";
$acao = "inserir";
}else{
if ($link_link == ""){
$status = "sem_link";
$acao = "inserir";
  }else{
$sql_insere = "INSERT INTO links(
			  user,
			  nome, 
			  link
			  ) VALUES (
			  '".$login_usuario."',
			  '".htmlspecialchars($nome_link)."',
			  '".htmlspecialchars($link_link)."'
			  );";
			 
			$executa_insere = mysqli_query($conexao, $sql_insere) or die (mysqli_error($conexao));
			$status = "insere_ok";
			$acao = "";
			}
	  }
}

$sql_user = "SELECT * FROM user WHERE username = '".$login_usuario."'";
$executa_user = mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));
$listar_user = mysqli_fetch_assoc($executa_user);

$sql_links = "SELECT * FROM links WHERE user = '".$login_usuario."' ORDER BY id DESC";
$executa_links = mysqli_query($conexao, $sql_links) or die (mysqli_error($conexao));
$contar_links = mysqli_num_rows($executa_links);

if ($id != ""){
$sql_links2 = "SELECT * FROM links WHERE id = ".$id;
$executa_links2 = mysqli_query($conexao, $sql_links2) or die (mysqli_error($conexao));
$listar_links2 = mysqli_fetch_assoc($executa_links2);
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
        <tr align="center"> 
          <td class="titulo">&nbsp;</td>
        </tr>
        <tr> 
          <td height="30" class="titulo" align="center" background="<? echo $end_objetos; ?>arquivos/images/barra_adm.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="1%">&nbsp;</td>
                <td width="68%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="center" valign="middle" class="titulo"><font color="#000000">Administra&ccedil;&atilde;o 
                        do <? echo $nome_site; ?></font>: <font color="#0000FF"><a title="<? echo $pagina_nome; ?>" href="links.php?nome=<? echo $login_usuario; ?>"><font color="#0000FF"><? echo $pagina_nome; ?></font></a></font></td>
                    </tr>
                  </table></td>
                <td width="31%" align="center" valign="middle" class="texto_gran"><font color="#FFFFFF"><? echo $listar_user["nome"]; ?></font></td>
              </tr>
            </table></td>
        </tr>
        <tr align="center"> 
          <td> 
            <? include "menu_adm.php"; ?>
          </td>
        </tr>
        <tr> 
          <td height="25" class="texto_gran"><? if ($acao == ""){ echo "Abaixo est&atilde;o listados todos 
            os seus links cadastrados:"; } if ($acao == "editar"){ echo "Editando link: <font color=\"#FF0000\">\"".$listar_links2["nome"]."\"</font>"; } if ($acao == "inserir"){ echo "Inserindo novo Link:"; } ?></td>
        </tr>
		<? if ($status != ""){ ?>
        <tr> 
          <td align="center" class="td">
		  <? switch($status){
		  case "deleta_ok":
		         echo "Link deletado com sucesso!";
				 break;
		  case "edita_ok":
		        echo "Link editado com sucesso!";
				break;
		  case "insere_ok":
		        echo "Link inserido com sucesso!";
				break;
		  case "sem_nome":
		        echo "Por favor preencha o nome do link!";
				break;
		  case "sem_link":
		        echo "Por favor preencha o Link!";
				break;
		  	} 
		  ?> 
		  </td>
		  </tr>
		   <tr class="texto_gran"> 
          <td>&nbsp;</td>
        </tr>
        <? }else{ ?>
		 <tr class="texto_gran"> 
          <td>&nbsp;</td>
        </tr>
		<? } ?>
		<tr> 
          <td align="center" class="titulo">
		  
		  <? if ($acao == ""){ ?>
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="5%" align="center" bgcolor="#99CC99" class="texto_gran"><img src="<? echo $end_objetos; ?>arquivos/images/mundo.gif" width="15" height="15"></td>
                <td width="71%" bgcolor="#99CC99" class="texto_gran">Nome do link</td>
                <td width="12%" align="center" bgcolor="#99CC99" class="texto">Editar</td>
                <td width="12%" align="center" bgcolor="#99CC99" class="texto">Excluir</td>
              </tr>
              <? if ($contar_links != "0"){
			  while($listar_link = mysqli_fetch_assoc($executa_links)){ 
			  if ($cor == "#FFFFFF"){ $cor = "#EEEEEE"; } else { $cor = "#FFFFFF"; }?>
              <tr> 
                <td height="20" colspan="2" bgcolor="<? echo $cor; ?>" class="texto"><img src="<? echo $end_objetos; ?>arquivos/images/lista.gif" width="21" height="7" border="0"><a href="http://<? echo $listar_link["link"]; ?>" title="<? echo $listar_link["link"]; ?>" target="_blank"><font color="#000000"><? echo $listar_link["nome"]; ?></font></a></td>
                <td align="center" bgcolor="<? echo $cor; ?>"><a href="adm_links.php?id=<? echo $listar_link["id"]; ?>&acao=editar" title="Editar link"><img src="<? echo $end_objetos; ?>arquivos/images/<? if ($cor == "#FFFFFF"){ echo "editar.gif"; }else {echo "editar2.gif"; } ?>" width="16" height="16" border="0"></a></td>
                <td align="center" bgcolor="<? echo $cor; ?>"><a href="adm_links.php?id=<? echo $listar_link["id"]; ?>&acao=deletar" title="Deletar link" onClick="return valida_confirma();"><img src="<? echo $end_objetos; ?>arquivos/images/<? if ($cor == "#FFFFFF"){ echo "lixo.gif"; }else {echo "lixo2.gif"; } ?>" width="16" height="16" border="0"></a></td>
              </tr>
              <? }
			  }else{ ?>
              <tr align="center">
                <td colspan="4" height="10"></td>
              </tr>
              <tr align="center"> 
                <td height="20" colspan="4" class="titulo"><font color="#000000">Nenhum 
                  link cadastrado</font></td>
              </tr>
              <? } ?>
              <tr> 
                <td colspan="2">&nbsp;</td>
                <td colspan="2" align="center" class="texto_gran">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="2" class="texto_gran">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="7%" align="center"><a href="adm_links.php?acao=inserir"><img src="<? echo $end_objetos; ?>arquivos/images/inserir_link.gif" alt="Inserir link" width="20" height="20" border="0"></a></td>
                      <td width="93%" class="texto_gran"><a href="adm_links.php?acao=inserir" title="Inserir link"><font color="#0000FF">Inserir 
                        Link</font></a></td>
                    </tr>
                  </table></td>
                <td colspan="2" align="center" class="texto_gran">Total: <? echo $contar_links; ?> 
                  links.</td>
              </tr>
              <tr> 
                <td colspan="2">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
			<? }elseif($acao == "editar"){?>
            <form name="edita_link" method="post" action="adm_links.php?acao=editando&id=<? echo $id; ?>">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td colspan="2">&nbsp;</td>
                  <td width="5%"><a href="adm_links.php"><img src="<? echo $end_objetos; ?>arquivos/images/listar_todos.gif" alt="Listar todos" width="20" height="20" border="0"></a></td>
                  <td width="27%" class="texto_gran"><a href="adm_links.php" title="Listar todos"><font color="#0000FF">Listar 
                    todos</font></a></td>
                </tr>
                <tr> 
                  <td width="23%" height="25" align="right" class="texto">Nome 
                    do link:</td>
                  <td colspan="3" class="texto"> 
                    <input name="nome" type="text" class="form" id="nome" value="<? echo $listar_links2["nome"]; ?>" size="30" maxlength="25">
                    EX.:&nbsp;<? echo $nome_site?></td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Link:</td>
                  <td><input name="link" type="text" class="form" id="link" value="<? echo $listar_links2["link"]; ?>" size="50" maxlength="100"></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td colspan="3" class="texto">Ex.:&nbsp;<? echo $url_site; ?></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td><input name="imageField" type="image" src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Editar" width="89" height="29" border="0"> 
                    <a href="adm_links.php"><img src="<? echo $end_objetos; ?>arquivos/images/cancelar.gif" alt="Cancelar" width="89" height="29" border="0"></a></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td colspan="3" align="right"><img src="<? echo $end_objetos; ?>arquivos/images/link_fundo.gif" width="128" height="128"></td>
                </tr>
              </table>
            </form> 
            <? }elseif($acao == "inserir"){ ?>
			<form name="edita_link" method="post" action="adm_links.php?acao=inserindo">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td colspan="2">&nbsp;</td>
                  <td width="5%" align="center"><a href="adm_links.php"><img src="<? echo $end_objetos; ?>arquivos/images/listar_todos.gif" alt="Listar todos" width="20" height="20" border="0"></a></td>
                  <td width="27%" class="texto_gran"><a href="adm_links.php" title="Listar todos"><font color="#0000FF">Listar 
                    todos</font></a></td>
                </tr>
                <tr> 
                  <td width="23%" height="25" align="right" class="texto">Nome 
                    do link:</td>
                  <td colspan="3" class="texto"> 
                    <input name="nome" type="text" class="form" id="nome" size="30" maxlength="25" value="<? echo $nome_link; ?>">
                    EX.:&nbsp;<? echo $nome_site?> </td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Link:</td>
                  <td><input name="link" type="text" class="form" id="link" size="50" maxlength="100" value="<? echo $link_link; ?>"></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td colspan="3" class="texto">Ex.:&nbsp;<? echo $url_site; ?></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td><input name="imageField" type="image" src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Inserir" width="89" height="29" border="0"> 
                    <a href="adm_links.php"><img src="<? echo $end_objetos; ?>arquivos/images/cancelar.gif" alt="Cancelar" width="89" height="29" border="0"></a></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td colspan="3" align="right"><img src="<? echo $end_objetos; ?>arquivos/images/link_fundo.gif" width="128" height="128"></td>
                </tr>
              </table>
            </form> 
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
