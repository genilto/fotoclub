<? include "conexao.php";
$sql_noticias = "SELECT * FROM noticias WHERE user = \"".$nome."\" ORDER BY id DESC LIMIT 5;";
$executa_noticias = mysqli_query($conexao, $sql_noticias) or die (mysqli_error($conexao));
$contar_noticias = mysqli_num_rows($executa_noticias);
?>

















lefttime=setInterval('scrollmarquee()',3500);

  document.write('<div id="painelexterno" style="position:relative;width:270px;height:120px;overflow:hidden; border: 0px solid #000000; background-color: #ffffff; text-align: left" >'); 
  document.write('<div id="sc" style="padding: 4px">');
  document.write('</div></div>');
  document.write('<link rel="stylesheet" type="text/css" href="gera_css.php">');






