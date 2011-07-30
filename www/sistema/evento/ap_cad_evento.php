<?php

//captura o codigo da evento (se existir)
$even_even_pk = NULL;
if(isset($_REQUEST["even_even_pk"]))
   $even_even_pk = $_REQUEST["even_even_pk"];

//instancia o objeto de eventos
$l_obj_evento = new Evento;

//cria conexao com o banco
$l_obj_evento->dbconn->conectar();


//verifica qual a acao que vem da pagina anterior
if($l_str_acao == K_CONSULTAR || $l_str_acao == K_ALTERAR || $l_str_acao == K_EXCLUIR){

    if(!isset($_REQUEST["even_even_pk"]))
	      msg(K_MSGERRO, K_VOLTAR, "Falta de par&acirc;metros", "O c&aacute;digo da not&iacute;cia n&atilde;o foram postado para a p&aacute;gina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");
	
	//pega a evento desejada
	$l_obj_evento->getEvento($even_even_pk);
}



//cria as variaveis da data
//separa as datas das horas
list ($l_dt_inicio_publicacao,$l_hr_inicio_publicacao) = split(' ', $l_obj_evento->even_even_dt_inicio_publicacao);
list ($l_dt_fim_publicacao,$l_hr_fim_publicacao) = split(' ', $l_obj_evento->even_even_dt_fim_publicacao);


//separa dia mes ano
list ($l_int_dia_inicio_publicacao, $l_int_mes_inicio_publicacao, $l_int_ano_inicio_publicacao) = split('[/.-]', $l_dt_inicio_publicacao);
list ($l_int_dia_fim_publicacao, $l_int_mes_fim_publicacao, $l_int_ano_fim_publicacao) = split ('[/.-]', $l_dt_fim_publicacao);
list ($l_int_dia_inicio, $l_int_mes_inicio, $l_int_ano_inicio) = split('[/.-]', $l_obj_evento->even_even_dt_inicio);
list ($l_int_dia_fim, $l_int_mes_fim, $l_int_ano_fim) = split ('[/.-]', $l_obj_evento->even_even_dt_fim);


//separa hora minuto segundo
list($l_int_hora_inicio_publicacao, $l_int_min_inicio_publicacao) = split (':', $l_hr_inicio_publicacao);
list($l_int_hora_fim_publicacao, $l_int_min_fim_publicacao) = split (':', $l_hr_fim_publicacao);

?>
<script language="JavaScript" type="text/javascript">


function frm_validar(frm,l_str_acao,l_fl_status_evento){

   

  if( (l_str_acao == '<?php echo K_INCLUIR ?>') || (l_str_acao == '<?php echo K_ALTERAR ?>') ){

      frm.even_even_status.value = l_fl_status_evento;

        var oEditor = FCKeditorAPI.GetInstance('even_even_corpo');
        var newsNotCorpo = oEditor.GetXHTML();


	  if(func_bl_isvazio(frm.even_even_nome,'O Nome da evento precisa ser preenchido!'))
	      return false;
	      
	  if(func_str_trim(newsNotCorpo)==""){
	      alert("O Corpo da evento precisa ser preenchido!")
	      return false;		  
	  }
	  		  
	  if(!compara_data(frm.l_int_dia_inicio.value,frm.l_int_mes_inicio.value,frm.l_int_ano_inicio.value,frm.l_int_dia_fim.value,frm.l_int_mes_fim.value,frm.l_int_ano_fim.value,"A [Data Final] do evento deve ser maior que a [Data Inicial]"))
	     return false;

	  if(!compara_data(frm.l_int_dia_inicio_publicacao.value,frm.l_int_mes_inicio_publicacao.value,frm.l_int_ano_inicio_publicacao.value,frm.l_int_dia_fim_publicacao.value,frm.l_int_mes_fim_publicacao.value,frm.l_int_ano_fim_publicacao.value,"A [Data Final] da publicacao do evento deve ser maior que a [Data Inicial]"))
	     return false;

      frm.submit();
  }
  
  if(l_str_acao == '<?php echo K_EXCLUIR ?>'){
      if(confirm("A exclusao dessa evento e irreversivel e era excluir todas as imagens e anexos associados a ela. \nTem certeza que deseja excluir?"))
          frm.submit();
	  else
	    return false;	  
  }

}

</script>
<br>
<form name="frm_cad_evento" method="post" action="rn_evento.php">
<input type="hidden" name="even_even_pk" value="<?php echo $l_obj_evento->even_even_pk ?>">
<input type="hidden" name="l_str_acao" value="<?php echo $l_str_acao ?>">
<input type="hidden" name="even_even_status" value="">
<table width="750" align="center">
<tr>
  <td align="center">
     <table width="730" border="0" align="center">
	    
		<tr>
		    <td width="100"><b>Nome:</b></td>
			<td width="630">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
                            <input type="text" name="even_even_nome" size="60" maxlength="100" value="<?php echo $l_obj_evento->even_even_nome; ?>">
		      <?php }else echo $l_obj_evento->even_even_nome; ?>
		      &nbsp;&nbsp;&nbsp;
			  <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
			     <input type="checkbox" name="even_even_destaque" value="<?php K_ATIVO?>" class="check" <?php if($l_obj_evento->even_even_destaque == K_ATIVO) echo " checked "; ?> ><b>Destaque</b>
			  <?php }
			        else{
					  echo "<b>Destaque:</b> "; 
					  if($l_obj_evento->even_even_destaque ==  K_ATIVO)
					     echo K_SIM;
					  else 
					     echo K_NAO;
				   }	 
			  ?>	 
			</td>
		</tr>
                <tr>
                    <td><b>Tipo de evento:</b></td>
                    <td>
                        <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
                        <input type="radio" name="even_even_tipo" value="<?php echo K_EVENTO_INTERNO ?>" class="check" <?php if($l_obj_evento->even_even_tipo == K_EVENTO_INTERNO || $l_str_acao == K_INCLUIR) echo " checked "; ?> >Evento interno &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="even_even_tipo" value="<?php echo K_EVENTO_EXTERNO ?>" class="check" <?php if($l_obj_evento->even_even_tipo == K_EVENTO_EXTERNO) echo " checked "; ?> >Evento externo
                        <?php } else echo ($l_obj_evento->even_even_tipo == K_EVENTO_INTERNO)?"Interno":"Externo"; ?>
                    </td>
                </tr>

                <tr>
                    <td><b>Inscri&ccedil;&atilde;o:</b></td>
                    <td>
                        <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
                        <input type="radio" name="even_even_inscricao" value="<?php echo K_ATIVO ?>" class="check" <?php if($l_obj_evento->even_even_inscricao == K_ATIVO || $l_str_acao == K_INCLUIR) echo " checked "; ?> >Com inscri&ccedil;&atilde;o &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="even_even_inscricao" value="<?php echo K_INATIVO ?>" class="check" <?php if($l_obj_evento->even_even_inscricao == K_INATIVO) echo " checked "; ?> >Sem inscri&ccedil;&atilde;ão
                        <?php } else echo ($l_obj_evento->even_even_inscricao == K_ATIVO)?"Com inscri&ccedil;&atilde;o":"Sem inscri&ccedil;&atilde;o"; ?>
                    </td>
                </tr>

		<tr>
		    <td><b>Chamada:</b></td>
			<td>
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <textarea name="even_even_chamada" id="even_even_chamada" cols="127" rows="3"><?php echo $l_obj_evento->even_even_chamada; ?></textarea>			     
		      <?php }else echo $l_obj_evento->even_even_chamada; ?>
		   </td>
		</tr>
	    <tr><td colspan="2"><b>Corpo:</b></td></tr>
		<tr>
		    <td colspan="2">
			 <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {
                         
                         	   $oFCKeditor = new FCKeditor('even_even_corpo') ;
				   $oFCKeditor->BasePath = '../nucleo/fckeditor/' ;

                                    //configuracoes
                                   //$oFCKeditor->Config['EnterMode'] = 'br';
				   $oFCKeditor->Height='380';

				   $oFCKeditor->Value = $l_obj_evento->even_even_corpo ;
				   $oFCKeditor->Create() ;
                         ?>
			 <?php }else echo $l_obj_evento->even_even_corpo; ?>
	        </td>
		</tr>
		
		<tr>
		    <td><b>Link:</b></td>
			<td>
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="even_even_link" size="60" value="<?php echo $l_obj_evento->even_even_link; ?>"> (opcional)
			<?                        
                        }else echo $l_obj_evento->even_even_link;
                       ?>
		   </td>
		</tr>
		

	    <tr>
		   <td><b>Dt Inicio evento:</b></td>
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
			 </select> 			 
			 
			<?php }else echo $l_obj_evento->even_even_dt_inicio; ?>
		   </td>
		</tr>
	    <tr>
                <td><b>Dt Fim evento:</b></td>
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
			 </select>  
		      <?php }else echo $l_obj_evento->even_even_dt_fim; ?>
		   </td>
		</tr>


                <tr>
		   <td><b>Dt Inicio publica&ccedil;&atilde;o:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>		   
		     <select name="l_int_dia_inicio_publicacao">
			   <?php for($i=1;$i<=31;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_dia_inicio_publicacao == $i) echo " selected "; ?> ><?php echo func_str_completa_esquerda($i,2,"0") ?></option>
			   <?php } ?>			   			   
			  </select> /
			  
			  <select name="l_int_mes_inicio_publicacao">
			   <option value="1" <?php if($l_int_mes_inicio_publicacao == 1) echo " selected "; ?>>Jan</option>
			   <option value="2" <?php if($l_int_mes_inicio_publicacao == 2) echo " selected "; ?>>Fev</option>
			   <option value="3" <?php if($l_int_mes_inicio_publicacao == 3) echo " selected "; ?>>Mar</option>
			   <option value="4" <?php if($l_int_mes_inicio_publicacao == 4) echo " selected "; ?>>Abr</option>
			   <option value="5" <?php if($l_int_mes_inicio_publicacao == 5) echo " selected "; ?>>Mai</option>
			   <option value="6" <?php if($l_int_mes_inicio_publicacao == 6) echo " selected "; ?>>Jun</option>
			   <option value="7" <?php if($l_int_mes_inicio_publicacao == 7) echo " selected "; ?>>Jul</option>
			   <option value="8" <?php if($l_int_mes_inicio_publicacao == 8) echo " selected "; ?>>Ago</option>
			   <option value="9" <?php if($l_int_mes_inicio_publicacao == 9) echo " selected "; ?>>Set</option>
			   <option value="10" <?php if($l_int_mes_inicio_publicacao == 10) echo " selected "; ?>>Out</option>
			   <option value="11" <?php if($l_int_mes_inicio_publicacao == 11) echo " selected "; ?>>Nov</option>
			   <option value="12" <?php if($l_int_mes_inicio_publicacao == 12) echo " selected "; ?>>Dez</option>
			  </select> /
			  
			  <select name="l_int_ano_inicio_publicacao">
               <?php for($i=date("Y",time())-2;$i<=date("Y",time())+5;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_ano_inicio_publicacao == $i) echo " selected "; ?>><?php echo $i ?></option>
			   <?php } ?>               
			 </select> <b>Hora:</b>
			 
			 <select name="l_int_hora_inicio_publicacao">
			   <?php for($i=0;$i<=23;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_hora_inicio_publicacao == $i) echo " selected "; ?>><?php echo func_str_completa_esquerda($i,2,"0") ?></option>
			   <?php } ?>
			 </select>: 
			 
			 <select name="l_int_min_inicio_publicacao">
			   			   <?php for($i=0;$i<=59;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_min_inicio_publicacao == $i)echo " selected "; ?>><?php echo func_str_completa_esquerda($i,2,"0") ?></option>
			   <?php } ?>
             </select>
			<?php }else echo $l_obj_evento->even_even_dt_inicio_publicacao; ?>
		   </td>
		</tr>
	    <tr>
                <td><b>Dt Fim publica&ccedil;&atilde;o:</b></td>
		   <td>
		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>		   		   
		     <select name="l_int_dia_fim_publicacao">
			   <?php for($i=1;$i<=31;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_dia_fim_publicacao == $i) echo " selected "; ?>><?php echo func_str_completa_esquerda($i,2,"0") ?></option>
			   <?php } ?>			   			   
			  </select> /
			  
			  <select name="l_int_mes_fim_publicacao">
			   <option value="1" <?php if($l_int_mes_fim_publicacao == 1) echo " selected "; ?>>Jan</option>
			   <option value="2" <?php if($l_int_mes_fim_publicacao == 2) echo " selected "; ?>>Fev</option>
			   <option value="3" <?php if($l_int_mes_fim_publicacao == 3) echo " selected "; ?>>Mar</option>
			   <option value="4" <?php if($l_int_mes_fim_publicacao == 4) echo " selected "; ?>>Abr</option>
			   <option value="5" <?php if($l_int_mes_fim_publicacao == 5) echo " selected "; ?>>Mai</option>
			   <option value="6" <?php if($l_int_mes_fim_publicacao == 6) echo " selected "; ?>>Jun</option>
			   <option value="7" <?php if($l_int_mes_fim_publicacao == 7) echo " selected "; ?>>Jul</option>
			   <option value="8" <?php if($l_int_mes_fim_publicacao == 8) echo " selected "; ?>>Ago</option>
			   <option value="9" <?php if($l_int_mes_fim_publicacao == 9) echo " selected "; ?>>Set</option>
			   <option value="10" <?php if($l_int_mes_fim_publicacao == 10) echo " selected "; ?>>Out</option>
			   <option value="11" <?php if($l_int_mes_fim_publicacao == 11) echo " selected "; ?>>Nov</option>
			   <option value="12" <?php if($l_int_mes_fim_publicacao == 12) echo " selected "; ?>>Dez</option>
			  </select> / 
			  
			  <select name="l_int_ano_fim_publicacao">
               <?php for($i=date("Y",time())-2;$i<=date("Y",time())+5;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_ano_fim_publicacao == $i) echo " selected "; ?>><?php echo $i ?></option>
			   <?php } ?>               
			 </select> <b>Hora:</b>
			 
			 <select name="l_int_hora_fim_publicacao">
			   <?php for($i=0;$i<=23;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_hora_fim_publicacao == $i) echo " selected "; ?>><?php echo func_str_completa_esquerda($i,2,"0") ?></option>
			   <?php } ?>
			 </select>: 
			 
			 <select name="l_int_min_fim_publicacao">
			   <?php for($i=0;$i<=59;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_min_fim_publicacao == $i) echo " selected "; ?>><?php echo func_str_completa_esquerda($i,2,"0") ?></option>
			   <?php } ?>
             </select>			 			  		   
			<?php }else echo $l_obj_evento->even_even_dt_fim_publicacao; ?>
		   </td>
		</tr>
		<tr><td colspan="2" align="center">
		 <br>
 	     <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>		   		   
		   <input type="button" value="<?php if($l_str_acao == K_INCLUIR) echo "Publicar"; else echo "Alterar" ?> Evento" onclick="javascript:frm_validar(frm_cad_evento,'<?php echo $l_str_acao; ?>','<?php echo K_ATIVO; ?>')">
		   <input type="button" value="<?php if($l_str_acao == K_INCLUIR) echo "Salvar como"; else echo "Alterar para" ?> Rascunho" onclick="javascript:frm_validar(frm_cad_evento,'<?php echo $l_str_acao; ?>','<?php echo K_RASCUNHO; ?>')">
		 <?php } 
		       if($l_str_acao == K_EXCLUIR){ ?>  
		   <input type="button" value="Excluir Evento" onclick="javascript:frm_validar(frm_cad_evento,'<?php echo $l_str_acao; ?>','<?php echo K_INATIVO; ?>')">
		 <?php } ?> 
		 <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_evento.php')">		 
        </td></tr>
	 </table>
  </td>
</tr>
</table>
<?php 
//fecha conexao com o banco
if($l_str_acao != K_INCLUIR) 
    $l_obj_evento->dbconn->fechar();
?>	
</form>
