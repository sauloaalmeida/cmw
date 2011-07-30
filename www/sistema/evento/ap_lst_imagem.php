<?php
    //o objeto ja foi criado na  pagina que chama esse include (ap_index_lst_imagem)
	
    //cria conexao com o banco
    $l_obj_evento = new Evento();
    $l_obj_evento->dbconn->conectar();
	
?>
<br>
<table width="750" align="center">
<tr>
  <td align="center">
   <table width="530" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" colspan="5">
          <input type="button" value="Cadastrar Imagem" class="botao01" onClick="GoTo('ap_index_cad_imagem.php?even_even_pk=<?php echo $even_even_pk ?>&l_str_acao=<?php echo K_INCLUIR ?>')">
          <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br><br>
        </td>  
      </tr>   
	  <tr>
	    <td width="180">T&iacute;tulo</td>
            <td width="280">Descr&ccedil;&atilde;o</td>
        <td width="57" align="center">Destaque</td>		
		<td colspan="3" align="center">A&ccedil;&atilde;o</td>
	  </tr>
      <tr><td colspan="6" height="1" background="../nucleo/imgs/linha_pontilhada.gif"></td></tr>
    <?php
	
	//pega a noticia desejada
	$l_obj_evento->getEvento($even_even_pk);
	
    //pega recordset de noticias
    $RSimagens = $l_obj_evento->GetListaImagens($even_even_pk);

   //verifica se existe algum registro no recordset
   if(!$l_obj_evento->dbconn->getExisteRecordset($RSimagens)){
       echo "<tr><td colspan='6' align='center'>Nenhuma Imagem associada a esse evento!!</td></tr>";
       echo "<tr><td colspan='6' height='1' background='../nucleo/imgs/linha_pontilhada.gif'></td></tr>";	   
   }	   
   else{
     while ( $RStemp = $l_obj_evento->dbconn->getRecordsetArray($RSimagens) ) { ?>

       <tr>
	   <td><?php echo substr($RStemp["even_img_titulo"],0,30); if(strlen($RStemp["even_img_titulo"]) > 30) echo "..."; ?></td>
	   <td><?php echo substr($RStemp["even_img_descricao"],0,30); if(strlen($RStemp["even_img_descricao"]) > 30) echo "..."; ?></td>
<td align="center"><?php if($RStemp["even_img_destaque"]==K_ATIVO) echo "<img src='../nucleo/imgs/marcado.gif'>"?></td>	   
	   <td width="20" align="center"><a href="ap_index_cad_imagem.php?l_str_acao=<?php echo K_CONSULTAR ?>&even_img_pk=<?php echo $RStemp["even_img_pk"] ?>&even_even_pk=<?php echo $even_even_pk ?>"><img src="../nucleo/imgs/bt_consultar.gif" border="0" alt="Consultar imagem"></a></td>
	   <td width="25" align="center"><a href="ap_index_cad_imagem.php?l_str_acao=<?php echo K_ALTERAR ?>&even_img_pk=<?php echo $RStemp["even_img_pk"] ?>&even_even_pk=<?php echo $even_even_pk ?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar imagem"></a></td>
	   <td width="25" align="center"><a href="ap_index_cad_imagem.php?l_str_acao=<?php echo K_EXCLUIR ?>&even_img_pk=<?php echo $RStemp["even_img_pk"] ?>&even_even_pk=<?php echo $even_even_pk ?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir imagem"></a></td>
	   <tr/>
	   <tr><td valign='top' colspan='6' height='1' background='../nucleo/imgs/linha_pontilhada.gif'></td></tr>
	 <?php
	 }  
   }	  
    $l_obj_evento->dbconn->fechar();
	?>   
   </table>  
  </td>
</tr>
<tr>
   <td align="center">
     <table width="530" border="0">
		<tr>
		    <td width="49"><b>Nome:</b></td>
			<td width="671"><?php echo $l_obj_evento->even_even_nome; ?>
		      &nbsp;&nbsp;&nbsp; <b>Destaque:</b>
			  <?php  if($l_obj_evento->even_even_destaque ==  K_ATIVO)
					     echo K_SIM, "&nbsp;&nbsp;&nbsp;<b>Chamada:</b> ", $l_obj_evento->even_even_chamada;
					  else 
					     echo K_NAO; 
				?>	
			</td>
		</tr>
	    <tr><td colspan="2"><b>Corpo:</b></td></tr>
		<tr>
		    <td colspan="2">
			 <?php echo $l_obj_evento->even_even_corpo; ?>
	        </td>
		</tr>	
                <tr>
		   <td colspan="2"><b>Data Inicio:</b> <?php echo $l_obj_evento->even_even_dt_inicio; ?> <b>Data Fim:</b> <?php echo $l_obj_evento->even_even_dt_fim; ?></td>
		</tr>
                <tr>
                    <td colspan="2"><b>Data Inicio Publica&ccedil;&atilde;o:</b> <?php echo $l_obj_evento->even_even_dt_inicio_publicacao; ?> <b>Data Fim Publica&ccedil;&atilde;o:</b> <?php echo $l_obj_evento->even_even_dt_fim_publicacao; ?></td>
		</tr>
   		<tr><td colspan="2" align="center">
		 <br>
         <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_evento.php')">
        </td></tr>		
	 </table>   
   </td>
</tr>
</table>
</form>