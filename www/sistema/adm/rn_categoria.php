<?
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_categoria.php';

$l_obj_categoria = new Categoria();

$l_str_acao = $_REQUEST["l_str_acao"];
$l_obj_categoria->news_cat_pk = $_REQUEST["l_str_pk"];

if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){
		$l_obj_categoria->news_cat_nome = $_REQUEST["cad_cat_nome"];
		$l_obj_categoria->news_cat_descricao = $_REQUEST["cad_cat_descricao"];
	}
	
$l_obj_categoria->dbconn->conectar();

if($l_str_acao == K_INCLUIR){

	if ($l_obj_categoria->incluir())
		 echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_categoria.php?l_str_msg=".urlencode("Categoria incluida com sucesso!")."'</script>";
	else
		 msg(K_MSGERRO, K_VOLTAR, "Erro na inclus�o", "Erro na inclus�o da Categoria.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
}

if($l_str_acao == K_ALTERAR){
	
	if ($l_obj_categoria->alterar())
		 echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_categoria.php?l_str_msg=".urlencode("Categoria alterada com sucesso!")."'</script>";
	else
		 msg(K_MSGERRO, K_VOLTAR, "Erro na altera��o", "Erro na altera��o dos dados da Categoria.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
}

if($l_str_acao == K_EXCLUIR){

	if($l_obj_categoria->existeNoticiaAssociada())
		msg(K_MSGAVISO, K_VOLTAR, "N�o � possivel remover esse registro", "N�o � possivel remover essa categoria pois existem not�cias associadas a ela.<br>Para remover esse registro remova primeiramente as noticias associadas a essa categoria");

	if ($l_obj_categoria->excluir())
		 echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_categoria.php?l_str_msg=".urlencode("Categoria exclu�da com sucesso!")."'</script>";
	else
		 msg(K_MSGERRO, K_VOLTAR, "Erro na exclus�o", "Erro na exclus�o dos dados do Usuario.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
}
$l_obj_categoria->dbconn->fechar();


?>
