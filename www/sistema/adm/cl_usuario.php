<?
class AdmUsuario{

	var $adm_usr_pk;
	var $adm_usr_nome;
	var $adm_usr_email;
	var $adm_usr_nivel;
	var $adm_usr_status;
	var $adm_usr_login;
	var $adm_usr_senha;
	var $dbconn;
	

	function AdmUsuario(){
	
		$this->dbconn = new Dbconn;
		$this->adm_usr_pk = NULL;
		$this->adm_usr_nome = NULL;
		$this->adm_usr_email = NULL;
		$this->adm_usr_nivel = NULL;
		$this->adm_usr_status = NULL;
		$this->adm_usr_login = NULL;
		$this->adm_usr_senha = NULL;

	}

	function GetUsuario($p_int_usr_pk){
                settype($p_int_usr_pk, 'integer');
		$l_str_sql = "Select adm_usr_pk, "; 
		$l_str_sql.= "       adm_usr_login, ";  
		$l_str_sql.= "	     adm_usr_nome, ";  
		$l_str_sql.= "	     adm_usr_email, ";  
		$l_str_sql.= "	     adm_usr_senha, ";  
		$l_str_sql.= "	     adm_usr_nivel, ";  
		$l_str_sql.= "	     adm_usr_status ";
		$l_str_sql.= "from adm_usuario ";  
		$l_str_sql.= "where adm_usr_pk = ".$p_int_usr_pk;
	
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));

		$this->adm_usr_pk = $p_int_usr_pk;
		$this->adm_usr_nome = $RStemp["adm_usr_nome"];
		$this->adm_usr_email = $RStemp["adm_usr_email"];
		$this->adm_usr_nivel = $RStemp["adm_usr_nivel"];
		$this->adm_usr_status = $RStemp["adm_usr_status"];
		$this->adm_usr_login = $RStemp["adm_usr_login"];
		$this->adm_usr_senha = $RStemp["adm_usr_senha"];
	}

	
	function getTodosUsuarios(){
	
		$l_str_sql = "Select adm_usr_pk, "; 
		$l_str_sql.= "       adm_usr_login, ";  
		$l_str_sql.= "	     adm_usr_nome, ";  
		$l_str_sql.= "	     adm_usr_email, ";  
		$l_str_sql.= "	     adm_usr_senha, ";  
		$l_str_sql.= "	     adm_usr_nivel, ";  
		$l_str_sql.= "	     adm_usr_status ";
		$l_str_sql.= "from adm_usuario ";  
		$l_str_sql.= "order by adm_usr_login";
	 
		return $this->dbconn->getRecordset($l_str_sql);
			
	}	

	function incluir(){

		$l_str_sql = "Insert Into adm_usuario (adm_usr_login, "; 
		$l_str_sql.= "			       adm_usr_nome, "; 
		$l_str_sql.= "			       adm_usr_email, ";
		$l_str_sql.= "			       adm_usr_senha, "; 
		$l_str_sql.= "			       adm_usr_nivel, "; 
		$l_str_sql.= "			       adm_usr_status) "; 
		$l_str_sql.= "		       values ('".$this->dbconn->anti_sql_injection($this->adm_usr_login)."', ";
		$l_str_sql.= "			       '".$this->dbconn->anti_sql_injection($this->adm_usr_nome)."', ";
		$l_str_sql.= "			       '".$this->dbconn->anti_sql_injection($this->adm_usr_email)."', ";
		$l_str_sql.= "			       password('".$this->dbconn->anti_sql_injection($this->adm_usr_senha)."'), ";
		$l_str_sql.= "			       '".$this->dbconn->anti_sql_injection($this->adm_usr_nivel)."', ";
		$l_str_sql.= "			       '".$this->dbconn->anti_sql_injection($this->adm_usr_status)."')";
	
		return $this->dbconn->execSql($l_str_sql);	

	}

	function alterar(){
		
                settype($this->adm_usr_pk, 'integer');
		$l_str_sql = "Update adm_usuario set "; 
		$l_str_sql.= "adm_usr_login = '".$this->dbconn->anti_sql_injection($this->adm_usr_login)."', ";
		$l_str_sql.= "adm_usr_nome= '".$this->dbconn->anti_sql_injection($this->adm_usr_nome)."', ";
		$l_str_sql.= "adm_usr_email = '".$this->dbconn->anti_sql_injection($this->adm_usr_email)."', ";
		if ($this->adm_usr_senha != "")
			$l_str_sql .= "adm_usr_senha = password('".$this->dbconn->anti_sql_injection($this->adm_usr_senha)."'), ";
		$l_str_sql.= "adm_usr_nivel = '".$this->dbconn->anti_sql_injection($this->adm_usr_nivel)."', ";
		$l_str_sql.= "adm_usr_status = '".$this->dbconn->anti_sql_injection($this->adm_usr_status)."' ";
                $l_str_sql.= "where adm_usr_pk =".$this->adm_usr_pk ;

		return $this->dbconn->execSql($l_str_sql);
	}


	function excluir(){
                settype($this->adm_usr_pk, 'integer');
		$l_str_sql = "Delete from adm_usuario "; 
		$l_str_sql.= "where adm_usr_pk = $this->adm_usr_pk ";
		return $this->dbconn->execSql($l_str_sql);
	}
	
	function existeRegistroAssociado(){
                settype($this->adm_usr_pk, 'integer');
		$l_str_sql = "select news_not_pk ";
		$l_str_sql.= "from news_noticia ";
		$l_str_sql.= "where adm_usr_fk = ".$this->adm_usr_pk;		

		//monta o recordset
		$RStemp = $this->dbconn->getRecordset($l_str_sql);
		
		//se existir registro retorna ele
		if($this->dbconn->getExisteRecordset($RStemp))
		   return true;
		else
		   return false;

	}	
	
	
}


?>