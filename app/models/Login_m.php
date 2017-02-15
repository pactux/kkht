<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por validar os usuários que acessam o sistema
*/

class Login_m extends CI_Model {
	function checaUsuario($email, $senha) {
		$usuario = $this->db->get_where("professor", array('email' => $email, 'senha' => $senha, 'status' => 1));

		if ($usuario->num_rows() == 1) {
			return $usuario->row();
		}
		else {
			return FALSE;
		}
	}

	function checaSessao() {
		$logado = $this->session->userdata('logado');

		if ($logado !== TRUE || !isset($logado)) {
			redirect(base_url(), "location", 301);
		}
	}

	function checaPermissao($permissao) {
		if ($permissao === '1') {
			show_404();
		}
	}
}

?>
