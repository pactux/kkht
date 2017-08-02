<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por controlar os pagamentos realizados
*/

class Pagamentos extends CI_Controller {
	private $meses = NULL;
	private $curso = NULL;
	private $dados = NULL;
	private $novaLista = NULL;
	private $geraNovaLista = NULL;
	private $pago = NULL;
	private $processa = NULL;
	private $mes = NULL;
	private $ano = NULL;

	function __construct() {
		parent::__construct();
		$this->login->checaSessao();

		$this->usuario = $this->session->userdata();
		$this->login->checaPermissao($this->usuario['permissao']);

		$this->load->view('includes/header_v');

		$this->load->model('Cursos_m', 'cursos');
		$this->load->model('Alunos_m', 'alunos');
		$this->load->model('Pagamentos_m', 'pagamentos');
		$this->load->model('Ajuda_m', 'ajuda');
	}

	// repopula tabela de pagamentos
	function gerarLista() {
		$this->dados['resp'] = '';
		$this->novaLista = $this->input->post('novalista');
		$this->dados['listaExiste'] = $this->pagamentos->checaListaExiste(mdate("%m"), mdate("%Y"));

		if (!empty($this->novaLista)) {
			$this->geraNovaLista = $this->pagamentos->novaLista();

			if ($this->geraNovaLista) {
				$this->dados['resp'] = "<div class='alert alert-success fade in'>Lista gerada com sucesso!</div>";
			}
			else {
				$this->dados['resp'] = "<div class='alert alert-danger fade in'>Erro! Contate o Admin do sistema</div>";
			}
		}

		$this->dados['titulo'] = 'Gerar lista de pagamentos';
		$this->load->view('gerar_lista_pagamentos_v', $this->dados);
	}

	// funções 'atuais' trabalham com o mês vigente
	function atual() {
		$this->dados['titulo'] = 'Busca pagamentos';
		$this->dados['resp'] = $this->input->get('r');
		$this->dados['cursos'] = $this->cursos->listaPorStatus(1);
		$this->dados['ajuda'] = $this->ajuda->buscaAjuda(6);

		$this->load->view('busca_pagamentos_atual_v', $this->dados);
	}

	function exibeAtual() {
		// exibe alunos que ainda não pagaram
		$this->curso = $this->input->post('curso-id');

		if (empty($this->curso)) {
			show_404();
			exit();
		}

		$this->dados['titulo'] = 'Pagamentos - ' . ucwords($this->cursos->listaCursoNome($this->curso)->row()->nome);
		$this->dados['curso'] = $this->curso;
		$this->dados['alunos'] = $this->pagamentos->listaPagamentos($this->curso, 0, mdate("%m"), mdate("%Y"));

		$this->load->view('pagamentos_v', $this->dados);
	}

	// processa os pagamentos realizados
	function processaAtual() {
		$this->curso = $this->input->get('c');
		$this->pago = $this->input->post('pago');

		if (empty($this->curso) || empty($this->pago)) {
			show_404();
			exit();
		}

		$this->processa = $this->pagamentos->processaPagamentos($this->pago);

		if ($this->processa) {
			redirect('pagamentos/atual?r=success');
		}
		else {
			redirect('pagamentos/atual?r=danger');
		}
	}

	// funções 'historico' trabalham com meses anteriores
	function historico() {
		$this->dados['titulo'] = 'Histórico de pagamentos';
		$this->dados['cursos'] = $this->cursos->listaPorStatus(1);
		$this->dados['meses'] = $this->listaMeses();
		$this->dados['anos'] = $this->anosAnteriores();
		$this->dados['ajuda'] = $this->ajuda->buscaAjuda(8);

		$this->load->view('busca_pagamentos_historico_v', $this->dados);
	}

	function exibeHistorico() {
		$this->curso = $this->input->post('curso-id');
		$this->pago = $this->input->post('pago');
		$this->mes = $this->input->post('mes');
		$this->ano = $this->input->post('ano');

		if (!isset($this->curso, $this->pago, $this->mes, $this->ano)) {
			show_404();
			exit();
		}

		$this->dados['mesNum'] = $this->mes;
		$this->dados['ano'] = $this->ano;
		$this->dados['pago'] = $this->pago;
		$this->dados['curso'] = $this->curso;
		$this->dados['mesNome'] = $this->listaMeses();

		$this->dados['titulo'] = 'Histórico - ' . ucwords($this->cursos->listaCursoNome($this->curso)->row()->nome);
		$this->dados['alunos'] = $this->pagamentos->listaPagamentos($this->curso, $this->pago, $this->mes, $this->ano);

		$this->load->view('pagamentos_historico_v', $this->dados);

	}

	function anosAnteriores() {
		return ($this->pagamentos->buscaAnos()) ? $this->pagamentos->buscaAnos() : FALSE;
	}

	function listaMeses() {
		$this->meses = array(
			'01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril', '05' => 'Maio', '06' => 'Junho',
			'07' => 'Julho', '08' => 'Agosto', '09' => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
		);

		return $this->meses;
	}
}

?>
