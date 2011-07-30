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


	function getNomeResponsavel(){

                settype($this->enqEnqPk, 'integer');
		$l_str_sql = " select adm_usr_nome ";
		$l_str_sql.= " from enq_enquete , ";
		$l_str_sql.= "      adm_usuario ";
		$l_str_sql.= " where adm_usr_pk = adm_usr_fk ";
		$l_str_sql.= "   and enq_enq_pk = ".$this->enqEnqPk;


		//cria a conexao com o banco
		$this->dbconn->conectar();

		//monta o recordset
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
		return $RStemp["adm_usr_nome"];

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

	}

	function getListaEnquetes($enq_cat_fk){

        settype($enq_cat_fk, 'integer');
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
		$l_str_sql.= " where enq_cat_fk =  ".$enq_cat_fk;
		$l_str_sql.= " order by enq_enq_pk desc";

       // echo $l_str_sql;
       // exit;

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}


function incluir(){


        settype($this->enqCatFk, 'integer');
        settype($this->admUsrFk, 'integer');

	$l_str_sql = " insert into enq_enquete ( ";
        $l_str_sql.= "        enq_enq_pergunta,  ";
        $l_str_sql.= "        enq_enq_tp_resposta,  ";
        $l_str_sql.= "        enq_enq_resultado_porcentagem,  ";
        $l_str_sql.= "        enq_enq_resultado_absoluto,  ";
        $l_str_sql.= "        enq_enq_duracao_voto,  ";
        $l_str_sql.= "        enq_enq_dt_criacao, ";
        $l_str_sql.= "        enq_enq_dt_inicio, ";
        $l_str_sql.= "        enq_enq_dt_fim, ";
        $l_str_sql.= "        enq_cat_fk,  ";
        $l_str_sql.= "        adm_usr_fk  ) ";
        $l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->enqEnqPergunta)."', ";
        $l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->enqEnqTipoResposta)."', ";
        $l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->enqEnqResultadoPorcentagem)."', ";
        $l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->enqEnqResultadoAbsoluto)."', ";
        $l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->enqEnqDuracaoVoto)."', ";
        $l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->enqEnqDtCriacao)."', ";
        $l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->enqEnqDtInicio)."', ";
        $l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->enqEnqDtFim)."', ";
        $l_str_sql.= "          ".$this->enqCatFk.", ";
        $l_str_sql.= "          ".$this->admUsrFk." ) ";



		return $this->dbconn->execSql($l_str_sql);
	}

	function alterar(){

                settype($this->enqCatFk, 'integer');
                settype($this->admUsrFk, 'integer');
                settype($this->enqEnqPk, 'integer');

		$l_str_sql = " update enq_enquete set  ";
		$l_str_sql.= "        enq_enq_pergunta = '".$this->dbconn->anti_sql_injection($this->enqEnqPergunta)."', ";
		$l_str_sql.= "        enq_enq_tp_resposta = '".$this->dbconn->anti_sql_injection($this->enqEnqTipoResposta)."', ";
		$l_str_sql.= "        enq_enq_resultado_porcentagem = '".$this->dbconn->anti_sql_injection($this->enqEnqResultadoPorcentagem)."', ";
		$l_str_sql.= "        enq_enq_resultado_absoluto = '".$this->dbconn->anti_sql_injection($this->enqEnqResultadoAbsoluto)."', ";
		$l_str_sql.= "        enq_enq_duracao_voto = ".$this->dbconn->anti_sql_injection($this->enqEnqDuracaoVoto).", ";
		$l_str_sql.= "        enq_enq_dt_inicio = '".$this->dbconn->anti_sql_injection($this->enqEnqDtInicio)."', ";
		$l_str_sql.= "        enq_enq_dt_fim = '".$this->dbconn->anti_sql_injection($this->enqEnqDtFim)."', ";
		$l_str_sql.= "        enq_cat_fk = ".$this->enqCatFk.", ";
		$l_str_sql.= "        adm_usr_fk = ".$this->admUsrFk." ";
        $l_str_sql.= " where  enq_enq_pk = ".$this->enqEnqPk;



		return $this->dbconn->execSql($l_str_sql);
	}

	function excluir(){

        settype($this->enqEnqPk, 'integer');
	$l_str_sql = " DELETE FROM enq_voto ";
        $l_str_sql.= " WHERE enq_resp_fk ";
        $l_str_sql.= " IN ( ";
        $l_str_sql.= "     SELECT enq_resp_pk ";
        $l_str_sql.= "     FROM enq_resposta ";
        $l_str_sql.= "     WHERE enq_enq_fk = ".$this->enqEnqPk;
        $l_str_sql.= " ) ";

//echo $l_str_sql;
    	$this->dbconn->execSql($l_str_sql);

        settype($this->enqEnqPk, 'integer');
        $l_str_sql = " DELETE FROM enq_resposta ";
        $l_str_sql.= "     WHERE enq_enq_fk = ".$this->enqEnqPk;
//echo $l_str_sql;
	    $this->dbconn->execSql($l_str_sql);


        settype($this->enqEnqPk, 'integer');
        $l_str_sql = " DELETE FROM enq_enquete ";
        $l_str_sql.= " WHERE enq_enq_pk = ".$this->enqEnqPk;
//echo $l_str_sql;
    	return $this->dbconn->execSql($l_str_sql);

	}




}

?>
