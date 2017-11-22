<!doctype html>
<html lang="pt-br">
<head>
	<script src="./js/jquery.min.js"></script>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="./css/estilo.css" />
</head>
<body>

<?php
$Obj_pesquisa=$_POST['pesquisa'];

$usuario = "root";
$senha ="";
$servidor = "localhost";
$dbname = "rede_social";

$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);

$pesquisa=mysqli_query($conexao,"select * from Perfil where usuario like '$Obj_pesquisa'");

?><h1>Resultado da pesquisa</h1>
<?php

while($linha=mysqli_fetch_array($pesquisa)){

      ?>
      <div class="resultado">
      <img style="width : 100px" src="../usuario/<?php echo $linha['id']?>/imagem.jpg"/>
      <a href='http://localhost/Rede_social/Pagina/entrar/Login/Home/Home.php?user=<?php echo $linha["id"] ?>'><p1><?php echo $linha['usuario'];?></p2></a>

      </div>
      <?php
  }


?>
<a href="./Home.php"><button>Voltar para o perfil</button></a>
</body>
</html>
