<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<?php
if (isset($_POST['botao-alterar'])) {
    $emprestimoid = $_GET['emprestimoid'];
    $livroid = $_POST['livroid'];
    $pessoaid = $_POST['pessoaid'];
    $dataemprestimo = $_POST['dataemprestimo'];
    $datadevolucao = $_POST['datadevolucao'];     

    $emprestimo->inserir($emprestimoid,$livroid,$pessoaid,$datadevolucao,$dataemprestimo);
}
?>

<?php
if (isset($_GET['edit_id'])) {
    extract($emprestimo->getID($_GET['edit_id']));
}
?>



<div class="container">

    <form method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-pencil text-primary"></i> Alteração do Registro</legend>
            <table class='table table-bordered'>

                <tr>
                    <td>Livro</td>
                    <td><select name="livroid" required class='form-control'>
                            <option value="">Selecione...</option>
                            <?php $livro->combo($livroid); ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Pessoa</td>
                    <td><select name="pessoaid" required class='form-control'>
                            <option value="">Selecione...</option>
                            <?php $pessoa->combo($pessoaid); ?>
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
                        <button type="submit" class="btn btn-success" name="botao-alterar">
                            <span class="glyphicon glyphicon-edit"></span> Gravar a alteração
                        </button>
                        <a href="lista-editora.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>

            </table>
    </form>
</div>

<?php include_once 'rodape.php'; ?>