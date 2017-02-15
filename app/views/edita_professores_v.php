<div class="container">
	<h3><?= $titulo; ?></h3>
	
	<div class="dist-topo"></div>

	<!-- exibe alerta HTML -->
	<?php if (isset($_GET['r'])): ?>
		<?php if ($_GET['r'] === 'warning'): ?>
			<div class="alert alert-warning fade in">
				Erro: Escolha um curso <a href='#' class='close' onclick="fechaAlerta(this);">&times;</a>
			</div>
		<?php else: ?>
			<div class="alert alert-danger fade in">
				Erro ao editar professor <a href='#' class='close' onclick="fechaAlerta(this);">&times;</a>
			</div>
		<?php endif ?>
	<?php endif ?>

	<!-- formulário de edição -->
	<form action="editarProfessor" method="post">
		<div class="form-group">
			<input type="hidden" name="matricula" class="form-control" value="<?= $professor->matricula; ?>" />
		</div>

		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" name="nome" class="form-control" id="nome" pattern=".{3,}" value="<?= $professor->nome; ?>" required />
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" class="form-control" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?= $professor->email; ?>" required />
		</div>

		<!-- mostra/esconde campos de senhas -->
		<div class="form-group">
			<br /><button type="button" class="btn btn-primary btn-xs" onclick="mostraSenha();">Alterar senha</button><br /><br />
		</div>

		<div id="mostra-senha" class="hidden">
			<div class="form-group">
				<label for="senha1">Senha</label>
				<input type="password" name="senha1" class="form-control" id="senha1" pattern=".{8,}" />
			</div>

			<div class="form-group">
				<label for="senha2">Confirme a senha</label>
				<input type="password" name="senha2" class="form-control" id="senha2" onkeyup="comparaSenhas();" />
				<span class="aviso vermelho" hidden>As senhas devem ser iguais</span>
			</div>
		</div>

		<label>Cursos</label>

		<?php if ($cursosProfessor !== FALSE): ?>

		<div class="checkbox">
			<?php foreach($cursos->result() as $c): ?>

				<!-- verifica se o curso pertence ao professor -->
				<?php if (array_search($c->id, $cursosProfessor) !== FALSE): ?>
					<label for="<?= $c->id; ?>">
						<input type="checkbox" name="cursos[]" id="<?= $c->id; ?>" value="<?= $c->id; ?>" checked /> <?= $c->nome; ?>
					</label><br />
				<?php else: ?>
					<label for="<?= $c->id; ?>">
						<input type="checkbox" name="cursos[]" id="<?= $c->id; ?>" value="<?= $c->id; ?>" /> <?= $c->nome; ?>
					</label><br />
				<?php endif ?>

			<?php endforeach ?>
		</div>

		<?php else: ?>
			<div class="vermelho">Não há cursos para esse professor</div><br />
		<?php endif ?>

		<br />

		<div class="form-group">
			<label>Permissão</label>
			<select name="permissao" class="form-control" required>
				<option value="<?= $professor->permissao_id; ?>"><?= $professor->tipo; ?></option>
				<option value=""></option>
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
				<option value="<?= $professor->status; ?>"><?= ($professor->status === '1') ? 'Ativo' : 'Inativo'; ?></option>
				<option value=""></option>
				<option value="">Selecione</option>
				<option value="1">Ativo</option>
				<option value="0">Inativo</option>
			</select>
		</div>

		<button type="submit" class="btn btn-success">Cadastrar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</form>
</div>
