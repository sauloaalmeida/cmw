<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_mailusuario.php';

//verifica se as variaveis foram passadas para pagina
if(!isset($_REQUEST["l_str_acao"]))
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "Alguns parametros necess�rios n�o foram postados para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

//captura as variaveis da pagina anterior
$l_str_acao = $_REQUEST["l_str_acao"];


//verifica se as variaveis foram passadas para pagina
if(!isset($_REQUEST["l_str_acao"]))
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "Alguns parametros necess�rios n�o foram postados para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

//captura as variaveis da pagina anterior
$l_str_acao = $_REQUEST["l_str_acao"];

?>
<html>
<head><title><?php echo K_TITULO_SISTEMA; ?></title>
<script language="JavaScript" type="text/javascript" src="../nucleo/js/default.js"></script>
<link href="../nucleo/css/default.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="../nucleo/submodal/subModal.css" />
<script type="text/javascript" src="../nucleo/submodal/common.js"></script>
<script type="text/javascript" src="../nucleo/submodal/subModal.js"></script>
</head>
<body leftmargin="0" bottommargin="0" marginheight="0" marginwidth="0" rightmargin="0" topmargin="0">
<table width="100%" height="100%" border="0">
  <tr><td height="60" valign="top"><?php include '../nucleo/incs/inc_topo.php'; ?></td></tr>
  <tr><td height="15" valign="bottom" id="rastro"><?php include 'inc_local_acao_envio.php'; ?></td></tr>
  <tr>
     <td valign="top" ><?php include 'ap_sel_envio.php'; ?></td>
  </tr>
</table>
</body>
</html>
