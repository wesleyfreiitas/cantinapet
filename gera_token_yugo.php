<!--
Using Formatter.js - Iugu detecta e melhora o input de Cartão:
http://firstopinion.github.io/formatter.js/
-->
<script type="text/javascript" src="https://js.iugu.com/v2"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="js.js"></script>
<script type="text/javascript" src="formatter.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<link rel="stylesheet" type="text/css" href="css.css"/>

<form id="payment-form" target="_blank" action="http://localhost/MeusProjetos/iugo/recebe_dados_cartao.php" method="POST">
    <div class="usable-creditcard-form">
      <div class="wrapper">
        <div class="input-group nmb_a">
          <div class="icon ccic-brand"></div>
            <input autocomplete="off" class="credit_card_number" data-iugu="number" placeholder="Número do Cartão" type="text" value="" />
          </div>
        <div class="input-group nmb_b">
          <div class="icon ccic-cvv"></div>
            <input autocomplete="off" class="credit_card_cvv" data-iugu="verification_value" placeholder="CVV" type="text" value="" />
        </div>
        <div class="input-group nmb_c">
          <div class="icon ccic-name"></div>
            <input class="credit_card_name" data-iugu="full_name" placeholder="Titular do Cartão" type="text" value="" />
        </div>
        <div class="input-group nmb_d">
          <div class="icon ccic-exp"></div>
            <input autocomplete="off" class="credit_card_expiration" data-iugu="expiration" placeholder="MM/AA" type="text" value="" />
        </div>
      </div>
      <div class="footer">
        <img src="https://s3-sa-east-1.amazonaws.com/storage.pupui.com.br/9CA0F40E971643D1B7C8DE46BBC18396/assets/cc-icons.e8f4c6b4db3cc0869fa93ad535acbfe7.png" alt="Visa, Master, Diners. Amex" border="0" />
        <a class="iugu-btn" href="http://iugu.com" tabindex="-1"><img src="https://s3-sa-east-1.amazonaws.com/storage.pupui.com.br/9CA0F40E971643D1B7C8DE46BBC18396/assets/payments-by-iugu.1GiLK6uTXqj2u1nA8bvXt4QLn7HCx7eety.png" alt="Pagamentos por Iugu" border="0" /></a>
      </div>
    </div>

    <div class="token-area">
        <label for="token">Token do Cartão de Crédito - Enviar para seu Servidor</label>
        <input type="text" name="token" id="token" value="" readonly="true" size="64" style="text-align:center" />
    </div>
       
    <div>
        <button type="submit">Salvar</button>
    </div>
            
  </form>
