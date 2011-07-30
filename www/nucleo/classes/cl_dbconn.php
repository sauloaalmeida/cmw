<?php
class Dbconn{


    ////////////////Atributos da class//////////////////
    var $servidor="localhost";
    //var $servidor="mysql2.vlsweb.com.br";
    var $usuario="root";
    //var $usuario="crmvba";
    var $senha="";
    //var $senha="4pDyIt";
    var $banco="crmvba";
    //var $banco="crmvba_org_br";
    var $conexao=""; 


    function conectar(){
        $this->conexao = mysqli_connect($this->servidor,$this->usuario,$this->senha,$this->banco);
		$this->conexao->autocommit(TRUE);
   }
   
   function getRecordset($sql){
      return $this->conexao->query($sql);
   }

   function execSql($sql){
       return $this->getRecordset($sql);
   }
   
    function getRecordsetArray($RS){
      return $RS->fetch_array(MYSQLI_BOTH);
   }

   function getQtdRegistros($RS){
      return $RS->num_rows;
   }

   function getExisteRecordset($RS){
      if( $this->getQtdRegistros($RS) >= 1)
	      return true;
	  else
	      return false;
   }
   
   function movefirst($RS){
       $RS->data_seek(0);
   }

   function moveto($RS,$qtd){
       $RS->data_seek($qtd);
   }

   function beginTrans(){
   		$this->conexao->autocommit(FALSE);

   }

    function commit(){
            $this->conexao->commit();
            $this->conexao->autocommit(TRUE);
    }

    function rollback(){
            $this->conexao->rollback();
            $this->conexao->autocommit(TRUE);
    }

    // Metodo que retorna o ultimo id de um insercao
    function id(){
        return $this->conexao->insert_id();
    }

    // Metodo fechar conexao
    function fechar(){
        return $this->conexao->close();
    }
	
	function anti_sql_injection($string){
        $string = get_magic_quotes_gpc() ? stripslashes($string) : $string;
        $string = $this->conexao->real_escape_string($string);
        return $string;
    }
   
}
?>
