<?php 
include 'nucleo/incs/inc_cache.php';
include 'sistema/nucleo/incs/inc_constantes.php';
include 'nucleo/incs/inc_funcoes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_mailenvio.php';

if( !isset($_REQUEST["nwsl_env_pk"]) ){
	echo "O codigo do envio de email nao foi informado.";
	exit;
}
	
//instancia o objeto de noticias	 
$l_obj_mail = new MailEnvio();	 

$l_obj_mail->dbconn->conectar();

$l_obj_mail->getEnvio($_REQUEST["nwsl_env_pk"]);

              $corpo_email = implode ('', file (K_TEMPLATE_FIS_ENVIO_EMAIL_VISUALIZA));
              $corpo_email = str_replace("##ASSUNTO_EMAIL##", $l_obj_mail->nwsl_env_assunto, $corpo_email);
              $corpo_email = str_replace("##K_SITE_URL_COMPLETA##", K_SITE_URL_COMPLETA, $corpo_email);
              $corpo_email = str_replace("##K_SITE_URL##", K_SITE_URL, $corpo_email);
              $corpo_email = str_replace("##CORPO_EMAIL##", $l_obj_mail->nwsl_env_corpo, $corpo_email);
	      $corpo_email = str_replace("##ENDERECO_VISUALIZACAO##", K_SITE_URL_COMPLETA.K_ENVIO_EMAIL_VISUALIZACAO."?nwsl_env_pk=".$l_obj_mail->nwsl_env_pk, $corpo_email);
	      $corpo_email = str_replace("##ENDERECO_REMOCAO##", K_SITE_URL_COMPLETA.K_ENVIO_EMAIL_REMOCAO."?email=".$RStemp["nwsl_usr_email"], $corpo_email);

              if(trim($l_obj_mail->nwsl_env_path)!=""){
                   $corpo_email = str_replace("##PATH_IMAGEM##", "<img src='".K_SITE_URL_COMPLETA.K_UPLOADDIR_EXIB_IMG_MAIL.$l_obj_mail->nwsl_env_path."' />", $corpo_email);
              }else{
                  $corpo_email = str_replace("##PATH_IMAGEM##", "", $corpo_email);
              }


echo $corpo_email;

 $l_obj_mail->dbconn->fechar();?>
