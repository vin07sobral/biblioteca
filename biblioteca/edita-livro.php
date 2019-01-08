<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<?php
if (isset($_POST['botao-alterar'])) {
    $livroid = $_GET['edit_id'];
    $nome = $_POST['nome'];
    $qtdpagina = $_POST['qtdpagina'];
    $editoraid = $_POST['editoraid'];
    $linguagemid = $_POST['linguagemid'];
    $generoid = $_POST['generoid'];
    $anopublicacao = $_POST['anopublicacao'];
    $edicao = $_POST['edicao'];

    $livro->alterar($livroid, $nome, $qtdpagina,$editoraid,$linguagemid,$generoid,$anopublicacao,$edicao);
}
?>

<?php
if (isset($_GET['edit_id'])) {
    extract($livro->getID($_GET['edit_id']));
}
?>


<div class="container">

    <form method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-pencil text-primary"></i> Alteração do Registro</legend>
            <table class='table table-bordered'>

                <tr>
                    <td>Título</td>
                    <td><input type='text' name='nome' class='form-control' value="<?php echo $nome; ?>" required></td>
                </tr>
                <tr>
                    <td>Páginas</td>
                    <td><input type='number' name='qtdpagina' class='form-control' value="<?php echo $qtdpagina; ?>" required></td>
                </tr>
                <tr>
                    <td>Editora</td>
                        <td><select name="editoraid" required class='form-control'>
                        <option value="">Selecione...</option>
                        <?php $editora->combo($editoraid); ?>
                        </select>
                        </td>
                 </tr>
                <tr>
                    <td>Linguagem</td>
                        <td><select name="linguagemid" required class='form-control'>
                        <option value="">Selecione...</option>
                        <?php $linguagem->combo($linguagemid); ?>
                        </select>
                        </td>
                 </tr>
                <tr>
                    <td>Gênero</td>
                        <td><select name="generoid" required class='form-control'>
                        <option value="">Selecione...</option>
                        <?php $genero->combo($generoid); ?>
                        </select>
                        </td>
                 </tr>
                <tr>
                    <td>Ano Publicação</td>
                    <td><input type='date' name='anopublicacao' class='form-control' value="<?php echo $anopublicacao; ?>" required></td>
                </tr>
                <tr>
                    <td>Edição</td>
                    <td><input type='text' name='edicao' class='form-control' value="<?php echo $edicao; ?>" required></td>
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