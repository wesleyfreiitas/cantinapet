<?php

include 'db.php';

$nomedono = addslashes($_POST['nomedono']);

# antes
$senha = md5($_POST['senha']);


$insere = $conn->prepare("SELECT * FROM dono WHERE nomedono = '$nomedono' and SENHA = '$senha'");

$insere->execute();

$row = $insere->fetch();
print_r($row);

if($row != ''){

	session_start();
	$_SESSION['login'] = true;
	$_SESSION['usuario'] = $usuario;

	header('location:index.php');
}
else{
	header('location:home.php?erro');
	
}
