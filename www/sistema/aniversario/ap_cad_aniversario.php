<?php

//captura o codigo do e-mail (se existir)
if(isset($_REQUEST["aniv_aniv_pk"]))
   $aniv_aniv_pk = $_REQUEST["aniv_aniv_pk"];

$l_mes_pesquisa = ( isset($_REQUEST["l_mes_pesquisa"]) && trim($_REQUEST["l_mes_pesquisa"])!="" ) ? trim($_REQUEST["l_mes_pesquisa"]):NULL;

//instancia o objeto de noticias
$l_obj_aniversario = new Aniversario;

//verifica qual a acao que vem da pagina anterior
if($l_str_acao == K_CONSULTAR || $l_str_acao == K_ALTERAR || $l_str_acao == K_EXCLUIR){

    if(!isset($_REQUEST["aniv_aniv_pk"]))
	      msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O codigo do aniversario nao foram postado para a pagina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");

    //cria conexao com o banco
    $l_obj_aniversario->dbconn->conectar();
	
	//pega o email desejado
	$l_obj_aniversario->getAniversario($aniv_aniv_pk);

        list ($l_int_dia, $l_int_mes, $l_int_ano) = split('[/.-]', $l_obj_aniversario->aniv_aniv_dt_nasc);
}

?>
<script language="JavaScript" type="text/javascript">

function frm_validar(frm,l_str_acao,l_fl_status_noticia){

  if( (l_str_acao == '<?php echo K_INCLUIR ?>') || (l_str_acao == '<?php echo K_ALTERAR ?>') ){

	  if(func_bl_isvazio(frm.aniv_aniv_nome,'O nome do usu\u00e1rio deve ser informado.'))
	      return false;

          if(!isDate(frm.l_int_dia.value,frm.l_int_mes.value,frm.l_int_ano.value,'Informe uma data v\u00e1lida'))
              return false;
		 
     frm.submit();
  }
  
  if(l_str_acao == '<?php echo K_EXCLUIR ?>'){
      if(confirm("A exclus\u00e3o dessa anivers\u00e1rio \u00e9 irrevers\u00edvel \nTem certeza que deseja excluir?"))
          frm.submit();
       //se nao confirmou, cancela
       return false;	  
  }

}

</script>
<br>
<form name="frm_cad_cadastro" method="post" action="rn_aniversario.php">
<input type="hidden" name="aniv_aniv_pk" value="<?php echo $l_obj_aniversario->aniv_aniv_pk ?>">
<input type="hidden" name="l_str_acao" value="<?php echo $l_str_acao ?>">
<input type="hidden" name="l_mes_pesquisa" value="<?php echo $l_mes_pesquisa ?>">
<table width="750" align="center">
<tr>
  <td align="center">
     <table width="730" border="0" align="center">
	    
		<tr>
		    <td width="30%" align="right"><b>Nome:</b></td>
			<td width="70%">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="aniv_aniv_nome" size="60" maxlength="100" value="<?php echo $l_obj_aniversario->aniv_aniv_nome; ?>">
		      <?php }else echo $l_obj_aniversario->aniv_aniv_nome; ?>
    		     </td>
		</tr>


                <tr>
                    <td align="right"><b>Data Nasc:</b></td>
                    <td>

		    <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		     <select name="l_int_dia">
			   <?php for($i=1;$i<=31;$i++) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_dia == $i) echo " selected "; ?> ><?php echo func_str_completa_esquerda($i,2,"0") ?></option>
			   <?php } ?>
		      </select> /

                      <select name="l_int_mes">
                          <?php
                            for($i=1;$i<=12;$i++){
                               echo "<option value='".$i."' ".(($l_int_mes == $i)?" selected ":"")."> ".func_str_nome_mes($i)."</option>";
                            }
                          ?>
                      </select> /

			  <select name="l_int_ano">
                        <?php for($i=date("Y",time())-1;$i>=date("Y",time())-90;$i--) {?>
			      <option value="<?php echo $i ?>" <?php if($l_int_ano == $i) echo " selected "; ?>><?php echo $i ?></option>
			   <?php } ?>
			 </select>
			<?php }else echo $l_obj_aniversario->aniv_aniv_dt_nasc; ?>
	            </td>
                </tr>

		<tr><td colspan="2" align="center">
		 <br>
 	     <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>		   		   
		   <input type="button" value="<?php if($l_str_acao == K_INCLUIR) echo "Incluir"; else echo "Alterar" ?> Cadastro" onclick="javascript:frm_validar(frm_cad_cadastro,'<?php echo $l_str_acao; ?>')"> 
	     <?php } 
		       if($l_str_acao == K_EXCLUIR){ ?>  
		   <input type="button" value="Excluir Cadastro" onclick="javascript:frm_validar(frm_cad_cadastro,'<?php echo $l_str_acao; ?>')"> 
		 <?php } ?> 
		 <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_aniversario.php?l_mes_pesquisa=<?php echo $l_mes_pesquisa; ?>')">
        </td></tr>
	 </table>
  </td>
</tr>
</table>
<?php 
//fecha conexao com o banco
if($l_str_acao != K_INCLUIR) 
    $l_obj_aniversario->dbconn->fechar();
?>	
</form>
