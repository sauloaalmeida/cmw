<?php
include 'cl_imagem.php';

//captura o codigo da imagem (se existir)
if(isset($_REQUEST["news_img_pk"]))
   $news_img_pk = $_REQUEST["news_img_pk"];

//instancia o objeto de imagem
$l_obj_imagem = new Imagem;

//verifica qual a acao que vem da pagina anterior
if($l_str_acao == K_CONSULTAR || $l_str_acao == K_ALTERAR || $l_str_acao == K_EXCLUIR){

    if(!isset($_REQUEST["news_img_pk"]))
	      msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O código da notícia não foram postado para a pagina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");

    //cria conexao com o banco
    $l_obj_imagem->dbconn->conectar();
	
	//pega a noticia desejada
	$l_obj_imagem->getImagem($news_img_pk);
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

	  if(func_bl_isvazio(frm.news_img_titulo,'O Título da imagem precisa ser preenchido!'))
	      return false;
	  

	  if(func_bl_isvazio(frm.news_img_descricao,'A descrição da imagem precisa ser preenchido!'))
	      return false;		  
		  
      if(l_str_acao == '<?php echo K_INCLUIR ?>')
		  if(func_bl_isvazio(frm.news_img_path1,'Deve existir ao menos a primeira imagem!'))
  	           return false;
				   
      if(!func_bl_isvazio(frm.news_img_path1)){
	         
			 if(frm.news_img_path1.value.lastIndexOf(".")<=0){
			     alert("O primeiro orquivo de imagem nao possui um nome ou uma extensão!");
				 frm.news_img_path1.focus();
			     return false;
			 }
			 else{
 		         //teste se a imagem 1 e a imagem 2 sao tipo *.jpg, *.gif, *.bmp, *.png	 
			     for(i in extensoes){
 			         // compara cada item do vetor, com o pedaco do nome do arquivo apartir do ultimo ponto (o da extensao)
			         if( extensoes[i] ==  frm.news_img_path1.value.toUpperCase().slice(frm.news_img_path1.value.lastIndexOf(".")+1) )
			            achou = true;
			     }
			  
 		         if(!achou){
		  	         alert("O primeiro arquivo não eh um arquivo de imagem válido!");
			         frm.news_img_path1.focus();
					 return false;
                 }			 			  			  			 
	         }
	  }
	  
      
	  if(!func_bl_isvazio(frm.news_img_path2)){
	         
			 if(frm.news_img_path2.value.lastIndexOf(".")<=0){
			     alert("O segundo orquivo de imagem nao possui um nome ou uma extensão!");
				 frm.news_img_path2.focus();
			     return false;
			 }
			 else{
 		         
			     for(i in extensoes){
 			         // compara cada item do vetor, com o pedaco do nome do arquivo apartir do ultimo ponto (o da extensao)
			         if( extensoes[i] ==  frm.news_img_path2.value.toUpperCase().slice(frm.news_img_path2.value.lastIndexOf(".")+1) )
			            achou = true;
			     }
			  
 		         if(!achou){
		  	         alert("O segundo arquivo não eh um arquivo de imagem válido!");
			         frm.news_img_path2.focus();
					 return false;
                 }			 			  			  			 
	         }
	  }	  
			 

	  if(func_bl_isvazio(frm.news_img_credito,'O crédito da imagem precisa ser preenchido!'))
	      return false;		  		  
	  
      return true;
  }
  
  if(l_str_acao == '<?php echo K_EXCLUIR ?>'){
      if(confirm("A exclusão dessa imagem é irreversivel! \nTem certeza que deseja excluir?"))
          return true;
	  else
	    return false;	  
  }

}

</script>
<br>
<form name="frm_cad_imagem" method="post" enctype="multipart/form-data" action="rn_imagem.php" onSubmit="return frm_validar(this,'<?php echo $l_str_acao ?>');">
<input type="hidden" name="news_not_pk" value="<?php echo $news_not_pk ?>">
<input type="hidden" name="news_img_pk" value="<?php echo $l_obj_imagem->news_img_pk ?>">
<input type="hidden" name="news_cat_fk" value="<?php echo $news_cat_pk ?>">
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
		         <input type="text" name="news_img_titulo" size="40" value="<?php echo $l_obj_imagem->news_img_titulo; ?>"> 
		      <?php }else echo $l_obj_imagem->news_img_titulo; ?>  
			  
	          <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
			     <input type="checkbox" name="news_img_destaque" value="<?php K_ATIVO?>" class="check" <?php if($l_obj_imagem->news_img_destaque == K_ATIVO) echo " checked "; ?> ><b>Destaque</b> 
			  <?php }
			        else{
					  echo "<b>Destaque:</b> "; 
					  if($l_obj_imagem->news_img_destaque ==  K_ATIVO)
					     echo K_SIM;
					  else 
					     echo K_NAO;
				   }	 
			  ?>			</td>
		</tr>
	    
		<tr>
		    <td><b>Descricão:</b></td>
			<td>
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <textarea name="news_img_descricao" cols="60" rows="4"><?php echo $l_obj_imagem->news_img_descricao; ?></textarea>
		      <?php }else echo $l_obj_imagem->news_img_descricao; ?>		   </td>
		</tr>
		<?php if($l_str_acao != K_INCLUIR ) {?>		
	    <tr>
		   <td><b>Data cadastro:</b></td>
		   <td>
		     <?php echo $l_obj_imagem->news_img_dt_cadastro; ?>		   </td>
		</tr>								
		<?php } ?>
	    <tr>
		   <td><b>Imagem 1:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		      <input type="file" name="news_img_path1" size="40" ><br>
			<?php } echo "<a id='link02' href=\"javascript:AbreJanela('ap_vis_imagem.php?l_str_arquivo=".$l_obj_imagem->news_img_path1."','Visualiza_Imagem','height=500, width=700, scrollbars=YES,resizable=yes')\">".substr($l_obj_imagem->news_img_path1,26)."</a>"; ?>		   </td>
		</tr>
	    <tr>
		   <td><b>Imagem 2:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		      <input type="file" name="news_img_path2" size="40"><br>
			<?php } echo "<a id='link02' href=\"javascript:AbreJanela('ap_vis_imagem.php?l_str_arquivo=".$l_obj_imagem->news_img_path2."','Visualiza_Imagem','height=500, width=700, scrollbars=YES,resizable=yes')\">".substr($l_obj_imagem->news_img_path2,26)."</a>"; ?>		   </td>
		</tr>														
	    <tr>
		   <td><b>Credito:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		      <input type="text" name="news_img_credito" size="40" value="<?php echo $l_obj_imagem->news_img_credito; ?>">
			<?php }else echo $l_obj_imagem->news_img_credito; ?>		   </td>
		</tr>						
		<tr><td colspan="2" align="center">
		 <br>
		 <?php if($l_str_acao != K_CONSULTAR) {?>
		   <input type="submit" value="<?php echo $l_str_acao ?> imagem">  
		 <?php }?>  
		 <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_imagem.php?news_not_pk=<?php echo $news_not_pk ?>&news_cat_pk=<?php echo $news_cat_pk ?>')">
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