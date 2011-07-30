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
        <table width="350" cellspacing="0" cellpadding="0"  class="borda_01">
          <tr> 
            <td width="87" rowspan="2" align="right" valign="middle" height="55"><img src="nucleo/imgs/logo.gif"></td>
            <td width="66" align="right">login:</td>
            <td width="124"><input name="adm_usr_login" type="text" tabindex="1"></td>
            <td width="71" rowspan="2" align="center"><input type="submit" name="Submit" value="Enviar" tabindex="3"></td>
          </tr>
          <tr> 
            <td align="right">senha:</td>
            <td><input name="adm_usr_senha" type="password" tabindex="2" ></td>
          </tr>
		</table>
        </form>
	  &nbsp;<span class="tx_msg_erro"><?php if (isset($_REQUEST['l_str_msg'])) echo $_REQUEST['l_str_msg']; ?></span>&nbsp;
	  </td>
  </tr>
</table>
</body>
</html>
