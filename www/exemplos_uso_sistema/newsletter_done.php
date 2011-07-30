<?php 
include 'nucleo/incs/inc_cache.php';
include 'nucleo/incs/inc_constantes.php';
include 'nucleo/incs/inc_funcoes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_mailusuario.php';

$msg = "Problemas ao cadastrar o email.";

if(!isset($_REQUEST["email"]) || !isset($_REQUEST["nome"]) ||  $_REQUEST["email"] == "" || $_REQUEST["nome"] ==""){
   $msg = "O campo nome ou email n&atilde;o foi(ram) informado(s)!";
}
else{
   $l_obj_mail = new MailUsuario();
   $l_obj_mail->dbconn->conectar();
   $l_obj_mail->nwsl_usr_nome = $_REQUEST["nome"];
   $l_obj_mail->nwsl_usr_email = $_REQUEST["email"];
	
   //verifica se ja esta cadastrado
   if($l_obj_mail->getExisteUsuario($_REQUEST["email"])){
	$msg="<br/>E-mail j&aacute; esta cadastrado em nossa base de dados";
   }else{ //se nao estiver cadastra
	$l_obj_mail->incluir();
	$msg = "<br/>E-mail cadastrado com sucesso.<br><br>Remova o dom&iacute;nio 'crmvba.org.br' da lista de Spam do seu provedor de e-mail, caso possua este recurso.";
   }

$l_obj_mail->dbconn->fechar();   
   
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt_PT">
    <head><title>Fim de cadastro</title>
<script>
	function limpaCampos(){
		window.opener.document.getElementById('nome').value = '';
		window.opener.document.getElementById('email').value = '';
	}
</script>
</head>

<body onUnload="javascript:limpaCampos();" class="txt_newsletterdone" >

 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
        <?php echo $msg; ?>
	<br/>      <br/>
	<input name="Botao" type="button" class="btn2" id="Botao" value="fechar" onclick="window.close();" />
    </td></tr> </table>

</body>
</html>
