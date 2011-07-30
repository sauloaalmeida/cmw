<?php
include 'cl_anexo.php';

//captura o codigo da imagem (se existir)
if(isset($_REQUEST["even_anx_pk"]))
   $even_anx_pk = $_REQUEST["even_anx_pk"];

//instancia o objeto de imagem
$l_obj_anexo = new Anexo;

//cria conexao com o banco
$l_obj_anexo->dbconn->conectar();

//verifica qual a acao que vem da pagina anterior
if($l_str_acao == K_CONSULTAR || $l_str_acao == K_ALTERAR || $l_str_acao == K_EXCLUIR){

    if(!isset($_REQUEST["even_anx_pk"]))
	      msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O codigo do anexo n�o foram postado para a pagina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");
	
	//pega a noticia desejada
	$l_obj_anexo->getAnexo($even_anx_pk);
}

?>
<script language="JavaScript" type="text/javascript">

function frm_validar(frm,l_str_acao){

var achou = false;

  if( (l_str_acao == '<?php echo K_INCLUIR ?>') || (l_str_acao == '<?php echo K_ALTERAR ?>') ){
  
     <?php
	 
	  if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){
      
	     //cria a variavel de contador
        $i=0;

        //pega os tipos de anexo existentes
         $RStipoanexos = $l_obj_anexo->getTipoAnexos();

         echo "var extensoes = new Array(".$l_obj_anexo->dbconn->getQtdRegistros($RStipoanexos).");\n";

         while ( $RStemp = $l_obj_anexo->dbconn->getRecordsetArray($RStipoanexos) ){
           echo "extensoes[".$i."] = '".$RStemp["tipo_anx_extensao"]."';\n";
	       $i++;
         }	
	  }

     ?>  

	  if(func_bl_isvazio(frm.even_anx_titulo,'O Titulo do anexo precisa ser preenchido!'))
	      return false;
	  

	  if(func_bl_isvazio(frm.even_anx_descricao,'A descricao do anexo precisa ser preenchido!'))
	      return false;		  
		  
      if(l_str_acao == '<?php echo K_INCLUIR ?>')
		  if(func_bl_isvazio(frm.even_anx_path,'O arquivo precisa ser anexado!'))
  	           return false;
      			   
				   
      if(!func_bl_isvazio(frm.even_anx_path)){
	         
			 if(frm.even_anx_path.value.lastIndexOf(".")<=0){
			     alert("O anexo nao possui um nome ou uma extensao!");
				 frm.even_anx_path.focus();
			     return false;
			 }
			 else{
 		         //teste se o anexo eh de um tipo de algum cadastrado no banco
			     for(i in extensoes){
 			         // compara cada item do vetor, com o pedaco do nome do arquivo apartir do ultimo ponto (o da extensao)
			         if(  extensoes[i] ==  frm.even_anx_path.value.toUpperCase().slice(frm.even_anx_path.value.lastIndexOf(".")+1) )
			            achou = true;
			     }
			  
 		         if(!achou){
		  	         alert("O arquivo nao eh um anexo valido, primeiro eh preciso fazer o cadsatro desse tipo de anexo!");
			         frm.even_anx_path.focus();
					 return false;
                 }			 			  			  			 
	         }
			 
			 
	  }
	  
     //verifica se o tipo de extensao bate com o selecionado  
	 if((l_str_acao == '<?php echo K_INCLUIR ?>' || l_str_acao == '<?php echo K_ALTERAR ?>') && ( !func_bl_isvazio(frm.even_anx_path) )  ){

         tipo_extensao = frm.tipo_anx_fk.value.split("<?php echo K_SEPARADOR?>");

		 if(frm.even_anx_path.value.toUpperCase().slice(frm.even_anx_path.value.lastIndexOf(".")+1) != tipo_extensao[1]){
           alert("O arquivo nao possui a mesma extensao do tipo de arquivo selecionado!");
           frm.tipo_anx_fk.focus();
		   return false;
	     }
		 
     }	
	 
     //verifica se o tipo de extensao bate com o selecionado caso ele ja esteja la
	 if((l_str_acao == '<?php echo K_ALTERAR ?>') && ( func_bl_isvazio(frm.even_anx_path) )  ){

         tipo_extensao = frm.tipo_anx_fk.value.split("<?php echo K_SEPARADOR?>");
		 if("<?php echo $l_obj_anexo->even_anx_path;?>".toUpperCase().slice("<?php echo $l_obj_anexo->even_anx_path;?>".lastIndexOf(".")+1) != tipo_extensao[1]){
           alert("O arquivo ja cadastrado nao possui a mesma extensao do tipo de arquivo selecionado!");
           frm.tipo_anx_fk.focus();
		   return false;
	     }
		 
     }		 	
	 
      
	  if(func_bl_isvazio(frm.even_anx_credito,'O credito do anexo precisa ser preenchido!'))
	      return false;		  		  
	  
      return true;
  }
  
  if(l_str_acao == '<?php echo K_EXCLUIR ?>'){
      if(confirm("A exclusao desse anexo eh irreversivel! \nTem certeza que deseja excluir?"))
          return true;
	  else
	    return false;	  
  }

}

</script>
<br>
<form name="frm_cad_anexo" method="post" enctype="multipart/form-data" action="rn_anexo.php" onSubmit="return frm_validar(this,'<?php echo $l_str_acao ?>');">
<input type="hidden" name="even_even_pk" value="<?php echo $even_even_pk ?>">
<input type="hidden" name="even_anx_pk" value="<?php echo $l_obj_anexo->even_anx_pk ?>">
<input type="hidden" name="l_str_acao" value="<?php echo $l_str_acao ?>">
<table width="750" align="center">
<tr>
  <td align="center">
     <table width="530" border="0">
	    
		<tr>
          <td colspan="2"><strong>Obs:</strong> O nome do arquivo n&atilde;o dever&aacute; ter acentos. </td>
		  </tr>
		<tr>
		    <td width="100"><b>Titulo:</b></td>
			<td width="630">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="even_anx_titulo" size="40" value="<?php echo $l_obj_anexo->even_anx_titulo; ?>"> 
		      <?php }else echo $l_obj_anexo->even_anx_titulo; ?>			</td>
		</tr>
	    
		<tr>
                    <td><b>Descri&ccedil;&atilde;o:</b></td>
			<td>
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <textarea name="even_anx_descricao" cols="60" rows="4"><?php echo $l_obj_anexo->even_anx_descricao; ?></textarea>
		      <?php }else echo $l_obj_anexo->even_anx_descricao; ?>		   </td>
		</tr>
		<?php if($l_str_acao != K_INCLUIR ) {?>		
	    <tr>
		   <td><b>Data cadastro:</b></td>
		   <td>
		     <?php echo $l_obj_anexo->even_anx_dt_cadastro; ?>		   </td>
		</tr>								
		<?php } ?>
	    <tr>
		   <td><b>Arquivo:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		      <input type="file" name="even_anx_path" size="40" ><br>
			<?php } echo "<a id='link02' href='".K_UPLOADDIR_EXIB_ANX_EVEN.$l_obj_anexo->even_anx_path."' target='_blank'>".substr($l_obj_anexo->even_anx_path,24)."</a>"; ?>		   </td>
		</tr>
	    <tr>
		   <td><b>Tipo Anexo:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) { ?>
 
 			 <select name="tipo_anx_fk" size="1">

			   <?php

                //verifica se existe algum registro no recordset
                if(!$l_obj_anexo->dbconn->getExisteRecordset($RStipoanexos))
                   echo "<option value=''>Sem formatos cadastrados</option>";
                else{
				   //volta para o primeiro registro
				   $l_obj_anexo->dbconn->movefirst($RStipoanexos);
				   $selecionado = "";
				   
                   while ( $RStemp = $l_obj_anexo->dbconn->getRecordsetArray($RStipoanexos) ){
				   
				     if($l_obj_anexo->tipo_anx_fk == $RStemp["tipo_anx_pk"])
					     $selecionado = " selected ";
						 
                     echo "<option value='".$RStemp["tipo_anx_pk"].K_SEPARADOR.$RStemp["tipo_anx_extensao"]."' ". $selecionado .">".$RStemp["tipo_anx_nome"]."</option>\n";
				     $selecionado = "";
				   }	 
				}	 
			    ?>
			 </select>
			<?php }else echo $l_obj_anexo->getDescricaoTipoAnexo($l_obj_anexo->tipo_anx_fk); ?>		   </td>
		</tr>														
	    <tr>
                <td><b>Cr&eacute;dito:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		      <input type="text" name="even_anx_credito" size="40" value="<?php echo $l_obj_anexo->even_anx_credito; ?>">
			<?php }else echo $l_obj_anexo->even_anx_credito; ?>		   </td>
		</tr>						
		<tr><td colspan="2" align="center">
		 <br>
		 <?php if($l_str_acao != K_CONSULTAR) {?>
		   <input type="submit" value="<?php echo $l_str_acao ?> anexo">  
		 <?php }?>  
           <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_anexo.php?even_even_pk=<?php echo $even_even_pk ?>&even_cat_pk=<?php echo $even_cat_pk ?>')">
        </td></tr>
	 </table>
  </td>
</tr>
</table>
<?php 
//fecha conexao com o banco
if($l_str_acao != K_INCLUIR) 
    $l_obj_anexo->dbconn->fechar();
?>	
</form>