<div class="container">
	<h3><?php echo $titulo; ?></h3>

	<div class="dist-topo"></div>

	<button class="btn btn-info btn-xs" onclick="abreFechaAjuda()">Ajuda</button>

	<div class="dist-topo"></div>

	<div class="alert alert-info fade in hidden ajuda">
		Criar classe de ajuda e colocar ajuda em métodos PHP <a href="#" class="close" onclick="fechaAlerta(this);">&times;</a>
	</div>

	<div class="dist-topo"></div>

	<?php if ($alunos !== FALSE): ?>
		<form action="./processaAtual?c=<?= $curso; ?>" method="post">
			<center>
				<button type="button" class="btn btn-primary btn-xs" onclick="marcarTodos(this);">Marcar todos</button>
			</center>

			<div class="dist-topo"></div>

			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>Matricula</th>
						<th>Nome</th>
						<th>Pago</th>
					</tr>
					<?php foreach ($alunos->result() as $a): ?>
						<tr>
							<td><?php echo $a->aluno_matricula; ?></td>
							<td><?php echo ucwords($a->nome); ?></td>
							<td><input type="checkbox" name="pago[]" class="check" value="<?php echo $a->id; ?>"></td>
						</tr>
					<?php endforeach ?>
				</table>
			</div>

			<button type="submit" class="btn btn-success">Processar</button>
		</form>
	<?php else: ?>
		<p class="text-center">Não existem pagamentos pendentes</p>
		<center><a href="javascript: window.history.back();">voltar</a></center>
	<?php endif ?>
</div>
