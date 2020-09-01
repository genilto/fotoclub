<? include "valida.php"; 
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$mens = isset($_POST["mens"]) ? $_POST["mens"] : "";
$acao = "";
$status = "";
$mens_padrao = "";

if ($id != ""){

	$sql = "SELECT * FROM user WHERE id = '".$id."'";
	$exe = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
	$contar = mysqli_num_rows($exe);
	$listar = mysqli_fetch_assoc($exe);
	
	$mens_padrao = "<table width='500' border='0' cellspacing='0' cellpadding='0'><tr><td width='25%' valign='top'><a href='http://".$url_site."'><img src='http://".$servidor_site."/arquivos/images/fotoclubelogo.gif' width='249' height='166' border='0'></a></td><td width='75%'><p><b><font color='#FF0000' size='2' face='Verdana, Arial, Helvetica, sans-serif'>:: FotoClube!<br></font></b><font size='2' face='Arial, Helvetica, sans-serif'><br><strong>Caro amigo ".$listar["nome"]." ".$listar["sobrenome"].",</strong> <br>        //            coloque aqui o titulo da mensagem        //             </td></tr><tr align='center'><td height='150' colspan='2'><p><font color='#000000' size='2' face='Verdana, Arial, Helvetica, sans-serif'>          //                  coloque o conteúdo da mensagem aqui               //           </font></p></td></tr></table>";
	
	if ($acao == "enviar"){
		if ($mens == ""){
			$status = "Preencha sua mensagem!";
			$acao = "";
		}else{
  
			if (!@mail($listar["email"], $nome_site.": Info", stripcslashes($mens), $headers)){
				$status = "O e-mail não pode ser enviado. Verifique!";
				$acao = "";
			}else{
				$status = "O email foi enviado com sucesso!";
				$acao = "";
			}
		}
	}
}

?>
<html>
<head>
<title><? echo $titulo_adm; ?></title>
<script language="JavaScript" src="<? echo $end_objetos_adm; ?>script.js"></script>
<script language="JavaScript" type="text/javascript">
function padrao(){
	
	var conteudo = "<? echo $mens_padrao; ?>";
	
	if(GetObject("padrao").checked == true){
		if(document.contato.mens.value != ""){
			if(confirm("Deseja abandonar o conteúdo digitado?")){
				document.contato.mens.value = conteudo;
			}else{
				GetObject("padrao").checked = false;
			}
		}else{
			document.contato.mens.value = conteudo;
		}
	}else{
		if(document.contato.mens.value != conteudo){
			if(confirm("Deseja abandonar as modificações?")){
				document.contato.mens.value = "";
			}else{
				GetObject("padrao").checked = true;
			}
		}else{
			document.contato.mens.value = "";
		}
	}
}
</script>
<link href="<? echo $end_objetos_adm; ?>padrao.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#EEEEEE">
<? 
if ($id != ""){ 
	if ($acao == ""){ ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top" class="form"> <form name="contato" method="post" action="contato.php?acao=enviar&id=<? echo $id; ?>" onSubmit="javascript:disable(this);">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr align="center"> 
            <td class="titulo">Contato com <? echo $listar["nome"]." ".$listar["sobrenome"]; ?></td>
          </tr>
          <tr> 
            <td height="10"></td>
          </tr>
          <tr> 
            <td class="titulo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="85%" class="titulo">Digite a mensagem em html que 
                    ser&aacute; enviada: </td>
                  <td width="4%" align="right"> <input name="padrao" id="padrao" type="checkbox" onClick="chama_funcao('padrao()');" value=""> 
                  </td>
                  <td width="11%" class="texto_gran">Padr&atilde;o</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td align="center" class="texto"><font color="#FF0000"><? echo $status; ?>&nbsp;</font></td>
          </tr>
          <tr align="center"> 
            <td> <textarea name="mens" cols="40" rows="10" id="mens"><? echo $mens; ?></textarea> 
            </td>
          </tr>
          <tr align="center" valign="bottom"> 
            <td height="25"><input name="sendBtn" type="submit" class="form" id="sendBtn" value="Enviar"> 
              <input name="Submit2" type="button" class="form" value="Cancelar" onClick="javascript:window.close();"></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
<? }
 }else{ ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top" class="form"><? echo $mens_padrao; ?></td>
  </tr>
</table>
<? } ?>
</body>
</html>
