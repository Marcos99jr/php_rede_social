	<!doctype html>
	<html lang="pt-br">
	<head>
		<script src="./js/jquery.min.js"></script>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="./css/estilo.css" />
	</head>
	<body>
	<?php
	session_start();
	$user_id_visit=$_SESSION['usuario_id'];
	$user_id=$_GET['user_adicionado'];


			$usuario = "root";
			$senha ="";
			$servidor = "localhost";
			$dbname = "rede_social";

			header('Content-Type: text/html, chaset-utf-8');
			$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);

	$inserir=mysqli_query($conexao,"UPDATE Amizade set situacao = 'confirmado' where amigo=$user_id and amigo_visit=$user_id_visit ");
	echo "agora vocês são amigo";
	?>
	<a href="./Home.php"><button>Voltar para o perfil</button></a>

	</body>
	</html>
