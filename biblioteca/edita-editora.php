<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<?php
if (isset($_POST['botao-alterar'])) {
    $id = $_GET['edit_id'];
    $nome = $_POST['nome'];

    $editora->alterar($id, $nome);
}
?>

<?php
if (isset($_GET['edit_id'])) {
    extract($editora->getID($_GET['edit_id']));
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