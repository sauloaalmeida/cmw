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
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parâmetro l_str_acao não foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

$l_str_acao =  $_POST["l_str_acao"];

// o codigo da noticia da imagem
if( !isset($_POST["news_not_pk"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parâmetro news_not_fk não foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");		

$news_not_pk = $_POST["news_not_pk"];

// o codigo da categoria da noticia (!para poder retornar para a pagina ap_index_lst_imagem)
if( !isset($_POST["news_cat_fk"]) )
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parâmetro news_cat_fk não foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");		

$news_cat_fk = $_POST["news_cat_fk"];

//instancia o objeto de imagens	 
$l_obj_imagem = new Imagem();	 

$l_obj_imagem->dbconn->conectar();	 

//decide o que fazer de acordo com a acao
if ($l_str_acao == K_EXCLUIR){

    if( !isset($_POST["news_img_pk"]) )
          msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parâmetro news_img_pk não foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    $l_obj_imagem->GetImagem($_POST["news_img_pk"]);

	if($l_obj_imagem->excluir()){
	
	     //exclui as imagens do diretorio
		 func_exclui_arq(K_UPLOADDIR_FIS_IMG_NOT . $l_obj_imagem->news_img_path1);
		 
		 if (strlen($l_obj_imagem->news_img_path2)>0)
	          func_exclui_arq(K_UPLOADDIR_FIS_IMG_NOT . $l_obj_imagem->news_img_path2);
		 
		 //redireciona para tela de listagem de imagens		 

  	     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_imagem.php?news_not_pk=".$news_not_pk."&news_cat_pk=".$news_cat_fk."&l_str_msg=".urlencode("Imagem excluida com sucesso!")."'</script>";	
		 
	}else	 
	    msg(K_MSGERRO, K_VOLTAR, "Erro na exclusão", "Erro na exclusão da Imagem.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

}elseif($l_str_acao == K_ALTERAR || $l_str_acao == K_INCLUIR){
    
	
	//testa os campos obrigatorios
    if($l_str_acao == K_ALTERAR){
	
  	     if( !isset($_POST["news_img_pk"]) )
             msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parâmetro news_img_pk não foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");   

	     $l_obj_imagem->GetImagem($_POST["news_img_pk"]);
	}
		 	 
		
    if( !isset($_POST["news_img_titulo"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parâmetro news_img_titulo foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");		
		
    if( !isset($_POST["news_img_descricao"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parâmetro news_img_descricao não foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
		
	//verifica se os arquivos de acordo com a acao
	if ($l_str_acao == K_INCLUIR){
		if ( is_null($_FILES['news_img_path1']['tmp_name']) || $_FILES['news_img_path1']['tmp_name'] == "" ||  $_FILES['news_img_path1']['size'] == 0)
 		       msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O primeiro arquivo não foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");   
			   
        //coloca o nome do arquivo no formato especifico
		$news_img_path1 = func_str_completa_esquerda($news_not_pk,8,'0')."_1".date("_YmdHis_"). $_FILES['news_img_path1']['name'];
		move_uploaded_file($_FILES['news_img_path1']['tmp_name'], K_UPLOADDIR_FIS_IMG_NOT . $news_img_path1);
		
		//muda a permissao para o leitura e escrita para o dono e leitura para os outros
		chmod (K_UPLOADDIR_FIS_IMG_NOT . $news_img_path1, 0644);
		

        if ( is_null($_FILES['news_img_path2']['tmp_name']) || $_FILES['news_img_path2']['tmp_name'] == "" ||  $_FILES['news_img_path2']['size'] == 0 || strlen($_FILES['news_img_path2']['tmp_name'])==0 )
		    $news_img_path2 = "";
		else{
            $news_img_path2 = func_str_completa_esquerda($news_not_pk,8,'0')."_2".date("_YmdHis_"). $_FILES['news_img_path2']['name'];
            move_uploaded_file($_FILES['news_img_path2']['tmp_name'], K_UPLOADDIR_FIS_IMG_NOT . $news_img_path2);
			
			//muda a permissao para o leitura e escrita para o dono e leitura para os outros
			chmod (K_UPLOADDIR_FIS_IMG_NOT . $news_img_path2, 0644);
		}	
	   
    }			   
	
	if ($l_str_acao == K_ALTERAR){
	
	    //verifica se o arquivo1 veio para pagina
        if ( strlen($_FILES['news_img_path1']['tmp_name']) == 0 || is_null($_FILES['news_img_path1']['tmp_name']) || $_FILES['news_img_path1']['tmp_name'] == "" ||  $_FILES['news_img_path1']['size'] == 0)
 		    $news_img_path1 = $l_obj_imagem->news_img_path1;
		else{
		     //se veio deleta o que esta la 
			 func_exclui_arq(K_UPLOADDIR_FIS_IMG_NOT . $l_obj_imagem->news_img_path1);
			 
			 //e inclui o que veio
			 $news_img_path1 = func_str_completa_esquerda($news_not_pk,8,'0')."_1".date("_YmdHis_"). $_FILES['news_img_path1']['name'];
		     move_uploaded_file($_FILES['news_img_path1']['tmp_name'], K_UPLOADDIR_FIS_IMG_NOT . $news_img_path1);
			 
			 //muda a permissao para o leitura e escrita para o dono e leitura para os outros
			 chmod (K_UPLOADDIR_FIS_IMG_NOT . $news_img_path1, 0644);			 
		}
		   
			 
	    //verifica se o arquivo2 veio para pagina
        if ( strlen($_FILES['news_img_path2']['tmp_name']) == 0 || is_null($_FILES['news_img_path2']['tmp_name']) || $_FILES['news_img_path2']['tmp_name'] == "" ||  $_FILES['news_img_path2']['size'] == 0)
 		      if ( strlen($l_obj_imagem->news_img_path2) == 0 || is_null($l_obj_imagem->news_img_path2) || $l_obj_imagem->news_img_path2 == "")
		           $news_img_path2 = "";
			  else
  		           $news_img_path2 = $l_obj_imagem->news_img_path2;
		else{
		
		     //se veio deleta o que esta la (se existir)
	 		 if (strlen($l_obj_imagem->news_img_path2)>0)
			     func_exclui_arq(K_UPLOADDIR_FIS_IMG_NOT . $l_obj_imagem->news_img_path2);
			 
			 //e inclui o que veio
			 $news_img_path2 = func_str_completa_esquerda($news_not_pk,8,'0')."_2".date("_YmdHis_"). $_FILES['news_img_path2']['name'];
		     move_uploaded_file($_FILES['news_img_path2']['tmp_name'], K_UPLOADDIR_FIS_IMG_NOT . $news_img_path2);
			 
			 //muda a permissao para o leitura e escrita para o dono e leitura para os outros
			 chmod (K_UPLOADDIR_FIS_IMG_NOT . $news_img_path2, 0644);
		}
		
				 
	}
		
    if( !isset($_POST["news_img_credito"]) )
        msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O parâmetro news_img_credito não foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");						
		
	//UFA!!! se validou isso tudo, trata algumas variaveis
	$news_img_dt_cadastro = date("Y-m-d H:i:s", time());
	
    if( !isset($_POST["news_img_destaque"]) )
        $news_img_destaque = K_INATIVO;
	else		
  	    $news_img_destaque = K_ATIVO;			
	
	//preenche os atributos	
    $l_obj_imagem->news_img_titulo = $_POST["news_img_titulo"];
    $l_obj_imagem->news_img_descricao = $_POST["news_img_descricao"];
    $l_obj_imagem->news_img_destaque = $news_img_destaque;	
    $l_obj_imagem->news_img_dt_cadastro = $news_img_dt_cadastro;				
    $l_obj_imagem->news_img_path1 = $news_img_path1;
    $l_obj_imagem->news_img_path2 = $news_img_path2;
    $l_obj_imagem->news_img_credito = $_POST["news_img_credito"];
    $l_obj_imagem->news_not_fk = $news_not_pk;

    if($l_str_acao == K_INCLUIR)
		if($l_obj_imagem->incluir())		
  		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_imagem.php?news_not_pk=".$news_not_pk."&news_cat_pk=".$news_cat_fk."&l_str_msg=".urlencode("Imagem incluida com sucesso!")."'</script>";
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na inclusão", "Erro na inclusão da Imagem.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

    if($l_str_acao == K_ALTERAR){	
	    $l_obj_imagem->news_img_pk = $_POST["news_img_pk"];
		if($l_obj_imagem->alterar())		
   		     echo "<script language='JavaScript' type='text/javascript'> window.location = 'ap_index_lst_imagem.php?news_not_pk=".$news_not_pk."&news_cat_pk=".$news_cat_fk."&l_str_msg=".urlencode("Imagem alterada com sucesso!")."'</script>";			
		else
            msg(K_MSGERRO, K_VOLTAR, "Erro na alteração", "Erro na alteração da imagem.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");
	}

}else    
   msg(K_MSGERRO, K_VOLTAR, "Ação inválida", "A ação postado para a pagina é invalida.<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");


?>