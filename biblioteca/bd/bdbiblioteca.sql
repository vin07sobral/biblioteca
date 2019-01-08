DROP DATABASE bdbiblioteca;

CREATE DATABASE bdbiblioteca;
USE bdbiblioteca;

CREATE TABLE pessoa
(
	pessoaid int auto_increment not null,
	nome varchar(100) not null,
	cpf varchar(15) not null,
	tipousuario enum('Aluno','Administrador','Funcionário') not null default 'Aluno',
	senha varchar(50)not null,
	endereco varchar(100) not null,
	numero varchar(10) not null,
	complemento varchar(50)  null,
	cep char(10) not null, 
	celular varchar(15) null,
	email varchar(100) not null,
        
    constraint pk_pessoa primary key(pessoaid)
);

insert into pessoa (nome, cpf, tipousuario, senha, endereco, numero, cep, celular, email)
values ('Administrador','111.111.111-11','Administrador',MD5('12345'),'Rua X',14,'13.310-300','(11)98211-5432','admin@uol.com.br');


insert into pessoa (nome, cpf, tipousuario, senha, endereco, numero, cep, celular, email)
values ('André','222.222.222-22','Aluno',MD5('12345'),'Rua X',14,'13.310-300','(11)98211-5432','admin@uol.com.br');

CREATE TABLE autor
(
	autorid int auto_increment,	
	nome varchar(100) not null,
	nacionalidade varchar(100) not null,

    constraint pk_autor primary key(autorid)
);

CREATE TABLE editora
(
	editoraid int auto_increment not null,
	nome varchar(50) not null,

    constraint pk_editora primary key(editoraid)
);

CREATE TABLE linguagem
(
	linguagemid int auto_increment not null,
	descricao varchar(50) not null,

    constraint pk_linguagem primary key(linguagemid)
);

CREATE TABLE genero
(
	generoid int auto_increment not null,
	descricao varchar(50) not null,

	constraint pk_genero primary key(generoid)
);
CREATE TABLE livro
(
	livroid int auto_increment not null, 
	nome varchar(100) not null,
	qtdpagina int not null,	
	editoraid int not null, -- TABELA EDITORA
	linguagemid int not null, -- TABELA LINGUAGEM
	generoid int not null, -- TABELA GENERO
	anopublicacao date not null,
	edicao int not null,

    constraint pk_livro primary key(livroid),
    constraint fk_livroeditora foreign key(editoraid) references editora(editoraid),
    constraint fk_livrolinguagem foreign key(linguagemid) references linguagem(linguagemid),
    constraint fk_livrogenero foreign key(generoid) references genero(generoid)
);

CREATE TABLE autorlivro
(
    autorlivroid int auto_increment not null,
    livroid int not null, -- TABELA LIVRO
    autorid int not null, -- TABELA AUTOR
    
    constraint pk_autorlivro primary key(autorlivroid),
    constraint fk_autorlivroautor foreign key(autorid) references autor (autorid),
    constraint fk_autorlivrolivro foreign key(livroid) references livro(livroid)
);

CREATE TABLE emprestimo
(
	emprestimoid int auto_increment not null,	
	livroid int not null, -- TABELA LIVRO
        pessoaid int not null, -- TABELA FUNCIONARIO
	dataemprestimo date not null,
	datadevolucao date not null,

        constraint pk_emprestimo primary key(emprestimoid),        
        constraint fk_emprestimolivro foreign key(livroid) references livro(livroid),
        constraint fk_emprestimopessoa foreign key(pessoaid) references pessoa(pessoaid)
);
