<?php

require_once "funcoes-sessao.php";
verificaAcesso();

// Guardando o nome da página atual
$pagina = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt-br" class="h-100">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Microblog</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


<link rel="stylesheet" href="../css/style.css">

</head>
<body id="admin" class="d-flex flex-column h-100 bg-light bg-gradient">
    
<header id="topo" class="border-bottom sticky-top">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
  <div class="container">
    <h1><a class="navbar-brand" href="index.php">Admin | Microblog</a></h1>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="meu-perfil.php">Meu perfil</a>
            </li>
                       
            <li class="nav-item">
                <a class="nav-link" href="usuarios.php">Usuários</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="noticias.php">Notícias</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../index.php" target="_blank">Área pública</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold" href=""> <i class="bi bi-x-circle"></i> Sair</a>
            </li>
        </ul>

    </div>
  </div>
</nav>

</header>

<main class="flex-shrink-0">
    <div class="container">

    