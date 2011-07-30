<?php
include 'cl_imagem.php';

//captura o codigo da imagem (se existir)
if(isset($_REQUEST["even_img_pk"]))
   $even_img_pk = $_REQUEST["even_img_pk"];

//instancia o objeto de imagem
$l_obj_imagem = new Imagem;

//verifica qual a acao que vem da pagina anterior
if($l_str_acao == K_CONSULTAR || $l_str_acao == K_ALTERAR || $l_str_acao == K_EXCLUIR){

    if(!isset($_REQUEST["even_img_pk"]))
	      msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O c�digo da not�cia n�o foram postado para a pagina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");

    //cria conexao com o banco
    $l_obj_imagem->dbconn->conectar();
	
	//pega a noticia desejada
	$l_obj_imagem->getImagem($even_img_pk);
}

?>
<script language="JavaScript" type="text/javascript">

function frm_validar(frm,l_str_acao){

var achou = false;
var extensoes = new Array(5);
extensoes[0] = "JPG";
extensoes[1] = "GIF";
extensoes[2] = "BMP";
extensoes[3] = "PNG";
extensoes[4] = "JPEG";



  if( (l_str_acao == '<?php echo K_INCLUIR ?>') || (l_str_acao == '<?php echo K_ALTERAR ?>') ){

	  if(func_bl_isvazio(frm.even_img_titulo,'O Titulo da imagem precisa ser preenchido!'))
	      return false;
	  

	  if(func_bl_isvazio(frm.even_img_descricao,'A descricao da imagem precisa ser preenchido!'))
	      return false;		  
		  
      if(l_str_acao == '<?php echo K_INCLUIR ?>')
		  if(func_bl_isvazio(frm.even_img_path1,'Deve existir ao menos a primeira imagem!'))
  	           return false;
				   
      if(!func_bl_isvazio(frm.even_img_path1)){
	         
			 if(frm.even_img_path1.value.lastIndexOf(".")<=0){
			     alert("O primeiro orquivo de imagem nao possui um nome ou uma extensao!");
				 frm.even_img_path1.focus();
			     return false;
			 }
			 else{
 		         //teste se a imagem 1 e a imagem 2 sao tipo *.jpg, *.gif, *.bmp, *.png	 
			     for(i in extensoes){
 			         // compara cada item do vetor, com o pedaco do nome do arquivo apartir do ultimo ponto (o da extensao)
			         if( extensoes[i] ==  frm.even_img_path1.value.toUpperCase().slice(frm.even_img_path1.value.lastIndexOf(".")+1) )
			            achou = true;
			     }
			  
 		         if(!achou){
		  	         alert("O primeiro arquivo nao eh um arquivo de imagem valido!");
			         frm.even_img_path1.focus();
					 return false;
                 }			 			  			  			 
	         }
	  }
	  
      
	  if(!func_bl_isvazio(frm.even_img_path2)){
	         
			 if(frm.even_img_path2.value.lastIndexOf(".")<=0){
			     alert("O segundo orquivo de imagem nao possui um nome ou uma extensao!");
				 frm.even_img_path2.focus();
			     return false;
			 }
			 else{
 		         
			     for(i in extensoes){
 			         // compara cada item do vetor, com o pedaco do nome do arquivo apartir do ultimo ponto (o da extensao)
			         if( extensoes[i] ==  frm.even_img_path2.value.toUpperCase().slice(frm.even_img_path2.value.lastIndexOf(".")+1) )
			            achou = true;
			     }
			  
 		         if(!achou){
		  	         alert("O segundo arquivo nao eh um arquivo de imagem valido!");
			         frm.even_img_path2.focus();
					 return false;
                 }			 			  			  			 
	         }
	  }	  
			 

	  if(func_bl_isvazio(frm.even_img_credito,'O credito da imagem precisa ser preenchido!'))
	      return false;		  		  
	  
      return true;
  }
  
  if(l_str_acao == '<?php echo K_EXCLUIR ?>'){
      if(confirm("A exclusao dessa imagem e irreversivel! \nTem certeza que deseja excluir?"))
          return true;
	  else
	    return false;	  
  }

}

</script>
<br>
<form name="frm_cad_imagem" method="post" enctype="multipart/form-data" action="rn_imagem.php" onSubmit="return frm_validar(this,'<?php echo $l_str_acao ?>');">
<input type="hidden" name="even_even_pk" value="<?php echo $even_even_pk ?>">
<input type="hidden" name="even_img_pk" value="<?php echo $l_obj_imagem->even_img_pk ?>">
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
		         <input type="text" name="even_img_titulo" size="40" value="<?php echo $l_obj_imagem->even_img_titulo; ?>"> 
		      <?php }else echo $l_obj_imagem->even_img_titulo; ?>  
			  
	          <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
			     <input type="checkbox" name="even_img_destaque" value="<?php K_ATIVO?>" class="check" <?php if($l_obj_imagem->even_img_destaque == K_ATIVO) echo " checked "; ?> ><b>Destaque</b> 
			  <?php }
			        else{
					  echo "<b>Destaque:</b> "; 
					  if($l_obj_imagem->even_img_destaque ==  K_ATIVO)
					     echo K_SIM;
					  else 
					     echo K_NAO;
				   }	 
			  ?>			</td>
		</tr>
	    
		<tr>
                    <td><b>Descri&ccedil;&atilde;o:</b></td>
			<td>
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <textarea name="even_img_descricao" cols="60" rows="4"><?php echo $l_obj_imagem->even_img_descricao; ?></textarea>
		      <?php }else echo $l_obj_imagem->even_img_descricao; ?>		   </td>
		</tr>
		<?php if($l_str_acao != K_INCLUIR ) {?>		
	    <tr>
		   <td><b>Data cadastro:</b></td>
		   <td>
		     <?php echo $l_obj_imagem->even_img_dt_cadastro; ?>		   </td>
		</tr>								
		<?php } ?>
	    <tr>
		   <td><b>Imagem 1:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		      <input type="file" name="even_img_path1" size="40" ><br>
			<?php } echo "<a id='link02' href=\"javascript:AbreJanela('ap_vis_imagem.php?l_str_arquivo=".$l_obj_imagem->even_img_path1."','Visualiza_Imagem','height=500, width=700, scrollbars=YES,resizable=yes')\">".substr($l_obj_imagem->even_img_path1,26)."</a>"; ?>		   </td>
		</tr>
	    <tr>
		   <td><b>Imagem 2:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		      <input type="file" name="even_img_path2" size="40"><br>
			<?php } echo "<a id='link02' href=\"javascript:AbreJanela('ap_vis_imagem.php?l_str_arquivo=".$l_obj_imagem->even_img_path2."','Visualiza_Imagem','height=500, width=700, scrollbars=YES,resizable=yes')\">".substr($l_obj_imagem->even_img_path2,26)."</a>"; ?>		   </td>
		</tr>														
	    <tr>
		   <td><b>Credito:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		      <input type="text" name="even_img_credito" size="40" value="<?php echo $l_obj_imagem->even_img_credito; ?>">
			<?php }else echo $l_obj_imagem->even_img_credito; ?>		   </td>
		</tr>						
		<tr><td colspan="2" align="center">
		 <br>
		 <?php if($l_str_acao != K_CONSULTAR) {?>
		   <input type="submit" value="<?php echo $l_str_acao ?> imagem">  
		 <?php }?>  
		 <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_imagem.php?even_even_pk=<?php echo $even_even_pk ?>&even_cat_pk=<?php echo $even_cat_pk ?>')">
        </td></tr>
	 </table>
  </td>
</tr>
</table>
<?php 
//fecha conexao com o banco
if($l_str_acao != K_INCLUIR) 
    $l_obj_imagem->dbconn->fechar();
?>	
</form>