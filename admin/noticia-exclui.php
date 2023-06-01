<?php 
require_once "../inc/funcoes-sessao.php";
require_once "../inc/funcoes-noticias.php";

verificaAcesso();

//pegando o id da notícia vindo do parâmetro de URL
$idNoticia = $_GET['id'];

//Pegando o id e o tipo do usuário logado vindos da SESSION
$idUsuario = $_SESSION['id'];
$tipoUsuario = $_SESSION['tipo'];

excluirNoticia($conexao, $idNoticia, $idUsuario, $tipoUsuario);

header("location:noticias.php");

//voltando pra páginas das notícias