<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_noticia.php';
include 'cl_imagem.php';
include 'cl_anexo.php';


if( !isset($_POST["news_cat_fk"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par�metro news_cat_fk n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");		

$news_cat_fk = $_POST["news_cat_fk"];

if( !isset($_POST["l_str_acao"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par�metro l_str_acao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

//cptura a acao da pagina
$l_str_acao =  $_POST["l_str_acao"];

//instancia o objeto de noticias	 
$l_obj_noticia = new Noticia();	 

$l_obj_noticia->dbconn->conectar();	 

//decide o que fazaer de acordo com a acao
if ($l_str_acao == K_EXCLUIR){

    if( !isset($_POST["news_not_pk"]) )
          msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par�metro news_not_pk n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    $l_obj_noticia->news_not_pk = $_POST["news_not_pk"];

    //se prepara para excluir as imagens do diretorio caso existam
	$l_obj_imagem =  new Imagem();
	
	$l_obj_imagem->dbconn->conectar();
	
	$RSimagens = $l_obj_imagem->GetImagens($_POST["news_not_pk"]);
	
	while ( $RStemp = $l_obj_imagem->dbconn->getRecordsetArray($RSimagens) ) {

	     if (strlen($RStemp['news_img_path1'])>0)
	              func_exclui_arq(K_UPLOADDIR_FIS_IMG_NOT . $RStemp['news_img_path1']);
	
	     if (strlen($RStemp['news_img_path2'])>0)
	              func_exclui_arq(K_UPLOADDIR_FIS_IMG_NOT . $RStemp['news_img_path2']);
	
	}
	
	//fecha a conexao com imagens
	$l_obj_imagem->dbconn->fechar();
	
	
	
    //se prepara para excluir os anexos do diretorio caso existam
	$l_obj_anexo =  new Anexo();
	
	$l_obj_anexo->dbconn->conectar();
	
	$RSanexos = $l_obj_anexo->getAnexos($_POST["news_not_pk"]);
	
	while ( $RStemp = $l_obj_anexo->dbconn->getRecordsetArray($RSanexos) ) {

	     if (strlen($RStemp['news_anx_path'])>0)
	              func_exclui_arq(K_UPLOADDIR_FIS_ANX_NOT . $RStemp['news_anx_path']);
	
	}
	
	//fecha a conexao com imagens
	$l_obj_anexo->dbconn->fechar();	
	
	
	//exclui os registros de noticias e de imagens do banco
	if($l_obj_noticia->excluir()){
  	     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_noticia.php?news_cat_pk=".$news_cat_fk."&l_str_msg=".urlencode("Noticia excluida com sucesso!")."'</script>";
	}else	 
	    msg(K_MSGERRO, K_VOLTAR, "Erro na exclusao", "Erro na exclusao da not�cia.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

}elseif($l_str_acao == K_ALTERAR || $l_str_acao == K_INCLUIR){

    if($l_str_acao == K_ALTERAR)
  	     if( !isset($_POST["news_not_pk"]) )
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro news_not_pk n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["news_not_titulo"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro news_not_titulo foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["news_not_corpo"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro news_not_corpo n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["news_not_origem"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro news_not_origem n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["news_not_autor"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro news_not_autor n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_dia_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_dia_inicio n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_mes_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_mes_inicio n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_ano_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_ano_inicio n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_hora_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_hora_inicio n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_min_inicio"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_min_inicio n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_dia_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_dia_fim n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_mes_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_mes_fim n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_ano_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_ano_fim n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if( !isset($_POST["l_int_hora_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_hora_fim n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_min_fim"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_min_fim n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
	//UFA!!! se validou isso tudo, trata algumas variaveis
		
    if( !isset($_POST["news_not_destaque"]) )
        $news_not_destaque = K_INATIVO;
	else		
  	    $news_not_destaque = K_ATIVO;
		
    if(!isset($_POST["news_not_chamada"]) )
        $news_not_chamada = "";
	else		
  	    $news_not_chamada = $_POST["news_not_chamada"];
		
    if(!isset($_POST["news_not_link"]) )
        $news_not_link = "";
	else		
  	    $news_not_link = $_POST["news_not_link"];		
	
	$news_not_dt_criacao = date("Y-m-d H:i:s", time());
	$news_not_dt_inicio = date("Y-m-d H:i:s", mktime ($_POST["l_int_hora_inicio"],$_POST["l_int_min_inicio"],0,$_POST["l_int_mes_inicio"],$_POST["l_int_dia_inicio"],$_POST["l_int_ano_inicio"]));	
	$news_not_dt_fim = date("Y-m-d H:i:s", mktime ($_POST["l_int_hora_fim"],$_POST["l_int_min_fim"],0,$_POST["l_int_mes_fim"],$_POST["l_int_dia_fim"],$_POST["l_int_ano_fim"]));		
	
	
	//preenche os atributos	
    $l_obj_noticia->news_not_titulo = $_POST["news_not_titulo"];
    $l_obj_noticia->news_not_chamada = $news_not_chamada;
    $l_obj_noticia->news_not_destaque = $news_not_destaque;				
    $l_obj_noticia->news_not_corpo = stripslashes($_POST["news_not_corpo"]);
    $l_obj_noticia->news_not_link = $news_not_link;
    $l_obj_noticia->news_not_target = $_POST["news_not_target"];			
    $l_obj_noticia->news_not_origem = $_POST["news_not_origem"];
    $l_obj_noticia->news_not_autor = $_POST["news_not_autor"];
    $l_obj_noticia->news_not_dt_criacao = $news_not_dt_criacao;
    $l_obj_noticia->news_not_dt_inicio = $news_not_dt_inicio;
    $l_obj_noticia->news_not_dt_fim = $news_not_dt_fim;
    $l_obj_noticia->news_cat_fk = $news_cat_fk;
    $l_obj_noticia->adm_usr_fk = $l_obj_seguranca->Get_adm_usr_pk();
    $l_obj_noticia->idi_idioma_fk = $_POST["idi_idioma_fk"];
    $l_obj_noticia->news_not_status = $_POST["news_not_status"];

    if($l_str_acao == K_INCLUIR)
		if($l_obj_noticia->incluir())		
  		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_noticia.php?news_cat_pk=".$news_cat_fk."&l_str_msg=".urlencode("Noticia incluida com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na inclusao", "Erro na inclusao da noticia.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if($l_str_acao == K_ALTERAR){	
	    $l_obj_noticia->news_not_pk = $_POST["news_not_pk"];
		if($l_obj_noticia->alterar())		
   		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_noticia.php?news_cat_pk=".$news_cat_fk."&l_str_msg=".urlencode("Noticia alterada com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na alteracao", "Erro na alteracao da not�cia.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	}

}else    
   msg(K_MSGERRO, K_VOLTAR, "A��o inv�lida", "A acao postado para a pagina eh invalida.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	 
?>