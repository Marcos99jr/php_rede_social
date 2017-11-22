<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$usuario=$_POST['nome'];
		echo $usuario;
	}
?>
<!doctype html>
<html lang="pt-br">
<head>
	<script src="./js/jquery.min.js"></script>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="./css/estilo.css" />
	<script>
	/*$(function(){
		var images = ['https://cdn.wallpapersafari.com/49/34/ftBCER.jpg','https://i.pinimg.com/originals/63/71/00/6371002b451318329de3341c1bfd92bd.jpg']
		var index = 0;
		var maxImages = images.length -1;

		var timer = setInterval(function() {
		var curImage = images[index];
		index = (index == maxImages) ? 0 : ++index;
			$('body').css({'background-image':'url('+curImage+')','transition': 'background 3000ms ease'});
			}, 6500);
	});*/
	</script>

</head>
<body class="body">

	<div class="cad_form">
		<div class="title_form">
			<h2>CADASTRO</h2>
		</div>

		<form class="cadastrar" method="POST" action="./PhpSql.php" >
						<label for ="nome">Nome</label>
						<input class="nome" type="text" name="nome" placeholder="Nome"></br></br>
						<label for ="snome">Sobrenome</label>
						<input class="snome" type="text" name="snome" placeholder="Sobrenome"></br></br>
						<label for ="usuario">Usuário</label>
						<input 	class="usuario" type="text" name="usuario" placeholder="Nome de Usuário" ></br></br>
						<label for ="email">Email</label>
						<input 	class="email" type="email" name="email" placeholder="E-mail"></br></br>
						<label for ="sexo">Sexo</label>
						<select name="sexo">
						<option value="F">Feminino</option></br></br>
						<option value="M">Masculino</option></br></br>
						</select></br></br>
						<label for ="sangue">Tipo sanguíneo</label>
						<select name="sangue">
							<option value="A+">A+</option>
							<option value="A-">A-</option>
							<option value="B+">B+</option>
							<option value="B-">B-</option>
							<option value="AB+">AB+</option>
							<option value="AB-">AB-</option>
							<option value="O+">O+</option>
							<option value="O-">O-</option>
						</select></br></br>
						<label for ="senha">Senha</label>
						<input class="senha" type="password" name="senha"></br></br>
						<label for ="conf_senha">Corfirme sua senha</label>
						<input class="senha" type="password" name="conf_senha"></br></br>

						<input class="send" type="submit" name="send" value="Enviar">

    </div>

		</form>
	</div>


</body>
</html>
