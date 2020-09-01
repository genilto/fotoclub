 <? $link_adm = "<td align=\"right\"><a href=\"adm.php\"><img src=\"".$end_objetos."arquivos/images/martelo.gif\" alt=\"Página de administração\" width=\"20\" height=\"20\" border=\"0\"></a></td>
            <td class=\"texto\">&nbsp;<a href=\"adm.php\" title=\"Página de administração\">Adm</a></td>"; ?>
			
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EEEEEE">
  <tr>
    <td><img src="<? echo $end_objetos; ?>arquivos/images/ponta_esq.gif" width="20" height="20" border="0"></td>
    <? if ($local_pagina != "adm_perfil"){ ?>
    <td align="right"><a href="adm_perfil.php"><img src="<? echo $end_objetos; ?>arquivos/images/perfil.gif" alt="Administrar perfil" width="20" height="20" border="0"></a></td>
    <td class="texto">&nbsp;<a href="adm_perfil.php" title="Administrar perfil">Perfil</a></td>
    <? }else{ echo $link_adm;  }	   	  
		  if ($local_pagina != "adm_pagina"){ ?>
    <td align="right"><a href="adm_pagina.php"><img src="<? echo $end_objetos; ?>arquivos/images/pagina.gif" alt="Administrar P&aacute;gina" width="20" height="20" border="0"></a></td>
    <td class="texto">&nbsp;<a href="adm_pagina.php" title="Administrar Página">P&aacute;gina</a></td>
    <? }else{ echo $link_adm;  }		   	  
		  if ($local_pagina != "adm_fotos"){ ?>
    <td align="right"><a href="adm_fotos.php" ><img src="<? echo $end_objetos; ?>arquivos/images/fotos.gif" alt="Administrar Fotos" width="20" height="20" border="0"></a></td>
    <td class="texto">&nbsp;<a href="adm_fotos.php" title="Administrar Fotos">Fotos</a></td>
    <? }else{ echo $link_adm;  }		   	  
		  if ($local_pagina != "adm_amigos"){ ?>
    <td align="right"><a href="adm_amigos.php"><img src="<? echo $end_objetos; ?>arquivos/images/amigos.gif" alt="Administrar Amigos" width="20" height="20" border="0"></a></td>
    <td class="texto">&nbsp;<a href="adm_amigos.php" title="Administrar Amigos">Amigos</a></td>
    <? }else{ echo $link_adm;  }	  
		  if ($local_pagina != "adm_links"){ ?>
    <td align="right"><a href="adm_links.php"><img src="<? echo $end_objetos; ?>arquivos/images/links.gif" alt="Administrar Links" width="20" height="20" border="0"></a></td>
    <td class="texto">&nbsp;<a href="adm_links.php" title="Administrar Links">Links</a></td>
    <? }else{ echo $link_adm;  } 
	      if ($local_pagina != "adm_noticias"){ ?>
	 <td align="right"><a href="adm_noticias.php"><img src="<? echo $end_objetos; ?>arquivos/images/noticias.gif" alt="Administrar Notícias" width="20" height="20" border="0"></a></td>
    <td class="texto">&nbsp;<a href="adm_noticias.php" title="Administrar Notícias">Notícias</a></td>
	 <? }else{ echo $link_adm;  }  ?>
    <td align="right"><img src="<? echo $end_objetos; ?>arquivos/images/ponta_dir.gif" width="20" height="20" border="0"></td> 
  </tr>
</table>
