<? 
$l_obj_usuario = new AdmUsuario();
$l_str_acao = $_REQUEST["l_str_acao"];

if (isset($_REQUEST["adm_usr_pk"])){
	    //cria conexao com o banco
		$adm_usr_pk = $_REQUEST["adm_usr_pk"];
		$l_obj_usuario->dbconn->conectar();
		$l_obj_RSusuario = $l_obj_usuario->GetUsuario($adm_usr_pk);

	}
?>

<script language="JavaScript" type="text/javascript">

function frm_validar(frm, l_str_acao){


	if((l_str_acao == "<?php echo K_INCLUIR?>") || (l_str_acao == "<?php echo K_ALTERAR?>")){

	  if(func_bl_isvazio(frm.cad_user_nome,'O Nome do usuario precisa ser preenchido!'))
	      return false;

	  if(!isEmail(frm.cad_user_email.value)){
	      alert("O email esta vazio ou não é um email válido");
		  frm.cad_user_email.focus();
	      return false;		  
	  }
				         
	  if(func_bl_isvazio(frm.cad_user_nivel,'O nivel do usuario precisa ser selecionado!'))
	      return false;
		  
	  if(func_bl_isvazio(frm.cad_user_status,'O status do usuario precisa ser selecionado!'))
	      return false;
		  
	  if(func_bl_isvazio(frm.cad_user_login,'O login do usuario precisa ser preenchido!'))
	      return false;

	  if(func_bl_isvazio(frm.cad_user_senha,'A senha do usuario precisa ser preenchida!'))
	      return false;
		  
	  if(frm.cad_user_senha.value != frm.cad_user_senha2.value){
	  	alert("As senhas digitadas são diferentes. Por favor redigite as senhas!");
		frm.cad_user_senha.value="";
		frm.cad_user_senha2.value="";
		frm.cad_user_senha.focus();
		return false;
	  }		  
	  
	}else if (l_str_acao == "<?php echo K_EXCLUIR?>"){
	
		if(confirm("Tem certeza que gostaria de excluir esse registro?"))
			return true;
		else
			return false;
	
	}
		  		  		  	  	  
      return true;
  }
  
</script>
<br><br>
<form name="frm_cad_usuario" method="post" action="rn_usuario.php?l_str_acao=<? echo $l_str_acao?>" onSubmit="return frm_validar(this,'<?php echo $l_str_acao ?>');">
<input name="l_str_acao" type="hidden" value="<? echo $l_str_acao;?>">
<input name="l_str_pk" type="hidden" value="<? echo $adm_usr_pk;?>">
<input name="l_str_senha_original" type="hidden" value="<? echo $l_obj_usuario->adm_usr_senha;?>">

<table width="579" align="center" border="0">

	<tr>
  		<td align="center">
			<table width="367" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="81" align="right" valign="top"><strong>Nome:&nbsp;</strong></td>
          <td width="280">
		  <? if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){ ?> 
		  	<input name='cad_user_nome' type='text' id='cad_user_nome' size='40' value='<? echo $l_obj_usuario->adm_usr_nome; ?>'>
		  <?}else
		  	echo $l_obj_usuario->adm_usr_nome;?>

			<br><br></td>
        </tr>
        <tr> 
          <td align="right" valign="top"><strong> E-mail:&nbsp;</strong></td>
          <td><? if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){ ?> 
	  		<input name='cad_user_email' type='text' id='cad_user_email' size='40' value='<? echo $l_obj_usuario->adm_usr_email ?>'>
	      <?}else
		        echo $l_obj_usuario->adm_usr_email;?>		  
		  <br><br></td>
        </tr>
        <tr> 
          <td align="right" valign="top"><strong>N&iacute;vel:&nbsp;</strong></td>
          <td><? if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){ ?>
			<select name='cad_user_nivel'> 
				<option <?php if ($l_str_acao == K_INCLUIR) echo "selected"; ?> value=''>-- Selecione --</option> 
				<option value='A' <?php if ($l_obj_usuario->adm_usr_nivel=="A") echo "selected"; ?>>Administrador</option> 
				<option value='E' <?php if ($l_obj_usuario->adm_usr_nivel=="E") echo "selected"; ?>>Editor</option> 
			</select>
	       <?php 
		}
		else 
		   if ($l_obj_usuario->adm_usr_nivel=="A")
			echo "Administrador"; 
		   else
		   	echo "Editor";	 
		?>
			  <br><br></td>
        </tr>
        <tr> 
          <td align="right" valign="top"><strong>Status:&nbsp;</strong></td>
          <td><? if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){ ?>
		  <select name='cad_user_status'> 
			<option <?php if ($l_str_acao == K_INCLUIR) echo "selected"; ?> value=''>-- Selecione --</option> 
			<option value='A' <?php if ($l_obj_usuario->adm_usr_status=="A") echo "selected"; ?>>Ativo</option> 
			<option value='I' <?php if ($l_obj_usuario->adm_usr_status=="I") echo "selected"; ?>>Inativo</option> 
		  </select>
	       <?php 
		}
		else 
		   if ($l_obj_usuario->adm_usr_status=="A")
			echo "Ativo"; 
		   else
		   	echo "Inativo";	 
		?>
		  
			  <br><br></td>
        </tr>
        <tr> 
          <td align="right" valign="top"><strong>Login:&nbsp;</strong></td>
          <td><? if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){ ?>
	  		<input name='cad_user_login' type='text' id='cad_user_login' size='40' value='<? echo $l_obj_usuario->adm_usr_login; ?>'> 
	     <? }else
	     		 echo $l_obj_usuario->adm_usr_login;
	     ?>

		  <br><br></td>
        </tr><? if($l_str_acao == K_INCLUIR || $l_str_acao == K_ALTERAR){ ?>
        <tr> 
          <td align="right" valign="top"><strong>Senha:&nbsp;</strong></td>
          <td><input name="cad_user_senha" type="password" id="cad_user_senha" size="40" value='<? echo $l_obj_usuario->adm_usr_senha; ?>'><br><br></td>
        </tr>
        <tr> 
          <td align="right"><strong>Repita a Senha:&nbsp;</strong></td>
          <td><input name="cad_user_senha2" type="password" id="cad_user_senha2" size="40" value='<? echo $l_obj_usuario->adm_usr_senha; ?>'><br><br></td>
        </tr> <? } ?>
        <tr> 
          <td colspan="2" align="center">
		  <input type="submit" name="Submit" value="<? echo $l_str_acao;?>">
		  <input type='button' value="&laquo; Voltar" onClick="GoTo('ap_index_lst_usuario.php')">
	  </td>
        </tr>
      </table>
		</td>
	</tr>

</table>
</form>