<?php
require_once "conecta.php";

/* Usada em noticia-insere.php */
function inserirNoticia($conexao, $titulo, $texto, $resumo, $imagem, $idUsuarioLogado)
{
    $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, usuario_id) VALUES('$titulo', '$texto', '$resumo', '$imagem', $idUsuarioLogado)";

    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
} // fim inserirNoticia


/* Usada em noticia-insere.php e noticia-atualiza.php */
function upload($arquivo)
{
    /* Array contendo a lista de formatos de imagem válidos */
    $tiposValidos = ["image/png", "image/jpeg", "image/gif", "image/svg+xml"];


    /* Validação do formato de imagem
    Se o formato do arquivo enviado NÃO ESTIVER LISTADO
    dentro do array $tiposValidos, para tudo e informe
    o usuário (dizendo que é um formato inválido) */
    if (!in_array($arquivo['type'], $tiposValidos)) {
        echo "<script>alert('Formato inválido!'); history.back();</script>";
        exit;
    }


    // Extraindo do arquivo apenas o "name" dele
    $nome = $arquivo['name'];

    // Extraindo do arquivo apenas o diretório/nome TEMPORÁRIO
    $temporario = $arquivo['tmp_name'];

    // Definindo a pasta final/destino dentro do nosso site
    // Usamos o . para concatenar o caminho com o nome do arquivo
    $destino = "../imagem/" . $nome;

    // Mover o arquivo enviado da área temporária no servidor
    // para a pasta de destino final dentro do site
    move_uploaded_file($temporario, $destino);
} // fim upload


/* Usada em noticias.php */
function lerNoticias($conexao, $idUsuarioLogado, $tipoUsuariologado)
{

    if ($tipoUsuariologado == 'admin') {
        /* SQL do admin: pode carregar/ver tudo de todos */
        $sql = "SELECT 
                noticias.id, 
                noticias.titulo, 
                noticias.data,
                usuarios.nome
            FROM noticias INNER JOIN usuarios
            ON noticias.usuario_id = usuarios.id
            ORDER BY data DESC";
    } else {
        /* SQL do editor: pode carregar/ver tudo DELE APENAS. */
        $sql = "SELECT * FROM noticias WHERE usuario_id = $idUsuarioLogado
        ORDER BY data DESC";
    }


    $resultado = mysqli_query($conexao, $sql) or
        die(mysqli_error($conexao));

    // Array vazio                    
    $noticias = [];

    /* Enquanto houver dados de cada notícia no resultado
    do SELECT SQL, guarde cada uma das notícias e seus dados
    em uma variável ($noticia) */
    while ($noticia = mysqli_fetch_assoc($resultado)) {
        /* E em seguida, coloque cada uma dentro do array
        chamado $noticias */
        array_push($noticias, $noticia);
    }

    /* Retornamos a matriz de notícias */
    return $noticias;
} // fim lerNoticias 
/* Usada em notícia atualizada.php */
function formataData($data)
{
    return date("d/m/Y H:i", strtotime($data));
}




function lerUmaNoticia($conexao, $idNoticia, $idUsuarioLogado, $TipoUsuarioLogado)
{

    if ($TipoUsuarioLogado == 'admin') {
        $sql = "SELECT * FROM noticias WHERE id = $idNoticia";
    } else {
        /* SQL do editor: carregar os dados somente da notícia dele */
        $sql = "SELECT * FROM noticias WHERE id = $idNoticia 
        AND usuario_id = $idUsuarioLogado";
    }

    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

    return mysqli_fetch_assoc($resultado);
}

function atualizarNoticia($conexao, $titulo, $texto, $resumo, $imagem, $idNoticia, $idUsuarioLogado, $tipoUsuarioLogado)
{
    if ($tipoUsuarioLogado == 'admin') {
        $sql = "UPDATE noticias SET 
            titulo = '$titulo', 
            texto = '$texto',
            resumo = '$resumo',
            imagem = '$imagem'
            WHERE id = $idNoticia";
    } else {
        $sql = "UPDATE noticias SET 
            titulo = '$titulo', 
            texto = '$texto',
            resumo = '$resumo',
            imagem = '$imagem'
            WHERE id = $idNoticia AND usuario_id = $idUsuarioLogado";
    } 
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

}
function excluirNoticia($conexao, $idNoticia, $idUsuarioLogado, $tipoUsuarioLogado){
    
    if($tipoUsuarioLogado == 'admin'){
        /* SQL do admin: pode apagar qualuqer notícia pelo id */
        $sql = "DELETE FROM noticias where id = $idNoticia";
    }else {
        /* SQL do editor: pode apagar SOMENTE sua própria notícias (pelo id da notícia e pelo seu próprio id) */
        $sql = "DELETE FROM noticias WHERE id = $idNoticia AND usuario_id = $idUsuarioLogado";
    }
    mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
    
}


function lerTodasNoticias($conexao){
    
    $sql = "SELECT * FROM noticias ORDER BY data DESC";

    
    $resultado = mysqli_query($conexao, $sql) 
                or die(mysqli_error($conexao));

   
    $noticias = [];

    
    while($noticia = mysqli_fetch_assoc($resultado)){
        
        array_push($noticias, $noticia);
    }

    
    return $noticias;

} // fim lerTodasNoticia//fim excluirNoticia

/* Funções usadas na páginas da área pública */

/* Usada em index.php */
            function lerDetalhes($conexao, $id){
                $sql = "SELECT
                            noticias.id,
                            noticias.titulo,
                            noticias.data,
                            noticias.imagem,
                            noticias.texto,
                            usuarios.nome
                    FROM noticias INNER JOIN usuarios 
                    ON noticias.usuario_id = usuarios.id
                    WHERE noticias.id = $id";
            $resultado = mysqli_query($conexao, $sql)
                        or die (mysqli_error($conexao));
            return mysqli_fetch_assoc($resultado);                                
}/* Fim  lerDetalhes */

/* Usada em resultados.php */
function busca($conexao, $termo){
    $sql = "SELECT * FROM noticias WHERE
                                    titulo LIKE '%$termo%' OR 
                                    texto LIKE '%$termo%' OR
                                    resumo LIKE '%$termo%'
                                    ORDER BY data  DESC";

    $resultado = mysqli_query($conexao, $sql)
                    or die (mysqli_error($conexao));
    $noticias = [];

    while($noticia = mysqli_fetch_assoc($resultado)){
        array_push($noticias, $noticia);
    }

    return $noticias;

}