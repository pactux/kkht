<div class="container">
	<h3><?php echo $titulo; ?></h3>

	<div class="dist-topo"></div>

	<button class="btn btn-info btn-xs" onclick="abreFechaAjuda()">Ajuda</button>

	<div class="dist-topo"></div>

	<!-- exibe texto de ajuda -->
	<div class="alert alert-info fade in hidden ajuda"><?php echo $ajuda['texto']; ?></div>

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
