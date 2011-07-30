<?php
    //o objeto ja foi criado na  pagina que chama esse include (ap_index_lst_imagem)
	
    //cria conexao com o banco
    $l_obj_noticia->dbconn->conectar();
	
?>
<br>
<table width="750" align="center">
<tr>
  <td align="center">
   <table width="530" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" colspan="5">
          <input type="button" value="Cadastrar Imagem" class="botao01" onClick="GoTo('ap_index_cad_imagem.php?news_not_pk=<?php echo $news_not_pk ?>&l_str_acao=<?php echo K_INCLUIR ?>&news_cat_pk=<?php echo $news_cat_pk ?>')">
          <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br><br>
        </td>  
      </tr>   
	  <tr>
	    <td width="180">Título</td>
	    <td width="280">Descrição</td>
        <td width="57" align="center">Destaque</td>		
		<td colspan="3" align="center">Ação</td>
	  </tr>
      <tr><td colspan="6" height="1" background="../nucleo/imgs/linha_pontilhada.gif"></td></tr>
    <?php
	
	//pega a noticia desejada
	$l_obj_noticia->getNoticia($news_not_pk);
	
    //pega recordset de noticias
    $RSimagens = $l_obj_noticia->GetListaImagens($news_not_pk);

   //verifica se existe algum registro no recordset
   if(!$l_obj_noticia->dbconn->getExisteRecordset($RSimagens)){
       echo "<tr><td colspan='6' align='center'>Nenhuma Imagem associada a essa noticia!!</td></tr>";
       echo "<tr><td colspan='6' height='1' background='../nucleo/imgs/linha_pontilhada.gif'></td></tr>";	   
   }	   
   else{
     while ( $RStemp = $l_obj_noticia->dbconn->getRecordsetArray($RSimagens) ) { ?>

       <tr>
	   <td><?php echo substr($RStemp["news_img_titulo"],0,30); if(strlen($RStemp["news_img_titulo"]) > 30) echo "..."; ?></td>
	   <td><?php echo substr($RStemp["news_img_descricao"],0,30); if(strlen($RStemp["news_img_descricao"]) > 30) echo "..."; ?></td>
<td align="center"><?php if($RStemp["news_img_destaque"]==K_ATIVO) echo "<img src='../nucleo/imgs/marcado.gif'>"?></td>	   
	   <td width="20" align="center"><a href="ap_index_cad_imagem.php?l_str_acao=<?php echo K_CONSULTAR ?>&news_img_pk=<?php echo $RStemp["news_img_pk"] ?>&news_cat_pk=<?php echo $news_cat_pk ?>&news_not_pk=<?php echo $news_not_pk ?>"><img src="../nucleo/imgs/bt_consultar.gif" border="0" alt="Consultar imagem"></a></td>
	   <td width="25" align="center"><a href="ap_index_cad_imagem.php?l_str_acao=<?php echo K_ALTERAR ?>&news_img_pk=<?php echo $RStemp["news_img_pk"] ?>&news_cat_pk=<?php echo $news_cat_pk ?>&news_not_pk=<?php echo $news_not_pk ?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar imagem"></a></td>
	   <td width="25" align="center"><a href="ap_index_cad_imagem.php?l_str_acao=<?php echo K_EXCLUIR ?>&news_img_pk=<?php echo $RStemp["news_img_pk"] ?>&news_cat_pk=<?php echo $news_cat_pk ?>&news_not_pk=<?php echo $news_not_pk ?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir imagem"></a></td>
	   <tr>
	   <tr><td valign='top' colspan='6' height='1' background='../nucleo/imgs/linha_pontilhada.gif'></td></tr>
	 <?php
	 }  
   }	  
    $l_obj_noticia->dbconn->fechar();	
	?>   
   </table>  
  </td>
</tr>
<tr>
   <td align="center">
     <table width="530" border="0">
		<tr>
		    <td width="49"><b>Titulo:</b></td>
			<td width="671"><?php echo $l_obj_noticia->news_not_titulo; ?>
		      &nbsp;&nbsp;&nbsp; <b>Destaque:</b>
			  <?php  if($l_obj_noticia->news_not_destaque ==  K_ATIVO)
					     echo K_SIM, "&nbsp;&nbsp;&nbsp;<b>Chamada:</b> ", $l_obj_noticia->news_not_chamada;
					  else 
					     echo K_NAO; 
				?>	
			</td>
		</tr>
	    <tr><td colspan="2"><b>Corpo:</b></td></tr>
		<tr>
		    <td colspan="2">
			 <?php echo $l_obj_noticia->news_not_corpo; ?>
	        </td>
		</tr>	
        <tr>
		   <td colspan="2"><b>Autor:</b> <?php echo $l_obj_noticia->getNomeResponsavel(); ?>  <b>Origem:</b> <?php echo $l_obj_noticia->news_not_origem; ?></td>
		</tr>					
	    <tr>
		   <td colspan="2"><b>Data Inicio:</b> <?php echo $l_obj_noticia->news_not_dt_inicio; ?> <b>Data Fim:</b> <?php echo $l_obj_noticia->news_not_dt_fim; ?></td>
		</tr>
   		<tr><td colspan="2" align="center">
		 <br>
         <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_noticia.php?news_cat_pk=<?php echo $news_cat_pk ?>')">
        </td></tr>		
	 </table>   
   </td>
</tr>
</table>
</form>