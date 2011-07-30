<?php
include 'nucleo/incs/inc_cache.php';
include 'nucleo/incs/inc_constantes.php';
include 'nucleo/incs/inc_funcoes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_noticia.php';

$l_obj_noticia = new noticia;
$l_obj_noticia->dbconn->conectar();

if(isset($_REQUEST["news_not_pk"])){
    $news_not_pk = $_REQUEST["news_not_pk"];
    $l_obj_noticia->GetNoticia($news_not_pk);
}else{
     $rsDestaqueNoticia = $l_obj_noticia->GetDestaque1(K_CAT_NOTICIAS, K_IDI_PORTUGUES);
     $rsTempDestaqueNoticia = $l_obj_noticia->dbconn->getRecordsetArray($rsDestaqueNoticia);
     $news_not_pk = $rsTempDestaqueNoticia["news_not_pk"];
     $l_obj_noticia->GetNoticia($news_not_pk);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php include('incs_sem_programacao/cabecalho.php'); ?>
</head>
<body>
<div id="content">
  <?php include('incs_sem_programacao/top.php'); ?>
  <?php include('incs_sem_programacao/menu_topo.php'); ?>
  <div id="container">
    <div id="column_1">
      <?php include('incs_sem_programacao/menu.php'); ?>
      <?php include('incs_sem_programacao/biblioteca.php'); ?>
    </div>
    <div id="column_2"><div id="texto">
        <h2>NOT&Iacute;CIAS<?php $url='noticias.php';
         include('incs_sem_programacao/barra_icones.php'); ?></h2>

        <?php

        ?>
          <p><span class="txt03"><?php echo $l_obj_noticia->news_not_titulo ;?></span>
          - <?php echo $l_obj_noticia->news_not_dt_inicio ;?> </p>
          <?php echo $l_obj_noticia->news_not_corpo ;?>
    </div>
        </div>
    <div id="column_3">
      <?php include('incs_sem_programacao/enquete.php'); ?>
      <?php include('incs_sem_programacao/newsletter.php'); ?>
      <?php include('incs_sem_programacao/parceiros.php'); ?>
    </div>
  </div><!-- content-->

  <div style="clear:both"> </div>
  <?php include('incs_sem_programacao/rodape.php'); ?><!-- footer-->

</div><!-- container -->

</body>
</html>
<?php $l_obj_noticia->dbconn->fechar();?>