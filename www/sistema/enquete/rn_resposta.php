<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_resposta.php';

if( !isset($_POST["enqCatFk"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro enqCatFk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

$enqCatFk = $_POST["enqCatFk"];

if( !isset($_POST["l_str_acao"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_str_acao nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
     
//cptura a acao da pagina
$l_str_acao =  $_POST["l_str_acao"];

if( !isset($_POST["enqEnqPk"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro enqEnqPk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

//cptura a acao da pagina
$enqEnqPk = $_POST["enqEnqPk"];


//instancia o objeto de enquetes
$l_obj_resposta = new Resposta();

$l_obj_resposta->dbconn->conectar();

//decide o que fazaer de acordo com a acao
if ($l_str_acao == K_EXCLUIR){

if( !isset($_POST["enqRespPk"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro enqRespPk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    $l_obj_resposta->enqRespPk = $_POST["enqRespPk"];
	
	//exclui os registros de enquetes e de imagens do banco
	if($l_obj_resposta->excluir()){
  	     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_resposta.php?enq_enq_pk=".$enqEnqPk."&enq_cat_pk=".$enqCatFk."&l_str_msg=".urlencode("Resposta excluida com sucesso!")."'</script>";
	}else	 
	    msg(K_MSGERRO, K_VOLTAR, "Erro na exclusao", "Erro na exclusao da enquete.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

}elseif($l_str_acao == K_ALTERAR || $l_str_acao == K_INCLUIR){

    if($l_str_acao == K_ALTERAR)
        if( !isset($_POST["enqRespPk"]) )
            msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro enqRespPk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["enqRespResposta"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro enqRespResposta foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");


	//preenche os atributos	
    $l_obj_resposta->enqRespResposta = $_POST["enqRespResposta"];
    $l_obj_resposta->enqEnqFk = $enqEnqPk;

    if($l_str_acao == K_INCLUIR)
		if($l_obj_resposta->incluir())
  		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_resposta.php?enq_enq_pk=".$enqEnqPk."&enq_cat_pk=".$enqCatFk."&l_str_msg=".urlencode("Resposta incluida com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na inclusao", "Erro na inclusao da resposta.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if($l_str_acao == K_ALTERAR){	
	       $l_obj_resposta->enqRespPk = $_POST["enqRespPk"];
		if($l_obj_resposta->alterar())
   		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_resposta.php?enq_enq_pk=".$enqEnqPk."&enq_cat_pk=".$enqCatFk."&l_str_msg=".urlencode("Resposta alterada com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na alteracao", "Erro na alteracao da resposta.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	}

}else    
   msg(K_MSGERRO, K_VOLTAR, "Acao invalida", "A acao postado para a pagina eh invalida.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	 
?>