<?php 
require "inc/cabecalho.php"; 
require "inc/funcoes-noticias.php";

$noticias = lerTodasNoticias($conexao);

?> 


<div class="row my-1 mx-md-n1">

    <!-- INÍCIO Card -->
        <?php foreach($noticias as $noticias) { ?>
		<div class="col-md-6 my-1 px-md-1">
            <article class="card shadow-sm h-100">
                <a href="noticia.php?id=<?=$noticias['id']?>" class="card-link">
                    <img src="imagens/<?=$noticias['imagem']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="fs-4 card-title"><?=$noticias['titulo']?></h3>
                        <p class="card-text"><?=$noticias['resumo']?></p>
                    </div>
                </a>
            </article>
		</div>
		<!-- FIM Card -->
           <?php } ?>
        <!-- INÍCIO Card -->
		<div class="col-md-6 my-1 px-md-1">
            <article class="card shadow-sm h-100">
                <a href="noticia.php" class="card-link">
                    <img src="https://picsum.photos/seed/picsum/200/100" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="fs-4 card-title">Título da notícia...</h3>
                        <p class="card-text">Resumo da notícia.</p>
                    </div>
                </a>
            </article>
		</div>
		<!-- FIM Card -->
</div>        

<?php 
require_once "inc/rodape.php";
?>

