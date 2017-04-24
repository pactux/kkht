<div class="container">
	<h3><?php echo $titulo; ?></h3>

	<div class="dist-topo"></div>

	<button class="btn btn-info btn-xs" onclick="abreFechaAjuda()">Ajuda</button>

	<div class="dist-topo"></div>

	<!-- exibe texto de ajuda -->
	<div class="alert alert-info fade in hidden ajuda">
		<a href="#" class="close" onclick="fechaAlerta(this);">&times;</a> <?php echo $ajuda['texto']; ?>
	</div>

	<div class="dist-topo"></div>

	<!-- exibe alerta HTML -->
	<?php if (isset($_GET['r'])): ?>
		<?php if ($_GET['r'] === 'false'): ?>
			<div class="alert alert-warning">Professor não encontrado <a href="#" onclick="fechaAlerta(this)" class="close">&times;</a></div>
		<?php elseif ($_GET['r'] === 'success'): ?>
			<div class="alert alert-success">Dados alterados <a href="#" onclick="fechaAlerta(this)" class="close">&times;</a></div>
		<?php endif ?>
	<?php endif ?>

	<!-- lista de professores em formato tabela -->
	<div class="table-responsive">
		<table class="table">
			<tr>
				<th>Matrícula</th>
				<th>Nome</th>
				<th>Mais</th>
			</tr>
			<?php foreach ($professores->result() as $p): ?>
				<tr>
					<td><?php echo $p->matricula; ?></td>
					<td><?php echo $p->nome; ?></td>
					<td><a href="editar?p=<?php echo $p->matricula; ?>" class="btn btn-info btn-xs">ver</a></td>
				</tr>
			<?php endforeach ?>
		</table>
	</div>

</div>
