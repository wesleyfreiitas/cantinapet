<form method="post" action="login.php">

	<label class="badge badge-secondary">Usuário:</label>
	<input type="text" name="nomedono" placeholder="Nome do usuário" class="form-control">
	<br>
	<label class="badge badge-secondary">Senha:</label>
	<input type="password" name="senha" placeholder="Digite a senha" class="form-control">

	<br>

	<input type="submit" value="Entrar" class="btn btn-success">

</form>
<br>
<?php if(isset($_GET['erro'])){ ?>

	<div class="alert alert-danger" role="alert">
		<?php echo "Usuário e/ou senha inválidos." ;

		?>
	</div>

<?php } ?>