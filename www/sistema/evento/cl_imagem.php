<?php 
class Imagem {

    var $dbconn;
    var $even_img_pk;
    var $even_img_titulo;
    var $even_img_destaque;	
    var $even_img_descricao;	
    var $even_img_dt_cadastro;		
    var $even_img_path1;
    var $even_img_path2;
    var $even_img_credito;
    var $even_even_fk;
	
	function Imagem(){
	
	    $agora = time();
	    $this->dbconn = new Dbconn;
        $this->even_img_pk = NULL;
        $this->even_img_titulo = NULL;
        $this->even_img_destaque = NULL;		
        $this->even_img_descricao = NULL;	
        $this->even_img_dt_cadastro = date("d/m/Y H:i:s",$agora);
        $this->even_img_path1 = NULL;
        $this->even_img_path2 = NULL;
        $this->even_img_credito = NULL;
        $this->even_even_fk = NULL;
	}
	
	function GetImagem($even_img_pk){

                settype($even_img_pk, 'integer');
		$l_str_sql = " select even_img_titulo, ";
		$l_str_sql.= "        even_img_destaque, ";		
		$l_str_sql.= "        even_img_descricao, ";
		$l_str_sql.= "        DATE_FORMAT(even_img_dt_cadastro, '%d/%m/%Y %H:%i:%s') even_img_dt_cadastro, ";
		$l_str_sql.= "        even_img_path1, ";
		$l_str_sql.= "        even_img_path2, ";				
		$l_str_sql.= "        even_img_credito, ";
		$l_str_sql.= "        even_even_fk ";		
		$l_str_sql.= " from even_imagem "; 
		$l_str_sql.= " where even_img_pk = ".$even_img_pk; 		 
		
		//$RS = $this->dbconn->gerRecordset($l_str_sql)
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
				
        $this->even_img_pk = $even_img_pk;
        $this->even_img_titulo = $RStemp["even_img_titulo"];
        $this->even_img_destaque = $RStemp["even_img_destaque"];		
        $this->even_img_descricao = $RStemp["even_img_descricao"];
        $this->even_img_dt_cadastro = $RStemp["even_img_dt_cadastro"];				
        $this->even_img_path1 = $RStemp["even_img_path1"];
        $this->even_img_path2 = $RStemp["even_img_path2"];
        $this->even_img_credito = $RStemp["even_img_credito"];
        $this->even_even_fk = $RStemp["even_even_fk"];		
	}	
	
	
	function GetImagens($even_even_fk){

                settype($even_even_fk, 'integer');
		$l_str_sql = " select even_img_titulo, ";
		$l_str_sql.= "        even_img_destaque, ";		
		$l_str_sql.= "        even_img_descricao, ";
		$l_str_sql.= "        DATE_FORMAT(even_img_dt_cadastro, '%d/%m/%Y %H:%i:%s') even_img_dt_cadastro, ";
		$l_str_sql.= "        even_img_path1, ";
		$l_str_sql.= "        even_img_path2, ";				
		$l_str_sql.= "        even_img_credito, ";
		$l_str_sql.= "        even_even_fk ";		
		$l_str_sql.= " from even_imagem "; 
		$l_str_sql.= " where even_even_fk = ".$even_even_fk; 		 
		
		return $this->dbconn->getRecordset($l_str_sql);

    }			
		
	
	function incluir(){

                settype($this->even_even_fk, 'integer');
		$l_str_sql = " insert into even_imagem ( ";
		$l_str_sql.= "        even_img_titulo, ";		
		$l_str_sql.= "        even_img_destaque, ";				
		$l_str_sql.= "        even_img_descricao, ";
		$l_str_sql.= "        even_img_dt_cadastro, ";		
		$l_str_sql.= "        even_img_path1, ";
		$l_str_sql.= "        even_img_path2, ";
		$l_str_sql.= "        even_img_credito, ";
		$l_str_sql.= "        even_even_fk ) ";		
		$l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->even_img_titulo)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_img_destaque)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_img_descricao)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_img_dt_cadastro)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_img_path1)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_img_path2)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_img_credito)."', ";
		$l_str_sql.= "           ".$this->even_even_fk." ) "; 										
		
		return $this->dbconn->execSql($l_str_sql);
	}
	
	function alterar(){

                settype($this->even_img_pk, 'integer');
		$l_str_sql = " update even_imagem set  ";
		$l_str_sql.= "        even_img_titulo = '".$this->dbconn->anti_sql_injection($this->even_img_titulo)."', ";
		$l_str_sql.= "        even_img_destaque = '".$this->dbconn->anti_sql_injection($this->even_img_destaque)."', ";
		$l_str_sql.= "        even_img_descricao = '".$this->dbconn->anti_sql_injection($this->even_img_descricao)."', ";
		$l_str_sql.= "        even_img_dt_cadastro = '".$this->dbconn->anti_sql_injection($this->even_img_dt_cadastro)."', ";
		$l_str_sql.= "        even_img_path1 = '".$this->dbconn->anti_sql_injection($this->even_img_path1)."', ";
		$l_str_sql.= "        even_img_path2 = '".$this->dbconn->anti_sql_injection($this->even_img_path2)."', ";
		$l_str_sql.= "        even_img_credito = '".$this->dbconn->anti_sql_injection($this->even_img_credito)."' ";
        $l_str_sql.= " where  even_img_pk = ".$this->even_img_pk;		 														
		
		return $this->dbconn->execSql($l_str_sql);	
	}
	
	function excluir(){

        settype($this->even_img_pk, 'integer');
		$l_str_sql = " delete from even_imagem ";
        $l_str_sql.= " where even_img_pk = ".$this->even_img_pk;		 															
			
		return $this->dbconn->execSql($l_str_sql);

	}		
		
	
}	

?>
