<?php

//captura o codigo da noticia (se existir)
if(isset($_REQUEST["news_not_pk"]))
   $news_not_pk = $_REQUEST["news_not_pk"];

//instancia o objeto de noticias
$l_obj_noticia = new Noticia;

//cria conexao com o banco
$l_obj_noticia->dbconn->conectar();

if($l_obj_noticia->GetExisteCategoriasFilhas($news_cat_pk)){
    $l_obj_noticia->dbconn->fechar();
    exit("<center><br><br><span class='tx_msg_erro'>Nao &eacute; poss&iacute;vel cadastrar not&iacute;cias nessa categoria, pois ela possui categorias filhas!</span></center>");
}


//verifica qual a acao que vem da pagina anterior
if($l_str_acao == K_CONSULTAR || $l_str_acao == K_ALTERAR || $l_str_acao == K_EXCLUIR){

    if(!isset($_REQUEST["news_not_pk"]))
	      msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O codigo da not�cia n�o foram postado para a pagina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");
	
	//pega a noticia desejada
	$l_obj_noticia->getNoticia($news_not_pk);
}



//cria as variaveis da data
//separa as datas das horas
list ($l_dt_inicio,$l_hr_inicio) = split(' ', $l_obj_noticia->news_not_dt_inicio);
list ($l_dt_fim,$l_hr_fim) = split(' ', $l_obj_noticia->news_not_dt_fim);

//separa dia mes ano
list ($l_int_dia_inicio, $l_int_mes_inicio, $l_int_ano_inicio) = split('[/.-]', $l_dt_inicio);
list ($l_int_dia_fim, $l_int_mes_fim, $l_int_ano_fim) = split ('[/.-]', $l_dt_fim);

//separa hora minuto segundo
list($l_int_hora_inicio, $l_int_min_inicio) = split (':', $l_hr_inicio);
list($l_int_hora_fim, $l_int_min_fim) = split (':', $l_hr_fim);

?>
<script language="JavaScript" type="text/javascript">

function habilitaChamada(obj) {
	if (obj.checked) {
		document.getElementById("news_not_chamada").disabled=false;
	}
	else {
		document.getElementById("news_not_chamada").value="";
		document.getElementById("news_not_chamada").disabled=true;
	}
	return true;
}


function frm_validar(frm,l_str_acao,l_fl_status_noticia){

   

  if( (l_str_acao == '<?php echo K_INCLUIR ?>') || (l_str_acao == '<?php echo K_ALTERAR ?>') ){

      frm.news_not_status.value = l_fl_status_noticia;

        var oEditor = FCKeditorAPI.GetInstance('news_not_corpo');
        var newsNotCorpo = oEditor.GetXHTML();


	  if(func_bl_isvazio(frm.news_not_titulo,'O Titulo da noticia precisa ser preenchido!'))
	      return false;
		  
      if(frm.news_not_destaque.checked){
	      if(func_bl_isvazio(frm.news_not_chamada,'A chamada da noticia deve ser preenchida quando for de destaque!'))
	      return false;		  
	  }
	      
	  if(func_str_trim(newsNotCorpo)==""){
	      alert("O Corpo da noticia precisa ser preenchido!")
	      return false;		  
	  }
	  
	  if(func_bl_isvazio(frm.news_not_origem,'A Origem da noticia precisa ser preenchida!'))
	      return false;		  
		  
	  if(func_bl_isvazio(frm.news_not_autor,'O Autor da noticia precisa ser preenchido!'))
	      return false;		  		  
		 
	  if(!compara_data(frm.l_int_dia_inicio.value,frm.l_int_mes_inicio.value,frm.l_int_ano_inicio.value,frm.l_int_dia_fim.value,frm.l_int_mes_fim.value,frm.l_int_ano_fim.value,"A [Data Final] da publicacao deve ser maior que a [Data Inicial]"))
	     return false;	  

      frm.submit();
  }
  
  if(l_str_acao == '<?php echo K_EXCLUIR ?>'){
      if(confirm("A exclusao dessa noticia e irreversivel e era excluir todas as imagens e anexos associados a ela. \nTem certeza que deseja excluir?"))
          frm.submit();
	  else
	    return false;	  
  }

}

</script>
<br>
<form name="frm_cad_noticia" method="post" action="rn_noticia.php">
<input type="hidden" name="news_not_pk" value="<?php echo $l_obj_noticia->news_not_pk ?>">
<input type="hidden" name="news_cat_fk" value="<?php echo $news_cat_pk ?>">
<input type="hidden" name="l_str_acao" value="<?php echo $l_str_acao ?>">
<input type="hidden" name="news_not_status" value="">
<table width="750" align="center">
<tr>
  <td align="center">
     <table width="730" border="0" align="center">
	    
		<tr>
		    <td width="100"><b>Titulo:</b></td>
			<td width="630">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="news_not_titulo" size="60" value="<?php echo $l_obj_noticia->news_not_titulo; ?>"> 
		      <?php }else echo $l_obj_noticia->news_not_titulo; ?>
		      &nbsp;&nbsp;&nbsp;
			  <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
			     <input type="checkbox" name="news_not_destaque" value="<?php K_ATIVO?>" class="check" <?php if($l_obj_noticia->news_not_destaque == K_ATIVO) echo " checked "; ?> onclick="javascript: habilitaChamada(this);"><b>Destaque</b> 
			  <?php }
			        else{
					  echo "<b>Destaque:</b> "; 
					  if($l_obj_noticia->news_not_destaque ==  K_ATIVO)
					     echo K_SIM;
					  else 
					     echo K_NAO;
				   }	 
			  ?>	 
			</td>
		</tr>

		<tr>
		    <td><b>Chamada:</b></td>
			<td>
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <textarea name="news_not_chamada" id="news_not_chamada" cols="127" rows="3"><?php echo $l_obj_noticia->news_not_chamada; ?></textarea>
			     <script language="JavaScript" type="text/javascript">
				    if (!document.all.news_not_destaque.checked)
					    document.all.news_not_chamada.disabled=true;
				 </script>				 
		      <?php }else echo $l_obj_noticia->news_not_chamada; ?>
		   </td>
		</tr>
	    <tr><td colspan="2"><b>Corpo:</b></td></tr>
		<tr>
		    <td colspan="2">
			 <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {
                         
                         	   $oFCKeditor = new FCKeditor('news_not_corpo') ;
				   $oFCKeditor->BasePath = '../nucleo/fckeditor/' ;

                                    //configuracoes
                                   //$oFCKeditor->Config['EnterMode'] = 'br';
				   $oFCKeditor->Height='380';

				   $oFCKeditor->Value = $l_obj_noticia->news_not_corpo ;
				   $oFCKeditor->Create() ;
                         ?>
			 <?php }else echo $l_obj_noticia->news_not_corpo; ?>
	        </td>
		</tr>
		
		<tr>
		    <td><b>Link:</b></td>
			<td>
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="news_not_link" size="60" value="<?php echo $l_obj_noticia->news_not_link; ?>"> (opcional) 
				 &nbsp;&nbsp;&nbsp;&nbsp;
				 <b>Abrir: </b><select name="news_not_target">
				    <option value="_self" <?php if($l_obj_noticia->news_not_target=="_self") echo 'selected';?>>na mesma janela</option>
					<option value="_blank" <?php if($l_obj_noticia->news_not_target=="_blank") echo 'selected';?>>em nova janela</option>
				 </select>
		      <?php }else{
 			               echo $l_obj_noticia->news_not_link." ";
						   if($l_obj_noticia->news_not_target == "_self")  
						       echo "Na mesma janela";
						   else
						       echo "Em nova janela";
						 }
			  ?>
		   </td>
		</tr>
		
		<?php if($l_str_acao != K_INCLUIR ) {?>		
	    <tr>
		    <td><b>Publicado por:</b></td>
		   <td>
		     <?php echo $l_obj_noticia->getNomeResponsavel(); ?>
		   </td>
		</tr>								
		<?php } ?>
	    <tr>
		   <td><b>Origem:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
	      		      <input type="text" name="news_not_origem" size="60" <?php echo " value='".$l_obj_noticia->news_not_origem."'";?>>
			<?php }else echo $l_obj_noticia->news_not_origem; ?>  

			&nbsp;&nbsp;&nbsp;<b>Idioma:</b>

			<?php 
				//instancia o objeto de idiomas
				$l_obj_idioma = new Idioma;

				//conecta com o banco para idioma
				$l_obj_idioma->dbconn->conectar();
			?>

		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
				<select name="idi_idioma_fk">

				<?php
					$rsIdiomas = $l_obj_idioma->getIdiomas();
					while ( $rsIdiomaTemp = $l_obj_idioma->dbconn->getRecordsetArray($rsIdiomas) ) {
						if($rsIdiomaTemp["idi_idioma_pk"] == $l_obj_noticia->idi_idioma_fk)
							echo "<option value='".$rsIdiomaTemp["idi_idioma_pk"]."' selected >".$rsIdiomaTemp["idi_nome"]."</option>";
						else
							echo "<option value='".$rsIdiomaTemp["idi_idioma_pk"]."' >".$rsIdiomaTemp["idi_nome"]."</option>";
					}
				?>

				</select>
			<?php }else echo $l_obj_idioma->getNomeIdioma($l_obj_noticia->idi_idioma_fk); ?>  

			<?php $l_obj_idioma->dbconn->fechar(); ?>

		   </td>
		</tr>
	    <tr>
		   <td><b>Autor:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		      <input type="text" name="news_not_autor" size="60" <?php if($l_str_acao == K_INCLUIR) echo " value='".$l_str_nome."'"; else echo " value='".$l_obj_noticia->news_not_autor."'";?>>
			<?php }else echo $l_obj_noticia->news_not_autor; ?>  
		   </td>
		</tr>		
		<?php if($l_str_acao != K_INCLUIR ) {?>		
	    <tr>
		   <td><b>Dt Criacao:</b></td>
		   <td>
		     <?php echo $l_obj_noticia->news_not_dt_criacao; ?>
		   </td>
		</tr>								
		<?php } ?>
               	</tr>
                <tr>
		   <td><b>Dt Inicio:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>		   
		     <select name="l_int_dia_inicio">
			   <?php for($i=1;$i<=31;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_dia_inicio == $i) echo " selected "; ?> ><?php echo func_str_completa_esquerda($i,2,"0") ?></option>			   
			   <?php } ?>			   			   
			  </select> /
			  
			  <select name="l_int_mes_inicio">
			   <option value="1" <?php if($l_int_mes_inicio == 1) echo " selected "; ?>>Jan</option>
			   <option value="2" <?php if($l_int_mes_inicio == 2) echo " selected "; ?>>Fev</option>
			   <option value="3" <?php if($l_int_mes_inicio == 3) echo " selected "; ?>>Mar</option>
			   <option value="4" <?php if($l_int_mes_inicio == 4) echo " selected "; ?>>Abr</option>
			   <option value="5" <?php if($l_int_mes_inicio == 5) echo " selected "; ?>>Mai</option>
			   <option value="6" <?php if($l_int_mes_inicio == 6) echo " selected "; ?>>Jun</option>
			   <option value="7" <?php if($l_int_mes_inicio == 7) echo " selected "; ?>>Jul</option>
			   <option value="8" <?php if($l_int_mes_inicio == 8) echo " selected "; ?>>Ago</option>
			   <option value="9" <?php if($l_int_mes_inicio == 9) echo " selected "; ?>>Set</option>
			   <option value="10" <?php if($l_int_mes_inicio == 10) echo " selected "; ?>>Out</option>
			   <option value="11" <?php if($l_int_mes_inicio == 11) echo " selected "; ?>>Nov</option>			   			   			   			   			   			   			   			   
			   <option value="12" <?php if($l_int_mes_inicio == 12) echo " selected "; ?>>Dez</option>			   
			  </select> /
			  
			  <select name="l_int_ano_inicio">			  
               <?php for($i=date("Y",time())-2;$i<=date("Y",time())+5;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_ano_inicio == $i) echo " selected "; ?>><?php echo $i ?></option>			   
			   <?php } ?>               
			 </select> <b>Hora:</b>
			 
			 <select name="l_int_hora_inicio">
			   <?php for($i=0;$i<=23;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_hora_inicio == $i) echo " selected "; ?>><?php echo func_str_completa_esquerda($i,2,"0") ?></option>			   
			   <?php } ?>
			 </select>: 
			 
			 <select name="l_int_min_inicio">			 
			   			   <?php for($i=0;$i<=59;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_min_inicio == $i)echo " selected "; ?>><?php echo func_str_completa_esquerda($i,2,"0") ?></option>			   
			   <?php } ?>
             </select>
			<?php }else echo $l_obj_noticia->news_not_dt_inicio; ?>  			 
		   </td>
		</tr>
	    <tr>
		   <td><b>Dt Fim:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>		   		   
		     <select name="l_int_dia_fim">
			   <?php for($i=1;$i<=31;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_dia_fim == $i) echo " selected "; ?>><?php echo func_str_completa_esquerda($i,2,"0") ?></option>			   
			   <?php } ?>			   			   
			  </select> /
			  
			  <select name="l_int_mes_fim">
			   <option value="1" <?php if($l_int_mes_fim == 1) echo " selected "; ?>>Jan</option>
			   <option value="2" <?php if($l_int_mes_fim == 2) echo " selected "; ?>>Fev</option>
			   <option value="3" <?php if($l_int_mes_fim == 3) echo " selected "; ?>>Mar</option>
			   <option value="4" <?php if($l_int_mes_fim == 4) echo " selected "; ?>>Abr</option>
			   <option value="5" <?php if($l_int_mes_fim == 5) echo " selected "; ?>>Mai</option>
			   <option value="6" <?php if($l_int_mes_fim == 6) echo " selected "; ?>>Jun</option>
			   <option value="7" <?php if($l_int_mes_fim == 7) echo " selected "; ?>>Jul</option>
			   <option value="8" <?php if($l_int_mes_fim == 8) echo " selected "; ?>>Ago</option>
			   <option value="9" <?php if($l_int_mes_fim == 9) echo " selected "; ?>>Set</option>
			   <option value="10" <?php if($l_int_mes_fim == 10) echo " selected "; ?>>Out</option>
			   <option value="11" <?php if($l_int_mes_fim == 11) echo " selected "; ?>>Nov</option>			   			   			   			   			   			   			   			   
			   <option value="12" <?php if($l_int_mes_fim == 12) echo " selected "; ?>>Dez</option>			   
			  </select> / 
			  
			  <select name="l_int_ano_fim">			  
               <?php for($i=date("Y",time())-2;$i<=date("Y",time())+5;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_ano_fim == $i) echo " selected "; ?>><?php echo $i ?></option>			   
			   <?php } ?>               
			 </select> <b>Hora:</b>
			 
			 <select name="l_int_hora_fim">
			   <?php for($i=0;$i<=23;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_hora_fim == $i) echo " selected "; ?>><?php echo func_str_completa_esquerda($i,2,"0") ?></option>			   
			   <?php } ?>
			 </select>: 
			 
			 <select name="l_int_min_fim">			 
			   <?php for($i=0;$i<=59;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_min_fim == $i) echo " selected "; ?>><?php echo func_str_completa_esquerda($i,2,"0") ?></option>			   
			   <?php } ?>
             </select>			 			  		   
			<?php }else echo $l_obj_noticia->news_not_dt_fim; ?>  			 			 
		   </td>
		</tr>
		<?php if($l_str_acao != K_INCLUIR ) {?>
                <tr>
		   <td><b>URL interna:</b></td>
		   <td>
		     <?php echo "<a href='".$l_obj_noticia->news_cat_url.$l_obj_noticia->news_not_pk."' target='_blank'>".$l_obj_noticia->news_cat_url.$l_obj_noticia->news_not_pk."</a>"; ?>
		   </td>
		</tr>
                <tr>
		   <td><b>URL externa:</b></td>
		   <td>
		     <?php echo "<a href='".K_SITE_URL_COMPLETA.$l_obj_noticia->news_cat_url.$l_obj_noticia->news_not_pk."' target='_blank'>".K_SITE_URL_COMPLETA.$l_obj_noticia->news_cat_url.$l_obj_noticia->news_not_pk."</a>"; ?>
		   </td>
		</tr>                
		<?php } ?>
		<tr><td colspan="2" align="center">
		 <br>
 	     <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>		   		   
		   <input type="button" value="<?php if($l_str_acao == K_INCLUIR) echo "Publicar"; else echo "Alterar" ?> Noticia" onclick="javascript:frm_validar(frm_cad_noticia,'<?php echo $l_str_acao; ?>','<?php echo K_ATIVO; ?>')">
		   <input type="button" value="<?php if($l_str_acao == K_INCLUIR) echo "Salvar como"; else echo "Alterar para" ?> Rascunho" onclick="javascript:frm_validar(frm_cad_noticia,'<?php echo $l_str_acao; ?>','<?php echo K_RASCUNHO; ?>')"> 
		 <?php } 
		       if($l_str_acao == K_EXCLUIR){ ?>  
		   <input type="button" value="Excluir Noticia" onclick="javascript:frm_validar(frm_cad_noticia,'<?php echo $l_str_acao; ?>','<?php echo K_INATIVO; ?>')">
		 <?php } ?> 
		 <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_noticia.php?news_cat_pk=<?php echo $news_cat_pk ?>')">		 
        </td></tr>
	 </table>
  </td>
</tr>
</table>
<?php 
//fecha conexao com o banco
if($l_str_acao != K_INCLUIR) 
    $l_obj_noticia->dbconn->fechar();
?>	
</form>
