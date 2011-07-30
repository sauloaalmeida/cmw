<br>
<table width="95%" align="center">
<tr>
  <td align="center">
  <input type="button" value="Cadastrar Evento" class="botao01" onClick="GoTo('ap_index_cad_evento.php?&l_str_acao=<?php echo K_INCLUIR ?>')">
  <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br><br>
  </td>  
</tr>
<tr>
  <td>
    <table width="100%" cellpadding="2" cellspacing="0" border="0">
	  <tr>
	    <th width="230" align="left"><strong>Nome</strong></th>
		<th width="112" align="center"><strong>Data Inicio</strong></th>
		<th width="111" align="center"><strong>Data Fim</strong></th>
		<th width="112" align="center"><strong>Data Inicio Publica&ccedil;&atilde;o</strong></th>
                <th width="111" align="center"><strong>Data Fim Publica&ccedil;&atilde;o</strong></th>
		<th width="37" align="center"><strong>Status</strong></th>
		<th width="57" align="center"><strong>Destaque</strong></th>
                <th width="57" align="center"><strong>Tipo</strong></th>
                <th width="57" align="center"><strong>Inscri&ccedil;&atilde;o</strong></th>
		<th colspan="6" align="center"><strong>A&ccedil;&atilde;o</strong></th>
	  </tr>
      
<?php

    $l_obj_evento = new Evento();
    
    $l_obj_evento->dbconn->conectar();
    //pega recordset de noticias
    $arrayEventos = $l_obj_evento->getEventos();
    $l_obj_evento->dbconn->fechar();

   //verifica se existe algum registro no recordset
   if($arrayEventos==NULL){
       echo "<tr><td colspan='15' align='center'>Nenhuma evento cadastrado!!</td></tr>";
       echo "<tr><td colspan='15' height='1' style='background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x'></td></tr>";
   }	   
   else{

     foreach ($arrayEventos as $evento) {?>

       <tr>
	   <td><?php echo substr($evento->even_even_nome,0,40); if(strlen($evento->even_even_nome) > 40) echo "..."; ?></td>
	   <td align="center"><?php echo $evento->even_even_dt_inicio ?></td>
	   <td align="center"><?php echo $evento->even_even_dt_fim ?></td>
	   <td align="center"><?php echo $evento->even_even_dt_inicio_publicacao ?></td>
	   <td align="center"><?php echo $evento->even_even_dt_fim_publicacao ?></td>
	   <td align="center"><?php echo $evento->even_even_status ?></td>
	   <td align="center"><?php if($evento->even_even_destaque==K_ATIVO) echo "<img src='../nucleo/imgs/marcado.gif'>"?></td>
           <td align="center"><?php echo ($evento->even_even_tipo==K_EVENTO_INTERNO)? "Interno":"Externo" ?></td>
           <td align="center"><?php if($evento->even_even_inscricao==K_ATIVO) echo "<img src='../nucleo/imgs/marcado.gif'>"?></td>
	   <td width="20" align="center"><a href="ap_index_cad_evento.php?l_str_acao=<?php echo K_CONSULTAR ?>&even_even_pk=<?php echo $evento->even_even_pk ?>"><img src="../nucleo/imgs/bt_consultar.gif" border="0" alt="Consultar evento"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_evento.php?l_str_acao=<?php echo K_ALTERAR ?>&even_even_pk=<?php echo $evento->even_even_pk ?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar evento"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_evento.php?l_str_acao=<?php echo K_EXCLUIR ?>&even_even_pk=<?php echo $evento->even_even_pk ?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir evento"></a></td>
           <td width="20" align="center"><a href="ap_index_lst_imagem.php?even_even_pk=<?php echo $evento->even_even_pk ?>"><img src="../nucleo/imgs/bt_imagem.gif" border="0" alt="Imagens do evento"></a></td>
           <td width="20" align="center"><a href="ap_index_lst_anexo.php?even_even_pk=<?php echo $evento->even_even_pk ?>"><img src="../nucleo/imgs/bt_anexar.gif" border="0" alt="Anexos do evento"></a></td>
           <td width="20" align="center"><a href="ap_index_lst_inscricao.php?even_even_pk=<?php echo $evento->even_even_pk ?>"><img src="../nucleo/imgs/bt_inscricao.gif" border="0" alt="Inscri&ccedil;&otilde;es"></a></td>
        </tr>
	<tr><td valign="top" colspan="15" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td></tr>
     <?php
	 }  
   }
   ?>
	</table>
  </td>
</tr>
</table>
