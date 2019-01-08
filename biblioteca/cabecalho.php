<?php
if (empty($_SESSION)) {// Se a sessao não estiver iniciada, iniciaremos! }
    session_start();
}

if (!isset($_SESSION['usuario'])) { //Se ainda não estiver logado
    header("Location: index.html"); // Enviamos para a página inicial
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Biblioteca</title>
        <!-- icone que aparecerá na aba do navegador-->
        <link rel="icon" type="image/ico" href="biblioteca.ico"/>
        <!--bootstrap -->
        <link href="Content/bootstrap/css/bootstrap.min.css" rel="stylesheet">   
        <link href="css/site.css" rel="stylesheet">   

        <script>
            function validarSenha() {
                NovaSenha = document.formCliente.senha.value;
                CNovaSenha = document.formCliente.csenha.value;
                if (NovaSenha !== CNovaSenha) {
                    alert("A senha e a confirmação da senha estão diferentes!");
                    return false;
                }
                return true;
            }

        </script>
    </head>

    <body>        
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Biblioteca</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="menu.php">Biblioteca</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="lista-emprestimo.php">Empréstimo</a></li>                        
                        <?php
                            if ($_SESSION['tipousuario'] == 'Administrador') {
                                echo'<li><a href="lista-livro.php">Livro</a></li>';
                                echo'<li><a href="lista-pessoa.php">Usuário</a></li>';
                                echo'<li><a href="lista-genero.php">Gênero</a></li>';
                                echo'<li><a href="lista-editora.php">Editora</a></li>';
                            }
                        ?>                                                
                        <!--<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="#">Separated link</a></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>-->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="edita-perfil.php"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> LogOff</a></li>
                    </ul>
                </div>
            </div>
          </nav>
    </body>
</html>