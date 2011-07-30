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

$qdtNoticias = 2000;

$bl_pesquisa_enviada = true;

if(!isset($_POST["pesquisa"]) ||  strlen(trim($_POST["pesquisa"]))<=2 ){
    $bl_pesquisa_enviada = false;
}

$pesquisa = trim($_POST["pesquisa"]);

function func_link_area_site($news_cat_fk){

    $retorno = "noticias.php";


           if($news_cat_fk == K_CAT_NOTICIAS)
                $retorno = "noticias.php";

           if($news_cat_fk == K_CAT_PAGINAS_SITE)
                $retorno = "conteudo_site.php";

           if($news_cat_fk == K_CAT_BALANCETES)
                $retorno = "balancetes.php";

           if($news_cat_fk == K_CAT_DOWNLOADS)
                $retorno = "downloads.php";

           if($news_cat_fk == K_CAT_ARTIGOS_TECNICOS)
                $retorno = "artigos_tecnicos.php";

           if($news_cat_fk == K_CAT_LICITACOES)
                $retorno = "licitacoes.php";

           if($news_cat_fk == K_CAT_GALERIA)
                $retorno = "galeria.php";

           if($news_cat_fk == K_CAT_VIDEOS)
                $retorno = "videos.php";

       return $retorno;

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
        <h2>Pesquisa do site
          <?php include('incs/barra_icones.php'); ?></h2>
<div id="texto_conteudo">
    <br/>
    <table cellspacing="0" cellpadding="5" width="100%" border="0">
          <tbody>

        <?php
        if(!$bl_pesquisa_enviada){
         ?>
           <tr>
              <td bgcolor="#FFFFFF">
                  <div align="left">
                      O texto que ser&aacute; pesquisado n&atilde;o foi enviado, ou &eacute; menor que tr&ecirc;s caracteres. Inicie sua pesquisa novamente no topo do site.
                  </div>
              </td>
            </tr>
        <?php
        }else{

           $listaCategorias = K_CAT_NOTICIAS.",";
           $listaCategorias.= K_CAT_PAGINAS_SITE.",";
           $listaCategorias.= K_CAT_BALANCETES.",";
           $listaCategorias.= K_CAT_DOWNLOADS.",";
           $listaCategorias.= K_CAT_GALERIA.",";
           $listaCategorias.= K_CAT_ARTIGOS_TECNICOS.",";
           $listaCategorias.= K_CAT_LICITACOES.",";
           $listaCategorias.= K_CAT_VIDEOS;

           $rsNoticias = $l_obj_noticia->pesquisar($pesquisa,$listaCategorias,$qdtNoticias,K_IDI_PORTUGUES);
           while($rsTempNoticias = $l_obj_noticia->dbconn->getRecordsetArray($rsNoticias)){
        ?>
            <tr>
              <td bgcolor="#FFFFFF"><div align="left"><span class="txt_titulo1"><?php echo $rsTempNoticias["news_not_titulo"];?></span><a href="<?php echo func_link_area_site($rsTempNoticias["news_cat_fk"]);?>?news_not_pk=<?php echo $rsTempNoticias["news_not_pk"];?>" class="news"><br />
                Data de publica&ccedil;&atilde;o:<?php  echo $rsTempNoticias["news_not_dt_inicio"];?><br />
                <em class="txt_legenda">&Aacute;rea do site: <?php echo $rsTempNoticias["news_cat_nome"];?></em></a></div></td>
            </tr>
        <?php }?>
          </tbody>
       <?php }?>
        </table>

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