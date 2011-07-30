<br>
<table width="95%" align="center">
<tr>
  <td align="center">
  <input type="button" value="Cadastrar Usuário" class="botao01" onClick="GoTo('ap_index_cad_usuario.php?l_str_acao=<? echo K_INCLUIR?>')">
  <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br><br>
  </td>  
</tr>
<tr>
  <td>
    <table width="100%" cellpadding="2" cellspacing="0" border="0">
        <tr> 
          <th align="left">Login</th>
          <th align="left" >Nome</th>
          <th align="left">E-mail</th>
          <th align="center">N&iacute;vel</th>
          <th width="46" align="center">Status</th>
          <th colspan="5" align="center">Ação</th>
        </tr>
        <?php
	
    $l_obj_usuario = new AdmUsuario;

    //cria conexao com o banco
    $l_obj_usuario->dbconn->conectar();

    //pega recordset de noticias
    $RSusuario = $l_obj_usuario->getTodosUsuarios();

   //verifica se existe algum registro no recordset
   if(!$l_obj_usuario->dbconn->getExisteRecordset($RSusuario)){
       echo "<tr><td colspan='11' align='center'>Nenhum usuário cadastrado!!</td></tr>";
       echo "<tr><td colspan='11' height='1' background='../nucleo/imgs/linha_pontilhada.gif'></td></tr>";	   
   }	   
   else{
     while ( $RStemp = $l_obj_usuario->dbconn->getRecordsetArray($RSusuario) ) { ?>
        <tr> 
          <td><?php echo $RStemp["adm_usr_login"]; ?></td>
          <td><?php echo $RStemp["adm_usr_nome"]; ?></td>
          <td><?php echo $RStemp["adm_usr_email"]; ?></td>
          <td align="center"><?php if ($RStemp["adm_usr_nivel"]=="A") echo "Adm"; else echo "Editor"; ?></td>
          <td align="center"><?php if ($RStemp["adm_usr_status"]=="A") echo "Ativo"; else echo "Inativo"; ?></td>
          <td width="29" align="center"><a href="ap_index_cad_usuario.php?adm_usr_pk=<?php echo $RStemp["adm_usr_pk"]; ?>&&l_str_acao=<? echo K_ALTERAR?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar cadastro de usuário"></a></td>
          <td width="25" align="center"><a href="ap_index_cad_usuario.php?adm_usr_pk=<?php echo $RStemp["adm_usr_pk"]; ?>&&l_str_acao=<? echo K_EXCLUIR?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir usuário"></a></td>
        <tr> 
        <tr>
          <td valign="top" colspan="11" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td>
        </tr>
        <?php
	 }  
   }	  
    $l_obj_usuario->dbconn->fechar();	
	?>
      </table>
  </td>
</tr>
</table>