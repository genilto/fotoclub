<? 
if($link_usuario == 0){
	$des_link_usuario = $nome.".".$dominio;
}else{
	$des_link_usuario = $url_site."/".$nome;
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="center" class="texto">
				<? if ($local_pagina != "usuarios"){ ?>
				<a href="usuarios.php?nome=<? echo $nome; ?>" title="Fotos"><font color="#FFFFFF">Fotos</font></a>
               <? } 
			   
			   if ($local_pagina != "perfil" && $local_pagina != "usuarios"){ echo "|"; } 
			   
			   if ($local_pagina != "perfil"){ ?>
				<a href="perfil.php?nome=<? echo $nome; ?>" title="Perfil de <? echo $listar_user["nome"]." ".$listar_user["sobrenome"]; ?>"><font color="#FFFFFF">Ver perfil</font></a>
			    <? } ?>
			
			 
			 <? if ($local_pagina == "usuarios"){ ?>
			 | 
			 <a href="javascript:abre('denuncie.php?foto=<? echo $id_foto;?>&nome=<? echo $nome; ?>', 'denuncie', 'width=400, height=400');" title="Denuncie esta foto"><font color="#FFFFFF">Denuncie</font></a> 
             <? } ?>
			 
			 <!--| <a href="javascript:abre('indica_pagina.php?nome=<? echo $nome; ?>', 'indique', 'width=400, height=300');" title="Indique esta página"><font color="#FFFFFF">Indique esta página</font></a>-->
			 | <a href="javascript:abre('add_amigos.php?nome=<? echo $nome; ?>', 'add_amigos', 'width=400, height=300');" title="Adicione a sua lista de amigos"><font color="#FFFFFF">Adicionar a meus amigos</font></a>
				 </td>
              </tr>
            </table>