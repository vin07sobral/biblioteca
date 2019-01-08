<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<?php
if (isset($_POST['botao-salvar'])) {
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];

    $autor->inserir($nome, $nacionalidade);
}
?>



<div class="container">


    <form name="formGrupo" method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-plus text-primary"></i> Novo Registro</legend>
            <table class='table'>

                <tr>
                    <td>Nome</td>
                    <td><input type='text' name='nome' class='form-control' required autofocus placeholder="Nome do autor" maxlength="50"></td>
                </tr>
                
                <tr>
                    <td>Nacionalidade</td>
                    <td><input type='text' name='nacionalidade' class='form-control' required autofocus placeholder="Nacionalidade do autor" maxlength="50"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success" name="botao-salvar">
                            <span class="glyphicon glyphicon-save-file"></span> Salvar
                        </button>  
                        <a href="lista-autor.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>

            </table>
        </fieldset>
    </form>


</div>

<?php include_once 'rodape.php'; ?>