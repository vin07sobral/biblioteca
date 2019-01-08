<?php
//conexão do banco
$DB_servidor="localhost";
$DB_usuario="root";
$DB_senha="root";
$DB_nome="bdbiblioteca";

try {
    $DB_con = new PDO("mysql:host={$DB_servidor};dbname={$DB_nome}",$DB_usuario,$DB_senha);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $e->getMessage();
}

include_once 'crud.php';

$editora = new editora($DB_con);        //ok
$pessoa = new pessoa($DB_con);          //ok
$autor = new autor($DB_con);            //ok
$livro = new livro($DB_con);            //ok
$genero = new genero($DB_con);          //ok
$emprestimo = new emprestimo($DB_con);  //ok
$autorlivro = new autorlivro($DB_con);
$linguagem = new linguagem($DB_con);
/*

$linguagem = new linguagem(DB_con); //analisar necessidade

*/?>