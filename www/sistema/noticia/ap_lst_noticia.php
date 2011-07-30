<?php
$l_obj_noticia = new Noticia;

//cria conexao com o banco
$l_obj_noticia->dbconn->conectar();

if($l_obj_noticia->GetExisteCategoriasFilhas($news_cat_pk)){
    $l_obj_noticia->dbconn->fechar();
    exit("<center><br><br><span class='tx_msg_erro'>Nao &eacute; poss&iacute;vel cadastrar not&iacute;cias nessa categoria, pois ela possui categorias filhas!</span></center>");
}
?>
<br>
<table width="95%" align="center">
<tr>
  <td align="center">
  <input type="button" value="Cadastrar Noticia" class="botao01" onClick="GoTo('ap_index_cad_noticia.php?news_cat_pk=<?php echo $news_cat_pk ?>&l_str_acao=<?php echo K_INCLUIR ?>')">
  <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br><br>
  </td>  
</tr>
<tr>
  <td>
    <table width="100%" cellpadding="2" cellspacing="0" border="0">
	  <tr>
	    <th width="230" align="left"><strong>Titulo</strong></th>
	    <th width="121" align="center"><strong>Data Criacao</strong></th>
		<th width="112" align="center"><strong>Data Inicio</strong></th>
		<th width="111" align="center"><strong>Data Fim</strong></th>				
		<th width="37" align="center"><strong>Status</strong></th>
		<th width="57" align="center"><strong>Destaque</strong></th>
		<th width="50" align="center"><strong>Idioma</strong></th>
		<th colspan="5" align="center"><strong>Acao</strong></th>
	  </tr>
      
<?php

    //pega recordset de noticias
    $RSnoticia = $l_obj_noticia->GetListaNoticias($news_cat_pk);

   //verifica se existe algum registro no recordset
   if(!$l_obj_noticia->dbconn->getExisteRecordset($RSnoticia)){
       echo "<tr><td colspan='12' align='center'>Nenhuma noticia cadastrada para essa categoria!!</td></tr>";
       echo "<tr><td colspan='12' height='1' style='background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x'></td></tr>";
   }	   
   else{
     while ( $RStemp = $l_obj_noticia->dbconn->getRecordsetArray($RSnoticia) ) { ?>

       <tr>
	   <td><?php echo substr($RStemp["news_not_titulo"],0,40); if(strlen($RStemp["news_not_titulo"]) > 40) echo "..."; ?></td>
	   <td align="center"><?php echo $RStemp["news_not_dt_criacao"] ?></td>
	   <td align="center"><?php echo $RStemp["news_not_dt_inicio"] ?></td>
	   <td align="center"><?php echo $RStemp["news_not_dt_fim"] ?></td>
	   <td align="center"><?php echo $RStemp["news_not_status"] ?></td>
	   <td align="center"><?php if($RStemp["news_not_destaque"]==K_ATIVO) echo "<img src='../nucleo/imgs/marcado.gif'>"?></td>	   
	   <td align="center"><?php echo "<img src='".$RStemp["idi_imagem"]."'>"?></td>	   
	   <td width="20" align="center"><a href="ap_index_cad_noticia.php?l_str_acao=<?php echo K_CONSULTAR ?>&news_not_pk=<?php echo $RStemp["news_not_pk"] ?>&news_cat_pk=<?php echo $news_cat_pk ?>"><img src="../nucleo/imgs/bt_consultar.gif" border="0" alt="Consultar not�cia"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_noticia.php?l_str_acao=<?php echo K_ALTERAR ?>&news_not_pk=<?php echo $RStemp["news_not_pk"] ?>&news_cat_pk=<?php echo $news_cat_pk ?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar not�cia"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_noticia.php?l_str_acao=<?php echo K_EXCLUIR ?>&news_not_pk=<?php echo $RStemp["news_not_pk"] ?>&news_cat_pk=<?php echo $news_cat_pk ?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir not�cia"></a></td>
       <td width="20" align="center"><a href="ap_index_lst_imagem.php?news_not_pk=<?php echo $RStemp["news_not_pk"] ?>&news_cat_pk=<?php echo $news_cat_pk ?>"><img src="../nucleo/imgs/bt_imagem.gif" border="0" alt="Imagens da not�cia"></a></td>
       <td width="20" align="center"><a href="ap_index_lst_anexo.php?news_not_pk=<?php echo $RStemp["news_not_pk"] ?>&news_cat_pk=<?php echo $news_cat_pk ?>"><img src="../nucleo/imgs/bt_anexar.gif" border="0" alt="Anexos da not�cia"></a></td>	   
	   </tr>
	   <tr><td valign="top" colspan="12" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td></tr>
	 <?php
	 }  
   }	  
    $l_obj_noticia->dbconn->fechar();	
	?>	  
	</table>
  </td>
</tr>
</table>
