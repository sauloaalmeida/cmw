<?php
include 'nucleo/incs/inc_cache.php';
include 'nucleo/incs/inc_constantes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_seguranca.php';
$l_obj_seguranca = new Seguranca;
$l_obj_seguranca->ExpiraCookie();
?>
<html>
<head>
<title><?php echo K_TITULO_SISTEMA; ?></title>
<link href="nucleo/css/default.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" bottommargin="0" topmargin="0" rightmargin="0">
<table width="100%" height="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"> 
      <form action="rn_login.php" method="post" name="frm_login">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th scope="col">&nbsp;</th>
            <th width="350" scope="col"><table width="350" height="300" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" style="border-bottom:1px solid #ccc; border-top:1px solid #ccc;">
              <tr align="center">
                <td height="150" valign="middle"><img src="nucleo/imgs/logo.gif" width="213" height="194"></td>
              </tr>
              <tr class="bg_02">
                <td align="center" bgcolor="#333333" class="tx_texto_03">&Aacute;REA RESTRITA </td>
              </tr>
              <tr class="bg_02">
                <td align="right"><table width="80%" border="0" align="center" cellpadding="4" cellspacing="0">
                    <tr bgcolor="#FFFFFF" class="bg_02">
                      <td width="90" align="right"><strong>login:</strong></td>
                      <td width="10%"><input name="adm_usr_login" type="text" tabindex="1" style="font-size:14px; background:#fff;"></td>
                      <td rowspan="2" align="left"><input name="Submit" type="submit" class="botao01" tabindex="3" value="Entrar" style="width:80px;"></td>
                    </tr>
                    <tr bgcolor="#FFFFFF" class="bg_02">
                      <td width="90" align="right"><strong>senha:</strong></td>
                      <td><input name="adm_usr_senha" type="password" tabindex="2" style="font-size:14px; background:#fff;"></td>
                    </tr>
                </table></td>
              </tr>
            </table></th>
            <th scope="col">&nbsp;</th>
          </tr>
        </table>
      </form>
	  &nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span>&nbsp;
    </td>
  </tr>
</table>
</body>
</html>
