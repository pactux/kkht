<?php $mensagens = array('Erro: Você não marcou presenças' => 'danger', 'Chamada realizada' => 'success'); ?>

<div class="container">
	<h3>Curso e período</h3>

	<div class="dist-topo"></div>

	<?php if ($msg = array_search($resp, $mensagens)): ?>
		<div class="alert alert-<?= $mensagens[$msg]; ?> fade in">
			<?= $msg; ?> <a href="#" class="close" onclick="fechaAlerta(this);">&times;</a>
		</div>
	<?php endif ?>

	<?php if ($cursos === FALSE): ?>
		<p class="vermelho">Não existem cursos para você</p>
	<?php else: ?>
		<form action="chamada/alunos" method="get">
			<div class="form-group">
				<select name="curso" class="form-control" required>
					<option value="">Selecione o curso</option>
					<?php foreach ($cursos->result() as $c): ?>
						<option value="<?= $c->id; ?>"><?= ucwords($c->nome); ?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<select name="periodo" class="form-control" required>
					<option value="">Selecione o período</option>
					<?php foreach ($periodos->result() as $p): ?>
						<option value="<?= $p->id; ?>"><?= ucwords($p->tipo); ?></option>
					<?php endforeach ?>
				</select>
			</div>

			<button type="submit" class="btn btn-success">Chamada</button>
		</form>
	<?php endif ?>
</div>
