<? include "ver_login.php";
$foto = $_GET["foto"];

$sql = "SELECT * FROM user WHERE username = '".$login_usuario."'";
$executa = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
$listar = mysqli_fetch_assoc($executa);
?>
<html>
<head>
<title><? echo $titulo; ?></title>
</head>

<body bgcolor="#333333">
<center><img src="<? echo $foto; ?>" border="3"><br>
<font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2">
<b><? if ($local != "adm_fotos"){ echo $listar["nome"]; } ?></b>
</font>
</center>
</body>
</html>
