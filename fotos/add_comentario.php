<?
include "ver_login.php";

$nome = $_GET["nome"];
$id_foto = $_GET["foto"];
$nome_comentario = ucwords(strtolower(htmlspecialchars($_POST["nome_comentario"])));
$email_comentario = strtolower($_POST["email_comentario"]);
$comentario_comentario = htmlspecialchars($_POST["comentario_comentario"]);
$erro_comentario = "";

if ($nome != "" && $id_foto != "" && $nome_comentario != "" && $comentario_comentario != ""){
	$sql_comentario = "INSERT INTO comentarios  (user 
												,foto
												,nome
												,email
												,comentario
												,data
												) VALUES (
												'".$nome."'
												,'".$id_foto."'
												,'".$nome_comentario."'
												,'".$email_comentario."'
												,'".$comentario_comentario."'
												,'".$data."');";
												
	$executa_comentario = mysqli_query($conexao, $sql_comentario) or die (mysqli_error($conexao));
	header("Location: usuarios.php?nome=".$nome."&foto=".$id_foto."&status_com=ok");
	exit;
}else{
	header("Location: usuarios.php?nome=".$nome."&foto=".$id_foto."&status_com=no");
	exit;
}
	?>