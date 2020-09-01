<? 
include "valida_user.php"; 
$local_pagina = "adm_noticias";
$pagina_nome = "Minhas notícias";

$status = isset($_GET["status"]) ? $_GET["status"] : "";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$titulo_not = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
$noticia = isset($_POST["noticia"]) ? $_POST["noticia"] : "";
$cor = "";

if($acao == "deletar"){ 
			$sql_del = "DELETE FROM noticias WHERE user = '".$login_usuario."' and id = ".$id;
			$executa_del = mysqli_query($conexao, $sql_del) or die (mysqli_error($conexao));
			$status = "deleta_ok";
			$acao = "";
}
elseif($acao == "editando"){
if ($titulo_not == ""){
$status = "sem_titulo";
$acao = "editar";
}else{
if ($noticia == ""){
$status = "sem_noticia";
$acao = "editar";
  }else{
$sql_edita = "UPDATE noticias SET 
              titulo = '".htmlspecialchars($titulo_not)."',
			  noticia = '".htmlspecialchars($noticia)."',
			  data = '".$data."'
              WHERE id = ".$id;
			 
			$executa_edita = mysqli_query($conexao, $sql_edita) or die (mysqli_error($conexao));
			$status = "edita_ok";
			$acao = "";
			}
	  }
}
elseif($acao == "inserindo"){
if ($titulo_not == ""){
$status = "sem_titulo";
$acao = "inserir";
}else{
if ($noticia == ""){
$status = "sem_noticia";
$acao = "inserir";
  }else{
$sql_insere = "INSERT INTO noticias(
			  user,
			  titulo, 
			  noticia,
			  data
			  ) VALUES (
			  '".$login_usuario."',
			  '".htmlspecialchars($titulo_not)."',
			  '".htmlspecialchars($noticia)."',
			  '".$data."'
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

$sql_noticias = "SELECT * FROM noticias WHERE user = '".$login_usuario."' ORDER BY id DESC";
$executa_noticias = mysqli_query($conexao, $sql_noticias) or die (mysqli_error($conexao));
$contar_noticias = mysqli_num_rows($executa_noticias);

if ($id != ""){
$sql_noticias2 = "SELECT * FROM noticias WHERE id = ".$id;
$executa_noticias2 = mysqli_query($conexao, $sql_noticias2) or die (mysqli_error($conexao));
$listar_noticias2 = mysqli_fetch_assoc($executa_noticias2);
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
                        do <? echo $nome_site; ?></font>: <a title="<? echo $pagina_nome; ?>" href="noticias.php?nome=<? echo $login_usuario; ?>"><font color="#0000FF"><? echo $pagina_nome; ?></font></a></td>
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
          <td height="25" class="texto_gran"><? if ($acao == ""){ echo "Abaixo est&atilde;o listados todas 
            as suas notícias cadastradas:"; } if ($acao == "editar"){ echo "Editando notícia: <font color=\"#FF0000\">\"".$listar_noticias2["titulo"]."\"</font>"; } if ($acao == "inserir"){ echo "Inserindo nova notícia:"; } ?></td>
        </tr>
		<? if ($status != ""){ ?>
        <tr> 
          <td align="center" class="td">
		  <? switch($status){
		  case "deleta_ok":
		         echo "Notícia deletada com sucesso!";
				 break;
		  case "edita_ok":
		        echo "Notícia editada com sucesso!";
				break;
		  case "insere_ok":
		        echo "Notícia inserida com sucesso!";
				break;
		  case "sem_titulo":
		        echo "Por favor preencha o título da notícia!";
				break;
		  case "sem_noticia":
		        echo "Por favor preencha a notícia!";
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
                <td width="5%" align="center" bgcolor="#99CC99" class="texto_gran"><img src="<? echo $end_objetos; ?>arquivos/images/jornal.gif" width="15" height="15"></td>
                <td width="71%" bgcolor="#99CC99" class="texto_gran">Not&iacute;cias</td>
                <td width="12%" align="center" bgcolor="#99CC99" class="texto">Editar</td>
                <td width="12%" align="center" bgcolor="#99CC99" class="texto">Excluir</td>
              </tr>
              <? if ($contar_noticias != "0"){
			  while($listar_noticia = mysqli_fetch_assoc($executa_noticias)){ 
			  if ($cor == "#FFFFFF"){ $cor = "#EEEEEE"; } else { $cor = "#FFFFFF"; }?>
              <tr> 
                <td height="20" colspan="2" bgcolor="<? echo $cor; ?>" class="texto"><img src="<? echo $end_objetos; ?>arquivos/images/lista.gif" width="21" height="7" border="0"><? echo $listar_noticia["titulo"]; ?></td>
                <td align="center" bgcolor="<? echo $cor; ?>"><a href="adm_noticias.php?id=<? echo $listar_noticia["id"]; ?>&acao=editar" title="Editar notícia"><img src="<? echo $end_objetos; ?>arquivos/images/<? if ($cor == "#FFFFFF"){ echo "editar.gif"; }else {echo "editar2.gif"; } ?>" width="16" height="16" border="0"></a></td>
                <td align="center" bgcolor="<? echo $cor; ?>"><a href="adm_noticias.php?id=<? echo $listar_noticia["id"]; ?>&acao=deletar" title="Deletar notícia" onClick="return valida_confirma();"><img src="<? echo $end_objetos; ?>arquivos/images/<? if ($cor == "#FFFFFF"){ echo "lixo.gif"; }else {echo "lixo2.gif"; } ?>" width="16" height="16" border="0"></a></td>
              </tr>
              <? }
			  }else{ ?>
              <tr align="center">
                <td colspan="4" height="10"></td>
              </tr>
              <tr align="center"> 
                <td height="20" colspan="4" class="titulo"><font color="#000000">Nenhuma 
                  notícia cadastrada</font></td>
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
                      <td width="7%" align="center"><a href="adm_noticias.php?acao=inserir"><img src="<? echo $end_objetos; ?>arquivos/images/inserir_link.gif" alt="Inserir not&iacute;cia" width="20" height="20" border="0"></a></td>
                      <td width="93%" class="texto_gran"><a href="adm_noticias.php?acao=inserir" title="Inserir notícia"><font color="#0000FF">Inserir 
                        Notícia</font></a></td>
                    </tr>
                  </table></td>
                <td colspan="2" align="center" class="texto_gran">Total: <? echo $contar_noticias; ?> 
                  notícias.</td>
              </tr>
              <tr> 
                <td colspan="2">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
			<? }elseif($acao == "editar"){?>
            <form name="edita_noticia" method="post" action="adm_noticias.php?acao=editando&id=<? echo $id; ?>">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td colspan="2">&nbsp;</td>
                  <td width="5%"><a href="adm_noticias.php"><img src="<? echo $end_objetos; ?>arquivos/images/listar_todos.gif" alt="Listar todas" width="20" height="20" border="0"></a></td>
                  <td width="27%" class="texto_gran"><a href="adm_noticias.php" title="Listar todas"><font color="#0000FF">Listar 
                    todas</font></a></td>
                </tr>
                <tr> 
                  <td width="23%" height="25" align="right" class="texto">Título 
                    da notícia:</td>
                  <td> <input name="titulo" type="text" class="form" id="titulo" value="<? echo $listar_noticias2["titulo"]; ?>" size="50" maxlength="50"> 
                  </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Notícia:</td>
                  <td><input name="noticia" type="text" class="form" id="noticia" value="<? echo $listar_noticias2["noticia"]; ?>" size="50"></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
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
                    <a href="adm_noticias.php"><img src="<? echo $end_objetos; ?>arquivos/images/cancelar.gif" alt="Cancelar" width="89" height="29" border="0"></a></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td colspan="3" align="right"><img src="<? echo $end_objetos; ?>arquivos/images/fundo_noticias.gif" width="128" height="128"></td>
                </tr>
              </table>
            </form> 
            <? }elseif($acao == "inserir"){ ?>
			<form name="edita_noticia" method="post" action="adm_noticias.php?acao=inserindo">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td colspan="2">&nbsp;</td>
                  <td width="5%" align="center"><a href="adm_noticias.php"><img src="<? echo $end_objetos; ?>arquivos/images/listar_todos.gif" alt="Listar todas" width="20" height="20" border="0"></a></td>
                  <td width="27%" class="texto_gran"><a href="adm_noticias.php" title="Listar todas"><font color="#0000FF">Listar 
                    todas</font></a></td>
                </tr>
                <tr> 
                  <td width="23%" height="25" align="right" class="texto">Título 
                    da notícia:</td>
                  <td> <input name="titulo" type="text" class="form" id="titulo" size="50" maxlength="50" value="<? echo $titulo_not; ?>"> 
                  </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Not&iacute;cia:</td>
                  <td><input name="noticia" type="text" class="form" id="noticia" value="<? echo $noticia; ?>" size="50"></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
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
                    <a href="adm_noticias.php"><img src="<? echo $end_objetos; ?>arquivos/images/cancelar.gif" alt="Cancelar" width="89" height="29" border="0"></a></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td colspan="3" align="right"><img src="<? echo $end_objetos; ?>arquivos/images/fundo_noticias.gif" width="128" height="128"></td>
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
