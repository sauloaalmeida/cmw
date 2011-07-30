<br>
<table width="95%" align="center">
<tr>
  <td align="center">
  <input type="button" value="Cadastrar Categoria" class="botao01" onClick="GoTo('ap_index_cad_categoria.php?l_str_acao=<? echo K_INCLUIR?>')">
  <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br><br>
  </td>  
</tr>
<tr>
  <td>
    <table width="100%" cellpadding="2" cellspacing="0" border="0" align="center">
        <tr> 
          <th align="left">Categoria</th>
          <th align="left">Descricao</th>
          <th colspan="2" align="center" width="40">Ação</th>
        </tr>
        <?php
	
    $l_obj_categoria = new Categoria;

    //cria conexao com o banco
    $l_obj_categoria->dbconn->conectar();

    //pega recordset de noticias
    $RScategoria = $l_obj_categoria->getTodasCategorias();

   //verifica se existe algum registro no recordset
   if(!$l_obj_categoria->dbconn->getExisteRecordset($RScategoria)){
       echo "<tr><td colspan='4' align='center'>Nenhuma categoria cadastrada!!</td></tr>";
       echo "<tr><td colspan='4' height='1' background='../nucleo/imgs/linha_pontilhada.gif'></td></tr>";	   
   }	   
   else{
     while ( $RStemp = $l_obj_categoria->dbconn->getRecordsetArray($RScategoria) ) { ?>
        <tr> 
          <td><?php echo $RStemp["news_cat_nome"]; ?></td>
          <td><?php echo $RStemp["news_cat_descricao"]; ?></td>
          <td width="20" align="center"><a href="ap_index_cad_categoria.php?news_cat_pk=<?php echo $RStemp["news_cat_pk"]; ?>&l_str_acao=<? echo K_ALTERAR?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar cadastro de categoria"></a></td>
          <td width="20" align="center"><a href="ap_index_cad_categoria.php?news_cat_pk=<?php echo $RStemp["news_cat_pk"]; ?>&l_str_acao=<? echo K_EXCLUIR?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir categoria"></a></td>
        <tr> 
        <tr>
          <td valign="top" colspan="4" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td>
        </tr>
        <?php
	 }  
   }	  
    $l_obj_categoria->dbconn->fechar();	
	?>
      </table>
  </td>
</tr>
</table>
