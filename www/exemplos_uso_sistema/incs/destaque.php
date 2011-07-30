<div id="destaque">
        <h2>DESTAQUE</h2>
        <?php if($existeDestaqueNoticia){
            
            $rsDestaqueNoticia = $l_obj_noticia->GetDestaque1(K_CAT_NOTICIAS, K_IDI_PORTUGUES);
            $rsTempDestaqueNoticia = $l_obj_noticia->dbconn->getRecordsetArray($rsDestaqueNoticia);

            $existeImagemDestaque = false;
            $rsImagemDestaque = $l_obj_noticia->getImagemDestaque($rsTempDestaqueNoticia["news_not_pk"]);
            if($l_obj_noticia->dbconn->getExisteRecordset($rsImagemDestaque)){
                $rsTempImagemDestaque = $l_obj_noticia->dbconn->getRecordsetArray($rsImagemDestaque);
                $existeImagemDestaque = true;
            }
            
          ?>
        <p>
          <?php if($existeImagemDestaque) {?>
         <img src="<?php echo K_UPLOADDIR_EXIB_IMG_NOT.$rsTempImagemDestaque["news_img_path1"]; ?>" width="190" height="130" align="left" class="border01">
         <?php } ?>
        <span class="txt02"><?php echo $rsTempDestaqueNoticia["news_not_titulo"];?></span><br>
          <?php echo $rsTempDestaqueNoticia["news_not_chamada"];?><br>
          <a href="noticias.php?news_not_pk=<?php echo $rsTempDestaqueNoticia["news_not_pk"];?>">[+] leia mais</a></p>
        <?php }?>
      </div>