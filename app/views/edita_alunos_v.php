<?php 
	$mensagens = array(
		'Escolha pelo menos um curso' => 'warning',
		'Dados alterados' => 'success',
		'Erro: Dados não alterados' => 'danger'
	);
?>

<div class="container">
	<h3><?= $titulo; ?></h3>

	<div class="dist-topo"></div>

	<!-- exibe alerta HTML -->
	<?php if ($msg = array_search($resp, $mensagens)): ?>
		<div class="alert alert-<?= $mensagens[$msg]; ?> fade in">
			<?= $msg; ?> <a href='#' class='close' onclick="fechaAlerta(this);">&times;</a>
		</div>
	<?php endif ?>

	<form action="editaraluno" method="post">
		<div class="form-group">
			<input type="hidden" name="matricula" value="<?= $aluno->matricula; ?>" class="form-control" />
		</div>

		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" pattern="[a-zA-Z. ]{3,70}" value="<?= ucwords($aluno->nome); ?>" required />
		</div>

		<div class="form-group">
			<label for="celular">Celular</label>
			<input type="tel" name="celular" id="celular" class="form-control" pattern="[0-9]{11,11}" maxlength="11" value="<?= $aluno->celular; ?>" required />
		</div>

		<!-- formata data nascimento -->
		<?php $dn = explode('-', $aluno->dataNascimento); ?>
		<?php $dn = $dn[2] . '-' . $dn[1] . '-' . $dn[0]; ?>

		<div class="form-group">
			<label for="nascimento">Data de nascimento</label>
			<input type="text" name="nascimento" id="nascimento" class="form-control" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[0-2])-(19[0-9]{2}|20[0-9]{2})" maxlength="10" value="<?= $dn; ?>" required />
		</div>

		<!-- formata data cadastro -->
		<?php $dc = strstr($aluno->dataCadastro, ' ', TRUE); ?>
		<?php $dc = explode('-', $dc); ?>
		<?php $dc = $dc[2] . '-' . $dc[1] . '-' . $dc[0]; ?>

		<div class="form-group">
			<label>Data da matrícula</label>
			<input type="text" class="form-control" maxlength="10" value="<?= $dc; ?>" disabled />
		</div>

		<label>Cursos</label>

		<?php if ($cursosAluno !== FALSE): ?>
			<div class="checkbox">
			<?php foreach($cursos->result() as $c): ?>

				<!-- verifica se o curso pertence ao aluno -->
				<?php if (array_search($c->id, $cursosAluno) !== FALSE): ?>
					<label for="<?= $c->id; ?>">
						<input type="checkbox" name="cursos[]" id="<?= $c->id; ?>" value="<?= $c->id; ?>" onchange="cursosRemovidos(this);" checked="true" /> <?= ucwords($c->nome); ?>
					</label><br />
				<?php else: ?>
					<label for="<?= $c->id; ?>">
					<input type="checkbox" name="cursos[]" id="<?= $c->id; ?>" value="<?= $c->id; ?>" /> <?= ucwords($c->nome); ?>
					</label><br />
				<?php endif ?>

			<?php endforeach ?>
			</div>
		<?php else: ?>
			<div class="vermelho">Não há cursos para esse aluno</div>
		<?php endif ?>

		<br />

		<div class="checkbox" id="remover"></div>

		<?php $s = []; ?>

		<?php ($aluno->status === '0') ? array_push($s, 0, 'Inativo') : array_push($s, 1, 'Ativo'); ?>
		<?php (in_array(1, $s)) ? array_push($s, 0, 'Inativo') : array_push($s, 1, 'Ativo'); ?>

		<div class="form-group">
			<label>Status</label>
			<select name="status" class="form-control" required>
				<option value="<?= $s[0]; ?>"><?= $s[1]; ?></option>
				<option value="<?= $s[2]; ?>"><?= $s[3]; ?></option>
			</select>
		</div>

		<button type="submit" class="btn btn-success">Editar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</form>
</div>
