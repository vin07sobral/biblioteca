<?php

//CLASSE PESSOA
class pessoa {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function validaLogin($cpf, $senha) {
        $stmt = $this->db->prepare("SELECT * from pessoa where cpf =:cpf AND senha =MD5(:senha)");
        $stmt->bindparam(":cpf", $cpf);
        $stmt->bindparam(":senha", $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getLogin($cpf) {
        $sql_select = "SELECT * FROM pessoa WHERE cpf=:cpf";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute(array(":cpf" => $cpf));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function inserir($nome, $cpf, $tipousuario, $senha, $endereco, $numero, $complemento, $cep, $celular, $email) {
        $sql_insert = "INSERT INTO pessoa (nome,cpf,tipousuario,senha,endereco,numero,complemento,cep,celular,email)
                VALUES(:nome,:cpf,:tipousuario,MD5(:senha),:endereco,:numero,:complemento,:cep,:celular,:email)";
        try {
            $stmt = $this->db->prepare($sql_insert);
//substituimos os parametros do sql pelo conteúdo
            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":cpf", $cpf);
            $stmt->bindparam(":tipousuario", $tipousuario);
            $stmt->bindparam(":senha", $senha);
            $stmt->bindparam(":endereco", $endereco);
            $stmt->bindparam(":numero", $numero);
            $stmt->bindparam(":complemento", $complemento);
            $stmt->bindparam(":cep", $cep);
            $stmt->bindparam(":celular", $celular);
            $stmt->bindparam(":email", $email);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-pessoa.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi inserido com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível inserir o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function getID($pessoaid) {
        $sql_selectid = "SELECT * FROM pessoa WHERE pessoaid=:pessoaid";
        $stmt = $this->db->prepare($sql_selectid);
        $stmt->execute(array(":pessoaid" => $pessoaid));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function alterar($pessoaid, $nome, $cpf, $tipousuario, $senha, $endereco, $numero, $complemento, $cep, $celular, $email) {
        $sql_update = "UPDATE pessoa 
                           SET nome=:nome, 
		               cpf=:cpf,						   
                               tipousuario=:tipousuario, 
			       senha=MD5(:senha),
                               endereco=:endereco,
                               numero=:numero,
                               complemento=:complemento,
                               cep=:cep,
                               celular=:celular,
                               email=:email                              
                           WHERE pessoaid=:pessoaid";
        try {
            $stmt = $this->db->prepare($sql_update);
            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":cpf", $cpf);
            $stmt->bindparam(":tipousuario", $tipousuario);
            $stmt->bindparam(":senha", $senha);
            $stmt->bindparam(":endereco", $endereco);
            $stmt->bindparam(":numero", $numero);
            $stmt->bindparam(":complemento", $complemento);
            $stmt->bindparam(":cep", $cep);
            $stmt->bindparam(":celular", $celular);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":pessoaid", $pessoaid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-pessoa.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi alterado com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. A descrição informada já existe! <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            } else {
                echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            }

            return false;
        }
    }

    public function apagar($pessoaid) {
        $sql_delete = "DELETE FROM pessoa WHERE pessoaid=:pessoaid";
        try {
            $stmt = $this->db->prepare($sql_delete);
            $stmt->bindparam(":pessoaid", $pessoaid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-cliente.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi excluído com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível remover o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function listar() {
        $sql_select = "select pessoaid,nome,cpf,tipousuario,endereco,numero,complemento,cep,celular,email from pessoa";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['pessoaid']); ?></td>
                    <td><?php print($row['nome']); ?></td>
                    <td><?php print($row['cpf']); ?></td>
                    <td><?php print($row['tipousuario']); ?></td>
                    <td><?php print($row['endereco']); ?></td>
                    <td><?php print($row['numero']); ?></td>
                    <td><?php print($row['complemento']); ?></td>
                    <td><?php print($row['cep']); ?></td>
                    <td><?php print($row['celular']); ?></td>
                    <td><?php print($row['email']); ?></td>
                    <td align="center">
                        <a href="edita-pessoa.php?edit_id=<?php print($row['pessoaid']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-pessoa.php?delete_id=<?php print($row['pessoaid']); ?>" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
            <?php
        }
    }

   public function combo($pessoaid) {
        $comando = $this->db->prepare("select pessoaid, nome from pessoa");
        $comando->execute();
        if ($comando->rowCount() > 0) {
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                ?>                
                <option <?php echo ($pessoaid == $row['pessoaid']) ? "selected" : null; ?> value="<?php print($row['pessoaid']); ?>">
                <?php print($row['nome']); ?></option>

                <?php
            }
        }
    }

}

//CLASSE EDITORA
class editora {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function inserir($nome) {
        $sql_insert = "INSERT INTO editora (nome) VALUES(:nome)";
        try {
            $stmt = $this->db->prepare($sql_insert);
//substituimos os parametros do sql pelo conteúdo
            $stmt->bindparam(":nome", $nome);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-editora.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi inserido com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível inserir o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function getID($editoraid) {
        $sql_select = "SELECT * FROM editora WHERE editoraid=editoraid";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute(array(":editoraid" => $editoraid));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function alterar($editoraid, $nome) {
        $sql_update = "UPDATE editora SET nome=:nome WHERE editoraid=:editoraid";
        try {
            $stmt = $this->db->prepare($sql_update);
            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":editoraid", $editoraid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-editora.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi alterado com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function apagar($editoraid) {
        $sql_delete = "DELETE FROM editora WHERE editoraid=:editoraid";
        try {
            $stmt = $this->db->prepare($sql_delete);
            $stmt->bindparam(":editoraid", $editoraid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-editora.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi excluído com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível remover o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function listar() {
        $sql_select = "select *from editora";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['editoraid']); ?></td>
                    <td><?php print($row['nome']); ?></td>                                      
                    <td align="center">
                        <a href="edita-editora.php?edit_id=<?php print($row['editoraid']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-editora.php?delete_id=<?php print($row['editoraid']); ?>" onclick="return confirm('Confirma a exclusão do registro?');" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
            <?php
        }
    }
 public function combo($editoraid) {
        $comando = $this->db->prepare("select *from editora");
        $comando->execute();
        if ($comando->rowCount() > 0) {
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                ?>                
                <option <?php echo ($editoraid == $row['editoraid']) ? "selected" : null; ?> value="<?php print($row['editoraid']); ?>">
                <?php print($row['nome']); ?></option>

                <?php
            }
        }
    }    
}

//CLASSE AUTOR
class autor {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function inserir($nome, $nacionalidade) {
        $sql_insert = "INSERT INTO autor (nome, nacionalidade) VALUES(:nome,:nacionalidade)";
        try {
            $stmt = $this->db->prepare($sql_insert);
            //substituimos os parametros do sql pelo conteúdo
            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":nacionalidade", $nacionalidade);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-autor.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi inserido com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (Exception $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível inserir o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function getID($autorid) {
        $sql_selectid = "SELECT * FROM autor WHERE autorid=:autorid";
        $stmt = $this->db->prepare($sql_selectid);
        $stmt->execute(array(":autorid" => $autorid));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function alterar($autorid, $nome, $nacionalidade) {
        $sql_update = "UPDATE autor SET nome=:nome, nacionalidade=:nacionalidade WHERE autorid=:autorid";
        try {
            $stmt = $this->db->prepare($sql_update);
            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":nacionalidade", $nacionalidade);
            $stmt->bindparam(":autorid", $autorid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-autor.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi alterado com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. A descrição informada já existe! <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            } else {
                echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            }
            return false;
        }
    }

    public function apagar($autorid) {
        $sql_delete = "DELETE FROM autor WHERE autorid=:autorid";
        try {
            $stmt = $this->db->prepare($sql_delete);
            $stmt->bindparam(":autorid", $autorid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-autor.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi excluído com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível remover o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function listar() {
        $sql_select = "select autorid,nome,nacionalidade from autor";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>                    
                    <td><?php print($row['autorid']); ?></td>
                    <td><?php print($row['nome']); ?></td>
                    <td><?php print($row['nacionalidade']); ?></td>
                    <td align="center">
                        <a href="edita-autor.php?edit_id=<?php print($row['autorid']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-autor.php?delete_id=<?php print($row['autorid']); ?>" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
            <?php
        }
    }

    public function combo() {
        $comando = $this->db->prepare("select autorid, nome from autor");
        $comando->execute();
        if ($comando->rowCount() > 0) {
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <option value="<?php print($row['autorid']); ?>">
                    <?php print($row['nome']); ?></option>
                <?php
            }
        }
    }

}

//CLASSE LIVRO
class livro {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function inserir($nome, $qtdpagina, $editora, $linguagem, $genero, $anopublicacao, $edicao) {
        $sql_insert = "INSERT INTO livro(nome, qtdpagina, editoraid, linguagemid, generoid, anopublicacao,edicao)
                VALUES(:nome, :qtdpagina, :editora, :linguagem, :genero, :anopublicacao,:edicao)";
        try {
            $stmt = $this->db->prepare($sql_insert);
            //substituimos os parametros do sql pelo conteúdo
            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":qtdpagina", $qtdpagina);
            $stmt->bindparam(":editora", $editora);
            $stmt->bindparam(":linguagem", $linguagem);
            $stmt->bindparam(":genero", $genero);
            $stmt->bindparam(":anopublicacao", $anopublicacao);
            $stmt->bindparam(":edicao", $edicao);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-livro.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi inserido com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível inserir o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function getID($livroid) {
        $sql_selectid = "SELECT * FROM livro WHERE livroid=:livroid";
        $stmt = $this->db->prepare($sql_selectid);
        $stmt->execute(array(":livroid" => $livroid));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function alterar($livroid, $nome, $qtdpagina, $editoraid, $linguagemid, $generoid, $anopublicacao, $edicao) {
        $sql_update = "UPDATE livro
                SET nome=:nome, qtdpagina=:qtdpagina, 
                editoraid=:editoraid, linguagemid=:linguagemid, 
                generoid=:generoid, anopublicacao=:anopublicacao,
                edicao=:edicao WHERE livroid=:livroid";                 ;
        try {
            $stmt = $this->db->prepare($sql_update);
            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":qtdpagina", $qtdpagina);
            $stmt->bindparam(":editoraid", $editoraid);
            $stmt->bindparam(":linguagemid", $linguagemid);
            $stmt->bindparam(":generoid", $generoid);
            $stmt->bindparam(":anopublicacao", $anopublicacao);
            $stmt->bindparam(":edicao", $edicao);
            $stmt->bindparam(":livroid", $livroid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-livro.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi alterado com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. A descrição informada já existe! <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            } else {
                echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            }

            return false;
        }
    }

    public function apagar($livroid) {
        $sql_delete = "DELETE FROM livro WHERE livroid=:livroid";
        try {
            $stmt = $this->db->prepare($sql_delete);
            $stmt->bindparam(":livroid", $livroid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-livro.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi excluído com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível remover o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function listar() {
        $sql_select = "SELECT livroid,l.nome, qtdpagina, 
                              e.nome editora, 
                              a.descricao linguagem, 
                              g.descricao genero, 
                              anopublicacao,edicao
                       FROM   livro l, genero g, editora e, linguagem a
                       WHERE  l.editoraid   = e.editoraid 
                       AND    l.linguagemid = a.linguagemid
                       AND    l.generoid    = g.generoid";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['livroid']); ?></td>
                    <td><?php print($row['nome']); ?></td>
                    <td><?php print($row['qtdpagina']); ?></td>
                    <td><?php print($row['editora']); ?></td>
                    <td><?php print($row['linguagem']); ?></td>
                    <td><?php print($row['genero']); ?></td>
                    <td><?php print($row['anopublicacao']); ?></td>                    
                    <td><?php print($row['edicao']); ?></td>
                    <td align="center">
                        <a href="edita-livro.php?edit_id=<?php print($row['livroid']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-livro.php?delete_id=<?php print($row['livroid']); ?>" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
            <?php
        }
    }

    public function combo($livroid) {
        $comando = $this->db->prepare("select livroid, nome from livro");
        $comando->execute();
        if ($comando->rowCount() > 0) {
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                ?>                
                <option <?php echo ($livroid == $row['livroid']) ? "selected" : null; ?> value="<?php print($row['livroid']); ?>">
                <?php print($row['nome']); ?></option>

                <?php
            }
        }
    }

}

//CLASSE AUTOR LIVRO
class autorlivro {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function inserir($livro, $autor) {
        $sql_insert = "INSERT INTO autorlivro(livro,autor) VALUES (:autor,:livro)";
        try {
            $stmt = $this->db->prepare($sql_insert);
            //substituimos os parametros do sql pelo conteúdo
            $stmt->bindparam(":autorid", $autor);
            $stmt->bindparam(":livroid", $livro);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-autorlivro.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi inserido com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível inserir o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function getID($autorlivroid) {
        $sql_select = "SELECT * FROM autorlivro WHERE autorlivroid=autorlivroid";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute(array(":autorlivroid" => $autorlivroid));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function alterar($autorlivroid, $autor, $livro) {
        $sql_update = "UPDATE autorlivro SET autorid=:autorid, livroid=:livroid WHERE autorlivroid=:autorlivroid";

        try {
            $stmt = $this->db->prepare($sql_update);
            $stmt->bindparam(":autorid", $autor);
            $stmt->bindparam(":livroid", $livro);
            $stmt->bindparam(":autorlivroid", $autorlivroid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-autorlivro.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi alterado com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function apagar($autorlivroid) {
        $sql_delete = "DELETE FROM autorlivro WHERE autorlivroid=:autorlivroid";
        try {
            $stmt = $this->db->prepare($sql_delete);
            $stmt->bindparam(":autorlivroid", $autorlivroid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-autorlivro.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi excluído com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível remover o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function listar() {
        $sql_select = "select *from autorlivro";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['autorlivroid']); ?></td>
                    <td><?php print($row['autorid']); ?></td>
                    <td><?php print($row['livroid']); ?></td>
                    <td align="center">
                        <a href="edita-autorlivro.php?edit_id=<?php print($row['$autorlivroid']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-autorlivro.php?delete_id=<?php print($row['$autorlivroid']); ?>" onclick="return confirm('Confirma a exclusão do registro?');" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
                <?php
            }
        }

        public function combo() {
            $comando = $this->db->prepare("select autorlivroid, autorid, a.nome, livroid, l.nome 
										from a.autor, l.livro
										where autorid=autorid and livroid=livroid");
            $comando->execute();
            if ($comando->rowCount() > 0) {
                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                <option value="<?php print($row['autorlivroid']); ?>">
                <?php print($row['a.nome']); ?></option>

                <?php
            }
        }
    }

}

//CLASSE EMPRESTIMO
class emprestimo {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function inserir($livroid, $pessoaid, $dataemprestimo, $datadevolucao) {
        $sql_insert = "INSERT INTO emprestimo(livroid,pessoaid,dataemprestimo,datadevolucao)
                VALUES (:livroid,:pessoaid,:dataemprestimo,:datadevolucao)";
        try {
            $stmt = $this->db->prepare($sql_insert);
            //substituimos os parametros do sql pelo conteúdo            
            $stmt->bindparam(":livroid", $livroid);
            $stmt->bindparam(":pessoaid", $pessoaid);
            $stmt->bindparam(":dataemprestimo", $dataemprestimo);
            $stmt->bindparam(":datadevolucao", $datadevolucao);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-emprestimo.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi inserido com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível inserir o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function getID($emprestimoid) {
        $sql_select = "SELECT * FROM emprestimo WHERE emprestimoid=emprestimoid";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute(array(":emprestimoid" => $emprestimoid));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function alterar($emprestimoid,$livroid, $pessoaid, $dataemprestimo, $datadevolucao) {
        $sql_update = "UPDATE emprestimo 
                          SET livroid =: livroid, 
                              pessoaid =: pessoaid,
                              dataemprestimo =: dataemprestimo, 
                              datadevolucao =: datadevolucao 
                          WHERE emprestimoid =: emprestimoid";

        try {
            $stmt = $this->db->prepare($sql_update);
            $stmt->bindparam(":livroid", $livroid);
            $stmt->bindparam(":pessoaid", $pessoaid);
            $stmt->bindparam(":dataemprestimo", $dataemprestimo);
            $stmt->bindparam(":datadevolucao", $datadevolucao);
            $stmt->bindparam(":emprestimoid", $emprestimoid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-emprestimo.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi alterado com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function apagar($emprestimoid) {
        $sql_delete = "DELETE FROM emprestimo
                        WHERE emprestimoid =: emprestimoid";
        try {
            $stmt = $this->db->prepare($sql_delete);
            $stmt->bindparam(":emprestimoid", $emprestimoid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-emprestimo.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi excluído com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível remover o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function listar() {
        $sql_select = "SELECT emprestimoid, 
                              p.nome pessoaid, 
                              l.nome livroid, 
                              dataemprestimo, 
                              datadevolucao
                         FROM emprestimo e, pessoa p, livro l
                        WHERE p.pessoaid = e.pessoaid 
                          AND l.livroid = e.livroid;";
        $stmt = $this->db->prepare($sql_select);        
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['emprestimoid']); ?></td>
                    <td><?php print($row['pessoaid']); ?></td>
                    <td><?php print($row['livroid']); ?></td>
                    <td><?php print($row['dataemprestimo']); ?></td>
                    <td><?php print($row['datadevolucao']); ?></td>
                    <td align="center">
                        <a href="edita-emprestimo.php?edit_id=<?php print($row['emprestimoid']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-emprestimo.php?delete_id=<?php print($row['emprestimoid']); ?>" onclick="return confirm('Confirma a exclusão do registro?');" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                    <?php
                }
            } else {
                ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
            <?php
        }
    }
/*COMBO SEM NECESSIDADE
    public function combo() {
        $comando = $this->db->prepare("select emprestimoid, autorid, a.nome, livroid, l.nome 
										from autor a,livro l
										where a.autorid=autorid and l.livroid=livroid");
        $comando->execute();
        if ($comando->rowCount() > 0) {
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <option value="<?php print($row['emprestimoid']); ?>">
                <?php print($row['a.nome']); ?></option>

                <?php
            }
        }
    }
 *
 */
}

//CLASSE GENERO
class genero{
    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }
    
    public function inserir($descricao) {
        $sql_insert = "INSERT INTO genero(descricao)
                VALUES (:descricao)";
        try {
            $stmt = $this->db->prepare($sql_insert);
            //substituimos os parametros do sql pelo conteúdo            
            $stmt->bindparam(":descricao", $descricao);            
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-genero.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi inserido com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível inserir o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function getID($generoid) {
        $sql_select = "SELECT * FROM genero WHERE generoid=:generoid";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute(array(":generoid" => $generoid));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function alterar($generoid, $descricao) {
        $sql_update = "UPDATE genero SET descricao=:descricao
                WHERE generoid=:generoid";

        try {
            $stmt = $this->db->prepare($sql_update);
            $stmt->bindparam(":descricao", $descricao); 
            $stmt->bindparam(":generoid", $generoid);             
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-genero.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi alterado com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function apagar($generoid) {
        $sql_delete = "DELETE FROM genero WHERE generoid=:generoid";
        try {
            $stmt = $this->db->prepare($sql_delete);
            $stmt->bindparam(":generoid", $generoid);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='lista-genero.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi excluído com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível remover o registro. <strong>Erro: " . $e->getMessage() . "</strong>
	          </div>
	      </div>";
            return false;
        }
    }

    public function listar() {
        $sql_select = "select *from genero";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['generoid']); ?></td>
                    <td><?php print($row['descricao']); ?></td>                    
                    <td align="center">
                        <a href="edita-genero.php?edit_id=<?php print($row['generoid']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-genero.php?delete_id=<?php print($row['generoid']); ?>" onclick="return confirm('Confirma a exclusão do registro?');" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                    <?php
                }
            } else {
                ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
            <?php
        }
    }
    public function combo($generoid) {
        $comando = $this->db->prepare("select *from genero");
        $comando->execute();
        if ($comando->rowCount() > 0) {
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                ?>                
                <option <?php echo ($generoid == $row['generoid']) ? "selected" : null; ?> value="<?php print($row['generoid']); ?>">
                <?php print($row['descricao']); ?></option>

                <?php
            }
        }
    }
}

class linguagem{
    private $db;
    
     function __construct($DB_con) {
        $this->db = $DB_con;
    }
    
    public function combo($linguagemid) {
        $comando = $this->db->prepare("select *from linguagem");
        $comando->execute();
        if ($comando->rowCount() > 0) {
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                ?>                
                <option <?php echo ($linguagemid == $row['linguagemid']) ? "selected" : null; ?> value="<?php print($row['linguagemid']); ?>">
                <?php print($row['descricao']); ?></option>

                <?php
            }
        }
    }
}

/*   
  linguagem //verificar necessidade
  genero //verificar necessidade
  autorlivro  
  emprestimo
 */