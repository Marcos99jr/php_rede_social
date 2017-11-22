<?php
if($_SERVER['REQUEST_METHOD']=="POST"){

$valor=$_POST['sair'];
session_start();
session_destroy();

header("location: ../Login.php");

}
?>
<!doctype html>
<html lang="pt-br">
<head>
	<script src="./js/jquery.min.js"></script>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="./css/estilo.css" />
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="./css/bootstrap/css/bootstrap.css" />
</head>
<main>

<?php
if(isset($_GET['user'])){//usado para entrar no perfil de outros

$user_id_visit=$_GET['user'];

$usuario = "root";
$senha ="";
$servidor = "localhost";
$dbname = "rede_social";


header('Content-Type: text/html, chaset-utf-8');
$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);


$consulta=mysqli_query($conexao,"SELECT * FROM Perfil where id=$user_id_visit");
$linha=mysqli_fetch_array($consulta);
$user_usuario=$linha['usuario'];
$user_sangue=$linha["sangue"];
$user_status=$linha["startus"];
?>

<div class="pessoa">
	<div class="capa">
		<img class="img_capa" src="../usuario/<?php echo $user_id_visit?>/background.jpg">
	</div>
	<div class="foto">
		<img class="img_foto"  src="../usuario/<?php echo $user_id_visit?>/imagem.jpg">
		<div class="status">
			<p1><?php if($user_status=="necessitado"){echo "Preciso de sangue";}elseif($user_status=='doador'){echo "Doador";}else{ echo "indefinido";} ?>
			</p1>
		</div>

	</div>
	<div class="Perfil_proprio">
		<div class="user_name">
			<h5><?php echo  $user_usuario ?></h5>
		</div>
		<div class="sangue">

			<h5><?php echo $user_sangue ?></h5>
		</div>
	</div>
</div>


<?php
session_start();
$user_id=$_SESSION['usuario_id'];

$amigo=mysqli_query($conexao,"SELECT * FROM Amizade where amigo=$user_id_visit and amigo_visit=$user_id or amigo=$user_id and amigo_visit=$user_id_visit");
$mostrar_solicitacao=0;

while($linha_amigo=mysqli_fetch_array($amigo)){
	if($linha_amigo['situacao']=='aguardando'||$linha_amigo['situacao']=="confirmado"||$linha_amigo['situacao']=="negado"){
		$mostrar_solicitacao=1;
	}
}
	if($mostrar_solicitacao!=1){
		?>
	<a href='./adicionar.php?user=<?php echo $user_id_visit ?>'><button>Adicionar aos amigos</button></a>
	<?php
	}

?>
<a href="./Home.php"><button>Voltar para o perfil</button></a>

<?php

}else{//perfil propio da pessoa



	session_start();
	if(isset($_SESSION['usuario_id'])){
		$user_id=$_SESSION['usuario_id'];


		$usuario = "root";
		$senha ="";
		$servidor = "localhost";
		$dbname = "rede_social";

		header('Content-Type: text/html, chaset-utf-8');
		$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);

		if(!$conexao){
			echo "Não foi possivel conectar";


		}




			$consulta=mysqli_query($conexao,"SELECT * FROM Perfil where id=$user_id ");
			$linha=mysqli_fetch_array($consulta);
			$sangue=$linha["sangue"];
			$user_usuario=$linha["usuario"];
			$status=$linha["startus"];

			?>

			<body>
			<div class="pessoa">
				<div class="capa">
					<img class="img_capa" src="../usuario/<?php echo $user_id?>/background.jpg">
				</div>
				<div class="foto">
					<img class="img_foto" src="../usuario/<?php echo $user_id?>/imagem.jpg">
				</div>
				<div class="Perfil_proprio">
					<div class="user_name">
						<h5><?php echo  $user_usuario ?></h5>
					</div>
					<div class="sangue">

						<h5><?php echo $sangue ?></h5>
					</div>
			</div>
				<nav>
					<div class="status">
						<p1><?php if($status=="necessitado"){echo "Preciso de sangue";}elseif($status=='doador'){echo "Doador";}else{ echo "indefinido";} ?>
							<a href='./change_stats.html'><button class="btn btn-link">Mudar</button></a>
						</p1>
						</div>
					</div>
				</nav>

			<div class="pesquisa">
					<form method='POST' action="pesquisa.php">
						<input type="text" name="pesquisa" placeholder="Nome do usuario"/>
						<button class="btn btn-info" type="submit" ><span class="icon"><i class="fa fa-check-circle" aria-hidden="true"></i>	          		</span></button>
					</form>
			</div>

			<h3>Pessoas que precisam de sangue</h3>

			<?php
			$consulta_lista=mysqli_query($conexao,"SELECT * FROM Perfil");
			 		while($linha=mysqli_fetch_array($consulta_lista)){


								if($linha["startus"]=='necessitado'){

									?>
									<h5><a href='?user=<?php echo $linha["id"] ?>'><?php echo $linha["nome"]." ".$linha["sobrenome"];?></a></h5>
									<?php
									}
							}


			?>

			<h1>Solicitações</h1>
			<?php
			$solicitacoes=mysqli_query($conexao, "SELECT * from Amizade where amigo_visit=$user_id and situacao='aguardando' ");

			while($linha_solicitacao=mysqli_fetch_array($solicitacoes)){
				$id_amigo=$linha_solicitacao['amigo'];

				$amigo_solicitacao=mysqli_query($conexao,"SELECT * FROM Perfil where id=$id_amigo");

					while($linha_amigo=mysqli_fetch_array($amigo_solicitacao)){
						?>
						<div class="solicitacoes">
						<img style="width : 100px" src="../usuario/<?php echo $linha_amigo['id']?>/imagem.jpg"/>
						<a href='?user=<?php echo $linha_amigo["id"] ?>'><p1><?php echo $linha_amigo['nome'];?></p2></a>
						<a href='./confirmado.php?user_adicionado=<?php echo $linha_amigo['id']?>'><button>Aceitar</button></a>
						<a href='./negado.php?user_adicionado=<?php echo $linha_amigo['id']?>'><button>x</button></a>
						</div>
						<?php
					}

			}

			?>


			<h1>Amigos</h1>
			<?php //amigos
			$solicitacoes=mysqli_query($conexao, "SELECT amigo from Amizade where amigo_visit=$user_id and situacao='confirmado' and amigo!=$user_id");

			while($linha_solicitacao=mysqli_fetch_array($solicitacoes)){
				$id_amigo=$linha_solicitacao['amigo'];
	
				$amigo_solicitacao=mysqli_query($conexao,"SELECT * FROM Perfil where id=$id_amigo");

					while($linha_amigo=mysqli_fetch_array($amigo_solicitacao)){
						?>
						<div class="solicitacoes">
						<img style="width : 100px" src="../usuario/<?php echo $linha_amigo['id']?>/imagem.jpg"/>
						<a href='?user=<?php echo $linha_amigo["id"] ?>'><p1><?php echo $linha_amigo['nome'];?></p2></a>
						<a href="./mensagem/mensagem.php?user=<?php echo $linha_amigo["id"] ?>"/><button>Enviar mensagem</button></a>
						</div>
						<?php
					}

			}

			$solicitacoes=mysqli_query($conexao, "SELECT amigo_visit from Amizade where amigo=$user_id and situacao='confirmado' and amigo_visit!=$user_id");

			while($linha_solicitacao=mysqli_fetch_array($solicitacoes)){
				$id_amigo=$linha_solicitacao['amigo_visit'];

				$amigo_solicitacao=mysqli_query($conexao,"SELECT * FROM Perfil where id=$id_amigo");

					while($linha_amigo=mysqli_fetch_array($amigo_solicitacao)){
						?>
						<div class="solicitacoes">
						<img style="width : 100px" src="../usuario/<?php echo $linha_amigo['id']?>/imagem.jpg"/>
						<a href='?user=<?php echo $linha_amigo["id"] ?>'><p1><?php echo $linha_amigo['nome'];?></p2></a>
						<a href="./mensagem/mensagem.php?user=<?php echo $linha_amigo["id"] ?>"/><button>Enviar mensagem</button></a>

						</div>
						<?php
					}

			}
		


			?>
			
			<form method="POST" action="Home.php">
			<input type='submit' value='sair' name='sair'/>
			</form>

			<?php



	}else{
		echo "Sessão encerrada, logue novamente.";
	?>
	<a href="../Login.php"/><button>Voltar</button></a>
	<?php
	}
}
?>
</home>
</main>
</html>
