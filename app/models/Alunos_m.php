<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por gerenciar o CRUD de alunos
*/

class Alunos_m extends CI_Model {
	function cadastraAlunos($aluno) {
		$this->db->insert('aluno', $aluno);

		if ($this->db->affected_rows() === 1) {
			$this->db->select('matricula');
			$this->db->order_by('matricula', 'DESC');

			// retorna o id do aluno inserido
			return $this->db->get('aluno', 1)->row();
		}
		else {
			return FALSE;
		}
	}

	function cadastraCursoAluno($cursoAluno) {
		$this->db->insert('curso_has_aluno', $cursoAluno);
		return ($this->db->affected_rows() === 1) ? TRUE : FALSE;
	}

	function listaAlunos($curso, $alunoStatus = NULL) {
		$this->db->select('matricula, aluno.nome, aluno.status');
		$this->db->join('curso', 'curso.id = curso_has_aluno.curso_id', 'inner');
		$this->db->join('aluno', 'aluno.matricula = curso_has_aluno.aluno_matricula', 'inner');
		$this->db->order_by('aluno.status DESC, aluno.nome ASC');

		// pesquisa pelo status do aluno (parametro opcional)
		if ($alunoStatus !== NULL) {
			$this->db->where('aluno.status', $alunoStatus);
		}

		$alunos = $this->db->get_where('curso_has_aluno', array('curso_id' => $curso, 'curso.status' => 1));

		return ($alunos->num_rows() === 0) ? FALSE : $alunos;
	}

	// efetua busca do aluno pelo nome
	function buscaAluno($nome) {
		$this->db->select('matricula, aluno.nome, aluno.status');
		$this->db->join('curso', 'curso.id = curso_has_aluno.curso_id', 'inner');
		$this->db->join('aluno', 'aluno.matricula = curso_has_aluno.aluno_matricula', 'inner');
		$this->db->like('aluno.nome', $nome);
		$this->db->order_by('aluno.nome', 'ASC');
		$this->db->distinct();

		$alunos = $this->db->get_where('curso_has_aluno', array('curso.status' => 1));

		return ($alunos->num_rows() === 0) ? FALSE : $alunos;
	}

	function listaAluno($idAluno) {
		$aluno = $this->db->get_where('aluno', array('matricula' => $idAluno), 1);
		return ($aluno->num_rows() === 0) ? FALSE : $aluno;
	}

	function listacursosDoAluno($idAluno) {
		$this->db->select('curso.id, curso.nome');		
		$this->db->join('aluno', 'aluno.matricula = curso_has_aluno.aluno_matricula', 'inner');
		$this->db->join('curso', 'curso.id = curso_has_aluno.curso_id', 'inner');

		$cursos = $this->db->get_where('curso_has_aluno', array('aluno_matricula' => $idAluno));

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

	function editaAluno($aluno) {
		$this->db->update('aluno', $aluno, array('matricula' => $aluno['matricula']));
		$erro = $this->db->error();

		return (empty($erro['message'])) ? TRUE : FALSE;
	}

	// edita o curso do aluno
	function editaCursoAluno($cAluno, $idAluno, $remover) {
		// procura curso x aluno
		$q = $this->db->get_where('curso_has_aluno', array('curso_id' => $cAluno, 'aluno_matricula' => $idAluno));

		if ($remover === FALSE) {
			$a = array('curso_id' => $cAluno, 'aluno_matricula' => $idAluno);

			// checa se o aluno pertence ao curso
			if ($q->num_rows() === 0) {
				$this->db->insert('curso_has_aluno', $a);
				return ($this->db->affected_rows() === 1) ? TRUE : FALSE;
			}
			else {
				array_pop($a);
				$this->db->update('curso_has_aluno', $a, array('id' => $q->row()->id));
				$erro = $this->db->error();
				return (empty($erro['message'])) ? TRUE : FALSE;
			}
		}
		else {
			$this->db->delete('curso_has_aluno', array('id' => $q->row()->id));
			return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
		}
	}
}

?>
