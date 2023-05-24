<?php
require_once "../inc/funcoes-usuarios.php"; 
require_once "../inc/cabecalho-admin.php";

/* Se o usuário logado Não FOR admin.... */
if( $_SESSION['tipo'] != "admin" ){
	//Então redirecione para não-autorizado
	header("location:nao-autorizado.php");
	exit;
}

/* Capturamos o parâmetro da URL */
$id = $_GET["id"];

/* Chamamos a função (passando conexao e o id do usuário), e após o término da execução da função, recebemos um array associativo contendo os dados do usuário */
$usuario = lerUsuario($conexao, $id);

/* Detectando quando o botão/formulário é acionado */
if(isset($_POST['atualizar'])){
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$tipo = $_POST['tipo'];
	/* Lógica para senha
	Se o campo senha do formulário estiver vazio OU se a senha digitada for igual à existente no banco de dados, 
	então significa que o usuário não alterou a senha. */
	if(empty($_POST['senha']) || password_verify($_POST['senha'], $usuario['senha']) ){
		// Então, mantenha a mesma senha já existente no banco
		$senha = $usuario['senha'];
	}else{
		$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT) ;
	}

	/* Chamamos a função para atualizar e passamos os dados capturados */
	atualizarUsuario($conexao, $id, $nome, $email, $senha, $tipo);

	/* Redirecionamos para a página com a lista de usuário */
	header("location:usuarios.php");
}//fim if/isset botão
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar dados do usuário
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input value="<?=$usuario['nome']?>"
				 class="form-control" type="text" id="nome" name="nome" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input value="<?=$usuario['email']?>"
				class="form-control" type="email" id="email" name="email" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select class="form-select" name="tipo" id="tipo" required>
					<option value=""></option>
					<option value="editor"  <?php if($usuario['tipo'] == "editor"){echo "selected";}?>
					 >Editor</option>
					<option value="admin" <?php if($usuario['tipo'] == "admin") {echo"selected";}?>  
					>Administrador</option>
				</select>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

