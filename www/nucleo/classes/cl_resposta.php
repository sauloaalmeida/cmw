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
        $l_str_sql.= " order by enq_resp_pk ";

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}	

	
}	

?>
