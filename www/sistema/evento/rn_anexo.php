<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_anexo.php';

//parametros importantes para o funcionamento da pagina

// a acao da pagina
if( !isset($_POST["l_str_acao"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro l_str_acao n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

$l_str_acao =  $_POST["l_str_acao"];

// o codigo da noticia da anexo
if( !isset($_POST["even_even_pk"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro even_even_fk n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

$even_even_pk = $_POST["even_even_pk"];


//instancia o objeto de anexo	 
$l_obj_anexo = new anexo();	 

$l_obj_anexo->dbconn->conectar();	 

//decide o que fazer de acordo com a acao
if ($l_str_acao == K_EXCLUIR){

    if( !isset($_POST["even_anx_pk"]) )
          msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro even_anx_pk n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");

    $l_obj_anexo->getAnexo($_POST["even_anx_pk"]);

	if($l_obj_anexo->excluir()){
	
	     //exclui as imagens do diretorio
		 func_exclui_arq(K_UPLOADDIR_FIS_ANX_EVEN . $l_obj_anexo->even_anx_path);
		 
		 //redireciona para tela de listagem de imagens		 
  	     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_anexo.php?even_even_pk=".$even_even_pk."&even_cat_pk=".$even_cat_fk."&l_str_msg=".urlencode("Anexo excluido com sucesso!")."'</script>";	
		 
	}else	 
	    msg(K_MSGERRO, K_VOLTAR, "Erro na exclus&atilde;o", "Erro na exclus&atilde;o da anexo.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

}elseif($l_str_acao == K_ALTERAR || $l_str_acao == K_INCLUIR){
    
	
	//testa os campos obrigatorios
    if($l_str_acao == K_ALTERAR){
	
  	     if( !isset($_POST["even_anx_pk"]) )
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro even_anx_pk n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

	     $l_obj_anexo->getAnexo($_POST["even_anx_pk"]);
	}
		 	 
		
    if( !isset($_POST["even_anx_titulo"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro even_anx_titulo foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["even_anx_descricao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro even_anx_descricao n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
	//verifica se os arquivos de acordo com a acao
	if ($l_str_acao == K_INCLUIR){
		if ( is_null($_FILES['even_anx_path']['tmp_name']) || $_FILES['even_anx_path']['tmp_name'] == "" ||  $_FILES['even_anx_path']['size'] == 0)
 		     msg(K_MSGERRO, K_VOLTAR, "Falta de par&acirc;metros", "O arquivo de anexo n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
			   
        $even_anx_path = func_str_completa_esquerda($even_even_pk,8,'0').date("_YmdHis_"). $_FILES['even_anx_path']['name'];
		move_uploaded_file($_FILES['even_anx_path']['tmp_name'], K_UPLOADDIR_FIS_ANX_EVEN . $even_anx_path);
		
		//muda a permissao para o leitura e escrita para o dono e leitura para os outros
		chmod (K_UPLOADDIR_FIS_ANX_EVEN . $even_anx_path, 0644);
	   
    }			   
	
	if ($l_str_acao == K_ALTERAR){
	
	    //verifica se o arquivo1 veio para pagina
        if ( strlen($_FILES['even_anx_path']['tmp_name']) == 0 || is_null($_FILES['even_anx_path']['tmp_name']) || $_FILES['even_anx_path']['tmp_name'] == "" ||  $_FILES['even_anx_path']['size'] == 0)
 		    $even_anx_path = $l_obj_anexo->even_anx_path;
		else{
		     //se veio deleta o que esta la 
			 func_exclui_arq(K_UPLOADDIR_FIS_ANX_EVEN . $l_obj_anexo->even_anx_path);
			 
			 //e inclui o que veio
			 $even_anx_path = func_str_completa_esquerda($even_even_pk,8,'0').date("_YmdHis_"). $_FILES['even_anx_path']['name'];
		     move_uploaded_file($_FILES['even_anx_path']['tmp_name'], K_UPLOADDIR_FIS_ANX_EVEN . $even_anx_path);
			 
	 		//muda a permissao para o leitura e escrita para o dono e leitura para os outros
			chmod (K_UPLOADDIR_FIS_ANX_EVEN . $even_anx_path, 0644);
		}
		   
			 
	}

    if( !isset($_POST["tipo_anx_fk"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de par&acirc;metros", "O par&acirc;metro tipo_anx_fk n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["even_anx_credito"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de par&acirc;metros", "O par&acirc;metro even_anx_credito n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
	//UFA!!! se validou isso tudo, trata algumas variaveis
	$even_anx_dt_cadastro = date("Y-m-d H:i:s", time());		
	list($tipo_anx_pk,$extensao) = split(K_SEPARADOR,$_POST["tipo_anx_fk"]);
	
	//preenche os atributos	
    $l_obj_anexo->even_anx_titulo = $_POST["even_anx_titulo"];
    $l_obj_anexo->even_anx_descricao = $_POST["even_anx_descricao"];
    $l_obj_anexo->even_anx_dt_cadastro = $even_anx_dt_cadastro;				
    $l_obj_anexo->even_anx_path = $even_anx_path;
    $l_obj_anexo->tipo_anx_fk = $tipo_anx_pk;	
    $l_obj_anexo->even_anx_credito = $_POST["even_anx_credito"];
    $l_obj_anexo->even_even_fk = $even_even_pk;

    if($l_str_acao == K_INCLUIR)
		if($l_obj_anexo->incluir())		
  		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_anexo.php?even_even_pk=".$even_even_pk."&l_str_msg=".urlencode("Anexo incluido com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na inclus&tilde;o", "Erro na inclus&atilde;o da anexo.<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");

    if($l_str_acao == K_ALTERAR){	
	    $l_obj_anexo->even_anx_pk = $_POST["even_anx_pk"];
		if($l_obj_anexo->alterar())		
   		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_anexo.php?even_even_pk=".$even_even_pk."&l_str_msg=".urlencode("Anexo alterado com sucesso!")."'</script>";			
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na altera&ccedil;atilde;o", "Erro na altera&ccedil;atilde;o da anexo.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	}

}else    
   msg(K_MSGERRO, K_VOLTAR, "A&ccedil;atilde;o inv&aacute;lida", "A a&ccedil;atilde;o postado para a p&aacute;gina &eacute; inv&aacute;lida.<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");


?>