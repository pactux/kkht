<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por criar e encerrar sessões dentro do sistema
*/

class Login extends CI_Controller {
	function index() {
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
}

?>
