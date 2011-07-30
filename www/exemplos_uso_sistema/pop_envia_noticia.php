<?php
$mensagem = NULL;

if(!isset($_REQUEST["url"]) ){
    $mensagem = "O link da not&iacute;cia n&atilde;o foi informado.";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt_PT">
<head>
<?php include('incs/cabecalho.php'); ?>
<script type="text/javascript" src="nucleo/js/default.js"></script>
<script language="JavaScript" type="text/javascript">

function frm_validar(frm){


       if(func_bl_isvazio(frm.nomeRemetente,'O nome do remetente deve ser informado.'))
	      return false;

     if(!isEmail(frm.emailRemetente.value)){
	alert("E-mail do remenetnte em branco ou formato inv\u00e1lido.");
		frm.emailRemetente.focus();
		 return false;
	 }

       if(func_bl_isvazio(frm.nomeDestinatario,'O nome do destinat\u00e1rio deve ser informado.'))
	      return false;

     if(!isEmail(frm.emailDestinatario.value)){
	alert("E-mail do destinat\u00e1rio em branco ou formato inv\u00e1lido.");
		frm.emailDestinatario.focus();
		 return false;
	 }

     frm.submit();


}
</script>

</head>
<body style="background:none;" >

<?php if($mensagem==NULL){ ?>

<form name="frmEnviaNoticia" action="envia_noticia_done.php" method="POST" onsubmit="javascript:return frm_validar(this);">
        <input type="hidden" name="url" value="<?php echo $_REQUEST["url"]; ?>" />
        <table align="center" border="0" style="margin-top:10px;">
<tbody>
                <tr>
                  <td height="35" colspan="2" align="left" valign="top" class="txt_titulo2">Enviar Not&iacute;cia para um amigo</td>
                </tr>
                <tr>
                    <td align="left">Seu nome*:</td>
                  <td align="right"><input name="nomeRemetente" type="text" value="" size="30" /></td>
        </tr>
                <tr>
                    <td align="left">Seu e-mail*:</td>
                  <td align="right"><input name="emailRemetente" type="text" value="" size="30" /></td>
        </tr>
                <tr>
                    <td align="left">Nome destinat&aacute;rio*:</td>
                  <td align="right"><input name="nomeDestinatario" type="text" value="" size="30" /></td>
        </tr>
                <tr>
                    <td align="left">E-mail destinat&aacute;rio*:</td>
                  <td align="right"><input name="emailDestinatario" type="text" value="" size="30" /></td>
        </tr>
                <tr>
                    <td colspan="2" align="left">Deixe seu coment&aacute;rio</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="comentario" rows="4" cols="35"></textarea>                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right"><input type="submit" class="btn2" value="Enviar" />                      <input type="button" class="btn2" onclick="javascript:window.close();" value="Fechar" /></td>
      </tr>
            </tbody>
        </table>

</form>
    <?php } else {
           echo $mensagem;
           echo "<input type='button'  value='Fechar' onclick='javascript:window.close();' />";
          }
    ?>
    </body>
</html>