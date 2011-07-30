<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_mailusuario.php';


if( !isset($_POST["l_str_acao"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par�metro l_str_acao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

//cptura a acao da pagina
$l_str_acao =  $_POST["l_str_acao"];

//instancia o objeto de noticias	 
$l_obj_mail = new MailUsuario();	 

$l_obj_mail->dbconn->conectar();	 

//decide o que fazaer de acordo com a acao
if ($l_str_acao == K_EXCLUIR){

    if( !isset($_POST["nwsl_usr_pk"]) )
          msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par�metro nwsl_usr_pk n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    $l_obj_mail->nwsl_usr_pk = $_POST["nwsl_usr_pk"];

    	
	//exclui os registros de noticias e de imagens do banco
	if($l_obj_mail->excluir()){
  	     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_cadastro.php?l_str_msg=".urlencode("E-mail excluido com sucesso!")."'</script>";	
	}else	 
	    msg(K_MSGERRO, K_VOLTAR, "Erro na exclus�o", "Erro na exclus�o do email.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

}elseif($l_str_acao == K_ALTERAR || $l_str_acao == K_INCLUIR){

    if($l_str_acao == K_ALTERAR)
  	     if( !isset($_POST["nwsl_usr_pk"]) )
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par�metro nwsl_usr_pk n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");   
		
    if( !isset($_POST["nwsl_usr_nome"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro nwsl_usr_nome foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["nwsl_usr_email"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro nwsl_usr_email nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
	//preenche os atributos	
    $l_obj_mail->nwsl_usr_nome = $_POST["nwsl_usr_nome"];
    $l_obj_mail->nwsl_usr_email = $_POST["nwsl_usr_email"];				
    //data ja eh prenchido no banco	

    if($l_str_acao == K_INCLUIR)
		if($l_obj_mail->incluir())		
  		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_cadastro.php?l_str_msg=".urlencode("E-mail incluido com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na inclusao", "Erro na inclusao da email.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if($l_str_acao == K_ALTERAR){	
	    $l_obj_mail->nwsl_usr_pk = $_POST["nwsl_usr_pk"];
		if($l_obj_mail->alterar())		
   		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_cadastro.php?l_str_msg=".urlencode("E-mail incluido alterado com sucesso!")."'</script>";			
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na alteracao", "Erro na alteracao do email.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	}

}else    
   msg(K_MSGERRO, K_VOLTAR, "Acao invalida", "A acao postada para a pagina a invalida.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	 
?>
