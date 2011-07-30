<?php 
class Idioma {

    var $dbconn;
    var $idi_idioma_pk;
    var $idi_nome;
    var $idi_descricao;
    var $idi_imagem;
	
	function Idioma (){
	
	  $this->dbconn = new Dbconn;
        $this->idi_idioma_pk = NULL;
        $this->idi_nome = NULL;
        $this->idi_descricao = NULL;
        $this->idi_imagem = NULL;				
	}
	
	function GetIdioma($idi_idioma_pk){
                settype($idi_idioma_pk, 'integer');
		$l_str_sql = " select idi_idioma_pk, ";
		$l_str_sql.= "        idi_nome, ";				
		$l_str_sql.= "        idi_descricao, ";
		$l_str_sql.= "        idi_imagem ";
		$l_str_sql.= " from idi_idioma "; 
		$l_str_sql.= " where idi_idioma_pk = ".$idi_idioma_pk; 		 

		
		//$RS = $this->dbconn->gerRecordset($l_str_sql)
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
				
        $this->idi_idioma_pk = $RStemp["idi_idioma_pk"];
        $this->idi_nome = $RStemp["idi_nome"];
        $this->idi_descricao = $RStemp["idi_descricao"];
        $this->idi_imagem = $RStemp["idi_imagem"];
	}	
	
	function getIdiomas(){
	
		$l_str_sql = " select idi_idioma_pk, ";
		$l_str_sql.= "        idi_nome, ";				
		$l_str_sql.= "        idi_descricao, ";
		$l_str_sql.= "        idi_imagem ";
		$l_str_sql.= " from idi_idioma "; 
		$l_str_sql.= " order by idi_nome desc "; 	
		
		//cria a conexao com o banco
		$this->dbconn->conectar();

		//monta o recordset
		return $this->dbconn->getRecordset($l_str_sql);
			
	}


	function getNomeIdioma($idi_idioma_pk){

                settype($idi_idioma_pk, 'integer');
		$l_str_sql = " select idi_nome";
		$l_str_sql.= " from idi_idioma ";
		$l_str_sql.= " where idi_idioma_pk = ".$idi_idioma_pk; 

		//cria a conexao com o banco
		$this->dbconn->conectar();
		
		//monta o recordset
		$RStemp = $this->dbconn->getRecordsetArray($this->dbconn->getRecordset($l_str_sql));
		return $RStemp["idi_nome"];		
			
	}	

	
	
}	

?>
