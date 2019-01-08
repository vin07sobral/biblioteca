<?php
include_once 'bd.php';
?>
<?php include_once 'cabecalho.php'; ?>

<div class="clearfix"></div>

   <div class="container">
	<div class="alert alert-info">
            <strong><?php print strtoupper($_SESSION['usuario']) ?></strong>, Seja bem vindo! O seu perfil é o <?php print $_SESSION['tipousuario']; ?><br><br>Selecione a opção desejada na parte superior. <i class="glyphicon glyphicon-arrow-up"></i>
	</div>
   </div>
<?php include_once 'rodape.php'; ?>