<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por gerenciar os professores
*/

class Professores extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->login->checaSessao();

		$this->usuario = $this->session->userdata();
		$this->login->checaPermissao($this->usuario['permissao']);

		$this->load->view('includes/header_v');
		$this->load->model('Cursos_m', 'cursos');
		$this->load->model('Professores_m', 'professor');
	}

	// página de cadastro
	function novo() {
		$dados['titulo'] = 'Novo Professor';
		$dados['cursos'] = $this->cursos->lista();
		$dados['permissao'] = $this->usuario['permissao'];
		$dados['mensagens'] = array(
			'Professor cadastrado com sucesso' => 'success', 
			'Erro ao cadastrar professor' => 'danger',
			'Erro: Escolha pelo menos um curso' => 'warning'
		);

		$this->load->view('cadastra_professores_v', $dados);
	}

	// efetua cadastro
	function novoProfessor() {
		$cursos = $this->input->post('cursos');

		if (empty($cursos)) {
			redirect('professores/novo?r=warning');
		}

		$professor = array(
			'nome' => $this->input->post('nome'),
			'email' => $this->input->post('email'),
			'senha' => sha1($this->input->post('senha1')),
			'dataCadastro' => mdate('%Y-%m-%d %H:%i:%s'),
			'permissao_id' => $this->input->post('permissao'),
			'status' => $this->input->post('status')
		);

		// envia dados ao model (tabela 'professor')
		$cadastraProfessor = $this->professor->cadastraProfessor($professor);

		if ($cadastraProfessor !== FALSE) {
			foreach ($cursos as $c) {
				$cursoProfessor = array('curso_id' => $c, 'professor_matricula' => $cadastraProfessor->matricula);

				// envia dados ao model (tabela 'curso_has_professor')
				$resultado = $this->professor->cadastraCursoProfessor($cursoProfessor);

				if ($resultado !== TRUE) {
					redirect('professores/novo?r=danger');
				}
			}
		}
		else {
			redirect('professores/novo?r=danger');
		}

		redirect('professores/novo?r=success');
	}

	// página de edição
	function editar() {
		$idProfessor = $this->input->get('p');

		if (!isset($idProfessor) || empty($idProfessor)) {
			show_404();
		}

		// carrega dados do professor (model)
		$professor = $this->professor->listaProfessor($idProfessor, $this->usuario['permissao']);

		if ($professor === FALSE) {
			redirect('professores/lista?r=false');
		}

		$dados['titulo'] = 'Editar professor';
		$dados['permissao'] = $this->usuario['permissao'];
		$dados['professor'] = $professor;
		$dados['cursos'] = $this->cursos->lista();
		$dados['cursosProfessor'] = $this->professor->listaCursosDoProfessor($idProfessor);

		$this->load->view('edita_professores_v', $dados);
	}

	// efetua edição
	function editarProfessor() {
		$professor = array(
			'matricula' => $this->input->post('matricula'),
			'nome' => $this->input->post('nome'),
			'email' => $this->input->post('email'),
			'permissao_id' => $this->input->post('permissao'),
			'status' => $this->input->post('status')
		);

		$cursosProfessor = $this->input->post('cursos');
		$senhaProfessor = $this->input->post('senha1');

		if (!empty($senhaProfessor)) {
			$professor['senha'] = sha1($senhaProfessor);
		}

		// envia dados editados ao model (tabela professor)
		$editaProfessor = $this->professor->editaProfessor($professor);

		if ($editaProfessor) {
			if (!empty($cursosProfessor)) {
				foreach ($cursosProfessor as $cp) {

					// envia dados editados ao model (tabela curso_has_professor)
					$resultado = $this->professor->editaCursoProfessor($cp, $professor['matricula']);

					if ($resultado !== TRUE) {
						redirect('professores/editar?p=' . $professor['matricula'] . '&r=danger');
					}
				}
			}

			redirect('professores/lista?r=success');
		}
		else {
			redirect('professores/editar?p=' . $professor['matricula'] . '&r=danger');
		}
	}

	// página que exibe a lista de professores
	function lista() {
		$dados['titulo'] = 'Professores';
		$dados['professores'] = $this->professor->listaProfessores($this->usuario['permissao']);

		$this->load->view('lista_professores_v', $dados);
	}
}

?>
