<?php
class Seguranca {

    var $dbconn;
	
	function Seguranca(){
	    $this->dbconn = new Dbconn;
	}


    function CriaCookie($adm_usr_pk,$login,$adm_usr_nome,$adm_usr_nivel){
	
	//pega a hora atual
	$agora = time();
	
			// Cria as sessions, e o cookie expira na hora atial + 60s * 60m * 24h (ou seja amanha)
			setcookie("skydive[adm_usr_pk]",$adm_usr_pk,$agora+(60*60*24),"/") ;
			setcookie("skydive[adm_usr_login]",$login,$agora+(60*60*24),"/");
			setcookie("skydive[adm_usr_nome]",$adm_usr_nome,$agora+(60*60*24),"/");
			setcookie("skydive[adm_usr_nivel]",$adm_usr_nivel,$agora+(60*60*24),"/");
			setcookie("skydive[hora_session]",$agora,$agora+(60*60*24),"/");
	}
	
	
	function ChecaUsuario($login,$senha){
	
		//cria a conexao com o banco
		$this->dbconn->conectar();
		
		$l_str_sql = " select adm_usr_pk, ";
		$l_str_sql.= "        adm_usr_nome, ";
		$l_str_sql.= "        adm_usr_nivel ";
		$l_str_sql.= " from adm_usuario "; 
    	$l_str_sql.= " where adm_usr_login = '".$this->dbconn->anti_sql_injection($login)."' ";
   	$l_str_sql.= "   and adm_usr_senha = password('".$this->dbconn->anti_sql_injection($senha)."') ";
   	$l_str_sql.= "   and adm_usr_status = '".K_ATIVO."' ";	   		

		//executa o sql
		$RSTemp = $this->dbconn->getRecordset($l_str_sql);
		
		if ($this->dbconn->getExisteRecordset($RSTemp)){
		
		    //pega os valores no banco
			$RSusuario = $this->dbconn->getRecordsetArray($RSTemp);		
		
			//cria o cookie
			$this->CriaCookie($RSusuario["adm_usr_pk"],$login,$RSusuario["adm_usr_nome"],$RSusuario["adm_usr_nivel"]);
			
			//fecha conexao com o banco
			$this->dbconn->fechar();
			
  			//retorna verdadeiro
			return true;
		}

   			//senao retorna falso
			return false;
	}
	
	
	function ExpiraCookie(){
		if(!isset($_COOKIE["skydive"]))
		   setcookie("skydive","",time()-(60*60*24),"/") ;
	}
	
	function VerificaUsuario(){
		//verifica se existem todos os cookies
		if(!isset($_COOKIE["skydive"]))
		   return false;
		   
		//verifica se a hora ainda esta valendo
	    if (date("i" ,time() - $this->get_hora_session())  > K_TEMPO)
			return false;

		//se nao entrou em nenhum erro retorna true
		return true;
	}	
	
	
	function Get_adm_usr_pk(){
		return $_COOKIE["skydive"]["adm_usr_pk"];
	}

	function Get_adm_usr_login(){
		return $_COOKIE["skydive"]["adm_usr_login"];
	}
		
	function Get_adm_usr_nome(){
		return $_COOKIE["skydive"]["adm_usr_nome"];
	}
	
	function Get_adm_usr_nivel(){
		return $_COOKIE["skydive"]["adm_usr_nivel"];
	}
	
	function Get_hora_session(){
		return $_COOKIE["skydive"]["hora_session"];
	}				


	function Get_isAdm(){
		if ($this->Get_adm_usr_nivel()=="A")
		    return true;
		else
		    return false;
	}

	
	function AtualizaUsuario(){
   		$this->CriaCookie($this->Get_adm_usr_pk(),$this->Get_adm_usr_login(),$this->Get_adm_usr_nome(),$this->Get_adm_usr_nivel());	
	}		
	

}
?>
