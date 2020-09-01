<? include "ver_login.php";

$erro = $_GET["erro"];

?>

<html>
<head>
<title><? echo $titulo; ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="<? echo $fundo ?>" topmargin="0" leftmargin="0">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="90" height="54" align="right"><a href="index.php"><img src="<? echo $end_objetos; ?>arquivos/images/usuarios_01.gif" alt="<? echo $url_site; ?>" width="90" height="54" border="0"></a></td>
    <td width="660" height="54" background="<? echo $end_objetos; ?>arquivos/images/usuarios_02.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="texto"> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td align="center" class="texto">
		      <a href="index.php" title="<? echo $url_site; ?>"><font color="#000000">Home</font></a> 
            | <a href="login.php" title="Login"><font color="#000000">Login</font></a>
			| <a href="cadastro.php" title="Cadastre-se"><font color="#000000">Cadastre-se</font></a> 
            | <a href="indique.php" title="Indique o <? echo $nome_site; ?>"><font color="#000000">Indique</font></a>
			| <a href="contato.php" title="Contato"><font color="#000000">Contato</font></a> </td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<? echo $cor_lados; ?>">
        <tr> 
          <td width="150"><img src="<? echo $end_objetos; ?>arquivos/images/usuarios_03.gif" width="150" height="20"></td>
          <td width="450" align="center" bgcolor="#1B8D08" class="titulo"><font color="#FFFFFF">Ocorreu 
            algum erro!</font></td>
          <td width="2"><img src="<? echo $end_objetos; ?>arquivos/images/usuarios_05.gif" width="150" height="20"></td>
        </tr>
        <tr> 
          <td height="500" colspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2" bgcolor="#1B8D08">&nbsp;</td>
                <td height="500" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr class="texto"> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td colspan="3" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/ops.gif" width="300" height="50"></td>
                    </tr>
                    <tr class="texto"> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td colspan="3" class="td">Alguns erros ocorreram:</td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr align="center"> 
                      <td colspan="3" class="texto"> 
                        <? if ($erro == "no_user"){ ?>
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="26%">&nbsp;</td>
                            <td width="74%" class="texto_gran">> Usu&aacute;rio 
                              <? echo $nome; ?> n&atilde;o encontrado.</td>
                          </tr>
                          <tr align="center"> 
                            <td colspan="2" class="texto">Parece que a p&aacute;gina 
                              que voc&ecirc; est&aacute; tentando acessar n&atilde;o 
                              existe.</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                            <td class="texto_gran">&nbsp;</td>
                          </tr>
                        </table>
                        <? }
						 elseif($erro == ""){ ?>
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="26%">&nbsp;</td>
                            <td width="74%" class="texto_gran">> Erro 404.</td>
                          </tr>
                          <tr align="center"> 
                            <td colspan="2" class="texto">Parece que a p&aacute;gina 
                              que voc&ecirc; est&aacute; tentando acessar n&atilde;o 
                              existe.</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                            <td class="texto_gran">&nbsp;</td>
                          </tr>
                        </table>
                        <? }else{ ?>
						 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="26%">&nbsp;</td>
                            <td width="74%" class="texto_gran">> Erro indefinido.</td>
                          </tr>
                          <tr align="center"> 
                            <td colspan="2" class="texto">N&atilde;o foi poss&iacute;vel 
                              identificar o erro. Por favor entre em contato com 
                              o administrador do site.</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                            <td class="texto_gran">&nbsp;</td>
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
                    <tr align="center"> 
                      <td colspan="3"><a href="index.php"><img src="<? echo $end_objetos; ?>arquivos/images/bt_home.gif" alt="<? echo $url_site; ?>" width="89" height="29" border="0"></a></td>
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
                  </table> </td>
                <td width="2" bgcolor="#1B8D08">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><img src="<? echo $end_objetos; ?>arquivos/images/bordas3.gif" width="150" height="20"></td>
          <td bgcolor="#1B8D08" class="texto" align="center"><? echo  $rodape_site; ?></td>
          <td><img src="<? echo $end_objetos; ?>arquivos/images/bordas4.gif" width="150" height="20"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
