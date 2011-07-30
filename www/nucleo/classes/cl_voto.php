<?php
class Voto {

        var $dbconn;
        var $enqVotoPk;
	 var $enqVotoIp;
	 var $enqVotoDtVotacao ;
	 var $enqRespFk;

	function Voto(){

	    $agora = time();
        $this->dbconn = new Dbconn;
        $this->enqVotoPk = NULL;
	 $this->enqVotoIp = NULL;
	 $this->enqVotoDtVotacao  = NULL;
	 $this->enqRespFk = NULL;

	}


	function registrarVotacao($respFks){


            foreach ($respFks as $respFk ) {

                settype($respFk, 'integer');
		$l_str_sql = "insert into enq_voto (";
		$l_str_sql.= "     enq_voto_ip, ";
		$l_str_sql.= "	   enq_resp_fk , ";
		$l_str_sql.= "     enq_voto_dt_votacao ) ";
		$l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->enqVotoIp)."', ";
		$l_str_sql.= "          ".$respFk.", ";
		$l_str_sql.= "          CURRENT_TIMESTAMP()) ";

		 $this->dbconn->execSql($l_str_sql);

            }

           return true;
	}

    function permiteVotar($enq_enq_pk,$ip){


    settype($enq_enq_pk, 'integer');
   $l_str_sql = "select date_format(enq_voto_dt_votacao,'%d') dia, ";
   $l_str_sql.=  " date_format(enq_voto_dt_votacao,'%m') mes, ";
   $l_str_sql.=  " date_format(enq_voto_dt_votacao,'%Y') ano, ";
   $l_str_sql.=  " date_format(enq_voto_dt_votacao,'%H') hora, ";
   $l_str_sql.=  " date_format(enq_voto_dt_votacao,'%i') minuto, ";
   $l_str_sql.=  " date_format(enq_voto_dt_votacao,'%s') segundo ";
   $l_str_sql.=  " from ";
   $l_str_sql.= " (SELECT date_add(max(enq_voto_dt_votacao), interval (select enq_enq_duracao_voto from enq_enquete where enq_enq_pk = ".$enq_enq_pk.") DAY) enq_voto_dt_votacao";
   $l_str_sql.=  " FROM enq_voto";
   $l_str_sql.=  " WHERE enq_voto_ip = '".$this->dbconn->anti_sql_injection($ip)."'";
   $l_str_sql.=  " and enq_resp_fk in (select enq_resp_pk from enq_resposta where enq_enq_fk = ".$enq_enq_pk.")";
   $l_str_sql.=  " group by enq_voto_ip) as votacao_futura" ;

        // echo  $l_str_sql."<br>";


         $RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));

         $dt_voto_futuro = mktime  ($RStemp["hora"], $RStemp["minuto"], $RStemp["segundo"], $RStemp["mes"], $RStemp["dia"], $RStemp["ano"]);
         $agora = mktime();

          //echo  date('d/m/Y H:i:s',$dt_voto_futuro)."<br>";
          //echo  date('d/m/Y H:i:s',$agora)."<br>";
         //echo ($dt_voto_futuro <= $agora);

         return ($dt_voto_futuro <= $agora);

     }



}
?>
