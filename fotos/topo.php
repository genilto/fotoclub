<?php
  $local_pagina_pra_contar = "topo";
  $logado = isset($logado) ? $logado : "não";
?>
<script src="AC_RunActiveContent.js" type="text/javascript"></script>

<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
      <td height="94" colspan="2"><table width="750" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td width="284"><a href="../index.php" title="<? echo $nome_site; ?>"><img src="<? echo $end_objetos; ?>arquivos/images/topo_01.gif" width="284" height="94" border="0" /></a></td>
              <td align="center">Anúncie aqui...</td>
          </tr>
      </table></td>
    </tr>
  
  <tr> 
    <td width="215" height="26" align="center" background="<? echo $end_objetos; ?>arquivos/images/topo_04.gif" class="texto"> 
        <? include "online.php"; ?>    </td>
    <td width="535" align="right" background="<? echo $end_objetos; ?>arquivos/images/topo_05.gif"> 
        <table width="380" border="0" cellpadding="0" cellspacing="0">
        <tr align="center" class="texto"> 
          <td width="7" align="right">&nbsp;</td>
          <td width="50" align="left">&nbsp;<a href="index.php" title="Página inicial"><strong><font color="#000000">Home</font></strong></a></td>
          <td width="9" align="right">&nbsp;</td>
          <? if ($logado == "não"){ ?>
          <td width="50" align="left">&nbsp;<a href="login.php" title="Login"><strong><font color="#000000">Login</font></strong></a></td>
          <? } else{ ?>
          <td width="49" align="left">&nbsp;<a href="logout.php" title="Sair"><strong><font color="#000000">Sair</font></strong></a></td>
          <? } ?>
          <td width="9" align="right">&nbsp;</td>
          <td width="51" align="left">&nbsp;<a href="busca.php" title="Buscar pessoas"><strong><font color="#000000">Busca</font></strong></a></td>
          <td width="9" align="right">&nbsp;</td>
          <td width="90" align="left">&nbsp;<a href="cadastro.php" title="Cadastre-se"><strong><font color="#000000">Cadastre-se</font></strong></a></td>
          <td width="56" align="left">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
