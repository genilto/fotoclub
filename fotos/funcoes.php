<?
#################################################################
#      Programador: Genilto Vanzin                              #
#      Data.......: 07/03/2006                                  #
#      Objetivo...: Este arquivo auxilia na manipulação de      #
#                   arquivos, como fazer upload, redimencionar  #
#					imagens, deletar arquivos e outros.         #
#################################################################

//Arrays em php
/*
$testando = array(1 => "teste1"
                 ,2 => "teste2"
			     ,3 => "teste3"
			     ,4 => "teste4"
			     ,5 => "teste5");
			  
foreach($testando as $posicao => $conteudo){
  echo $posicao." = ".$conteudo."<br>";
}  */

function inicia_sessao_js($valor){
	setcookie("exibir_js", $valor);
}

function cria_nome($foto_nome_original, $pre_nome){
  //Pega extensao da foto
  $extensao = strrchr($foto_nome_original, ".");
  //gera novo nome
  $foto_nome = $pre_nome."_".time().$extensao;
  //retorna o nome da foto
  return $foto_nome;
}

function delete($file){
  //verifica se o arquivo existe
  if (file_exists($file)){
    //verifica se é possivel remover, se for remove
	if(unlink($file)){
      //retorna mensagem de ok
	  return "ok";
    }else{
	  //se nãoi for retorna mensagem de erro
	  return "Não foi possível excluir o arquivo!";
	}
  }else{
    //se o arquivo não existir retorna a mensagem
    return "O arquivo não existia no servidor!";
  }
}

function deleta_dir($file){
  //verifica se arquivo é um diretorio
  if(is_dir($file)){
    //se for abre o diretorio
	$handle = opendir($file);
	//estrutura de repetição que le todos os arquivos 
    while($filename = readdir($handle)){
      //chama novamente a função com o nome do arquivo interno
	  if($filename != "." && $filename != ".."){
        deleta_dir($file."/".$filename); 
      }
    }
	//fecha o diretorio
    closedir($handle);
    if (@rmdir($file)){
      $retorno = "ok";
    }else{
      $retorno = "nao";
    }
  }else{
    if (@unlink($file)){
      $retorno = "ok";
    }else{
      $retorno = "nao";
    }
  }
 return $retorno;
}

function grava_foto($foto, $nome, $pasta, $largura, $altura){//1
  $tmp = $foto["tmp_name"];
  $img_type = $foto["type"]; 
  //verifica se formato da imagem é valido
  if ($img_type != "image/pjpeg" && $img_type != "image/jpeg" && $img_type != "image/gif" && $img_type != "image/x-png"){
    return "Formato de arquivo inv&aacute;lido.";
  //se for
  }else{
    //verifica se a imagem com o del_ ja existe
	if(file_exists($pasta."/del_".$nome)){
      return "Ocorreu um pequeno erro, tente novamente.";
    //se não existir
	}else{
      //e se nao for possivel copiar para o diretorio
      if (!copy($tmp, $pasta."/del_".$nome)){
        return "Não foi possivel fazer o upload da imagem."; 
      //se copiou     
	  }else{
        $imagem = $pasta."/del_".$nome;
        $sImagem  = file_get_contents($imagem);
		//verifica se a imagem a ser gravada ja existe
	    if(file_exists($pasta."/".$nome)){
          return "Ocorreu um pequeno erro, tente novamente.";
	  	  unlink($pasta."/"."del_".$nome);
        //se não existir
		}else{
          //Carrega a imagem
          $img = null;
          $img = imagecreatefromstring($sImagem);
          // Se a imagem foi carregada com sucesso, testa o tamanho da mesma
          if ($img) {
            // Pega o tamanho da imagem e proporção de resize
            $width  = imagesx($img);
            $height = imagesy($img);
            $scale  = min($largura/$width, $altura/$height);

            // Se a imagem é maior que o permitido, encolhe ela!
            if ($scale < 1) {
              $new_width = floor($scale * $width);
              $new_height = floor($scale * $height);
			  // Cria uma imagem temporária
              $tmp_img = imagecreatetruecolor($new_width, $new_height);
              // Copia e resize a imagem velha na nova
              imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
              //destroi a imagem antiga
			  imagedestroy($img);
              //joga a nova na variavel
			  $img = $tmp_img;
            }
          }
		  //verfifica se há uma nova imagem
          if(!$img){
		    //se não existir deleta a imagem e retorna a msg de erro
			unlink($pasta."/"."del_".$nome);
            return "Não foi possivel carregar a imagem."; 		    
          }else{
            //verifica se foi possivel criar a nova imagem
			if(!imagejpeg($img,$pasta."/".$nome,85)){
			  //se não foi, deleta a que foi copiada eretorna o erro
			  unlink($pasta."/"."del_".$nome);
			  return "Não foi possivel criar a nova imagem.";
			}else{
			  //e se foi deleta a que foi copiada e retorna ok.
			  unlink($pasta."/"."del_".$nome);
			  return "ok";
			}
          }
        }
      }
    }
  }
  unlink($pasta."/"."del_".$nome);
}

function total_dias_mes($mes,$ano){
    if( $mes == "01" ){
      $qt_dias = 31;
    }
    // have to handle leap year
    if($mes == "02" && $ano % 4 == 0 && ($ano % 100 != 0 || $ano % 1000 == 0)){
      $qt_dias = 29;
    }elseif($mes == "02"){
      $qt_dias = 28;
    }
    if($mes == "03"){
      $qt_dias = 31;
    }
    if($mes == "04"){
      $qt_dias = 30;
    }
    if($mes == "05"){
      $qt_dias = 31;
    }
    if($mes == "06"){
      $qt_dias = 30;
    }
    if($mes == "07"){
      $qt_dias = 31;
    }
    if($mes == "08"){
      $qt_dias = 31;
    }
    if($mes == "09"){
      $qt_dias = 30;
    }
    if($mes == "10"){
      $qt_dias = 31;
    }
    if($mes == "11"){
      $qt_dias = 30;
    }
    if($mes == "12"){
      $qt_dias = 31;
    }
    return $qt_dias;
  }

function par_impar($num){
  if ($num % 2 == 0){
    echo "É par!";
  }else{
    echo "É impar!";
  }
}

function mes_extenso($mes){
  switch($mes){
    case 1:
	  $mes = "janeiro";
	  break;
	case 2:
	  $mes = "fevereiro";
	  break;
	case 3:
	  $mes = "março";
	  break;
	case 4:
	  $mes = "abril";
	  break;
	case 5:
	  $mes = "maio";
	  break;
	case 6:
	  $mes = "junho";
	  break;
	case 7:
	  $mes = "julho";
	  break;
	case 8:
	  $mes = "agosto";
	  break;
	case 9:
	  $mes = "setembro";
	  break;
	case 10:
	  $mes = "outubro";
	  break;
	case 11:
	  $mes = "novembro";
	  break;
	case 12:
	  $mes = "dezembro";
	  break;
  }
  return $mes;
}

function troca_cor($cor1, $cor2, $cor_atual){
  if($cor_atual == $cor1){
    return $cor2;
  }else{
    return $cor1;
  }
}

function sem_acentos($str){ 
	$str = str_replace("ç","c",$str); 
	$str = str_replace("Ç","C",$str); 
	$str = str_replace("ã","a",$str); 
	$str = str_replace("õ","o",$str); 
	$str = str_replace("Ã","A",$str); 
	$str = str_replace("Õ","O",$str); 
	$str = str_replace(" ","",$str); 
	$str = str_replace("á","a",$str); 
	$str = str_replace("é","e",$str); 
	$str = str_replace("í","i",$str); 
	$str = str_replace("ó","o",$str); 
	$str = str_replace("ú","u",$str); 
	$str = str_replace("Á","A",$str); 
	$str = str_replace("É","E",$str); 
	$str = str_replace("Í","I",$str); 
	$str = str_replace("Ó","O",$str); 
	$str = str_replace("Ú","U",$str); 
	$str = str_replace("â","a",$str); 
	$str = str_replace("ê","e",$str); 
	$str = str_replace("ô","o",$str); 
	$str = str_replace("û","u",$str); 
	$str = str_replace("Â","A",$str); 
	$str = str_replace("Ê","E",$str); 
	$str = str_replace("Ô","O",$str); 
	$str = str_replace("Û","U",$str); 
	$str = str_replace("'","",$str); 
	$str = str_replace("","_",$str);
	$str = str_replace("","_",$str);
	$str = str_replace("º","",$str);
	$str = str_replace("`","",$str);
	$str = str_replace("´","",$str);
	$str = str_replace("+","",$str);
	$str = str_replace("/","",$str);
	$str = str_replace("|","",$str);
	$str = str_replace("\\","",$str);
	$str = str_replace("\"","",$str);
	$str = str_replace(";","",$str);
	$str = str_replace(",","",$str);
	$str = str_replace("\n", "<br>", $str);
	return $str; 
}


//retorna trecho de uma string
function trecho($string, $tamanho){
	$trecho = htmlspecialchars(strip_tags(substr($string,0,$tamanho))); 
	if (strlen($string) > $tamanho){ 
		$trecho .= "..."; 
	}
	return $trecho;
}

function envia_email($para, $assunto, $mensagem)
{
	global $mailto;
	global $headers;
	
	return mail($para, $assunto, $mensagem, $headers, "-r".$mailto);
}

?>