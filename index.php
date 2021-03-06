<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Assinatura | CantinaPET</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script type="text/javascript" src="https://js.iugu.com/v2"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script type="text/javascript" src="js.js"></script>
            <script type="text/javascript" src="formatter.min.js"></script>
            <script type="text/javascript" src="jquery.js"></script>
            <link rel="stylesheet" type="text/css" href="css.css"/>
            <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>


</head>
<body>

<div class="container">
    <header>Assinatura | CantinaPET</header>
    <div class="progress-bar">
        <div class="step">
            <p>
                Sobre mim
            </p>
            <div class="bullet">
                <span>1</span>
            </div>
            <div class="check fas fa-check"></div>
        </div>
        <div class="step">
            <p>
                Meus pets
            </p>
            <div class="bullet">
                <span>2</span>
            </div>
            <div class="check fas fa-check"></div>
        </div>
        <div class="step">
            <p>
                Plano
            </p>
            <div class="bullet">
                <span>3</span>
            </div>
            <div class="check fas fa-check"></div>
        </div>
        <div class="step">
            <p>
                Checkout
            </p>
            <div class="bullet">
                <span>4</span>
            </div>
            <div class="check fas fa-check"></div>
        </div>
    </div>
    <div class="form-outer">
        <form action="processa.php" id="payment-form" method="post">
            <div class="page slide-page">
                <div class="title">
                    Nutri????o de qualidade ?? um gesto de amor
                </div>
                <div align="center">
                    <div class="form-inline field">
                        <div class="form-check">
                            <label>Eu tenho </label>
                            <input name="numero" style="width: 50px" type="text" placeholder="1" />
                            <label>cachorro de nome</label>
                            <input name="nomepet" id="nomepet" style="width: 150px" type="text" placeholder="Nome do pet" />
                            <label>CPF:</label>
                            <input name="cpf" id="cpf" style="width: 100px" type="text" placeholder="cpf" />
                        </div>
                    </div>
                </div>

                <div class="form-inline field">
                    <div class="form-check">
                        <label>Meu nome ?? </label>
                        <input name="nomedono" style="width: 150px" type="text" placeholder="seu nome" />
                        <label> e meu email ?? </label>
                        <input name="email" style="width: 250px" type="email" placeholder="seu email"/>
                    </div>
                </div>

                <div class="form-inline field">
                    <div class="form-check">
                        <label>Meu CEP ?? </label>
                        <input id="cep" name="cep" style="width: 150px" type="text" placeholder="60860-000"/>
                        <input id="rua" name="rua" type="hidden"/>
                        <input id="bairro" name="bairro" type="hidden"/>
                        <input id="cidade" name="cidade" type="hidden"/>
                        <input id="uf" name="uf" type="hidden"/>
                        
                        <label> e meu n??mero ?? </label>
                        <input name="fone" style="width: 150px" type="text" placeholder="99999-9999"/>
                    </div>
                </div>

                <div class="field">
                    <button class="firstNext next" onclick="myfunction()">Continuar</button>
                </div>
            </div>
            <div class="page">
                <div class="form-inline field">
                    <div class="form-check">
                        <!--Aqui vem o nome do pet recuperado do banco-->
                        <h3 id=pnome></h3>
                        <label> tem </label>
                        <input name="idade" style="width: 30px" type="text"  />
                        <label> anos e pesa </label>
                        <input name="peso" style="width: 50px" type="text" />
                        <label> kg </label>
                        <input name="gramas" style="width: 50px" type="text" />
                        <label> g </label>
                    </div>
                </div>

                <div class="form-inline field">
                    <div class="form-check">
                        <!--Aqui vem o nome do pet recuperado do banco-->
                        <h3 id=pnome2></h3><br>
                        <label>?? da ra??a </label>
                        <select name="raca" style="width: 220px">
                            <option value="GOLDEN">GOLDEN</option>
                            <option value="POODLE">POODLE</option>
                            <option value="PINSCHER">PINSCHER</option>
                            <option value="SRD">SRD</option>
                        </select>
                    </div>
                </div>

                <div class="form-inline field">
                    <div class="form-check">
                        <label>Qual score </label>
                        <!--<input name="score" style="width: 80px" type="text" placeholder="Kira" />-->
                        <label> se encontra hoje?</label>
                    </div>
                </div>

                <div>
                    <input value="1" type="radio" name="score" id="i1" />
                    <label for="i1"><img src="http://vkontakte.ru/images/gifts/256/81.jpg" alt=""></label>
                    <input value="2" type="radio" name="score" id="i2" />
                    <label for="i2"><img src="http://vkontakte.ru/images/gifts/256/82.jpg" alt=""></label>
                    <input value="3" type="radio" name="score" id="i3" />
                    <label for="i3"><img src="http://vkontakte.ru/images/gifts/256/83.jpg" alt=""></label>
                </div>

                <div class="field btns">
                    <button class="prev-1 prev">Anterior</button>
                    <button class="next-1 next">Continuar</button>
                </div>
            </div>
            <div class="page">
                <div class="title form-check">
                    Plano Mensal da <span>Kira</span>
                </div>
                <div style="margin-top: 50px;">
                    <input value="r1" type="radio" name="plano" id="plano" />
                    <label for="i1"><img src="http://vkontakte.ru/images/gifts/256/81.jpg" alt=""></label>
                    <input value="r2" type="radio" name="plano" id="plano" />
                    <label for="i2"><img src="http://vkontakte.ru/images/gifts/256/82.jpg" alt=""></label>
                    <input value="r3" type="radio" name="plano" id="plano" />
                    <label for="i3"><img src="http://vkontakte.ru/images/gifts/256/83.jpg" alt=""></label>
                </div>

                <div class="field btns">
                    <button class="prev-2 prev">Anterior</button>
                    <button class="next-2 next">Continuar</button>
                </div>
            </div>
            <div class="page">
            

    <div class="usable-creditcard-form">
      <div class="wrapper">
        <div class="input-group nmb_a">
          <div class="icon ccic-brand"></div>
            <input autocomplete="off" class="credit_card_number" data-iugu="number" placeholder="N??mero do Cart??o" type="text" value="" />
          </div>
        <div class="input-group nmb_b">
          <div class="icon ccic-cvv"></div>
            <input autocomplete="off" class="credit_card_cvv" data-iugu="verification_value" placeholder="CVV" type="text" value="" />
        </div>
        <div class="input-group nmb_c">
          <div class="icon ccic-name"></div>
            <input class="credit_card_name" data-iugu="full_name" placeholder="Titular do Cart??o" type="text" value="" />
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
        <label for="token"></label>
        <input type="hidden" name="token" id="token" value="" readonly="true" size="64" style="text-align:center" />
    </div>
       
    
                <div class="field btns">
                    <button class="prev-3 prev">Anterior</button>
                    <button class="submit" type="submit">Completar assinatura</button>
                </div>
            </div>
        </form>
    </div>
</div>
    <!-- Adicionando Javascript -->
    <script>

        $(document).ready(function() {

            function limpa_formul??rio_cep() {
                // Limpa valores do formul??rio de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova vari??vel "cep" somente com d??gitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Express??o regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado n??o foi encontrado.
                                limpa_formul??rio_cep();
                                alert("CEP n??o encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep ?? inv??lido.
                        limpa_formul??rio_cep();
                        alert("Formato de CEP inv??lido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formul??rio.
                    limpa_formul??rio_cep();
                }
            });
        });

    </script>
<script src="script.js"></script>
<script>
function myfunction(){
    var input = document.querySelector('#nomepet');
    var texto = input.value;
    document.getElementById("pnome").innerHTML = texto;
    document.getElementById("pnome2").innerHTML = texto;
}
</script>
</body>
</html>