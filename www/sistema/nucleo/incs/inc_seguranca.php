<?php
//Instancia o objeto de seguranca
$l_obj_seguranca = new Seguranca;

//verifica se o usuario tem permissao de esta logado
if ($l_obj_seguranca->VerificaUsuario())
	$l_obj_seguranca->AtualizaUsuario();
else
	header('Location: ../index.php?l_str_msg='.urlencode("Sua sess�o expirou. Efetue o logon novamente!"));	
									
?>
                 