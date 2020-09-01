<? include "ver_login.php";
   //Resgata informações do formulario
   $username = $_POST["username"];
   //Verifica se tem informação que o formulario foi submetido
   $status = $_GET["status"];
 ?>
<html>
<head>
<title><? echo $titulo ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
</head>
<body topmargin="0" leftmargin="0" <? if ($username == ""){ echo "onLoad=\"document.esq_senha.username.focus();\""; }?>>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center"> 
    <td colspan="3"><img src="<? echo $end_objetos; ?>arquivos/images/esq_senha.gif" width="400" height="23"></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center"> 
    <td colspan="3">
	<?
	//se não tem username mostra formulario
	 if ($username == ""){
	?>
	<form name="esq_senha" method="post" action="esqueceu_senha.php?status=enviado">
        <table width="95%" border="0" cellspacing="0" cellpadding="0">
          <?
		  //se nao tiver username mostra a mensagem 
		  if ($status != ""){
		  ?>
		   <tr> 
            <td colspan="2" class="td" align="center"><? if ($status == "enviado"){ echo "Por favor digite seu Username"; } else { echo "Usuário não encontrado"; } ?></td>
          </tr>
		  <tr> 
            <td colspan="2" class="texto">&nbsp;</td>
          </tr>
		  <? } ?>
		  <tr> 
            <td colspan="2" class="texto">Se voc&ecirc; realmente esqueceu sua 
              senha, n&oacute;s poderemos envi&aacute;-la para seu e-mail que 
              est&aacute; cadastrado conosco, para isso basta informar seu username 
              no campo abaixo.</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td align="right" class="texto">Username:</td>
            <td><input name="username" type="text" class="form" size="30" maxlength="15"></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="imageField" type="image" src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Enviar" width="89" height="29" border="0">
              <a href="javascript:window.close();"><img src="<? echo $end_objetos; ?>arquivos/images/cancelar.gif" alt="Fechar" width="89" height="29" border="0"></a> 
            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form>
	  <? }
	 else{
	 //executa uma busca na tabela 
	 $sql = "SELECT * FROM user WHERE username = \"".$username."\";";
	 $executa = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
	 $listar = mysqli_fetch_assoc($executa);
	 $contar = mysqli_num_rows($executa);
	 
	 $senha_user = $listar["senha"];
	 $user_name = $listar["username"];
	 $nome = $listar["nome"];
	 $sobrenome = $listar["sobrenome"];
	 $email = $listar["email"];
	 
	//se não tiver ninguem cadastrado mostra a mensagem
	if ($contar == 0){
	 echo "<script>window.location=\"esqueceu_senha.php?status=sem_user\"</script>";
	 }
	 else{
	 $erros = "";
	 $mens = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr> 
    <td width=\"26%\" valign=\"top\"><a href=\"http://".$url_site."\" target=\"_blank\" title=\"http://".$url_site."\"><img src=\"http://".$servidor_site."/arquivos/images/fotoclubelogo.gif\" width=\"249\" height=\"166\" border=\"0\"></a></td>
    <td width=\"74%\">
	 <font face=\"Verdana\" color=\"#009900\" size=\"2\">
	          <b>:: Envio de Senha</b>
	        </font>
	     <br><br>
                 <b>".$nome." ".$sobrenome.":</b>
				 <br>
				 <font face=\"arial\" size=\"2\">Você requisitou sua senha no site </font><a href=\"http://".$url_site."\" target=\"_blank\"><font face=\"arial\" size=\"2\" color=\"#0000ff\">http://".$url_site."</font></a>,<br><font face=\"arial\" size=\"2\"> e a seu pedido nós enviamos ela pra você:</font><br><br>		 
  <font size=\"2\" face=\"Arial\" color=\"#FF0000\"><b>Username:</b></font> <font size=\"2\" face=\"Arial\" color=\"#000000\">".$user_name."</font><br>
  <font size=\"2\" face=\"Arial\" color=\"#FF0000\"><b>Senha:</b></font> <font size=\"2\" face=\"Arial\" color=\"#000000\">".$senha_user."</font><br>
  <br>
  <a href=\"http://".$url_site."/login.php\" target=\"_blank\"><font size=\"2\" face=\"arial\" color=\"0000FF\"><img src=\"http://".$servidor_site."/arquivos/images/login.gif\" border=\"0\" alt=\"Login no site\"></font><br><br></a>
	</td>
  </tr>
</table>";
	 
 $headers = "MIME-Version: 1.0\r\n";
 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
 $headers .= "From: ".$nome_site."<".$mailto."> \r\n";
 
  if (!@mail($email, $nome_site.": Envio de senha", "$mens", $headers)){
  $erros = "> O E-mail não pode ser enviado.";
  }
 }
 ?>
      <table width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
          <td class="titulo">Confirma&ccedil;&atilde;o de envio:</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td align="center" class="texto"><? if ($erros == ""){
		  echo "<b>Sucesso!</b><br>
		  Um e-mail com sua senha foi enviado para você <b>".$nome." ".$sobrenome."</b> pelo email: <b>".$email."</b>";
		  }
		  else{
		  echo "<b>Os seguintes erros ocorreram:</b><br>".$erros;
		  }		  
		  ?></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td align="center"><a href="javascript:window.close();"><img src="<? echo $end_objetos; ?>arquivos/images/botao_ok.gif" alt="Fecha janela" width="89" height="29" border="0"></a><? if ($erros != ""){ ?> <a href="esqueceu_senha.php"><img src="<? echo $end_objetos; ?>arquivos/images/insistir.gif" alt="Tentar de novo" width="89" height="29" border="0"></a><? } ?> 
          </td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
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
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
