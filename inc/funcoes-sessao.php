<?php
/* Sessões no PHP
Recurso usado para o controle de acesso à determinadas páginas e/ou recursos do site. Exemplo: área administrativa, área do cliente/aluno. 

Nesta área, o acesso só é possível mediante alguma forma de autenticação. Exemplo? login/senha.*/

if (!isset($_SESSION)) {
    //Então, inicie uma sessão
    session_start();
}

function verificaAcesso()
{
    /* Se NÃO EXISTIR uma váriavel de SESSÃO baseada no identificado do usuário,
    significa que ele/ela NÃO ESTÁ logada(a) no sistema. */
    if (!isset($_SESSION['id'])) {
        //Destrua qualquer recurso de sessão
        session_destroy();

        //Redirecione para o formulario de login
        header("location:../login.php");
        exit; // ou die ()
    }
} // fim verificaAcesso

function login($id, $nome, $tipo)
{
    /* Criação de variáveis de SESSÃO */
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $_SESSION['tipo'] = $tipo;


    /* As variáveis de sessão ficam disponíveis para utilização durante não for fechado ou o usuário estiver logado. */
} //fim login

//Usada em todos as páginas admim
function logout()
{
    session_start();
    session_destroy();
    header("location:../login.php?lougout");
    exit;
}
