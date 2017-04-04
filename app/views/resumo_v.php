<?php 
	$meses = array(
		1 => 'janeiro', 2 => 'fevereiro', 3 => 'março', 4 => 'abril', 5 => 'maio', 6 => 'junho',
		7 => 'julho', 8 => 'agosto', 9 => 'setembro', 10 => 'outubro', 11 => 'novembro', 12 => 'dezembro'
	);
?>

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
					<option value="<?= $c->id; ?>"><?= ucwords($c->nome); ?></option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="form-group">
			<label>Período</label>
			<select name="periodo" class="form-control">
				<option value="0">Selecione</option>
				<?php foreach ($periodos->result() as $p): ?>
					<option value="<?= $p->id; ?>"><?= ucfirst($p->tipo); ?></option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="form-group">
			<label>Mês</label>
			<select name="mes" class="form-control">
				<option value="0">Selecione</option>
				<?php foreach ($meses as $valor => $mes): ?>
					<option value="<?= $valor; ?>"><?= ucfirst($mes); ?></option>
				<?php endforeach ?>
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
