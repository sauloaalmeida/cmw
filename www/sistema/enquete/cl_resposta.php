<?php 
class Resposta {

    var $dbconn;
    var $enqRespPk;
    var $enqRespResposta;
    var $enqEnqFk;
	
	function Resposta(){
	
	    $agora = time();
	    $this->dbconn = new Dbconn;
        $this->enqRespPk = NULL;
        $this->enqRespResposta = NULL;
        $this->enqEnqFk = NULL;
      
	}
	
	function getResposta($enq_resp_pk){

        settype($enq_resp_pk, 'integer');
        $l_str_sql = " SELECT enq_resp_pk,  ";
        $l_str_sql.= "        enq_resp_resposta,  ";
        $l_str_sql.= "        enq_enq_fk  ";
        $l_str_sql.= " FROM enq_resposta  ";
        $l_str_sql.= " WHERE enq_resp_pk = ".$enq_resp_pk;
	
		//$RS = $this->dbconn->gerRecordset($l_str_sql)
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));

        $this->enqRespPk = $RStemp["enq_resp_pk"];
        $this->enqRespResposta = $RStemp["enq_resp_resposta"];
        $this->enqEnqFk = $RStemp["enq_enq_fk"];
	}	
	
	function getListaRespostas($enq_enq_fk){

        settype($enq_enq_fk, 'integer');
        $l_str_sql = " SELECT enq_resp_pk,  ";
        $l_str_sql.= "        enq_resp_resposta,  ";
        $l_str_sql.= "        enq_enq_fk  ";
        $l_str_sql.= " FROM enq_resposta  ";
        $l_str_sql.= " WHERE enq_enq_fk = ".$enq_enq_fk;
		$l_str_sql.= " order by enq_enq_fk desc";

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}


    function incluir(){

        settype($this->enqEnqFk, 'integer');
		$l_str_sql = " insert into enq_resposta ( ";
        $l_str_sql.= "        enq_resp_resposta,  ";
        $l_str_sql.= "        enq_enq_fk  ) ";
		$l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->enqRespResposta)."', ";
		$l_str_sql.= "          ".$this->enqEnqFk." ) ";

		return $this->dbconn->execSql($l_str_sql);
	}

	function alterar(){

        settype($this->enqRespPk, 'integer');
		$l_str_sql = " update enq_resposta set  ";
		$l_str_sql.= "        enq_resp_resposta = '".$this->dbconn->anti_sql_injection($this->enqRespResposta)."' ";
        $l_str_sql.= " where  enq_resp_pk = ".$this->enqRespPk;


		return $this->dbconn->execSql($l_str_sql);
	}

	function excluir(){

        settype($this->enqRespPk, 'integer');
		$l_str_sql = " DELETE FROM enq_voto ";
        $l_str_sql.= " WHERE enq_resp_fk = " .$this->enqRespPk ;
        $this->dbconn->execSql($l_str_sql);

        settype($this->enqRespPk, 'integer');
        $l_str_sql = " DELETE FROM enq_resposta ";
        $l_str_sql.= "     WHERE enq_resp_pk = ".$this->enqRespPk;        
	    return $this->dbconn->execSql($l_str_sql);

	}

	

	
}	

?>
