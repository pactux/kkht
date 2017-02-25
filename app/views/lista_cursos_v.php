<div class="container">
	<h3><?php echo $titulo; ?></h3>

	<p>Escolha um curso para visualizar os alunos</p>

	<div class="dist-topo"></div>

	<?php if (isset($resp)): ?>
		<div class="alert alert-warning">
			Aluno(s) não encontrado(s) <a href="#" class="close" onclick="fechaAlerta(this);">&times;</a>
		</div>
	<?php endif ?>

	<form action="listaalunoscurso" method="get">
		<div class="form-group">
			<select name="c" id="pes-curso" class="form-control" required>
				<option value="">Selecione</option>
				<?php foreach ($cursos->result() as $c): ?>
					<option value="<?php echo $c->id; ?>"><?php echo ucwords($c->nome); ?></option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="hidden">
			<input type="text" name="na" id="pes-rapida" class="form-control" />
		</div>

		<button type="submit" class="btn btn-success">Buscar</button>
		<button type="reset" class="btn btn-default">Cancelar</button>
	</form>

	<div class="dist-topo"></div>

	<center>
		<button class="btn btn-primary btn-xs" onclick="campoPesquisaRapida(this)">Pesquisa por aluno</button>
	</center>
</div>
