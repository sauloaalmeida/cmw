<?php

//captura o codigo da enquete (se existir)
if(isset($_REQUEST["enq_enq_pk"]))
   $enq_enq_pk = $_REQUEST["enq_enq_pk"];

//instancia o objeto de enquetes
$l_obj_enquete = new enquete;

//verifica qual a acao que vem da pagina anterior
if($l_str_acao != K_INCLUIR){

    if(!isset($_REQUEST["enq_enq_pk"]))
	      msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O codigo da enquete nao foi postado para a pagina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");

    //cria conexao com o banco
    $l_obj_enquete->dbconn->conectar();
	
	//pega a enquete desejada
	$l_obj_enquete->getEnquete($enq_enq_pk);
}

//cria as variaveis da data
//separa as datas das horas
list ($l_dt_inicio,$l_hr_inicio) = split(' ', $l_obj_enquete->enqEnqDtInicio);
list ($l_dt_fim,$l_hr_fim) = split(' ', $l_obj_enquete->enqEnqDtFim);

//separa dia mes ano
list ($l_int_dia_inicio, $l_int_mes_inicio, $l_int_ano_inicio) = split('[/.-]', $l_dt_inicio);
list ($l_int_dia_fim, $l_int_mes_fim, $l_int_ano_fim) = split ('[/.-]', $l_dt_fim);

//separa hora minuto segundo
list($l_int_hora_inicio, $l_int_min_inicio) = split (':', $l_hr_inicio);
list($l_int_hora_fim, $l_int_min_fim) = split (':', $l_hr_fim);

?>
<script language="JavaScript" type="text/javascript">

function frm_validar(frm,l_str_acao){

  if( (l_str_acao == '<?php echo K_INCLUIR ?>') || (l_str_acao == '<?php echo K_ALTERAR ?>') ){

	  if(func_bl_isvazio(frm.enqEnqPergunta,'A pergunta da enquete precisa ser preenchida!'))
	      return false;

	  if(func_bl_isvazio(frm.enqEnqDuracaoVoto,'A dura\u00e7\u00e3o do voto da enquete precisa ser preenchida!'))
	      return false;

      if(!func_bl_isInteiroPositivo(frm.enqEnqDuracaoVoto,'o Campo Dura\u00e7\u00e3o do voto da enquete, precisa ser um numero inteiro e positivo'))
          return false;
		  
      if(!frm.enqEnqResultadoPorcentagem.checked && !frm.enqEnqResultadoAbsoluto.checked){
	      alert("Pelo menos um tipo de apresenta\u00e7\u00e3o de resultado deve ser selecionado");
          frm.enqEnqResultadoPorcentagem.focus();
	      return false;		  
	  }
		 
	  if(!compara_data(frm.l_int_dia_inicio.value,frm.l_int_mes_inicio.value,frm.l_int_ano_inicio.value,frm.l_int_dia_fim.value,frm.l_int_mes_fim.value,frm.l_int_ano_fim.value,"A [Data Final] da enquete deve ser maior que a [Data Inicial]"))
	     return false;	  

      return true;
  }
  
  if(l_str_acao == '<?php echo K_EXCLUIR ?>'){
      return confirm("A exclus\u00e3o dessa enquete \u00e9 irrevers\u00edvel e excluir\u00e1 todas as perguntas e votos associados a essa enquete. \nTem certeza que deseja excluir?");
  }

}

</script>
<br>
<form name="frm_cad_enquete" method="post" action="rn_enquete.php" onsubmit="return frm_validar(this,'<?php echo $l_str_acao;?>')">
<input type="hidden" name="enqEnqPk" value="<?php echo $l_obj_enquete->enqEnqPk ?>">
<input type="hidden" name="enqCatFk" value="<?php echo $enq_cat_pk ?>">
<input type="hidden" name="l_str_acao" value="<?php echo $l_str_acao ?>">
<table width="750" align="center">
<tr>
  <td align="center">
     <table width="730" border="0" align="center">
	    
		<tr>
		    <td width="100"><b>Pergunta:</b></td>
			<td width="630">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="enqEnqPergunta" size="80" maxlength="255" value="<?php echo $l_obj_enquete->enqEnqPergunta; ?>">
		      <?php }else echo $l_obj_enquete->enqEnqPergunta; ?>
			</td>
		</tr>
		<tr>
		    <td width="100"><b>Dura&ccedil;&atilde;o voto:</b></td>
			<td width="630">
                <table border="0">
                    <tr>
                       <td>
                        <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
                		         <input type="text" name="enqEnqDuracaoVoto" size="5" maxlength="3" value="<?php echo $l_obj_enquete->enqEnqDuracaoVoto; ?>">
                        <?php }else echo $l_obj_enquete->enqEnqDuracaoVoto; ?>
                       (em dias)</td>
                       <td>&nbsp;&nbsp;<b>Tipo resposta: </b></td>
                       <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
                       <td>
                        <input type="radio" name="enqEnqTipoResposta" value="<?php echo K_ENQUETE_RESP_UNICA; ?>" <?php if($l_str_acao == K_INCLUIR || $l_obj_enquete->enqEnqTipoResposta == K_ENQUETE_RESP_UNICA) echo " checked ";?>>
                       </td>
                       <td>&Uacute;nica &nbsp;&nbsp</td>
                       <td>
                        <input type="radio" name="enqEnqTipoResposta" value="<?php echo K_ENQUETE_RESP_MULTIPLA; ?>" <?php if($l_obj_enquete->enqEnqTipoResposta == K_ENQUETE_RESP_MULTIPLA) echo " checked ";?> >
                        </td>
                        <td>
                        M&uacute;ltipla
                       </td>
                       <?php }else echo "<td>".$l_obj_enquete->getTipoRespostaExtenso()."</td>";?>
                     </tr>
                </table>
			</td>
		</tr>
		<tr>
		    <td width="100"><b>Apres. result:</b></td>
			<td width="630">
                <table border="0">
                    <tr>
                      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
                       <td>
                        <input type="checkbox" name="enqEnqResultadoPorcentagem" value="<?php echo K_ATIVO; ?>" <?php if(($l_str_acao == K_INCLUIR) || ($l_str_acao == K_ALTERAR && $l_obj_enquete->enqEnqResultadoPorcentagem == K_ATIVO))echo " checked "; ?>>
                       </td>
                      <?php }?>
                      <td>Porcentagem<?php if($l_str_acao == K_EXCLUIR || $l_str_acao == K_CONSULTAR) echo ":".$l_obj_enquete->getResultadoPorcentagemExtenso(); ?></td>
                       <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
                       <td>
                        <input type="checkbox" name="enqEnqResultadoAbsoluto" value="<?php echo K_ATIVO; ?>" <?php if($l_str_acao == K_ALTERAR && $l_obj_enquete->enqEnqResultadoAbsoluto == K_ATIVO) echo " checked "; ?>>
                        </td>
                       <?php }?>
                        <td>
                        Absoluto<?php if($l_str_acao == K_EXCLUIR || $l_str_acao == K_CONSULTAR) echo ":".$l_obj_enquete->getResultadoAbsolutoExtenso(); ?>
                       </td>
                     </tr>
                </table>
			</td>
		</tr>
		<?php if($l_str_acao != K_INCLUIR ) {?>		
	    <tr>
		    <td><b>Publicado por:</b></td>
		   <td>
		     <?php echo $l_obj_enquete->getNomeResponsavel(); ?>
		   </td>
		</tr>								
		<?php } ?>

		<?php if($l_str_acao != K_INCLUIR ) {?>		
	    <tr>
		   <td><b>Dt Cria&ccedil;&atilde;o:</b></td>
		   <td>
		     <?php echo $l_obj_enquete->enqEnqDtCriacao; ?>
		   </td>
		</tr>								
		<?php } ?>								
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
			<?php }else echo $l_obj_enquete->enqEnqDtInicio; ?>
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
			<?php }else echo $l_obj_enquete->enqEnqDtFim; ?>
		   </td>
		</tr>
		<tr><td colspan="2" >
		 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 	     <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>		   		   
		   <input type="submit" value="<?php if($l_str_acao == K_INCLUIR) echo "Publicar"; else echo "Alterar" ?> Enquete" >
		 <?php } 
		       if($l_str_acao == K_EXCLUIR){ ?>  
		   <input type="submit" value="Excluir Enquete">
		 <?php } ?> 
		 <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_enquete.php?enq_cat_pk=<?php echo $enq_cat_pk ?>')">
        </td></tr>
	 </table>
  </td>
</tr>
</table>
<?php 
//fecha conexao com o banco
if($l_str_acao != K_INCLUIR) 
    $l_obj_enquete->dbconn->fechar();
?>	
</form>
