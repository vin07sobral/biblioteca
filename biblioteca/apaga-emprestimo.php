<?php include_once 'bd.php';?>
<?php include_once 'cabecalho.php';?>

<?php if(isset($_GET['delete_id'])){
    $emprestimo->apagar($_GET['delete_id']);
}
?>
<div class="container">
    <a href="lista-emprestimo.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-backward"></i> $nbsp; Retornar</a>
</div>

<?php include_once 'rodape.php';?>