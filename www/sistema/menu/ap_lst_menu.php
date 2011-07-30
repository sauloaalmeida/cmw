
<br>
<table width="95%" align="center">

<tr>
<td align="center">
<br/>
<input type="button" value="Novo Menu" class="botao01" onClick="GoTo('ap_index_cad_menu.php?l_str_acao=<?php echo K_INCLUIR ?>&menu_link_pk=<?php echo $l_obj_menu->menu_link_pk;?>&menu_link_pai_fk=<?php echo $l_obj_menu->menu_link_pk;?>')">
<br/>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo ("<br/>".$_REQUEST['l_str_msg']); ?></span><br>
  </td>
</tr>
<tr>
    <td valign="top">
    <table width="100%" cellpadding="2" cellspacing="0" border="0">
	  <tr>
	    <th align="left" width="200" >Nome</th>
	    <th align="left" width="400" >URL</th>
	    <th align="left" width="100"  >Target</th>
        <th width="80" >Ordem</th>
	    <th colspan="4" width="80">A&ccedil;&atilde;o</th>
    <?php
    
    //pega menus filhos
    $RSmenusfilhos = $l_obj_menu->GetMenusFilhos($menu_link_pk);

   //verifica se existe algum registro no recordset
   if(!$l_obj_menu->dbconn->getExisteRecordset($RSmenusfilhos)){
       echo "<tr><td colspan='8' align='center'>Nenhum menu cadastrado!!</td></tr>";
       echo "<tr><td colspan='8' height='1' style='background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x'></td></tr>";
   }
   else{
     while ( $RStemp = $l_obj_menu->dbconn->getRecordsetArray($RSmenusfilhos) ) { ?>

       <tr>
	   <td align="left"><?php echo $RStemp["menu_link_nome"]; ?></td>
	   <td align="left"><?php echo $RStemp["menu_link_url"] ?></td>
           <td align="left"><?php echo $l_obj_menu->getDescricaoTarget($RStemp["menu_link_target"]) ?></td>
	   <td align="center"><?php echo $RStemp["menu_link_ordem"] ?></td>
	   <td width="20" align="center"><a href="ap_index_lst_menu.php?menu_link_pk=<?php echo $RStemp["menu_link_pk"] ?>&menu_link_pai_fk=<?php echo $RStemp["menu_link_pai_fk"] ?>"><img src="../nucleo/imgs/bt_ir.gif" border="0" alt="Ir para o menu" title="Ir para o menu"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_menu.php?l_str_acao=<?php echo K_CONSULTAR ;?>&menu_link_pk=<?php echo $RStemp["menu_link_pk"] ?>&menu_link_pai_fk=<?php echo $RStemp["menu_link_pai_fk"] ?>"><img src="../nucleo/imgs/bt_consultar.gif" border="0" alt="Consultar" title="Consultar"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_menu.php?l_str_acao=<?php echo K_ALTERAR ;?>&menu_link_pk=<?php echo $RStemp["menu_link_pk"] ?>&menu_link_pai_fk=<?php echo $RStemp["menu_link_pai_fk"] ?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar" title="Alterar"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_menu.php?l_str_acao=<?php echo K_EXCLUIR ;?>&menu_link_pk=<?php echo $RStemp["menu_link_pk"] ?>&menu_link_pai_fk=<?php echo $RStemp["menu_link_pai_fk"] ?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir" title="Excluir"></a></td>
	</tr>
         <tr><td valign="top" colspan="8" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td></tr>
	 <?php
	 }
   }

	?>
	</table>
  </td>
</tr>
</table>
<?php
    //fecha conexao
    $l_obj_menu->dbconn->fechar();
?>

