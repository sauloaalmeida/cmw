<?php
include 'nucleo/incs/inc_cache.php';
include 'nucleo/incs/inc_constantes.php';
include 'nucleo/incs/inc_funcoes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_noticia.php';

$l_obj_noticia = new Noticia();
$l_obj_noticia->dbconn->conectar();

if(isset($_REQUEST["news_img_pk"])){
   $news_img_pk = $_REQUEST["news_img_pk"];
   $RSimagem = $l_obj_noticia->getRsImagem($news_img_pk);
	   if($l_obj_noticia->dbconn->getExisteRecordset($RSimagem)){
	   		$RStemp = $l_obj_noticia->dbconn->getRecordsetArray($RSimagem);
	   }
}
else{
	if(isset($_REQUEST["news_not_pk"])){
	   $news_not_pk = $_REQUEST["news_not_pk"];
	   $RSimagem = $l_obj_noticia->getListaImagens($news_not_pk);
	   $RStemp = $l_obj_noticia->dbconn->getRecordsetArray($RSimagem);
	}
}


?>
<html>
<head>
</head>

<body>

    <table width="10%" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td><table width="435" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><em style="font-size:12px;">foto: <?php echo $RStemp["news_img_credito"];?> </em></td>
  </tr>
</table>
</td>
              </tr>
              <tr>
                <td align="center">
                    <img height="315" src='<?php echo K_UPLOADDIR_EXIB_IMG_NOT.$RStemp["news_img_path2"];?>' /></td>
              </tr>
              <tr>
                <td width="315" align="left"><table width="435" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center"> <strong style="font-size:12px;"><?php echo $RStemp["news_img_titulo"];?></strong></td>
                  </tr>
                </table></td>
              </tr>
</table>

</body>
<?php
$l_obj_noticia->dbconn->fechar();
?>