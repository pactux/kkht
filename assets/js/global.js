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
	$tag.parentNode.classList.add('hidden');
}

// exibe/esconde as janelas de ajuda
function abreFechaAjuda () {
  var $ajuda = document.getElementsByClassName('ajuda');
  var $existe = $ajuda[0].classList.contains('hidden');

  ($existe === true) ? $ajuda[0].classList.remove('hidden') : $ajuda[0].classList.add('hidden');
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

// alterna os campos de busca na seção 'Alunos'
function campoPesquisaRapida($bt) {
  var $form = document.getElementsByTagName('form');
  var $select = document.getElementById('pes-curso');
  var $input = document.getElementById('pes-rapida');

  if ($input.parentNode.className === 'hidden') {
    $select.parentNode.className = 'hidden';
    $select.removeAttribute('required');

    $input.parentNode.className = 'form-group show';
    $input.placeholder = 'Digite o nome do Aluno';
    $input.required = 'true';

    $form[0].action = 'buscaalunonome';
    $bt.innerText = 'Pesquisa por curso';

  }
  else {
    $input.parentNode.className = 'hidden';
    $input.removeAttribute('required');

    $select.parentNode.className = 'form-group show';
    $select.required = 'true';

    $form[0].action = 'listaalunoscurso';
    $bt.innerText = 'Pesquisa por aluno';
  }
}

// Armazena os cursos a serem removidos
function cursosRemovidos($tag) {
  var $i = null, $desmarcar = null;
  var $valor = $tag.getAttribute('value');
  var $input = document.createElement('input');
  var $divRemover = document.getElementById('remover');
  var $classeInput = document.getElementsByClassName('remover');

  if ($tag.getAttribute('checked') === 'true') {
    $desmarcar = window.confirm('Remover curso?');

    if ($desmarcar === false) {
      $tag.checked = 'true';
    }
    else {
      $tag.removeAttribute('checked');
      $divRemover.style.visibility = 'hidden';

      if ($divRemover.hasChildNodes()) {
        if ($divRemover.lastChild.value === $valor) {
          $divRemover.removeChild($divRemover.lastChild);
        }
      }

      $input.type = 'checkbox';
      $input.name = 'remover[]';
      $input.checked = 'true';
      $input.className = 'remover';
      $input.value = $valor;

      $divRemover.appendChild($input);
    }
  }
  else {
    $tag.setAttribute('checked', 'true');

    for ($i = 0; $i < $divRemover.childNodes.length; $i += 1) {
      if ($valor === $divRemover.childNodes[$i].getAttribute('value')) {
        $divRemover.removeChild($divRemover.childNodes[$i]);
      }
    }
  }
}

// controla a marcação de todos os campos checkbox
function marcarTodos($bt) {
  var $i = null;
  var $textoBotao = $bt.innerText.toLowerCase();
  var $campoCheckbox = document.getElementsByClassName('check');

  for ($i = 0; $i < $campoCheckbox.length; $i += 1) {
    if ($campoCheckbox[$i].getAttribute('checked') === '') {
      $campoCheckbox[$i].checked = '';
      $campoCheckbox[$i].removeAttribute('checked');
    }
    else {
      $campoCheckbox[$i].checked = 'true';
      $campoCheckbox[$i].setAttribute('checked', '');
    }
  }

  ($textoBotao === 'marcar todos') ? $bt.innerText = 'Desmarcar todos' : $bt.innerText = 'Marcar todos';
}

// confirma o envio do formulário
function salvaChamada($form) {
  $testa = window.confirm('Finalizar chamada?');
  ($testa === true) ? $form.action = $form.action : $form.action = '#';
}

// confirma a execução de uma ação
function executaAcao() {
  var $resposta = document.getElementsByClassName('resposta');
  var $executa = window.confirm('Prosseguir com ação?');

  if ($executa === true) {
    return true;
  }
  else {
    $resposta[0].classList.remove('hidden');
    $resposta[0].innerText = 'Ação não executada';
    return false;
  }
}

window.onload = function() {
  // insere titulo no app
  return document.title = 'KKHT - ' + document.getElementsByTagName('h3')[0].innerText;
}
