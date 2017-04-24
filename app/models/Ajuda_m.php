<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por buscar os textos de ajuda dos módulos
*/

class Ajuda_m extends CI_Model {
	private $texto = NULL;
	private $vazio = NULL;

	function buscaAjuda($id = 0) {
		$this->vazio = array('texto' => 'Texto inexistente');
		$this->texto = $this->db->get_where('ajuda', array('id' => $id));

		return ($this->texto->num_rows() === 0) ? $this->vazio : $this->texto->row_array();
	}
}

?>
