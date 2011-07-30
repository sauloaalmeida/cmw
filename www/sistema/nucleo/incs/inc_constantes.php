<?php
//======================================================
//           Configuracoes do sistema
//======================================================

//tempo maximo de permanencia dentro do sistema em minutos
define("K_TEMPO",160);


//======================================================
//           Nomes do sistema do sistema
//======================================================
//tempo maximo de permanencia dentro do sistema em minutos
define("K_TITULO_SISTEMA",":: CRMVBA - Conselho Regional de Medicina Veterin&aacute;ria da Bahia");
define("K_TITULO_TOPO","CRMVBA - Conselho Regional de Medicina Veterin&aacute;ria da Bahia");
define("K_NOME_ORGANIZACAO","CRMVBA");
define("K_SITE_URL","www.crmvba.org.br");
define("K_SITE_URL_COMPLETA","http://".K_SITE_URL);
//======================================================
//   Flags que sao utilizadas por todo o sistema
//======================================================

define("K_ATIVO","A");
define("K_INATIVO","I");
define("K_RASCUNHO","R");

define("K_ENQUETE_RESP_MULTIPLA","M");
define("K_ENQUETE_RESP_UNICA","U");

define("K_SIM","SIM");
define("K_NAO","NAO");

define("K_EVENTO_INTERNO","I");
define("K_EVENTO_EXTERNO","E");

//constantes da janela de mensagem
define("K_MSGAVISO","AVISO");
define("K_MSGERRO","ERRO");
define("K_FECHAR","FECHAR");
define("K_VOLTAR","VOLTAR");

//constantes de acao das paginas
define("K_INCLUIR","Incluir");
define("K_EXCLUIR","Excluir");
define("K_ALTERAR","Alterar");
define("K_CONSULTAR","Consultar");
define("K_ENVIAR","Enviar");
define("K_SELECIONAR","Selecionar");

define("K_RAIZ_MENU",1);

//separador utilizado sempre com funcoes split ou similares
define("K_SEPARADOR","#*#");

define("K_UPLOADDIR_FIS","D:\\VLSWeb\\Clientes\\crmvba.org.br\\www\\uploads\\");

//constantes do uploads das imagens de noticia
define("K_UPLOADDIR_FIS_FCKEDITOR",K_UPLOADDIR_FIS."fckeditor\\");


//endereco virtual para exibicao das imagens da noticia
define("K_UPLOADDIR_EXIB_FCKEDITOR",K_SITE_URL_COMPLETA."/uploads/fckeditor/");


//endereco fisico da gravacao das imagens de noticia
define("K_UPLOADDIR_FIS_IMG_NOT",K_UPLOADDIR_FIS."uploads\\news\\imgs\\");
//define("K_UPLOADDIR_FIS_IMG_NOT","D:\\Documents and Settings\\up23\\Meus documentos\\freela\\php\\cmw\\www\\uploads\\news\\imagens\\");
//define("K_UPLOADDIR_FIS_IMG_NOT","D:\\workspace\\php\\aduneb\\www\\uploads\\news\\imagens\\");



//endereco virtual para exibicao das imagens da noticia
define("K_UPLOADDIR_EXIB_IMG_NOT","/uploads/news/imgs/");


//constantes do uploads dos anexos de noticia
//endereco fisico da gravacao dos anexos de noticia
define("K_UPLOADDIR_FIS_ANX_NOT",K_UPLOADDIR_FIS."news\\anexos\\");
//define("K_UPLOADDIR_FIS_ANX_NOT","D:\\Documents and Settings\\up23\\Meus documentos\\freela\\php\\cmw\\www\\uploads\\news\\anexos\\");
//define("K_UPLOADDIR_FIS_ANX_NOT","D:\\workspace\\php\\aduneb\\www\\uploads\\news\\anexos\\");

//endereco virtual para exibicao dos anexos da noticia
define("K_UPLOADDIR_EXIB_ANX_NOT","/uploads/news/anexos/");

define("K_UPLOADDIR_FIS_IMG_MAIL",K_UPLOADDIR_FIS."mail\\imgs\\");
//define("K_UPLOADDIR_FIS_IMG_MAIL","D:\\Documents and Settings\\up23\\Meus documentos\\freela\\php\\cmw\\www\\uploads\\mail\\imgs\\");
//define("K_UPLOADDIR_FIS_IMG_MAIL","D:\\workspace\\php\\aduneb\\www\\uploads\\mail\\imgs\\");


define("K_UPLOADDIR_FIS_IMG_EVEN",K_UPLOADDIR_FIS."eventos\\imgs\\");
define("K_UPLOADDIR_EXIB_IMG_EVEN","/uploads/eventos/imgs/");
define("K_UPLOADDIR_FIS_ANX_EVEN",K_UPLOADDIR_FIS."eventos\\anexos\\");
define("K_UPLOADDIR_EXIB_ANX_EVEN","/uploads/eventos/anexos/");

//endereco virtual para exibicao das imagens dos emais
define("K_UPLOADDIR_EXIB_IMG_MAIL","/uploads/mail/imgs/");

//endereco fisico para Template do envio de email
//define("K_TEMPLATE_FIS_ENVIO_EMAIL","/home/httpd/vhosts/aduneb.com.br/httpdocs/nucleo/templates/envio_email.html");
//define("K_TEMPLATE_FIS_ENVIO_EMAIL","D:/Documents and Settings/up23/Meus documentos/freela/workspace/php/aduneb/www/nucleo/templates/envio_email.html");
//define("K_TEMPLATE_FIS_ENVIO_EMAIL_VISUALIZA","/home/httpd/vhosts/aduneb.com.br/httpdocs/nucleo/templates/envio_email_vizualiza.html");
//define("K_TEMPLATE_FIS_ENVIO_EMAIL_VISUALIZA","D:/Documents and Settings/up23/Meus documentos/freela/workspace/php/aduneb/www/nucleo/templates/envio_email_vizualiza.html");

//define("K_TEMPLATE_FIS_ENVIO_EMAIL","D:\\Documents and Settings\\up23\\Meus documentos\\freela\\php\\cmw\\www\\sistem\\nucleo\\templates\\envio_email.html");
//define("K_TEMPLATE_FIS_ENVIO_EMAIL","D:\\workspace\\php\\aduneb\\www\\sistem\\nucleo\\templates\\envio_email.html");

define("K_ENVIO_EMAIL_VISUALIZACAO","/email_visualizacao.php");
define("K_ENVIO_EMAIL_REMOCAO","/email_remocao_done.php");
define("K_NOME_FROM_ENVIO","CRMVBA - Conselho Regional de Medicina Veterin&aacute;ria da Bahia");
define("K_EMAIL_FROM_ENVIO","crmvba@crmvba.org.br");


?>
