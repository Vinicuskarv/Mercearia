<?php
session_start();
include('conexao.php');

if (isset($_SESSION['usuario'])) {
} else {
    echo "Nenhum usuário logado.";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mercearia</title>
    <link rel="stylesheet" href="./master.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"crossorigin="anonymous">
    <link rel="stylesheet" href="./css/master.css">
    <link rel="stylesheet" href="./css/ADM.css">

</head>
<body>
    <nav>
        <ul class="NavBarTop">
            <li><a href="LOGIN.html">LOGIN</a></li>
            <li><a href="HOME.html">HOME</a></li>
            <li><a href="ADM.html">ADM</a></li>
        </ul>
    </nav>
    <div class ="TopAdm">
        <h1> <?php echo "Olá " . $_SESSION['usuario'] ?> </h1>
    </div>
    <div class= "CampoModifiq">
        <form action="adicionar_produto.php" method="post">
            <h4 for="username">Adicionar Produto</h4>
            <label for="username">Nome do produto</label><br>
            <input type="text" name="name" id="name" required><br>
            <label for="username">Quantidade</label><br>
            <input type="text" name="quantidade" id="quantidade" required><br>
            <label for="username">Preço</label><br>
            <input type="text" name="preco" id="preco" required><br>
            <label for="username">Imagem</label><br>
            <input type="text" name="imagem" id="imagem" required><br>
            <button class="ButtonMaster" type="submit">Entrar</button>
        </form>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"crossorigin="anonymous"></script>
</body>
</html>