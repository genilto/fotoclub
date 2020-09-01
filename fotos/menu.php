<?php
  $logado = isset($logado) ? $logado : "não";
  $local_pagina = isset($local_pagina) ? $local_pagina : "";
?>
<form name="login_menu" method="post" action="login.php?acao=logar" onSubmit="return valida_login_menu();">
  <table width="138" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEEEEE">
    <tr align="center" bgcolor="#FFFFFF"> 
      <td colspan="2" class="texto">&nbsp;</td>
    </tr>
    <tr align="center"> 
      <td colspan="2" class="titulo"><img src="<? echo $end_objetos; ?>arquivos/images/borda_menu_cima.gif" width="138" height="19"></td>
    </tr>
    <tr> 
      <td colspan="2" align="center" class="titulo"><img src="<? echo $end_objetos; ?>arquivos/images/servicos.gif"></td>
    </tr>
    <tr> 
      <td width="6%">&nbsp;</td>
      <td width="88%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="20%" height="25" align="right"><a href="index.php"><img src="<? echo $end_objetos; ?>arquivos/images/home.gif" alt="P&aacute;gina inicial" width="20" height="20" border="0"></a></td>
            <td class="texto">&nbsp;<a href="index.php" title="Página inicial">Home</a></td>
          </tr>
          <tr> 
            <td height="25" align="right"><a href="cadastro.php"><img src="<? echo $end_objetos; ?>arquivos/images/cadastro.gif" alt="Cadastre-se" width="20" height="20" border="0"></a></td>
            <td align="left" class="texto">&nbsp;<a href="cadastro.php" title="Cadastre-se">Cadastre-se</a></td>
          </tr>
          <tr> 
            <td height="25" align="right"><a href="busca.php"><img src="<? echo $end_objetos; ?>arquivos/images/busca.gif" alt="Buscar pessoas" width="20" height="20" border="0"></a></td>
            <td align="left" class="texto">&nbsp;<a href="busca.php" title="Buscar pessoas">Busca</a></td>
          </tr>
          
          <? if ($logado == "não"){ ?>
          <tr> 
            <td height="25" align="right"><a href="login.php"><img src="<? echo $end_objetos; ?>arquivos/images/login_link.gif" alt="Login" width="20" height="20" border="0"></a></td>
            <td align="left" class="texto">&nbsp;<a href="login.php" title="Login">Login</a></td>
          </tr>
          <? } else{ ?>
          <tr> 
            <td height="25" align="right"><a href="logout.php"><img src="<? echo $end_objetos; ?>arquivos/images/login_link.gif" alt="Sair" width="20" height="20" border="0"></a></td>
            <td align="left" class="texto">&nbsp;<a href="logout.php" title="Sair">Sair</a></td>
          </tr>
          <? } ?>
        </table></td>
    </tr>
    <tr class="texto"> 
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/<? if ($logado == "não"){ echo "login_menu.gif"; } else{ echo "adm.gif"; }?>"></td>
    </tr>
    <? 
    if ($logado == "não"){ ?>
    <tr> 
      <td colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td colspan="2" class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td align="right" class="texto">User:</td>
            <td><input name="username" type="text" class="form" id="username" size="10" maxlength="15"></td>
          </tr>
          <tr> 
            <td align="right" class="texto">Senha:</td>
            <td><input name="senha" type="password" class="form" size="10" maxlength="30"> 
            </td>
          </tr>
          <tr> 
            <td class="texto">&nbsp;</td>
            <td height="25" valign="bottom"> <input name="entrar" type="image" src="<? echo $end_objetos; ?>arquivos/images/entrar.gif" alt="Entrar" border="0"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <? } else{?>
    <tr> 
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td height="20" colspan="2" align="center" class="texto_gran"><? echo $des_saudacao;?></td>
    </tr>
    <tr> 
      <td height="20" colspan="2" align="center" class="texto"><? echo $login_usuario; ?></td>
    </tr>
    <tr> 
      <td height="20" colspan="2" align="center" class="texto_gran"> 
        <? if ($local_pagina == ""){ echo "<a href=\"adm.php\" title=\"Administrar página\">Entrar</a>"; } else { echo "<a href=\"logout.php\" title=\"Sair\">sair</a>"; } ?>
      </td>
    </tr>
    <? } ?>
    <tr align="center"> 
      <td colspan="2"><img src="<? echo $end_objetos; ?>arquivos/images/borda_menu_baixo.gif" width="138" height="19"></td>
    </tr>
  </table>
</form>