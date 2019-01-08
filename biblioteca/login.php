<?php

include_once 'bd.php';

if (empty($_SESSION)) {
    session_start();
}

if (isset($_POST['botao-login'])) {
    $usuario = $_POST['cpf'];
    $senha = $_POST['senha'];
    $login = $pessoa->validaLogin($usuario, $senha);
    if ($login) {
        extract($pessoa->getLogin($usuario));
        $_SESSION['tipousuario'] = $tipousuario;
        $_SESSION['usuario'] = $_POST['cpf'];
        header("Location: menu.php");
        exit;
    } else {
        echo "<SCRIPT> 
       alert('O usuário ou a senha informados são inválidos!');
       window.location = 'http://localhost/biblioteca';
    </SCRIPT>";
    }
}