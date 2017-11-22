<!doctype html>
<html lang="pt-br">
<head>
	<script src="./js/jquery.min.js"></script>
	<meta charset="utf-8"/>
  <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
<?php

$user_nome=$_POST['nome'];
$user_snome=$_POST['snome'];
$user_usuario=$_POST['usuario'];
$user_email=$_POST['email'];
$user_sexo=$_POST['sexo'];
$user_sangue=$_POST['sangue'];
$user_senha=$_POST['senha'];
$user_data=date('y/m/d');
$user_startus="indefinido";
$user_conf_senha=$_POST['conf_senha'];

$usuario = "root";
$senha ="";
$servidor = "localhost";
$dbname = "rede_social";

header('Content-Type: text/html, chaset-utf-8');
$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);

if(!$conexao){
	echo "N�o foi possivel conectar";


}
function procurar_usuario($elemento){

	$usuario = "root";
	$senha ="";
	$servidor = "localhost";
	$dbname = "rede_social";
	$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);
	$result_usuario=1;
	$consulta=mysqli_query($conexao,"SELECT * FROM Perfil");

	while($linha=mysqli_fetch_array($consulta)){

			if($elemento==$linha["usuario"]){
			$result_usuario=0;



			}

		}

	return $result_usuario;
}

function procurar_email($elemento){

	$usuario = "root";
	$senha ="";
	$servidor = "localhost";
	$dbname = "rede_social";
	$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);
	$result_email=1;
	$consulta=mysqli_query($conexao,"SELECT * FROM Perfil");

	while($linha=mysqli_fetch_array($consulta)){

			if($elemento==$linha["email"]){
			$result_email=0;


			}

		}

	return $result_email;
}

	if(procurar_email($user_email)==true && procurar_usuario($user_usuario)==true ){

		$hashed= hash('SHA512',$user_senha);
		$consulta=mysqli_query($conexao,"SELECT * FROM Perfil");
		$num_rows = mysqli_num_rows($consulta);//quantidade de linhas de uma consulta
		$num_rows+=1;
		$sql = "INSERT INTO Perfil VALUES ";
		$sql .= "('$num_rows','$user_nome', '$user_snome', 	'$user_sexo', '$user_email', '$user_usuario','$user_sangue','$user_data', '$hashed','$user_startus')";
		$salvando=mysqli_query($conexao,$sql);

		if($salvando==1){
		echo "Dados gravados";
		?>
		<form class="cad_form" method="POST" action='PhpSql_img.php' enctype="multipart/form-data">
			<label for="foto">Foto de perfil</label>
			<input class="file" type="file" name="foto"/></br></br>
			<label for="foto_fundo"></label>
			<input class="file" type="file" name="foto_fundo"/></br></br>
			<input class="send" type="submit" name="send" value="Enviar">
		</form>

		<?php


		}else{
		echo "Erro ao gravar";

		?>
		</body>
		<?php

		}

	}else{


		if(procurar_email($user_email)==0){
		echo "E-mail: ".$user_email." j� cadastrado </br>";

		}
		if(procurar_usuario($user_usuario)==0){
			echo "Usuario: ".$user_usuario." j� cadastrado";
		}

	}








mysqli_close($conexao);
?>
</body>
</html>
