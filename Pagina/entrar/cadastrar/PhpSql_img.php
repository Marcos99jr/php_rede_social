<!doctype html>
<html lang="pt-br">
<head>
	<script src="./js/jquery.min.js"></script>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="./css/estilo.css" />
</head>
<body>

<?php
$usuario = "root";
$senha ="";
$servidor = "localhost";
$dbname = "rede_social";

header('Content-Type: text/html, chaset-utf-8');
$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);

if(!$conexao){
	echo "Não foi possivel conectar";


}
$consulta=mysqli_query($conexao,"SELECT * FROM Perfil");
		$num_rows = mysqli_num_rows($consulta);//quantidade de linhas de uma consulta

$background=$_FILES['foto_fundo']['tmp_name'];
$foto=$_FILES['foto']['tmp_name'];
mkdir("../login/usuario/$num_rows") or die("erro ao criar diretório");
copy($foto,"../login/usuario/$num_rows/imagem.jpg");
copy($background,"../login/usuario/$num_rows/background.jpg");
header("location: 	http://localhost/Rede_social/Pagina/entrar/Login/Login.php");

?>
</html>
