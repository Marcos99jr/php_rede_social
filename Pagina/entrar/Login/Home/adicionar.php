<html>
<head>
</head>
<body>
<?php
$user_visit=$_GET['user'];
session_start();
if(isset($_SESSION['usuario_id'])){
  $user_id=$_SESSION['usuario_id'];

  $sql = "INSERT INTO Amizade VALUES ";
  $sql .= "('$user_id','$user_visit','aguardando','')";

	$usuario = "root";
	$senha ="";
	$servidor = "localhost";
	$dbname = "rede_social";
	$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);

  $salvando=mysqli_query($conexao,$sql);
  echo "Solicitação enviado!";
  ?>
  <a href="./Home.php"><button>Voltar para o perfil</button></a>
<?php
  }
?>

</body>
</html>
