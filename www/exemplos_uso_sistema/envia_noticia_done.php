<?php

include 'nucleo/incs/inc_constantes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_noticia.php';

//testas se as variaveis vieram
$mensagem = NULL;
$validacao = true;


if(!isset($_POST["url"]) && $validacao){
    $mensagem = "O link da not&iacute;cia n&atilde;o foi informado.";
    $validacao = false;
}

if(!isset($_POST["nomeRemetente"])  && $validacao){
    $mensagem = "O nome do remetente n&atilde;o foi informado.";
    $validacao = false;
}

if(!isset($_POST["emailRemetente"])  && $validacao){
    $mensagem = "O e-mail do remetente n&atilde;o foi informado.";
    $validacao = false;
}

if(!isset($_POST["nomeDestinatario"])  && $validacao){
    $mensagem = "O nome do destinat&aacute;rio n&atilde;o foi informado.";
    $validacao = false;
}

if(!isset($_POST["emailDestinatario"])  && $validacao){
    $mensagem = "O e-mail do destinat&aacute;rio n&atilde;o foi informado.";
    $validacao = false;
}

//verifica se o arquivo existe

if (file_exists(K_TEMPLATE_FIS_ENVIO_EMAIL_NOTICIA) && $validacao){

//prepara e envia o email
$l_obj_noticia = new Noticia();
$l_obj_noticia->dbconn->conectar();
$l_obj_noticia->GetNoticia($_POST["news_not_pk"]);
$l_obj_noticia->dbconn->fechar();

$url = "<a href='".K_SITE_URL_COMPLETA."/".$_POST["url"]."' target='_blank'>".K_SITE_URL_COMPLETA."/".$_POST["url"]."</a>";



              $corpo_email = implode ('', file (K_TEMPLATE_FIS_ENVIO_EMAIL_NOTICIA));
              $corpo_email = str_replace("##NOME_DESTINATARIO##", $_POST["nomeDestinatario"], $corpo_email);
              $corpo_email = str_replace("##NOME_REMETENTE##", $_POST["nomeRemetente"], $corpo_email);
              $corpo_email = str_replace("##EMAIL_REMETENTE##", $_POST["emailRemetente"], $corpo_email);
              $corpo_email = str_replace("##TITULO_NOTICIA##",$l_obj_noticia->news_not_titulo, $corpo_email);
              $corpo_email = str_replace("##URL##", $url, $corpo_email);
	      $corpo_email = str_replace("##COMENTARIO##", ( ( isset($_POST["comentario"]) && trim($_POST["comentario"])!="")?$_POST["nomeRemetente"].", ainda fez o seguinte comentário:<br/><br/>".$_POST["comentario"]."</br>":"" ), $corpo_email);



$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: ".K_EMAIL_FROM_ENVIO."\r\n";
$headers .= "Return-Path: ".K_EMAIL_FROM_ENVIO."\r\n";
$headers .= "Reply-To: ".$_POST["emailRemetente"]."\r\n";


            // Mail it

            if(!mail($_POST["emailDestinatario"], "Seu amigo(a) ".$_POST["nomeRemetente"]." enviou uma notícia do site da CRMVBA", $corpo_email, $headers)){
                $mensagem =  "Ocorreu um problema durante o envio de sua e-mail. Tente novamente.";
                $validacao = false;
            }

            //se chegou ate aqui eh porque enviou
            if($validacao)
                $mensagem =  "Sua mensagem foi enviada com sucesso!";

	}
        else{
            if($validacao)
                $mensagem = "Template de envio de e-mail in&aacute;lido ou inexistente";
        }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt_PT">
<?php include('incs/cabecalho.php'); ?>
<head><title>Enviar not&iacute;cia</title></head>
<body style="background:none;" >


        <br><center><font face='arial'><?php echo $mensagem; ?></font></center>


        <br/><input type='button' class="botao1"  value='Fechar' onclick='javascript:window.close();' />

</body>
</html>
