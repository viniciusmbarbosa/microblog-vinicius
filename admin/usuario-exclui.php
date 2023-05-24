<?php
require_once "../inc/funcoes-usuarios.php";
require_once "../inc/funcoes-sessao.php";

/* Se o usuário logado Não FOR admin.... */
if( $_SESSION['tipo'] != "admin" ){
	//Então redirecione para não-autorizado
	header("location:nao-autorizado.php");
	exit;
}

verificaAcesso();

/* Capturando o valor recebido pelo parâmetro
id através da URL */
$id = $_GET["id"];

/* Chamando a função de excluir usuário passando
o id do usuário que será excluído */
excluiUsuario($conexao, $id);

/* Voltando para a página com a tabela/lista de usuários */
header("location:usuarios.php");