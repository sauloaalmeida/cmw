<?php 
class EnqueteCategoria {

    var $dbconn;
    var $enqCatPk;
    var $enqCatNome;
    var $enqCatDesricao;
   
	
	function EnqueteCategoria(){
	
	    $agora = time();
	    $this->dbconn = new Dbconn;
        $this->enqCatPk = NULL;
        $this->enqCatNome = NULL;
        $this->enqCatDesricao = NULL;
       
	}
	
	function getEnqueteCategoria($enq_cat_pk){

                settype($enq_cat_pk, 'integer');
		$l_str_sql = " select enq_cat_pk, ";
		$l_str_sql.= "        enq_cat_nome, ";
		$l_str_sql.= "        enq_cat_descricao ";
		$l_str_sql.= " from enq_categoria ";
		$l_str_sql.= " where enq_cat_pk = ".$enq_cat_pk;
		
		//$RS = $this->dbconn->gerRecordset($l_str_sql)
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
				
        $this->enqCatPk = $RStemp["enq_cat_pk"];
        $this->enqCatNome = $RStemp["enq_cat_nome"];
        $this->enqCatDescricao = $RStemp["enq_cat_descricao"];
	}		
	
	
}	

?>
