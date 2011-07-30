<br>
<table width="95%" align="center">
<!--<tr>
  <td align="center">
  <input type="button" value="Cadastrar Inscricao" class="botao01" onClick="GoTo('ap_index_cad_inscricao.php?&l_str_acao=<?php echo K_INCLUIR ?>')">
  <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br><br>
  </td>  
</tr>-->
<tr>
  <td>
    <table width="100%" cellpadding="2" cellspacing="0" border="0">
	  <tr>
	    <th width="230" align="left"><strong>Nome</strong></th>
		<th width="112" align="center"><strong>Data cadastro</strong></th>
		<th width="111" align="center"><strong>Tipo inscrito</strong></th>
                <th width="112" align="center"><strong>N&deg; CRMV</strong></th>
                <th width="111" align="center"><strong>E-mail</strong></th>
		<th width="37" align="center"><strong>Telefone</strong></th>
		<th width="57" align="center"><strong>Celular</strong></th>
		<!--<th colspan="3" align="center"><strong>A&ccedil;&atilde;o</strong></th>-->
	  </tr>
      
<?php

    $l_obj_evento_inscricao = new Inscricao();
    
    $l_obj_evento_inscricao->dbconn->conectar();
    //pega recordset de noticias
    $arrayInscricao = $l_obj_evento_inscricao->getIncricoes($_REQUEST["even_even_pk"]);
    $l_obj_evento_inscricao->dbconn->fechar();

   //verifica se existe algum registro no recordset
   if($arrayInscricao==NULL){
       echo "<tr><td colspan='7' align='center'>Nenhuma inscri&ccedil;&atilde; cadastrado!!</td></tr>";
       echo "<tr><td colspan='7' height='1' style='background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x'></td></tr>";
   }	   
   else{

     foreach ($arrayInscricao as $inscricao) {?>

       <tr>
	   <td><?php echo substr($inscricao->even_insc_nome,0,40); if(strlen($inscricao->even_insc_nome) > 40) echo "..."; ?></td>
	   <td align="center"><?php echo $inscricao->even_insc_dt_inscricao ?></td>
	   <td align="center"><?php echo $inscricao->even_insc_tipo_inscrito ?></td>
	   <td align="center"><?php echo $inscricao->even_insc_crmv ?></td>
	   <td align="center"><?php echo $inscricao->even_insc_email ?></td>
	   <td align="center"><?php echo $inscricao->even_insc_tel ?></td>
           <td align="center"><?php echo $inscricao->even_insc_cel ?></td>
           <!--<td width="20" align="center"><a href="ap_index_cad_inscricao.php?l_str_acao=<?php echo K_CONSULTAR ?>&even_insc_pk=<?php echo $inscricao->even_insc_pk ?>"><img src="../nucleo/imgs/bt_consultar.gif" border="0" alt="Consultar evento"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_inscricao.php?l_str_acao=<?php echo K_ALTERAR ?>&even_insc_pk=<?php echo $inscricao->even_insc_pk ?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar evento"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_inscricao.php?l_str_acao=<?php echo K_EXCLUIR ?>&even_insc_pk=<?php echo $inscricao->even_insc_pk ?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir evento"></a></td>-->
        </tr>
	<tr><td valign="top" colspan="7" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td></tr>
     <?php
	 }  
   }
   ?>
	</table>
  </td>
</tr>
</table>
