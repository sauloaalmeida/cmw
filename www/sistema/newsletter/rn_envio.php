<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_mailenvio.php';
include 'cl_mailusuario.php';

if(!isset($_REQUEST["l_str_acao"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro l_str_acao nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

//cptura a acao da pagina
$l_str_acao =  $_REQUEST["l_str_acao"];

//instancia o objeto de noticias
$l_obj_mail = new MailEnvio();

$l_obj_mail->dbconn->conectar();


//decide o que fazaer de acordo com a acao

if($l_str_acao == K_EXCLUIR){

	 if( !isset($_POST["nwsl_env_pk"]) )
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro nwsl_env_pk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

  	   $l_obj_mail->getEnvio($_POST["nwsl_env_pk"]);

	   //exclui as imagens do diretorio
         if(trim($l_obj_mail->nwsl_env_path)!="")
	 	   func_exclui_arq(K_UPLOADDIR_FIS_IMG_MAIL . $l_obj_mail->nwsl_env_path);

           //exclui o envio
	    if($l_obj_mail->excluir()){

	       //redireciona para tela de listagem de imagens
  	       echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_envio.php?l_str_msg=".urlencode("Envio excluido com sucesso!")."'</script>";

	    }else{
	        msg(K_MSGERRO, K_VOLTAR, "Erro na exclusao", "Erro na exclusao do envio.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
            }

}elseif ($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){
    
    
    if($l_str_acao == K_ALTERAR){
  	if( !isset($_POST["nwsl_env_pk"]) ){
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro nwsl_env_pk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
        }
    }

    if( !isset($_POST["nwsl_env_assunto"]) ){
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro nao nwsl_env_assunto foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
    }


	//preenche os atributos
    $l_obj_mail->nwsl_env_assunto = $_POST["nwsl_env_assunto"];
    $l_obj_mail->nwsl_env_path = $nwsl_env_path;
    $l_obj_mail->nwsl_env_corpo = stripslashes($_POST["nwsl_env_corpo"]);
    $l_obj_mail->nwsl_temp_fk = (trim($_POST["nwsl_temp_fk"]) != "")?$_POST["nwsl_temp_fk"]:NULL;


    //verifica se os arquivos de acordo com a acao
    if ($l_str_acao == K_INCLUIR){
          if ( !is_null($_FILES['nwsl_env_path']['tmp_name']) && $_FILES['nwsl_env_path']['tmp_name'] != "" &&  $_FILES['nwsl_env_path']['size'] > 0){

                //coloca o nome do arquivo no formato especifico
                    $nwsl_env_path = date("YmdHis_"). $_FILES['nwsl_env_path']['name'];
                    move_uploaded_file($_FILES['nwsl_env_path']['tmp_name'], K_UPLOADDIR_FIS_IMG_MAIL . $nwsl_env_path);

                  //muda a permissao para o leitura e escrita para o dono e leitura para os outros
                  chmod (K_UPLOADDIR_FIS_IMG_MAIL . $nwsl_env_path, 0644);
         }else{
            $nwsl_env_path = "";
         }

        //inclui o envio
        if($l_obj_mail->incluir())
             echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_envio.php?l_str_msg=".urlencode("Envio incluido com sucesso!")."'</script>";
        else
            msg(K_MSGERRO, K_VOLTAR, "Erro na inclusao", "Erro na inclusao do envio.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    }


    if ($l_str_acao == K_ALTERAR){

        //pega o valor antigo
        $l_obj_mail->getEnvio($_POST["nwsl_env_pk"]);

            //verifica se o arquivo1 veio para pagina
        if ( strlen($_FILES['nwsl_env_path']['tmp_name']) == 0 || is_null($_FILES['nwsl_env_path']['tmp_name']) || $_FILES['nwsl_env_path']['tmp_name'] == "" ||  $_FILES['nwsl_env_path']['size'] == 0)
                    $nwsl_env_path = $l_obj_mail->nwsl_env_path;
        else{
                //se veio deleta o que esta la
                 func_exclui_arq(K_UPLOADDIR_FIS_IMG_MAIL. $l_obj_mail->nwsl_env_path);

                 //e inclui o que veio
                 $nwsl_env_path = date("YmdHis_"). $_FILES['nwsl_env_path']['name'];
                  move_uploaded_file($_FILES['nwsl_env_path']['tmp_name'], K_UPLOADDIR_FIS_IMG_MAIL . $nwsl_env_path);

                 //muda a permissao para o leitura e escrita para o dono e leitura para os outros
                 chmod (K_UPLOADDIR_FIS_IMG_MAIL . $nwsl_env_path, 0644);
        }

        //altera o envio
        $l_obj_mail->nwsl_env_pk = $_POST["nwsl_env_pk"];
        if($l_obj_mail->alterar())
             echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_envio.php?l_str_msg=".urlencode("Envio alterado com sucesso!")."'</script>";
        else
            msg(K_MSGERRO, K_VOLTAR, "Erro na alteracao", "Erro na alteracao do envio.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    }   
    
}elseif ($l_str_acao == K_ENVIAR){
    
    
    
	 if( !isset($_REQUEST["nwsl_env_pk"]) )
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parametro nwsl_env_pk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

         //monta lista com codigo dos emails que serao enviados
         $primeiro=true;
         $emails_codes="";
         foreach($_POST["nwsl_usr_pk"] as $usr_pk){

             if($primeiro){
                $emails_codes .= $usr_pk;
                $primeiro=false;
             }else{
                $emails_codes .= ",".$usr_pk;
             }
         }


	$l_obj_usuario = new MailUsuario();
	$l_obj_usuario->dbconn->conectar();
	$rsUsuarios = $l_obj_usuario->getEmails($emails_codes);

        //envia todos os emails
	$l_obj_mail->getEnvio($_REQUEST["nwsl_env_pk"]);

        /*
        echo "codes: ".$emails_codes;
        echo "<br>news: ".$_REQUEST["nwsl_env_pk"];
        echo "<br>path: ".$l_obj_mail->nwsl_temp_path;
        exit;
        */
	while ( $RStemp = $l_obj_mail->dbconn->getRecordsetArray($rsUsuarios) ){

	   //echo "template=".K_TEMPLATE_FIS_ENVIO_EMAIL;
  	   //abre o arquivo modelo e joga em uma variavel.
              if($l_obj_mail->nwsl_temp_fk != NULL){

                  $corpo_email = implode ('', file ($l_obj_mail->nwsl_temp_path));
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
              }else{
                  if(trim($l_obj_mail->nwsl_env_path)!=""){
                        $corpo_email ="<center><img src='".K_SITE_URL_COMPLETA.K_UPLOADDIR_EXIB_IMG_MAIL.$l_obj_mail->nwsl_env_path."' /></center><br />";
                  }
                  $corpo_email .= $l_obj_mail->nwsl_env_corpo;
              }


                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "From: ".K_EMAIL_FROM_ENVIO."\r\n";
                $headers .= "Return-Path: ".K_EMAIL_FROM_ENVIO."\r\n";
                $headers .= "Reply-To: ".K_EMAIL_FROM_ENVIO."\r\n";

                $contErros = 0;
                // Mail it
                //echo "Enviou email".$RStemp["nwsl_usr_email"]."<br>";
                /*
                echo "<br>".$l_obj_mail->nwsl_env_corpo;
                echo "<br>".$l_obj_mail->nwsl_temp_path;
                echo "<br>".$corpo_email;
                exit;*/
                if(!mail($RStemp["nwsl_usr_email"], $l_obj_mail->nwsl_env_assunto, $corpo_email, $headers)){
                    $listaErros[$contErros++] = $RStemp["nwsl_usr_email"] ." - ". $RStemp["nwsl_usr_nome"]."<br>";
                }
        
        }

	//faz update dos dados do envio
	$l_obj_mail->enviar();

        //caso exista erros envia um email com os email com problemas de envio
        if($contErros>0){

	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: ".K_EMAIL_FROM_ENVIO."\r\n";
	$headers .= "Return-Path: ".K_EMAIL_FROM_ENVIO."\r\n";
	$headers .= "Reply-To: ".K_EMAIL_FROM_ENVIO."\r\n";

            $corpo_email = "Assunto: ".$l_obj_mail->nwsl_env_assunto."<br/>";
            $corpo_email.= "Data: ". date("d/m/Y H:i:s")."<br/></br>";
            foreach ($listaErros as $emailErro){
                $corpo_email.=  $emailErro;
            }
            // Mail it
            mail('sauloandrade@yahoo.com', "Problema com o envio de email - ".date("d/m/Y H:i:s"), $corpo_email, $headers);
            //echo "enviou email dos erros";
        }

	$l_obj_usuario->dbconn->fechar();
        //exit();
	//redireciona para a pagina de listagem
        echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_envio.php?l_str_msg=".urlencode("Envio executado com sucesso!")."'</script>";    
    
    
}else{
    msg(K_MSGERRO, K_VOLTAR, "Acao invalida", "A acao postada para a pagina &eacute; invalida.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");    
}

?>