<?php

	
	//inicio Imagem noticia
	$RSimagem = $l_obj_noticia->getListaImagensNotDestaque($news_not_pk);
	if( $l_obj_noticia->dbconn->getExisteRecordset($RSimagem) ){
							   
 	        $RStemp = $l_obj_noticia->dbconn->getRecordsetArray($RSimagem);
							     
		if($RStemp["news_img_path2"] != "")
		      echo "<a href=\"javascript:AbreJanela('visualiza_imagem_detalhe.php?news_img_pk=".$RStemp["news_img_pk"]."','Visualiza_Imagem','height=550, width=600, scrollbars=yes, resizable=yes');\">";
	                               
		echo "<img src='".K_UPLOADDIR_EXIB_IMG_NOT.$RStemp["news_img_path1"]."' width='160' height='120' hspace='5' vspace='2' align='right' class='borda01'>";
	 
		if($RStemp["news_img_path2"] != "")
		      echo "</a>";
	}   
	//fim Imagem noticia

	
?>