<?php
	$mensagens = array(
		'Aluno cadastrado com sucesso' => 'success',
		'Erro ao cadastrar aluno' => 'danger',
		'Erro: Escolha pelo menos um curso' => 'warning'
	);
?>

<div class="container">
	<h3><?= $titulo; ?></h3>

	<div class="dist-topo"></div>

	<!-- exibe alerta HTML -->
	<?php if ($msg = array_search($resp, $mensagens)): ?>
		<div class="alert alert-<?php echo $mensagens[$msg]; ?> fade in">
			<?php echo $msg; ?> <a href='#' class='close' onclick="fechaAlerta(this);">&times;</a>
		</div>
	<?php endif ?>

	<form action="novoAluno" method="post">
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" pattern="[a-zA-Z. ]{3,70}" autofocus required />
		</div>

		<div class="form-group">
			<label for="celular">Celular</label>
			<input type="tel" name="celular" id="celular" class="form-control" pattern="[0-9]{11,11}" maxlength="11" placeholder="Digite apenas números" required />
		</div>

		<div class="form-group">
			<label for="nascimento">Data de nascimento</label>
			<input type="text" name="nascimento" id="nascimento" class="form-control" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[0-2])-(19[0-9]{2}|20[0-9]{2})" maxlength="10" placeholder="dd-mm-aaaa" required />
		</div>

		<label>Cursos</label>
		<div class="checkbox">
			<!-- exibe os cursos disponíveis -->
			<?php foreach($cursos->result() as $c): ?>
				<label for="<?= $c->id; ?>">
					<input type="checkbox" name="cursos[]" id="<?= $c->id; ?>" value="<?= $c->id; ?>" /> <?= $c->nome; ?>
				</label><br />
			<?php endforeach ?>
		</div>

		<br />

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
