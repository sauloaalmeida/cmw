<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_aniversario.php';


if( !isset($_POST["l_str_acao"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_str_acao nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

//cptura a acao da pagina
$l_str_acao =  $_POST["l_str_acao"];
$l_mes_pesquisa =  (isset($_POST["l_mes_pesquisa"])?$_POST["l_mes_pesquisa"]:"");

//instancia o objeto de noticias	 
$l_obj_aniversario = new Aniversario();

$l_obj_aniversario->dbconn->conectar();

//decide o que fazaer de acordo com a acao
if ($l_str_acao == K_EXCLUIR){

    if( !isset($_POST["aniv_aniv_pk"]) )
          msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro aniv_aniv_pk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    $l_obj_aniversario->aniv_aniv_pk = $_POST["aniv_aniv_pk"];

    	
	//exclui os registros de noticias e de imagens do banco
	if($l_obj_aniversario->excluir()){
  	     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_aniversario.php?l_mes_pesquisa=".$l_mes_pesquisa."&l_str_msg=".urlencode("Anivers&aacute;rio excluido com sucesso!")."'</script>";
	}else	 
	    msg(K_MSGERRO, K_VOLTAR, "Erro na exclusao", "Erro na exclusao do anivers&aacute;rio.<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");

}elseif($l_str_acao == K_ALTERAR || $l_str_acao == K_INCLUIR){

    if($l_str_acao == K_ALTERAR)
  	     if( !isset($_POST["aniv_aniv_pk"]) )
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro aniv_aniv_pk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["aniv_aniv_nome"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro aniv_aniv_nome foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_dia"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_dia nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["l_int_mes"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_mes nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

	if( !isset($_POST["l_int_ano"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_int_ano nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
	//preenche os atributos	
    $l_obj_aniversario->aniv_aniv_nome = $_POST["aniv_aniv_nome"];
    $l_obj_aniversario->aniv_aniv_dt_nasc = date("Y-m-d", mktime (0,0,0,$_POST["l_int_mes"],$_POST["l_int_dia"],$_POST["l_int_ano"]));	
	
    //data ja eh prenchido no banco	

    if($l_str_acao == K_INCLUIR)
		if($l_obj_aniversario->incluir())
  		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_aniversario.php?l_mes_pesquisa=".$l_mes_pesquisa."&l_str_msg=".urlencode("Anivers&aacute;rio incluido com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na inclusao", "Erro na inclusao da anivers&aacute;rio.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if($l_str_acao == K_ALTERAR){	
	    $l_obj_aniversario->aniv_aniv_pk = $_POST["aniv_aniv_pk"];
		if($l_obj_aniversario->alterar())
   		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_aniversario.php?l_mes_pesquisa=".$l_mes_pesquisa."&l_str_msg=".urlencode("Anivers&aacute;rio incluido alterado com sucesso!")."'</script>";			
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na alteracao", "Erro na alteracao do anivers&aacute;rio.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	}

}else    
   msg(K_MSGERRO, K_VOLTAR, "Acao invalida", "A acao postada para a pagina a invalida.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	 
?>
