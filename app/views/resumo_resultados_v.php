<?php 
	$meses = array(
		NULL, 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho',
		'julho', 'agosto', 'setembro',  'outubro',  'novembro',  'dezembro'
	);
?>

<div class="container">
	<h3><?php echo $titulo; ?></h3>

	<div class="dist-topo"></div>

	<center><a href="javascript: history.back();" class="btn btn-primary btn-xs">Nova pesquisa</a></center>

	<div class="dist-topo"></div>

	<div class="table-responsive">
		<table class="table">
			<?php if (isset($result->aluno)): ?>
				<tr>
					<td><b>Matricula</b></td>
					<td><?= $result->matricula; ?></td>
				</tr>
				<tr>
					<td><b>Aluno</b></td>
					<td><?= ucwords($result->aluno); ?></td>
				</tr>
			<?php endif ?>
			<tr>
				<td><b>Curso</b></td>
				<td><?= (isset($result->curso)) ? ucwords($result->curso) : '---'; ?></td>
			</tr>
			<tr>
				<td><b>Período</b></td>
				<td><?= (isset($result->periodo)) ? ucwords($result->periodo) : '---'; ?></td>
			</tr>
			<tr>
				<td><b>Mês</b></td>
				<td><?= (isset($result->mes)) ? ucfirst($meses[$result->mes]) : '---'; ?></td>
			</tr>
			<tr>
				<td><b>Ano</b></td>
				<td><?= (isset($result->ano)) ? $result->ano : '---'; ?></td>
			</tr>
			<tr>
				<td><b>Presenças</b></td>
				<td><?= $result->presencas; ?></td>
			</tr>
		</table>
	</div>
</div>
