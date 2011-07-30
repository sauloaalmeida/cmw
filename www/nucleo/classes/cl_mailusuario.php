<?php 
class MailUsuario {

    var $dbconn;
    var	$nwsl_usr_pk;
    var	$nwsl_usr_nome;
    var	$nwsl_usr_email;
    var	$nwsl_usr_dt_cadastro;
    
	
	function MailUsuario(){
	
	$agora = time();
	$this->dbconn = new Dbconn;
        $this->nwsl_usr_pk = NULL;
        $this->nwsl_usr_nome = NULL;
        $this->nwsl_usr_email = NULL;
        $this->nwsl_usr_dt_cadastro = date("d-m-Y H:i:s",$agora);
	}
	
	function incluir(){
		
		$l_str_sql = "insert into nwsl_usuario (";
		$l_str_sql.= "     nwsl_usr_nome, ";
		$l_str_sql.= "	   nwsl_usr_email, ";
		$l_str_sql.= "     nwsl_usr_dt_cadastro ) ";
		$l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->nwsl_usr_nome)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->nwsl_usr_email)."', ";
		$l_str_sql.= "          CURRENT_TIMESTAMP()) ";

		return $this->dbconn->execSql($l_str_sql);
	}
	
	
	
		
		
	function getExisteUsuario($email){
	
		$l_str_sql = " select nwsl_usr_pk,  ";
		$l_str_sql.= "        nwsl_usr_nome,  ";
		$l_str_sql.= "        DATE_FORMAT(nwsl_usr_dt_cadastro, '%d/%m/%Y %H:%i') nwsl_usr_dt_cadastro ";
		$l_str_sql.= " from nwsl_usuario ";
		$l_str_sql.= " where LCASE(nwsl_usr_email) = LCASE('".$this->dbconn->anti_sql_injection($email)."') ";
		
		//se existirem registros retorna verdadeiro
		return $this->dbconn->getExisteRecordset($this->dbconn->getRecordset($l_str_sql));
	
	}

	function excluir($email){
	
		$l_str_sql = " delete from nwsl_usuario  ";
		$l_str_sql.= " where LCASE(nwsl_usr_email) = LCASE('".$this->dbconn->anti_sql_injection($email)."') ";
		
		//se existirem registros retorna verdadeiro
		return $this->dbconn->execSql($l_str_sql);
	
	}
	
}	

?>
