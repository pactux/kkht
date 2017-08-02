<div class="container">
	<h3><?php echo $titulo; ?></h3>

	<div class="dist-topo"></div>

	<button class="btn btn-info btn-xs" onclick="abreFechaAjuda()">Ajuda</button>

	<div class="dist-topo"></div>

	<div class="alert alert-info fade in hidden ajuda"><?php echo $ajuda['texto']; ?></div>

	<div class="dist-topo"></div>

	<form action="./exibeHistorico" method="post">
		<div class="form-group">
			<select name="curso-id" class="form-control" required>
				<option value="">Selecione um curso</option>
				<?php foreach ($cursos->result() as $c): ?>
					<option value="<?php echo $c->id; ?>"><?php echo ucwords($c->nome); ?></option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="form-group">
			<select name="pago" class="form-control" required>
				<option value="">Selecione o status</option>
				<option value="1">Pago</option>
				<option value="0">Pendente</option>
			</select>
		</div>

		<div class="form-group">
			<select name="mes" class="form-control" required>
				<option value="">Selecione um mês</option>
				<?php foreach ($meses as $valor => $nome): ?>
					<option value="<?php echo $valor; ?>"><?php echo $nome; ?></option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="form-group">
			<select name="ano" class="form-control" required>
				<option value="">Selecione um ano</option>
				<?php if ($anos !== FALSE): ?>
					<?php foreach ($anos->result() as $ano): ?>
						<option value="<?php echo $ano->anoPagamento; ?>"><?php echo $ano->anoPagamento; ?></option>
					<?php endforeach ?>
				<?php else: ?>
					<option value="<?php echo mdate('%Y'); ?>"><?php echo mdate("%Y"); ?></option>
				<?php endif ?>
			</select>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-success">Buscar</button>
		</div>
	</form>
</div>
