<?php
include 'nucleo/incs/inc_cache.php';
include 'nucleo/incs/inc_constantes.php';
include 'nucleo/incs/inc_funcoes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_noticia.php';
include 'nucleo/classes/cl_enquete.php';
include 'nucleo/classes/cl_resposta.php';
include 'nucleo/classes/cl_menulink.php';

$qdtOutrasNoticia = 100;
$l_possui_imagem = false;

$l_obj_noticia = new Noticia();
$l_obj_noticia->dbconn->conectar();

if(isset($_REQUEST["news_not_pk"])){
    $news_not_pk = $_REQUEST["news_not_pk"];
    $l_obj_noticia->GetNoticia($news_not_pk);
}else{
     $rsDestaqueNoticia = $l_obj_noticia->GetDestaque1(K_CAT_GALERIA, K_IDI_PORTUGUES);
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
        <h2>Galeria de Fotos
          <?php include('incs/barra_icones.php'); ?></h2>
<div id="texto_conteudo">
    <table width="100%" border="0" cellpadding="8" cellspacing="0" style="border-bottom:3px solid #666;">
          <tr>
            <td height="30" colspan="2" bgcolor="#FFFFFF" style="border-bottom:3px solid #666;"><span class="txt_titulo1"><?php echo $l_obj_noticia->news_not_titulo ;?></span> - <?php echo $l_obj_noticia->news_not_dt_inicio ;?></td>
          </tr>
          <tr>
            <td height="300" align="center" valign="top" bgcolor="#FFFFFF">
        	 <iframe src="galeria_detalhe.php?news_not_pk=<?php echo $news_not_pk ?>" name="ifrmDetalheImagem" id="ifrmDetalheImagem" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:445px;height:380px;"></iframe>
            </td>
            <td bgcolor="#e5e7e7" width="100" align="center" valign="top" style="border-left:1px solid #666;">
		<iframe src="galeria_indice.php?news_not_pk=<?php echo $news_not_pk ?>" name="ifrmIndiceImagem" id="ifrmIndiceImagem" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:96px;height:380px;background-color:#e5e7e7;"></iframe>
            </td>
          </tr>
        </table>
        <div style="float:left; width:580px; background:#fff; padding:10px 10px 5px 10px; border:1px solid #E3E3E3; border-bottom:0; text-align:left; margin-top:15px"><span class="txt_titulo2">Outras Galerias </span></div>
        <div id="mais_noticias" style="width:580px;">

	    <ul class="news_ul">
      	  <?php
	      	$rsOutrasNoticias = $l_obj_noticia->getUltimasNoticiasNotIn(K_CAT_GALERIA,$qdtOutrasNoticia,$news_not_pk,K_IDI_PORTUGUES);
			while($rsTempOutrasNoticias = $l_obj_noticia->dbconn->getRecordsetArray($rsOutrasNoticias)) {?>
      		      <li><span class="txt_data"><?php echo $rsTempOutrasNoticias["news_not_dt_inicio"];?></span>&nbsp; <a href="galeria.php?news_not_pk=<?php echo $rsTempOutrasNoticias["news_not_pk"];?>" class="news"><?php echo $rsTempOutrasNoticias["news_not_titulo"];?></a></li>
	       <?php }?>
	    </ul>
        </div>

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