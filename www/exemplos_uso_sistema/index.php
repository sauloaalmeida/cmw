<?php
include 'nucleo/incs/inc_cache.php';
include 'nucleo/incs/inc_constantes.php';
include 'nucleo/incs/inc_funcoes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_noticia.php';
include 'nucleo/classes/cl_enquete.php';
include 'nucleo/classes/cl_resposta.php';
include 'nucleo/classes/cl_menulink.php';


$l_obj_noticia = new noticia;
$l_obj_noticia->dbconn->conectar();

$qdtDestaquesNoticia = 1;
$existeDestaqueNoticia = false;
$qdtOutrasNoticia = 5;
$rsDestaqueNoticia = $l_obj_noticia->getUltimasNoticiasDestaques(K_CAT_NOTICIAS,$qdtDestaquesNoticia,K_IDI_PORTUGUES);

if($l_obj_noticia->dbconn->getExisteRecordset($rsDestaqueNoticia)){
   $existeDestaqueNoticia = true;
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php include('incs/cabecalho.php'); ?>
</head>
<body>
<div id="content">
  <?php include('incs/top.php'); ?>
  <?php include('incs/menu_topo.php'); ?>
  <div id="container">
    <div id="column_1">
      <?php include('incs/menu.php'); ?>
      <?php include('incs/biblioteca.php'); ?>
    </div>
    <div id="column_2">
      <?php include('incs/banner.php'); ?>
      <?php include('incs/destaque.php'); ?>
      <?php include('incs/ultimas_noticias.php'); ?>
      <?php include('incs/banners_rodape.php'); ?>
    </div>
    <div id="column_3">
      <?php include('incs/enquete.php'); ?>
      <?php include('incs/newsletter.php'); ?>
      <?php include('incs/parceiros.php'); ?>
    </div>
  </div><!-- content-->
  
  <div style="clear:both"> </div>
  <?php include('incs/rodape.php'); ?><!-- footer-->
  
</div><!-- container -->

</body>
</html>
