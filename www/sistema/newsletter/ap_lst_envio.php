<script>

    function validaExclusao(nwsl_pk, status){
	if(status=='A')
		window.location='ap_index_cad_envio.php?l_str_acao=<?php echo K_EXCLUIR ?>&nwsl_env_pk='+nwsl_pk;
	else{
		alert('Nao eh possivel excluir registro com estatus de Enviado');
		return false;
	}	
    }

</script>
<br>
<table width="95%" align="center">
<tr>
  <td align="center">
  <input type="button" value="Cadastrar Envio" class="botao01" onClick="GoTo('ap_index_cad_envio.php?l_str_acao=<?php echo K_INCLUIR ?>')">
  <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br><br>  </td>  
</tr>
<tr>
  <td><table width="100%" cellpadding="2" cellspacing="0" border="0">
    <tr>
      <th width="50" align="left">C&oacute;digo</th>
      <th align="left">Assunto</th>
      <th width="125" >Data cadastro</th>
      <th width="125" >Data envio</th>
      <th width="100" >Status</th>
      <th colspan="4" width="80">A&ccedil;&atilde;o</th>
    </tr>
    
    <?php
    $l_obj_mail = new MailEnvio;

    //cria conexao com o banco
    $l_obj_mail->dbconn->conectar();

    //pega recordset de noticias
    $RSmail = $l_obj_mail->getTodosEnvios();

   //verifica se existe algum registro no recordset
   if(!$l_obj_mail->dbconn->getExisteRecordset($RSmail)){
       echo "<tr><td colspan='9' align='center'>Nenhum envio cadastrado!!</td></tr>";
       echo "<tr><td colspan='9' height='1' background='../nucleo/imgs/linha_pontilhada.gif'></td></tr>";	   
   }	   
   else{
     while ( $RStemp = $l_obj_mail->dbconn->getRecordsetArray($RSmail) ) { ?>
    <tr>
      <td align="left"><?php echo func_str_completa_esquerda($RStemp["nwsl_env_pk"],5,"0"); ?></td>
      <td align="left"><?php echo $RStemp["nwsl_env_assunto"] ?></td>
      <td align="center"><?php echo $RStemp["nwsl_env_dt_cadastro"] ?></td>
      <td align="center"><?php echo $RStemp["nwsl_env_dt_envio"] ?></td>
      <td align="center"><?php 
			if($RStemp["nwsl_env_status"] == 'E') 
				echo "Enviado";
			else
				echo "Em aguardo";
		?></td>
      <td width="20" align="center"><a href="ap_index_cad_envio.php?l_str_acao=<?php echo K_ALTERAR ?>&nwsl_env_pk=<?php echo $RStemp["nwsl_env_pk"] ?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar envio" /></a></td>
      <td width="20" align="center"><a href="javascript:window.open('pop_email_visualizacao.php?nwsl_env_pk=<?php echo $RStemp["nwsl_env_pk"] ?>','vizualiza_email','left=100,top=100,height=650,width=800,scrollbars=yes');void(0);" ><img src="../nucleo/imgs/bt_consultar.gif" border="0" alt="Consultar envio"  /></a></td>
      <td width="20" align="center"><a href="javascript:validaExclusao(<?php echo $RStemp["nwsl_env_pk"] ?>,'<?php echo $RStemp["nwsl_env_status"] ?>');void(0);"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir envio" /></a></td>
      <td width="20" align="center"><a href="ap_index_sel_envio.php?l_str_acao=<?php echo K_SELECIONAR ?>&nwsl_env_pk=<?php echo $RStemp["nwsl_env_pk"] ?>"><img src="../nucleo/imgs/bt_enviar.gif" border="0" alt="Enviar email" /></a></td>
    </tr>
    <tr>
      <td valign="top" colspan="9" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td>
    </tr>
    <?php
	 }  
   }	  
    $l_obj_mail->dbconn->fechar();	
	?>
  </table></td>
</tr>
</table>
