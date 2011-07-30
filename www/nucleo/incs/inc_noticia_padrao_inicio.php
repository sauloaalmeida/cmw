<?php

	if ($news_not_pk == ""){
		echo "<br><center><b>O código da noticia não foi passado ou não existe notícia cadastrada!</b><center>";
		exit();
	}
	else 	//se existe codigo busca a noticia       
        	$l_obj_noticia->getNoticia($news_not_pk);

?>	