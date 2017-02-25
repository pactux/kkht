<div class="container">
	<h3><?php echo $titulo; ?></h3>

	<div class="dist-topo"></div>

	<div class="table-responsive">
		<table class="table">
			<tr>
				<th>Matricula</th>
				<th>Nome</th>
				<th>Status</th>
			</tr>
			<?php foreach ($alunos->result() as $a): ?>
				<tr>
					<td><?php echo $a->matricula; ?></td>
					<td><a href="editar?a=<?php echo $a->matricula; ?>"><?php echo ucwords($a->nome); ?></a></td>
					<?php echo ($a->status == 1) ? "<td class='ativo'>Ativo</td>" : "<td class='inativo'>Inativo</td>"; ?>
				</tr>
			<?php endforeach ?>
		</table>
	</div>
</div>
