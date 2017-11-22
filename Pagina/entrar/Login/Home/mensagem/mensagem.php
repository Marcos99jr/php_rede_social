<?php
session_start();
	if(isset($_SESSION['usuario_id'])){


$usuario = "root";
$senha ="";
$servidor = "localhost";
$dbname = "rede_social";


header('Content-Type: text/html, chaset-utf-8');
$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);

$usuario=$_SESSION['usuario_id'];
$amigo=$_GET['user'];

$p_usuario=mysqli_query($conexao,"SELECT * FROM Perfil where id=$usuario ");
$p_linha=mysqli_fetch_array($p_usuario);
$nome_usuario=$p_linha["nome"];


$consulta=mysqli_query($conexao,"SELECT mensagem FROM Amizade where amigo=$usuario and  amigo_visit=$amigo or amigo=$amigo and  amigo_visit=$usuario");
$linha=mysqli_fetch_array($consulta);


if($_SERVER['REQUEST_METHOD']=="POST"){
	$mensagem=$_POST['mensagem'];

$mensagem="¢".$nome_usuario.": ".$mensagem;
	$array=$linha[0].$mensagem;
	$inserir=mysqli_query($conexao,"UPDATE Amizade set mensagem ='$array' where amigo=$usuario and  amigo_visit=$amigo or amigo=$amigo and  amigo_visit=$usuario ");



}else{
$usuario=$_SESSION['usuario_id'];
$amigo=$_GET['user'];

$usuario = "root";
$senha ="";
$servidor = "localhost";
$dbname = "rede_social";
header('Content-Type: text/html, chaset-utf-8');
$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);

$consulta=mysqli_query($conexao,"SELECT mensagem FROM Amizade where amigo=$usuario and  amigo_visit=$amigo or amigo=$amigo and  amigo_visit=$usuario");
	if($consulta!=false){
	$linha=mysqli_fetch_array($consulta);
	}
}

	if($linha[0]!=""){
		?>
		<div class="box">
		<?php
		$array=explode("¢",$linha[0]);

		foreach ($array as $indice => $value){
		echo "<p class='text'>".$value."</p>";
		}
		if(isset($mensagem)){
			$new=$stringCorrigida = str_replace('¢', ' ', $mensagem);
			?>
			<p class="text">
			<?php
			echo $new;
			?>
		</p>
			<?php
		}
	}
	$usuario=$_SESSION['usuario_id'];
	$amigo=$_GET['user'];
	$array_mensagem=[];

	?>
		<!doctype html>
		<html lang="pt-br">
		<head>
			<meta charset="utf-8"/>
			<link rel="stylesheet" type="text/css" href="./css/msg.css"/>
			<link rel="stylesheet" href="./css/font-awesome.min.css">
		</head>
		<body>
		<form method="POST" id="form" action="mensagem.php?user=<?php echo$amigo?>">
			<input type="text" name="mensagem" placeholder="Digite a sua mensagem aqui... "/>
			<input type="submit" value="enviar" id="enviar">
		</form>
		<a href="http://localhost/Rede_social/Pagina/entrar/Login/Home/Home.php"><button>Voltar</button></a>
	</div>
		</body>
		</html>
	<?php
	}
	?>
