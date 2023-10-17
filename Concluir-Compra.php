<?php
include 'conexao.php';

$nome = $_POST['nome'];
$dataNascimento = $_POST['data_nascimento'];
$morada = $_POST['morada'];
$produtos = $_POST['produtos']; // Dados JSON
$precoTotal = $_POST['Preco_total'];

// Decodifique o JSON em um array associativo
$produtosJson = json_decode($produtos, true);

echo $nome;
echo $dataNascimento;
echo $morada;
echo $precoTotal;
print_r($produtosJson); // Use print_r para exibir um array no PHP

$sql = "INSERT INTO encomendas (nome, data_nascimento, morada, preco_total) VALUES ('$nome', '$dataNascimento', '$morada', '$precoTotal')";

if ($conexao->query($sql) === TRUE) {
    $encomendaId = $conexao->insert_id;

    if ($produtosJson !== null) {
        foreach ($produtosJson as $item) {
            // Os dados do item são acessados como $item['chave']
            $produtoId = $item[0]; // Produto ID
            $quantidade = $item[1]; // Quantidade

            $sql = "INSERT INTO produtos_encomendas (encomenda_id, produto_id, quantidade) VALUES ('$encomendaId', '$produtoId', '$quantidade')";
            $conexao->query($sql);
        }
    }

    echo "Encomenda registrada com sucesso!";
} else {
    echo "Erro ao registrar a encomenda: " . $conexao->error;
}

$conexao->close();
?>
