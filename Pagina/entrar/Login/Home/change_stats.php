<?php
$newStatus=$_POST['status'];


session_start();
$id=$_SESSION['usuario_id'];


$usuario = "root";
$senha ="";
$servidor = "localhost";
$dbname = "rede_social";
$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);


$consulta=mysqli_query($conexao,"SELECT * FROM Perfil where id=$id ");

$linha=mysqli_fetch_array($consulta);


if($newStatus=="necessitado"){
$comando=mysqli_query($conexao," UPDATE Perfil
    set startus = 'necessitado'
    where id=$id");


}elseif ($newStatus=="doador"){

$comando=mysqli_query($conexao,"UPDATE Perfil
    set startus = 'doador'
    where id=$id");

}else{

  $comando=mysli_query($conexao,"UPDATE Perfil set startus = 'indefinido' where id=$id ");

}
?>
  <a href="./Home.php"><button>Voltar para o perfil</button></a>
<?php

?>
