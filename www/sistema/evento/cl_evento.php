<?php 
class Evento {

    var $dbconn;
    var $even_even_pk;
    var $even_even_nome;
    var $even_even_chamada;
    var $even_even_destaque;
    var $even_even_tipo;
    var $even_even_link;
    var $even_even_inscricao;
    var $even_even_corpo;
    var $even_even_dt_inicio;
    var $even_even_dt_fim;
    var $even_even_dt_inicio_publicacao;
    var $even_even_dt_fim_pulicacao;
    var $even_even_status;
	
	function Evento(){
	
	$agora = time();
	$this->dbconn = new Dbconn;
        $this->even_even_pk = NULL;
        $this->even_even_nome = NULL;
        $this->even_even_chamada = NULL;
        $this->even_even_destaque = NULL;				
        $this->even_even_tipo = NULL;
        $this->even_even_link = NULL;
        $this->even_even_inscricao = NULL;
        $this->even_even_corpo = NULL;
        $this->even_even_dt_inicio = date("d/m/Y H:i",$agora);
        $this->even_even_dt_fim = date("d/m/Y H:i",$agora);
        $this->even_even_dt_inicio_publicacao = date("d/m/Y H:i",$agora);
        $this->even_even_dt_fim_publicacao = date("d/m/Y H:i",$agora);
        $this->even_even_status = NULL;
	}
	
	function GetEvento($even_even_pk){

                settype($even_even_pk, 'integer');
		$l_str_sql = " select even_even_nome, ";
		$l_str_sql.= "        even_even_chamada, ";				
		$l_str_sql.= "        even_even_destaque, ";
		$l_str_sql.= "        even_even_tipo, ";
		$l_str_sql.= "        even_even_link, ";		
		$l_str_sql.= "        even_even_inscricao, ";
		$l_str_sql.= "        even_even_corpo, ";
		$l_str_sql.= "        DATE_FORMAT(even_even_dt_inicio, '%d/%m/%Y') even_even_dt_inicio, ";
		$l_str_sql.= "        DATE_FORMAT(even_even_dt_fim, '%d/%m/%Y') even_even_dt_fim, ";
		$l_str_sql.= "        DATE_FORMAT(even_even_dt_inicio_publicacao, '%d/%m/%Y %H:%i') even_even_dt_inicio_publicacao, ";
		$l_str_sql.= "        DATE_FORMAT(even_even_dt_fim_publicacao, '%d/%m/%Y %H:%i') even_even_dt_fim_publicacao, ";
		$l_str_sql.= "        even_even_status ";		
		$l_str_sql.= " from even_evento "; 
		$l_str_sql.= " where even_even_pk = ".$even_even_pk;
		
		//$RS = $this->dbconn->gerRecordset($l_str_sql)
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
				
        $this->even_even_pk = $even_even_pk;
        $this->even_even_nome = $RStemp["even_even_nome"];
        $this->even_even_chamada = $RStemp["even_even_chamada"];
        $this->even_even_destaque = $RStemp["even_even_destaque"];
        $this->even_even_tipo = $RStemp["even_even_tipo"];
        $this->even_even_link = $RStemp["even_even_link"];		     
        $this->even_even_inscricao = $RStemp["even_even_inscricao"];
        $this->even_even_corpo = $RStemp["even_even_corpo"];
        $this->even_even_dt_inicio = $RStemp["even_even_dt_inicio"];
        $this->even_even_dt_fim = $RStemp["even_even_dt_fim"];
        $this->even_even_dt_inicio_publicacao = $RStemp["even_even_dt_inicio_publicacao"];
        $this->even_even_dt_fim_publicacao = $RStemp["even_even_dt_fim_publicacao"];
        $this->even_even_status = $RStemp["even_even_status"];		
	}	
	
	
	function getEventos(){

		$l_str_sql = " select even_even_pk, ";
		$l_str_sql.= "        even_even_nome, ";
                $l_str_sql.= "        even_even_destaque, ";
                $l_str_sql.= "        even_even_tipo, ";
                $l_str_sql.= "        even_even_inscricao, ";
		$l_str_sql.= "        DATE_FORMAT(even_even_dt_inicio, '%d/%m/%Y') even_even_dt_inicio, ";
		$l_str_sql.= "        DATE_FORMAT(even_even_dt_fim, '%d/%m/%Y') even_even_dt_fim, ";
		$l_str_sql.= "        DATE_FORMAT(even_even_dt_inicio_publicacao, '%d/%m/%Y %H:%i') even_even_dt_inicio_publicacao, ";
		$l_str_sql.= "        DATE_FORMAT(even_even_dt_fim_publicacao, '%d/%m/%Y %H:%i') even_even_dt_fim_publicacao, ";
		$l_str_sql.= "        even_even_status ";		
		$l_str_sql.= " from even_evento "; 
		$l_str_sql.= " order by even_even_pk desc";

                //echo $l_str_sql;

		//monta o recordset
		$rsEventos =  $this->dbconn->getRecordset($l_str_sql);

                $i = 0;
                $arrayEventos = NULL;

                while($RStemp = $this->dbconn->getRecordsetArray($rsEventos)){

                      $evento = new Evento;

                        $evento->even_even_pk = $RStemp["even_even_pk"];
                        $evento->even_even_nome = $RStemp["even_even_nome"];
                        $evento->even_even_destaque = $RStemp["even_even_destaque"];
                        $evento->even_even_tipo = $RStemp["even_even_tipo"];
                        $evento->even_even_inscricao = $RStemp["even_even_inscricao"];
                        $evento->even_even_corpo = $RStemp["even_even_corpo"];
                        $evento->even_even_dt_inicio = $RStemp["even_even_dt_inicio"];
                        $evento->even_even_dt_fim = $RStemp["even_even_dt_fim"];
                        $evento->even_even_dt_inicio_publicacao = $RStemp["even_even_dt_inicio_publicacao"];
                        $evento->even_even_dt_fim_publicacao = $RStemp["even_even_dt_fim_publicacao"];
                        $evento->even_even_status = $RStemp["even_even_status"];

                      //coloca os eventos no array
                      $arrayEventos[$i++] = $evento;
                }

                //retorna o array
                return $arrayEventos;
			
	}	
	
	function incluir(){


		$l_str_sql = " insert into even_evento ( ";
		$l_str_sql.= "        even_even_nome, ";
		$l_str_sql.= "        even_even_chamada, ";				
		$l_str_sql.= "        even_even_destaque, ";
		$l_str_sql.= "        even_even_link, ";		
		$l_str_sql.= "        even_even_tipo, ";
		$l_str_sql.= "        even_even_inscricao, ";
		$l_str_sql.= "        even_even_corpo, ";
		$l_str_sql.= "        even_even_dt_inicio, ";
		$l_str_sql.= "        even_even_dt_fim, ";
		$l_str_sql.= "        even_even_dt_inicio_publicacao, ";
		$l_str_sql.= "        even_even_dt_fim_publicacao, ";
		$l_str_sql.= "        even_even_status ) ";		
		$l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->even_even_nome)."', ";
		$l_str_sql.= "          ".(($this->even_even_chamada!=NULL)?"'".$this->dbconn->anti_sql_injection($this->even_even_chamada)."'":NULL).", ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_even_destaque)."', ";
		$l_str_sql.= "          ".(($this->even_even_link!=NULL)?"'".$this->dbconn->anti_sql_injection($this->even_even_link)."'":NULL).", ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_even_tipo)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_even_inscricao)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_even_corpo)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_even_dt_inicio)."', ";
                $l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_even_dt_fim)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_even_dt_inicio_publicacao)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_even_dt_fim_publicacao)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_even_status)."' ) ";
		
		return $this->dbconn->execSql($l_str_sql);
	}
	
	function alterar(){


                settype($this->even_even_pk, 'integer');
		$l_str_sql = " update even_evento set  ";
		$l_str_sql.= "        even_even_nome = '".$this->dbconn->anti_sql_injection($this->even_even_nome)."', ";
		$l_str_sql.= "        even_even_chamada = ".(($this->even_even_chamada!=NULL)?"'".$this->dbconn->anti_sql_injection($this->even_even_chamada)."'":NULL).", ";
		$l_str_sql.= "        even_even_destaque = '".$this->dbconn->anti_sql_injection($this->even_even_destaque)."', ";
		$l_str_sql.= "        even_even_link = ".(($this->even_even_link!=NULL)?"'".$this->dbconn->anti_sql_injection($this->even_even_link)."'":NULL).", ";
		$l_str_sql.= "        even_even_tipo = '".$this->dbconn->anti_sql_injection($this->even_even_tipo)."', ";
		$l_str_sql.= "        even_even_inscricao = '".$this->dbconn->anti_sql_injection($this->even_even_inscricao)."', ";
                $l_str_sql.= "        even_even_corpo = '".$this->dbconn->anti_sql_injection($this->even_even_corpo)."', ";
		$l_str_sql.= "        even_even_dt_inicio = '".$this->dbconn->anti_sql_injection($this->even_even_dt_inicio)."', ";
		$l_str_sql.= "        even_even_dt_fim = '".$this->dbconn->anti_sql_injection($this->even_even_dt_fim)."', ";
		$l_str_sql.= "        even_even_dt_inicio_publicacao = '".$this->dbconn->anti_sql_injection($this->even_even_dt_inicio_publicacao)."', ";
		$l_str_sql.= "        even_even_dt_fim_publicacao = '".$this->dbconn->anti_sql_injection($this->even_even_dt_fim_publicacao)."', ";
		$l_str_sql.= "        even_even_status = '".$this->dbconn->anti_sql_injection($this->even_even_status)."' ";
                $l_str_sql.= " where  even_even_pk = ".$this->even_even_pk;
		
	//	echo $l_str_sql;
	//	exit;																
		return $this->dbconn->execSql($l_str_sql);	
	}
	
	function excluir(){
	settype($this->even_even_pk, 'integer');
        $l_str_sql = " delete from even_anexo ";
        $l_str_sql.= " where even_even_fk = ".$this->even_even_pk;		 															
    	$this->dbconn->execSql($l_str_sql);

        settype($this->even_even_pk, 'integer');
        $l_str_sql = " delete from even_imagem ";
        $l_str_sql.= " where even_even_fk = ".$this->even_even_pk;		 															
	    $this->dbconn->execSql($l_str_sql);
		
      settype($this->even_even_pk, 'integer');
      $l_str_sql = " delete from even_evento ";
      $l_str_sql.= " where  even_even_pk = ".$this->even_even_pk;		 														
			
    	return $this->dbconn->execSql($l_str_sql);
	
	}		
	
// ------------------------------------------------------------------
//  Metodos relacionados ao cadastro de imagens
//---------------------------------------------------------------------	

	function getListaImagens($even_even_pk){

                settype($even_even_pk, 'integer');
		$l_str_sql = " select even_img_pk, ";
		$l_str_sql.= "        even_img_titulo, ";
		$l_str_sql.= "        even_img_destaque, ";		
		$l_str_sql.= "        even_img_descricao ";														
		$l_str_sql.= " from even_imagem "; 
		$l_str_sql.= " where even_even_fk =  ".$even_even_pk; 
		$l_str_sql.= " order by even_img_pk desc";


                //monta o recordset
		return  $this->dbconn->getRecordset($l_str_sql);

			
	}	
	
	function getListaAnexos($even_even_pk){

                settype($even_even_pk, 'integer');
		$l_str_sql = " select even_anx_pk, ";
		$l_str_sql.= "        even_anx_titulo, ";
		$l_str_sql.= "        even_anx_descricao ";														
		$l_str_sql.= " from even_anexo "; 
		$l_str_sql.= " where even_even_fk =  ".$even_even_pk; 
		$l_str_sql.= " order by even_anx_pk desc"; 
		
                //monta o recordset
		return  $this->dbconn->getRecordset($l_str_sql);

			
	}		
	
}	

?>

