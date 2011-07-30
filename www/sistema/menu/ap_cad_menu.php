<?php

if(isset($_REQUEST["menu_link_pk"]))
   $menu_link_pk = $_REQUEST["menu_link_pk"];

if(isset($_REQUEST["menu_link_pai_fk"]))
   $menu_link_pai_fk = $_REQUEST["menu_link_pai_fk"];


//instancia o objeto de noticias
$l_obj_menu = new MenuLink;

//verifica qual a acao que vem da pagina anterior
if($l_str_acao == K_CONSULTAR || $l_str_acao == K_ALTERAR || $l_str_acao == K_EXCLUIR){

    if(!isset($_REQUEST["menu_link_pk"]))
	      msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O codigo do menu nao foram postado para a pagina<br><br>Clique em voltar e tente novamente se o problema persistir contate o administrador!");

    //cria conexao com o banco
    $l_obj_menu->dbconn->conectar();
	
	//pega o email desejado
    $l_obj_menu->getMenu($menu_link_pk);
}

?>
<script language="JavaScript" type="text/javascript">

function frm_validar(frm,l_str_acao){

  if( (l_str_acao == '<?php echo K_INCLUIR ?>') || (l_str_acao == '<?php echo K_ALTERAR ?>') ){

      if(func_bl_isvazio(frm.menu_link_nome,'O nome do menu deve ser informado.'))
          return false;

      if(func_bl_isvazio(frm.menu_link_ordem,'A ordem do menu deve ser informada.'))
          return false;
		 
     frm.submit();
  }
  
  if(l_str_acao == '<?php echo K_EXCLUIR ?>'){
      if(confirm("A exclus\u00e3o dessa menu \u00e9 irrevers\u00edvel \nTem certeza que deseja excluir?"))
          frm.submit();
       //se nao confirmou, cancela
       return false;	  
  }

}

</script>
<br>
<form name="frm_cad_menu" method="post" action="rn_menu.php">
<input type="hidden" name="menu_link_pk" value="<?php echo $l_obj_menu->menu_link_pk ?>">
<input type="hidden" name="menu_link_pai_fk" value="<?php echo $menu_link_pai_fk ?>">
<input type="hidden" name="l_str_acao" value="<?php echo $l_str_acao ?>">
<table width="750" align="center">
<tr>
  <td align="center">
     <table width="730" border="0" align="center">
	    
		<tr>
		    <td width="30%" align="right"><b>Nome*:</b></td>
			<td width="70%">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="menu_link_nome" size="60" maxlength="100" value="<?php echo $l_obj_menu->menu_link_nome; ?>">
		      <?php }else echo $l_obj_menu->menu_link_nome; ?>
    		     </td>
		</tr>

		<tr>
                    <td width="30%" align="right"><b>Descri&ccedil;&atilde;o:</b></td>
			<td width="70%">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <textarea cols="60" rows="3" name="menu_link_descricao"><?php echo $l_obj_menu->menu_link_descricao; ?></textarea>
		      <?php }else echo $l_obj_menu->menu_link_descricao; ?>
    		     </td>
		</tr>

		<tr>
		    <td width="30%" align="right"><b>URL:</b></td>
			<td width="70%">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="menu_link_url" size="60" maxlength="255" value="<?php echo $l_obj_menu->menu_link_url; ?>">
		      <?php }else echo $l_obj_menu->menu_link_url; ?>
    		     </td>
		</tr>

                <tr>
		    <td width="30%" align="right"><b>Target:</b></td>
			<td width="70%">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) { ?>
                            <select name="menu_link_target">
                                <option value=""> -- Selecionar -- </option>
                                <option value="_self" <?php if($l_obj_menu->menu_link_target=="_self") echo " selected ";?> >Mesmo frame</option>
                                <option value="_top" <?php if($l_obj_menu->menu_link_target=="_top") echo " selected ";?>>Mesma p&aacute;gina</option>
                                <option value="_blank" <?php if($l_obj_menu->menu_link_target=="_blank") echo " selected ";?>>Nova p&aacute;gina</option>
                                
                            </select>
		      <?php }else {
                                $l_obj_menu->getDescricaoTarget($l_obj_menu->menu_link_target);
                            }
                       ?>
    		     </td>
		</tr>

                <tr>
		    <td width="30%" align="right"><b>Ordem*:</b></td>
			<td width="70%">
		      <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>
		         <input type="text" name="menu_link_ordem" size="5" maxlength="3" value="<?php echo $l_obj_menu->menu_link_ordem; ?>">
		      <?php }else echo $l_obj_menu->menu_link_ordem; ?>
    		     </td>
		</tr>

		<tr><td colspan="2" align="center">
		 <br>
 	     <?php if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR) {?>		   		   
		   <input type="button" value="<?php if($l_str_acao == K_INCLUIR) echo "Incluir"; else echo "Alterar" ?> Cadastro" onclick="javascript:frm_validar(frm_cad_menu,'<?php echo $l_str_acao; ?>')">
	     <?php } 
		   if($l_str_acao == K_EXCLUIR){ ?>  
		   <input type="button" value="Excluir Cadastro" onclick="javascript:frm_validar(frm_cad_menu,'<?php echo $l_str_acao; ?>')">
		 <?php } 
             
                if($l_str_acao == K_INCLUIR){ ?>
                    <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_menu.php?menu_link_pk=<?php echo $menu_link_pk;?>');">
                <?}
                else{ ?>
                    <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_menu.php?menu_link_pk=<?php echo ($menu_link_pai_fk!='')?$menu_link_pai_fk:K_RAIZ_MENU;?>');">
                <?php }?>
	 
        </td></tr>
	 </table>
  </td>
</tr>
</table>
<?php 
//fecha conexao com o banco
if($l_str_acao != K_INCLUIR) 
    $l_obj_menu->dbconn->fechar();
?>	
</form>
