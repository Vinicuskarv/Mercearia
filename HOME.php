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
            <button type="submit" class="ButtonCartStory"><img src="./Icons/icons8-shopping-cart-30.png" alt="produtos"><label>2</label></button>

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
                        <div class="CardHover">
                            <input type="number" name="quantidade" id="quantidade">
                            <button type="submit" class="ButtonCart"><img src="./Icons/icons8-shopping-cart-30.png"  alt="Img produto"></button>
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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"crossorigin="anonymous"></script>
</body>
</html>