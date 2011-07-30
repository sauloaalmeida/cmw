<?
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_usuario.php';

$l_obj_usuario = new AdmUsuario();

$l_str_acao = $_REQUEST["l_str_acao"];
$l_obj_usuario->adm_usr_pk = $_REQUEST["l_str_pk"];

if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){
		$l_obj_usuario->adm_usr_nome = $_REQUEST["cad_user_nome"];
		$l_obj_usuario->adm_usr_email = $_REQUEST["cad_user_email"];
		$l_obj_usuario->adm_usr_nivel = $_REQUEST["cad_user_nivel"];
		$l_obj_usuario->adm_usr_status = $_REQUEST["cad_user_status"];
		$l_obj_usuario->adm_usr_login = $_REQUEST["cad_user_login"];
		
		//se a senha tiver sido trocada envia para ser alterada no banco
		if ($_REQUEST["cad_user_senha"] != $_REQUEST["l_str_senha_original"])
			$l_obj_usuario->adm_usr_senha = $_REQUEST["cad_user_senha"];
	}
$l_obj_usuario->dbconn->conectar();

if($l_str_acao == K_INCLUIR){

	if ($l_obj_usuario->incluir())
		 echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_usuario.php?l_str_msg=".urlencode("Usuário incluido com sucesso!")."'</script>";
	else
		 msg(K_MSGERRO, K_VOLTAR, "Erro na inclusão", "Erro na inclusão do Usuario.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
}

if($l_str_acao == K_ALTERAR){
	
	if ($l_obj_usuario->alterar())
		 echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_usuario.php?l_str_msg=".urlencode("Usuário alterado com sucesso!")."'</script>";
	else
		 msg(K_MSGERRO, K_VOLTAR, "Erro na alteração", "Erro na alteração dos dados do Usuario.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
}

if($l_str_acao == K_EXCLUIR){

	if($l_obj_usuario->existeRegistroAssociado())
		msg(K_MSGAVISO, K_VOLTAR, "Não é possivel remover esse registro", "Não é possivel remover esse usuário pois existem notícias associadas a ela.<br>Para remover esse registro remova primeiramente as noticias associadas a esse usuario");

	if ($l_obj_usuario->excluir())
		 echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_usuario.php?l_str_msg=".urlencode("Usuário excluído com sucesso!")."'</script>";
	else
		 msg(K_MSGERRO, K_VOLTAR, "Erro na exclusão", "Erro na exclusão dos dados do Usuario.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
}
$l_obj_usuario->dbconn->fechar();


?>