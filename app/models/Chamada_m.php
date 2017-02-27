<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável por gerenciar o CRUD de chamadas (inclusive relatórios)
*/

class Chamada_m extends CI_Model {
	// seleciona os cursos (ativos) pelo id do professor
	function listaCursosProfessor($professor) {
		$this->db->select('curso.id, curso.nome');
		$this->db->join('curso', 'curso.id = curso_has_professor.curso_id', 'inner');
		$this->db->join('professor', 'professor.matricula = curso_has_professor.professor_matricula', 'inner');
		
		$cursos = $this->db->get_where('curso_has_professor', array('matricula' => $professor, 'curso.status' => 1));

		return ($cursos->num_rows() === 0) ? FALSE : $cursos;
	}

	// seleciona os alunos (ativos) pelo id do curso
	function listaAlunosCurso($curso) {
		$this->db->select('matricula, aluno.nome');
		$this->db->join('curso', 'curso.id = curso_has_aluno.curso_id', 'inner');
		$this->db->join('aluno', 'aluno.matricula = curso_has_aluno.aluno_matricula', 'inner');

		$alunos = $this->db->get_where('curso_has_aluno', array('curso.id' => $curso, 'aluno.status' => 1));

		return ($alunos->num_rows() === 0) ? FALSE : $alunos;
	}

	function listaPeriodos() {
		$this->db->order_by('id', 'ASC');
		return $this->db->get('periodo');
	}

	function gravaPresencas($presencas) {
		$this->db->insert('frequencia', $presencas);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}

?>
