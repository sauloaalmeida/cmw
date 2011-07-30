<?php 
class Aniversario {

    var $dbconn;
    var $aniv_aniv_pk;
    var $aniv_aniv_nome;
    var $aniv_aniv_dt_nasc;
    
    
	
	function Aniversario(){
	
	$agora = time();
	$this->dbconn = new Dbconn;
        $this->aniv_aniv_pk = NULL;
        $this->aniv_aniv_nome = NULL;
        $this->aniv_aniv_dt_nasc = NULL;
	}
	
	function incluir(){
		
		$l_str_sql = "insert into aniv_aniversario (";
		$l_str_sql.= "     aniv_aniv_nome, ";
		$l_str_sql.= "     aniv_aniv_dt_nasc ) ";
		$l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->aniv_aniv_nome)."', ";
      		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->aniv_aniv_dt_nasc)."' ) ";

		return $this->dbconn->execSql($l_str_sql);
	}
	
	
	function excluir(){

              settype($this->aniv_aniv_pk, 'integer');
	      $l_str_sql = " delete from aniv_aniversario ";
	      $l_str_sql.= " where  aniv_aniv_pk = ".$this->aniv_aniv_pk;

   		return $this->dbconn->execSql($l_str_sql);
	
	}	
	

	function alterar(){

                settype($this->aniv_aniv_pk, 'integer');
		$l_str_sql = " update aniv_aniversario set  ";
		$l_str_sql.= "        aniv_aniv_nome = '".$this->dbconn->anti_sql_injection($this->aniv_aniv_nome)."', ";
		$l_str_sql.= "        aniv_aniv_dt_nasc = '".$this->dbconn->anti_sql_injection($this->aniv_aniv_dt_nasc)."' ";
	        $l_str_sql.= " where  aniv_aniv_pk = ".$this->aniv_aniv_pk;
		
		return $this->dbconn->execSql($l_str_sql);	
	}
		
		
	function getAniversarios($mes){

                settype($mes, 'integer');
		$l_str_sql = " select aniv_aniv_pk,  ";
		$l_str_sql.= "        aniv_aniv_nome,  ";
		$l_str_sql.= "        DATE_FORMAT(aniv_aniv_dt_nasc, '%d/%m/%Y') aniv_aniv_dt_nasc, ";
                $l_str_sql.= "        DATE_FORMAT(aniv_aniv_dt_nasc, '%m') aniv_aniv_dt_mes_nasc, ";
                $l_str_sql.= "        DATE_FORMAT(aniv_aniv_dt_nasc, '%d') aniv_aniv_dt_dia_nasc ";
		$l_str_sql.= " from aniv_aniversario ";
                if($mes != NULL)
                    $l_str_sql.= " where MONTH(aniv_aniv_dt_nasc) = ".$mes;
		$l_str_sql.= " order by MONTH(aniv_aniv_dt_nasc), ";
		$l_str_sql.= "          DAY(aniv_aniv_dt_nasc), ";
		$l_str_sql.= "          aniv_aniv_nome ";

                //echo $l_str_sql;
                //exit;


		return $this->dbconn->getRecordset($l_str_sql);

	}

	function getAniversario($aniv_aniv_pk){

                settype($aniv_aniv_pk, 'integer');
		$l_str_sql = " select aniv_aniv_pk,  ";
		$l_str_sql.= "        aniv_aniv_nome,  ";
		$l_str_sql.= "        DATE_FORMAT(aniv_aniv_dt_nasc, '%d/%m/%Y') aniv_aniv_dt_nasc ";
		$l_str_sql.= " from aniv_aniversario ";
		$l_str_sql.= " where aniv_aniv_pk = ".$aniv_aniv_pk;

		
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
				
	        $this->aniv_aniv_pk = $aniv_aniv_pk;
	        $this->aniv_aniv_nome = $RStemp["aniv_aniv_nome"];
	        $this->aniv_aniv_dt_nasc = $RStemp["aniv_aniv_dt_nasc"];

	
	}
	
}	

?>
