<?php $mensagens = array('Pagamentos processados!' => 'success', 'Erro ao processar pagamentos' => 'danger'); ?>

<div class="container">
	<h3><?php echo $titulo; ?></h3>

	<div class="dist-topo"></div>

	<!-- exibir resposta na página de acordo com a ação -->
	<?php if ($msg = array_search($resp, $mensagens)): ?>
		<div class="alert alert-<?php echo $mensagens[$msg]; ?> fade in">
			<?php echo $msg; ?> <a href='#' class='close' onclick="fechaAlerta(this);">&times;</a>
		</div>
	<?php endif ?>

	<div class="dist-topo"></div>

	<button class="btn btn-info btn-xs" onclick="abreFechaAjuda()">Ajuda</button>

	<div class="dist-topo"></div>

	<div class="alert alert-info fade in hidden ajuda">
		Criar classe de ajuda e colocar ajuda em métodos PHP <a href="#" class="close" onclick="fechaAlerta(this);">&times;</a>
	</div>

	<div class="dist-topo"></div>

	<form action="./exibeAtual" method="post">
		<div class="form-group">
			<select name="curso-id" class="form-control" required>
				<option value="">Selecione um curso</option>
				<?php foreach ($cursos->result() as $c): ?>
					<option value="<?php echo $c->id; ?>"><?php echo ucwords($c->nome); ?></option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-success">Buscar</button>
		</div>
	</form>
</div>
