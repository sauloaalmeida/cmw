<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_imagem.php';

//parametros importantes para o funcionamento da pagina

// a acao da pagina
if( !isset($_POST["l_str_acao"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro l_str_acao n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

$l_str_acao =  $_POST["l_str_acao"];

// o codigo da noticia da imagem
if( !isset($_POST["even_even_pk"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro even_even_fk n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

$even_even_pk = $_POST["even_even_pk"];

//instancia o objeto de imagens	 
$l_obj_imagem = new Imagem();	 

$l_obj_imagem->dbconn->conectar();	 

//decide o que fazer de acordo com a acao
if ($l_str_acao == K_EXCLUIR){

    if( !isset($_POST["even_img_pk"]) )
          msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro even_img_pk n&atilde;o foi postado para a p&aacute;gina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    $l_obj_imagem->GetImagem($_POST["even_img_pk"]);

	if($l_obj_imagem->excluir()){
	
	     //exclui as imagens do diretorio
		 func_exclui_arq(K_UPLOADDIR_FIS_IMG_EVEN . $l_obj_imagem->even_img_path1);
		 
		 if (strlen($l_obj_imagem->even_img_path2)>0)
	          func_exclui_arq(K_UPLOADDIR_FIS_IMG_EVEN . $l_obj_imagem->even_img_path2);
		 
		 //redireciona para tela de listagem de imagens		 

  	     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_imagem.php?even_even_pk=".$even_even_pk."&l_str_msg=".urlencode("Imagem excluida com sucesso!")."'</script>";	
		 
	}else	 
	    msg(K_MSGERRO, K_VOLTAR, "Erro na exclus&atilde;o", "Erro na exclus&atilde;o da Imagem.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

}elseif($l_str_acao == K_ALTERAR || $l_str_acao == K_INCLUIR){
    
	
	//testa os campos obrigatorios
    if($l_str_acao == K_ALTERAR){
	
  	     if( !isset($_POST["even_img_pk"]) )
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro even_img_pk n&atilde;o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

	     $l_obj_imagem->GetImagem($_POST["even_img_pk"]);
	}
		 	 
		
    if( !isset($_POST["even_img_titulo"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro even_img_titulo n&atilde;o  foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
    if( !isset($_POST["even_img_descricao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par&acirc;metro even_img_descricao n&atilde;o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
	//verifica se os arquivos de acordo com a acao
	if ($l_str_acao == K_INCLUIR){
		if ( is_null($_FILES['even_img_path1']['tmp_name']) || $_FILES['even_img_path1']['tmp_name'] == "" ||  $_FILES['even_img_path1']['size'] == 0)
 		       msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O primeiro arquivo n&atilde;o  foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
			   
        //coloca o nome do arquivo no formato especifico
		$even_img_path1 = func_str_completa_esquerda($even_even_pk,8,'0')."_1".date("_YmdHis_"). $_FILES['even_img_path1']['name'];
		move_uploaded_file($_FILES['even_img_path1']['tmp_name'], K_UPLOADDIR_FIS_IMG_EVEN . $even_img_path1);
		
		//muda a permissao para o leitura e escrita para o dono e leitura para os outros
		chmod (K_UPLOADDIR_FIS_IMG_EVEN . $even_img_path1, 0644);
		

        if ( is_null($_FILES['even_img_path2']['tmp_name']) || $_FILES['even_img_path2']['tmp_name'] == "" ||  $_FILES['even_img_path2']['size'] == 0 || strlen($_FILES['even_img_path2']['tmp_name'])==0 )
		    $even_img_path2 = "";
		else{
            $even_img_path2 = func_str_completa_esquerda($even_even_pk,8,'0')."_2".date("_YmdHis_"). $_FILES['even_img_path2']['name'];
            move_uploaded_file($_FILES['even_img_path2']['tmp_name'], K_UPLOADDIR_FIS_IMG_EVEN . $even_img_path2);
			
			//muda a permissao para o leitura e escrita para o dono e leitura para os outros
			chmod (K_UPLOADDIR_FIS_IMG_EVEN . $even_img_path2, 0644);
		}	
	   
    }			   
	
	if ($l_str_acao == K_ALTERAR){
	
	    //verifica se o arquivo1 veio para pagina
        if ( strlen($_FILES['even_img_path1']['tmp_name']) == 0 || is_null($_FILES['even_img_path1']['tmp_name']) || $_FILES['even_img_path1']['tmp_name'] == "" ||  $_FILES['even_img_path1']['size'] == 0)
 		    $even_img_path1 = $l_obj_imagem->even_img_path1;
		else{
		     //se veio deleta o que esta la 
			 func_exclui_arq(K_UPLOADDIR_FIS_IMG_EVEN . $l_obj_imagem->even_img_path1);
			 
			 //e inclui o que veio
			 $even_img_path1 = func_str_completa_esquerda($even_even_pk,8,'0')."_1".date("_YmdHis_"). $_FILES['even_img_path1']['name'];
		     move_uploaded_file($_FILES['even_img_path1']['tmp_name'], K_UPLOADDIR_FIS_IMG_EVEN . $even_img_path1);
			 
			 //muda a permissao para o leitura e escrita para o dono e leitura para os outros
			 chmod (K_UPLOADDIR_FIS_IMG_EVEN . $even_img_path1, 0644);
		}
		   
			 
	    //verifica se o arquivo2 veio para pagina
        if ( strlen($_FILES['even_img_path2']['tmp_name']) == 0 || is_null($_FILES['even_img_path2']['tmp_name']) || $_FILES['even_img_path2']['tmp_name'] == "" ||  $_FILES['even_img_path2']['size'] == 0)
 		      if ( strlen($l_obj_imagem->even_img_path2) == 0 || is_null($l_obj_imagem->even_img_path2) || $l_obj_imagem->even_img_path2 == "")
		           $even_img_path2 = "";
			  else
  		           $even_img_path2 = $l_obj_imagem->even_img_path2;
		else{
		
		     //se veio deleta o que esta la (se existir)
	 		 if (strlen($l_obj_imagem->even_img_path2)>0)
			     func_exclui_arq(K_UPLOADDIR_FIS_IMG_EVEN . $l_obj_imagem->even_img_path2);
			 
			 //e inclui o que veio
			 $even_img_path2 = func_str_completa_esquerda($even_even_pk,8,'0')."_2".date("_YmdHis_"). $_FILES['even_img_path2']['name'];
		     move_uploaded_file($_FILES['even_img_path2']['tmp_name'], K_UPLOADDIR_FIS_IMG_EVEN . $even_img_path2);
			 
			 //muda a permissao para o leitura e escrita para o dono e leitura para os outros
			 chmod (K_UPLOADDIR_FIS_IMG_EVEN . $even_img_path2, 0644);
		}
		
				 
	}
		
    if( !isset($_POST["even_img_credito"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O par�metro even_img_credito n�o foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");						
		
	//UFA!!! se validou isso tudo, trata algumas variaveis
	$even_img_dt_cadastro = date("Y-m-d H:i:s", time());
	
    if( !isset($_POST["even_img_destaque"]) )
        $even_img_destaque = K_INATIVO;
	else		
  	    $even_img_destaque = K_ATIVO;			
	
	//preenche os atributos	
    $l_obj_imagem->even_img_titulo = $_POST["even_img_titulo"];
    $l_obj_imagem->even_img_descricao = $_POST["even_img_descricao"];
    $l_obj_imagem->even_img_destaque = $even_img_destaque;	
    $l_obj_imagem->even_img_dt_cadastro = $even_img_dt_cadastro;				
    $l_obj_imagem->even_img_path1 = $even_img_path1;
    $l_obj_imagem->even_img_path2 = $even_img_path2;
    $l_obj_imagem->even_img_credito = $_POST["even_img_credito"];
    $l_obj_imagem->even_even_fk = $even_even_pk;

    if($l_str_acao == K_INCLUIR)
		if($l_obj_imagem->incluir())		
  		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_imagem.php?even_even_pk=".$even_even_pk."&l_str_msg=".urlencode("Imagem incluida com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na inclus&atilde;o", "Erro na inclus&atilde;o da Imagem.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if($l_str_acao == K_ALTERAR){	
	    $l_obj_imagem->even_img_pk = $_POST["even_img_pk"];
		if($l_obj_imagem->alterar())		
   		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_imagem.php?even_even_pk=".$even_even_pk."&l_str_msg=".urlencode("Imagem alterada com sucesso!")."'</script>";			
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na altera&ccedil;&atilde;o", "Erro na altera&ccedil;&atilde;o da imagem.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	}

}else    
   msg(K_MSGERRO, K_VOLTAR, "A&ccedil;&atilde;o inv&aacute;lida", "A a&ccedil;&atilde;o postado para a pagina &eacute; inv&aacute;lida.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");


?>