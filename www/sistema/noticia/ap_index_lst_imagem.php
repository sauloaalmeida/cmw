<?php
//includes utilizados
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_seguranca.php';
include '../nucleo/incs/inc_seguranca.php';
include 'cl_noticia.php';
?>
<html>
<head><title><?php echo K_TITULO_SISTEMA; ?></title>
<script language="JavaScript" type="text/javascript" src="../nucleo/js/default.js"></script>

<?php 
if(!isset($_REQUEST["news_not_pk"]))
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O campo news_not_pk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

$news_not_pk = $_REQUEST["news_not_pk"];

if(!isset($_REQUEST["news_cat_pk"]))
     msg(K_MSGERRO, K_VOLTAR, "Falta de parametros", "O campo news_cat_pk nao foi postado para a pagina<br><br>Clique em voltar e tente novament se o problema persistir contate o administrador!");

$news_cat_pk = $_REQUEST["news_cat_pk"];


//instancia objeto de noticia para pegar a categoria da noticia
$l_obj_noticia = new Noticia();

$news_cat_nome = $l_obj_noticia->getNomeCategoria($news_cat_pk);

$l_obj_noticia->dbconn->fechar();
?>
<link href="../nucleo/css/default.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" bottommargin="0" marginheight="0" marginwidth="0" rightmargin="0" topmargin="0">
<table width="100%" height="100%" border="0">
  <tr><td height="60" valign="top"><?php include '../nucleo/incs/inc_topo.php'; ?></td></tr>
  <tr><td height="15" valign="bottom" id="rastro"><?php include 'inc_local_imagem.php'; ?></td></tr>
  <tr>
     <td valign="top"><?php include 'ap_lst_imagem.php'; ?></td>
  </tr>
</table>
</body>
</html>
