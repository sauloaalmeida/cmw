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
    var $news_cat_url;
    var $adm_usr_fk;
    var $idi_idioma_fk;
    var $news_not_status;
	
	function Noticia(){
	
	    $agora = time();
	    $this->dbconn = new Dbconn;
        $this->news_not_pk = NULL;
        $this->news_not_titulo = NULL;
        $this->news_not_chamada = NULL;
        $this->news_not_destaque = NULL;				
        $this->news_not_corpo = NULL;
        $this->news_not_target = NULL;		
        $this->news_not_link = NULL;				
        $this->news_not_origem = NULL;
        $this->news_not_autor = NULL;		
        $this->news_not_dt_criacao = NULL;
        $this->news_not_dt_inicio = date("d/m/Y H:i",$agora);
        $this->news_not_dt_fim = date("d/m/Y H:i",$agora);
        $this->news_cat_fk = NULL;
        $this->news_cat_url = NULL;
        $this->adm_usr_fk = NULL;
        $this->idi_idioma_fk = NULL;
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
		$l_str_sql.= "        news_cat_url, ";
                $l_str_sql.= "        adm_usr_fk, ";
		$l_str_sql.= "        idi_idioma_fk, ";
		$l_str_sql.= "        news_not_status ";		
		$l_str_sql.= " from news_noticia inner join news_categoria on (news_cat_fk = news_cat_pk) ";
		$l_str_sql.= " where news_not_pk = ".$news_not_pk;
		
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
        $this->news_cat_url = $RStemp["news_cat_url"];
        $this->adm_usr_fk = $RStemp["adm_usr_fk"];
        $this->idi_idioma_fk = $RStemp["idi_idioma_fk"];
        $this->news_not_status = $RStemp["news_not_status"];		
	}	
	
	function getCategorias(){
	
		$l_str_sql = " select c.news_cat_pk, ";
		$l_str_sql.= "        c.news_cat_nome, ";
                $l_str_sql.= "        c.news_cat_pai_fk, ";
                $l_str_sql.= "        IF( exists(select c2.news_cat_pk from news_categoria c2 where c2.news_cat_pai_fk = c.news_cat_pk) ,'S','N') as news_cat_tem_filho ";
		$l_str_sql.= " from news_categoria c";
                $l_str_sql.= " where news_cat_pai_fk IS NOT NULL ";
                $l_str_sql.= "   and news_cat_pai_fk = (select min(c3.news_cat_pk) from news_categoria c3 where c3.news_cat_pai_fk IS NULL) ";
		$l_str_sql.= " order by news_cat_pk"; 
		
		//cria a conexao com o banco
		$this->dbconn->conectar();

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);
			
	}
        
	function GetCategoriasFilhas($news_cat_pk){
	
                settype($news_cat_pk, 'integer');
		$l_str_sql = " select c.news_cat_pk, ";
		$l_str_sql.= "        c.news_cat_nome, ";
                $l_str_sql.= "        c.news_cat_pai_fk, ";
                $l_str_sql.= "        IF( exists(select c2.news_cat_pk from news_categoria c2 where c2.news_cat_pai_fk = c.news_cat_pk) ,'S','N') as news_cat_tem_filho ";
		$l_str_sql.= " from news_categoria c";
                $l_str_sql.= " where news_cat_pai_fk IS NOT NULL ";
                $l_str_sql.= "   and news_cat_pai_fk = ".$news_cat_pk;
		$l_str_sql.= " order by news_cat_pk";
		
		//cria a conexao com o banco
		$this->dbconn->conectar();

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);
			
	}

	function GetExisteCategoriasFilhas($news_cat_pk){

                settype($news_cat_pk, 'integer');
		$l_str_sql = " select count(news_cat_pk) qtd_filhos";
                $l_str_sql.= " from news_categoria ";
                $l_str_sql.= " where news_cat_pai_fk = ".$news_cat_pk;
                $l_str_sql.= "   and news_cat_pai_fk IS NOT NULL ";

                $RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));

                if($RStemp["qtd_filhos"] > 0)
                    return true;
                else
                    return false;

	}

	function GetCategoriasPais($news_cat_pk){

                settype($news_cat_pk, 'integer');
		$l_str_sql = " call getCategoriasPai(".$news_cat_pk.")";

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);

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
	
	
	function getListaNoticias($news_cat_fk){

                settype($news_cat_pk, 'integer');
		$l_str_sql = " select news_not_pk, ";
		$l_str_sql.= "        news_not_titulo, ";
		$l_str_sql.= "        news_not_link, ";		
		$l_str_sql.= "        news_not_target, ";				
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_criacao, '%d/%m/%Y %H:%i') news_not_dt_criacao, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_inicio, '%d/%m/%Y %H:%i') news_not_dt_inicio, ";
		$l_str_sql.= "        DATE_FORMAT(news_not_dt_fim, '%d/%m/%Y %H:%i') news_not_dt_fim, ";
		$l_str_sql.= "        news_not_destaque, ";														
		$l_str_sql.= "        idi_idioma_fk, ";		
		$l_str_sql.= "        idi_imagem, ";		
		$l_str_sql.= "        news_not_status ";		
		$l_str_sql.= " from news_noticia inner join idi_idioma on (idi_idioma_pk = idi_idioma_fk) "; 
		$l_str_sql.= " where news_cat_fk =  ".$news_cat_fk; 
		$l_str_sql.= " order by news_not_pk desc"; 


		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);
			
	}	
	
	function incluir(){

                settype($this->news_cat_fk, 'integer');
                settype($this->adm_usr_fk, 'integer');
                settype($this->idi_idioma_fk, 'integer');
		$l_str_sql = " insert into news_noticia ( ";
		$l_str_sql.= "        news_not_titulo, ";		
		$l_str_sql.= "        news_not_chamada, ";				
		$l_str_sql.= "        news_not_destaque, ";
		$l_str_sql.= "        news_not_corpo, ";
		$l_str_sql.= "        news_not_link, ";		
		$l_str_sql.= "        news_not_target, ";		
		$l_str_sql.= "        news_not_origem, ";
		$l_str_sql.= "        news_not_autor, ";		
		$l_str_sql.= "        news_not_dt_criacao, ";
		$l_str_sql.= "        news_not_dt_inicio, ";
		$l_str_sql.= "        news_not_dt_fim, ";
		$l_str_sql.= "        news_cat_fk, ";
		$l_str_sql.= "        adm_usr_fk, ";			
		$l_str_sql.= "        idi_idioma_fk, ";	
		$l_str_sql.= "        news_not_status ) ";		
		$l_str_sql.= " values ( '".$this->dbconn->anti_sql_injection($this->news_not_titulo)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_not_chamada)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_not_destaque)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_not_corpo)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_not_link)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_not_target)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_not_origem)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_not_autor)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_not_dt_criacao)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_not_dt_inicio)."', ";
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_not_dt_fim)."', ";
		$l_str_sql.= "           ".$this->news_cat_fk.", "; 				
		$l_str_sql.= "           ".$this->adm_usr_fk.", "; 
		$l_str_sql.= "           ".$this->idi_idioma_fk.", "; 
		$l_str_sql.= "          '".$this->dbconn->anti_sql_injection($this->news_not_status)."' ) ";
		
		return $this->dbconn->execSql($l_str_sql);
	}
	
	function alterar(){

                settype($this->news_cat_fk, 'integer');
                settype($this->adm_usr_fk, 'integer');
                settype($this->idi_idioma_fk, 'integer');
                settype($this->news_not_pk, 'integer');
		$l_str_sql = " update news_noticia set  ";
		$l_str_sql.= "        news_not_titulo = '".$this->dbconn->anti_sql_injection($this->news_not_titulo)."', ";
		$l_str_sql.= "        news_not_chamada = '".$this->dbconn->anti_sql_injection($this->news_not_chamada)."', ";
		$l_str_sql.= "        news_not_destaque = '".$this->dbconn->anti_sql_injection($this->news_not_destaque)."', ";
		$l_str_sql.= "        news_not_corpo = '".$this->dbconn->anti_sql_injection($this->news_not_corpo)."', ";
		$l_str_sql.= "        news_not_link = '".$this->dbconn->anti_sql_injection($this->news_not_link)."', ";
		$l_str_sql.= "        news_not_target = '".$this->dbconn->anti_sql_injection($this->news_not_target)."', ";
		$l_str_sql.= "        news_not_origem = '".$this->dbconn->anti_sql_injection($this->news_not_origem)."', ";
		$l_str_sql.= "        news_not_autor = '".$this->dbconn->anti_sql_injection($this->news_not_autor)."', ";
		$l_str_sql.= "        news_not_dt_criacao = '".$this->dbconn->anti_sql_injection($this->news_not_dt_criacao)."', ";
		$l_str_sql.= "        news_not_dt_inicio = '".$this->dbconn->anti_sql_injection($this->news_not_dt_inicio)."', ";
		$l_str_sql.= "        news_not_dt_fim = '".$this->dbconn->anti_sql_injection($this->news_not_dt_fim)."', ";
		$l_str_sql.= "        news_cat_fk = ".$this->news_cat_fk.", ";
		$l_str_sql.= "        adm_usr_fk = ".$this->adm_usr_fk.", ";				
		$l_str_sql.= "        idi_idioma_fk = ".$this->idi_idioma_fk.", ";
		$l_str_sql.= "        news_not_status = '".$this->dbconn->anti_sql_injection($this->news_not_status)."' ";
        $l_str_sql.= " where  news_not_pk = ".$this->news_not_pk;		 
		
	//	echo $l_str_sql;
	//	exit;
														
		
		return $this->dbconn->execSql($l_str_sql);	
	}
	
	function excluir(){
	settype($this->news_not_pk, 'integer');
        $l_str_sql = " delete from news_anexo ";
        $l_str_sql.= " where news_not_fk = ".$this->news_not_pk;		 															
    	$this->dbconn->execSql($l_str_sql);

        settype($this->news_not_pk, 'integer');
        $l_str_sql = " delete from news_imagem ";
        $l_str_sql.= " where news_not_fk = ".$this->news_not_pk;		 															
	    $this->dbconn->execSql($l_str_sql);
		
      settype($this->news_not_pk, 'integer');
      $l_str_sql = " delete from news_noticia ";
      $l_str_sql.= " where  news_not_pk = ".$this->news_not_pk;		 														
			
    	return $this->dbconn->execSql($l_str_sql);
	
	}		
	
// ------------------------------------------------------------------
//  Metodos relacionados ao cadastro de imagens
//---------------------------------------------------------------------	

	function getListaImagens($news_not_pk){

                settype($news_not_pk, 'integer');
		$l_str_sql = " select news_img_pk, ";
		$l_str_sql.= "        news_img_titulo, ";
		$l_str_sql.= "        news_img_destaque, ";		
		$l_str_sql.= "        news_img_descricao ";														
		$l_str_sql.= " from news_imagem "; 
		$l_str_sql.= " where news_not_fk =  ".$news_not_pk; 
		$l_str_sql.= " order by news_img_pk desc"; 
		
		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);
			
	}	
	
	function getListaAnexos($news_not_pk){

                settype($news_not_pk, 'integer');
		$l_str_sql = " select news_anx_pk, ";
		$l_str_sql.= "        news_anx_titulo, ";
		$l_str_sql.= "        news_anx_descricao ";														
		$l_str_sql.= " from news_anexo "; 
		$l_str_sql.= " where news_not_fk =  ".$news_not_pk; 
		$l_str_sql.= " order by news_anx_pk desc"; 
		
		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);
			
	}		
	
}	

?>
