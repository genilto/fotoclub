<?

$sql_fotos = "SELECT * FROM fotos WHERE user = \"".$nome."\" ORDER BY id DESC LIMIT 4;";
$executa_fotos = mysqli_query($conexao, $sql_fotos) or die ("<b>menu_esq_fotos.php</b><br> ".mysqli_error($conexao));
$contar_fotos = mysqli_num_rows($executa_fotos);

$sql_fotos_total = "SELECT * FROM fotos WHERE user = \"".$nome."\";";
$executa_fotos_total = mysqli_query($conexao, $sql_fotos_total) or die ("<b>menu_esq_fotos.php</b><br> ".mysqli_error($conexao));
$contar_fotos_total = mysqli_num_rows($executa_fotos_total);

?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="center"> 
    <td colspan="2" class="td"><font color="#000000"><? echo $nome; ?></font></td>
  </tr>
  <tr class="texto"> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center"> 
    <td colspan="2"> <a href="perfil.php?nome=<? echo $nome; ?>" title="Ver perfil">
      <? if ($foto_pessoal == "sem_foto_pessoal.gif"){ ?>
      <img src="<? echo $end_objetos; ?>arquivos/images/<? echo $foto_pessoal; ?>" border="0"> 
      <? } else { ?>
      <img src="<? echo $nome; ?>/<? echo $foto_pessoal; ?>" border="0"> 
      <? } ?>
      </a>
    </td>
  </tr>
  <tr align="center" class="texto"> 
    <td colspan="2" class="texto_gran"><a href="perfil.php?nome=<? echo $nome; ?>" title="Ver perfil"><font color="<? echo $cor_links; ?>"><? echo $listar_user["nome"]." ".$listar_user["sobrenome"]; ?></font></a></td>
  </tr>
  <tr class="texto"> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center"> 
    <td colspan="2" class="td"><font color="#000000">&Uacute;ltimas Fotos</font></td>
  </tr>
  <? if ($contar_fotos == ""){ ?>
  <tr class="texto"> 
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/sem_foto_peq.gif" border="0"></td>
  </tr>
  <tr class="texto"> 
    <td colspan="2">&nbsp;</td>
  </tr>
  <? } else{ 
			  while ($listar_fotos = mysqli_fetch_assoc($executa_fotos)){ ?>
  <tr class="texto"> 
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="center"><a href="usuarios.php?nome=<? echo $nome; ?>&foto=<? echo $listar_fotos["id"]; ?>" title="<? echo $listar_fotos["data"]; ?>"><img border="0" src="<? echo $nome."/thumbs/".$listar_fotos["thumb"]; ?>"></a></td>
  </tr>
  <tr> 
    <td colspan="2" align="center" class="texto"><font color="<? echo $cor_links; ?>"><? echo $listar_fotos["data"]; ?></font></td>
  </tr>
  <tr class="texto"> 
    <td colspan="2">&nbsp;</td>
  </tr>
  <? } 
			  }
			  if ($contar_fotos_total > "4"){
			  ?>
  <tr class="texto"> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center"> 
    <td colspan="2" class="texto_gran"> <a href="fotos.php?nome=<? echo $nome; ?>" title="Mais fotos"><font color="<? echo $cor_links; ?>">Mais 
      fotos</font></a></td>
  </tr>
  <tr align="center">
    <td colspan="2" class="texto_gran">&nbsp;</td>
  </tr>
  <? } ?>
</table>
