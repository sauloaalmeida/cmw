<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_evento.php';
include 'cl_imagem.php';
include 'cl_anexo.php';


if( !isset($_POST["l_str_acao"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de par&acirc;metros", "O par&acirc;metro l_str_acao n&tilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

//cptura a acao da pagina
$l_str_acao =  $_POST["l_str_acao"];

//instancia o objeto de noticias	 
$l_obj_evento = new Evento();

$l_obj_evento->dbconn->conectar();

//decide o que fazaer de acordo com a acao
if ($l_str_acao == K_EXCLUIR){

    if( !isset($_POST["even_even_pk"]) )
          msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro even_even_pk n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    $l_obj_evento->even_even_pk = $_POST["even_even_pk"];

    //se prepara para excluir as imagens do diretorio caso existam
	$l_obj_imagem =  new Imagem();
	
	$l_obj_imagem->dbconn->conectar();
	
	$RSimagens = $l_obj_imagem->GetImagens($_POST["even_even_pk"]);
	
	while ( $RStemp = $l_obj_imagem->dbconn->getRecordsetArray($RSimagens) ) {

	     if (strlen($RStemp['even_img_path1'])>0)
	              func_exclui_arq(K_UPLOADDIR_FIS_IMG_EVEN . $RStemp['even_img_path1']);
	
	     if (strlen($RStemp['even_img_path2'])>0)
	              func_exclui_arq(K_UPLOADDIR_FIS_IMG_EVEN . $RStemp['even_img_path2']);
	
	}
	
	//fecha a conexao com imagens
	$l_obj_imagem->dbconn->fechar();
	
	
	
    //se prepara para excluir os anexos do diretorio caso existam
	$l_obj_anexo =  new Anexo();
	
	$l_obj_anexo->dbconn->conectar();
	
	$RSanexos = $l_obj_anexo->getAnexos($_POST["even_even_pk"]);
	
	while ( $RStemp = $l_obj_anexo->dbconn->getRecordsetArray($RSanexos) ) {

	     if (strlen($RStemp['even_anx_path'])>0)
	              func_exclui_arq(K_UPLOADDIR_FIS_ANX_EVEN . $RStemp['even_anx_path']);
	
	}
	
	//fecha a conexao com imagens
	$l_obj_anexo->dbconn->fechar();	
	
	
	//exclui os registros de noticias e de imagens do banco
	if($l_obj_evento->excluir()){
  	     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_evento.php?l_str_msg=".urlencode("Evento excluido com sucesso!")."'</script>";
	}else	 
	    msg(K_MSGERRO, K_VOLTAR, "Erro na exclusao", "Erro na exclusao da not&iacute;cia.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

}elseif($l_str_acao == K_ALTERAR || $l_str_acao == K_INCLUIR){

    if($l_str_acao == K_ALTERAR)
  	     if( !isset($_POST["even_even_pk"]) )
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro even_even_pk n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["even_even_nome"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro even_even_nome foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["even_even_tipo"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro even_even_tipo foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["even_even_inscricao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro even_even_inscricao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["even_even_corpo"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro even_even_corpo n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_dia_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_dia_inicio n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_mes_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_mes_inicio n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_ano_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_ano_inicio n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_dia_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_dia_fim n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_mes_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_mes_fim n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_ano_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_ano_fim n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_dia_inicio_publicacao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_dia_inicio_publicacao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_mes_inicio_publicacao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_mes_inicio_publicacao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_ano_inicio_publicacao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_ano_inicio_publicacao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_hora_inicio_publicacao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_hora_inicio_publicacao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_min_inicio_publicacao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_min_inicio_publicacao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_dia_fim_publicacao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_dia_fim_publicacao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_mes_fim_publicacao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_mes_fim_publicacao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_ano_fim_publicacao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_ano_fim_publicacao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_hora_fim_publicacao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_hora_fim_publicacao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_min_fim_publicacao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_min_fim_publicacao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
	//UFA!!! se validou isso tudo, trata algumas variaveis
		
    if( !isset($_POST["even_even_destaque"]) )
        $even_even_destaque = K_INATIVO;
    else
       $even_even_destaque = K_ATIVO;
		
    if(!isset($_POST["even_even_chamada"]) )
        $even_even_chamada = "";
    else
        $even_even_chamada = $_POST["even_even_chamada"];
		
    if(!isset($_POST["even_even_link"]) )
        $even_even_link = NULL;
    else
        $even_even_link = $_POST["even_even_link"];
	
	$even_even_dt_inicio = date("Y-m-d", mktime (0,0,0,$_POST["l_int_mes_inicio"],$_POST["l_int_dia_inicio"],$_POST["l_int_ano_inicio"]));
	$even_even_dt_fim = date("Y-m-d", mktime (0,0,0,$_POST["l_int_mes_fim"],$_POST["l_int_dia_fim"],$_POST["l_int_ano_fim"]));
	$even_even_dt_inicio_publicacao = date("Y-m-d H:i:s", mktime ($_POST["l_int_hora_inicio_publicacao"],$_POST["l_int_min_inicio_publicacao"],0,$_POST["l_int_mes_inicio_publicacao"],$_POST["l_int_dia_inicio_publicacao"],$_POST["l_int_ano_inicio_publicacao"]));
	$even_even_dt_fim_publicacao = date("Y-m-d H:i:s", mktime ($_POST["l_int_hora_fim_publicacao"],$_POST["l_int_min_fim_publicacao"],0,$_POST["l_int_mes_fim_publicacao"],$_POST["l_int_dia_fim_publicacao"],$_POST["l_int_ano_fim_publicacao"]));

	//preenche os atributos	
    $l_obj_evento->even_even_nome = $_POST["even_even_nome"];
    $l_obj_evento->even_even_chamada = $even_even_chamada;
    $l_obj_evento->even_even_destaque = $even_even_destaque;
    $l_obj_evento->even_even_tipo = $_POST["even_even_tipo"];
    $l_obj_evento->even_even_inscricao = $_POST["even_even_inscricao"];
    $l_obj_evento->even_even_corpo = stripslashes($_POST["even_even_corpo"]);
    $l_obj_evento->even_even_link = $even_even_link;
    $l_obj_evento->even_even_dt_inicio = $even_even_dt_inicio;
    $l_obj_evento->even_even_dt_fim = $even_even_dt_fim;
    $l_obj_evento->even_even_dt_inicio_publicacao = $even_even_dt_inicio_publicacao;
    $l_obj_evento->even_even_dt_fim_publicacao = $even_even_dt_fim_publicacao;
    $l_obj_evento->even_even_status = $_POST["even_even_status"];

    if($l_str_acao == K_INCLUIR)
		if($l_obj_evento->incluir())
  		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_evento.php?l_str_msg=".urlencode("Evento incluidao com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na inclusao", "Erro na inclusao do evento.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if($l_str_acao == K_ALTERAR){	
	    $l_obj_evento->even_even_pk = $_POST["even_even_pk"];
		if($l_obj_evento->alterar())
   		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_evento.php?l_str_msg=".urlencode("Evento alterado com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na alteracao", "Erro na altera&ccedil;&atilde;o do evento.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	}

}else    
   msg(K_MSGERRO, K_VOLTAR, "A&ccedil;&atilde;o inv&aacute;lida", "A a&ccedil;&atilde;o postado para a p&aacute;gina eh invalida.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	 
?>