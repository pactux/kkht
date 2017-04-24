<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por gerenciar os alunos
*/

class Alunos extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->login->checaSessao();

		$this->usuario = $this->session->userdata();
		$this->login->checaPermissao($this->usuario['permissao']);

		$this->load->view('includes/header_v');
		$this->load->model('Cursos_m', 'cursos');
		$this->load->model('Alunos_m', 'alunos');
		$this->load->model('Ajuda_m', 'ajuda');
	}

	// monta página de cadastro
	function novo() {
		$dados['titulo'] = 'Novo Aluno';
		$dados['resp'] = $this->input->get('r');
		$dados['cursos'] = $this->cursos->listaPorStatus(1);

		$this->load->view('cadastra_alunos_v', $dados);
	}

	// efetua cadastro
	function novoAluno() {
		$cursos = $this->input->post('cursos');

		if (empty($cursos)) redirect('alunos/novo?r=warning');

		$aluno = array(
			'nome' => strtolower($this->input->post('nome')),
			'celular' => $this->input->post('celular'),
			'dataNascimento' => $this->input->post('nascimento'),
			'dataCadastro' => mdate('%Y-%m-%d %H:%i:%s'),
			'status' => $this->input->post('status')
		);

		$fd = explode('-', $aluno['dataNascimento']);
		$aluno['dataNascimento'] = $fd[2] . '-' . $fd[1] . '-' . $fd[0];

		$cadastra = $this->alunos->cadastraAlunos($aluno);

		if ($cadastra !== FALSE) {
			foreach ($cursos as $c) {
				$cursoAluno = array('curso_id' => $c, 'aluno_matricula' => $cadastra->matricula);
				$resultado = $this->alunos->cadastraCursoAluno($cursoAluno);

				if ($resultado !== TRUE) redirect('alunos/novo?r=danger');
			}
		}
		else {
			redirect('alunos/novo?r=danger');
		}

		redirect('alunos/novo?r=success');
	}

	function listaCursos() {
		$dados['titulo'] = 'Todos os Cursos';
		$dados['ajuda'] = $this->ajuda->buscaAjuda(1);
		$dados['resp'] = $this->input->get('r');
		$dados['cursos'] = $this->cursos->listaPorStatus(1);

		$this->load->view('lista_cursos_v', $dados);
	}

	// busca com o select de cursos
	function listaAlunosCurso() {
		$curso = $this->input->get('c');
		$alunos = $this->alunos->listaAlunos($curso);

		if ($alunos === FALSE) {
			redirect('alunos/listacursos?r=warning');
		}
		else {
			$dados['titulo'] = 'Alunos do ' . ucwords($this->cursos->listaCursoNome($curso)->row()->nome);
			$dados['alunos'] = $alunos;

			$this->load->view('lista_alunos_v', $dados);
		}
	}

	// busca com o campo de pesquisa
	function buscaAlunoNome() {
		$nome = $this->input->get('na');
		$alunos = $this->alunos->buscaAluno($nome);

		if ($alunos === FALSE) {
			redirect('alunos/listacursos?r=warning');
		}
		else {
			$dados['titulo'] = 'Alunos encontrados';
			$dados['alunos'] = $alunos;

			$this->load->view('lista_alunos_v', $dados);
		}
	}

	// monta página de edição
	function editar() {
		$idAluno = $this->input->get('a');
		$resp = $this->input->get('r');

		if (!isset($idAluno) || empty($idAluno)) redirect('alunos/listacursos?r=warning');

		$aluno = $this->alunos->listaAluno($idAluno);

		if ($aluno === FALSE) {
			redirect('alunos/listacursos?r=warning');
		}
		else {
			$dados['titulo'] = 'Editar Aluno';
			$dados['resp'] = $resp;
			$dados['aluno'] = $aluno->row();
			$dados['cursos'] = $this->cursos->lista();
			$dados['cursosAluno'] = $this->alunos->listacursosDoAluno($idAluno);
	
			$this->load->view('edita_alunos_v', $dados);
		}
	}

	// efetua edição
	function editarAluno() {
		$aluno = array(
			'matricula' => $this->input->post('matricula'),
			'nome' => strtolower($this->input->post('nome')),
			'celular' => $this->input->post('celular'),
			'dataNascimento' => $this->input->post('nascimento'),
			'status' => $this->input->post('status')
		);

		$cursos = $this->input->post('cursos');
		$removerCursos = $this->input->post('remover');

		if (empty($cursos)) redirect('alunos/editar?a=' . $aluno['matricula'] . '&r=warning');

		// formata data para o padrão MySQL
		$fd = explode('-', $aluno['dataNascimento']);
		$aluno['dataNascimento'] = $fd[2] . '-' . $fd[1] . '-' . $fd[0];

		// envia os dados editados ao model
		$editaAluno = $this->alunos->editaAluno($aluno);

		if ($editaAluno !== FALSE) {
			foreach ($cursos as $cn) {
				// envia dados editados ao model
				$resultado = $this->alunos->editaCursoAluno($cn, $aluno['matricula'], FALSE);

				if ($resultado !== TRUE) redirect('alunos/editar?a=' . $aluno['matricula'] . '&r=danger');
			}

			foreach ($removerCursos as $rc) {
				// envia dados editados ao model
				$resultado = $this->alunos->editaCursoAluno($rc, $aluno['matricula'], TRUE);

				if ($resultado !== TRUE) redirect('alunos/editar?a=' . $aluno['matricula'] . '&r=danger');
			}

			redirect('alunos/editar?a=' . $aluno['matricula'] . '&r=success');
		}
		else {
			redirect('alunos/editar?a=' . $aluno['matricula'] . '&r=danger');
		}
	}
}

?>
