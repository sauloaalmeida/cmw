<?php 
class Imagem {

    var $dbconn;
    var $news_img_pk;
    var $news_img_titulo;
    var $news_img_destaque;	
    var $news_img_descricao;	
    var $news_img_dt_cadastro;		
    var $news_img_path1;
    var $news_img_path2;
    var $news_img_credito;
    var $news_not_fk;
	
	function Imagem(){
	
	    $agora = time();
	    $this->dbconn = new Dbconn;
        $this->news_img_pk = NULL;
        $this->news_img_titulo = NULL;
        $this->news_img_destaque = NULL;		
        $this->news_img_descricao = NULL;	
        $this->news_img_dt_cadastro = date("d/m/Y H:i:s",$agora);
        $this->news_img_path1 = NULL;
        $this->news_img_path2 = NULL;
        $this->news_img_credito = NULL;
        $this->news_not_fk = NULL;
	}
	
	function GetImagem($news_img_pk){

                settype($news_img_pk, 'integer');
		$l_str_sql = " select news_img_titulo, ";
		$l_str_sql.= "        news_img_destaque, ";		
		$l_str_sql.= "        news_img_descricao, ";
		$l_str_sql.= "        DATE_FORMAT(news_img_dt_cadastro, '%d/%m/%Y %H:%i:%s') news_img_dt_cadastro, ";
		$l_str_sql.= "        news_img_path1, ";
		$l_str_sql.= "        news_img_path2, ";				
		$l_str_sql.= "        news_img_credito, ";
		$l_str_sql.= "        news_not_fk ";		
		$l_str_sql.= " from news_imagem "; 
		$l_str_sql.= " where news_img_pk = ".$news_img_pk; 		 
		
		//$RS = $this->dbconn->gerRecordset($l_str_sql)
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
				
        $this->news_img_pk = $news_img_pk;
        $this->news_img_titulo = $RStemp["news_img_titulo"];
        $this->news_img_destaque = $RStemp["news_img_destaque"];		
        $this->news_img_descricao = $RStemp["news_img_descricao"];
        $this->news_img_dt_cadastro = $RStemp["news_img_dt_cadastro"];				
        $this->news_img_path1 = $RStemp["news_img_path1"];
        $this->news_img_path2 = $RStemp["news_img_path2"];
        $this->news_img_credito = $RStemp["news_img_credito"];
        $this->news_not_fk = $RStemp["news_not_fk"];		
	}	
	
	
	function GetImagens($news_not_fk){

                settype($news_not_fk, 'integer');
		$l_str_sql = " select news_img_titulo, ";
		$l_str_sql.= "        news_img_destaque, ";		
		$l_str_sql.= "        news_img_descricao, ";
		$l_str_sql.= "        DATE_FORMAT(news_img_dt_cadastro, '%d/%m/%Y %H:%i:%s') news_img_dt_cadastro, ";
		$l_str_sql.= "        news_img_path1, ";
		$l_str_sql.= "        news_img_path2, ";				
		$l_str_sql.= "        news_img_credito, ";
		$l_str_sql.= "        news_not_fk ";		
		$l_str_sql.= " from news_imagem "; 
		$l_str_sql.= " where news_not_fk = ".$news_not_fk; 		 
		
		return $this->dbconn->getRecordset($l_str_sql);

    }			
		
	
	function incluir(){

                settype($this->news_not_fk, 'integer');
		$l_str_sql = " insert into news_imagem ( ";
		$l_str_sql.= "        news_img_titulo, ";		
		$l_str_sql.= "        news_img_destaque, ";				
		$l_str_sql.= "        news_img_descricao, ";
		$l_str_sql.= "        news_img_dt_cadastro, ";		
		$l_str_sql.= "        news_img_path1, ";
		$l_str_sql.= "        news_img_path2, ";
		$l_str_sql.= "        news_img_credito, ";
		$l_str_sql.= "        news_not_fk ) ";		
		$l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->news_img_titulo)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_img_destaque)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_img_descricao)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_img_dt_cadastro)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_img_path1)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_img_path2)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_img_credito)."', ";
		$l_str_sql.= "           ".$this->news_not_fk." ) "; 										
		
		return $this->dbconn->execSql($l_str_sql);
	}
	
	function alterar(){

                settype($this->news_img_pk, 'integer');
		$l_str_sql = " update news_imagem set  ";
		$l_str_sql.= "        news_img_titulo = '".$this->dbconn->anti_sql_injection($this->news_img_titulo)."', ";
		$l_str_sql.= "        news_img_destaque = '".$this->dbconn->anti_sql_injection($this->news_img_destaque)."', ";
		$l_str_sql.= "        news_img_descricao = '".$this->dbconn->anti_sql_injection($this->news_img_descricao)."', ";
		$l_str_sql.= "        news_img_dt_cadastro = '".$this->dbconn->anti_sql_injection($this->news_img_dt_cadastro)."', ";
		$l_str_sql.= "        news_img_path1 = '".$this->dbconn->anti_sql_injection($this->news_img_path1)."', ";
		$l_str_sql.= "        news_img_path2 = '".$this->dbconn->anti_sql_injection($this->news_img_path2)."', ";
		$l_str_sql.= "        news_img_credito = '".$this->dbconn->anti_sql_injection($this->news_img_credito)."' ";
        $l_str_sql.= " where  news_img_pk = ".$this->news_img_pk;		 														
		
		return $this->dbconn->execSql($l_str_sql);	
	}
	
	function excluir(){

        settype($this->news_img_pk, 'integer');
		$l_str_sql = " delete from news_imagem ";
        $l_str_sql.= " where news_img_pk = ".$this->news_img_pk;		 															
			
		return $this->dbconn->execSql($l_str_sql);

	}		
		
	
}	

?>
