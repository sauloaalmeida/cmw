<?php
include '../nucleo/incs/inc_cache.php';
include '../nucleo/incs/inc_constantes.php';
include '../nucleo/incs/inc_funcoes.php';
include '../nucleo/classes/cl_dbconn.php';
include '../nucleo/classes/cl_noticia.php';
include '../nucleo/classes/feedwriter/FeedItem.php';
include '../nucleo/classes/feedwriter/FeedWriter.php';

  $qdtNoticia = 200;

  //Creating an instance of FeedWriter class.
  $feed = new FeedWriter(RSS2);

  //Setting the channel elements
  //Use wrapper functions for common channel elements
  $feed->setTitle('Conselho Regional de Medicina Veterinária da Bahia');
  $feed->setLink(K_SITE_URL_COMPLETA.'/rss');
  $feed->setDescription('RSS do site do Conselho Regional de Medicina Veterinária da Bahia');

  //Image title and link must match with the 'title' and 'link' channel elements for valid RSS 2.0
  $feed->setImage('RSS CRMVBA',K_SITE_URL_COMPLETA.'/rss',K_SITE_URL_COMPLETA.'/images/logo_crmv.png');



	//Detriving informations from database addin feeds
	$l_obj_noticia = new noticia;
	$l_obj_noticia->dbconn->conectar();


$rsNoticias = $l_obj_noticia->getUltimasNoticias(K_CAT_NOTICIAS, $qdtNoticia, K_IDI_PORTUGUES);

while ($row = $l_obj_noticia->dbconn->getRecordsetArray($rsNoticias)){


		//Create an empty FeedItem
		$newItem = $feed->createNewItem();

		//Add elements to the feed item
		$newItem->setTitle($row['news_not_titulo']);
		$newItem->setLink(K_SITE_URL_COMPLETA.'/noticias.php?news_not_pk='.$row['news_not_pk']);
		$newItem->setDate($row['news_not_dt_inicio']);
		$newItem->setDescription(substr($row['news_not_chamada'],100)."...");

		//Now add the feed item
		$feed->addItem($newItem);
	}

	$l_obj_noticia->dbconn->fechar();

  //OK. Everything is done. Now genarate the feed.
  $feed->genarateFeed();
  ?>