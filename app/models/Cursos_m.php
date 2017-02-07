<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável pelo CRUD dos cursos
*/

class Cursos_m extends CI_Model {
	function cadastra($curso) {
		$this->db->insert('curso', $curso);
		return ($this->db->affected_rows() === 1) ? TRUE : FALSE;
	}

	function lista() {
		return $this->db->get('curso');
	}

	function altera($idCurso, $statusCurso) {
		$this->db->update('curso', $statusCurso, array('id' => $idCurso));
		return ($this->db->affected_rows() === 1) ? TRUE : FALSE;
	}
}

?>
