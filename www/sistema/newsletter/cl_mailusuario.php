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
	
	
	function excluir(){

              settype($this->nwsl_usr_pk, 'integer');
	      $l_str_sql = " delete from nwsl_usuario ";
	      $l_str_sql.= " where  nwsl_usr_pk = ".$this->nwsl_usr_pk;

   		return $this->dbconn->execSql($l_str_sql);
	
	}	
	

	function alterar(){

                settype($this->nwsl_usr_pk, 'integer');
		$l_str_sql = " update nwsl_usuario set  ";
		$l_str_sql.= "        nwsl_usr_nome = '".$this->dbconn->anti_sql_injection($this->nwsl_usr_nome)."', ";
		$l_str_sql.= "        nwsl_usr_email = '".$this->dbconn->anti_sql_injection($this->nwsl_usr_email)."' ";
	        $l_str_sql.= " where  nwsl_usr_pk = ".$this->nwsl_usr_pk;
		
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


	function getEmails($listaEmails){

		$l_str_sql = " select nwsl_usr_pk,  ";
		$l_str_sql.= "        nwsl_usr_nome,  ";
		$l_str_sql.= "        nwsl_usr_email,  ";
		$l_str_sql.= "        DATE_FORMAT(nwsl_usr_dt_cadastro, '%d/%m/%Y %H:%i') nwsl_usr_dt_cadastro ";
		$l_str_sql.= " from nwsl_usuario ";
                $l_str_sql.= " where nwsl_usr_pk in(".$listaEmails.") ";
		$l_str_sql.= " order by nwsl_usr_nome ";


		return $this->dbconn->getRecordset($l_str_sql);

	}


	function getTodosCadastrados(){
	
		$l_str_sql = " select nwsl_usr_pk,  ";
		$l_str_sql.= "        nwsl_usr_nome,  ";
		$l_str_sql.= "        nwsl_usr_email,  ";
		$l_str_sql.= "        DATE_FORMAT(nwsl_usr_dt_cadastro, '%d/%m/%Y %H:%i') nwsl_usr_dt_cadastro ";
		$l_str_sql.= " from nwsl_usuario ";
		$l_str_sql.= " order by nwsl_usr_nome";

		
		return $this->dbconn->getRecordset($l_str_sql);
	
	}

	function getEmailsByNomeEmail($l_str_nome,$l_str_email){

		$l_str_sql = " select nwsl_usr_pk,  ";
		$l_str_sql.= "        nwsl_usr_nome,  ";
		$l_str_sql.= "        nwsl_usr_email,  ";
		$l_str_sql.= "        DATE_FORMAT(nwsl_usr_dt_cadastro, '%d/%m/%Y %H:%i') nwsl_usr_dt_cadastro ";
		$l_str_sql.= " from nwsl_usuario ";
                $l_str_sql.= " where 1 = 1";
                if(strlen(trim($l_str_nome))>0)
                    $l_str_sql.= " and nwsl_usr_nome like '%".$this->dbconn->anti_sql_injection($l_str_nome)."%'";

                if(strlen(trim($l_str_email))>0)
                    $l_str_sql.= " and nwsl_usr_email like '%".$this->dbconn->anti_sql_injection($l_str_email)."%'";

                $l_str_sql.= " order by nwsl_usr_nome";


		return $this->dbconn->getRecordset($l_str_sql);

	}

	function getEmail($nwsl_usr_pk){

                settype($nwsl_usr_pk, 'integer');
		$l_str_sql = " select nwsl_usr_pk,  ";
		$l_str_sql.= "        nwsl_usr_nome,  ";
		$l_str_sql.= "        nwsl_usr_email,  ";
		$l_str_sql.= "        DATE_FORMAT(nwsl_usr_dt_cadastro, '%d/%m/%Y %H:%i') nwsl_usr_dt_cadastro ";
		$l_str_sql.= " from nwsl_usuario ";
		$l_str_sql.= " where nwsl_usr_pk = ".$nwsl_usr_pk;

		
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
				
	        $this->nwsl_usr_pk = $nwsl_usr_pk;
	        $this->nwsl_usr_nome = $RStemp["nwsl_usr_nome"];
	        $this->nwsl_usr_email = $RStemp["nwsl_usr_email"];
	        $this->nwsl_usr_dt_cadastro = $RStemp["nwsl_usr_dt_cadastro"];

	
	}



	
}	

?>
