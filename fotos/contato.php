<? 

include "ver_login.php";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
 ?>
<html>
<head>
<title><? echo $titulo ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
<LINK REL="SHORTCUT ICON" HREF="<? echo $end_objetos; ?>arquivos/images/icon.gif">
</head>

<body topmargin="0" leftmargin="0" <? if ($acao == ""){ echo "onLoad=\"document.contato.nome.focus();\""; } ?>>
<? include "topo.php"; ?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="138" valign="top"> 
      <? include "menu.php"; ?>
    </td>
    <td colspan="4" align="center" valign="top"> 
	<? 
if ($acao == "enviar"){ ?>

	<table width="80%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td colspan="3"> 
            <?
						
//dados obrigatorios
$nome = isset($_POST["nome"]) ? ucwords(strtolower(htmlspecialchars($_POST["nome"]))) : "";
$email = isset($_POST["email"]) ? strtolower($_POST["email"]) : "";
$acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
$texto = isset($_POST["texto"]) ? htmlspecialchars($_POST["texto"]) : "";
$ip = $_SERVER['REMOTE_ADDR'];


$erros = "";		  
//Verfica se os dados obrigatorios foram preenchidos
if ($nome == ""){
	$erros = $erros. "> O campo Nome não pode estar vazio<br>";
}elseif ($email == ""){
	$erros = $erros . "> O campo E-mail não pode estar vazio<br>";
/*}elseif(!@ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $email)){
	$erros = $erros . "> O campo E-mail não contém um email válido";*/
}elseif ($acao == ""){
	$erros = $erros . "> Escolha uma ação.<br>";
}elseif ($texto == ""){
	$erros = $erros . "> O campo de Comentários não pode estar vazio<br>";
}
 
//envia mensagem ao email do cadastrado
 if ($erros == ""){
 $mens = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr> 
    <td width=\"27%\" align=\"center\" valign=\"top\"><a href=\"http://".$dominio."\" target=\"_blank\"><img border=\"0\" src=\"".$servidor_site."/arquivos/images/fotoclubelogo.gif\" width=\"249\" height=\"166\"></a></td>
    <td width=\"73%\" valign=\"top\"> 
      <table width=\"100%\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#CCCCCC\">
        <tr>
          <td><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
              <tr align=\"center\"> 
                <td colspan=\"2\" bgcolor=\"#CCCCCC\"><strong><em><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">Contato 
                  ".$nome_site.": </font></em></strong> <em><font color=\"#990000\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>".$nome."</strong></font></em></td>
              </tr>
              <tr> 
                <td align=\"right\">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr bgcolor=\"#EEEEEE\"> 
                <td width=\"33%\" height=\"25\" align=\"right\"><font color=\"#CC0000\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Nome: 
                  </strong></font></td>
                <td width=\"67%\">&nbsp;<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">".$nome."</font></td>
              </tr>
              <tr> 
                <td height=\"25\" align=\"right\"><strong><font color=\"#CC0000\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">E-mail: 
                  </font></strong></td>
                <td>&nbsp;<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">".$email."</font></td>
              </tr>
              <tr bgcolor=\"#EEEEEE\"> 
                <td height=\"25\" align=\"right\" valign=\"top\"><font color=\"#CC0000\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>".$acao.":</strong></font></td>
               <td>&nbsp;<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">".$texto."</font></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr align=\"center\">
    <td colspan=\"2\">&nbsp;</td>
  </tr>
  <tr align=\"center\"> 
    <td colspan=\"2\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">&copy; 
      2006 ".$nome_site." | By ".$criador."</font></td>
  </tr>
</table>";

  if (!envia_email($mailto, $nome_site.": ".$acao." - ".$nome,"$mens")){
  $erros = "> O E-mail não pode ser enviado.";
  }
 }

?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td colspan="3" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/<? if ($erros == ""){ echo "sucesso.gif"; }else{ echo "opa.gif"; } ?>" width="548" height="31"></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" class="texto"> 
                  <? if ($erros == ""){
				 echo "<b>Os dados foram enviados com sucesso.</b><br><br>
				 Muito Obrigado <b>".$nome."</b> por entrar em contato conosco, o <b>".$nome_site."</b> agradece.<br>
				 Entraremos em contato com você o mais breve possível caso necessite 
              mais esclarecimentos. "; 
				  }
				   else{
				    echo "<font class=\"texto_gran\">Os seguintes erros ocorreram:</font><br><br>".$erros; 
				  }
				   ?>
                </td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td align="center"><a href="<? if ($erros == ""){ echo "index.php"; }else{ echo "javascript:history.back();"; } ?>"><img src="<? echo $end_objetos; ?>arquivos/images/<? if ($erros == ""){ echo "bt_home.gif"; }else{ echo "voltar.gif"; } ?>" alt="<? if ($erros == ""){ echo "Home"; }else{ echo "Voltar"; } ?>" width="89" height="29" border="0"></a></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
	
	<? } else { ?>
	<form name="contato" method="post" action="contato.php?acao=enviar" onSubmit="return valida_contato();">
        <table width="80%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="27%">&nbsp;</td>
            <td width="57%">&nbsp;</td>
            <td width="16%">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="3" class="titulo">.: Contato</td>
          </tr>
          <tr> 
            <td colspan="3" class="texto">Para entrar em contato, mandar seu coment&aacute;rio, 
              suas d&uacute;vidas, sugest&otilde;es ou reclama&ccedil;&otilde;es 
              voc&ecirc; precisa preencher corretamente os campos abaixo, sua 
              opini&atilde;o &eacute; importante para n&oacute;s:</td>
          </tr>
          <tr> 
            <td colspan="3" class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="3" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/cad_obr.gif" width="548" height="31"></td>
          </tr>
          <tr> 
            <td align="right" class="texto">&nbsp;</td>
            <td height="25" colspan="2" class="ex">&nbsp;</td>
          </tr>
          <tr> 
            <td align="right" class="texto">Nome Completo:</td>
            <td height="25" colspan="2" class="ex"> <input name="nome" type="text" class="form" id="nome" size="30" maxlength="30"> 
            </td>
          </tr>
          <tr> 
            <td align="right" class="texto">E-mail:</td>
            <td height="25" colspan="2" class="ex"> <input name="email" type="text" class="form" id="email" size="50" maxlength="50"> 
            </td>
          </tr>
          <tr> 
            <td height="25" align="right" class="texto">A&ccedil;&atilde;o:</td>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="texto"> 
                  <td width="5%"><input name="acao" type="radio" value="comentario" checked></td>
                  <td width="21%">Coment&aacute;rio</td>
                  <td width="5%"><input type="radio" name="acao" value="duvida"></td>
                  <td width="12%">D&uacute;vida</td>
                  <td width="5%"><input type="radio" name="acao" value="sugestao"></td>
                  <td width="17%">Sugest&atilde;o</td>
                  <td width="2%"><input type="radio" name="acao" value="reclamacao"></td>
                  <td width="33%">Reclama&ccedil;&atilde;o</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td align="right" valign="top" class="texto">Coment&aacute;rio, d&uacute;vida, 
              sugest&atilde;o ou reclama&ccedil;&atilde;o:</td>
            <td><textarea name="texto" cols="50" rows="5" class="form"></textarea></td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td align="right" class="texto">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="3" class="texto">Ao completar e enviar este formul&aacute;rio 
              de contato voc&ecirc; estar&aacute; enviando um e-mail para os criadores 
              do <b><? echo $nome_site; ?></b>. Entraremos em contato com você 
              o mais breve possível caso necessite mais esclarecimentos. </td>
          </tr>
          <tr> 
            <td align="right" class="texto">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="3" align="center" class="texto"> <input name="envia" type="image" src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Enviar" width="89" height="29" border="0"> 
              <a href="javascript:history.back()"><img src="<? echo $end_objetos; ?>arquivos/images/voltar.gif" alt="Voltar" width="89" height="29" border="0"></a> 
            </td>
          </tr>
        </table>
      </form>
	  
	  
	  <? } ?></td>
  </tr>
  <tr> 
    <td colspan="5"> 
      <? include "rodape.php" ?>
    </td>
  </tr>
</table>
</body>
</html>
