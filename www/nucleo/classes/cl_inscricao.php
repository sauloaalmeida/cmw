<?php 
class Inscricao{

    var $dbconn;
    var $even_insc_pk;
    var $even_insc_nome;
    var $even_insc_crvm;
    var $even_insc_dt_inscricao;
    var $even_insc_tipo_inscrito;
    var $even_insc_tel;
    var $even_insc_cel;
    var $even_insc_email;
    var $even_even_fk;
    var $evento;
	
	function Inscricao(){
	
	$agora = time();
	$this->dbconn = new Dbconn;
        $this->even_insc_pk = NULL;
        $this->even_insc_nome = NULL;
        $this->even_insc_crvm = NULL;
        $this->even_insc_dt_inscricao = date("d/m/Y H:i",$agora);;
        $this->even_insc_tipo_inscrito = NULL;
        $this->even_insc_tel = NULL;
        $this->even_insc_cel = NULL;
        $this->even_insc_email = NULL;
        $this->even_even_fk = NULL;
        $this->evento = new Evento();

	}
	
	
	
	
	function incluir(){


		$l_str_sql = " insert into even_inscricao ( ";
		$l_str_sql.= "        even_insc_nome, ";
		$l_str_sql.= "        even_insc_crmv, ";
		$l_str_sql.= "        even_insc_email, ";
		$l_str_sql.= "        even_insc_tipo_inscrito, ";
		$l_str_sql.= "        even_insc_tel, ";
		$l_str_sql.= "        even_insc_cel, ";
		$l_str_sql.= "        even_insc_dt_inscricao, ";
		$l_str_sql.= "        even_even_fk ) ";
		$l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->even_insc_nome)."', ";
		$l_str_sql.= "          ".(($this->even_insc_crmv!=NULL)?"'".$this->dbconn->anti_sql_injection($this->even_insc_crmv)."'":NULL).", ";
                $l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_insc_email)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_insc_tipo_inscrito)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_insc_tel)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_insc_cel)."', ";
		$l_str_sql.= "          now(), ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_even_fk)."' ) ";
		
//
//                echo $l_str_sql;
//                exit;
                

		return $this->dbconn->execSql($l_str_sql);
	}
		
	
	function getEvento(){

            return $this->evento->GetEvento($this->even_even_fk);
			
	}	
	
	
	
}	

?>


