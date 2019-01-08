<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<?php
if (isset($_POST['botao-salvar'])) {
    $nome = $_POST['nome'];
    $qtdpagina = $_POST['qtdpagina'];
    $editoraid = $_POST['editoraid'];
    $linguagemid = $_POST['linguagemid'];
    $generoid = $_POST['generoid'];
    $anopublicacao = $_POST['anopublicacao'];
    $edicao = $_POST['edicao'];

    $livro->inserir($nome,$qtdpagina,$editoraid,$linguagemid,$generoid,$anopublicacao,$edicao);
}
?>



<div class="container">


    <form name="formGrupo" method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-plus text-primary"></i> Novo Registro</legend>
            <table class='table'>

                <tr>
                    <td>Título</td>
                    <td><input type='text' name='nome' class='form-control' required autofocus placeholder="Título do livro" maxlength="50"></td>
                </tr>

                <tr>
                    <td>Páginas</td>
                    <td><input type='number' name='qtdpagina' class='form-control' required autofocus placeholder="Quantidade páginas"></td>
                </tr>

                <tr>
                    <td>Editora</td>
                    <td><select name="editoraid" required class='form-control'>
                            <option value="">Selecione...</option>
                            <?php $editora->combo(0); ?>
                        </select></td>
                </tr>

                <tr>
                    <td>Linguagem</td>
                    <td><select name="linguagemid" required class='form-control'>
                            <option value="">Selecione...</option>
                            <?php $linguagem->combo(0); ?>
                        </select></td>
                </tr>

                <tr>
                    <td>Gênero</td>
                    <td><select name="generoid" required class='form-control'>
                            <option value="">Selecione...</option>
                            <?php $genero->combo(0); ?>
                        </select></td>
                </tr>

                <tr>
                    <td>Ano publicação</td>
                    <td><input type='date' name='anopublicacao' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Edição</td>
                    <td><input type='number' name='edicao' class='form-control' required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success" name="botao-salvar">
                            <span class="glyphicon glyphicon-save-file"></span> Salvar
                        </button>  
                        <a href="lista-livro.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>

            </table>
        </fieldset>
    </form>


</div>

<?php include_once 'rodape.php'; ?>