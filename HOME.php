<?php
session_start();
include('verifica_is_adm.php');

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
        </ul>
    </nav>
    <div class="container-fluid CampoTop">
        <div>
            <h1>ORGANIC</h1>
            <p>A comida orgânica é uma opção saudável e sustentável, cultivada sem pesticidas sintéticos e respeitando o meio ambiente.</p>
            <input class="ButtonMaster" type="button" value="Sobre">
        </div>
        
    </div>
    <header class="container CampoCards">
        <section class="row" id="noticias-produto">
            <div class="col col-md-4 col-sm-6 ">
                <div class="card ">
                    <img src="./Img/13e873ab90ad6d139718b00561bcdb80.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            
        </section>
    </header>
    <script>
        // Função para chamar os valores com AJAX
        function carregarProduto() {
        // Cria uma instância do objeto XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Define a função de callback para manipular a resposta do AJAX
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
            // A resposta do AJAX foi recebida com sucesso
            var noticiasContainer = document.getElementById("noticias-produto");
            noticiasContainer.innerHTML = xhr.responseText;
            }
        };

        // Faz a requisição AJAX
        xhr.open("GET", "mostrar_produto.php", true);
        xhr.send();
        }
        window.onload = function() {
            carregarProduto();
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"crossorigin="anonymous"></script>
</body>
</html>