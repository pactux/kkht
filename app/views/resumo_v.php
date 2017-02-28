<div class="container">
	<h3><?= 'Busca por ' . $titulo; ?></h3>

	<div class="dist-topo"></div>

	<?php if (isset($resp)): ?>
		<div class="alert alert-danger fade in">
			Erro: busca não realizada <a href="#" class="close" onclick="fechaAlerta(this);">&times;</a>
		</div>
	<?php endif ?>

	<form action="resultadosbusca" method="post">
		<?php if ($tipoBusca === 'aluno'): ?>
			<div class="form-group">
				<label for="matricula">Matricula</label>
				<input type="number" name="matricula" id="matricula" class="form-control" required />
			</div>
		<?php endif ?>

		<div class="form-group">
			<label>Curso</label>
			<select name="curso" class="form-control" required>
				<option value="">Selecione</option>
				<?php foreach ($cursos->result() as $c): ?>
					<option value="<?= $c->id; ?>"><?= $c->nome; ?></option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="form-group">
			<label>Período</label>
			<select name="periodo" class="form-control">
				<option value="0">Selecione</option>
				<?php foreach ($periodos->result() as $p): ?>
					<option value="<?= $p->id; ?>"><?= $p->tipo; ?></option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="form-group">
			<label>Mês</label>
			<select name="mes" class="form-control">
				<option value="0">Selecione</option>
				<?php for ($i = 1; $i < 13; $i += 1): ?>
					<option value="<?= $i; ?>"><?= $i; ?></option>
				<?php endfor ?>
			</select>
		</div>

		<div class="form-group">
			<label>Ano</label>
			<select name="ano" class="form-control" required>
				<option value="">Selecione</option>
				<option value="2017">2017</option>
			</select>
		</div>

		<button type="submit" class="btn btn-success">Pesquisar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</form>
</div>
