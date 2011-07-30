<?php
   $s_nwsl_usr_nome=(isset($_REQUEST["s_nwsl_usr_nome"]))?$_REQUEST["s_nwsl_usr_nome"]:"";
   $s_nwsl_usr_email=(isset($_REQUEST["s_nwsl_usr_email"]))?$_REQUEST["s_nwsl_usr_email"]:"";
?>
<script type="text/javascript">
     function enviarEmails(){

        var arrChecks = document.getElementsByName('nwsl_usr_pk[]');

        for(var i=0;i<arrChecks.length;i++){
            if(arrChecks[i].checked){
                showPopWin('/sistema/nucleo/submodal/loading.html', 240, 60, null, false);
                document.getElementById('form_envio').submit();
                return true;
            }
        }


         alert('Voce deve selecionar ao menos um email para ser enviado.');
         return false;
     }
</script>
<br>
<table width="95%" align="center">
<tr>
  <td align="center">      
  &nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span>
 <form action='ap_index_sel_envio.php' method='post'>
        <input type="hidden" name="l_str_acao" value="<?php echo K_SELECIONAR;?>" />
        <input type="hidden" name="nwsl_env_pk" value="<?php echo nwsl_env_pk;?>" />
        <input type="hidden" name="l_executou_busca" value="<?php echo K_SIM;?>" />
  
        <fieldset style="width:700px;border-color:#CC3300;border-width:1px"><legend>Pesquisar usu&aacute;rios</legend>
            <table align="center" width="600" >
      <tr>
          <td>Nome:</td>
          <td><input type="text" name="s_nwsl_usr_nome" value="<?php echo $s_nwsl_usr_nome; ?>" size="30" /></td>
          <td>E-mail:</td>
          <td><input type="text" name="s_nwsl_usr_email" value="<?php echo $s_nwsl_usr_email; ?>" size="30" /></td>
          <td><input type="submit" value="pesquisar"/></td>
      </tr>
  </table>
        </fieldset>
 </form>
  </td>  
</tr>
<tr>
  <td>
    <form id="form_envio" action='rn_envio.php' method='post'>
        <input type="hidden" name="l_str_acao" value="<?php echo K_ENVIAR;?>" />
        <input type="hidden" name="nwsl_env_pk" value="<?php echo nwsl_env_pk;?>" />

        <table width="100%" cellpadding="2" cellspacing="0" border="0">
	  <tr>
              <th width="20"><input type="checkbox" name="selecionar_todos" id="selecionar_todos" onclick="javascript:selecionarTodos(this,'nwsl_usr_pk[]')" /></th>
	    <th align="left" >Selecionar/Desselecionar todos</th>
	    <th align="left" >E-mail</th>
            <th align="center" >Data de cadastro</th>

    <?php
    $l_obj_mail = new MailUsuario;

    //cria conexao com o banco
    $l_obj_mail->dbconn->conectar();

    //pega recordset de noticias
    $RSmail = $l_obj_mail->getEmailsByNomeEmail($s_nwsl_usr_nome,$s_nwsl_usr_email);

   //verifica se existe algum registro no recordset
   if(!$l_obj_mail->dbconn->getExisteRecordset($RSmail)){
       
       if(isset($_POST["l_executou_busca"]))
            $msgBusca = "A busca n&atilde;o retornou nenhum registro para os par&acirc;metros informados!";
       else
            $msgBusca = "Nenhum, usu&aacute;rio cadastrado!";

       echo "<tr><td colspan='4' align='center'>".$msgBusca."</td></tr>";
       echo "<tr><td colspan='4' height='1' style='background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x'></td></tr>";
   }	   
   else{
     while ( $RStemp = $l_obj_mail->dbconn->getRecordsetArray($RSmail) ) { ?>

       <tr>
           <td><input type="checkbox" name="nwsl_usr_pk[]" value="<?php echo $RStemp["nwsl_usr_pk"]; ?>" /></td>
	   <td align="left"><?php echo $RStemp["nwsl_usr_nome"] ?></td>
	   <td align="left"><?php echo $RStemp["nwsl_usr_email"] ?></td>
	   <td align="center"><?php echo $RStemp["nwsl_usr_dt_cadastro"] ?></td>
	</tr>
         <tr><td valign="top" colspan="4" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td></tr>
	 <?php
	 }  
   }	  
    $l_obj_mail->dbconn->fechar();	
	?>	  
	</table>
      <br/><br/><center><input type="button" value="Enviar E-mail" class="botao01" onclick="enviarEmails();"></center>
    </form>
  </td>
</tr>
</table>
