<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_menulink.php';


if( !isset($_POST["l_str_acao"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_str_acao n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

//cptura a acao da pagina
$l_str_acao =  $_POST["l_str_acao"];

//instancia o objeto de noticias	 
$l_obj_menu = new MenuLink();

$l_obj_menu->dbconn->conectar();

//decide o que fazaer de acordo com a acao
if ($l_str_acao == K_EXCLUIR){

    if( !isset($_POST["menu_link_pk"]) )
          msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro menu_link_pk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    $l_obj_menu->menu_link_pk = $_POST["menu_link_pk"];

    	
	//exclui o registro
	if($l_obj_menu->excluir()){
  	     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_menu.php?menu_link_pk=".((isset($_REQUEST["menu_link_pai_fk"]))?$_REQUEST["menu_link_pai_fk"]:K_RAIZ_MENU)."&l_str_msg=".urlencode("Menu excluido com sucesso!")."'</script>";
	}else	 
	    msg(K_MSGERRO, K_VOLTAR, "Erro na exclusao", "Erro na exclusao do menu.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

}elseif($l_str_acao == K_ALTERAR || $l_str_acao == K_INCLUIR){

    if($l_str_acao == K_ALTERAR)
  	     if( !isset($_POST["menu_link_pk"]) )
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro menu_link_pk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["menu_link_nome"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro menu_link_nome foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["menu_link_ordem"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro menu_link_email nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
        
    //preenche os atributos
    $l_obj_menu->menu_link_nome = $_POST["menu_link_nome"];
    $l_obj_menu->menu_link_url = (isset($_POST["menu_link_url"]) && trim($_POST["menu_link_url"])!="")?trim($_POST["menu_link_url"]):NULL;
    $l_obj_menu->menu_link_target = (isset($_POST["menu_link_target"]) && trim($_POST["menu_link_target"])!="")?trim($_POST["menu_link_target"]):NULL;
    $l_obj_menu->menu_link_ordem = $_POST["menu_link_ordem"];
    $l_obj_menu->menu_link_descricao = (isset($_POST["menu_link_descricao"]) && trim($_POST["menu_link_descricao"])!="")?trim($_POST["menu_link_descricao"]):NULL;
    $l_obj_menu->menu_link_pai_fk = $_REQUEST["menu_link_pai_fk"];

    //setado para null enquanto nou houver upload de imagem
    $l_obj_menu->menu_link_path = NULL;

    //data ja eh prenchido no banco

    if($l_str_acao == K_INCLUIR)
		if($l_obj_menu->incluir())
  		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_menu.php?menu_link_pk=".$l_obj_menu->menu_link_pai_fk."&l_str_msg=".urlencode("Menu incluido com sucesso!")."'</script>";
		else
                    msg(K_MSGERRO, K_VOLTAR, "Erro na inclusao", "Ocorreu um erro na inclusao do menu.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if($l_str_acao == K_ALTERAR){	
	    $l_obj_menu->menu_link_pk = $_REQUEST["menu_link_pk"];
		if($l_obj_menu->alterar())
   		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_menu.php?menu_link_pk=".$l_obj_menu->menu_link_pai_fk."&l_str_msg=".urlencode("Menu alterado com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na alteracao", "Ocorreu um erro na alteracao do menu.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	}

}else    
   msg(K_MSGERRO, K_VOLTAR, "Acao invalida", "A acao postada para a pagina a invalida.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	 
?>
