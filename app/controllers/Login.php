<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por criar e encerrar sessões dentro do sistema, 
* além de filtrar os agentes que acessam
*/

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('user_agent');

		$this->browser = $this->agent->browser();
		$this->browsers = array('Edge', 'Spartan', 'MSIE', 'Internet Explorer');
	}

	function index() {
		if (array_search($this->browser, $this->browsers)) redirect('login/badbrowser');
		$this->load->view("login_v");
	}

	function signIn() {
		$email = $this->input->post('email');
		$senha = $this->input->post('senha');
		$checaUsuario = $this->login->checaUsuario($email, sha1($senha));

		if ($checaUsuario === FALSE || $checaUsuario->status === 0) {
			redirect('login?dadosIncorretos=true', 'location', 301);
		}
		else {
			$dadosUsuario = array(
				'matricula' => $checaUsuario->matricula,
				'nome' => $checaUsuario->nome,
				'email' => $checaUsuario->email,
				'permissao' => $checaUsuario->permissao_id,
				'logado' => TRUE
			);

			$this->session->set_userdata($dadosUsuario);
			redirect('chamada', 'location', 301);
		}
	}

	function signOut() {
		$this->session->unset_userdata('logado');
		session_destroy();
		redirect('login?logout=true', 'location', 301);
	}

	function badBrowser() {
		if (array_search($this->browser, $this->browsers) === FALSE) redirect('login');
		$this->load->view('browser_v');
	}
}

?>
