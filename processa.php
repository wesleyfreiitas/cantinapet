<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<?php
//DADOS DO BANCO
$servidor = "localhost";
$usuario = "root";
$senha = "";
$db = "banco";
//DADOS QUE VEM DO FORMULÁRIO
$numero = $_POST['numero'];
$cpf = $_POST['cpf'];
$nomepet = $_POST['nomepet'];
$nomedono = $_POST['nomedono'];
$email = $_POST['email'];
$cep = $_POST['cep'];
$district = $_POST['bairro'];
$state = $_POST['uf'];
$city = $_POST['cidade'];
$street = $_POST['rua'];
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
  CURLOPT_POSTFIELDS => "{\"email\":\"$email\",\"name\":\"$nomedono\",\"phone\":$fone,\"phone_prefix\":85,\"cpf_cnpj\":\"$cpf\",\"zip_code\":\"$cep\",\"number\":\"0\",\"street\":\"$street\",\"city\":\"$city\",\"state\":\"$state\",\"district\":\"$district\"}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json"
  ],
]);

//Analisa a string codificada JSON e converte-a em uma variável do PHP.

$response = json_decode(curl_exec($curl));

$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {

//O response->id é a id do cliente que acabou de ser criado.

$cliente = $response->id;
//Exibe id do cliente, para saber se foi gerado.
//echo $cliente;

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
//Analisa a string codificada JSON e converte-a em uma variável do PHP.

$response = json_decode(curl_exec($curl));
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//COMUNICAÇÃO COM O BANCO, ADICIONA DADOS DO DONO E DO PET AO BANCO.
$conexao = mysqli_connect($servidor, $usuario, $senha, $db);

$insere = "INSERT INTO dono (nomedono, email, cep, fone, senha) VALUES ('$nomedono', '$email', '$cep','$fone', '$senha2')";

$insere2 = "INSERT INTO pet(nomepet, idade, peso, gramas, raca, score, plano, numero)
VALUES ('$nomepet', '$idade', '$peso', '$gramas', '$raca', '$score', '$plano', '$numero')";
mysqli_query($conexao, $insere);
mysqli_query($conexao, $insere2);

//CALCULO DO PLANO QUE SERÁ ENVIADO PARA FAZER A CONFIGURAÇÃO DO PLANO
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

//FINALIZANDO A LISTAGEM DOS PLANOS INICIANDO A CRIAÇÃO DO PLANO.
//REALIZANDO A ADIÇÃO DE MAIS UM NO ID DO ÚLTIMO PLANO
$idPlano = $response->totalItems + 1;

$planin = chamaplano($plano);

//CONVERTENDO OS VALORES ENCONTRADOS EM CENTAVO.
$valorPlano = $planin*100;

//echo "<br>" . $valorPlano;

}
}
//CRIA PLANO
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

//Analisa a string codificada JSON e converte-a em uma variável do PHP.

$response = json_decode(curl_exec($curl));
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

//Analisa a string codificada JSON e converte-a em uma variável do PHP.

$response = json_decode(curl_exec($curl));
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //RECEBE OS DADOS DO CARTÃO E TOKEN DE AUTORIZAÇÃO DO SERVIDOR DA YUGO.

  $assinatura = $response->id;
//IMPRIME O ID DA ASSINATURA
  //echo "Assinatura ".$assinatura."<br>";
  //IMPRIME O TOKEN RECEBIDO DA IUGO PARA FATURAR NO CARTÃO
  //echo $e."<br>";

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
//Analisa a string codificada JSON e converte-a em uma variável do PHP.

  $response = json_decode(curl_exec($curl));
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    //PEGA O ID DO METODO DE PAGAMENTO CRIADO.

    $pagamento = $response->id;

    //echo "ID pagamento ".$pagamento;

    //BUSCA A ASSINATURA CRIADA PARA PEGAR O CAMPO RECENTS_INVOICES
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
//Analisa a string codificada JSON e converte-a em uma variável do PHP.

$response = json_decode(curl_exec($curl));

$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//TODA A ASSINATURA
$recent_invoices_obj = $response->recent_invoices;
//Retorna a string contendo a representação JSON de um value.
$recent_invoices = json_encode($recent_invoices_obj);
//FILTREI A COBRANÇA RECENTE
$data2 = json_decode($recent_invoices);

$recent_invoices2 = $data2[0]->id;
//IMPRIME O ID DA COBRAÇA QUE SERÁ USADA NA COBRANÇA DIRETA.
//echo $recent_invoices2."FATURA GERADA<br>";
//EFETUANDO A COBRANÇA DIRETA
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

$response = json_decode(curl_exec($curl));

$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  
$mensagem =  $response->message;

$success = "Autorizado";

if ($mensagem == $success) {?>
  <div class="alert alert-success" role="alert">
  Transação autorizada no valor de <?php echo "<br>" . $valorPlano;?>
    </div>
    <?php
}else{?>
  <div class="alert alert-danger" role="alert">
  Transação negada no valor de <?php echo "<br>" . $planin;?>
    </div>
    <?php
}
}
}
  }
}
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
$url = 'http://localhost/MeusProjetos/iugo/cantinapet/redefinir.php';
//A variável $corpo é onde se encontra o texto do email, onde estamos informando em um link a
// url para onde o usuário será mandado ao clicar no link recebido no email e com um token único que
// foi gerado quando ele clicou em redefinir a senha.
$corpo = 'Olá ' . $info['nomedono'] . ', <br><br>
          O seu cadastro já foi realizado e logo entraremos em contato com você.<br><br>
          Se você tiver alguma dúvida no cadastro, pode nos contatar via WhatsApp pelo número <a href="https://api.whatsapp.com/send?phone=5585997617976">(85) 99761-7976</a>.<br><br>
          Seu pet vai amar <3.<br><br>
          Muito obrigado pela sua escolha.<br><br>
          Acesse o link abaixo para definir sua senha.<br><br>
          <a " href="' . $url . '?token=' . $_SESSION['token'] . '">Definir a sua senha</a>';

$informacoes = ['Assunto' => 'Cantina Pet - Confirmação de cadastro', 'Corpo' => $corpo];
$mail->formatarEmail($informacoes);

if ($mail->enviarEmail()) {
    $data['sucesso'] = true;
} else {
    $data['erro'] = true;
}

}