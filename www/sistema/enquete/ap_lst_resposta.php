<br>
<table width="95%" align="center">
<tr>
  <td align="center">
  <input type="button" value="Cadastrar Resposta" class="botao01" onClick="GoTo('ap_index_cad_resposta.php?enq_enq_pk=<?php echo $enq_enq_pk ?>&enq_cat_pk=<?php echo $enq_cat_pk ?>&l_str_acao=<?php echo K_INCLUIR ?>')">
  <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br><br>
  </td>  
</tr>
<tr>
  <td>
    <table width="100%" cellpadding="2" cellspacing="0" border="0">
        <?php
    $l_obj_enquete = new Enquete;

    //cria conexao com o banco
    $l_obj_enquete->dbconn->conectar();
    $l_obj_enquete->getEnquete($enq_enq_pk);
    $l_obj_enquete->dbconn->fechar();
    ?>
      <tr><td colspan="4"><b>Pergunta da enquete: &nbsp;&nbsp;</b><?php echo $l_obj_enquete->enqEnqPergunta;?><br/><br/></td></tr>
	  <tr>
	    <th align="left">Resposta</th>
		<th colspan="3" align="center">A&ccedil;&atilde;o</th>
	  </tr>
    <?php
    $l_obj_resposta = new Resposta;

    //cria conexao com o banco
    $l_obj_resposta->dbconn->conectar();

    //pega recordset de respostas
    $RSresposta = $l_obj_resposta->GetListaRespostas($enq_enq_pk);

   //verifica se existe algum registro no recordset
   if(!$l_obj_resposta->dbconn->getExisteRecordset($RSresposta)){
       echo "<tr><td colspan='4' align='center'>Nenhuma Resposta cadastrada para essa categoria!!</td></tr>";
       echo "<tr><td colspan='4' height='1'  style='background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x'></td></tr>";
   }	   
   else{
     while ( $RStemp = $l_obj_resposta->dbconn->getRecordsetArray($RSresposta) ) { ?>

       <tr>
	   <td><?php echo substr($RStemp["enq_resp_resposta"],0,80); if(strlen($RStemp["enq_resp_resposta"]) > 80) echo "..."; ?></td>
	   <td width="20" align="center"><a href="ap_index_cad_resposta.php?l_str_acao=<?php echo K_CONSULTAR ?>&enq_resp_pk=<?php echo $RStemp["enq_resp_pk"] ?>&enq_enq_pk=<?php echo $enq_enq_pk ?>&enq_cat_pk=<?php echo $enq_cat_pk ?>"><img src="../nucleo/imgs/bt_consultar.gif" border="0" alt="Consultar resposta"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_resposta.php?l_str_acao=<?php echo K_ALTERAR ?>&enq_resp_pk=<?php echo $RStemp["enq_resp_pk"] ?>&enq_enq_pk=<?php echo $enq_enq_pk ?>&enq_cat_pk=<?php echo $enq_cat_pk ?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar resposta"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_resposta.php?l_str_acao=<?php echo K_EXCLUIR ?>&enq_resp_pk=<?php echo $RStemp["enq_resp_pk"] ?>&enq_enq_pk=<?php echo $enq_enq_pk ?>&enq_cat_pk=<?php echo $enq_cat_pk ?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir resposta"></a></td>
	   <tr>
	   <tr><td valign="top" colspan="4" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td></tr>
	 <?php
	 }  
   }	  
    $l_obj_resposta->dbconn->fechar();
	?>	  
	</table>
  </td>
</tr>
</table>