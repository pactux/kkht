<div class="container">
	<h3><?php echo $titulo; ?></h3>
	
	<div class="dist-topo"></div>

	<!-- exibe alerta HTML -->
	<?php if (isset($_GET['r'])): ?>
		<?php if ($msg = array_search($_GET['r'], $mensagens)): ?>
			<div class="alert alert-<?php echo $mensagens[$msg]; ?> fade in">
				<?php echo $msg; ?> <a href='#' class='close' onclick="fechaAlerta(this);">&times;</a>
			</div>
		<?php endif ?>
	<?php endif ?>

	<!-- formulário de cadastro -->
	<form action="novoProfessor" method="post">
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" name="nome" class="form-control" id="nome" pattern=".{3,}" autofocus required />
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" class="form-control" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required />
		</div>

		<div class="form-group">
			<label for="senha1">Senha</label>
			<input type="password" name="senha1" class="form-control" id="senha1" pattern=".{8,}" placeholder="No minimo 8 digítos" required />
		</div>

		<div class="form-group">
			<label for="senha2">Confirme a senha</label>
			<input type="password" name="senha2" class="form-control" id="senha2" onkeyup="comparaSenhas();" required />
			<span class="aviso vermelho" hidden>As senhas devem ser iguais</span>
		</div>

		<label>Cursos</label>
		<div class="checkbox">
			<!-- exibe os cursos disponíveis -->
			<?php foreach($cursos->result() as $c): ?>
				<label for="<?php echo $c->id; ?>">
					<input type="checkbox" name="cursos[]" id="<?php echo $c->id; ?>" value="<?php echo $c->id; ?>" /> <?php echo $c->nome; ?>
				</label><br />
			<?php endforeach ?>
		</div>

		<br />

		<div class="form-group">
			<label>Permissão</label>
			<select name="permissao" class="form-control">
				<option value="1">professor</option>
				<option value="2">administrador</option>
				<?php if ($permissao === '3'): ?>
					<option value="3">root</option>
				<?php endif ?>
			</select>
		</div>

		<div class="form-group">
			<label>Status</label>
			<select name="status" class="form-control" required>
				<option value="">Selecione</option>
				<option value="1">Ativo</option>
				<option value="0">Inativo</option>
			</select>
		</div>

		<button type="submit" class="btn btn-success">Cadastrar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</form>
</div>
