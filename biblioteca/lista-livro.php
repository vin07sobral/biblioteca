<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="menu.php" class="btn btn-large btn-warning"><i class="glyphicon glyphicon-home"></i> &nbsp; Menu Inicial</a>
<a href="adiciona-livro.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Novo Registro</a>
</div>


<div class="container">
    <h2><span class="glyphicon glyphicon-tags text-info"></span>Listagem de livros</h2>
	 <table class='table table-bordered table-responsive'>
     <tr class="info">
     <th><i class="glyphicon glyphicon-asterisk"></i></th>
     <th>Título</th>
     <th>Quantidade páginas</th>
     <th>Editora</th>    
     <th>Linguagem</th>    
     <th>Gênero</th>    
     <th>Ano publicacão</th>    
     <th>Edição</th>    
     <th colspan="2" align="center">Opções</th>
     </tr>
     <!-- Carregamos a listagem da Classe -->
     <?php $livro->listar(); ?>    
</table>          
</div>

<?php include_once 'rodape.php'; ?>

