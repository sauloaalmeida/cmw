<?php
class Enquete {

    var $dbconn;
    var $enqEnqPk;
    var $enqEnqPergunta;
    var $enqEnqTipoResposta;
    var $enqEnqResultadoPorcentagem;
    var $enqEnqResultadoAbsoluto;
    var $enqEnqDuracaoVoto;
    var $enqEnqDtCriacao;
    var $enqEnqDtInicio;
    var $enqEnqDtFim;
    var $enqCatFk;
    var $admUsrFk;
    var $respostas;


	function Enquete(){

	    $agora = time();
	    $this->dbconn = new Dbconn;
        $this->enqEnqPk = NULL;
        $this->enqEnqPergunta = NULL;
        $this->enqEnqTipoResposta = NULL;
        $this->enqEnqResultadoPorcentagem = NULL;
        $this->enqEnqResultadoAbsoluto = NULL;
        $this->enqEnqDuracaoVoto = NULL;
        $this->enqEnqDtCriacao = date("d/m/Y H:i",$agora);
        $this->enqEnqDtInicio = date("d/m/Y H:i",$agora);
        $this->enqEnqDtFim = date("d/m/Y H:i",$agora);
        $this->enqCatFk = NULL;
        $this->admUsrFk = NULL;

	}

    function getResultadoPorcentagemExtenso(){
        return ($this->enqEnqResultadoPorcentagem==K_ATIVO)?K_SIM:K_NAO;
    }

    function getResultadoAbsolutoExtenso(){
        return ($this->enqEnqResultadoAbsoluto==K_ATIVO)?K_SIM:K_NAO;
    }

    function getTipoRespostaExtenso(){
        return ($this->enqEnqTipoResposta == K_ENQUETE_RESP_UNICA)?"&Uacute;nica":"M&uacute;ltipla";
    }



    function getEnquete($enq_enq_pk){

        settype($enq_enq_pk, 'integer');
        $l_str_sql = " SELECT enq_enq_pk, ";
        $l_str_sql.= "        enq_enq_pergunta,  ";
        $l_str_sql.= "        enq_enq_tp_resposta,  ";
        $l_str_sql.= "        enq_enq_resultado_porcentagem,  ";
        $l_str_sql.= "        enq_enq_resultado_absoluto,  ";
        $l_str_sql.= "        enq_enq_duracao_voto,  ";
        $l_str_sql.= "        DATE_FORMAT(enq_enq_dt_criacao, '%d/%m/%Y %H:%i') enq_enq_dt_criacao,  ";
        $l_str_sql.= "        DATE_FORMAT(enq_enq_dt_inicio, '%d/%m/%Y %H:%i')enq_enq_dt_inicio,  ";
        $l_str_sql.= "        DATE_FORMAT(enq_enq_dt_fim, '%d/%m/%Y %H:%i')enq_enq_dt_fim,  ";
        $l_str_sql.= "        enq_cat_fk,  ";
        $l_str_sql.= "        adm_usr_fk  ";
        $l_str_sql.= " FROM enq_enquete  ";
        $l_str_sql.= " WHERE enq_enq_pk = ".$enq_enq_pk;

	//$RS = $this->dbconn->gerRecordset($l_str_sql)
	$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));

        $this->enqEnqPk = $RStemp["enq_enq_pk"];
        $this->enqEnqPergunta = $RStemp["enq_enq_pergunta"];
        $this->enqEnqTipoResposta = $RStemp["enq_enq_tp_resposta"];
        $this->enqEnqResultadoPorcentagem = $RStemp["enq_enq_resultado_porcentagem"];
        $this->enqEnqResultadoAbsoluto = $RStemp["enq_enq_resultado_absoluto"];
        $this->enqEnqDuracaoVoto = $RStemp["enq_enq_duracao_voto"];
        $this->enqEnqDtCriacao = $RStemp["enq_enq_dt_criacao"];
        $this->enqEnqDtInicio = $RStemp["enq_enq_dt_inicio"];
        $this->enqEnqDtFim = $RStemp["enq_enq_dt_fim"];
        $this->enqCatFk = $RStemp["enq_cat_fk"];
        $this->admUsrFk = $RStemp["adm_usr_fk"];


	//popula o array das respostas
        $l_str_sql = " SELECT enq_resp_pk,  ";
        $l_str_sql.= "        enq_resp_resposta,  ";
        $l_str_sql.= "        enq_enq_fk  ";
        $l_str_sql.= " FROM enq_resposta  ";
        $l_str_sql.= " WHERE enq_enq_fk = ".$enq_enq_pk;
        $l_str_sql.= " order by enq_resp_pk ";

	$i = 0;
	$RSImagem = $this->dbconn->getRecordset($l_str_sql);

	while($RStemp2 = $this->dbconn->getRecordsetArray($RSImagem)){

              $resposta = new Resposta;
              $resposta->enqRespPk = $RStemp2["enq_resp_pk"];
              $resposta->enqRespResposta = $RStemp2["enq_resp_resposta"];
              $resposta->enqEnqFk = $RStemp2["enq_enq_fk"];

              //coloca a imagem completa no array
	      $this->respostas[$i++] = $resposta;
	}

    }

    function getUltimaEnquete($enq_cat_pk){

        settype($enq_cat_pk, 'integer');
        $l_str_sql = " SELECT enq_enq_pk ";
        $l_str_sql.= " FROM enq_enquete  ";
        $l_str_sql.= " WHERE enq_cat_fk = ".$enq_cat_pk;
        $l_str_sql.= "   and now() BETWEEN enq_enq_dt_inicio AND enq_enq_dt_fim ";
        $l_str_sql.= " ORDER BY enq_enq_dt_inicio desc ";
        $l_str_sql.= " LIMIT 1 ";

        $rsEnquete = $this->dbconn->getRecordset($l_str_sql);
        if($this->dbconn->getExisteRecordset($rsEnquete)){
            $RStemp = $this->dbconn->getRecordsetArray($rsEnquete);
            $this->getEnquete($RStemp["enq_enq_pk"]);
        }
    }

    function getResultadoEnquete($enq_enq_pk){

     settype($enq_enq_pk, 'integer');
     $l_str_sql = " SELECT e.enq_enq_pergunta, ";
     $l_str_sql.= "              e.enq_enq_pk, ";
     $l_str_sql.= "              r.enq_resp_pk, ";
     $l_str_sql.= "              r.enq_resp_resposta, ";
     $l_str_sql.= "              ifnull(ROUND(((res.absoluto/(SELECT count(*) FROM enq_voto WHERE enq_resp_fk in ";
     $l_str_sql.= "                        (SELECT enq_resp_pk FROM enq_resposta WHERE enq_enq_fk = ".$enq_enq_pk." )))*100)),0) porcentagem, ";
     $l_str_sql.= "              ifnull(res.absoluto,0) absoluto ";
     $l_str_sql.= " FROM enq_enquete e inner join enq_resposta r on (e.enq_enq_pk = r.enq_enq_fk) ";
     $l_str_sql.= "                    left  join (SELECT enq_resp_fk, count(enq_voto_pk) as absoluto from enq_voto GROUP BY enq_resp_fk order by enq_resp_fk) ";
     $l_str_sql.= "        as res on (r.enq_resp_pk = res.enq_resp_fk) ";
     $l_str_sql.= " WHERE enq_enq_pk = ".$enq_enq_pk;
     $l_str_sql.= " GROUP BY enq_enq_pergunta, ";
     $l_str_sql.= " enq_enq_pk, ";
     $l_str_sql.= " enq_resp_resposta ";
     $l_str_sql.= " ORDER BY enq_resp_pk ";

       return $this->dbconn->getRecordset($l_str_sql);
   }
   
   
	function getIP() {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
            return getenv("HTTP_CLIENT_IP");
        } elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
            return getenv("HTTP_X_FORWARDED_FOR");
        } elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
            return getenv("REMOTE_ADDR");
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
            return $_SERVER['REMOTE_ADDR'];
        } else {
            return "unknown";
        }
    }   


}

?>
