<?php
include ('criarCliente.php');
include('Email.php');
session_start();

try{
	$conn = new PDO('mysql:host=localhost;dbname=banco','root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Criou-se uma conexão persistente que não se finaliza após o fim do script
    array(PDO::ATTR_PERSISTENT => true);
	echo "Banco conectado";
}catch(PDOException $e){
	echo $e->getMessage();
}

$numero = $_POST['numero'];
$nomepet = $_POST['nomepet'];
$nomedono = $_POST['nomedono'];
$email = $_POST['email'];
$cep = $_POST['cep'];
$fone = $_POST['fone'];
$idade = $_POST['idade'];
$peso = $_POST['peso'];
$gramas = $_POST['gramas'];
$raca = $_POST['raca'];
$score = $_POST['score'];
$plano = $_POST['plano'];
$senha2 = 'CantinaPet';




$insere = $conn->prepare("INSERT INTO pet(nomepet, idade, peso, gramas, raca, score, plano, numero)
VALUES ('$nomepet', '$idade', '$peso', '$gramas', '$raca', '$score', '$plano', '$numero')");

$insere2 = $conn->prepare("INSERT INTO dono (nomedono, email, cep, fone, senha) 
VALUES ('$nomedono', '$email', '$cep','$fone', '$senha2')");

$insere->execute();
$insere2->execute();

$consulta = $conn->prepare("SELECT * FROM dono WHERE email = '$email'");

$consulta->execute();

$token = uniqid();
$_SESSION['token'] = $token;
$_SESSION['email'] = $email;

$info = $consulta->fetch();
$mail = new Email('smtp.gmail.com', 'wesleydefreiitas01@gmail.com', 'qyxgasvbvgewcqvj', 'Cantina pet');
$mail->enviarPara($_POST['email'], $info['nomedono']);
//A url que estamos passando na variável $url é para onde o usuário será mandado quando clicar no link
// recebido no email
$url = 'http://localhost:8080/study_pdo/redefinir.php';
//A variável $corpo é onde se encontra o texto do email, onde estamos informando em um link a
// url para onde o usuário será mandado ao clicar no link recebido no email e com um token único que
// foi gerado quando ele clicou em redefinir a senha.
$corpo = 'Olá ' . $info['nomedono'] . ', <br>
           Voce se cadastrou no Catnina Pet. Acesse o link abaixo para Defina sua senha.<br>
           <h3><a href="' . $url . '?token=' . $_SESSION['token'] . '">Definir a sua senha</a></h3>';

$informacoes = ['Assunto' => 'Confirmação de cadastro', 'Corpo' => $corpo];
$mail->formatarEmail($informacoes);

if ($mail->enviarEmail()) {
    $data['sucesso'] = true;
} else {
    $data['erro'] = true;
}
