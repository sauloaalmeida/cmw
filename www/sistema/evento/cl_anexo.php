<?php 
class Anexo {

    var $dbconn;
    var $even_anx_pk;
    var $even_anx_titulo;
    var $even_anx_descricao;	
    var $even_anx_dt_cadastro;		
    var $even_anx_path;
    var $tipo_anx_fk;
    var $even_anx_credito;
    var $even_even_fk;

	
	function Anexo(){
	
	    $agora = time();
	    $this->dbconn = new Dbconn;
        $this->even_anx_pk = NULL;
        $this->even_anx_titulo = NULL;
        $this->even_anx_descricao = NULL;	
        $this->even_anx_dt_cadastro = date("d/m/Y H:i:s",$agora);
        $this->even_anx_path = NULL;
        $this->tipo_anx_fk = NULL;
        $this->even_anx_credito = NULL;
        $this->even_even_fk = NULL;
	}
	
	function getAnexo($even_anx_pk){

                settype($even_anx_pk, 'integer');
		$l_str_sql = " select even_anx_titulo, ";
		$l_str_sql.= "        even_anx_descricao, ";
		$l_str_sql.= "        DATE_FORMAT(even_anx_dt_cadastro, '%d/%m/%Y %H:%i:%s') even_anx_dt_cadastro, ";
		$l_str_sql.= "        even_anx_path, ";
		$l_str_sql.= "        tipo_anx_fk, ";				
		$l_str_sql.= "        even_anx_credito, ";
		$l_str_sql.= "        even_even_fk ";		
		$l_str_sql.= " from even_anexo "; 
		$l_str_sql.= " where even_anx_pk = ".$even_anx_pk; 		 
		
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
				
        $this->even_anx_pk = $even_anx_pk;
        $this->even_anx_titulo = $RStemp["even_anx_titulo"];
        $this->even_anx_descricao = $RStemp["even_anx_descricao"];
        $this->even_anx_dt_cadastro = $RStemp["even_anx_dt_cadastro"];				
        $this->even_anx_path = $RStemp["even_anx_path"];
        $this->tipo_anx_fk = $RStemp["tipo_anx_fk"];
        $this->even_anx_credito = $RStemp["even_anx_credito"];
        $this->even_even_fk = $RStemp["even_even_fk"];		
	}	
	
	
	function GetAnexos($even_even_fk){

                settype($even_even_fk, 'integer');
		$l_str_sql = " select even_anx_titulo, ";
		$l_str_sql.= "        even_anx_descricao, ";
		$l_str_sql.= "        DATE_FORMAT(even_anx_dt_cadastro, '%d/%m/%Y %H:%i:%s') even_anx_dt_cadastro, ";
		$l_str_sql.= "        even_anx_path, ";
		$l_str_sql.= "        tipo_anx_fk, ";				
		$l_str_sql.= "        even_anx_credito, ";
		$l_str_sql.= "        even_even_fk ";		
		$l_str_sql.= " from even_anexo "; 
		$l_str_sql.= " where even_even_fk = ".$even_even_fk; 		 
		
		return $this->dbconn->getRecordset($l_str_sql);

    }			
		
	
	function incluir(){

                settype($this->even_even_fk, 'integer');
                settype($this->tipo_anx_fk, 'integer');
		$l_str_sql = " insert into even_anexo ( ";
		$l_str_sql.= "        even_anx_titulo, ";		
		$l_str_sql.= "        even_anx_descricao, ";
		$l_str_sql.= "        even_anx_dt_cadastro, ";		
		$l_str_sql.= "        even_anx_path, ";
		$l_str_sql.= "        tipo_anx_fk, ";
		$l_str_sql.= "        even_anx_credito, ";
		$l_str_sql.= "        even_even_fk ) ";		
		$l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->even_anx_titulo)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_anx_descricao)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_anx_dt_cadastro)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_anx_path)."', ";
		$l_str_sql.= "          ".$this->tipo_anx_fk.", "; 				
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_anx_credito)."', ";
		$l_str_sql.= "           ".$this->even_even_fk." ) "; 										
		
		return $this->dbconn->execSql($l_str_sql);
	}
	
	function alterar(){

                settype($this->even_anx_pk, 'integer');
                settype($this->tipo_anx_fk, 'integer');
		$l_str_sql = " update even_anexo set  ";
		$l_str_sql.= "        even_anx_titulo = '".$this->dbconn->anti_sql_injection($this->even_anx_titulo)."', ";
		$l_str_sql.= "        even_anx_descricao = '".$this->dbconn->anti_sql_injection($this->even_anx_descricao)."', ";
		$l_str_sql.= "        even_anx_dt_cadastro = '".$this->dbconn->anti_sql_injection($this->even_anx_dt_cadastro)."', ";
		$l_str_sql.= "        even_anx_path = '".$this->dbconn->anti_sql_injection($this->even_anx_path)."', ";
		$l_str_sql.= "        tipo_anx_fk = ".$this->tipo_anx_fk.", ";
		$l_str_sql.= "        even_anx_credito = '".$this->dbconn->anti_sql_injection($this->even_anx_credito)."' ";
                $l_str_sql.= " where  even_anx_pk = ".$this->even_anx_pk;
		
		return $this->dbconn->execSql($l_str_sql);	
	}
	
	function excluir(){
                
                settype($this->even_anx_pk, 'integer');
		$l_str_sql = " delete from even_anexo ";
                $l_str_sql.= " where even_anx_pk = ".$this->even_anx_pk;
			
		return $this->dbconn->execSql($l_str_sql);

	}	
	
	
	function getTipoAnexos(){
	   
	    
  	    $l_str_sql = " select tipo_anx_pk, ";
  	    $l_str_sql.= "        tipo_anx_nome, ";
  	    $l_str_sql.= "        tipo_anx_extensao ";				
		$l_str_sql.= " from tipo_anexo ";
		
		return $this->dbconn->getRecordset($l_str_sql);
		
	}
	
	function getDescricaoTipoAnexo($tipo_anx_fk){

                settype($tipo_anx_fk, 'integer');
                $l_str_sql = " select tipo_anx_nome ";
		$l_str_sql.= " from tipo_anexo ";
                $l_str_sql.= " where tipo_anx_pk = ".$tipo_anx_fk;
		
		$RS = $this->dbconn->getRecordset($l_str_sql);
		
		if($this->dbconn->getExisteRecordset($RS)){
		    $RStemp = $this->dbconn->getRecordsetArray($RS);																
		    return $RStemp["tipo_anx_nome"];
		}	
	    else 
		   return "Formato desconhecido.";
	
	}	
		
	
}	

?>
