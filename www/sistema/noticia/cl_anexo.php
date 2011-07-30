<?php 
class Anexo {

    var $dbconn;
    var $news_anx_pk;
    var $news_anx_titulo;
    var $news_anx_descricao;	
    var $news_anx_dt_cadastro;		
    var $news_anx_path;
    var $tipo_anx_fk;
    var $news_anx_credito;
    var $news_not_fk;

	
	function Anexo(){
	
	    $agora = time();
	    $this->dbconn = new Dbconn;
        $this->news_anx_pk = NULL;
        $this->news_anx_titulo = NULL;
        $this->news_anx_descricao = NULL;	
        $this->news_anx_dt_cadastro = date("d/m/Y H:i:s",$agora);
        $this->news_anx_path = NULL;
        $this->tipo_anx_fk = NULL;
        $this->news_anx_credito = NULL;
        $this->news_not_fk = NULL;
	}
	
	function getAnexo($news_anx_pk){

                settype($news_anx_pk, 'integer');
		$l_str_sql = " select news_anx_titulo, ";
		$l_str_sql.= "        news_anx_descricao, ";
		$l_str_sql.= "        DATE_FORMAT(news_anx_dt_cadastro, '%d/%m/%Y %H:%i:%s') news_anx_dt_cadastro, ";
		$l_str_sql.= "        news_anx_path, ";
		$l_str_sql.= "        tipo_anx_fk, ";				
		$l_str_sql.= "        news_anx_credito, ";
		$l_str_sql.= "        news_not_fk ";		
		$l_str_sql.= " from news_anexo "; 
		$l_str_sql.= " where news_anx_pk = ".$news_anx_pk; 		 
		
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
				
        $this->news_anx_pk = $news_anx_pk;
        $this->news_anx_titulo = $RStemp["news_anx_titulo"];
        $this->news_anx_descricao = $RStemp["news_anx_descricao"];
        $this->news_anx_dt_cadastro = $RStemp["news_anx_dt_cadastro"];				
        $this->news_anx_path = $RStemp["news_anx_path"];
        $this->tipo_anx_fk = $RStemp["tipo_anx_fk"];
        $this->news_anx_credito = $RStemp["news_anx_credito"];
        $this->news_not_fk = $RStemp["news_not_fk"];		
	}	
	
	
	function GetAnexos($news_not_fk){

                settype($news_not_fk, 'integer');
		$l_str_sql = " select news_anx_titulo, ";
		$l_str_sql.= "        news_anx_descricao, ";
		$l_str_sql.= "        DATE_FORMAT(news_anx_dt_cadastro, '%d/%m/%Y %H:%i:%s') news_anx_dt_cadastro, ";
		$l_str_sql.= "        news_anx_path, ";
		$l_str_sql.= "        tipo_anx_fk, ";				
		$l_str_sql.= "        news_anx_credito, ";
		$l_str_sql.= "        news_not_fk ";		
		$l_str_sql.= " from news_anexo "; 
		$l_str_sql.= " where news_not_fk = ".$news_not_fk; 		 
		
		return $this->dbconn->getRecordset($l_str_sql);

    }			
		
	
	function incluir(){

                settype($this->news_not_fk, 'integer');
                settype($this->tipo_anx_fk, 'integer');
		$l_str_sql = " insert into news_anexo ( ";
		$l_str_sql.= "        news_anx_titulo, ";		
		$l_str_sql.= "        news_anx_descricao, ";
		$l_str_sql.= "        news_anx_dt_cadastro, ";		
		$l_str_sql.= "        news_anx_path, ";
		$l_str_sql.= "        tipo_anx_fk, ";
		$l_str_sql.= "        news_anx_credito, ";
		$l_str_sql.= "        news_not_fk ) ";		
		$l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->news_anx_titulo)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_anx_descricao)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_anx_dt_cadastro)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_anx_path)."', ";
		$l_str_sql.= "          ".$this->tipo_anx_fk.", "; 				
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_anx_credito)."', ";
		$l_str_sql.= "           ".$this->news_not_fk." ) "; 										
		
		return $this->dbconn->execSql($l_str_sql);
	}
	
	function alterar(){

                settype($this->news_anx_pk, 'integer');
                settype($this->tipo_anx_fk, 'integer');
		$l_str_sql = " update news_anexo set  ";
		$l_str_sql.= "        news_anx_titulo = '".$this->dbconn->anti_sql_injection($this->news_anx_titulo)."', ";
		$l_str_sql.= "        news_anx_descricao = '".$this->dbconn->anti_sql_injection($this->news_anx_descricao)."', ";
		$l_str_sql.= "        news_anx_dt_cadastro = '".$this->dbconn->anti_sql_injection($this->news_anx_dt_cadastro)."', ";
		$l_str_sql.= "        news_anx_path = '".$this->dbconn->anti_sql_injection($this->news_anx_path)."', ";
		$l_str_sql.= "        tipo_anx_fk = ".$this->tipo_anx_fk.", ";
		$l_str_sql.= "        news_anx_credito = '".$this->dbconn->anti_sql_injection($this->news_anx_credito)."' ";
                $l_str_sql.= " where  news_anx_pk = ".$this->news_anx_pk;
		
		return $this->dbconn->execSql($l_str_sql);	
	}
	
	function excluir(){
                
                settype($this->news_anx_pk, 'integer');
		$l_str_sql = " delete from news_anexo ";
                $l_str_sql.= " where news_anx_pk = ".$this->news_anx_pk;
			
		return $this->dbconn->execSql($l_str_sql);

	}	
	
	
	function getTipoAnexos(){
	   
	    
  	    $l_str_sql = " select tipo_anx_pk, ";
  	    $l_str_sql.= "        tipo_anx_nome, ";
  	    $l_str_sql.= "        tipo_anx_extensao ";				
		$l_str_sql.= " from tipo_anexo ";
                $l_str_sql.= " order by tipo_anx_nome ";
		
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
