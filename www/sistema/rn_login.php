<?php
//include de garantia do cache o cache dos browsers
include 'nucleo/incs/inc_cache.php';

//include que de constantes do sistema
include 'nucleo/incs/inc_constantes.php';

//testa se os parametros vieram
//se os parametros nao vieram, redireciona para pagina de login com mensagem de erro.
if (!isset($_POST['adm_usr_login']) || !isset($_POST['adm_usr_senha'])){
     header('Location: index.php?l_str_msg='.urlencode("Tentativa de entrada inválida no sistema!"));
}

//ja que continuamos aqui...
//inicializamos as variaveis
$l_str_login = trim($_POST['adm_usr_login']);
$l_str_senha = trim($_POST['adm_usr_senha']);

// colocaremos os includes para usar os objetos
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_seguranca.php';

//instancia o objeto de seguranca
$l_obj_seguranca = new Seguranca;

//confere o login e senha do usuario
//se aprovados inicializa o usuario e redireciona para pagina inicial
if ($l_obj_seguranca->ChecaUsuario($l_str_login,$l_str_senha)){
	   echo "<script language='JavaScript' type='text/javascript'> window.location = 'adm/ap_index.php'</script>";
}
else{ //se erro passa para pagina de login com mensagem de erro
	   echo "<script language='JavaScript' type='text/javascript'> window.location = 'index.php?l_str_msg=".urlencode("Usuário e/ou senha inválidos!")."'</script>";
	   }

?>
