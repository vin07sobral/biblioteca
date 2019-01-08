<?php include_once 'bd.php';?>
<?php include_once 'cabecalho.php';?>

<?php if(isset($_GET['delete_id'])){
    $pessoa->apagar($_GET['delete_id']);
}
?>
<div class="container">
    <a href="lista-pessoa.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-backward"></i> $nbsp; Retornar</a>
</div>

<?phpinclude_once 'rodape.php';?>