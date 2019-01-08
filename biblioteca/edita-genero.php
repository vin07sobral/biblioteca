<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<?php
if (isset($_POST['botao-alterar'])) {
    $generoid = $_GET['edit_id'];
    $descricao = $_POST['descricao'];

    $editora->alterar($generoid, $descricao);
}
?>

<?php
if (isset($_GET['edit_id'])) {
    extract($genero->getID($_GET['edit_id']));
}
?>


<div class="container">

    <form method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-pencil text-primary"></i> Alteração do Registro</legend>
            <table class='table table-bordered'>
                <tr>
                    <td>Nome</td>
                    <td><input type='text' name='descricao' class='form-control' value="<?php echo $descricao; ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success" name="botao-alterar">
                            <span class="glyphicon glyphicon-edit"></span> Gravar a alteração
                        </button>
                        <a href="lista-genero.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>
            </table>
    </form>
</div>

<?php include_once 'rodape.php'; ?>