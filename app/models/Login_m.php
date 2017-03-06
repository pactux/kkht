<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por validar os usuários que acessam o sistema
*/

class Login_m extends CI_Model {
	function checaUsuario($email, $senha) {
		$usuario = $this->db->get_where("professor", array('email' => $email, 'senha' => $senha, 'status' => 1));
		return ($usuario->num_rows() === 1) ? $usuario->row() : FALSE;
	}

	function checaSessao() {
		$logado = $this->session->userdata('logado');

		if ($logado !== TRUE || !isset($logado)) redirect(base_url());
	}

	function checaPermissao($permissao) {
		if ($permissao === '1') show_404();
	}

	function confirmaEmail($email) {
		$confirma = $this->db->get_where('professor', array('email' => $email));
		return ($confirma->num_rows() === 0) ? FALSE : TRUE;
	}

	function alteraSenha($email, $senha) {
		$hash = array('senha' => sha1($senha));

		$this->db->update('professor', $hash, array('email' => $email));
		return ($this->db->affected_rows() === 1) ? TRUE : FALSE;
	}
}

?>
