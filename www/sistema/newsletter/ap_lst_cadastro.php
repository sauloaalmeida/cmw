<br>
<table width="95%" align="center">
<tr>
  <td align="center">
  <input type="button" value="Cadastrar E-mail" class="botao01" onClick="GoTo('ap_index_cad_cadastro.php?l_str_acao=<?php echo K_INCLUIR ?>')">
  <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br><br>
  </td>  
</tr>
<tr>
  <td>
    <table width="100%" cellpadding="2" cellspacing="0" border="0">
	  <tr>
	    <th width="46" align="left">C&oacute;digo</th>
	    <th align="left" >Nome</th>
	    <th align="left" >E-mail</th>
	    <th width="133" >Data cadastro</th>
	    <th colspan="2">A&ccedil;&atilde;o</th>
    <?php
    $l_obj_mail = new MailUsuario;

    //cria conexao com o banco
    $l_obj_mail->dbconn->conectar();

    //pega recordset de noticias
    $RSmail = $l_obj_mail->getTodosCadastrados();

   //verifica se existe algum registro no recordset
   if(!$l_obj_mail->dbconn->getExisteRecordset($RSmail)){
       echo "<tr><td colspan='6' align='center'>Nenhum usuario cadastrado!!</td></tr>";
       echo "<tr><td colspan='6' height='1' style='background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x'></td></tr>";
   }	   
   else{
     while ( $RStemp = $l_obj_mail->dbconn->getRecordsetArray($RSmail) ) { ?>

       <tr>
	   <td align="left"><?php echo func_str_completa_esquerda($RStemp["nwsl_usr_pk"],5,"0"); ?></td>
	   <td align="left"><?php echo $RStemp["nwsl_usr_nome"] ?></td>
	   <td align="left"><?php echo $RStemp["nwsl_usr_email"] ?></td>
	   <td align="center"><?php echo $RStemp["nwsl_usr_dt_cadastro"] ?></td>
	   <td width="20" align="center"><a href="ap_index_cad_cadastro.php?l_str_acao=<?php echo K_ALTERAR ?>&nwsl_usr_pk=<?php echo $RStemp["nwsl_usr_pk"] ?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar usuario"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_cadastro.php?l_str_acao=<?php echo K_EXCLUIR ?>&nwsl_usr_pk=<?php echo $RStemp["nwsl_usr_pk"] ?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir usuario"></a></td>
	</tr>
         <tr><td valign="top" colspan="6" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td></tr>
	 <?php
	 }  
   }	  
    $l_obj_mail->dbconn->fechar();	
	?>	  
	</table>
  </td>
</tr>
</table>
