use questionarios;

create table usuarios (
    id int primary key auto_increment,
    email varchar(255)
); 

create table questionarios (
    id int primary key auto_increment,
    nome varchar(255)
);

create table perguntas (
    id int primary key auto_increment,
    titulo varchar(255),
    descricao text,
    questionario_id int
);

create table opcoes (
    id int primary key auto_increment,
    descricao varchar(255),
    pergunta_id int,
    correta boolean
);

create table preenchimentos (
    id int primary key auto_increment,
    criado_em timestamp default current_timestamp,
    usuario_id int,
    questionario_id int,
    concluido boolean,
    acertos int
);

create table respostas (
    id int primary key auto_increment,
    opcao_id int,
    preenchimento_id int
);