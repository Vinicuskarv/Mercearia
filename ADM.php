<?php
session_start();
include('conexao.php');
include('verifica_login.php');

if (isset($_SESSION['usuario'])) {
} else {
    echo "Nenhum usuário logado.";
}
$query = "SELECT * FROM produto";
$result = mysqli_query($conexao, $query);
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

    <link rel="stylesheet" href="./css/ADM.css">

</head>
<body>
    <nav>
        <ul class="NavBarTop">
            <li><a href="LOGIN.php">LOGIN</a></li>
            <li><a href="HOME.php">HOME</a></li>
            <li><a href="ADM.php">ADM</a></li>
            <li><a href="logout.php">SAIR</a></li>
            
        </ul>
    </nav>
    <div class ="TopAdm">
        <h1> <?php echo "Olá " . $_SESSION['usuario'] ?> </h1>
    </div>
    <div class="container">
        <div class="row">
            <div class= "col CampoModifiq">
                <form action="adicionar_produto.php" method="post">
                    <h4 for="username">Adicionar Produto</h4>
                    <label for="username">Nome do produto</label><br>
                    <input type="text" name="name" id="name" required><br>
                    <label for="username">Quantidade</label><br>
                    <input type="text" name="quantidade" id="quantidade" required><br>
                    <label for="username">Preço</label><br>
                    <input type="float" name="preco" id="preco" required><br>
                    <label for="username">Imagem</label><br>
                    <input type="text" name="imagem" id="imagem" required><br>
                    <button class="ButtonMaster" type="submit">Adicionar</button>
                </form>
            </div>
            <div class= "col CampoModifiq" >
                <form>
                    <h4>Editar Produto</h4>
                    <label for="Id">ID Do produto</label><br>
                    <input type="text" name="Id" id="Id" required><br>
                    <button type="button" class="ButtonMaster" onclick="pesquisarProduto()">Pesquisar</button>
                    
                    <div id="resultadoPesquisa">
       
                    </div>
                </form>
            </div>
        </div><br><br>
        <div class="row justify-content-center">
            <div class="col col-lg-8 ">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Produtos</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Encomendas</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    
                    <table class="table table-striped table-hover">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                    </tr>
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['Nome']; ?></td>
                            <td><?php echo $row['Quantidade']; ?></td>
                            <td><?php echo number_format($row['Preco'], 2, '.', ',');?></td>
                        </tr>
                    <?php
                        }
                        } else {
                            echo "<p>Não tem produtos.</p>";
                        }
                    ?>
                    </table>
                
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">...</div>
                <div>
            </div>
        <div>
    </div>
    
    <script>
        function pesquisarProduto() {
            var produtoId = document.getElementById("Id").value;
            var resultadoPesquisa = document.getElementById("resultadoPesquisa");
            
            var xhr = new XMLHttpRequest();
            
            xhr.open("GET", "pesquisa_item.php?id=" + produtoId, true);
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    resultadoPesquisa.innerHTML = xhr.responseText;
                }
            };
            
            xhr.send();
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"crossorigin="anonymous"></script>
</body>
</html>