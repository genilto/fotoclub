<? include "valida.php"; ?>
<html>
<head>
<title><? echo $titulo_adm; ?></title>
<script src="<? echo $end_objetos_adm; ?>script.js"></script>
<link href="<? echo $end_objetos_adm; ?>padrao.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#EEEEEE">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" class="form"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td colspan="3" class="texto"> 
            <b>Usuário:</b>
			<br>
		<? 
				echo "login sessao 1: ".$_SESSION["login_usuario"]."<br>";
				echo "senha sessao 1: ".$_SESSION["senha_usuario"]."<br>";
				echo "login sessao 2: ".$_SESSION["login_usuario"]."<br>";
				echo "senha sessao 2: ".$_SESSION["senha_usuario"]."<br>";
				echo "login cookie 1: ".$_COOKIE["login_usuario"]."<br>";
				echo "senha cookie 1: ".$_COOKIE["senha_usuario"]."<br>";
				echo "login cookie 2: ".$_COOKIE["login_usuario"]."<br>";
				echo "senha cookie 2: ".$_COOKIE["senha_usuario"]."<br>";


		  ?><br><br>
		  <b>Administrador:</b>
		  <br>
		  <?
				echo "Senha normal: ".$listar["senha"]."<br>";
				echo "Senha md5 :".md5($listar["senha"])."<br>";
				echo "login sessao 1: ".$_SESSION["login_administrador"]."<br>";
				echo "senha sessao 1: ".$_SESSION["senha_administrador"]."<br>";
				echo "login sessao 2: ".$_SESSION["login_administrador"]."<br>";
				echo "senha sessao 2: ".$_SESSION["senha_administrador"]."<br>";
				echo "login cookie 1: ".$_COOKIE["login_administrador"]."<br>";
				echo "senha cookie 1: ".$_COOKIE["senha_administrador"]."<br>";
				echo "login cookie 2: ".$_COOKIE["login_administrador"]."<br>";
				echo "senha cookie 2: ".$_COOKIE["senha_administrador"]."<br>";

?>
		  
          </td>
        </tr>
        <tr> 
          <td width="30%" align="right">&nbsp;</td>
          <td width="38%">&nbsp;</td>
          <td width="32%">&nbsp;</td>
        </tr>
        <tr align="center"> 
          <td colspan="3"><a href="javascript:window.close();"><img src="<? echo $end_objetos; ?>arquivos/images/botao_sair.gif" alt="Fecha a janela" width="89" height="29" border="0"></a></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
