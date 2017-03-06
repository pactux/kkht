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

		$dados['dadosIncorretos'] = strtolower($this->input->get('dadosIncorretos'));
		$dados['logout'] = strtolower($this->input->get('logout'));

		$this->load->view('login_v', $dados);
	}

	function signIn() {
		$email = $this->input->post('email');
		$senha = $this->input->post('senha');
		$checaUsuario = $this->login->checaUsuario($email, sha1($senha));

		if ($checaUsuario === FALSE || $checaUsuario->status === 0) {
			redirect($this->index() . '?dadosIncorretos=warning');
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
			redirect('chamada');
		}
	}

	function signOut() {
		$this->session->unset_userdata('logado');
		session_destroy();
		redirect($this->index() . '?logout=success');
	}

	// cria nova senha
	function novaSenha() {
		$this->load->helper('string');

		$email = $this->input->post('email');

		// checa se email existe
		$confirmaEmail = $this->login->confirmaEmail($email);

		if ($confirmaEmail) {
			$senha = random_string('alnum', 8);
			$alteraSenha = $this->login->alteraSenha($email, $senha);
			$enviaEmail = $this->enviaEmail($email, $senha);

			if ($enviaEmail) {
				redirect($this->index() . '?dadosIncorretos=sent');
			}
			else {
				redirect($this->index() . '?dadosIncorretos=error');
			}
		}
		else {
			redirect($this->index() . '?dadosIncorretos=danger');
		}
	}

	// dispara email de recuperação
	function enviaEmail($para, $senha) {
		$this->load->library('email');

		$dados = array("name" => "", "email" => "", "message_body" => $senha);
		$mensagem = $this->load->view('email/novasenha_v', $dados, TRUE);

		$this->email->from('naoresponder@example.com');
		$this->email->to($para);
		$this->email->subject('Nova senha de acesso');
		$this->email->message($mensagem);

		return ($this->email->send()) ? TRUE : FALSE;
	}

	function badBrowser() {
		if (array_search($this->browser, $this->browsers) === FALSE) redirect($this->index());
		$this->load->view('browser_v');
	}
}

?>
