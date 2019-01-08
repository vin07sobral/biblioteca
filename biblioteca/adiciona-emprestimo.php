<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<?php
if (isset($_POST['botao-salvar'])) {
    $livroid = $_POST['livroid'];
    $pessoaid = $_POST['pessoaid'];
    $dataemprestimo = $_POST['dataemprestimo'];
    $datadevolucao = $_POST['datadevolucao'];    

    $emprestimo->inserir($livroid,$pessoaid,$datadevolucao,$dataemprestimo);
}
?>



<div class="container">


    <form name="formGrupo" method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-plus text-primary"></i> Novo Registro</legend>
            <table class='table'>

                <tr>
                    <td>Livro</td>
                    <td><select name="livroid" required class='form-control'>
                            <option value="">Selecione...</option>
                            <?php $livro->combo(0); ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Pessoa</td>
                    <td><select name="pessoaid" required class='form-control'>
                            <option value="">Selecione...</option>
                            <?php $pessoa->combo(0); ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Data empréstimo</td>
                    <td><input type='date' name='dataemprestimo' class='form-control' required ></td>
                </tr>
                <tr>
                    <td>Data devolução</td>
                    <td><input type='date' name='datadevolucao' class='form-control' required ></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success" name="botao-salvar">
                            <span class="glyphicon glyphicon-save-file"></span> Salvar
                        </button>  
                        <a href="lista-emprestimo.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>

            </table>
        </fieldset>
    </form>


</div>

<?php include_once 'rodape.php'; ?>