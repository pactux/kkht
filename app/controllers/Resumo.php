<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por criar buscas e preparar os resultados de pesquisa
*/

class Resumo extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->login->checaSessao();

		$this->usuario = $this->session->userdata();
		$this->login->checaPermissao($this->usuario['permissao']);

		$this->load->model('Resumo_m', 'resumo');
		$this->load->model('Cursos_m', 'cursos');
		$this->load->model('Chamada_m', 'chamada');

		$this->load->view('includes/header_v');
	}

	// monta página de busca
	function busca() {
		$resp = $this->input->get('r');
		$tipoBusca = $this->input->get('b');

		if ($tipoBusca === 'periodo' || isset($resp)) $titulo = 'período';
		elseif ($tipoBusca === 'aluno') $titulo = 'aluno';
		else show_404();

		$dados['resp'] = $resp;
		$dados['titulo'] = $titulo;
		$dados['tipoBusca'] = $tipoBusca;
		$dados['cursos'] = $this->cursos->listaPorStatus(1);
		$dados['periodos'] = $this->chamada->listaPeriodos();

		$this->load->view('resumo_v', $dados);
	}

	// recebe os resultados e monta em uma nova página
	function resultadosBusca() {
		$matricula = $this->input->post('matricula');
		$curso = $this->input->post('curso');
		$periodo = $this->input->post('periodo');
		$mes = $this->input->post('mes');
		$ano = $this->input->post('ano');

		$busca = $this->resumo->resumoPorPeriodo($matricula, $curso, $periodo, $mes, $ano);

		if ($busca === FALSE) redirect('resumo/busca?r=danger');

		$dados['titulo'] = 'Resultados';
		$dados['result'] = $busca->row();

		$this->load->view('resumo_resultados_v', $dados);
	}
}

?>
