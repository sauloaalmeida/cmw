<?php

//captura o codigo do e-mail (se existir)
if(isset($_REQUEST["nwsl_env_pk"]))
   $nwsl_env_pk = $_REQUEST["nwsl_env_pk"];

//instancia o objetos
$l_obj_mail = new MailEnvio;

//template vai ser necessario sempre
$l_obj_template = new Template;
$l_obj_template->dbconn->conectar();

//verifica qual a acao que vem da pagina anterior
if($l_str_acao == K_CONSULTAR || $l_str_acao == K_ALTERAR || $l_str_acao == K_EXCLUIR){

    if(!isset($_REQUEST["nwsl_env_pk"]))
	      msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O codigo do envio nao foi postado para a pagina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");

    //cria conexao com o banco
    $l_obj_mail->dbconn->conectar();
	
	//pega o email desejado
	$l_obj_mail->getEnvio($nwsl_env_pk);
}

?>
<script language="JavaScript" type="text/javascript">

function frm_validar_envio(frm,l_str_acao){

var extensoes = new Array(5);
extensoes[0] = "JPG";
extensoes[1] = "GIF";
extensoes[2] = "BMP";
extensoes[3] = "PNG";
extensoes[4] = "JPEG";

  if(l_str_acao == '<?php echo K_INCLUIR ?>' || l_str_acao == '<?php echo K_ALTERAR ?>') {

        if(func_bl_isvazio(frm.nwsl_env_assunto,'O Titulo da noticia precisa ser preenchido!'))
	      return false;

        var oEditor = FCKeditorAPI.GetInstance('nwsl_env_corpo');
        var newsNotCorpo = oEditor.GetXHTML();

	if(func_str_trim(newsNotCorpo)==""){
	      alert("O Corpo do newsletter precisa ser preenchido!")
	      return false;
	}
  }

  if(l_str_acao == '<?php echo K_EXCLUIR ?>') {
	return confirm('A exclusao desse registro e irreversivel.\nTem certeza que deseja excluir?');
  }  
  
  return true;
}


</script>
<br>
<form name="frm_cad_envio" method="post" enctype="multipart/form-data" action="rn_envio.php" onsubmit="javascript:return frm_validar_envio(this,'<?php echo$l_str_acao;?>')" >
<input type="hidden" name="nwsl_env_pk" value="<?php echo $l_obj_mail->nwsl_env_pk ?>">
<input type="hidden" name="l_str_acao" value="<?php echo $l_str_acao ?>">
<table width="750" align="center">
<tr>
  <td align="center">
     <table width="730" border="0" align="center">
	    
		<tr>
		    <td width="30%" align="right"><b>Assunto:</b></td>
			<td width="70%">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="nwsl_env_assunto" size="60" maxlength="100" value="<?php echo $l_obj_mail->nwsl_env_assunto; ?>"> 
		      <?php }else echo $l_obj_mail->nwsl_env_assunto; ?>
    		     </td>
		</tr>
		
		<?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		<tr>
		   <td align="right"><b>Imagem:</b></td>
		   <td>
		      <input type="file" name="nwsl_env_path" size="40" ><br>
			<?php echo "<a id='link02' href=\"javascript:AbreJanela('ap_vis_imagem.php?l_str_arquivo=".$l_obj_mail->nwsl_env_path."','Visualiza_Imagem','height=500, width=700, scrollbars=YES,resizable=yes')\">".substr($l_obj_mail->nwsl_env_path,15)."</a>"; ?>  
		   </td>
		</tr>
		<?php } else {?>
		   <tr>
		      <td align="center" colspan="2"><br>
                   <?php if(trim($l_obj_mail->nwsl_env_path)!=""){?>
			<img src="<?php echo K_UPLOADDIR_EXIB_IMG_MAIL.$l_obj_mail->nwsl_env_path;?>">
                   <?php }?>
		      </td>
		   </tr>
		<?php } ?>

       		<tr>
		    <td width="30%" align="right"><b>Template:</b></td>
			<td width="70%">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
                            <select name="nwsl_temp_fk">
                                <option>Sem template</option>
                                <?php
                                $RStemplate = $l_obj_template->getTodosTemplates();
                                while ( $RStemp = $l_obj_template->dbconn->getRecordsetArray($RStemplate) ) {
                                    echo "<option value='".$RStemp['nwsl_temp_pk']."' ".(($l_obj_mail->nwsl_temp_fk == $RStemp['nwsl_temp_pk'])?"Selected":"").">".$RStemp['nwsl_temp_nome']."</option>";
                                }
                                ?>


                            </select>		         
		      <?php }else echo $l_obj_mail->nwsl_temp_nome; ?>
    		     </td>
		</tr>

		<tr>
		    <td colspan="2"><b>Corpo do E-mail:</b></td>
        </tr>

		<tr>
		    <td colspan="2">
		     <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {

				   $oFCKeditor = new FCKeditor('nwsl_env_corpo') ;
				   $oFCKeditor->BasePath = '../nucleo/fckeditor/' ;

                           //configuracoes
                           //$oFCKeditor->Config['EnterMode'] = 'br';
				   $oFCKeditor->Height='380';

				   $oFCKeditor->Value = $l_obj_mail->nwsl_env_corpo ;
				   $oFCKeditor->Create() ;
				
		           }else 
                           echo $l_obj_mail->nwsl_env_corpo; 
				?>
    		     </td>
		</tr>

		<tr><td colspan="2" align="center">
		 <br>
		 <?php if($l_str_acao != K_CONSULTAR) {?>
		   <input type="submit" value="<?php echo $l_str_acao ?> envio">  
		 <?php }?>  
		 <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_envio.php')">		 
        </td></tr>
	 </table>
  </td>
</tr>
</table>
<?php 
//fecha conexao com o banco
if($l_str_acao != K_INCLUIR) 
    $l_obj_mail->dbconn->fechar();

//e fechado sempre tb
$l_obj_template->dbconn->fechar();
?>

</form>
