<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$db = "banco";
//---------
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
$e = $_POST['token'];

//CRIANDO CLIENTE

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.iugu.com/v1/customers?api_token=14955FE4B8AD26F4794FFED4AF64161DCCA0724916DF6A3B96F389DFC9F84B8B",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"email\":\"$email\",\"name\":\"$nomedono\",\"phone\":$fone,\"phone_prefix\":85,\"cpf_cnpj\":\"60344242323\",\"zip_code\":\"$cep\",\"number\":\"191\",\"street\":\"TRES CORACOES\",\"city\":\"FORTALEZA\",\"state\":\"CE\",\"district\":\"PASSARE\"}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json"
  ],
]);

$response = json_decode(curl_exec($curl));

$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {

  $cliente = $response->id; //preservar esse valor para passar na assinatura

  echo $cliente;

//FINALIZANDO A CRIAÇÃO DO CLIENTE INICIANDO A LISTAGEM DOS PLANOS

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.iugu.com/v1/plans?api_token=14955FE4B8AD26F4794FFED4AF64161DCCA0724916DF6A3B96F389DFC9F84B8B ",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json"
  ],
]);

$response = json_decode(curl_exec($curl));
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {

$conexao = mysqli_connect($servidor, $usuario, $senha, $db);

$insere = "INSERT INTO dono (nomedono, email, cep, fone, senha) VALUES ('$nomedono', '$email', '$cep','$fone', '$senha2')";

$insere2 = "INSERT INTO pet(nomepet, idade, peso, gramas, raca, score, plano, numero)
VALUES ('$nomepet', '$idade', '$peso', '$gramas', '$raca', '$score', '$plano', '$numero')";
mysqli_query($conexao, $insere);
mysqli_query($conexao, $insere2);

function chamaplano($plano)
{
    $cd = 160;
    if ($plano == 'r1') {
        $r1 = 40;
        $cm = $cd * 28;

        $kgm = $cm / 1000;
        $pf = $kgm * $r1;
        return $pf;
    } elseif ($plano == 'r2') {
        $r2 = 45;
        $cm = $cd * 28;

        $kgm = $cm / 1000;
        $pf = $kgm * $r2;
        return $pf;
    } elseif ($plano == 'r3') {
        $r3 = 40;
        $cm = $cd * 28;

        $kgm = $cm / 1000;
        $pf = $kgm * $r3;
        return $pf;
    }
}
//FINALIZANDO A LISTAGEM DOS PLANOS INICIANDO A CRIAÇÃO DO PLANO


$idPlano = $response->totalItems + 1;

$planin = chamaplano($plano);

$valorPlano = $planin*100;
echo "<br>" . $valorPlano;
}}
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.iugu.com/v1/plans?api_token=14955FE4B8AD26F4794FFED4AF64161DCCA0724916DF6A3B96F389DFC9F84B8B ",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"payable_with\":[\"credit_card\"],\"identifier\":\"$idPlano\",\"name\":\"PLANO\",\"interval\":28,\"interval_type\":\"months\",\"value_cents\":\"$valorPlano\"}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json"
  ],
]);

$response2 = json_decode(curl_exec($curl));
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {


//FINALIZANDO A CRIAÇÃO DOS PLANOS E INICIEI A CRIAÇÃO DA ASSINATURA.

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.iugu.com/v1/subscriptions?api_token=14955FE4B8AD26F4794FFED4AF64161DCCA0724916DF6A3B96F389DFC9F84B8B ",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"two_step\":false,\"suspend_on_invoice_expired\":true,\"only_charge_on_due_date\":true,\"only_on_charge_success\":true,\"ignore_due_email\":false,\"credits_based\":false,\"price_cents\":1000,\"customer_id\":\"$cliente\",\"plan_identifier\":\"$idPlano\",\"only_on_charge_success\":false}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json"
  ],
]);

$response = json_decode(curl_exec($curl));
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //RECEBE OS NOME DO CARTÃO E TOKEN DE AUTORIZAÇÃO DO SERVIDOR DA YUGO.

  $assinatura = $response->id;

  echo "Assinatura ".$assinatura."<br>";
  
  echo $e."<br>";

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.iugu.com/v1/customers/$cliente/payment_methods?api_token=14955FE4B8AD26F4794FFED4AF64161DCCA0724916DF6A3B96F389DFC9F84B8B",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"description\":\"peladinho\",\"token\":\"$e\",\"set_as_default\":\"true\"}",
    CURLOPT_HTTPHEADER => [
      "Accept: application/json",
      "Content-Type: application/json"
    ],
  ]);

  $response = json_decode(curl_exec($curl));
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {

    $pagamento = $response->id;
    echo "ID pagamento ".$pagamento;

    //busca assinatura
    $curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.iugu.com/v1/subscriptions/$assinatura?api_token=14955FE4B8AD26F4794FFED4AF64161DCCA0724916DF6A3B96F389DFC9F84B8B",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json"
  ],
]);

$response = json_decode(curl_exec($curl));

$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {

$recent_invoices_obj = $response->recent_invoices;

$recent_invoices = json_encode($recent_invoices_obj);

$data2 = json_decode($recent_invoices);

$recent_invoices2 = $data2[0]->id;

echo $recent_invoices2."FATURA GERADA<br>";
//ATIVANDO FATURA.
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.iugu.com/v1/charge?api_token=14955FE4B8AD26F4794FFED4AF64161DCCA0724916DF6A3B96F389DFC9F84B8B",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"customer_payment_method_id\":\"$pagamento\",\"restrict_payment_method\":false,\"customer_id\":\"$cliente\",\"invoice_id\":\"$recent_invoices2\"}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
  }
}
}

/*?>

<input type="text" disabled value="<?php echo $planin;?>">

<?php
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
}*/
}