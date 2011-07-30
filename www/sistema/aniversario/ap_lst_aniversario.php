<?php
    $l_obj_aniversario = new Aniversario;

    //cria conexao com o banco
    $l_obj_aniversario->dbconn->conectar();

    $l_mes_pesquisa = ( isset($_REQUEST["l_mes_pesquisa"]) && trim($_REQUEST["l_mes_pesquisa"])!="" ) ? trim($_REQUEST["l_mes_pesquisa"]):NULL;
?>
<br>
<table width="95%" align="center">
<tr>
  <td align="center">
  <input type="button" value="Cadastrar Anivers&aacute;rio" class="botao01" onClick="GoTo('ap_index_cad_aniversario.php?l_mes_pesquisa=<?php echo $l_mes_pesquisa; ?>&l_str_acao=<?php echo K_INCLUIR ?>')">
  <br><br>&nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span><br>
  </td>  
</tr>

<tr>
    <td align="center">
      <form action='ap_index_lst_aniversario.php' method='post'>
         <fieldset style="width:400px;border-color:#CC3300;border-width:1px"><legend>Pesquisar Anivers&aacute;rios</legend>
           <table align="center" width="350" >
                <tr>
                  <td>M&ecirc;s:</td>
                  <td>
                      <select name="l_mes_pesquisa">
                          <option value=""> -- Todos -- </option>
                          <?php
                            for($i=1;$i<=12;$i++){
                               echo "<option value='".$i."' ".(($l_mes_pesquisa == $i)?" selected ":"")."> ".func_str_nome_mes($i)."</option>";
                            }
                          ?>                         
                      </select>
                  </td>
                  <td><input type="submit" value="pesquisar"/></td>
              </tr>
          </table>
        </fieldset>
      </form>
    </td>
</tr>
<tr>
  <td>
    <table width="100%" cellpadding="2" cellspacing="0" border="0">
	  <tr>
	    <th align="left" >Nome</th>
            <th align="left" >M&ecirc;s</th>
            <th align="center" >Dia</th>
            <th align="center" >Data Nasc</th>
	    <th colspan="3">A&ccedil;&atilde;o</th>
          </tr>
    <?php
    //pega recordset de noticias
    $rsAniversario = $l_obj_aniversario->getAniversarios($l_mes_pesquisa);

   //verifica se existe algum registro no recordset
   if(!$l_obj_aniversario->dbconn->getExisteRecordset($rsAniversario)){
       echo "<tr><td colspan='7' align='center'>Nenhum anivers&aacute;rio cadastrado para o filtro aplicado!!</td></tr>";
       echo "<tr><td colspan='7' height='1' style='background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x'></td></tr>";
   }	   
   else{
     while ( $RStemp = $l_obj_aniversario->dbconn->getRecordsetArray($rsAniversario) ) { ?>

       <tr>
	   <td align="left"><?php echo $RStemp["aniv_aniv_nome"] ?></td>
           <td align="left"><?php echo func_str_nome_mes($RStemp["aniv_aniv_dt_mes_nasc"]) ?></td>
           <td align="center"><?php echo $RStemp["aniv_aniv_dt_dia_nasc"] ?></td>
	   <td align="center"><?php echo $RStemp["aniv_aniv_dt_nasc"] ?></td>
           <td width="20" align="center"><a href="ap_index_cad_aniversario.php?l_mes_pesquisa=<?php echo $l_mes_pesquisa; ?>&l_str_acao=<?php echo K_CONSULTAR ?>&aniv_aniv_pk=<?php echo $RStemp["aniv_aniv_pk"] ?>"><img src="../nucleo/imgs/bt_consultar.gif" border="0" alt="Consultar aniversario"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_aniversario.php?l_mes_pesquisa=<?php echo $l_mes_pesquisa; ?>&l_str_acao=<?php echo K_ALTERAR ?>&aniv_aniv_pk=<?php echo $RStemp["aniv_aniv_pk"] ?>"><img src="../nucleo/imgs/bt_alterar.gif" border="0" alt="Alterar aniversario"></a></td>
	   <td width="20" align="center"><a href="ap_index_cad_aniversario.php?l_mes_pesquisa=<?php echo $l_mes_pesquisa; ?>&l_str_acao=<?php echo K_EXCLUIR ?>&aniv_aniv_pk=<?php echo $RStemp["aniv_aniv_pk"] ?>"><img src="../nucleo/imgs/bt_excluir.gif" border="0" alt="Excluir aniversario"></a></td>
	</tr>
         <tr><td valign="top" colspan="7" height="1" style="background:url(../nucleo/imgs/linha_pontilhada.gif) repeat-x"></td></tr>
	 <?php
	 }  
   }	  
    $l_obj_aniversario->dbconn->fechar();
	?>	  
	</table>
  </td>
</tr>
</table>
