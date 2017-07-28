<div class="container">
	<h3><?php echo $titulo; ?></h3>

	<div class="dist-topo"></div>

	<div class="alert alert-danger fade in resposta hidden"></div>

	<?php echo $resp; ?>

	<h4 class="vermelho">Atenção!</h4>

	<p>Ao clicar no botão <span class="vermelho">Gerar lista</span>, uma nova lista de pagamentos será criada.</p>

	<div class="dist-topo"></div>

	<form action="./gerarLista" method="post" onsubmit="javascript: return executaAcao();">
		<?php if ($listaExiste === FALSE): ?>
			<button type="submit" class="btn btn-success" name="novalista" value="novalista">Gerar lista</button>
		<?php else: ?>
			<p class="text-center"><b>Aguarde o próximo mês para nova lista</b></p><br />
			<center>
				<?php echo anchor('pagamentos/atual', 'Lista atual', array('class' => 'btn btn-sm btn-primary')); ?>
			</center>
		<?php endif ?>
	</form>
</div>
