<?php 
class Inscricao{

    var $dbconn;
    var $even_insc_pk;
    var $even_insc_nome;
    var $even_insc_crvm;
    var $even_insc_dt_inscricao;
    var $even_insc_tipo_inscrito_inscrito;
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
	
	function GetInscricao($even_insc_pk){

                settype($even_insc_pk, 'integer');
		$l_str_sql = " select i.even_insc_nome, ";
		$l_str_sql.= "        i.even_insc_crmv, ";
		$l_str_sql.= "        i.even_insc_tipo_inscrito, ";
		$l_str_sql.= "        i.even_insc_tel, ";
		$l_str_sql.= "        i.even_insc_cel, ";
		$l_str_sql.= "        i.even_insc_email, ";
		$l_str_sql.= "        DATE_FORMAT(i.even_insc_dt_inscricao, '%d/%m/%Y %H:%i') i.even_insc_dt_inscricao, ";
		$l_str_sql.= "        i.even_even_fk, ";
		$l_str_sql.= "        e.even_even_nome ";
		$l_str_sql.= " from even_inscricao i INNER JOIN even_evento e ON (e.even_even_pk = i.even_even_fk) ";
		$l_str_sql.= " where even_insc_pk = ".$even_insc_pk;
		
		//$RS = $this->dbconn->gerRecordset($l_str_sql)
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));


        $this->even_insc_pk = $even_insc_pk;
        $this->even_insc_nome = $RStemp["even_insc_nome"];
        $this->even_insc_crmv = $RStemp["even_insc_crmv"];
        $this->even_insc_tipo_inscrito = $RStemp["even_insc_tipo_inscrito"];
        $this->even_insc_tel = $RStemp["even_insc_tel"];
        $this->even_insc_cel = $RStemp["even_insc_cel"];
        $this->even_insc_email = $RStemp["even_insc_email"];
        $this->even_insc_dt_inscricao = $RStemp["even_insc_dt_inscricao"];
        $this->even_insc_fk = $RStemp["even_insc_fk"];
        $this->evento->even_even_pk = $RStemp["even_insc_fk"];
        $this->evento->even_even_nome = $RStemp["even_even_nome"];



	}	
	
	
	function getIncricoes($even_even_pk){

                settype($even_even_pk, 'integer');
		$l_str_sql = " select even_insc_pk, ";
		$l_str_sql.= "        even_insc_nome, ";
                $l_str_sql.= "        even_insc_crmv, ";
                $l_str_sql.= "        even_insc_tipo_inscrito, ";
                $l_str_sql.= "        even_insc_tel, ";
                $l_str_sql.= "        even_insc_cel, ";
                $l_str_sql.= "        even_insc_email, ";
		$l_str_sql.= "        DATE_FORMAT(even_insc_dt_inscricao, '%d/%m/%Y %H:%i') even_insc_dt_inscricao, ";
		$l_str_sql.= "        even_even_fk ";
		$l_str_sql.= " from even_inscricao ";
                $l_str_sql.= " where even_even_fk = ".$even_even_pk;
		$l_str_sql.= " order by even_insc_nome";

//                echo $l_str_sql;
//                exit;
                
		//monta o recordset
		$rsInscricao =  $this->dbconn->getRecordset($l_str_sql);

                $i = 0;
                $arrayInscricao = NULL;

                while($RStemp = $this->dbconn->getRecordsetArray($rsInscricao)){

                      $inscricao = new Inscricao;

                        $inscricao->even_insc_pk = $RStemp["even_insc_pk"];
                        $inscricao->even_insc_nome = $RStemp["even_insc_nome"];
                        $inscricao->even_insc_crmv = $RStemp["even_insc_crmv"];
                        $inscricao->even_insc_tipo_inscrito = $this->nomeTipoInscrito($RStemp["even_insc_tipo_inscrito"]);
                        $inscricao->even_insc_tel = $RStemp["even_insc_tel"];
                        $inscricao->even_insc_cel = $RStemp["even_insc_cel"];
                        $inscricao->even_insc_email = $RStemp["even_insc_email"];
                        $inscricao->even_insc_dt_inscricao = $RStemp["even_insc_dt_inscricao"];
                        $inscricao->even_even_fk = $RStemp["even_even_fk"];

                      //coloca os inscricaos no array
                      $arrayInscricao[$i++] = $inscricao;
                }

                //retorna o array
                return $arrayInscricao;
			
	}

        function nomeTipoInscrito($tipo){
            switch ($tipo) {
                case 'C':
                    return 'Cad Conselho';
                    break;
                case 'E':
                    return 'Estudante';
                    break;
                case 'O':
                    return 'Outros';
                    break;
                default:
                    return 'Desconhecido';
                    break;
            }
        }
	
	function incluir(){


		$l_str_sql = " insert into even_inscricao ( ";
		$l_str_sql.= "        even_insc_nome, ";
		$l_str_sql.= "        even_insc_crmv, ";
		$l_str_sql.= "        even_even_email, ";
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
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_insc_dt_inscricao)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->even_even_fk)."' ) ";
		
		return $this->dbconn->execSql($l_str_sql);
	}
	
	function alterar(){


                settype($this->even_insc_pk, 'integer');
		$l_str_sql = " update even_inscricao set  ";
		$l_str_sql.= "        even_insc_nome = '".$this->dbconn->anti_sql_injection($this->even_insc_nome)."', ";
		$l_str_sql.= "        even_insc_crmv = ".(($this->even_insc_crmv!=NULL)?"'".$this->dbconn->anti_sql_injection($this->even_insc_crmv)."'":NULL).", ";
		$l_str_sql.= "        even_even_email = ".(($this->even_even_email!=NULL)?"'".$this->dbconn->anti_sql_injection($this->even_even_email)."'":NULL).", ";
		$l_str_sql.= "        even_insc_tipo_inscrito = '".$this->dbconn->anti_sql_injection($this->even_insc_tipo_inscrito)."', ";
		$l_str_sql.= "        even_insc_tel = '".$this->dbconn->anti_sql_injection($this->even_insc_tel)."', ";
                $l_str_sql.= "        even_insc_cel = '".$this->dbconn->anti_sql_injection($this->even_insc_cel)."', ";
		$l_str_sql.= "        even_insc_dt_inscricao = '".$this->dbconn->anti_sql_injection($this->even_insc_dt_inscricao)."', ";
		$l_str_sql.= "        even_even_fk = '".$this->dbconn->anti_sql_injection($this->even_even_fk)."' ";
                $l_str_sql.= " where  even_insc_pk = ".$this->even_insc_pk;
		
	//	echo $l_str_sql;
	//	exit;																
		return $this->dbconn->execSql($l_str_sql);	
	}
	
	function excluir(){
		
      settype($this->even_insc_pk, 'integer');
      $l_str_sql = " delete from even_inscricao ";
      $l_str_sql.= " where  even_insc_pk = ".$this->even_insc_pk;
			
    	return $this->dbconn->execSql($l_str_sql);
	
	}		
	
	function getEvento(){

            return $this->evento->GetEvento($this->even_even_fk);
			
	}	
	
	
	
}	

?>


