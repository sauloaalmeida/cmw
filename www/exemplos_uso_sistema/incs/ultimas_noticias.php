
<div id="ultimas_noticias">
    <h2>&Uacute;ltimas Not&iacute;cias</h2>
        <?php
         $rsOutrasNoticias = $l_obj_noticia->getUltimasNoticiasNotIn(K_CAT_NOTICIAS,$qdtOutrasNoticia,$rsTempDestaqueNoticia["news_not_pk"],K_IDI_PORTUGUES);
         if($l_obj_noticia->dbconn->getExisteRecordset($rsOutrasNoticias)){
        ?>
        <?php while($rsTempOutrasNoticias = $l_obj_noticia->dbconn->getRecordsetArray($rsOutrasNoticias)) {?>
        <li><span class="txt01"><?php echo $rsTempOutrasNoticias["news_not_dt_inicio"];?> - </span><a href="noticias.php?news_not_pk=<?php echo $rsTempOutrasNoticias["news_not_pk"];?>" class="noticias"><?php echo $rsTempOutrasNoticias["news_not_titulo"];?></a></li>
     <?php }
         }?>
      </div>