<?php
if($_SERVER['REQUEST_METHOD']=="POST"){

$user_usuario=$_POST['usuario'];
$user_senha=$_POST['senha'];
$user_senha=hash('SHA512',$user_senha);


	function procurar($user,$sen){

		$usuario = "root";
		$senha ="";
		$servidor = "localhost";
		$dbname = "rede_social";
		$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);
		if(!$conexao){
			echo "Não foi possivel conectar";


		}

		$result=false;
		$consulta=mysqli_query($conexao,"SELECT * FROM Perfil");

		while($linha=mysqli_fetch_array($consulta)){

				if($user==$linha["usuario"]){

					if($sen==$linha["senha"]){

						session_start();

						$_SESSION['usuario_id']=$linha["id"];
						header("location: ./Home/Home.php");

					}



				}

			}

		return $result;
		?><div>

		<h1><?php echo "Usuario ou senha incorreto"; ?></h1>
		</div>
		<?php
	}


	$consulta=procurar($user_usuario,$user_senha);

}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="./css/index.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<script type="text/javascript" src="./js/jquery.min.js"></script>
	<script type="text/javascript" src="./js/javascript.js"></script>
</head>
<body>
	<header class="banner">
		<div class="central">
			<h1 class="titulo">Ar<>cos</h1>
			<p>Sua rede social de doação de sangue</p>

		</div>
		<div class="button">
			<button class="login">Login</button>
		</div>

	<section class="form">
		<h1 id="log">Login</h1>
		<form method='POST' action="Login.php">
			<input type="text" name="usuario" placeholder="Nome do usuário"/></br></br>
			<input type="password" name="senha" placeholder="Senha"></br></br></br></br>
			<button type="submit" id="color" class="btn btn-outline-light">Logar</button>
		</form>
		<a href="http://localhost/Rede_social/Pagina/Index.html"><button>Voltar</button></a>
	</section>
	</header>
</body>
</html>
