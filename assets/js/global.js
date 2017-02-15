// funcionamento do menu

function menuMobile() {
  var $btMobile = document.getElementById('navbar');

  if ($btMobile.getAttribute('class') == 'collapse navbar-collapse') {
    $btMobile.setAttribute('class', 'collapse in navbar-collapse');
  }
  else {
    $btMobile.setAttribute('class', 'collapse navbar-collapse');
  }
}

function subMenu($menu) {
  if ($menu.getAttribute('class') == 'dropdown') {
    $menu.setAttribute('class', 'dropdown open');
  }
  else {
    $menu.setAttribute('class', 'dropdown');
  }
}

function fechaAlerta($tag) {
	$tag.parentNode.hidden = 'true';
}

// funcionamento dos campos de senha

function comparaSenhas() {
  var $senha1 = document.getElementById('senha1');
  var $senha2 = document.getElementById('senha2');
  var $btSubmit = document.getElementsByClassName('btn btn-success');
  var $aviso = document.getElementsByClassName('aviso');

  // checa se as senhas são diferentes
  if ($senha1.value != $senha2.value) {
    $btSubmit[0].setAttribute('disabled', '');
    $aviso[0].removeAttribute('hidden');

    $senha1.style.borderColor = '#ff0000';
    $senha2.style.borderColor = '#ff0000';

    return false;
  }
  else {
    $btSubmit[0].removeAttribute('disabled');
    $aviso[0].setAttribute('hidden', '');

    $senha1.style.borderColor = '#cccccc';
    $senha2.style.borderColor = '#cccccc';

    return true;
  }
}

function mostraSenha() {
  var $divSenha = document.getElementById('mostra-senha');
  var $senha1 = document.getElementById('senha1');
  var $senha2 = document.getElementById('senha2');

  // checa se os campos de senha estão visíveis
  if ($divSenha.className === 'hidden') {
    $divSenha.className = 'show';

    $senha1.placeholder = 'No mínimo 8 dígitos';
    $senha1.setAttribute('required', '');
    $senha2.setAttribute('required', '');
  }
  else {
    $divSenha.className = 'hidden';

    $senha1.removeAttribute('required');
    $senha2.removeAttribute('required');
  }

}
