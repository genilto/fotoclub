<?
include "conf.php";

$conexao = mysqli_connect($servidor, $usuario, $senha) or die (mysqli_error($conexao));
$banco = mysqli_select_db($conexao, $banco);
 
?>