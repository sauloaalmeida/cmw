<?php

	if ($news_not_pk == ""){
		echo "<br><center><b>O c�digo da noticia n�o foi passado ou n�o existe not�cia cadastrada!</b><center>";
		exit();
	}
	else 	//se existe codigo busca a noticia       
        	$l_obj_noticia->getNoticia($news_not_pk);

?>	