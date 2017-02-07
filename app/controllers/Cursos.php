<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por gerenciar a página de cursos (cadastrar, exibir, etc)
*/

class Cursos extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->login->checaSessao();
		$this->load->view("includes/header_v");
		$this->load->model('Cursos_m', 'curso');
	}

	// define o conteudo que será exibido na página (request)
	function index() {
		$acao = $this->input->get("acao");

		if ($acao == 'cadastrar') {
			$dados['titulo'] = 'Novo Curso';
			$dados['request'] = 'cadastrar';
			$this->load->view("cursos_v", $dados);
		}
		elseif ($acao == 'listar') {
			$dados['titulo'] = 'Todos os cursos';
			$dados['request'] = 'listar';
			$dados['conteudo'] = $this->curso->lista();
			$this->load->view("cursos_v", $dados);
		}
		else {
			show_404();
		}
	}

	// cadastra novo curso
	function novo() {
		$curso = array('nome' => $this->input->post('nome'), 'status' => $this->input->post('status'));
		$cadastra = $this->curso->cadastra($curso);

		($cadastra) ? redirect('cursos?acao=listar&resposta=true') : redirect('cursos?acao=cadastrar&resposta=false');
	}

	// altera status do curso
	function status() {
		$acao = $this->input->get('a');
		$curso = $this->input->get('c');

		if (isset($acao, $curso)) {
			$alteraStatus = $this->curso->altera($curso, array('status' => $acao));

			($alteraStatus) ? redirect('cursos?acao=listar&resposta=true') : redirect('cursos?acao=listar&resposta=false');
		}

	}
}

?>
