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
$l_existe_noticia = false;


if(isset($_REQUEST["news_not_pk"])){
    $news_not_pk = $_REQUEST["news_not_pk"];
    $l_obj_noticia->GetNoticia($news_not_pk);
    $l_existe_noticia = true;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"   "http://www.w3.org/TR/html4/strict.dtd">
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
    <div id="column_2"><div id="texto">
            <h2><?php echo $l_obj_noticia->news_not_origem ;?><?php include('incs/barra_icones.php'); ?></h2>

        <?php

        ?>
          <p><span class="txt03"><?php echo $l_obj_noticia->news_not_titulo ;?></span>
          - <?php echo $l_obj_noticia->news_not_dt_inicio ;?> </p>
          <?php echo $l_obj_noticia->news_not_corpo ;?>
    </div>
        </div>
    <div id="column_3">
      <?php include('incs/enquete.php'); ?>
      <?php include('incs/newsletter.php'); ?>
      <?php include('incs/parceiros.php'); ?>
    </div>
  </div><!-- content-->

  <div style="clear:both"> </div>
  <?php include('incs_sem_programacao/rodape.php'); ?><!-- footer-->

</div><!-- container -->

</body>
</html>
<?php $l_obj_noticia->dbconn->fechar();?>