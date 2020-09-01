<? include "ver_login.php";
//Resgata informações do formulario
$comentario = isset($_POST["comentario"]) ? htmlspecialchars($_POST["comentario"]) : "";
   
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
$foto = isset($_GET["foto"]) ? $_GET["foto"] : "";
$nome = isset($_GET["nome"]) ? $_GET["nome"] : "";
$status = "";
   
if ($nome != "" && $foto != ""){
	$sql_foto = "SELECT * FROM fotos WHERE user = \"".$nome."\" and id = ".$foto.";";
	$executa_foto = mysqli_query($conexao, $sql_foto) or die (mysqli_error($conexao));
	$listar_foto = mysqli_fetch_assoc($executa_foto);
	
	if($link_usuario == 0){
		$des_link_usuario = $nome.".".$dominio;
	}else{
		$des_link_usuario = $url_site."/".$nome;
	}
	
}else{
	if ($foto == ""){
		$status = "sem_foto";
	}
}
 ?>
<html>
<head>
<title><? echo $titulo ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
</head>
<body topmargin="0" leftmargin="0" <? if ($acao == "" && $status == ""){ echo "onLoad=\"document.denuncie.comentario.focus();\""; }?>>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center"> 
    <td colspan="3"><img src="<? echo $end_objetos; ?>arquivos/images/denuncie.gif" width="400" height="23"></td>
  </tr>
  <tr align="center">
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr align="center"> 
    <td colspan="3"> 
      <?
	//se não tem username mostra formulario
	 if ($status == ""){
	 if ($acao == ""){
	 
	?>
      <form name="denuncie" method="post" action="denuncie.php?acao=enviar&nome=<? echo $nome; ?>&foto=<? echo $foto; ?>">
        <table width="95%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td colspan="2" class="texto"><p>Se voc&ecirc; encontrou uma foto 
                com conte&uacute;do racista/ofensivo a terceiros, ou que exiba 
                imagens de cunho er&oacute;tico/pornogr&aacute;fico, denuncie. 
                Do contr&aacute;rio, se voc&ecirc; simplesmente n&atilde;o gostou 
                de uma foto, mas ela n&atilde;o infringe as regras, poupe o seu 
                (e o nosso) tempo, continue a navegar pelo site.</p></td>
          </tr>
          <tr class="texto"> 
            <td width="42%">&nbsp;</td>
            <td width="58%">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td align="center"><img src="<? echo $nome."/thumbs/".$listar_foto["thumb"]; ?>" border="0"></td>
                </tr>
                <tr> 
                  <td align="center" class="texto">http://<? echo $des_link_usuario; ?></td>
                </tr>
                <tr>
                  <td align="center" class="texto_gran">&nbsp;</td>
                </tr>
                <tr> 
                  <td align="center" class="texto_gran">Tem certeza que esta foto 
                    est&aacute; em desacordo com a <a href="javascript:abre('privacidade.php', 'privacidade', 'scrollbars=yes, width=400, height=300')" title="Política de privacidade"><font color="#0000FF">política 
                    de privacidade</font></a> do <? echo $nome_site; ?>?</td>
                </tr>
              </table></td>
          </tr>
          <tr class="texto"> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td align="right" class="texto">Coment&aacute;rio extra:</td>
            <td><textarea name="comentario" cols="50" rows="5" class="form" id="comentario"></textarea></td>
          </tr>
          <tr class="texto"> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr align="center"> 
            <td colspan="2" class="texto_gran"><font color="#FF0000">Se voc&ecirc; 
              tiver certeza clique em <font color="#0000FF">ok.</font></font></td>
          </tr>
          <tr class="texto"> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr align="center"> 
            <td colspan="2"> <input name="imageField" type="image" src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Denunciar" width="89" height="29" border="0"> 
              <a href="javascript:window.close();"><img src="<? echo $end_objetos; ?>arquivos/images/cancelar.gif" alt="Fechar" width="89" height="29" border="0"></a> 
            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form>
      <? }
	 else{

	if ($comentario == ""){
	$comentario = "Não há comentário.";
	}
	 $erros = "";
	 if ($login_usuario != ""){
	 	$usuario_nome = $login_usuario;
	 	$usuario = "<b>".$login_usuario."</b>, <a href=\"http://".$des_link_usuario."\" target=\"_blank\"><font color=\"#0000FF\" face=\"Arial\" size=\"2\">http://".$des_link_usuario."</font></a>, ";
	 }else{
	 	$usuario_nome = "quem denunciou";
	 	$usuario = "um usuário anônimo";
	 }
	 
	 $mens = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr> 
    <td width=\"28%\" valign=\"top\"><a href=\"http://".$url_site."\" target=\"_blank\" title=\"http://".$url_site."\"><img src=\"http://".$servidor_site."/arquivos/images/fotoclubedenuncia.gif\" width=\"249\" height=\"166\" border=\"0\"></a></td>
    <td width=\"72%\">
	 <font face=\"Verdana\" color=\"#FF0000\" size=\"2\">
	          <b>:: ".$nome_site." :: <br>Denúncia de irregularidades</b>
	        </font>
	     <br><br>
                 <font face=\"arial\" size=\"2\">Houve uma denúncia em <b>".$data."</b> às <b>".$hora."</b><br>
				 de ".$usuario." no qual:<br><br>
				 Comentário de ".$usuario_nome.":<br>
				 <b>".$comentario."</b><br><br>
				 Usuário ".$nome_site." denunciado: <b>".$nome."</b><br>
				 Foto denunciada: <b>".$listar_foto["foto"]."</b><br>
				 Data de inclusão desta foto: <b>".$listar_foto["data"]."</b></font><br><br><br>		
 
  <a href=\"http://".$dominio."/usuarios.php?nome=".$nome."&foto=".$foto."\" target=\"_blank\"><font size=\"2\" face=\"arial\" color=\"0000FF\"><img src=\"http://".$servidor_site."/arquivos/images/ver.gif\" border=\"0\" alt=\"Ver foto\"></font><br><br></a>
	</td>
  </tr>
</table>";
	 
 $headers = "MIME-Version: 1.0\r\n";
 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
 $headers .= "From: ".$nome_site."<".$mailto."> \r\n";
 
  if (!@mail($mailto, "Denúncia ".$nome_site, "$mens", $headers)){
  $erros = "> O E-mail não pode ser enviado.";
  }
 ?>
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td class="titulo">Confirma&ccedil;&atilde;o de envio:</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td align="center" class="texto"> 
            <? if ($erros == ""){
		  echo "<b>Sucesso!</b><br>
		  Um e-mail com sua denúncia foi enviado para nós do <b>".$nome_site."</b>, muito obrigado por colaborar.";
		  echo "<br><br><font color=\"#FF0000\" class=\"texto_gran\">Foto denunciada: </font><br><br>
		  <img src=\"".$nome."/thumbs/".$listar_foto["thumb"]."\" border=\"0\"><br>
		  ".$listar_foto["data"]."
		  <br><br>
		  Usuário ".$nome_site." denunciado: <b>
		  <br><br>
		  ".$nome."</b><br>http://".$des_link_usuario;
		  }
		  else{
		  echo "<b>Os seguintes erros ocorreram:</b><br><br>".$erros;
		  }		  
		  ?>
          </td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td align="center"><a href="javascript:window.close();"><img src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Fecha janela" width="89" height="29" border="0"></a> 
            <? if ($erros != ""){ ?>
            <a href="denuncie.php?nome=<? echo $nome; ?>&foto=<? echo $foto; ?>"><img src="<? echo $end_objetos; ?>arquivos/images/insistir.gif" alt="Tentar de novo" width="89" height="29" border="0"></a> 
            <? } ?>
          </td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
      </table>
      <? } 
	  }else{ ?>
	  
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center" class="texto_gran">Aten&ccedil;&atilde;o...</td>
        </tr>
        <tr> 
          <td align="center"><img src="<? echo $end_objetos; ?>arquivos/images/sem_foto.gif"></td>
        </tr>
        <tr> 
          <td height="25" align="center" class="titulo">Este usu&aacute;rio ainda 
            n&atilde;o tem fotos...</td>
        </tr>
        <tr> 
          <td align="center" class="titulo">&nbsp;</td>
        </tr>
        <tr> 
          <td align="center" class="titulo"><a href="javascript:window.close();"><img src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Fecha janela" width="89" height="29" border="0"></a> 
          </td>
        </tr>
      </table>
<? } ?>
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
