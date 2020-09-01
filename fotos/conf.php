<?
//$hora_arrumada = time() + 10800;
$hora_arrumada = time();

//Hora
$hour = date("H", $hora_arrumada);
$minutos = date("i", $hora_arrumada);
$segundos = date("s", $hora_arrumada);

//data
$dia = date("d", $hora_arrumada);
$mes = date("m", $hora_arrumada);
$ano = date("Y", $hora_arrumada);
//Ano permitidos
$min_ano_permitido = ($ano - 80);
$max_ano_permitido = ($ano - 5);

//horario de verão
if (date("I", $hora_arrumada) == "1"){
	$h_verao = "sim"; 
}else{
	$h_verao = "não"; 
}

//tudo junto
$data = $dia."/".$mes."/".$ano;
$hora = $hour.":".$minutos.":".$segundos;
$horario_verao = $h_verao;

if ($hour >= 1 && $hour < 5){
	$des_saudacao = "Boa noite";
}elseif ($hour >= 5 && $hour < 12){
	$des_saudacao = "Bom dia";
}elseif($hour >= 12 && $hour < 20){
	$des_saudacao = "Boa tarde";
}elseif($hour >= 20 && $hour < 23){
	$des_saudacao = "Boa noite";
}else{
	$des_saudacao = "Boa noite";
}

//Array contendo os meses do ano
$w_meses = array("01" => "Janeiro"
			   , "02" => "Fevereiro"
			   , "03" => "Março"
			   , "04" => "Abril"
			   , "05" => "Maio"
			   , "06" => "Junho"
			   , "07" => "Julho"
			   , "08" => "Agosto"
			   , "09" => "Setembro"
			   , "10" => "Outubro"
			   , "11" => "Novembro"
			   , "12" => "Dezembro");

//Array com os tipo de sexo
$w_lista_sexo = array("Masculino"
			        , "Feminino"
					, "Outro");

//informaçoes site
$nome_site = "Fotoclube";
$ano = "2008";
$servidor_site = "fotoclube.genilto.local";
$dominio = $servidor_site."/fotos";
$url_site = $dominio;
$mailto = "fotoclube@".$servidor_site;
$fromMail = $mailto;
$criador = "Genilto Vanzin";

//tipo do link
	// 0 = http://usuario.dominio -> subdominio
	// 1 = http://dominio/usuario -> folder
$link_usuario = 1;
//endereço das imagens e links
	// 0 = imagem(link)
	// 1 = servidor + imagem(link)
$end_img_link = 0;
//forma de login
	// 0 = utiliza sessão - $HTTP_SESSION_VARS
	// 1 = utiliza sessão - $_SESSION	
	// 2 = utiliza cookies - $HTTP_COOKIE_VARS
	// 3 = utiliza cookies - $COOKIES
$login_type = 1;
//Forma do cookie nas demais paginas
	// 0 = $HTTP_COOKIE_VARS
	// 1 = $_COOKIE
$login_type_outros = 0;

//Quantidade de fotos permitidas
$qtd_max_fotos_dia = 100;
$qtd_max_fotos_dia_extenso = "cem fotos";

//Se o chat vai listar todos os usuários ou só os amigos
$ind_chat_lista_todos = "S";

//titulo do site
$titulo = ":: ".$nome_site." :: Fotoclube";
//rodapé do site
$rodape_site = "Resolu&ccedil;&atilde;o 
			m&iacute;nima de 800X600 | &copy; ".$ano." ".$nome_site . " | By " . $criador;
			
//link para a págia de administração do site
$link_administrador = "<a href=\"../admin/index.php\"><font color=\"#74AB62\">Adm</font></a>";

//descrição dos caracteres permitidos para cadastro
$caracteres_permitidos = "S&atilde;o permitidos apenas n&uacute;meros 
						de &quot;0&quot; a &quot;9&quot; e letras de &quot;a&quot; a &quot;z&quot; 
						min&uacute;sculas e sem acentos, podem ser separados por &quot;.&quot; ou &quot;_&quot; 
						apenas, deve conter no mínimo 3 caracteres";

//condição do endereco das imagens e links
if($end_img_link == 0){
	$end_objetos = "../";
	$end_objetos_adm = "../fotos/";
}else{
	$end_objetos = "http://".$servidor_site."/";
	$end_objetos_adm = "http://".$servidor_site."/fotos/";
}
//Condição para abrir ou não uma sessão
if($login_type == 0 || $login_type == 1){
	//session_save_path("C:/");
	session_start();
	//echo session_save_path();
}


//Informações do Chat

//Tempo máximo de ausência de um usuário
$tempo_limite = 30; //segundos

// Tempo entre uma consulta e outra
$tempo_entre_consultas = 10; //segundos

//informaçoes para conexao com db
$servidor = "localhost";
$banco = "fotolog";
$usuario = "root";
$senha = "mysql";

$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: $fromMail\r\n";
$headers .= "Return-Path: $fromMail\r\n";

include "funcoes.php";

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-Type: text/html;  charset=utf-8");

?>