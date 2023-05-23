<?php 
// Importando o arquivo com funções de usuários
require_once "../inc/funcoes-usuarios.php";
require_once "../inc/cabecalho-admin.php";

/* Detectando se o formulário foi acionado
(clique no botão, ou ao pressionar enter) */
if(isset($_POST['inserir'])){

	/* Capturando os dados informados */
	$nome = $_POST['nome'];
	$email = $_POST['email'];

	/* No caso da senha, capturamos e codificamos */
	$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
	
	$tipo = $_POST['tipo'];

	/* Chamando a função para inserir um novo usuário,
	e passando pra ela os dados capturados a partir
	do formulário (mais o parâmetro de $conexao) */
	inserirUsuario($conexao, $nome, $email, $senha, $tipo);

	/* Após inserir o novo usuário, redirecionamos
	para a página com a lista de usuários do site */
	header("location:usuarios.php");
}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Inserir novo usuário
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir">

			<div class="mb-3">  
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select class="form-select" name="tipo" id="tipo" required>
					<option value=""></option>
					<option value="editor">Editor</option>
					<option value="admin">Administrador</option>
				</select>
			</div>
			
			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

