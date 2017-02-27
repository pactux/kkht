<div class="container">
	<h3><?php echo 'Aula de ' . ucwords($curso->nome); ?></h3>

	<div class="dist-topo"></div>

	<?php if (isset($resp)): ?>
		<div class="alert alert-<?= $resp; ?> fade in">
			Erro: chamada não realizada <a href="#" onclick="fechaAlerta(this);">&times;</a>
		</div>
	<?php endif ?>

	<div class="informacoes">
		<span><b>Professor:</b> <?php echo $professor; ?></span><br />
		<span><b>Data da aula:</b> <?php echo $hoje; ?></span>
	</div>

	<div class="dist-topo"></div>

	<form action="salvachamada?<?= 'c=' . $curso->id . '&p=' . $periodo ?>" method="post" onsubmit="salvaChamada(this)">

		<center>
			<button type="button" class="btn btn-primary btn-xs" id="mt" onclick="marcarTodos(this);">Marcar todos</button>
		</center>

		<div class="dist-topo"></div>

		<div class="table-responsive">
			<table class="table">
				<tr>
					<th>Mat</th>
					<th>Nome</th>
					<th>Presente</th>
				</tr>
				<?php foreach ($alunos->result() as $a): ?>
				<tr>
					<td><?= $a->matricula; ?></td>
					<td><?= ucwords($a->nome); ?></td>
					<td><input type="checkbox" name="presente[]" class="check" value="<?= $a->matricula; ?>" /></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>

		<p class="vermelho">Ao <u>salvar</u>, a ação não poderá ser desfeita</p>

		<button type="submit" class="btn btn-success">Salvar</button>
	</form>
</div>
