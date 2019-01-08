<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<!-- tratamento para alterar o registro -->
<?php
if (isset($_POST['botao-alterar'])) {
    $id = $_GET['edit_id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $tipousuario = $_POST['tipousuario'];
    $senha = $_POST['senha'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $cep = $_POST['cep'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];

    $pessoa->alterar($id, $nome, $cpf, $tipousuario, $senha, $endereco, $numero, $numero, $complemento, $cep, $celular, $email);
}
?>

<!-- obtendo os dados para alteração -->
<?php
if (isset($_GET['edit_id'])) {
    extract($pessoa->getID($_GET['edit_id']));
}
?>


<div class="container">

    <form method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-pencil text-primary"></i> Alteração do Registro</legend>
            <table class='table table-bordered'>

                <tr>
                    <td>Nome</td>
                    <td><input type='text' name='nome' class='form-control' value="<?php echo $nome; ?>" required></td>
                </tr>

                <tr>
                    <td>CPF</td>
                    <td><input type='text' name='cpf' class='form-control' value="<?php echo $cpf; ?>" required></td>
                </tr>

                <tr>
                    <td>Tipo Usuário</td>
                    <td><input type='text' name='tipousuario' class='form-control' value="<?php echo $tipousuario; ?>" required></td>
                </tr>

                <tr>
                    <td>Senha</td>
                    <td><input type='password' name='senha' class='form-control' value="<?php echo $senha; ?>" required></td>
                </tr>

                <tr>
                    <td>Endereço</td>
                    <td><input type='text' name='endereco' class='form-control' value="<?php echo $endereco; ?>" required></td>
                </tr>

                <tr>
                    <td>Número</td>
                    <td><input type='text' name='numero' class='form-control' value="<?php echo $numero; ?>" required></td>
                </tr>

                <tr>
                    <td>Complemeto</td>
                    <td><input type='text' name='complemento' class='form-control' value="<?php echo $complemento; ?>" required></td>
                </tr>

                <tr>
                    <td>CEP</td>
                    <td><input type='text' name='cep' class='form-control' value="<?php echo $cep; ?>" required></td>
                </tr>

                <tr>
                    <td>Celular</td>
                    <td><input type='text' name='celular' class='form-control' value="<?php echo $celular; ?>" required></td>
                </tr>

                <tr>
                    <td>E-mail</td>
                    <td><input type='text' name='email' class='form-control' value="<?php echo $email; ?>" required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success" name="botao-alterar">
                            <span class="glyphicon glyphicon-edit"></span> Gravar a alteração
                        </button>
                        <a href="lista-pessoa.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>
            </table>
    </form>
</div>

<?php include_once 'rodape.php'; ?>