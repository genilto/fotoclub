<? include "valida.php"; 

$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
$status = isset($_GET["status"]) ? $_GET["status"] : "";

$cor = "";

if ($acao == "deletar" || $acao == "deletando"){
	if ($id == ""){
		$status = "Escolha o usuário que deseja deletar";
		$acao = "";
	}else{
		
		$sql_user = "SELECT * FROM user WHERE id = '".$id."'";
		$exe_user = mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));
		$contar_user = mysqli_num_rows($exe_user);
		$listar_user = mysqli_fetch_assoc($exe_user);
		
		if ($contar_user == 0){
			$status = "Não há nenhum usuário cadastrado com id ".$id;
			$acao = "";
		}else{
			if ($acao == "deletando"){
				if (md5($senha) != $senha_administrador){
  					$status = "A senha de administrador está incorreta.";
  					$acao = "deletar";  
				}else{
					$usuario = $listar_user["username"];
					$email   = $listar_user["email"];
					$nome    = $listar_user["nome"]." ".$listar_user["sobrenome"];
	
					$sql_amigos   = "DELETE FROM amigos         WHERE user      = '".$listar_user["username"]."' OR amigo = '".$listar_user["username"]."'";
					$sql_coment   = "DELETE FROM comentarios    WHERE user      = '".$listar_user["username"]."'";
					$sql_config   = "DELETE FROM config         WHERE user      = '".$listar_user["username"]."'";
					$sql_contad   = "DELETE FROM contador       WHERE user      = '".$listar_user["username"]."'";
					$sql_fotos    = "DELETE FROM fotos          WHERE user      = '".$listar_user["username"]."'";
					$sql_links    = "DELETE FROM links          WHERE user      = '".$listar_user["username"]."'";
					$sql_noticias = "DELETE FROM noticias    	WHERE user      = '".$listar_user["username"]."'";
					$sql_chat 	  = "DELETE FROM conversas_chat WHERE user      = '".$listar_user["username"]."'";
					$sql_user 	  = "DELETE FROM user 			WHERE username  = '".$listar_user["username"]."'";

					if(deleta_dir("../fotos/".$listar_user["username"]."/") == "ok"){
						$status_del = "";
						$deleta_usuario = "sim";
						$acao = "";
					}else{
						$status_del = "<br>Não foi possível deletar o diretório ".$usuario.".";
						$status_del .= "<br>Deseja excluir o usuário mesmo assim?<br>";
						$status_del .= "<a href=\"index.php?acao=deletar&id=".$id."&del_erro=sim\"><b>Sim</b></a> - ";
						$status_del .= "<a href=\"index.php\"><b>Não</b></a>";
						$deleta_usuario = $_GET["del_erro"];
						$acao = "";
					}
					if($deleta_usuario == "sim"){
						mysqli_query($conexao, $sql_amigos) or die (mysqli_error($conexao));
						mysqli_query($conexao, $sql_coment) or die (mysqli_error($conexao));
						mysqli_query($conexao, $sql_config) or die (mysqli_error($conexao));
						mysqli_query($conexao, $sql_contad) or die (mysqli_error($conexao));
						mysqli_query($conexao, $sql_fotos) or die (mysqli_error($conexao));
						mysqli_query($conexao, $sql_links) or die (mysqli_error($conexao));
						mysqli_query($conexao, $sql_noticias) or die (mysqli_error($conexao));
						mysqli_query($conexao, $sql_chat) or die (mysqli_error($conexao));
						mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));

						$mens = "<table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
								<td width=\"25%\" valign=\"top\">
								<a href=\"http://".$url_site."\">
								<img src=\"http://".$servidor_site."/arquivos/images/fotoclubelogo.gif\" width=\"249\" height=\"166\" border=\"0\">
								</a>
								</td>
								<td width=\"75%\">
								<p><b><font color=\"#FF0000\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">:: ".$nome_site."<br></font></b>
								<font size=\"2\" face=\"Arial, Helvetica, sans-serif\">
								<br>
								<strong>Caro(a) amigo(a) ".$nome.",</strong> 
								<br>Seu cadastro foi anulado pela equipe ".$nome_site.".</td>
								</tr>
								<tr align=\"center\">
								<td height=\"150\" colspan=\"2\">
								<p>
								<font color=\"#000000\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">
								Seu cadastro: <b>".$usuario."</b>, 
								foi removido do sistema do ".$nome_site.", talvez por conter algum conteúdo proibido, 
								ou porque você tenha requisitado o anulamento do cadastro. <br>
								De qualquer forma não deixe de visitar o ".$nome_site." e até a próxima.
								</font></p>
								</td>
								</tr>
								</table>";
						
						$headers = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headers .= "From: ".$nome_site."<".$mailto."> \r\n";
				  
						if (!@mail($email, $nome_site.": Cadastro anulado!", $mens, $headers)){
							$status_mail = "<br>O e-mail não pode ser enviado.";
						}else{
							$status_mail = "";
						}
						$status = "Usuário ".$usuario." deletado com sucesso! ".$status_mail;
					}else{
						$status = "Usuário ".$usuario." não pode ser deletado! ".$status_del;
					}
				}
			}
		}
	}
}

$sql = "SELECT * FROM user ORDER BY nome";
$exe = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
$contar = mysqli_num_rows($exe);
?>
<html>
<head>
<title><? echo $titulo_adm; ?></title>
<script src="<? echo $end_objetos_adm; ?>script.js"></script>
<link href="<? echo $end_objetos_adm; ?>padrao.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="0" leftmargin="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td width="100%" colspan="2" align="center" bgcolor="#EEEEEE"> <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr bgcolor="#999999"> 
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td><img src="<? echo $end_objetos; ?>arquivos/images/canto_adm_1.gif" width="20" height="20"></td>
                      <td>&nbsp;</td>
                      <td align="right"><img src="<? echo $end_objetos; ?>arquivos/images/canto_adm_2.gif" width="20" height="20"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td align="right" valign="top"><a href="<? echo $end_objetos_adm; ?>index.php"><img src="<? echo $end_objetos; ?>arquivos/images/fotoclubelogo_adm.gif" width="200" height="133" border="0" alt="<? echo $url_site; ?>"></a></td>
                <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" background="<? echo $end_objetos; ?>arquivos/images/banner.gif">
                    <tr> 
                      <td width="550" height="100" valign="top">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td height="30" valign="middle"> 
                        <? include "menu_site.php"; ?>
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr bgcolor="#999999"> 
                <td width="0%" bgcolor="#999999" class="titulo">&nbsp;</td>
                <td width="27%" height="20" align="right" bgcolor="#999999" class="titulo"><font color="#FFFFFF">Usu&aacute;rios 
                  cadastrados:</font></td>
                <td width="70%" class="titulo"><font color="#FFFFFF">&nbsp;<? echo $contar; ?> 
                  no total</font></td>
                <td width="3%" align="right" class="titulo">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr valign="top" bgcolor="#EEEEEE"> 
          <td height="200" colspan="2" class="texto_gran"> 
            <? if ($status != ""){ ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr align="center"> 
                <td colspan="2" class="td"><? echo $status; ?></td>
              </tr>
              <tr class="texto"> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            <? } 
	if ($acao == ""){ ?>
            <table width="750" border="0" cellpadding="0" cellspacing="0">
              <? 
	    
		if ($contar != 0){	   
			while ($listar = mysqli_fetch_assoc($exe)){
				if ($cor == "#EEEEEE"){ 
					$cor = "#CCCCCC"; 
					$lixo = "lixo3.gif";
					$chave = "chave2.gif";
					$contato = "contato2.gif";
				}else{
					$lixo = "lixo2.gif";
					$chave = "chave3.gif";
					$contato = "contato3.gif"; 
					$cor = "#EEEEEE";
				} 
				
				if($link_usuario == 0){
	   				$des_link_usuario = $listar["username"].".".$dominio;
				}else{
					$des_link_usuario = $url_site."/".$listar["username"];
				}
	   ?>
              <tr bgcolor="<? echo $cor; ?>"> 
                <td height="20" align="right"><img src="<? echo $end_objetos; ?>arquivos/images/lista.gif" width="21" height="7"></td>
                <td class="texto"><a href="<? echo $end_objetos_adm; ?>usuarios.php?nome=<? echo $listar["username"]; ?>" title="http://<? echo $des_link_usuario; ?>" target="_blank"><font color="#0000FF"><? echo $listar["nome"]." ".$listar["sobrenome"]; ?></font></a></td>
                <td class="texto">&nbsp;</td>
                <td class="texto"><a href="index.php?acao=deletar&id=<? echo $listar["id"]; ?>" title="Deletar usuário"><img src="<? echo $end_objetos; ?>arquivos/images/<? echo $lixo; ?>" width="16" height="16" border="0"></a></td>
                <td class="texto"><a href="javascript:abre('ver_senha.php?id=<? echo $listar["id"]; ?>', 'ver_senha', 'width=300, height=250');" title="Ver informações deste usuário"><img src="<? echo $end_objetos; ?>arquivos/images/<? echo $chave; ?>" width="16" height="16" border="0"></a></td>
                <td class="texto"><a href="javascript:abre('contato.php?id=<? echo $listar["id"]; ?>', 'contato', 'width=400, height=300');" title="Entrar em contato com este usuário"><img src="<? echo $end_objetos; ?>arquivos/images/<? echo $contato; ?>" width="16" height="16" border="0"></a></td>
              </tr>
              <? }
		 }else{ ?>
              <tr align="center"> 
                <td colspan="6" class="titulo">&nbsp;</td>
              </tr>
              <tr align="center"> 
                <td colspan="6" class="titulo">&nbsp;</td>
              </tr>
              <tr align="center"> 
                <td colspan="6" class="titulo"><font color="#FF0000">Nenhum usuário 
                  cadastrado!</font></td>
              </tr>
              <? } ?>
            </table>
            <? }elseif($acao == "deletar"){
	  
	  ?>
            <form name="deletar" method="post" action="index.php?acao=deletando&id=<? echo $id; ?>&del_erro=<? echo $_GET["del_erro"]; ?>" onSubmit="javascript:disable(this); return valida_confirma();">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="39%" class="titulo">&nbsp;</td>
                  <td width="61%">&nbsp;</td>
                </tr>
                <tr> 
                  <td align="center" class="titulo">Deletando usu&aacute;rio <font color="#0000FF"><? echo $listar_user["nome"]." ".$listar_user["sobrenome"]; ?></font></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="2" align="center" class="texto_gran">&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="2" align="center" class="texto_gran">Digite a senha 
                    de administrador: </td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="2" align="center" class="texto">senha: 
                    <input name="senha" type="password" class="form" id="senha" size="30" maxlength="30"></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr align="center"> 
                  <td colspan="2"><input name="sendBtn" type="submit" class="form" id="sendBtn" value="Pr&oacute;ximo"> 
                    <input name="Submit2" type="button" class="form" value="Cancelar" onClick="javascript:window.location='index.php';"></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </form>
            <? } ?>
          </td>
        </tr>
        <tr align="center" bgcolor="#999999"> 
          <td height="20" colspan="2" class="texto"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="<? echo $end_objetos; ?>arquivos/images/canto_adm_3.gif" width="20" height="20"></td>
                <td height="20" align="center" class="texto"><font color="#EEEEEE"><? echo $rodape_site; ?></font></td>
                <td align="right"><img src="<? echo $end_objetos; ?>arquivos/images/canto_adm_4.gif" width="20" height="20"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td colspan="2"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>