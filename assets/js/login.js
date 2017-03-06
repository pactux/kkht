window.onload = function() {
	var $variavel = 'dadosIncorretos'.toLowerCase();
	var $url = window.location.href.toLowerCase().split('?');

	if ($url[1].indexOf($variavel) !==  -1) {
		var $novoLink = document.createElement('a');
		var $novaDiv = document.createElement('div');
		var $divSenha = document.getElementById('senha');

		$divSenha.style.textAlign = 'center';

		$novaDiv.className = 'altura';
		$novoLink.href = '#';
		$novoLink.innerHTML = 'Esqueci minha senha';

		$divSenha.appendChild($novaDiv);
		$divSenha.appendChild($novoLink);

		$novoLink.onclick = function() {
			var $bt = document.getElementsByTagName('button');
			var $alerta = document.getElementsByClassName('alert');
			var $form = document.getElementsByClassName('form-signin');
			var $campoSenha = document.getElementsByClassName('form-control');
			var $titulo = document.getElementsByClassName('form-signin-heading');

			$form[0].action = 'login/novaSenha';

			$alerta[0].style.display = 'none';
			$titulo[0].style.fontSize = '25px';
			$titulo[0].innerText = 'Recuperar senha';

			$campoSenha[1].style.display = 'none';
			$campoSenha[1].removeAttribute('required');

			$bt[0].innerText = 'Recuperar';
			$bt[0].style.marginTop = '10px';

			$novoLink.style.display = 'none';
		}
	}
}
