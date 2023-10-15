<?php
session_start();
include('verifica_is_adm.php');
$query = "SELECT * FROM produto";
$result = mysqli_query($conexao, $query);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercearia</title>
    <link rel="stylesheet" href="./master.css">
    <link rel="stylesheet" href="./css/HOME.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"crossorigin="anonymous">
</head>
<body>
    <nav>
        <ul class="NavBarTop">
            <li><a href="LOGIN.php">LOGIN</a></li>
            <li><a href="HOME.php">HOME</a></li>
            <?php
                if(isset($_SESSION['modo_adm'])):
            ?>
            <li><a href="ADM.php">ADM</a></li>
            
            <li><a href="logout.php">SAIR</a></li>
            <?php
                endif;
                unset($_SESSION['modo_adm']);
            ?>
            <button type="submit" class="ButtonCartStory" onClick="AbrirDivInfo()"><img src="./Icons/icons8-shopping-cart-30.png" alt="produtos"><label id="CartNumber"></label></button>
        </ul>
    </nav>
    <div class="container-fluid CampoTop">
        <div>
            <h1>ORGANIC</h1>
            <p>A comida orgânica é uma opção saudável e sustentável, cultivada sem pesticidas sintéticos e respeitando o meio ambiente.</p>
        </div>
    </div>
    <div class="CartCamp">
        <div id="CartProdutos"></div><br>
        <button class="ButtonCloseCart" onClick="FecharDivInfo()">X</button>
        <form class="campEcomendas" id="campEcomendas" action="adicionar_ecomenda.php" method="post">
            <input type="hidden" name="meuArrayInput" id="meuArrayInput" value="">
            <button type="submit" class="buttoAdicionareEcomenda">Confirmar</button>
            <button type="button" class="buttoAdicionareEcomenda" onClick="EscluirCart()">Excluir Carrinho</button>
        </form>
        </div>
    <header class="container CampoCards">
        <section class="row" id="produtos">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col col-md-4 col-sm-6 ">
                <div class="card">
                    <?php
                        $mostrarDiv = isset($_SESSION['modo_admTwo']);

                        if ($mostrarDiv == 1) {
                            echo '<form class="btnExcluirPrd" action="excluir_produto.php" method="post">
                                <input type="hidden" name="id" id="id" value="' . $row['id'] . '" required>
                                <button type="submit" class="buttoExcluirProduto">X</button>
                            </form>';
                        }
                    ?>
                    <div style="background-image: url('<?php echo $row['Img']; ?>')" class="card-img-top" alt="Img produto"></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['Nome']; ?></h5>
                        <p>€ <?php echo number_format($row['Preco'], 2, '.', ','); ?></p>
                        <label class="CardHoverlabel">Stock: <?php echo $row['Quantidade']; ?></label>

                        <div class="CardHover" >
                            <?php
                                if ($row['Quantidade'] > 0){
                            ?>
                            <div>
                            <input type="number" name="quantidade" id="quantidade-<?php echo $row['id'] ?>" >
                            
                            <input type="hidden" name="Preco" value="<?php echo number_format($row['Preco'], 2, '.', ','); ?>" id="valor-<?php echo $row['id'] ?>">
                            <input type="hidden" name="Nome" value="<?php echo $row['Nome']; ?>" id="nome-<?php echo $row['id'] ?>">
                            <input type="hidden" name="Quantidade" value="<?php echo $row['Quantidade']; ?>" id="quantidade-atual-<?php echo $row['id'] ?>">

                            <button type="submit" class="ButtonCart addToCartButton" data-product-id="<?php echo $row['id'] ?>"><img src="./Icons/icons8-shopping-cart-30.png"  alt="Img produto"></button>
                            </div>
                            <?php
                                } else {
                            ?>
                            <label>Não há stock</label>
                            <?php
                                }
                            ?>
                            <div class ="CardHovInf" id="CardHovInf-<?php echo $row['id'] ?>"></div>
                        </div>      
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
            echo "<p>Não tem produtos.</p>";
        }
        ?>
        </section>
        
    </header>

    <script>
        var carrinho = [];
        var PrecoTotal = 0;

        document.getElementById('meuArrayInput').value = JSON.stringify(carrinho);

        function EscluirCart() {
            carrinho = [];
            var exibicao = document.getElementById('CartProdutos');
            while (exibicao.firstChild) {
                exibicao.removeChild(exibicao.firstChild);
            }
            atualizarQuantidade();
        }

        function AbrirDivInfo() {
            var CartCampo = document.querySelectorAll('.CartCamp');
            
            CartCampo.forEach(function(element) {
                element.classList.add('CardCampOn');
            });
        }
        function FecharDivInfo() {
            var CartCampo = document.querySelectorAll('.CartCamp');
            
            CartCampo.forEach(function(element) {
                element.classList.remove('CardCampOn');
            });
        }

        function atualizarExibicao(array) {
            var exibicao = document.getElementById('CartProdutos');
            exibicao.innerHTML = '';

            array.forEach(function (item) {
                
                var linha = document.createElement('p');
                linha.textContent = item[3] + ', Quantidade: ' + item[1] + ', Preço: ' + item[2];
                exibicao.appendChild(linha);

                var precoUnido = item[2] * item[1];
                PrecoTotal += precoUnido;
            });

            var precoTotalFormatado = PrecoTotal.toFixed(2);
            var totalLinha = document.createElement('p');
            totalLinha.textContent = 'Preço Total: ' + precoTotalFormatado;
            exibicao.appendChild(totalLinha);
        }



        function atualizarQuantidade() {
            var quantidadeItens = document.getElementById('CartNumber');
            quantidadeItens.textContent = carrinho.length;
        }

        atualizarQuantidade();

        var addToCartButtons = document.querySelectorAll('.addToCartButton');

        addToCartButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var produtoId = this.getAttribute('data-product-id');
                var quantidadeInput = document.querySelector('#quantidade-'+produtoId);
                var valorInput = document.querySelector('#valor-'+produtoId);
                var NomeInput = document.querySelector('#nome-'+produtoId);
                var quantidadeAtual = document.querySelector('#quantidade-atual-'+produtoId);
                var exibi= document.getElementById('CardHovInf-'+produtoId);


                if (quantidadeInput) {
                    var quantidade = parseInt(quantidadeInput.value);
                    var valor = valorInput.value;
                    var nome = NomeInput.value;
                    var QAtual = quantidadeAtual.value;
                    console.log(QAtual);

                    if (!isNaN(quantidade) && quantidade > 0) {
                        if (quantidade <= QAtual){
                            carrinho.push([produtoId, quantidade, valor, nome]);
                            atualizarQuantidade();
                            atualizarExibicao(carrinho);
                            document.getElementById('meuArrayInput').value = JSON.stringify(carrinho);

                            quantidadeInput.value = "";
                            valorInput.value = "";
                            while (exibi.firstChild) {
                                exibi.removeChild(exibi.firstChild);
                            }
                        }else{
                            while (exibi.firstChild) {
                                exibi.removeChild(exibi.firstChild);
                            }
                            var aviso = document.createElement('p');
                            aviso.textContent = "Stock atual: " + QAtual;
                            aviso.style.color = 'black'; 

                            exibi.appendChild(aviso);
                        }
                    } else {
                        while (exibi.firstChild) {
                                exibi.removeChild(exibi.firstChild);
                            }
                        var aviso = document.createElement('p');
                            aviso.textContent = "Valor Invalido";
                            aviso.style.color = 'black'; 
                            exibi.appendChild(aviso);

                    }
                } else {
                    console.log("Campo de entrada não encontrado para o produto com ID " + produtoId);
                }
            });
        });
    </script>   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"crossorigin="anonymous"></script>
</body>
</html>