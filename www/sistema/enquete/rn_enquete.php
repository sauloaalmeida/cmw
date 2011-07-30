<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_enquete.php';

if( !isset($_POST["enqCatFk"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro enqCatFk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

$enqCatFk = $_POST["enqCatFk"];

if( !isset($_POST["l_str_acao"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_str_acao nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

//cptura a acao da pagina
$l_str_acao =  $_POST["l_str_acao"];

//instancia o objeto de enquetes
$l_obj_enquete = new Enquete();	 

$l_obj_enquete->dbconn->conectar();

//decide o que fazaer de acordo com a acao
if ($l_str_acao == K_EXCLUIR){

    if( !isset($_POST["enqEnqPk"]) )
          msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro enqEnqPk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    $l_obj_enquete->enqEnqPk = $_POST["enqEnqPk"];
	
	//exclui os registros de enquetes e de imagens do banco
	if($l_obj_enquete->excluir()){
  	     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_enquete.php?enq_cat_pk=".$enqCatFk."&l_str_msg=".urlencode("Enquete excluida com sucesso!")."'</script>";
	}else	 
	    msg(K_MSGERRO, K_VOLTAR, "Erro na exclusao", "Erro na exclusao da enquete.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

}elseif($l_str_acao == K_ALTERAR || $l_str_acao == K_INCLUIR){

    if($l_str_acao == K_ALTERAR)
  	     if( !isset($_POST["enqEnqPk"]) )
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro enqEnqPk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["enqEnqPergunta"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro enqEnqPergunta foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["enqEnqDuracaoVoto"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro enqEnqDuracaoVoto foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["enqEnqTipoResposta"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro enqEnqTipoResposta foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_dia_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_dia_inicio nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_mes_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_mes_inicio nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_ano_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_ano_inicio nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_hora_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_hora_inicio nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_min_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_min_inicio nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_dia_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_dia_fim nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_mes_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_mes_fim nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_ano_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_ano_fim nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_hora_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_hora_fim nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_min_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_min_fim nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
	//UFA!!! se validou isso tudo, trata algumas variaveis
    if( !isset($_POST["enqEnqResultadoPorcentagem"]) )
        $enqEnqResultadoPorcentagem = K_INATIVO;
	else
  	    $enqEnqResultadoPorcentagem = K_ATIVO;

    if( !isset($_POST["enqEnqResultadoAbsoluto"]) )
        $enqEnqResultadoAbsoluto = K_INATIVO;
	else
  	    $enqEnqResultadoAbsoluto = K_ATIVO;

    if( !isset($_POST["enqEnqTipoResposta"]) )
        $enqEnqTipoResposta = K_ENQUETE_RESP_UNICA;
	else
  	    $enqEnqTipoResposta = $_POST["enqEnqTipoResposta"];
			
	$enqEnqDtCriacao = date("Y-m-d H:i:s", time());
	$enqEnqDtInicio = date("Y-m-d H:i:s", mktime ($_POST["l_int_hora_inicio"],$_POST["l_int_min_inicio"],0,$_POST["l_int_mes_inicio"],$_POST["l_int_dia_inicio"],$_POST["l_int_ano_inicio"]));
	$enqEnqDtFim = date("Y-m-d H:i:s", mktime ($_POST["l_int_hora_fim"],$_POST["l_int_min_fim"],0,$_POST["l_int_mes_fim"],$_POST["l_int_dia_fim"],$_POST["l_int_ano_fim"]));
	
	
	//preenche os atributos	
    $l_obj_enquete->enqEnqPergunta = $_POST["enqEnqPergunta"];
    $l_obj_enquete->enqEnqDuracaoVoto = $_POST["enqEnqDuracaoVoto"];
    $l_obj_enquete->enqEnqTipoResposta = $enqEnqTipoResposta;
    $l_obj_enquete->enqEnqResultadoPorcentagem = $enqEnqResultadoPorcentagem;
    $l_obj_enquete->enqEnqResultadoAbsoluto = $enqEnqResultadoAbsoluto;
    $l_obj_enquete->enqEnqDtCriacao = $enqEnqDtCriacao;
    $l_obj_enquete->enqEnqDtInicio = $enqEnqDtInicio;
    $l_obj_enquete->enqEnqDtFim = $enqEnqDtFim;
    $l_obj_enquete->enqCatFk = $enqCatFk;
    $l_obj_enquete->admUsrFk = $l_obj_seguranca->Get_adm_usr_pk();


    if($l_str_acao == K_INCLUIR)
		if($l_obj_enquete->incluir())
  		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_enquete.php?enq_cat_pk=".$enqCatFk."&l_str_msg=".urlencode("Enquete incluida com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na inclusao", "Erro na inclusao da enquete.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if($l_str_acao == K_ALTERAR){	
	    $l_obj_enquete->enqEnqPk = $_POST["enqEnqPk"];
		if($l_obj_enquete->alterar())
   		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_enquete.php?enq_cat_pk=".$enqCatFk."&l_str_msg=".urlencode("Enquete alterada com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na alteracao", "Erro na alteracao da enquete.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	}

}else    
   msg(K_MSGERRO, K_VOLTAR, "Acao invalida", "A acao postado para a pagina eh invalida.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	 
?>