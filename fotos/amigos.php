<? include "ver_login.php";
	$nome = $_GET["nome"];
	include "contador.php"; 
	$local_pagina = "perfil";

	if ($nome == ""){
		echo "<script>window.location=\"erro.php?erro=no_user\"</script>";
	}else{

		$sql_user = "SELECT * FROM user WHERE username = \"".$nome."\"";
		$executa_user = mysqli_query($conexao, $sql_user) or die (mysqli_error($conexao));
		$listar_user = mysqli_fetch_assoc($executa_user);
		$contar_user = mysqli_num_rows($executa_user);

		if ($contar_user == "0"){
			echo "<script>window.location=\"erro.php?erro=no_user&nome=".$nome."\"</script>";
		}

		$sql_conf = "SELECT * FROM config WHERE user = \"".$nome."\"";
		$executa_conf = mysqli_query($conexao, $sql_conf) or die (mysqli_error($conexao));
		$listar_conf = mysqli_fetch_assoc($executa_conf);

		$cor_lados = $listar_conf["cor_lados"];
		$cor_meio = $listar_conf["cor_meio"];
		$cor_tit = $listar_conf["cor_tit"];
		$fonte_tit = $listar_conf["fonte_tit"];
		$cor_links = $listar_conf["cor_links"];
		$cor_comentario = $listar_conf["cor_comentario"];
		$foto_pessoal = $listar_user["foto"];
		$titulo_conf = $listar_conf["titulo"];

		$sql_links = "SELECT * FROM links WHERE user = \"".$nome."\" ORDER BY id DESC";
		$executa_links = mysqli_query($conexao, $sql_links) or die (mysqli_error($conexao));
		$contar_links = mysqli_num_rows($executa_links);
	}
?><html>
<head>
<title><? echo $titulo_conf; ?></title>
<link href="padrao.css" rel="stylesheet" type="text/css">
<script src="script.js"></script>
<? echo "
<style type=\"text/css\">
<!--
.img {
	border: thin solid ".$cor_comentario.";
}
-->
</style>";
?>
</head>

<body bgcolor="<? echo $fundo ?>" topmargin="0" leftmargin="0">
<? include "topo_usuarios.php"; ?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="750" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<? echo $cor_lados; ?>">
        <tr> 
          <td><img src="<? echo $end_objetos; ?>arquivos/images/usuarios_03.gif" width="150" height="20"></td>
          <td width="450" bgcolor="#1B8D08"><? include "menu_cima_fotos.php"; ?></td>
          <td><img src="<? echo $end_objetos; ?>arquivos/images/usuarios_05.gif" width="150" height="20"></td>
        </tr>
        <tr> 
          <td width="150" valign="top"><? include "menu_esq_fotos.php"; ?></td>
          <td height="500" valign="top" bgcolor="<? echo $cor_meio; ?>"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td align="center"><font size="2" color="<? echo $cor_tit; ?>" face="<? echo $fonte_tit; ?>"><strong>Amigos 
                  de <? echo $listar_user["nome"]." ".$listar_user["sobrenome"]; ?></strong></font></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td class="texto_gran"> 
                  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="right" class="texto_gran">&nbsp;&nbsp;<font color="<? echo $cor_comentario; ?>">Página: 
                        <? if ($pagina == ""){ echo "1"; }else{ echo $pagina; } ?>
                        </font></td>
  </tr>
</table>
                </td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td> 
                  <? 
        $TAMANHO_PAGINA = 9;

        $pagina = $_GET["pagina"];
        if (!$pagina) {
           $inicio = 0;
           $pagina=1;
        }
        else {
           $inicio = ($pagina - 1) * $TAMANHO_PAGINA;
        }
        
        $ssql = "SELECT * FROM amigos WHERE user = '".$nome."'";
        $rs = mysqli_query($conexao, $ssql) or die (mysqli_error($conexao));
        $num_total_registros = mysqli_num_rows($rs);
        $total_paginas = ceil($num_total_registros / $TAMANHO_PAGINA); 

        $sql_list = "
            SELECT * FROM amigos WHERE user = '".$nome."' ORDER BY id DESC LIMIT ".$inicio.",".$TAMANHO_PAGINA."";
        $res_list = mysqli_query($conexao, $sql_list) or die (mysqli_error($conexao));
        $numero_registros = mysqli_num_rows($res_list);
        
        $coluna = 0;  // coluna atual. Só podem existir 3 colunas 
        $total_registros = 0;
        ?>
                  <table width="100%" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <?
        while(($reg = mysqli_fetch_array($res_list))){
		      $sql_ver_amigo = "SELECT * FROM user WHERE username = '".$reg["amigo"]."'";
			  $exe_ver_amigo = mysqli_query($conexao, $sql_ver_amigo) or die (mysqli_error($conexao));
			  $listar_ver_amigo = mysqli_fetch_assoc($exe_ver_amigo);
			  
            $total_registros++;
?>
                      <td align="center" valign="bottom" class="texto"><?
					  	if($link_usuario == 0){
							$des_link_amigo_usuario_pagina = $listar_ver_amigo["username"].".".$dominio;
						}else{
							$des_link_amigo_usuario_pagina = $url_site."/".$listar_ver_amigo["username"];
						} ?>
						<a href="usuarios.php?nome=<? echo $listar_ver_amigo["username"]; ?>" title="http://<? 
						 echo $des_link_amigo_usuario_pagina; ?>"> 
						<?
                        if ($listar_ver_amigo["foto"] == "sem_foto_pessoal.gif"){ 
					       echo "<img src=\"".$end_objetos."arquivos/images/".$listar_ver_amigo["foto"]."\" border=\"0\">"; 
						}else{ ?>
						 <img src="<? echo $listar_ver_amigo["username"]."/".$listar_ver_amigo["foto"]; ?>" border="0"> 
                        <? } ?>
                        </a>
						<br>
						<a href="usuarios.php?nome=<? echo $listar_ver_amigo["username"]; ?>" title="http://<? 
						 echo $des_link_amigo_usuario_pagina; ?>"> 
							<font color="<? echo $cor_comentario; ?>"><? echo $listar_ver_amigo["username"]; ?></font> </a>
                        <br>
                        <br>
						<br>
						<br>
						</td>
                      <?
                 $coluna++;

            if($coluna == 3){
                echo "</tr><tr>";
                $coluna = 0;
            }

            if($numero_registros == $total_registros){

                if ($total_paginas > 1){
                   for ($i=1;$i<=$total_paginas;$i++){
                    if ($pagina == $i)
                       $links = $links."<option selected>".$pagina."</option>";
                      else{ 
     $links = $links."<option value=\"".$_SERVER['PHP_SELF']."?pagina=".$i."&nome=".$nome."\">".$i."</option>"; 
      
			        }
				  }
                } 

            }
        }
        
  ?>
                    </tr>
                  </table>
                  <table width="100%" align="center" cellpadding="0" cellspacing="0">
                    <tr class="texto"> 
                      <td bgcolor="<? echo $cor_lados; ?>"></td>
                    </tr>
                    <tr> 
                      <td align="center" class="titulo"><? if ($links != ""){ ?>
					  <font color="<? echo $cor_comentario; ?>">Páginas:</font> <select name="paginas" class="form" onChange="MM_jumpMenu('parent',this,1)">
                                      <? echo $links; ?> </select>
					  <? } ?> 
                        </td>
                    </tr>
                    <tr> 
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="34%" align="right" class="texto_gran"><font color="<? echo $cor_comentario; ?>">Total: 
                              <? echo $num_total_registros; ?> amigo(s).</font></td>
                          </tr>
                        </table></td>
                    </tr>
                    <?
		if ($num_total_registros == 0){
		?>
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td align="center" class="titulo">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td align="center" class="titulo"><font color="<? echo $cor_comentario; ?>">Nenhum amigo foi encontrado!</font></td>
                    </tr>
                    <tr> 
                      <? }
?>
                  </table></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
            </table></td>
          <td width="150" valign="top"><? include "menu_dir_fotos.php"; ?></td>
        </tr>
        <tr> 
          <td><img src="<? echo $end_objetos; ?>arquivos/images/bordas3.gif" width="150" height="20"></td>
          <td bgcolor="#1B8D08" class="texto" align="center"><? echo $rodape_site; ?></td>
          <td><img src="<? echo $end_objetos; ?>arquivos/images/bordas4.gif" width="150" height="20"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
