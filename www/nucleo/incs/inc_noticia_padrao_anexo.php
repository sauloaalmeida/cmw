<?php

	//inicio anexo noticia
	$RSanexo = $l_obj_noticia->getListaAnexos($news_not_pk);
	if( $l_obj_noticia->dbconn->getExisteRecordset($RSanexo) ){

	       echo "<table>";

	       while($RStempAnexo = $l_obj_noticia->dbconn->getRecordsetArray($RSanexo)){
		       echo "<tr>";
		       echo "  <td>";
		       echo "    <a href='".K_UPLOADDIR_EXIB_ANX_NOT.$RStempAnexo["news_anx_path"]."'target='_blank'>";
                       echo "<img src='".K_UPLOADDIR_EXIB_ICO_ANX_TP.$RStempAnexo["tipo_anx_icone"]."' border='0'></a>";
		       echo "  <td/>";
		       echo "  <td align='left'>";
            echo " <b><a href='".K_UPLOADDIR_EXIB_ANX_NOT.$RStempAnexo["news_anx_path"]."'target='_blank'></b>";
            echo $RStempAnexo["news_anx_titulo"]."</a><br>";
   		       echo "     <b>Formato arquivo: </b>".$RStempAnexo["tipo_anx_nome"]."<br>";
   		       echo "     <b>Descri&ccedil;&atilde;o: </b>".$RStempAnexo["news_anx_descricao"]."<br>";
		       echo "  <td/>";
		       echo " <tr>";
		}

	        echo "</table>";
	}
	//fim anexo noticia

?>
