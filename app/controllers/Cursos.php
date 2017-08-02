<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por gerenciar as páginas de cursos (cadastrar, exibir, etc)
*/

class Cursos extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->login->checaSessao();

		$this->usuario = $this->session->userdata();
		$this->login->checaPermissao($this->usuario['permissao']);

		$this->load->view("includes/header_v");
		$this->load->model('Cursos_m', 'curso');
		$this->load->model('Ajuda_m', 'ajuda');
	}

	// define o conteudo que será exibido na página (request)
	function index() {
		$acao = $this->input->get("a");
		$dados['resp'] = $this->input->get('r');

		if ($acao === 'cadastrar') {
			$dados['titulo'] = 'Novo Curso';
			$dados['request'] = 'cadastrar';
			$dados['ajuda'] = $this->ajuda->buscaAjuda(7);
			$this->load->view("cursos_v", $dados);
		}
		elseif ($acao === 'listar') {
			$dados['titulo'] = 'Todos os cursos';
			$dados['request'] = 'listar';
			$dados['ajuda'] = $this->ajuda->buscaAjuda(3);
			$dados['conteudo'] = $this->curso->lista();
			$this->load->view("cursos_v", $dados);
		}
		else {
			show_404();
		}
	}

	// cadastra novo curso
	function novo() {
		$curso = array('nome' => strtolower($this->input->post('nome')), 'status' => $this->input->post('status'));
		$cadastra = $this->curso->cadastra($curso);

		($cadastra) ? redirect('cursos?a=listar&r=success') : redirect('cursos?a=cadastrar&r=danger');
	}

	// altera status do curso
	function status() {
		$acao = $this->input->get('a');
		$curso = $this->input->get('c');

		if (isset($acao, $curso)) {
			$alteraStatus = $this->curso->altera($curso, array('status' => $acao));

			($alteraStatus) ? redirect('cursos?a=listar&r=success') : redirect('cursos?a=listar&r=danger');
		}

	}
}

?>
