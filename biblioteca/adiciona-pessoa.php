<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<?php
if (isset($_POST['botao-salvar'])) {
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

    $pessoa->inserir($nome, $cpf, $tipousuario, $senha, $endereco, $numero, $numero, $complemento, $cep, $celular, $email);
}
?>



<div class="container">


    <form name="formGrupo" method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-plus text-primary"></i> Novo Registro</legend>
            <table class='table'>

                <tr>
                    <td>Nome</td>
                    <td><input type='text' name='nome' class='form-control' required autofocus placeholder="Nome Completo" maxlength="100"></td>
                </tr>

                <tr>
                    <td>CPF</td>
                    <td><input type='text' name='cpf' class='form-control'required maxlength="20" placeholder="CPF do Usuário"></td>
                </tr>

                <tr>
                    <td>Tipo usuário</td>
                    <td><input type='text' name='tipousuario' class='form-control' required maxlength="50" placeholder="Tipo Usuário(Administrador, Aluno, Funcionário)"></td>
                </tr>

                <tr>
                    <td>Senha</td>
                    <td><input type='password' name='senha' class='form-control' required maxlength="20" placeholder="Senha para o login"></td>
                </tr>
                <tr>
                    <td>Confirmação da Senha</td>
                    <td><input type='password' name='csenha' class='form-control' required maxlength="20" placeholder="Confirmação da Senha"></td>
                </tr>
                <tr>
                    <td>Endereço</td>
                    <td><input type='text' name='endereco' class='form-control' required maxlength="20" placeholder="Endereço do Usuário"></td>
                </tr>
                <tr>
                    <td>Número</td>
                    <td><input type='text' name='numero' class='form-control' required maxlength="20" placeholder="Número da casa do Usuário"></td>
                </tr>
                <tr>
                    <td>Complemento</td>
                    <td><input type='text' name='complemento' class='form-control' maxlength="100" placeholder="Complemento"></td>
                </tr>
                <tr>
                    <td>CEP</td>
                    <td><input type='text' name='cep' class='form-control' required maxlength="10" placeholder="CEP"></td>
                </tr>
                <tr>
                    <td>Celular</td>
                    <td><input type='text' name='celular' class='form-control' maxlength="15" placeholder="Celular"></td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td><input type='text' name='email' class='form-control' required maxlength="100" placeholder="E-mail"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success" name="botao-salvar">
                            <span class="glyphicon glyphicon-save-file"></span> Salvar
                        </button>  
                        <a href="lista-pessoa.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>

            </table>
        </fieldset>
    </form>
</div>

<?php include_once 'rodape.php'; ?>