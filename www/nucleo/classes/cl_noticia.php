<?php
class Noticia {

    var $dbconn;
    var $news_not_pk;
    var $news_not_titulo;
    var $news_not_chamada;
    var $news_not_destaque;
    var $news_not_corpo;
    var $news_not_link;
    var $news_not_target;
    var $news_not_origem;
    var $news_not_autor;
    var $news_not_dt_criacao;
    var $news_not_dt_inicio;
    var $news_not_dt_fim;
    var $news_cat_fk;
    var $adm_usr_fk;
    var $news_not_status;

	function Noticia(){

	    $agora = time();
	    $this->dbconn = new Dbconn;
        $this->news_not_pk = NULL;
        $this->news_not_titulo = NULL;
        $this->news_not_chamada = NULL;
        $this->news_not_destaque = NULL;
        $this->news_not_corpo = NULL;
        $this->news_not_link = NULL;
        $this->news_not_target = NULL;
        $this->news_not_origem = NULL;
        $this->news_not_autor = NULL;
        $this->news_not_dt_criacao = NULL;
        $this->news_not_dt_inicio = date("d/m/Y H:i",$agora);
        $this->news_not_dt_fim = date("d/m/Y H:i",$agora);
        $this->news_cat_fk = NULL;
        $this->adm_usr_fk = NULL;
        $this->news_not_status = NULL;
	}

	function GetNoticia($news_not_pk){

                settype($news_not_pk, 'integer');
		$l_str_sql = " select news_not_titulo, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_destaque, ";
		$l_str_sql.= "        news_not_corpo, ";
		$l_str_sql.= "        news_not_link, ";
		$l_str_sql.= "        news_not_target, ";
		$l_str_sql.= "        news_not_origem, ";
		$l_str_sql.= "        news_not_autor, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_criacao, '%d/%m/%Y %H:%i') news_not_dt_criacao, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%Y %H:%i') news_not_dt_inicio, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_fim, '%d/%m/%Y %H:%i') news_not_dt_fim, ";
		$l_str_sql.= "        news_cat_fk, ";
		$l_str_sql.= "        adm_usr_fk, ";
		$l_str_sql.= "        news_not_status ";
		$l_str_sql.= " from news_noticia ";
		$l_str_sql.= " where news_not_pk = ".$news_not_pk;
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";

		//$RS = $this->dbconn->gerRecordset($l_str_sql)
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));

        $this->news_not_pk = $news_not_pk;
        $this->news_not_titulo = $RStemp["news_not_titulo"];
        $this->news_not_chamada = $RStemp["news_not_chamada"];
        $this->news_not_destaque = $RStemp["news_not_destaque"];
        $this->news_not_corpo = $RStemp["news_not_corpo"];
        $this->news_not_link = $RStemp["news_not_link"];
        $this->news_not_target = $RStemp["news_not_target"];
        $this->news_not_origem = $RStemp["news_not_origem"];
        $this->news_not_autor = $RStemp["news_not_autor"];
        $this->news_not_dt_criacao = $RStemp["news_not_dt_criacao"];
        $this->news_not_dt_inicio = $RStemp["news_not_dt_inicio"];
        $this->news_not_dt_fim = $RStemp["news_not_dt_fim"];
        $this->news_cat_fk = $RStemp["news_cat_fk"];
        $this->adm_usr_fk = $RStemp["adm_usr_fk"];
        $this->news_not_status = $RStemp["news_not_status"];
	}


	function GetAgenda($news_not_pk){


                settype($news_not_pk, 'integer');
		$l_str_sql = " select news_not_titulo, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_destaque, ";
		$l_str_sql.= "        news_not_corpo, ";
		$l_str_sql.= "        news_not_link, ";
		$l_str_sql.= "        news_not_target, ";
		$l_str_sql.= "        news_not_origem, ";
		$l_str_sql.= "        news_not_autor, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_criacao, '%d/%m/%Y %H:%i') news_not_dt_criacao, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%Y %H:%i') news_not_dt_inicio, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_fim, '%d/%m/%Y %H:%i') news_not_dt_fim, ";
		$l_str_sql.= "        news_cat_fk, ";
		$l_str_sql.= "        adm_usr_fk, ";
		$l_str_sql.= "        news_not_status ";
		$l_str_sql.= " from news_noticia ";
		$l_str_sql.= " where news_not_pk = ".$news_not_pk;
		$l_str_sql.= "   and news_not_status = 'A' ";


		//$RS = $this->dbconn->gerRecordset($l_str_sql)
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));

        $this->news_not_pk = $news_not_pk;
        $this->news_not_titulo = $RStemp["news_not_titulo"];
        $this->news_not_chamada = $RStemp["news_not_chamada"];
        $this->news_not_destaque = $RStemp["news_not_destaque"];
        $this->news_not_corpo = $RStemp["news_not_corpo"];
        $this->news_not_link = $RStemp["news_not_link"];
        $this->news_not_target = $RStemp["news_not_target"];
        $this->news_not_origem = $RStemp["news_not_origem"];
        $this->news_not_autor = $RStemp["news_not_autor"];
        $this->news_not_dt_criacao = $RStemp["news_not_dt_criacao"];
        $this->news_not_dt_inicio = $RStemp["news_not_dt_inicio"];
        $this->news_not_dt_fim = $RStemp["news_not_dt_fim"];
        $this->news_cat_fk = $RStemp["news_cat_fk"];
        $this->adm_usr_fk = $RStemp["adm_usr_fk"];
        $this->news_not_status = $RStemp["news_not_status"];
	}

	function getNomeCategoria($news_cat_pk){

                settype($news_cat_pk, 'integer');
		$l_str_sql = " select news_cat_nome ";
		$l_str_sql.= " from news_categoria ";
		$l_str_sql.= " where news_cat_pk = ".$news_cat_pk;

		//cria a conexao com o banco
		$this->dbconn->conectar();

		//monta o recordset
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
		return $RStemp["news_cat_nome"];

	}

	function getNomeResponsavel(){

                settype($this->news_not_pk, 'integer');
		$l_str_sql = " select adm_usr_nome ";
		$l_str_sql.= " from news_noticia , ";
		$l_str_sql.= "      adm_usuario ";
		$l_str_sql.= " where adm_usr_pk = adm_usr_fk ";
		$l_str_sql.= "   and news_not_pk = ".$this->news_not_pk;

		//cria a conexao com o banco
		$this->dbconn->conectar();

		//monta o recordset
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
		return $RStemp["adm_usr_nome"];

	}

	function getUltimasNoticias($news_cat_fk,$qtd,$idioma){

                settype($news_cat_fk, 'integer');
                settype($qtd, 'integer');
                settype($idioma, 'integer');
		$l_str_sql = " select news_not_pk, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_titulo, ";
		$l_str_sql.= "        news_not_link, ";
		$l_str_sql.= "        news_not_target, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%y %H:%i') news_not_dt_inicio ";
		$l_str_sql.= " from news_noticia";
		$l_str_sql.= " where news_cat_fk =  ".$news_cat_fk;
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
		$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
		$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          news_not_dt_inicio DESC, ";
		$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";
		$l_str_sql.= " LIMIT ".$qtd;

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}


        function getUltimasNoticiasNotDestaque($news_cat_fk,$qtd,$idioma){

                settype($news_cat_fk, 'integer');
                settype($qtd, 'integer');
                settype($idioma, 'integer');
		$l_str_sql = " select news_not_pk, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_titulo, ";
		$l_str_sql.= "        news_not_link, ";
		$l_str_sql.= "        news_not_target, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%y %H:%i') news_not_dt_inicio ";
		$l_str_sql.= " from news_noticia";
		$l_str_sql.= " where news_cat_fk =  ".$news_cat_fk;
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and news_not_destaque <> 'A' ";
		$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
		$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
		$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          news_not_dt_inicio DESC, ";
		$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";
		$l_str_sql.= " LIMIT ".$qtd;

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}

        function getUltimasNoticiasNotDestaqueNotIn($news_cat_fk,$qtd,$lista,$idioma){

                settype($news_cat_fk, 'integer');
                settype($qtd, 'integer');
                settype($idioma, 'integer');

		$l_str_sql = " select news_not_pk, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_titulo, ";
		$l_str_sql.= "        news_not_link, ";
		$l_str_sql.= "        news_not_target, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%y %H:%i') news_not_dt_inicio ";
		$l_str_sql.= " from news_noticia";
		$l_str_sql.= " where news_cat_fk =  ".$news_cat_fk;
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and news_not_destaque <> 'A' ";
		$l_str_sql.= "   and news_not_pk NOT IN (".$this->dbconn->anti_sql_injection($lista).") ";
		$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
		$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
		$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          news_not_dt_inicio DESC, ";
		$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";
		$l_str_sql.= " LIMIT ".$qtd;

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}




	function getUltimasNoticiasCompleto($news_cat_fk,$qtd,$idioma){

                settype($news_cat_fk, 'integer');
                settype($qtd, 'integer');
                settype($idioma, 'integer');
		$l_str_sql = " select news_not_pk, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_titulo, ";
		$l_str_sql.= "        news_not_corpo, ";
		$l_str_sql.= "        news_not_link, ";
		$l_str_sql.= "        news_not_target, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%y %H:%i') news_not_dt_inicio ";
		$l_str_sql.= " from news_noticia";
		$l_str_sql.= " where news_cat_fk =  ".$news_cat_fk;
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
		$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
		$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          news_not_dt_inicio DESC, ";
		$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";
		$l_str_sql.= " LIMIT ".$qtd;

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}

	function pesquisar($pesquisa,$lista,$qtd,$idioma){

                settype($qtd, 'integer');
                settype($idioma, 'integer');

		$l_str_sql = " select news_not_pk, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_titulo, ";
		$l_str_sql.= "        news_not_corpo, ";
		$l_str_sql.= "        news_not_link, ";
		$l_str_sql.= "        news_not_target, ";
		$l_str_sql.= "        news_cat_nome, ";
                $l_str_sql.= "        news_cat_fk, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%y %H:%i') news_not_dt_inicio ";
		$l_str_sql.= " from news_noticia, ";
		$l_str_sql.= "      news_categoria ";
		$l_str_sql.= " where news_cat_fk = news_cat_pk ";
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
		$l_str_sql.= "   and news_cat_fk IN (".$this->dbconn->anti_sql_injection($lista).") ";
                $l_str_sql.= "   and ( ";
                $l_str_sql.= "        news_not_titulo LIKE '%".$this->dbconn->anti_sql_injection($pesquisa)."%' OR ";
                $l_str_sql.= "        news_not_chamada LIKE '%".$this->dbconn->anti_sql_injection($pesquisa)."%' OR ";
                $l_str_sql.= "        news_not_corpo LIKE '%".$this->dbconn->anti_sql_injection($pesquisa)."%' OR ";
                $l_str_sql.= "        news_not_autor LIKE '%".$this->dbconn->anti_sql_injection($pesquisa)."%' OR ";
                $l_str_sql.= "        news_not_origem LIKE '%".$this->dbconn->anti_sql_injection($pesquisa)."%' ";
                $l_str_sql.= "        ) ";
		$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          news_not_dt_inicio DESC, ";
		$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";
		$l_str_sql.= " LIMIT ".$qtd;

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}



	function getUltimasNoticiasDestaques($news_cat_fk,$qtd,$idioma){

                settype($news_cat_fk, 'integer');
                settype($qtd, 'integer');
                settype($idioma, 'integer');
		$l_str_sql = " select news_not_pk, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_titulo, ";
		$l_str_sql.= "        news_not_link, ";
                $l_str_sql.= "        news_not_autor, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%Y %H:%i') news_not_dt_inicio, ";
		$l_str_sql.= "        news_not_target ";
		$l_str_sql.= " from news_noticia ";
		$l_str_sql.= " where news_cat_fk =  ".$news_cat_fk;
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and news_not_destaque = 'A' ";
		$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
		$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
		$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          news_not_dt_inicio DESC, ";
		$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";
		$l_str_sql.= " LIMIT ".$qtd;

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}


	function getUltimasNoticiasDestaquesCompletoNotIn($news_cat_fk,$qtd,$lista,$idioma){

                settype($news_cat_fk, 'integer');
                settype($qtd, 'integer');
                settype($idioma, 'integer');
		$l_str_sql = " select news_not_pk, ";
		$l_str_sql.= "        news_not_titulo, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_corpo, ";
		$l_str_sql.= "        news_not_link, ";
		$l_str_sql.= "        news_not_target, ";
		$l_str_sql.= "        news_not_origem, ";
		$l_str_sql.= "        news_not_autor, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%Y') news_not_dt_inicio ";
		$l_str_sql.= " from news_noticia ";
		$l_str_sql.= " where news_cat_fk =  ".$news_cat_fk;
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and news_not_destaque = 'A' ";
		$l_str_sql.= "   and news_not_pk NOT IN (".$this->dbconn->anti_sql_injection($lista).") ";
		$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
		$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
		$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          news_not_dt_inicio DESC, ";
		$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";
		$l_str_sql.= " LIMIT ".$qtd;

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}

	function getUltimasNoticiasNotIn($news_cat_fk,$qtd,$lista,$idioma){

                settype($news_cat_fk, 'integer');
                settype($qtd, 'integer');
                settype($idioma, 'integer');
		$l_str_sql = " select news_not_pk, ";
		$l_str_sql.= "        news_not_titulo, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_corpo, ";
		$l_str_sql.= "        news_not_link, ";
		$l_str_sql.= "        news_not_target, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%y') news_not_dt_inicio, ";
		$l_str_sql.= "        news_not_origem ";
		$l_str_sql.= " from news_noticia ";
		$l_str_sql.= " where news_cat_fk =  ".$news_cat_fk;
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
		$l_str_sql.= "   and news_not_pk NOT IN (".$this->dbconn->anti_sql_injection($lista).") ";
		$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
		$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          news_not_dt_inicio DESC, ";
		$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";
		$l_str_sql.= " LIMIT ".$qtd;

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}

	function getListaImagens($news_not_pk){

                settype($news_not_pk, 'integer');
		$l_str_sql = " select news_img_pk, ";
		$l_str_sql.= "        news_img_titulo, ";
		$l_str_sql.= "        news_img_path1, ";
		$l_str_sql.= "        news_img_path2, ";
		$l_str_sql.= "        news_img_descricao, ";
		$l_str_sql.= "        news_img_credito ";
		$l_str_sql.= " from news_imagem ";
		$l_str_sql.= " where news_not_fk =  ".$news_not_pk;
		$l_str_sql.= " order by news_img_pk desc";

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}

	function getListaImagensNotDestaque($news_not_pk){

                settype($news_not_pk, 'integer');
		$l_str_sql = " select news_img_pk, ";
		$l_str_sql.= "        news_img_titulo, ";
		$l_str_sql.= "        news_img_path1, ";
		$l_str_sql.= "        news_img_path2, ";
                $l_str_sql.= "        news_img_credito, ";
		$l_str_sql.= "        news_img_descricao ";
		$l_str_sql.= " from news_imagem ";
		$l_str_sql.= " where news_not_fk =  ".$news_not_pk;
		$l_str_sql.= "   and news_img_destaque <> 'A' ";
		$l_str_sql.= " order by news_img_pk desc";

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}

	function getListaImagensNotIn($news_not_pk,$lista){

                settype($news_not_pk, 'integer');
		$l_str_sql = " select news_img_pk, ";
		$l_str_sql.= "        news_img_titulo, ";
		$l_str_sql.= "        news_img_path1, ";
		$l_str_sql.= "        news_img_descricao ";
		$l_str_sql.= " from news_imagem ";
		$l_str_sql.= " where news_not_fk =  ".$news_not_pk;
		$l_str_sql.= "   and news_img_pk NOT IN (".$this->dbconn->anti_sql_injection($lista).") ";
		$l_str_sql.= " order by news_img_pk desc";

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}

	function getImagemDestaque($news_not_pk){

                settype($news_not_pk, 'integer');
		$l_str_sql = " select news_img_pk, ";
		$l_str_sql.= "        news_img_titulo, ";
		$l_str_sql.= "        news_img_path1, ";
		$l_str_sql.= "        news_img_path2, ";
		$l_str_sql.= "        news_img_descricao ";
		$l_str_sql.= " from news_imagem ";
		$l_str_sql.= " where news_not_fk =  ".$news_not_pk;
		$l_str_sql.= "   and news_img_destaque = 'A' ";
		$l_str_sql.= " order by news_img_pk ";


		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}

	function getListaAnexos($news_not_pk){

                settype($news_not_pk, 'integer');
		$l_str_sql = " select news_anx_pk, ";
		$l_str_sql.= "        news_anx_titulo, ";
		$l_str_sql.= "        news_anx_descricao, ";
		$l_str_sql.= "        news_anx_path, ";
		$l_str_sql.= "        tipo_anx_nome, ";
		$l_str_sql.= "        tipo_anx_icone ";
		$l_str_sql.= " from news_anexo INNER JOIN tipo_anexo ON tipo_anx_pk = tipo_anx_fk";
		$l_str_sql.= " where news_not_fk =  ".$news_not_pk;
		$l_str_sql.= " order by news_anx_titulo desc";

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}

	function getImagensStaff($news_not_pk){

                settype($news_not_pk, 'integer');
		$l_str_sql = " select news_img_pk, ";
		$l_str_sql.= "        news_img_titulo, ";
		$l_str_sql.= "        news_img_path1, ";
		$l_str_sql.= "        news_img_credito, ";
		$l_str_sql.= "        news_img_descricao ";
		$l_str_sql.= " from news_imagem ";
		$l_str_sql.= " where news_not_fk =  ".$news_not_pk;
		$l_str_sql.= " order by news_img_titulo ASC, ";
		$l_str_sql.= "          news_img_pk DESC";

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

	}

	function GetDestaque1($news_cat_fk,$idioma){

                settype($news_cat_fk, 'integer');
                settype($idioma, 'integer');
		$l_str_sql = " select news_not_pk, ";
		$l_str_sql.= "        news_not_titulo, ";
		$l_str_sql.= "        news_not_chamada, ";
                $l_str_sql.= "        news_not_corpo, ";
		$l_str_sql.= "        news_not_link, ";
                $l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%y') news_not_dt_inicio, ";
		$l_str_sql.= "        news_not_target ";
		$l_str_sql.= " from news_noticia ";
		$l_str_sql.= " where news_cat_fk = ".$news_cat_fk;
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and news_not_destaque = 'A' ";
		$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
		$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
		$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          news_not_dt_inicio DESC, ";
		$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";



		//monta o recordset
		$RStemp = $this->dbconn->getRecordset($l_str_sql);

		//se existir registro retorna ele
		if($this->dbconn->getExisteRecordset($RStemp))
		   return $RStemp;
		else {
  				$l_str_sql = " select news_not_pk, ";
				$l_str_sql.= "        news_not_titulo, ";
				$l_str_sql.= "        news_not_chamada, ";
				$l_str_sql.= "        news_not_link, ";
    			$l_str_sql.= "        news_not_target ";
				$l_str_sql.= " from news_noticia ";
				$l_str_sql.= " where news_cat_fk = ".$news_cat_fk;
				$l_str_sql.= "   and news_not_status = 'A' ";
				$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
				$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
				$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
				$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
				$l_str_sql.= "          news_not_dt_inicio DESC, ";
				$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
				$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";

				//retorna a noticia mais nova
				return $this->dbconn->getRecordset($l_str_sql);

		}

	}


    function getRsNoticia($news_not_pk){

                settype($news_not_pk, 'integer');

		$l_str_sql = " select news_not_titulo, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_destaque, ";
		$l_str_sql.= "        news_not_corpo, ";
		$l_str_sql.= "        news_not_link, ";
		$l_str_sql.= "        news_not_target, ";
		$l_str_sql.= "        news_not_origem, ";
		$l_str_sql.= "        news_not_autor, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_criacao, '%d/%m/%Y %H:%i') news_not_dt_criacao, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%Y %H:%i') news_not_dt_inicio, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_fim, '%d/%m/%Y %H:%i') news_not_dt_fim, ";
		$l_str_sql.= "        news_cat_fk, ";
		$l_str_sql.= "        adm_usr_fk, ";
		$l_str_sql.= "        news_not_status ";
		$l_str_sql.= " from news_noticia ";
		$l_str_sql.= " where news_not_pk = ".$news_not_pk;
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";

		return $this->dbconn->getRecordset($l_str_sql);
	}



    function GetDestaque2($news_cat_fk,$news_not_pk,$idioma){

                settype($news_cat_fk, 'integer');
                settype($news_not_pk, 'integer');
                settype($idioma, 'integer');
		$l_str_sql = " select news_not_pk, ";
		$l_str_sql.= "        news_not_titulo, ";
		$l_str_sql.= "        news_not_chamada, ";
		$l_str_sql.= "        news_not_link, ";
		$l_str_sql.= "        news_not_target ";
		$l_str_sql.= " from news_noticia ";
		$l_str_sql.= " where news_cat_fk = ".$news_cat_fk;
		$l_str_sql.= "   and news_not_status = 'A' ";
		$l_str_sql.= "   and news_not_destaque = 'A' ";
		$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
		$l_str_sql.= "   and news_not_pk NOT IN (".$news_not_pk.")";
		$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
		$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          news_not_dt_inicio DESC, ";
		$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
		$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";

		//monta o recordset
		$RStemp = $this->dbconn->getRecordset($l_str_sql);

		//se existir registro retorna ele
		if($this->dbconn->getExisteRecordset($RStemp))
		   return $RStemp;
		else {
  				$l_str_sql = " select news_not_pk, ";
				$l_str_sql.= "        news_not_titulo, ";
				$l_str_sql.= "        news_not_chamada, ";
				$l_str_sql.= "        news_not_link, ";
				$l_str_sql.= "        news_not_target ";
				$l_str_sql.= " from news_noticia ";
				$l_str_sql.= " where news_cat_fk = ".$news_cat_fk;
				$l_str_sql.= "   and news_not_status = 'A' ";
				$l_str_sql.= "   and now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
				$l_str_sql.= "   and news_not_pk NOT IN (".$news_not_pk.")";
				$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
				$l_str_sql.= " order by YEAR(news_not_dt_inicio) DESC, ";
				$l_str_sql.= "          MONTH(news_not_dt_inicio) DESC, ";
				$l_str_sql.= "          news_not_dt_inicio DESC, ";
				$l_str_sql.= "          HOUR(news_not_dt_inicio) DESC, ";
				$l_str_sql.= "          MINUTE(news_not_dt_inicio) DESC ";

				//retorna a noticia mais nova
				return $this->dbconn->getRecordset($l_str_sql);

		}

	}

	function GetRSImagem($news_img_pk){

                settype($news_img_pk, 'integer');
		$l_str_sql = " select news_img_titulo, ";
		$l_str_sql.= "        news_img_descricao, ";
		$l_str_sql.= "        DATE_FORMAT(news_img_dt_cadastro, '%d/%m/%Y %H:%i:%s') news_img_dt_cadastro, ";
		$l_str_sql.= "        news_img_path1, ";
		$l_str_sql.= "        news_img_path2, ";
		$l_str_sql.= "        news_img_credito, ";
		$l_str_sql.= "        news_not_fk ";
		$l_str_sql.= " from news_imagem ";
		$l_str_sql.= " where news_img_pk = ".$news_img_pk;

		//$RS = $this->dbconn->gerRecordset($l_str_sql)
		return $this->dbconn->getRecordset($l_str_sql);

	}

	function getRsMidiaSuperior($news_cat_pk,$idioma){

                settype($news_cat_pk, 'integer');
                settype($idioma, 'integer');
		$l_str_sql = " SELECT trim(news_not_pk) news_not_pk, ";
		$l_str_sql.= "        trim(news_not_titulo) news_not_titulo,  ";
		$l_str_sql.= "        trim(news_not_link) news_not_link,  ";
		$l_str_sql.= "        trim(news_not_autor) news_not_autor, ";
		$l_str_sql.= "        trim(news_not_origem) news_not_origem  ";
		$l_str_sql.= " FROM news_noticia ";
		$l_str_sql.= " WHERE news_cat_fk = ".$news_cat_pk;
		$l_str_sql.= " AND news_not_status = 'A' ";
		$l_str_sql.= " AND now() BETWEEN news_not_dt_inicio AND news_not_dt_fim ";
		$l_str_sql.= " AND news_not_destaque = 'I' ";
		$l_str_sql.= "   and idi_idioma_fk = ".$idioma;
		$l_str_sql.= " ORDER BY news_not_titulo, ";
		$l_str_sql.= " 	 news_not_link, ";
		$l_str_sql.= " 	 news_not_autor ";

		return $this->dbconn->getRecordset($l_str_sql);

	}

}

?>