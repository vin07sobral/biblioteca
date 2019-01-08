<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<?php
if (isset($_POST['botao-salvar'])) {
    $descricao = $_POST['descricao'];

    $genero->inserir($descricao);
}
?>



<div class="container">


    <form name="formGrupo" method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-plus text-primary"></i> Novo Registro</legend>
            <table class='table'>

                <tr>
                    <td>Descrição</td>
                    <td><input type='text' name='descricao' class='form-control' required autofocus placeholder="Descrição gênero" maxlength="50"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success" name="botao-salvar">
                            <span class="glyphicon glyphicon-save-file"></span> Salvar
                        </button>  
                        <a href="lista-genero.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>

            </table>
        </fieldset>
    </form>


</div>

<?php include_once 'rodape.php'; ?>