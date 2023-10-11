<?php
session_start();

include 'conexao.php';

function buscarUsuario() {
    global $conexao;
    $query = "SELECT * FROM utilizador";
    $result = mysqli_query($conexao, $query);

    if (!$result) {
        die("Erro na busca de dados: " . mysqli_error($conexao));
    }

    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $usuarios = buscarUsuario();

    foreach ($usuarios as $usuario) {
        // Verifique as credenciais usando a função password_verify se as senhas estiverem criptografadas
        if ($usuario['Name'] == $username &&  $usuario['Password'] ==  $password) {
            $_SESSION['usuario'] = $usuario['Name'];

            header("Location: HOME.html");
            exit();
        }
    }

    echo "Credenciais inválidas. Tente novamente.";
}
?>
