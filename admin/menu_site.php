<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center" class="texto"> <a href="<? echo $end_objetos_adm; ?>index.php" title="<? echo $url_site; ?>"><font color="#000000"><?=$nome_site?></font></a> 
      | <a href="javascript:abre('contato.php', 'news', 'width=400, height=300');" title="Newsletter"><font color="#000000">Newsletter</font></a>
	  | <a href="javascript:abre('ver_sessoes.php', 'ver_sessoes', 'width=400, height=350');" title="Ver sessão corrente"><font color="#000000">Sessão</font></a> 
	  | <a href="javascript:abre('senha.php', 'trocar_senha', 'width=400, height=300');" title="Trocar senha"><font color="#000000">Trocar senha</font></a> 
      | <a href="logout.php" title="Logout"><font color="#000000">Logout</font></a> 
	</td>
    <td align="center" class="texto"> 
      <? include $end_objetos_adm."online.php"; ?>
    </td>
  </tr>
</table>
