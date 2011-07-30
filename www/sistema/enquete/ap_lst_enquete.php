<br>
<table width="95%" align="center">
<tr>
  <td align="center">
  <input type="button" value="Cadastrar Enquete" class="botao01" onClick="GoTo('ap_index_cad_enquete.php?enq_cat_pk=<?php echo $enq_cat_pk ?>&l_str_acao=<?php echo K_INCLUIR ?>')">
  <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br><br>
  </td>  
</tr>
<tr>
  <td>
    <table width="100%" cellpadding="2" cellspacing="0" border="0">
	  <tr>
	    <th align="left" nowrap="nowrap">Pergunta</th>
	    <th align="center" nowrap="nowrap">Data Cria&ccedil;&atilde;o</th>
		<th align="center" nowrap="nowrap">Data In&iacute;cio</th>
		<th align="center" nowrap="nowrap">Data Fim</th>				
		<th align="center">Tipo Resp</th>
		<th align="center" nowrap="nowrap">Porcent</th>
		<th align="center" nowrap="nowrap">Absoluto</th>
		<th colspan="4" align="center" nowrap="nowrap">A&ccedil;&atilde;o</th>
	  </tr>
    <?php
    $l_obj_enquete = new Enquete;

    //cria conexao com o banco
    $l_obj_enquete->dbconn->conectar();

    //pega recordset de enquetes
    $RSenquete = $l_obj_enquete->GetListaEnquetes($enq_cat_pk);

   //verifica se existe algum registro no recordset
   if(!$l_obj_enquete->dbconn->getExisteRecordset($RSenquete)){
       echo "<tr><td colspan='11' align='center'>Nenhuma Enquete cadastrada para essa categoria!!</td></tr>";
       echo "<tr><td colspan='11' height='1' background='../nucleo/imgs/linha_pontilhada.gif'></td></tr>";
   }	   
   else{
     while ( $RStemp = $l_obj_enquete->dbconn->getRecordsetArray($RSenquete) ) { ?>

       <tr>
	   <td><?php echo substr($RStemp["enq_enq_pergunta"],0,30); if(strlen($RStemp["enq_enq_pergunta"]) > 30) echo "..."; ?></td>
	   <td align="center"><?php echo $RStemp["enq_enq_dt_criacao"] ?></td>
	   <td align="center"><?php echo $RStemp["enq_enq_dt_inicio"] ?></td>
	   <td align="center"><?php echo $RStemp["enq_enq_dt_fim"] ?></td>
       <td align="center"><?php echo ($RStemp["enq_enq_tp_resposta"]==K_ENQUETE_RESP_MULTIPLA)?"M&uacute;ltipla": "&Uacute;nica" ?></td>
	   <td align="center"><?php if($RStemp["enq_enq_resultado_porcentagem"]==K_ATIVO) echo "<img src='../nucleo/imgs/marcado.gif'>"?></td>
       <td align="center"><?php if($RStemp["enq_enq_resultado_absoluto"]==K_ATIVO) echo "<img src='../nucleo/imgs/marcado.gif'>"?></td>
	   <td width="20" align="center"><a href="ap_index_cad_enquete.php?l_str_acao=<?php echo K_CONSULTAR ?>&enq_enq_pk=<?php echo $RStemp["enq_enq_pk"] ?>&enq_cat_pk=<?php echo $enq_cat_pk ?>"><img src="../nucleo/imgs/bt_consultar.gif" border="0" alt="Consultar enquete"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_enquete.php?l_str_acao=<?php echo K_ALTERAR ?>&enq_enq_pk=<?php echo $RStemp["enq_enq_pk"] ?>&enq_cat_pk=<?php echo $enq_cat_pk ?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar enquete"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_enquete.php?l_str_acao=<?php echo K_EXCLUIR ?>&enq_enq_pk=<?php echo $RStemp["enq_enq_pk"] ?>&enq_cat_pk=<?php echo $enq_cat_pk ?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir enquete"></a></td>
       <td width="20" align="center"><a href="ap_index_lst_resposta.php?enq_enq_pk=<?php echo $RStemp["enq_enq_pk"] ?>&enq_cat_pk=<?php echo $enq_cat_pk ?>"><img src="../nucleo/imgs/bt_resposta.gif" border="0" alt="Respostas da enquete"></a></td>
	   <tr>
	   <tr><td valign="top" colspan="11" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td></tr>
	 <?php
	 }  
   }	  
    $l_obj_enquete->dbconn->fechar();
	?>	  
	</table>
  </td>
</tr>
</table>