<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por gerenciar o CRUD de professores
*/

class Professores_m extends CI_Model {
	function listaProfessores($permissao) {
		if ($permissao === '2') {
			return $this->db->get_where('professor', array('permissao_id < ' => 3));
		}
		else {
			return $this->db->get('professor');
		}
	}

	function listaProfessor($idProfessor, $permissao) {
		if ($permissao === '2') {
			$this->db->join('permissao', 'professor.permissao_id = permissao.id', 'inner');
			$professor = $this->db->get_where('professor', array('matricula' => $idProfessor, 'permissao_id <= ' => $permissao), 1);
		}
		else {
			$this->db->join('permissao', 'professor.permissao_id = permissao.id', 'inner');
			$professor = $this->db->get_where('professor', array('matricula' => $idProfessor), 1);
		}

		return ($professor->num_rows() !== 1) ? FALSE : $professor->row();
	}

	// retorna os cursos pertencentes ao professor
	function listaCursosDoProfessor($professor) {
		$this->db->select('curso.id, curso.nome');		
		$this->db->join('professor', 'professor.matricula = curso_has_professor.professor_matricula', 'inner');
		$this->db->join('curso', 'curso.id = curso_has_professor.curso_id', 'inner');
		$cursos = $this->db->get_where('curso_has_professor', array('professor_matricula' => $professor));

		if ($cursos->num_rows() === 0) {
			return FALSE;
		}
		else {
			foreach ($cursos->result() as $c) {
				$cursosArray[$c->nome] = $c->id;
			}

			return $cursosArray;
		}
	}

	// insere novo professor na base de dados
	function cadastraProfessor($professor) {
		$this->db->insert('professor', $professor);

		if ($this->db->affected_rows() === 1) {
			$this->db->select('matricula');
			$this->db->order_by('matricula', 'DESC');

			// retorna o id do professor inserido
			return $this->db->get('professor', 1)->row();
		}
		else {
			return FALSE;
		}
	}

	function cadastraCursoProfessor($cursoProfessor) {
		$this->db->insert('curso_has_professor', $cursoProfessor);
		return ($this->db->affected_rows() === 1) ? TRUE : FALSE;
	}

	function editaProfessor($professor) {
		$this->db->update('professor', $professor, array('matricula' => $professor['matricula']));
		$erro = $this->db->error();

		return (empty($erro['message'])) ? TRUE : FALSE;
	}

	// edita o curso do professor
	function editaCursoProfessor($cProfessor, $idProfessor, $remover) {
		// procura curso x professor
		$q = $this->db->get_where('curso_has_professor', array('curso_id' => $cProfessor, 'professor_matricula' => $idProfessor));

		if ($remover === FALSE) {
			$p = array('curso_id' => $cProfessor, 'professor_matricula' => $idProfessor);

			// checa se o professor pertence ao curso
			if ($q->num_rows() === 0) {
				$this->db->insert('curso_has_professor', $p);
				return ($this->db->affected_rows() === 1) ? TRUE : FALSE;
			}
			else {
				array_pop($p);
				$this->db->update('curso_has_professor', $p, array('id' => $q->row()->id));
				$erro = $this->db->error();

				return (empty($erro['message'])) ? TRUE : FALSE;
			}
		}
		else {
			$this->db->delete('curso_has_professor', array('id' => $q->row()->id));
			return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
		}
	}
}

?>
