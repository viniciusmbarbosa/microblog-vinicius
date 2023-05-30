<?php
require_once "conecta.php";

/* Usada em noticia-insere.php */
function inserirNoticia($conexao, $titulo, $texto, $resumo, $imagem, $idUsuarioLogado){
    $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, usuario_id) VALUES('$titulo', '$texto', '$resumo', '$imagem', $idUsuarioLogado)";

    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
} // fim inserirNoticia


/* Usada em noticia-insere.php e noticia-atualiza.php */
function upload($arquivo){
    /* Array contendo a lista de formatos de imagem válidos */
    $tiposValidos = ["image/png", "image/jpeg", "image/gif","image/svg+xml"];


    /* Validação do formato de imagem
    Se o formato do arquivo enviado NÃO ESTIVER LISTADO
    dentro do array $tiposValidos, para tudo e informe
    o usuário (dizendo que é um formato inválido) */
    if( !in_array($arquivo['type'], $tiposValidos) ){
        echo "<script>alert('Formato inválido!'); history.back();</script>";
        exit; 
    }


    // Extraindo do arquivo apenas o "name" dele
    $nome = $arquivo['name'];

    // Extraindo do arquivo apenas o diretório/nome TEMPORÁRIO
    $temporario = $arquivo['tmp_name'];

    // Definindo a pasta final/destino dentro do nosso site
    // Usamos o . para concatenar o caminho com o nome do arquivo
    $destino = "../imagem/".$nome;
    
    // Mover o arquivo enviado da área temporária no servidor
    // para a pasta de destino final dentro do site
    move_uploaded_file($temporario, $destino);
} // fim upload


/* Usada em noticias.php */
function lerNoticias($conexao){
    $sql = "SELECT 
                noticias.id, 
                noticias.titulo, 
                noticias.data,
                usuarios.nome
            FROM noticias INNER JOIN usuarios
            ON noticias.usuario_id = usuarios.id
            ORDER BY data DESC";

    $resultado = mysqli_query($conexao, $sql) or 
                    die(mysqli_error($conexao));

    // Array vazio                    
    $noticias = [];  
    
    /* Enquanto houver dados de cada notícia no resultado
    do SELECT SQL, guarde cada uma das notícias e seus dados
    em uma variável ($noticia) */
    while( $noticia = mysqli_fetch_assoc($resultado) ){
        /* E em seguida, coloque cada uma dentro do array
        chamado $noticias */
        array_push($noticias, $noticia);
    }

    /* Retornamos a matriz de notícias */
    return $noticias;
} // fim lerNoticias