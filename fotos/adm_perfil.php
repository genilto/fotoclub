<? 
$status = "";

include "valida_user.php"; 

$local_pagina = "adm_perfil";
$pagina_nome = "Meu perfil";
$acao = isset($_GET["acao"]) ? $_GET["acao"] : "";

if ($acao == "editar"){

	$sql_user = "SELECT * FROM user WHERE username = '".$login_usuario."'";
	$executa_user = mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));
	$listar_user = mysqli_fetch_assoc($executa_user);

	$erros = "";
	$nome = $_POST["nome_cadastro"];
	$sobrenome = $_POST["sobrenome"];
	$email = strtolower($_POST["email"]);
	$senha = $_POST["senha"];
	$sexo = $_POST["sexo"];
	$dia_nasc = $_POST["dia_nasc"];
	$mes_nasc = $_POST["mes_nasc"];
	$ano_nasc = $_POST["ano_nasc"];
	$data_nasc = $dia_nasc."/".$mes_nasc."/".$ano_nasc;
	$pais = $_POST["pais"];
	$estado = $_POST["estado"];
	$cep1 = $_POST["cep1"];
	$cep2 = $_POST["cep2"];
	$cep = $cep1."-".$cep2;
	$sobre = $_POST["sobre"];
	$ip = $_SERVER['REMOTE_ADDR'];
	$id = $listar_user["id"];

	//Verfica se os dados obrigatorios foram preenchidos
	if ($nome == ""){
		$status = "sem_nome";
		$acao = "";
	}
	if($senha == ""){
		$senha = $listar_user["senha"];
	}
	if ($sobrenome == ""){
		$status = "sem_sobrenome";
		$acao = "";
	}
	if ($email == ""){
		$status = "sem_email";
		$acao = "";
	}
	if ($dia_nasc == ""){
		$status = "sem_dia";
		$acao = "";
	}
	if ($mes_nasc == ""){
		$status = "sem_mes";
		$acao = "";
	}
	if ($ano_nasc == ""){
		$status = "sem_ano";
		$acao = "";
	}
	if ($sexo == ""){
		$status = "sem_sexo";
		$acao = "";
	}
	if ($pais == ""){
		$status = "sem_pais";
		$acao = "";
	}
	if ($estado == ""){
		$status = "sem_estado";
		$acao = "";
	}
	if ($cep1 == ""){
		$status = "sem_cep";
		$acao = "";
	}
	if ($cep2 == ""){	
		$status = "sem_cep";
		$acao = "";
	}
	if ($sobre == ""){
		$status = "sem_sobre";
		$acao = "";
	}

	if ($status == ""){
		$foto = isset($_FILES["foto"]) ? $_FILES["foto"] : false;
		if (!$foto || $foto["size"] <= 0){
			$foto_nome = $listar_user["foto"];
		}else{

			if ($status == ""){
				$foto_nome_original = $_FILES["foto"]["name"];
				$tmp = $_FILES["foto"]["tmp_name"];
				$img_type = $_FILES["foto"]["type"];

				$extensao = strrchr($foto_nome_original, ".");
				$foto_nome = $login_usuario."_perfil_".$dia."_".$mes."_".$ano."_".time().$extensao;

				$status_foto = "";
				
				if ($img_type != "image/pjpeg" && $img_type != "image/jpeg" && $img_type != "image/gif" && $img_type != "image/x-png"){
					$status = "formato_in";
					$status_foto = "no";
					$acao = "";
				}else{
					$status_foto = "ok";
				}

				if ($status_foto == "ok"){
					if ($listar_user["foto"] != "sem_foto_pessoal.gif"){
						if (!@unlink($login_usuario."/".$listar_user["foto"])){
							$status = "no_del";
							$acao = "";
						}
					}
					if ($status == "no_del" || $status == ""){
						//copia para o diretorio
						if (!@copy($tmp, $login_usuario."/deleta_".$foto_nome)){
							$status = "no_up";
							$acao = "";
						}else{
							$imagemQs = "deleta_".$foto_nome;
							$imagem = $login_usuario."/".$imagemQs;
							$sImagem  = @file_get_contents($imagem);

							define('MAX_WIDTH', 100);
							define('MAX_HEIGHT', 100);

							//verifica se o thumbnail ja existe
							if(@file_exists($login_usuario."/".$foto_nome)){
								$status = "foto_existe";
								$acao = "";
							}
							if ($status == "no_del" || $status == ""){
								# Carrega a imagem
								$img = null;
								$img = @imagecreatefromstring($sImagem);

								// Se a imagem foi carregada com sucesso, testa o tamanho da mesma
								if ($img) {
									// Pega o tamanho da imagem e proporção de resize
									$width = imagesx($img);
									$height = imagesy($img);
									$scale = min(MAX_WIDTH/$width, MAX_HEIGHT/$height);
								
									// Se a imagem é maior que o permitido, encolhe ela!
									if ($scale < 1) {
										$new_width = floor($scale * $width);
										$new_height = floor($scale * $height);
										// Cria uma imagem temporária
										$tmp_img = imagecreatetruecolor($new_width, $new_height);
										// Copia e resize a imagem velha na nova (trocado imagecopyresized por imagecopyresampled. mais qualidade e menor arquivo)
										imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
										imagedestroy($img);
										$img = $tmp_img;
									}
								}

								// Se não for
								if (!$img) {
									$status = "no_load";
									$acao = "";
								}
								if ($status == "no_del" || $status == ""){
									// Salva a imagem
									if(!@empty($imagemQs) && @file_exists($imagem)){
										@imagejpeg($img,$login_usuario."/".$foto_nome,85);
										@unlink($imagem);
									}
								}
							}
						}
					}
				}
			}
		}
		
		$sql_mail = "SELECT * FROM user WHERE email = '".$email."'";
		$executa_mail = mysqli_query($conexao, $sql_mail) or die (mysqli_error($conexao));
		$contar_mail = mysqli_num_rows($executa_mail);
		  
		if ($contar_mail != "0"){
			if ($listar_user["email"] != $email){
				$status = "email_existe";
			}
		}

		if ($status == "no_del" || $status == "") {
			$sql_edita = "UPDATE `user` SET `foto` = '".$foto_nome."',
											  `ip` = '".$ip."', 
											  `nome` = '".ucwords(strtolower(htmlspecialchars($nome)))."',
											  `sobrenome` = '".ucwords(strtolower(htmlspecialchars($sobrenome)))."',
											  `email` = '".$email."',
											  `senha` = '".$senha."',
											  `sexo` = '".$sexo."',
											  `data_nasc` = '".$data_nasc."',
											  `pais` = '".ucwords(strtolower(htmlspecialchars($pais)))."',
											  `estado` = '".htmlspecialchars($estado)."',
											  `cep` = '".$cep."',
											  `sobre` = '".htmlspecialchars($sobre)."' 
											  WHERE `id` = ".$id.";";
		  
			mysqli_query($conexao, $sql_edita) or die (mysqli_error($conexao));
		
			if($login_type == 0){
				$HTTP_SESSION_VARS["senha_usuario"] = md5($senha);
			}elseif($login_type == 1){
				$_SESSION["senha_usuario"] = md5($senha);
			}else{
				setcookie("senha_usuario", md5($senha));
			}

	  		$status = $status."edita_ok";
        	$acao = "";
     	}
	}
}

$sql_user = "SELECT * FROM user WHERE username = '".$login_usuario."'";
$executa_user = mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));
$listar_user = mysqli_fetch_assoc($executa_user);


$data_nasc = explode("/", $listar_user["data_nasc"]);
$cep = explode("-", $listar_user["cep"]);

?><html>
<head>
<title><? echo $titulo ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
<LINK REL="SHORTCUT ICON" HREF="<? echo $end_objetos; ?>arquivos/images/icon.gif">
</head>

<body topmargin="0" leftmargin="0">
<? include "topo.php"; ?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="138" valign="top"> 
      <? include "menu.php"; ?>
    </td>
    <td width="614" colspan="4" align="center" valign="top"> 
	<table width="550" border="0" cellpadding="0" cellspacing="0">
        <tr align="center"> 
          <td class="titulo">&nbsp;</td>
        </tr>
        <tr> 
          <td height="30" class="titulo" align="center" background="<? echo $end_objetos; ?>arquivos/images/barra_adm.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="1%">&nbsp;</td>
                <td width="68%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="center" valign="middle" class="titulo"><font color="#000000">Administra&ccedil;&atilde;o 
                        do <? echo $nome_site; ?></font>: <font color="#0000FF"><a title="<? echo $pagina_nome; ?>" href="perfil.php?nome=<? echo $login_usuario; ?>"><font color="#0000FF"><? echo $pagina_nome; ?></font></a></font></td>
                    </tr>
                  </table></td>
                <td width="31%" align="center" valign="middle" class="texto_gran"><font color="#FFFFFF"><? echo $listar_user["nome"]; ?></font></td>
              </tr>
            </table></td>
        </tr>
        <tr align="center"> 
          <td> 
            <? include "menu_adm.php"; ?>
          </td>
        </tr>
        <tr> 
          <td height="25" class="texto_gran">Preencha abaixo as informa&ccedil;&otilde;es 
            de seu perfil: </td>
        </tr>
        <? if ($status != ""){ ?>
        <tr> 
          <td class="td" align="center"><?
		  switch($status){
		  
		  case "edita_ok":
		       echo "Dados editados com sucesso!";
			   break;
		  case "sem_nome":
		       echo "Preencha seu nome!";
			   break;
		  case "sem_sobrenome":
		       echo "Preencha seu sobrenome!";
			   break;
          case "sem_email":
		       echo "Preencha seu email!";
			   break;			   
	      case "sem_dia":
		       echo "Escolha o dia de seu aniversário!";
			   break;
		  case "sem_mes":
		       echo "Escolha o mês de seu aniversário!";
			   break;
		  case "sem_ano":
		       echo "Escolha o ano de seu aniversário!";
			   break;
		  case "sem_pais":
		       echo "Preencha seu País!";
			   break;
		  case "sem_estado":
		       echo "Preencha seu estado!";
			   break;
		  case "sem_cep":
		       echo "Preencha seu Cep corretamente!";
			   break;
		  case "sem_sobre":
		       echo "Preencha o campo Sobre mim!";
			   break;
		  case "formato_in":
		       echo "O formato da imagem é inválido!";
			   break;	   
		  case "no_del":
		       echo "Não foi possível deletar a foto antiga!";
			   break;
		  case "no_up":
		       echo "Não foi possível fazer o upload da foto!";
			   break;	   
		  case "foto_existe":
		       echo "Ocorreu um pequeno erro, tente novamente!";
			   break;
		  case "no_load":
		       echo "Não foi possível carregar a foto!";
			   break;
		  case "email_existe":
		       echo "O email escolhido já está sendo usado por outra pessoa!";
			   break;
		  case "no_deledita_ok":
		       echo "Dados editados com sucesso, a foto antiga não pode ser apagada!";
			   break;	   
			  	   
			   	   
		  } ?></td>
        </tr>
        <? } ?>
		 <tr class="texto_gran"> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td align="right" class="texto"><form action="adm_perfil.php?acao=editar" method="post" enctype="multipart/form-data" name="cadastro" onSubmit="return valida_cadastro('edita');">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="28%" height="25" align="right" bgcolor="#99CC99" class="texto">Trocar 
                    Foto:</td>
                  <td width="72%" bgcolor="#99CC99" class="texto"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="65%"> <input name="foto" type="file" class="form" id="foto" size="30"> 
                        </td>
                        <td width="6%" align="center"><img src="<? echo $end_objetos; ?>arquivos/images/ver_foto_atual.gif" width="16" height="16"></td>
                        <td width="29%" class="texto"> <a href="javascript:abre('ver_foto.php?foto=<?
					if ($listar_user["foto"] == "sem_foto_pessoal.gif"){
					echo $end_objetos."arquivos/images/".$listar_user["foto"];
					}
					else{				
					 echo $listar_user["username"]."/".$listar_user["foto"]; } ?>', '<? echo $listar_user["username"]; ?>', 'width=150, height=150');" title="Ver foto atual"><font color="#0000FF">Ver 
                          atual</font></a></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td align="right" bgcolor="#99CC99" class="texto">&nbsp;</td>
                  <td valign="top" bgcolor="#99CC99" class="texto">Tamanho m&aacute;ximo 
                    permitido: 2MB</td>
                </tr>
                <tr class="texto"> 
                  <td align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Nome:</td>
                  <td><input name="nome_cadastro" type="text" class="form" id="nome_cadastro" size="40" maxlength="30" value="<? echo $listar_user["nome"]; ?>"></td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Sobrenome: </td>
                  <td> <input name="sobrenome" type="text" class="form" id="sobrenome" size="40" maxlength="30" value="<? echo $listar_user["sobrenome"]; ?>"></td>
                </tr>
				 <tr class="texto"> 
                  <td align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr bgcolor="#99CC99"> 
                  <td height="25" align="right" class="texto">Nova Senha:</td>
                  <td class="texto"> 
                    <input name="senha" type="password" class="form" id="senha" size="30" maxlength="30">
                    *Opcional</td>
                </tr>
				 <tr class="texto"> 
                  <td align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
			    <tr> 
                  <td height="25" align="right" class="texto">E-mail:</td>
                  <td><input name="email" type="text" class="form" id="email" size="50" maxlength="50" value="<? echo $listar_user["email"]; ?>"></td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Sexo: </td>
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
                    </SELECT></td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Data de nascimento:</td>
                  <td class="texto"> <SELECT class="form" tabIndex="47" name="dia_nasc">
                  <OPTION value="">dia</OPTION>
                  <? $i = "1";
					while($i <= "31"){
			  			$dia = $i++;
			  			if($data_nasc[0] == $dia){
							$opcao_dia = "selected"; 
						}else{
							$opcao_dia = "";
						} 
			  			echo "<OPTION ".$opcao_dia." value=\"".$dia."\">".$dia."</OPTION>";
			  		}
			  ?>
                    </SELECT>
                    / 
                    <SELECT class="form" tabIndex="48" name="mes_nasc">
                      <OPTION value="">mês</OPTION>
                 
			<?	foreach($w_meses as $num_mes => $des_mes){
					if($data_nasc["1"] == $num_mes){
						$escreve_selected = " selected";
					}else{
						$escreve_selected = "";
					}
                	echo "<OPTION value=\"".$num_mes."\"".$escreve_selected.">".$des_mes."</OPTION>\n";
				} ?>
					 
				  </SELECT>
                    / 
                    <SELECT class="form" tabIndex="49" name="ano_nasc">
                      <OPTION value="">ano</OPTION>
                      <?	while($min_ano_permitido <= $max_ano_permitido){
			  					$ano = $min_ano_permitido++;
              					if ($data_nasc[2] == $ano){
									$opcao_ano = "selected";
								}else{
									$opcao_ano = "";
								} 
			  					echo "<OPTION ".$opcao_ano." value=\"".$ano."\">".$ano."</OPTION>";
			  				}
			  ?>
                    </SELECT> </td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Pa&iacute;s:</td>
                  <td> <input name="pais" type="text" class="form" id="pais" size="30" maxlength="50" value="<? echo $listar_user["pais"]; ?>"></td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Estado:</td>
                  <td><input name="estado" type="text" class="form" id="estado" size="3" maxlength="3" value="<? echo $listar_user["estado"]; ?>"></td>
                </tr>
                <tr> 
                  <td height="25" align="right" class="texto">Cep: </td>
                  <td class="texto"> <INPUT name="cep1" class="form" onKeyUp="pula(this,'cep2', 5);" size="10" maxLength="5" value="<? echo $cep["0"]; ?>">
                    - 
                    <INPUT name="cep2" class="form" size="2" maxLength="3" value="<? echo $cep["1"]; ?>"> 
                    <a href="javascript:abre('busca_cep.php', 'buscar_cep', 'width=360, height=390')" title="Consultar cep"> 
                    <B>» Consultar CEP</B></a></td>
                </tr>
                <tr> 
                  <td align="right" valign="top" class="texto">Sobre mim:</td>
                  <td><textarea name="sobre" cols="50" rows="5" class="form" id="sobre"><? echo $listar_user["sobre"]; ?></textarea></td>
                </tr>
                <tr> 
                  <td align="right" class="texto">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr align="center"> 
                  <td height="25" colspan="2" class="texto"><input name="envia" type="image" src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Alterar" width="89" height="29" border="0"> 
                    &nbsp; <a href="usuarios.php?nome=<? echo $login_usuario; ?>"><img src="<? echo $end_objetos; ?>arquivos/images/ver_fotos.gif" alt="Ver minha p&aacute;gina de fotos" width="89" height="29" border="0"></a></td>
                </tr>
              </table>
            </form></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="5"> 
      <? include "rodape.php" ?>
    </td>
  </tr>
</table>
</body>
</html>
