<?php
class MailEnvio {

    var $dbconn;
    var	$nwsl_env_pk;
    var	$nwsl_env_assunto;
    var	$nwsl_env_dt_cadastro;
    var	$nwsl_env_dt_envio;
    var	$nwsl_env_path;
    var	$nwsl_env_corpo;
    var	$nwsl_env_status;


	function MailEnvio(){

	$agora = time();
	$this->dbconn = new Dbconn;
        $this->nwsl_env_pk = NULL;
        $this->nwsl_env_assunto = NULL;
        $this->nwsl_env_dt_cadastro = date("d-m-Y H:i:s",$agora);
        $this->nwsl_env_dt_envio = NULL;
	$this->nwsl_env_path = NULL;
        $this->nwsl_env_corpo = NULL;
	$this->nwsl_env_status = NULL;

	}



	function getEnvio($nwsl_env_pk){
                
                settype($nwsl_env_pk, 'integer');
		$l_str_sql = " select nwsl_env_pk,  ";
		$l_str_sql.= "        nwsl_env_assunto,  ";
		$l_str_sql.= "        DATE_FORMAT(nwsl_env_dt_cadastro, '%d/%m/%Y %H:%i') nwsl_env_dt_cadastro, ";
		$l_str_sql.= "        DATE_FORMAT(nwsl_env_dt_envio, '%d/%m/%Y %H:%i') nwsl_env_dt_envio, ";
		$l_str_sql.= "        nwsl_env_path,  ";
                $l_str_sql.= "        nwsl_env_corpo,  ";
		$l_str_sql.= "        nwsl_env_status  ";
		$l_str_sql.= " from nwsl_envio ";
		$l_str_sql.= " where nwsl_env_pk = ".$nwsl_env_pk;


		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));

	        $this->nwsl_env_pk = $nwsl_env_pk;
	        $this->nwsl_env_assunto = $RStemp["nwsl_env_assunto"];
	        $this->nwsl_env_dt_cadastro = $RStemp["nwsl_env_dt_cadastro"];
	        $this->nwsl_env_dt_envio = $RStemp["nwsl_env_dt_envio"];
		$this->nwsl_env_path = $RStemp["nwsl_env_path"];
                $this->nwsl_env_corpo = $RStemp["nwsl_env_corpo"];
		$this->nwsl_env_status = $RStemp["nwsl_env_status"];

	}


       	function getTodasEnviadas(){

		$l_str_sql = " select nwsl_env_pk,  ";
		$l_str_sql.= "        nwsl_env_assunto,  ";
		$l_str_sql.= "        DATE_FORMAT(nwsl_env_dt_cadastro, '%d/%m/%Y %H:%i') nwsl_env_dt_cadastro, ";
		$l_str_sql.= "        DATE_FORMAT(nwsl_env_dt_envio, '%d/%m/%Y %H:%i') nwsl_env_dt_envio, ";
		$l_str_sql.= "        nwsl_env_path,  ";
		$l_str_sql.= "        nwsl_env_status  ";
		$l_str_sql.= " from nwsl_envio ";
		$l_str_sql.= " where nwsl_env_status = 'E' ";
                $l_str_sql.= " order by  nwsl_env_pk desc";


		return $this->dbconn->getRecordset($l_str_sql);
        }

}

?>
