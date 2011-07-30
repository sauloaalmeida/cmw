<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_menulink.php';
?>
<html>
<head><title><?php echo K_TITULO_SISTEMA; ?></title>
<script language="JavaScript" type="text/javascript" src="../nucleo/js/default.js"></script>
<script type="text/javascript" src="../nucleo/treemenu/simpletreemenu.js"></script>
<link rel="stylesheet" type="text/css" href="../nucleo/treemenu/simpletree.css" />
<link href="../nucleo/css/default.css" rel="stylesheet" type="text/css">

</head>
<body leftmargin="0" bottommargin="0" marginheight="0" marginwidth="0" rightmargin="0" topmargin="0">
<table width="100%" height="100%" border="0">
  <tr><td height="60" valign="top"><?php include '../nucleo/incs/inc_topo.php'; ?></td></tr>
  <tr><td height="15" valign="bottom" id="rastro"><?php include 'inc_local_menu.php'; ?></td></tr>
  <tr>
     <td valign="top"><?php include 'ap_lst_menu.php'; ?></td>
  </tr>
</table>
</body>
</html>
