<?php

//captura o codigo do e-mail (se existir)
if(isset($_REQUEST["nwsl_usr_pk"]))
   $nwsl_usr_pk = $_REQUEST["nwsl_usr_pk"];

//instancia o objeto de noticias
$l_obj_mail = new MailUsuario;

//verifica qual a acao que vem da pagina anterior
if($l_str_acao == K_CONSULTAR || $l_str_acao == K_ALTERAR || $l_str_acao == K_EXCLUIR){

    if(!isset($_REQUEST["nwsl_usr_pk"]))
	      msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O codigo do e-mail nao foram postado para a pagina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");

    //cria conexao com o banco
    $l_obj_mail->dbconn->conectar();
	
	//pega o email desejado
	$l_obj_mail->getEmail($nwsl_usr_pk);
}

?>
<script language="JavaScript" type="text/javascript">

function frm_validar(frm,l_str_acao,l_fl_status_noticia){

  if( (l_str_acao == '<?php echo K_INCLUIR ?>') || (l_str_acao == '<?php echo K_ALTERAR ?>') ){

	  if(func_bl_isvazio(frm.nwsl_usr_nome,'O nome do usuario deve ser informado.'))
	      return false;		  
		  
     if(!isEmail(frm.nwsl_usr_email.value)){
	alert("E-mail em branco ou formato inv\u00e1lido.");
		frm.nwsl_usr_email.focus();
		 return false;
	 }	  		  
		 
     frm.submit();
  }
  
  if(l_str_acao == '<?php echo K_EXCLUIR ?>'){
      if(confirm("A exclus\u00e3o dessa e-mail \u00e9 irrevers\u00edvel \nTem certeza que deseja excluir?"))
          frm.submit();
       //se nao confirmou, cancela
       return false;	  
  }

}

</script>
<br>
<form name="frm_cad_cadastro" method="post" action="rn_cadastro.php">
<input type="hidden" name="nwsl_usr_pk" value="<?php echo $l_obj_mail->nwsl_usr_pk ?>">
<input type="hidden" name="l_str_acao" value="<?php echo $l_str_acao ?>">
<table width="750" align="center">
<tr>
  <td align="center">
     <table width="730" border="0" align="center">
	    
		<tr>
		    <td width="30%" align="right"><b>Nome:</b></td>
			<td width="70%">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="nwsl_usr_nome" size="60" maxlength="100" value="<?php echo $l_obj_mail->nwsl_usr_nome; ?>"> 
		      <?php }else echo $l_obj_mail->nwsl_usr_nome; ?>
    		     </td>
		</tr>

		<tr>
		    <td width="30%" align="right"><b>E-mail:</b></td>
			<td wwidth="70%">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="nwsl_usr_email" size="60" maxlength="255" value="<?php echo $l_obj_mail->nwsl_usr_email; ?>"> 
		      <?php }else echo $l_obj_mail->nwsl_usr_email; ?>
    		     </td>
		</tr>


		<tr><td colspan="2" align="center">
		 <br>
 	     <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>		   		   
		   <input type="button" value="<?php if($l_str_acao == K_INCLUIR) echo "Incluir"; else echo "Alterar" ?> Cadastro" onclick="javascript:frm_validar(frm_cad_cadastro,'<?php echo $l_str_acao; ?>')"> 
	     <?php } 
		       if($l_str_acao == K_EXCLUIR){ ?>  
		   <input type="button" value="Excluir Cadastro" onclick="javascript:frm_validar(frm_cad_cadastro,'<?php echo $l_str_acao; ?>')"> 
		 <?php } ?> 
		 <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_cadastro.php')">		 
        </td></tr>
	 </table>
  </td>
</tr>
</table>
<?php 
//fecha conexao com o banco
if($l_str_acao != K_INCLUIR) 
    $l_obj_mail->dbconn->fechar();
?>	
</form>
