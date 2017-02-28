<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Classe responsável pela execução das buscas
*/

class Resumo_m extends CI_Model {
	function resumoPorPeriodo($matricula, $curso, $periodo, $mes, $ano) {
		$select = 'curso.nome as curso,';

		if (!empty($matricula)) $select .= 'aluno.matricula as matricula, aluno.nome as aluno,';
		if ($periodo !== '0') $select .= 'periodo.tipo as periodo,';
		if ($mes !== '0') $select .= 'EXTRACT(MONTH FROM dataAula) as mes,';

		$select .= 'EXTRACT(YEAR FROM dataAula) as ano, COUNT(aluno.matricula) as presencas';

		$this->db->select($select);
		$this->db->join('curso', 'curso.id = frequencia.curso_id');
		$this->db->join('aluno', 'aluno.matricula = frequencia.aluno_matricula');
		$this->db->join('periodo', 'periodo.id = frequencia.periodo_id');
		$this->db->where('curso_id', $curso);
		$this->db->where('YEAR(dataAula)', $ano);
		
		if (!empty($matricula)) $this->db->where('aluno.matricula', $matricula);
		if ($periodo !== '0') $this->db->where('periodo.id', $periodo);
		if ($mes !== '0') $this->db->where('MONTH(dataAula)', $mes);

		$resumo = $this->db->get('frequencia');
		$erro = $this->db->error();

		return (empty($erro['message'])) ? $resumo : FALSE;
	}
}

?>
