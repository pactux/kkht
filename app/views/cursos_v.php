<div class="container">
	<h3><?php echo $titulo; ?></h3>

	<div class="dist-topo"></div>

	<!-- exibe alerta HTML -->
	<?php if (isset($_GET['resposta'])): ?>
		<?php if ($_GET['resposta'] == 'true'): ?>
			<div class="alert alert-success fade in">
				Ação realizada com sucesso! <a href='#' class='close' onclick="fechaAlerta(this);">&times;</a>
			</div>
		<?php else: ?>
			<div class="alert alert-danger fade in">
				Erro ao realizar ação <a href='#' class='close' onclick="fechaAlerta(this);">&times;</a>
			</div>
		<?php endif ?>
	<?php endif ?>

	<?php if ($request == 'cadastrar'): ?>
		<form action="cursos/novo" method="post">
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" name="nome" class="form-control" id="nome" required />
			</div>

			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" class="form-control" id="status" required>
					<option value="">Selecione</option>
					<option value="1">Ativo</option>
					<option value="0">Inativo</option>
				</select>
			</div>

			<button class="btn btn-success" type="submit">Cadastrar</button>
			<button class="btn btn-default" type="reset">Cancelar</button>
		</form>
	<?php else: ?>
		<div class="table-responsive">
			<table class="table">
				<tr>
					<th>Curso</th>
					<th>Status</th>
					<th>#</th>
				</tr>
				<?php foreach ($conteudo->result() as $exibe): ?>
					<?php ($exibe->status == 0) ? $status = 'Inativo' : $status = 'Ativo'; ?>
					<tr>
						<td><?php echo $exibe->nome; ?></td>
						<td><?php echo $status; ?></td>
						<td>
							<?php if ($status == 'Ativo'): ?>
								<a href="cursos/status?a=0&c=<?php echo $exibe->id; ?>" class="btn btn-warning btn-xs">inativar</a>
							<?php else: ?>
								<a href="cursos/status?a=1&c=<?php echo $exibe->id; ?>" class="btn btn-success btn-xs">ativar</a>
							<?php endif ?>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
		</div>
	<?php endif ?>
</div>
