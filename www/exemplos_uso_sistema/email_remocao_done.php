<?php 
include 'nucleo/incs/inc_cache.php';
include 'nucleo/incs/inc_constantes.php';
include 'nucleo/incs/inc_funcoes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_mailusuario.php';

$msg = "Problemas ao cadastrar o email.";

if(!isset($_REQUEST["email"]) || $_REQUEST["email"] ==""){
   $msg = "Campo email n&atilde;o foi informado!";
}
else{
   $l_obj_mail = new MailUsuario();
   $l_obj_mail->dbconn->conectar();
   $l_obj_mail->nwsl_usr_email = $_REQUEST["email"];
	
   //verifica se ja esta cadastrado
   if($l_obj_mail->getExisteUsuario($_REQUEST["email"])){
	$l_obj_mail->excluir($_REQUEST["email"]);
	$msg="<br/><br/>E-mail ".$_REQUEST["email"]." foi removido da nossa base de dados com sucesso";
   }else{ //se nao estiver cadastra
	$msg = "<br/><br/>O e-mail ".$_REQUEST["email"]." n&atilde;o esta cadastrado em nossa base de dados.";
   }

$l_obj_mail->dbconn->fechar();   
   
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt_PT">
    <head><title></title>
</head>

<body class="txt_newsletterdone" >

 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
        <?php echo $msg; ?>
	<br/>      <br/>
    </td>
  </tr> </table>

</body>
</html>