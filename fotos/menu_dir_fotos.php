<? 
$sql_amigos = "SELECT * FROM amigos WHERE user = \"".$nome."\" ORDER BY RAND() LIMIT 2;";
$executa_amigos = mysqli_query($conexao, $sql_amigos) or die ("<b>menu_dir_fotos.php</b><br> ".mysqli_error($conexao));
$contar_amigos = mysqli_num_rows($executa_amigos);

$sql_total_amigos = "SELECT * FROM amigos WHERE user = \"".$nome."\";";
$executa_total_amigos = mysqli_query($conexao, $sql_total_amigos) or die ("<b>menu_dir_fotos.php</b><br> ".mysqli_error($conexao));
$contar_total_amigos = mysqli_num_rows($executa_total_amigos);

$sql_links = "SELECT * FROM links WHERE user = \"".$nome."\" ORDER BY id DESC LIMIT 13;";
$executa_links = mysqli_query($conexao, $sql_links) or die ("<b>menu_dir_fotos.php</b><br> ".mysqli_error($conexao));
$contar_links = mysqli_num_rows($executa_links);

$sql_total_links = "SELECT * FROM links WHERE user = \"".$nome."\" ORDER BY id DESC;";
$executa_total_links = mysqli_query($conexao, $sql_total_links) or die ("<b>menu_dir_fotos.php</b><br> ".mysqli_error($conexao));
$contar_total_links = mysqli_num_rows($executa_total_links);

$sql_noticias = "SELECT * FROM noticias WHERE user = \"".$nome."\" ORDER BY id DESC LIMIT 5;";
$executa_noticias = mysqli_query($conexao, $sql_noticias) or die ("<b>menu_dir_fotos.php</b><br> ".mysqli_error($conexao));
$contar_noticias = mysqli_num_rows($executa_noticias);

echo "
<style type=\"text/css\">
<!--
.painel_veiculo{
	font-family: ".$fonte_tit."; 
	font-size: 10px;
	color: ".$cor_links.";
	font-weight: normal;
	text-decoration: none;
	font-style: none;
}
.painel_trecho{
	font-family: Arial;
	font-size: 10px;
	color: ".$cor_links.";
	font-weight: normal;
	text-decoration: none;
	font-style: normal;
}
a.painel_titulo{
	font-family: Verdana;
	font-size: 10px;
	color: ".$cor_links.";
	font-weight: bold;
	text-decoration: none;
	font-style: normal;
}
a.painel_titulo:visited{
	font-family: Verdana;
	font-size: 10px;
	color: ".$cor_links.";
	font-weight: bold;
	text-decoration: none;
	font-style: normal;
}
a.painel_titulo:link{
	font-family: Verdana;
	font-size: 10px;
	color: ".$cor_links.";
	font-weight: bold;
	text-decoration: none;
	font-style: normal;
}
a.painel_titulo:hover{
	font-family: Verdana;
	font-size: 10px;
	color: ".$cor_links.";
	font-weight: bold;
	text-decoration: underline;
	font-style: normal;
}
-->
</style>";
//.img_amigo {	border: 0px thin solid ".$cor_comentario.";

?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td colspan="2" align="center" class="td"><font color="#000000">Amigos no 
      <? echo $nome_site; ?></font></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <? if ($contar_amigos == "0"){ ?>
  <tr> 
    <td colspan="2" align="center" class="texto_gran"><font color="<? echo $cor_links; ?>">Nenhum 
      amigo</font></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <? }else{
			  while ($listar_amigos = mysqli_fetch_assoc($executa_amigos)){
			    $sql_ver_amigos = "SELECT * FROM user WHERE username = '".$listar_amigos["amigo"]."';";
			    $exe_ver_amigos = mysqli_query($conexao, $sql_ver_amigos) or die ("<b>menu_dir_fotos.php</b><br> ".mysqli_error($conexao));
			    while($listar_ver_amigos = mysqli_fetch_assoc($exe_ver_amigos)){
			   ?>
  <tr> 
    <td colspan="2" class="texto" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td align="center"><?
		  
		  if($link_usuario == 0){
				$des_link_amigo_usuario = $listar_ver_amigos["username"].".".$dominio;
			}else{
				$des_link_amigo_usuario = $url_site."/".$listar_ver_amigos["username"];
			}?>
			 
		    <a href="usuarios.php?nome=<? echo $listar_ver_amigos["username"]; ?>" title="http://<? echo $des_link_amigo_usuario; ?>">
            <? if ($listar_ver_amigos["foto"] == "sem_foto_pessoal.gif"){ echo "<img src=\"".$end_objetos."arquivos/images/".$listar_ver_amigos["foto"]."\"  border=\"0\">"; } else { ?>
            <img src="<? echo $listar_ver_amigos["username"]."/".$listar_ver_amigos["foto"]; ?>" border="0"> 
            <? } ?>
          	</a>
		  </td>
        </tr>
        <tr> 
          <td height="20" align="center" class="texto"><a href="usuarios.php?nome=<? echo $listar_ver_amigos["username"]; ?>" title="http://<? echo $des_link_amigo_usuario; ?>"><font color="<? echo $cor_links; ?>"><? echo $listar_ver_amigos["username"]; ?></font></a></td>
        </tr>
        <tr> 
          <td height="10">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <? } 
  } 
} 
?>
  <? if($contar_total_amigos > "2"){ ?>
  <tr> 
    <td colspan="2" class="texto_gran" align="center"><a href="amigos.php?nome=<? echo $nome; ?>" title="Mais Amigos"><font color="<? echo $cor_links; ?>">Mais 
      amigos</font></a></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <? } ?>
  <tr> 
    <td colspan="2" align="center" class="td"><font color="#000000">Links</font></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <? if ($contar_links == "0"){ ?>
  <tr> 
    <td colspan="2" align="center" class="texto_gran"><font color="<? echo $cor_links; ?>">Nenhum 
      link</font></td>
  </tr>
  <? }else{ 
			  while ($listar_links = mysqli_fetch_assoc($executa_links)){ ?>
  <tr> 
    <td class="texto" align="center" colspan="2"><a href="http://<? echo $listar_links["link"]; ?>" title="http://<? echo $listar_links["link"]; ?>" target="_blank"> 
      <font color="<? echo $cor_links; ?>"><? echo nl2br(wordwrap($listar_links["nome"], 23, "\n", 1)); ?></font></a></td>
  </tr>
  <? }
			  } ?>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <? if ($contar_total_links > "13"){ ?>
  <tr> 
    <td colspan="2" class="texto_gran" align="center"><a href="links.php?nome=<? echo $nome; ?>" title="Mais links"><font color="<? echo $cor_links; ?>">Mais 
      links</font></a></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <? } ?>
  <tr> 
    <td colspan="2" align="center" class="td"><font color="#000000">&Uacute;ltimas 
      Not&iacute;cias</font></td>
  </tr>
  <? if ($contar_noticias == "0"){ ?>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="center" class="texto_gran"><font color="<? echo $cor_links; ?>">Nenhuma 
      notícia</font></td>
  </tr>
  <? }else{ ?>
  <tr> 
    <td colspan="2"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td class="texto"> <script src="script.js"></script> 
            <? 
		  echo "<script>
			var aLogo = new Array();
			var aData = new Array();
			var aTitulo = new Array();
			var aTrecho = new Array();
			var iCont=0;";
			$i = 0;
			while ($listar_noticias = mysqli_fetch_assoc($executa_noticias)){ 			
				echo "
				aLogo[".$i."]=\"\";
				aData[".$i."]=\"<span class='painel_veiculo'>".$listar_noticias["data"]."</span><br>\";
				aTitulo[".$i."]=\"<a class='painel_titulo' href='noticias.php?id=".$listar_noticias["id"]."&nome=".$nome."'>\";
				aTitulo[".$i."]=aTitulo[".$i."]+\"".$listar_noticias["titulo"]."</a><br>\";
				aTrecho[".$i++."]=\"<span class='painel_trecho'>".wordwrap(trecho($listar_noticias["noticia"], 100), 25, "<br>", 1)."</span><br><br>\";\n\n";
			}
			echo "lefttime=setInterval('scrollmarquee()',3500);
			document.write('<br>');
			document.write('<div id=\"painelexterno\" align=\"center\" style=\"position:relative;width:140px;height:150px; overflow:hidden; border: 0px solid #000000;\">'); 
			document.write('<div id=\"sc\" style=\"padding: 1px\">');
			document.write('</div></div>');	
			document.write('<center><a href=\"noticias.php?nome=".$nome."\" title=\"Mais notícias\" class=\"texto_gran\"><font color=\"".$cor_links."\">Mais notícias</font></a></center><br>');
			</script>"; ?>
          </td>
        </tr>
      </table></td>
  </tr>
  <? } ?>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="center">Anuncie aqui...</td>
  </tr>

</table>
