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

if(isset($_REQUEST["news_not_pk"])){
    $news_not_pk = $_REQUEST["news_not_pk"];
    $l_obj_noticia->GetNoticia($news_not_pk);
}else{
     $rsDestaqueNoticia = $l_obj_noticia->GetDestaque1(K_CAT_LICITACOES, K_IDI_PORTUGUES);
     $rsTempDestaqueNoticia = $l_obj_noticia->dbconn->getRecordsetArray($rsDestaqueNoticia);
     $news_not_pk = $rsTempDestaqueNoticia["news_not_pk"];
     $l_obj_noticia->GetNoticia($news_not_pk);
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
        <h2><?php echo $l_obj_noticia->news_not_titulo ;?>
          <?php include('incs/barra_icones.php'); ?></h2>
<div id="texto_conteudo">
<?php echo $l_obj_noticia->news_not_corpo ;?>
    <br/><br/>
       <?php
            $rsAnexos = $l_obj_noticia->getListaAnexos($l_obj_noticia->news_not_pk);
            while($rsTempAnexos = $l_obj_noticia->dbconn->getRecordsetArray($rsAnexos)){
        ?>
                <div style="margin-bottom:15px;"><h4><?php echo $rsTempAnexos["news_anx_titulo"]; ?> </h4>
                    <a href="<?php echo K_UPLOADDIR_EXIB_ANX_NOT.$rsTempAnexos["news_anx_path"]; ?>" target="_blank">Clique aqui</a>&nbsp;(<?php echo $rsTempAnexos["tipo_anx_nome"]; ?>)
                </div>
        <?php
            }
       ?>

</div>
    </div>
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
<?php $l_obj_noticia->dbconn->fechar();?>