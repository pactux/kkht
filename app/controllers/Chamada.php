<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por gerenciar as chamadas (presenças e relatórios)
*/

class Chamada extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->login->checaSessao();

		$this->usuario = $this->session->userdata();

		$this->load->view("includes/header_v");
		$this->load->model('Chamada_m', 'chamada');
		$this->load->model('Cursos_m', 'cursos');
	}

	// monta página de seleção de curso e período
	function index() {
		$dados['resp'] = $this->input->get('r');
		$dados['cursos'] = $this->chamada->listaCursosProfessor($this->usuario['matricula']);
		$dados['periodos'] = $this->chamada->listaPeriodos();

		$this->load->view("cursos_chamada_v", $dados);
	}

	// monta página com a lista de alunos
	function alunos() {
		$resp = $this->input->get('r');
		$curso = $this->input->get('curso');
		$periodo = $this->input->get('periodo');

		$dados['resp'] = $resp;
		$dados['periodo'] = $periodo;
		$dados['hoje'] = mdate('%d/%m/%Y');
		$dados['professor'] = $this->usuario['nome'];
		$dados['curso'] = $this->cursos->listaCursoNome($curso)->row();
		$dados['alunos'] = $this->chamada->listaAlunosCurso($curso);

		$this->load->view('chamada_v', $dados);
	}

	function salvaChamada() {
		$presentes = $this->input->post('presente');

		if (empty($presentes)) redirect('chamada?r=danger');

		$curso = $this->input->get('c');
		$periodo = $this->input->get('p');

		foreach ($presentes as $p) {
			$presenca = array(
				'aluno_matricula' => $p,
				'professor_matricula' => $this->usuario['matricula'],
				'curso_id' => $curso,
				'dataAula' => mdate('%Y-%m-%d'),
				'periodo_id' => $periodo,
				'presente' => 1
			);

			$salvar = $this->chamada->gravaPresencas($presenca);

			if ($salvar === FALSE) redirect('chamada/alunos?curso=' . $curso . '&periodo=' . $periodo . '&r=danger');
		}

		redirect('chamada?r=success');
	}
}

?>
