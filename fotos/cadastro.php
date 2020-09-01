<? 

require_once "ver_login.php";

$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
$focus = "";
$status = "";

//dados obrigatorios
$nome_cadastro = "";
$sobrenome = "";
$email = "";
$username = "";
$senha = "";
$confirma = "";
$dia_nasc = "";
$mes_nasc = "";
$ano_nasc = "";
$data_nasc = "";
$sexo = "";
$pais = "";
$estado = "";
$cep1 = "";
$cep2 = "";
$cep = "";
$sobre = "";

//dados opcionais
$endereco = "";
$numero = "";
$complemento = "";
$bairro = "";
$cidade = "";
$fone_ddd = "";
$fone_p = "";
$fone_s = "";
$ip = "";

if ($acao == "cadastrar") {

	//dados obrigatorios
	$nome_cadastro = $_POST["nome_cadastro"];
	$sobrenome = $_POST["sobrenome"];
	$email = strtolower($_POST["email"]);
	$username = strtolower($_POST["username"]);
	$senha = $_POST["senha"];
	$confirma = $_POST["confirma"];
	$dia_nasc = $_POST["dia_nasc"];
	$mes_nasc = $_POST["mes_nasc"];
	$ano_nasc = $_POST["ano_nasc"];
	$data_nasc = $dia_nasc."/".$mes_nasc."/".$ano_nasc;
	$sexo = $_POST["sexo"];
	$pais = $_POST["pais"];
	$estado = $_POST["estado"];
	$cep1 = $_POST["cep1"];
	$cep2 = $_POST["cep2"];
	$cep = $cep1."-".$cep2;
	$sobre = $_POST["sobre"];
	
	//dados opcionais
	$endereco = $_POST["endereco"];
	$numero = $_POST["numero"];
	$complemento = $_POST["complemento"];
	$bairro = $_POST["bairro"];
	$cidade = $_POST["cidade"];
	$fone_ddd = $_POST["fone_ddd"];
	$fone_p = $_POST["fone_p"];
	$fone_s = $_POST["fone_s"];
	$ip = $_SERVER['REMOTE_ADDR'];
		  
	//Verfica se os dados obrigatorios foram preenchidos
	if ($nome_cadastro == ""){
		$status = "Preencha seu Nome";
		$acao = "";
		$focus = "nome_cadastro";
	}elseif ($sobrenome == ""){
		$status = "Preencha seu Sobrenome";
		$acao = "";
		$focus = "sobrenome";
	}elseif ($email == ""){
		$status = "Preencha seu E-mail";
		$acao = "";
		$focus = "email";
	/*}elseif(!ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $email)){
		$status = "E-mail inválido, preencha-o corretamente";
		$acao = "";
		$focus = "email";*/
	}elseif ($username == ""){
		$status = "Preencha seu Username";
		$acao = "";
		$focus = "username";
	}elseif(!preg_match('/^[a-z0-9._]*$/i', $username)){
		$status = "Username inválido, preencha-o corretamente<br><font color=\"#000000\">".$caracteres_permitidos."</font>";
		$acao = "";
		$focus = "username";
	}elseif (strlen($username) < 3){
		$status = "Username muito curto, deve ter no mínimo 3 caracteres!";
		$acao = "";
		$focus = "username";
	}elseif ($senha == ""){
		$status = "Preencha sua senha";
		$acao = "";
		$focus = "senha";
	}elseif (strlen($senha) < 6){
		$status = "Senha muito curta, deve conter no mínimo 6 caracteres.";
		$acao = "";
		$focus = "senha";
	}elseif($senha != $confirma){
		$status = "As senhas não são iguais";
		$acao = "";
		$focus = "senha";
	}elseif ($dia_nasc == ""){
		$status = "Escolha o Dia de seu nascimento";
		$acao = "";
		$focus = "dia_nasc";
	}elseif ($mes_nasc == ""){
		$status = "Escolha o Mês de seu nascimento";
		$acao = "";
		$focus = "mes_nasc";
	}elseif ($ano_nasc == ""){
		$status = "Escolha o Ano de seu nascimento";
		$acao = "";
		$focus = "ano_nasc";
	}elseif ($sexo == ""){
		$status = "Escolha seu Sexo";
		$acao = "";
		$focus = "sexo";
	}elseif ($pais == ""){
		$status = "Preencha seu País";
		$acao = "";
		$focus = "pais";
	}elseif ($estado == ""){
		$status = "Preencha seu Estado";
		$acao = "";
		$focus = "estado";
	}elseif ($cep1 == ""){
		$status = "Preencha seu Cep";
		$acao = "";
		$focus = "cep1";
	}elseif ($cep2 == ""){
		$status = "Preencha seu Cep";
		$acao = "";
		$focus = "cep2";
	}elseif ($sobre == ""){
		$status = "Preencha as informações sobre você";
		$acao = "";
		$focus = "sobre";
	}else{
		/*//atribui um valor aos dados não preenchidos		  
		if ($endereco == ""){
			$endereco = "none";
		}
		if ($numero == ""){
			$numero = "none";
		}
		if ($complemento == ""){
			$complemento = "none";
		}		  
		if ($bairro == ""){
			$bairro = "none";
		}		  
		if ($cidade == ""){
			$cidade = "none";
		}
		if ($fone_ddd == ""){
			$fone_ddd = "00";
		}
		if ($fone_p == ""){
			$fone_p = "0000";
		}
		if ($fone_s == ""){
			$fone_s = "0000";
		}*/
				  
		$telefone = "(".$fone_ddd.")".$fone_p."-".$fone_s;
			
		$sql_mail = "SELECT * FROM user WHERE email = '".$email."'";
		$executa_mail = mysqli_query($conexao, $sql_mail) or die ("mail".mysqli_error($conexao));
		$contar_mail = mysqli_num_rows($executa_mail);
			  
		$sql = "SELECT * FROM user WHERE username = '".$username."'";
		$ver = mysqli_query($conexao, $sql) or die ("user".mysqli_error($conexao));
		$contar = mysqli_num_rows($ver);
	
		if ($contar_mail != 0){
			$status = "O e-mail <b>".$email."</b> 
					  já está sendo usado por outra pessoa.";
			$acao = "";
			$focus = "email";   
	   	}else{
			if ($contar != 0){
				$status = "O nome de usuário <b>".$username."</b> 
					  já está sendo usado por outra pessoa.";
			$acao = "";
			$focus = "username";
		}else{
			//insere os dados no banco
			$cadastra = "INSERT INTO `user` (`foto`
											,`ip` 
											,`nome` 
											,`sobrenome` 
											,`email`
											,`username`
											,`senha` 
											,`sexo` 
											,`data_nasc` 
											,`pais` 
											,`estado` 
											,`cep` 
											,`sobre`
											,`endereco` 
											,`numero` 
											,`complemento` 
											,`bairro` 
											,`cidade` 
											,`telefone`
									) VALUES (\"sem_foto_pessoal.gif\"
											 ,\"".$ip."\"
											 ,\"".ucwords(strtolower(htmlspecialchars($nome_cadastro)))."\"
											 ,\"".ucwords(strtolower(htmlspecialchars($sobrenome)))."\"
											 ,\"".$email."\"
											 ,\"".$username."\"
											 ,\"".$senha."\"
											 ,\"".$sexo."\"
											 ,\"".$data_nasc."\"
											 ,\"".ucwords(strtolower(htmlspecialchars($pais)))."\"
											 ,\"".htmlspecialchars($estado)."\"
											 ,\"".$cep."\"
											 ,\"".htmlspecialchars($sobre)."\"
											 ,\"".htmlspecialchars($endereco)."\"
											 ,\"".$numero."\"
											 ,\"".htmlspecialchars($complemento)."\"
											 ,\"".ucwords(strtolower(htmlspecialchars($bairro)))."\"
											 ,\"".ucwords(strtolower(htmlspecialchars($cidade)))."\"
											 ,\"".$telefone."\");";
											   
			$cadastra_padrao = "INSERT INTO `config` (`user` 
													 ,`titulo` 
													 ,`cor_lados` 
													 ,`cor_meio` 
													 ,`fonte_tit` 
													 ,`cor_tit` 
													 ,`cor_comentario`
													 ,`cor_links`
							 		 ) VALUES ('".$username."'
											  ,'".$nome_site." - ".ucwords(strtolower(htmlspecialchars($nome_cadastro)))." ".ucwords(strtolower(htmlspecialchars($sobrenome)))."'
											  ,'#CCCCCC'
											  ,'#EEEEEE'
											  ,'Verdana'
											  ,'#FF0000'
											  ,'#333333'
											  ,'#0000FF' );";
	
			//cria o diretorio com o nome do usuario
			if (!@mkdir(htmlspecialchars($username),0777)){
				$status = "Não foi possível criar o diretório ".$username.".";
				$acao = "";
				$focus = "nome";
			}else{
				//cria o diretorio para imagens
				if (!@mkdir(htmlspecialchars($username)."/images",0777)){
					$status = "Não foi possível criar o diretório das imagens.";
					$acao = "";
					$focus = "nome";
				}else{
					//cria o diretorio para thumbs
					if (!@mkdir(htmlspecialchars($username)."/thumbs",0777)){
						$status = "Não foi possível criar o diretório para thumbs.";
						$acao = "";
						$focus = "nome";
					}else{
						//cria o index.php
						if (!$handle = fopen(htmlspecialchars($username)."/index.php", 'a')) {
			 				$status = "Erro abrindo arquivo (index.php).";
							$acao = "";
							$focus = "nome";
			 				exit;
						}else{
							$conteudo = "<script>window.location=\"../usuarios.php?nome=".$username."\";</script>";
	 						// Escreve $conteudo no arquivo aberto. 
							if (!fwrite($handle, $conteudo)) {
				 				$status = "Erro escrevendo no arquivo (index.php).";
								$acao = "";
				 				$focus = "nome"; 
				 				exit; 
				 			}
						}
		  			}
		 		}
			}
	  	}
		if ($status == ""){ 
			$executa = mysqli_query($conexao, $cadastra) or die (mysqli_error($conexao));
			$executa_padrao = mysqli_query($conexao, $cadastra_padrao) or die (mysqli_error($conexao));
			
			if($link_usuario == 0){
				$des_link_usuario = htmlspecialchars($username).".".$dominio;
			}else{
				$des_link_usuario = $url_site."/".htmlspecialchars($username);
			}
		 
			//envia mensagem ao email do cadastrado 
		 
			$erro_mail = ""; 	 
			$mens = "<table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
				  <tr> 
					<td width=\"25%\" valign=\"top\"><a href=\"http://".$url_site."\" title=\"http://".$url_site."\"><img src=\"http://".$servidor_site."/arquivos/images/fotoclubelogo.gif\" width=\"249\" height=\"166\" border=\"0\"></a></td>
					<td width=\"75%\"><p><b><font color=\"#FF0000\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">:: 
						Cadastro efetuado!<br>
						</font></b><font size=\"2\" face=\"Arial, Helvetica, sans-serif\"><br>
						Parabéns <strong>".ucwords(strtolower(htmlspecialchars($nome_cadastro)))." ".ucwords(strtolower(htmlspecialchars($sobrenome)))."</strong>! <br>
						Você é o(a) mais novo(a) integrante do <br>
						clube de fotos que mais cresce na internet:<em><strong> O</strong></em></font><em><strong> 
						<font color=\"#FF9900\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">".$nome_site.".</font></strong></em></p>
					  <br> <font face=\"verdana\" size=\"2\" color=\"#222222\">Sua 
					  página de fotos é:<br>
					  <b>http://".$des_link_usuario."</b></font> </td>
				  </tr>
				  <tr align=\"center\"> 
					<td height=\"150\" colspan=\"2\"> <p><font color=\"#000000\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">O 
						".$nome_site." agradece seu cadastro no site e informa que<br>
						a partir de agora voc&ecirc; poder&aacute;, sem nenhuma complica&ccedil;&atilde;o, 
						<br>
						postar suas fotos na internet para que todo mundo possa ver 
						e comentar.</font></p>
					  <p><a href=\"http://".$des_link_usuario."\" target=\"_blank\"><img src=\"http://".$servidor_site."/arquivos/images/ver_fotos.gif\" border=\"0\" alt=\"Ver minha página de fotos\"></a>&nbsp; 
						<a href=\"http://".$url_site."/login.php\" target=\"_blank\"><img src=\"http://".$servidor_site."/arquivos/images/login.gif\" border=\"0\" alt=\"Login no site\"></a></p></td>
				  </tr>
				</table>"; 
				
			if (!@mail($email,$nome_site.": Cadastro efetuado!",$mens, $headers)){
				$erro_mail = "sim"; 
			} 
		}
	}
}  
}
 ?>
<html>
<head>
<title><? echo $titulo; ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
<LINK REL="SHORTCUT ICON" HREF="<? echo $end_objetos; ?>arquivos/images/icon.gif">
</head>

<body topmargin="0" leftmargin="0"<? if ($focus == ""){ $focus = "nome_cadastro"; } if($acao == ""){ echo " onLoad=\"document.cadastro.".$focus.".focus();\""; } ?>>
<? include "topo.php"; ?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="138" valign="top"> 
      <? include "menu.php"; ?>
    </td>
    <td colspan="4" align="center" valign="top"> 
	<? if ($acao == ""){ ?>
	<form name="cadastro" method="post" action="cadastro.php?acao=cadastrar" onSubmit="return valida_cadastro('insere');">
        <table width="80%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="27%">&nbsp;</td>
            <td width="57%">&nbsp;</td>
            <td width="16%">&nbsp;</td>
          </tr>
          <?
   if ($status != ""){
  ?>
          <tr> 
            <td colspan="3" align="center" class="titulo">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="3" align="center" class="td"><? echo $status ?></td>
          </tr>
          <tr> 
            <td colspan="3" align="center" class="titulo">&nbsp;</td>
          </tr>
          <?
}
?>
          <tr> 
            <td colspan="3" class="titulo">.: Cadastre-se</td>
          </tr>
          <tr> 
            <td colspan="3" class="texto">Para se cadasrar voc&ecirc; precisa 
              preencher corretamente os campos abaixo:</td>
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
            <td align="right" class="texto">Nome:</td>
            <td height="25" colspan="2" class="ex"> <input name="nome_cadastro" type="text" class="form" id="nome_cadastro" size="30" maxlength="30" value="<? echo $nome_cadastro; ?>"> 
            </td>
          </tr>
          <tr> 
            <td align="right" class="texto">Sobrenome:</td>
            <td height="25" colspan="2" class="ex"> <input name="sobrenome" type="text" class="form" id="sobrenome" size="30" maxlength="30" value="<? echo $sobrenome; ?>"> 
            </td>
          </tr>
          <tr> 
            <td align="right" class="texto">E-mail:</td>
            <td height="25" colspan="2" class="ex"> <input name="email" type="text" class="form" id="email" size="50" maxlength="50" value="<? echo $email; ?>"> 
            </td>
          </tr>
          <tr> 
            <td align="right" class="texto">Username:</td>
            <td colspan="2" class="ex"> 
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="46%"><input name="username" type="text" class="form" id="username" size="30" maxlength="15" value="<? echo $username; ?>"></td>
                  <td width="54%"><a href="javascript:testar_username();"><img src="<? echo $end_objetos; ?>arquivos/images/testar_username.gif" alt="Testar username" width="96" height="17" border="0"></a></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="25" align="right" class="texto">&nbsp;</td>
            <td colspan="2" valign="top" class="texto"><? echo $caracteres_permitidos; ?></td>
          </tr>
          <tr> 
            <td height="25" align="right" class="texto">Senha:</td>
            <td colspan="2"> <input name="senha" type="password" class="form" id="senha" size="20" maxlength="30"></td>
          </tr>
          <tr> 
            <td align="right" class="texto">Confirma senha:</td>
            <td height="25" colspan="2"> <input name="confirma" type="password" class="form" id="confirma" size="20" maxlength="30"> 
            </td>
          </tr>
          <tr> 
            <td align="right" class="texto">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td height="27" align="right" class="texto">Data de Nascimento:</td>
            <td class="texto"> <SELECT class="form" tabIndex="7" name="dia_nasc">
                <OPTION value="" selected>dia</OPTION>
             <? $i = "1";
				while($i <= "31"){
			  		$day = $i++;
			  		if ($day == $dia_nasc){
			  			$sel = " selected";
			  		}else{
			  			$sel = "";
			  		}
			  		echo "<OPTION value=\"".$day."\"".$sel.">".$day."</OPTION>";
			  	}
			  ?>
              </SELECT>
              / 
              <SELECT class="form" tabIndex="8" name="mes_nasc">
				<OPTION value=""<? if($mes_nasc == ""){ echo "selected"; } ?>>mês</OPTION>

			<? 	foreach($w_meses as $num_mes => $des_mes){
					if($mes_nasc == $num_mes){
						$escreve_selected = " selected";
					}else{
						$escreve_selected = "";
					}
                	echo "<OPTION value=\"".$num_mes."\"".$escreve_selected.">".$des_mes."</OPTION>\n";
				} ?>
              </SELECT>
              / 
              <SELECT class="form" tabIndex="9" name="ano_nasc">
                <OPTION value="" selected>ano</OPTION>
            <? 	while($min_ano_permitido <= $max_ano_permitido){
			  		$year = $min_ano_permitido++;
			  		if ($year == $ano_nasc){
			  			$sel = " selected";
			  		}else{
			  			$sel = "";
			  		}
			  		echo "<OPTION value=\"".$year."\"".$sel.">".$year."</OPTION>";
			  	}
			  ?>
              </SELECT> </td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td height="25" align="right" class="texto">Sexo:</td>
            <td> <SELECT class="form" name="sexo">
               <? 	foreach($w_lista_sexo as $des_sexo){
					  		if($listar_user["sexo"] == $des_sexo){
								$escreve_selected = " selected"; 
							}else{
								$escreve_selected = "";
							}
					  		echo "<OPTION value=\"".$des_sexo."\"".$escreve_selected.">".$des_sexo."</OPTION>";
					  	}
					  ?>
              </SELECT> </td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td height="25" align="right" class="texto">Pa&iacute;s:</td>
            <td><input name="pais" type="text" class="form" id="pais" size="30" maxlength="50" value="<? echo $pais; ?>"></td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td height="25" align="right" class="texto">Estado:</td>
            <td><input name="estado" type="text" class="form" id="estado" size="3" maxlength="3" value="<? echo $estado; ?>"></td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td height="25" align="right" class="texto">CEP:</td>
            <td class="texto"> <INPUT name="cep1" class="form" onKeyUp="pula(this,'cep2', 5);" size="10" maxLength="5" value="<? echo $cep1; ?>">
              - 
              <INPUT name="cep2" value="<? echo $cep2; ?>" class="form" size="2" maxLength="3">
			  <a href="javascript:abre('busca_cep.php', 'buscar_cep', 'width=360, height=390')" title="Consultar cep"> 
              <B>» Consultar CEP</B></a></td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td align="right" valign="top" class="texto">Sobre mim:</td>
            <td class="titulo"><textarea name="sobre" cols="50" rows="5" class="form" id="sobre"><? echo $sobre; ?></textarea></td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td align="right" class="texto">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="3" align="center" class="texto"><img src="<? echo $end_objetos; ?>arquivos/images/cad_opc.gif" width="546" height="29"></td>
          </tr>
          <tr> 
            <td align="right" class="texto">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td height="25" align="right" class="texto">Endere&ccedil;o:</td>
            <td colspan="2"><input name="endereco" type="text" class="form" id="endereco" size="50" maxlength="100" value="<? echo $endereco; ?>"></td>
          </tr>
          <tr> 
            <td height="25" align="right" class="texto">N&uacute;mero:</td>
            <td colspan="2"><input name="numero" type="text" class="form" id="numero" size="5" maxlength="10" value="<? echo $numero; ?>"></td>
          </tr>
          <tr> 
            <td height="25" align="right" class="texto">Complemento:</td>
            <td colspan="2"><input name="complemento" type="text" class="form" id="complemento" size="50" maxlength="100" value="<? echo $complemento; ?>"></td>
          </tr>
          <tr> 
            <td height="25" align="right" class="texto">Bairro:</td>
            <td><input name="bairro" type="text" class="form" id="bairro" size="30" maxlength="50" value="<? echo $bairro; ?>"></td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td height="25" align="right" class="texto">Cidade:</td>
            <td><input name="cidade" type="text" class="form" id="cidade" size="30" maxlength="50" value="<? echo $cidade; ?>"></td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td align="right" class="texto">Telefone:</td>
            <td height="25" class="texto"> <INPUT name="fone_ddd" value="<? echo $fone_ddd; ?>" class="form" onKeyUp="pula(this,'fone_p', 2);" size="1" maxLength="2"> 
              <INPUT name="fone_p" value="<? echo $fone_p; ?>" class="form" tabIndex="22" onKeyUp="pula(this,'fone_s', 4);" size="3" maxLength="4">
              - 
              <INPUT name="fone_s" value="<? echo $fone_s; ?>" class="form" size="3" maxLength="4"></td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td align="right" class="texto">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="3" class="texto">Ao completar e enviar este formul&aacute;rio 
              de registro gratuito voc&ecirc; estar&aacute; concordando com nossa 
              pol&iacute;tica de Privacidade presente no endere&ccedil;o: <a href="javascript:abre('privacidade.php', 'privacidade', 'scrollbars=yes, width=400, height=300')" title="Política de privacidade">http://<? echo $url_site ?>/privacidade.php</a></td>
          </tr>
          <tr> 
            <td align="right" class="texto">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="texto">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="3" align="center" class="texto"> <input name="envia" type="image" src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Cadastrar" width="89" height="29" border="0"> 
              <a href="javascript:history.back()"><img src="<? echo $end_objetos; ?>arquivos/images/voltar.gif" alt="Voltar" width="89" height="29" border="0"></a> 
            </td>
          </tr>
          <tr> 
            <td align="right" class="texto">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="texto">&nbsp;</td>
          </tr>
        </table>
      </form>
	  <? }elseif($acao == "cadastrar"){ ?>
      <table width="80%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td colspan="3"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td colspan="3" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/<? if ($status == ""){ echo "sucesso.gif"; }else{ echo "opa.gif"; } ?>" width="548" height="31"></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3" class="texto"> 
                  <? if ($status == ""){
				 echo "Seu cadastro foi realizado com sucesso, "; 
				 if ($erro_mail != ""){
				 echo " porém o e-mail não pode ser enviado a você confirmando o mesmo, mesmo assim ";
				 }
				 echo "a partir de agora voc&ecirc; poder&aacute; postar suas fotos.<br><br>
				 Sua página de fotos é: <a href=\"usuarios.php?nome=".$username."\" title=\"http://".$des_link_usuario."\">http://".$des_link_usuario."</a>.<br>
				 Para configurar suas fotos basta você se logar no site pelo endereço <a href=\"login.php\" title=\"Login\">http://".$url_site."/login.php</a> ou clicando no botão login.<br>                  
                  Deseja fazer isso agora?";
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
                <td align="center"><a href="<? if ($status == ""){ echo "login.php"; }else{ echo "javascript:history.back();"; } ?>"><img src="<? echo $end_objetos; ?>arquivos/images/<? if ($status == ""){ echo "login.gif"; }else{ echo "voltar.gif"; } ?>" alt="<? if ($status == ""){ echo "Login"; }else{ echo "Voltar"; } ?>" width="89" height="29" border="0"></a></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td align="right"><img src="<? echo $end_objetos; ?>arquivos/images/sucesso_cadastro.gif" width="118" height="119"></td>
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
      <? } ?>
    </td>
  </tr>
  <tr> 
    <td colspan="5"> 
      <? include "rodape.php" ?>
    </td>
  </tr>
</table>
</body>
</html>
