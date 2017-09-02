<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por fazer o CRUD de pagamentos
*/

class Pagamentos_m extends CI_Model {
	private $novaListaIDs = NULL;
	private $insereDados = array();
	private $resultado = NULL;
	private $pagamentosID = NULL;
	private $atualizaPagos = array();
	private $anos = NULL;

	function checaListaExiste($mes, $ano) {
		$this->db->select('mesPagamento, anoPagamento');
		$this->resultado = $this->db->get_where('pagamentos', array('mesPagamento' => $mes, 'anoPagamento' => $ano));

		return ($this->resultado->num_rows() > 0) ? TRUE : FALSE;
	}

	// cria nova lista de pagamentos
	function novaLista() {
		// seleciona os alunos com matricula ativa
		$this->db->select('curso_has_aluno.id');
		$this->db->join('aluno', 'aluno.matricula = curso_has_aluno.aluno_matricula');
		$this->db->join('curso', 'curso.id = curso_has_aluno.curso_id');

		$this->novaListaIDs = $this->db->get_where('curso_has_aluno', array('aluno.status' => 1));

		if ($this->novaListaIDs->num_rows() === 0) {
			return FALSE;
		}
		else {
			// popula tabela de pagamentos
			foreach ($this->novaListaIDs->result() as $novo) {
				$this->insereDados['curso_has_aluno_id'] = $novo->id;
				$this->insereDados['mesPagamento'] = mdate("%m");
				$this->insereDados['anoPagamento'] = mdate("%Y");
				$this->insereDados['pago'] = 0;

				$this->db->insert('pagamentos', $this->insereDados);
			}

			return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
		}
	}

	function listaPagamentos($curso, $pago, $mes, $ano) {
		$this->db->select('curso_has_aluno.aluno_matricula, aluno.nome, pagamentos.id');
		$this->db->join('pagamentos', 'pagamentos.curso_has_aluno_id = curso_has_aluno.id');
		$this->db->join('aluno', 'aluno.matricula = curso_has_aluno.aluno_matricula');
		$this->db->where('aluno.status', 1);
		$this->db->where('pagamentos.mesPagamento', $mes);
		$this->db->where('pagamentos.anoPagamento', $ano);
		$this->db->where('curso_has_aluno.curso_id', $curso);

		$this->lista = $this->db->get_where('curso_has_aluno', array('pagamentos.pago' => $pago));

		return ($this->lista->num_rows() > 0) ? $this->lista : FALSE;
	}

	function processaPagamentos($pagamentos) {
		foreach ($pagamentos as $id) {
			$this->atualizaPagos['pago'] = 1;
			$this->atualizaPagos['dataPagamento'] = mdate("%y-%m-%d");

			$this->db->where('id', $id);
			$this->db->update('pagamentos', $this->atualizaPagos);
		}

		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	function buscaAnos() {
		$this->db->select('anoPagamento');
		$this->db->distinct();

		$this->anos = $this->db->get('pagamentos');

		return ($this->anos->num_rows() > 0) ? $this->anos : FALSE;
	}
}
