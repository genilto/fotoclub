<? 
include "valida_user.php";

$local_pagina = "adm_fotos";
$pagina_nome = "Minhas fotos";
$pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : "";
$status = isset($_GET["status"]) ? $_GET["status"] : "";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$id_com = isset($_GET["id_foto"]) ? $_GET["id_foto"] : "";
$comentario = isset($_POST["comentario"]) ? $_POST["comentario"] : "";
$erros = "";
$foto = isset($_FILES["foto"]) ? $_FILES["foto"] : false;

$links = "";

if ($acao == "deletar_com"){
	if ($id != ""){
		$sql_del_com = "DELETE FROM comentarios WHERE user = '".$login_usuario."' and id = ".$id_com;
		$executa_del_com = mysqli_query($conexao, $sql_del_com) or die (mysqli_error($conexao));
		$status = "del_com_ok";
		$acao = "comentarios";
		$id = $id;
	}
}

if ($acao == "editando"){
	if ($id != ""){
		if ($comentario == ""){
			$status = "sem_com";
			$acao = "editar";
			$id = $id;
		}else{
			$sql_edita = "UPDATE fotos SET comentario = '".htmlspecialchars(mysqli_real_escape_string($conexao, $comentario))."' WHERE user = '".$login_usuario."' and id = ".$id;
			$executa_edita = mysqli_query($conexao, $sql_edita) or die (mysqli_error($conexao));
			$status = "edita_ok";
			$acao = "";
		}
	}
}elseif ($acao == "deletar"){
	if ($id != ""){
		$sql_fotos = "SELECT * FROM fotos WHERE user = '".$login_usuario."' and id = ".$id;
		$executa_fotos = mysqli_query($conexao, $sql_fotos) or die (mysqli_error($conexao));
		$listar_foto = mysqli_fetch_assoc($executa_fotos);
		$contar_fotos = mysqli_num_rows($executa_fotos);

		if (file_exists($login_usuario."/images/".$listar_foto["foto"])){
			if(!@unlink($login_usuario."/images/".$listar_foto["foto"])){
				$erros = "no_del_img";
			}
		}else{
			$erros = $erros."sem_img_";
		}
		if (file_exists($login_usuario."/thumbs/".$listar_foto["thumb"])){
			if(!@unlink($login_usuario."/thumbs/".$listar_foto["thumb"])){
				$erros = "no_del_img";
			}
		}else{
			$erros = $erros."sem_thu_";
		}

		$sql_del = "DELETE FROM fotos WHERE user = '".$login_usuario."' and id = ".$id;
		$executa_del = mysqli_query($conexao, $sql_del) or die (mysqli_error($conexao));

		$sql_del_com = "DELETE FROM comentarios WHERE user = '".$login_usuario."' and foto = ".$id;
		$executa_del_com = mysqli_query($conexao, $sql_del_com) or die (mysqli_error($conexao));

		if ($erros != ""){
			$status = $erros;
		}else{
			$status = "deleta_ok";
		}
		$acao = "";
	}
}elseif($acao == "inserindo"){

	$sql_fotos = "SELECT * FROM fotos WHERE user = '".$login_usuario."' AND data = '".$data."' ORDER BY id DESC";
	$executa_fotos = mysqli_query($conexao, $sql_fotos) or die (mysqli_error($conexao));
	$contar_fotos = mysqli_num_rows($executa_fotos);
	$listar_fotos = mysqli_fetch_assoc($executa_fotos);

	if($contar_fotos < $qtd_max_fotos_dia){

		if (!$foto){
			$status = "sem_foto";
			$acao = "inserir";
		}elseif($comentario == ""){
			$status = "sem_com";
			$acao = "inserir";
		}else{
			
			$foto_nome_original = $foto["name"];
			$extensao = strrchr($foto_nome_original, ".");
			$foto_nome = $login_usuario."_".$dia."_".$mes."_".$ano."_".time().$extensao;
	
			$status_foto = "";
	 		
			$status_foto = grava_foto($foto, $foto_nome, $login_usuario."/images", 400, 800);

			if ($status_foto == "ok"){
				$status_foto = grava_foto($foto, $foto_nome, $login_usuario."/thumbs", 100, 100);
				
				if($status_foto == "ok"){
					$sql_insere = "INSERT INTO fotos (user, 
													  foto, 
													  thumb, 
													  comentario, 
													  data
												 ) VALUES (
												     '".$login_usuario."',
													 '".$foto_nome."',
													 '".$foto_nome."',
													 '".htmlspecialchars(mysqli_real_escape_string($conexao, $comentario))."',
													 '".$data."'
													 );";
					$executa_insere = mysqli_query($conexao, $sql_insere) or die (mysqli_error($conexao));
					$status = "insere_ok";
					$acao = "";
				}else{
					$status = "outro";
					$acao = "inserir";
				}
			} else{
				$status = "outro";
				$acao = "inserir";
			}
		}
	}else{
		$postar = "no";
		$acao = "inserir";
	}
} 

$sql_user = "SELECT * FROM user WHERE username = '".$login_usuario."'";
$executa_user = mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));
$listar_user = mysqli_fetch_assoc($executa_user);

if ($acao == "comentarios" || $acao == "editar"){
	if ($id != ""){
	  
		$sql_fotos = "SELECT * FROM fotos WHERE user = '".$login_usuario."' AND id = ".$id;
		$executa_fotos = mysqli_query($conexao, $sql_fotos) or die (mysqli_error($conexao));
		$listar_fotos = mysqli_fetch_assoc($executa_fotos);
		
		$sql_com = "SELECT * FROM comentarios WHERE user = '".$login_usuario."' AND foto = ".$id;
		$executa_com = mysqli_query($conexao, $sql_com) or die (mysqli_error($conexao));
		$contar_com = mysqli_num_rows($executa_com);
	}else{
		$status = "sem_id";
		$acao = "";
	}
}else{

	$sql_fotos = "SELECT * FROM fotos WHERE user = '".$login_usuario."' AND data = '".$data."' ORDER BY id DESC";
	$executa_fotos = mysqli_query($conexao, $sql_fotos) or die (mysqli_error($conexao));
	$contar_fotos = mysqli_num_rows($executa_fotos);
	$listar_fotos = mysqli_fetch_assoc($executa_fotos);

	if($contar_fotos < $qtd_max_fotos_dia){
		$postar = "ok";
	}else{
		$postar = "no";
	}
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
                        do <? echo $nome_site; ?></font>: <font color="#0000FF"><a title="<? echo $pagina_nome; ?>" href="fotos.php?nome=<? echo $login_usuario; ?>"><font color="#0000FF"><? echo $pagina_nome; ?></font></a></font></td>
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
          <td height="25" class="texto_gran">
            <? 
			switch($acao){
			case "":
			     echo "Abaixo est&atilde;o listadas todas as fotos postadas por você:";
			     break;
			case "editar":
			     echo "Editando foto:";
				 break;
			case "inserir":
			     echo "Postando foto:";
				 break;
			case "comentarios":
			     echo "Administrando comentários:<br><font color=\"#FF0000\">Foto: ".$listar_fotos["data"]."</font>";
				 break;
			}
			?>
          </td>
        </tr>
        <? if ($status != ""){ ?>
        <tr> 
          <td class="td" align="center"><? switch($status){
		  case "deleta_ok":
		         echo "Foto deletada com sucesso!";
				 break;
		  case "edita_ok":
		        echo "Foto editada com sucesso!";
				break;
		  case "insere_ok":
		        echo "Foto inserida com sucesso!";
				break;
		  case "sem_titulo":
		        echo "Por favor preencha o título da notícia!";
				break;
		  case "sem_noticia":
		        echo "Por favor preencha a notícia!";
				break;
		  case "no_del_img":
		        echo "Foto deletada com sucesso, porém houve algum erro.";
				break;
		  case "sem_img_":
		        echo "Foto deletada com sucesso, porém a foto não existia.";
				break;
		  case "sem_thu_":
		        echo "Foto deletada com sucesso, porém o thumbnail não existia.";
				break;
		  case "sem_img_sem_thu_":
		        echo "Foto deletada com sucesso, porém o thumbnail e a foto não existiam.";
				break;
		  case "sem_foto":
		        echo "Por favor escolha uma foto, tem que ser menor que 500 KB.";
				break;
		  case "sem_com":
		        echo "Por favor preencha o comentario da foto.";
				break;
		  case "no_jpg":
		        echo "O formato da imagem é inválido.";
				break;
		  case "no_up":
		        echo "Não foi possível fazer o upload da foto.";
				break;
		  case "tem_img":
		        echo "Ocorreu um pequeno erro, tente novamente.";
				break;
		  case "no_load":
		        echo "Não foi possível carregar a imagem.";
				break;
		  case "del_com_ok":
		        echo "Comentário deletado com sucesso.";
				break;
		  case "sem_id":
		        echo "Escolha uma foto pra editar.";
				break;
		  case "no_img_peq":
		        echo "Ocorreu algum problema ao criar o thumb, talvez a foto escolhida seja muito pequena.";
				break;
		  case "no_img_gran":
		        echo "Ocorreu algum problema ao criar a foto grande.";
				break;		
		  case "outro":
		        echo $status_foto;
				break;
		  	} 
		  ?></td>
        </tr>
        <? } ?>
		 <tr class="texto_gran"> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td align="center" class="titulo">
		  		  
				  
		  <? 
		  if ($acao == ""){
        $TAMANHO_PAGINA = 6;

        if (!$pagina) {
           $inicio = 0;
           $pagina=1;
        }
        else {
           $inicio = ($pagina - 1) * $TAMANHO_PAGINA;
        }
        
        $ssql = "SELECT * FROM fotos WHERE user = '".$login_usuario."'";
        $rs = mysqli_query($conexao, $ssql) or die (mysqli_error($conexao));
        $num_total_registros = mysqli_num_rows($rs);
        $total_paginas = ceil($num_total_registros / $TAMANHO_PAGINA); 

        $sql_list = "
            SELECT * FROM fotos WHERE user = '".$login_usuario."' ORDER BY id DESC LIMIT ".$inicio.",".$TAMANHO_PAGINA."";
        $res_list = mysqli_query($conexao, $sql_list) or die (mysqli_error($conexao));
        $numero_registros = mysqli_num_rows($res_list);
        
        $coluna = 0;  // coluna atual. Só podem existir 3 colunas 
        $total_registros = 0;
        ?>
            <table width="100%" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <?
        while(($reg = mysqli_fetch_array($res_list))){
            $total_registros++;
?>
                <td align="center" class="texto"> <a href="javascript:abre('ver_foto.php?local=adm_fotos&foto=<? echo $login_usuario."/images/".$reg["foto"]; ?>', 'fotos', 'width=430, height=330')"> 
                  <img src="<? echo $login_usuario."/thumbs/".$reg["thumb"]; ?>" alt="<? echo $reg["data"]; ?>" border="2" class="img_padrao"> 
                  </a><br>
                  <a href="adm_fotos.php?acao=deletar&id=<? echo $reg["id"]; ?>" title="Deletar foto" onClick="return valida_confirma();"><font color="#0000FF">Deletar</font></a> 
                  | <a href="adm_fotos.php?acao=editar&id=<? echo $reg["id"]; ?>&pagina=<? echo $pagina; ?>" title="Editar foto"><font color="#0000FF">Editar</font></a> 
                  <br> <a href="adm_fotos.php?acao=comentarios&id=<? echo $reg["id"]; ?>&pagina=<? echo $pagina; ?>" title="Administrar comentários"><font color="#0000FF">Adm 
                  comentários(<? 
				  
				  $sql_total_fotos = "SELECT id FROM comentarios WHERE foto = '".$reg["id"]."'";
				  $exe_total_fotos = mysqli_query($conexao, $sql_total_fotos) or die (mysqli_error($conexao));
				  echo mysqli_num_rows($exe_total_fotos);
				  
				  ?>)</font></a><br><br></td>
                <?
                 $coluna++;

            if($coluna == 3){
                echo "</tr><tr>";
                $coluna = 0;
            }

            if($numero_registros == $total_registros){

                if ($total_paginas > 1){
                   for ($i=1;$i<=$total_paginas;$i++){
                    if ($pagina == $i) {
                       $links = $links."<option selected>".$pagina."</option>";
                    } else { 
                        $links = $links."<option value=\"".$_SERVER['PHP_SELF']."?pagina=".$i."&acao=".$acao."\">".$i."</option>"; 
      	            }
				          }
                } 
              }
            }
  ?>
              </tr>		  
            </table>
			
			
            <table width="100%" align="center" cellpadding="0" cellspacing="0">
              <tr class="texto"> 
                <td bgcolor="#CCCCCC"></td>
              </tr>
              <tr> 
                <td height="10"></td>
              </tr>
              <tr> 
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="3%"><img src="<? echo $end_objetos; ?>arquivos/images/postar_foto.gif" width="20" height="20"></td>
                      <td width="20%" class="texto_gran"><a href="adm_fotos.php?acao=inserir&pagina=<? echo $pagina; ?>" title="Postar foto"><font color="#0000FF">Postar 
                        foto</font></a></td>
                      <td width="48%" align="center" class="texto_gran"> 
                        <? if ($links != ""){ ?>
                        Páginas: 
                        <select name="paginas" class="form" onChange="MM_jumpMenu('parent',this,1)">
                                      <? echo $links; ?> </select>
                        <? } ?>
                      </td>
                      <td width="29%" align="right" class="texto_gran">Total: 
                        <? echo $num_total_registros; ?> fotos.</td>
                    </tr>
                  </table></td>
              </tr>
              <?
		if ($num_total_registros == 0){
		?>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td align="center"><img src="<? echo $end_objetos; ?>arquivos/images/sem_foto_adm.gif" width="200" height="33"></td>
              </tr>
              <tr>
                <td align="center" class="titulo">&nbsp;</td>
              </tr>
              <tr> 
                <td align="center" class="titulo">Nenhuma foto foi encontrada!</td>
              </tr>
              <tr> 
                <td align="right" class="titulo">&nbsp;</td>
              </tr>
              <tr> 
                <td align="right" class="titulo">&nbsp;</td>
              </tr>
              <tr> 
                <td align="right" class="titulo">&nbsp;</td>
              </tr>
              <tr> 
                <td align="right" class="titulo">&nbsp;</td>
              </tr>
              <tr> 
                <td align="right" class="titulo"><img src="<? echo $end_objetos; ?>arquivos/images/fundo_fotos.gif" width="128" height="128"></td>
              </tr>
              <? }
?>
            </table>
		    <? } elseif($acao == "editar"){ ?>
            <form name="editar" method="post" action="adm_fotos.php?acao=editando&id=<? echo $id; ?>">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td align="center" class="texto_gran">Foto:</td>
                  <td align="center" class="texto_gran">&nbsp;Coment&aacute;rio:</td>
                </tr>
                <tr> 
                  <td height="25" align="center" valign="top" class="texto"><a href="javascript:abre('ver_foto.php?local=adm_fotos&foto=<? echo $login_usuario."/images/".$listar_fotos["foto"]; ?>', 'fotos', 'width=430, height=330,')"><img src="<? echo $login_usuario."/thumbs/".$listar_fotos["thumb"]; ?>" border="0" alt="<? echo $listar_fotos["data"]; ?>"></a><br>
				  <? echo $listar_fotos["data"]; ?></td>
                  <td align="center"> <textarea name="comentario" cols="50" rows="5" class="form" id="textarea2"><? echo $listar_fotos["comentario"]; ?></textarea> 
                  </td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td rowspan="2" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>&nbsp;</td>
                        <td align="right">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td> &nbsp; <input name="imageField2" type="image" src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Editar" width="89" height="29" border="0">
                          <a href="adm_fotos.php?pagina=<? echo $pagina; ?>"><img src="<? echo $end_objetos; ?>arquivos/images/cancelar.gif" alt="Cancelar" width="89" height="29" border="0"></a></td>
                        <td align="right">&nbsp; </td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                        <td align="right"><img src="<? echo $end_objetos; ?>arquivos/images/fundo_fotos.gif" width="128" height="128"></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                </tr>
              </table>
            </form> 
            <? }elseif($acao == "inserir"){ 
		
		  if($postar == "ok"){
		  
		  ?>
            <form action="adm_fotos.php?acao=inserindo" method="post" enctype="multipart/form-data" name="postar">

              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td><br></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Foto:</td>
                  <td><input name="foto" type="file" class="form" id="foto" size="30"></td>
                </tr>
                <tr> 
                  <td height="25" align="right" valign="top" class="texto">Coment&aacute;rio: 
                  </td>
                  <td><textarea name="comentario" cols="50" rows="5" class="form" id="comentario"><? echo $comentario; ?></textarea></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td><input name="imageField" type="image" src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Postar" width="89" height="29" border="0">
                    &nbsp;<a href="adm_fotos.php?pagina=<? echo $pagina; ?>"><img src="<? echo $end_objetos; ?>arquivos/images/cancelar.gif" alt="Cancelar" width="89" height="29" border="0"></a></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td align="right"><img src="<? echo $end_objetos; ?>arquivos/images/fundo_fotos.gif" width="128" height="128"></td>
                </tr>
              </table>
            </form> 
            <? }else{ ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr align="center"> 
                <td colspan="2"><img src="<? echo $end_objetos; ?>arquivos/images/atencao.gif" width="200" height="33"></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr align="center"> 
                <td colspan="2" class="texto_gran">Voc&ecirc; tem direito de postar 
                  apenas <? echo $qtd_max_fotos_dia_extenso; ?> por dia, e voc&ecirc; 
                  j&aacute; postou hoje. </td>
              </tr>
              <tr align="center"> 
                <td colspan="2" class="texto">&nbsp;</td>
              </tr>
              <tr align="center"> 
                <td colspan="2" class="texto">
                  Se voc&ecirc; tiver alguma d&uacute;vida 
                  sobre este assunto consulte nossa<br>
                   <a href="javascript:abre('privacidade.php', 'privacidade', 'scrollbars=yes, width=400, height=300')" title="Política de privacidade"> 
				   <font color="#0000FF">pol&iacute;tica de privacidade</font></a>, ou entre em <a href="contato.php" title="Entre em contato">
				   <font color="#0000FF">contato</font></a> 
                  conosco.</font></td>
              </tr>
              <tr align="center">
                <td colspan="2" class="texto">&nbsp;</td>
              </tr>
              <tr align="center"> 
                <td colspan="2" class="texto">&nbsp;</td>
              </tr>
              <tr align="center"> 
                <td colspan="2" class="texto"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="43%" align="right"><img src="<? echo $end_objetos; ?>arquivos/images/postar_foto.gif" width="20" height="20"></td>
                      <td width="57%" class="texto_gran">&nbsp;<a title="Listar Fotos" href="adm_fotos.php?pagina=<? echo $pagina; ?>"><font color="#0000FF">Listar 
                        fotos</font></a></td>
                    </tr>
                  </table></td>
              </tr>
              <tr align="center"> 
                <td colspan="2" class="texto">&nbsp;</td>
              </tr>
            </table>
            <? } ?>
            <? }elseif ($acao == "comentarios"){ ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="5%" align="center" bgcolor="#99CC99" class="texto_gran"><img src="<? echo $end_objetos; ?>arquivos/images/comentarios.gif" width="15" height="15"></td>
                <td width="71%" bgcolor="#99CC99" class="texto_gran">Nome</td>
                <td width="12%" align="center" bgcolor="#99CC99" class="texto">Excluir</td>
              </tr>
              <?
			 			  
			   if ($contar_com != "0"){
			  while($listar_com = mysqli_fetch_assoc($executa_com)){ 
			  if ($cor == "#FFFFFF"){ $cor = "#EEEEEE"; } else { $cor = "#FFFFFF"; }?>
              <tr> 
                <td height="20" colspan="2" bgcolor="<? echo $cor; ?>" class="texto"><img src="<? echo $end_objetos; ?>arquivos/images/lista.gif" width="21" height="7" border="0"><a href="javascript:abre('ver_comentario.php?data_foto=<? echo $dia_foto."/".$mes_foto."/".$ano_foto; ?>&id=<? echo $listar_com["id"]; ?>', 'comentarios', 'width=400, height=300, scrollbars=yes')" title="Ver comentário"><font color="#000000"><? echo $listar_com["nome"]; ?></font></a></td>
                <td align="center" bgcolor="<? echo $cor; ?>"><a href="adm_fotos.php?id_foto=<? echo $listar_com["id"]; ?>&acao=deletar_com&id=<? echo $id; ?>&pagina=<? echo $pagina; ?>" title="Deletar comentário" onClick="return valida_confirma();"><img src="../arquivos/images/<? if ($cor == "#FFFFFF"){ echo "lixo.gif"; }else {echo "lixo2.gif"; } ?>" width="16" height="16" border="0"></a></td>
              </tr>
              <? }
			  }else{ ?>
              <tr align="center"> 
                <td height="20" colspan="3" bgcolor="#6699FF" class="titulo"><font color="#FFFFFF">Esta 
                  foto não recebeu nenhum comentário.</font></td>
              </tr>
              <? } ?>
              <tr> 
                <td colspan="2">&nbsp;</td>
                <td align="center" class="texto_gran">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" class="texto_gran"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="3%" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/postar_foto.gif" width="20" height="20"></td>
                      <td width="57%" class="texto_gran">&nbsp;<a title="Listar Fotos" href="adm_fotos.php?pagina=<? echo $pagina; ?>"><font color="#0000FF">Listar 
                        fotos</font></a></td>
                      <td width="40%" align="center" class="texto_gran">Total: 
                        <? echo $contar_com; ?> Coment&aacute;rios.</td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan="2">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>

		  
		  <? } ?>
		  </td>
        </tr>
        <tr> 
          <td align="right" class="texto">&nbsp;</td>
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
