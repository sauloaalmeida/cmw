<?php

//captura o codigo da enquete (se existir)
if(isset($_REQUEST["enq_resp_pk"]))
   $enq_resp_pk = $_REQUEST["enq_resp_pk"];

//instancia o objeto de enquetes
$l_obj_resposta= new Resposta;

//verifica qual a acao que vem da pagina anterior
if($l_str_acao != K_INCLUIR){

    if(!isset($_REQUEST["enq_resp_pk"]))
	      msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O codigo da resposta nao foi postado para a pagina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");

    //cria conexao com o banco
    $l_obj_resposta->dbconn->conectar();
	
	//pega a enquete desejada
	$l_obj_resposta->getResposta($enq_resp_pk);
}



?>
<script language="JavaScript" type="text/javascript">

function frm_validar(frm,l_str_acao){

  if( (l_str_acao == '<?php echo K_INCLUIR ?>') || (l_str_acao == '<?php echo K_ALTERAR ?>') ){

	  if(func_bl_isvazio(frm.enqRespResposta,'A resposta da enquete precisa ser preenchida!'))
	      return false;
	
      return true;
  }
  
  if(l_str_acao == '<?php echo K_EXCLUIR ?>'){
      return confirm("A exclus\u00e3o dessa resposta \u00e9 irrevers\u00edvel e excluir\u00e1 todas os votos associados a essa resposta. \nTem certeza que deseja excluir?");
  }

}

</script>
<br>
<form name="frm_cad_enquete" method="post" action="rn_resposta.php" onsubmit="return frm_validar(this,'<?php echo $l_str_acao;?>')">
<input type="hidden" name="enqRespPk" value="<?php echo $l_obj_resposta->enqRespPk ?>">
<input type="hidden" name="enqEnqPk" value="<?php echo $enq_enq_pk ?>">
<input type="hidden" name="enqCatFk" value="<?php echo $enq_cat_pk ?>">
<input type="hidden" name="l_str_acao" value="<?php echo $l_str_acao ?>">
<table width="750" align="center">
<tr>
  <td align="center">
     <table width="730" border="0" align="center">
	    
		<tr>
		    <td width="100"><b>Resposta:</b></td>
			<td width="630">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="enqRespResposta" size="80" maxlength="100" value="<?php echo $l_obj_resposta->enqRespResposta; ?>">
		      <?php }else echo $l_obj_resposta->enqRespResposta; ?>
			</td>
		</tr>
		<tr><td colspan="2" >
		 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 	     <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>		   		   
		   <input type="submit" value="<?php if($l_str_acao == K_INCLUIR) echo "Incluir"; else echo "Alterar" ?> Resposta" >
		 <?php } 
		       if($l_str_acao == K_EXCLUIR){ ?>  
		   <input type="submit" value="Excluir Resposta">
		 <?php } ?> 
		 <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_resposta.php?enq_cat_pk=<?php echo $enq_cat_pk ?>&enq_enq_pk=<?php echo $enq_enq_pk ?>')">
        </td></tr>
	 </table>
  </td>
</tr>
</table>
<?php 
//fecha conexao com o banco
if($l_str_acao != K_INCLUIR) 
    $l_obj_resposta->dbconn->fechar();
?>	
</form>
