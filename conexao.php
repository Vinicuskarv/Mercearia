<?php
define('HOST', '127.0.0.1:8111');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'Mercearia');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possivel conectar');

?>
