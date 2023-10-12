
<?php
require_once 'conexao.php';
$query = "SELECT * FROM produto";
$result = mysqli_query($conexao, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col col-md-4 col-sm-6 ">
                <div class="card">
                    <img src="<?php echo $row['Img']; ?>" class="card-img-top" alt="Img produto">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['Nome']; ?></h5>
                        <p>€ <?php echo number_format($row['Preco'], 2, '.', ','); ?></p>
                        <div class="CardHover">
                            <div>
                                <button type="button">-</button>
                                    <label>2</label>
                                <button type="button">+</button>
                            </div>
                            
                            <button type="submit" class="ButtonCart"><img src="./Icons/icons8-shopping-cart-30.png"  alt="Img produto"></button>
                        </div>
                    </div>
                </div>
            </div>

        <?php
    }
} else {
    echo "<p>Nenhuma notícia encontrada.</p>";
}
?>
