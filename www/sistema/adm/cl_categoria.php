<?
class Categoria{

	var $news_cat_pk;
	var $news_cat_nome;
	var $news_cat_descricao;
	var $dbconn;
	

	function Categoria(){
	
		$this->dbconn = new Dbconn;
		$this->news_cat_pk = NULL;
		$this->news_cat_nome = NULL;
		$this->news_cat_descricao = NULL;
	}

	function GetCategoria($p_int_cat_pk){

                settype($p_int_cat_pk, 'integer');
		$l_str_sql = "Select news_cat_pk, "; 
		$l_str_sql.= "       news_cat_nome, ";  
		$l_str_sql.= "	     news_cat_descricao ";  
		$l_str_sql.= "from news_categoria ";  
		$l_str_sql.= "where news_cat_pk = ".$p_int_cat_pk;
	
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));

		$this->news_cat_pk = $p_int_cat_pk;
		$this->news_cat_nome = $RStemp["news_cat_nome"];
		$this->news_cat_descricao = $RStemp["news_cat_descricao"];
	}

	
	function getTodasCategorias(){
	
		$l_str_sql = "Select news_cat_pk, "; 
		$l_str_sql.= "       news_cat_nome, ";  
		$l_str_sql.= "	     news_cat_descricao ";  
		$l_str_sql.= "from news_categoria ";  
		$l_str_sql.= "order by news_cat_nome";
	 
		return $this->dbconn->getRecordset($l_str_sql);
			
	}	

	function incluir(){
		$l_str_sql = "Insert Into news_categoria (news_cat_nome, "; 
		$l_str_sql.= "			          news_cat_descricao ) ";
		$l_str_sql.= "		         values ('".$this->dbconn->anti_sql_injection($this->news_cat_nome)."', ";
		$l_str_sql.= "			         '".$this->dbconn->anti_sql_injection($this->news_cat_descricao)."' ) ";
	
		return $this->dbconn->execSql($l_str_sql);	
	}

	function alterar(){

                settype($this->news_cat_pk, 'integer');
		$l_str_sql = "Update news_categoria set "; 
		$l_str_sql.= "news_cat_nome = '".$this->dbconn->anti_sql_injection($this->news_cat_nome)."', ";
		$l_str_sql.= "news_cat_descricao = '".$this->dbconn->anti_sql_injection($this->news_cat_descricao)."' ";
		$l_str_sql.= "where news_cat_pk = $this->news_cat_pk ";

		return $this->dbconn->execSql($l_str_sql);
	}


	function excluir(){
                settype($this->news_cat_pk, 'integer');
		$l_str_sql = "Delete from news_categoria "; 
		$l_str_sql.= "where news_cat_pk = $this->news_cat_pk ";
		return $this->dbconn->execSql($l_str_sql);
	}

	function existeNoticiaAssociada(){

                settype($this->news_cat_pk, 'integer');
		$l_str_sql = "select news_not_pk ";
		$l_str_sql.= "from news_noticia ";
		$l_str_sql.= "where news_cat_fk = ".$this->news_cat_pk;		

		//monta o recordset
		$RStemp = $this->dbconn->getRecordset($l_str_sql);
		
		//se existir registro retorna ele
		if($this->dbconn->getExisteRecordset($RStemp))
		   return true;
		else
		   return false;

	}
	

}


?>
