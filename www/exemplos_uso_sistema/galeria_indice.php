<?php
include 'nucleo/incs/inc_cache.php';
include 'nucleo/incs/inc_constantes.php';
include 'nucleo/incs/inc_funcoes.php';
include 'nucleo/classes/cl_dbconn.php';
include 'nucleo/classes/cl_noticia.php';

$l_int_pag = 1;

if(isset($_REQUEST["l_int_pag"]))
	$l_int_pag = $_REQUEST["l_int_pag"];

$news_not_pk = $_REQUEST["news_not_pk"];

$l_int_count = 0;

$l_obj_noticia = new Noticia();

$l_obj_noticia->dbconn->conectar();

$RSimagem = $l_obj_noticia->getListaImagensNotDestaque($news_not_pk);

?>
<html>
<head>
<style type="text/css">
<!--
body {
	background-color: #e5e7e7;
}
-->
</style></head>
<body>

    <table bgcolor="#e5e7e7" border="0" cellspacing="3" cellpadding="0" align="center">
		<?php
		if($l_int_pag > 1)
		    $l_obj_noticia->dbconn->moveto($RSimagem,(($l_int_pag-1)*K_QTD_IMG_GALERIA));

		while ( ($RStemp = $l_obj_noticia->dbconn->getRecordsetArray($RSimagem)) && ($l_int_count <= (K_QTD_IMG_GALERIA -1)) ){
		?>
              <tr>
                <td><a href='galeria_detalhe.php?news_img_pk=<?php echo $RStemp["news_img_pk"]; ?>' target='ifrmDetalheImagem'><img src='<?php echo K_UPLOADDIR_EXIB_IMG_NOT.$RStemp["news_img_path1"]; ?>' width='90' height='66' border='0'></a></td>
              </tr>
		<?php
			$l_int_count++;
		}?>

		  <tr>
                      <td align="center" valign="bottom" bgcolor="#e5e7e7">
			  <table bgcolor="#e5e7e7" border="0" cellspacing="0" cellpadding="0">
      		        <tr>
					<?php
						$l_total_registros = $l_obj_noticia->dbconn->getQtdRegistros($RSimagem);
						$l_total_paginas = ($l_total_registros%K_QTD_IMG_GALERIA == 0)? $l_total_registros/K_QTD_IMG_GALERIA:($l_total_registros/K_QTD_IMG_GALERIA)+1;
                                                $l_total_paginas = floor($l_total_paginas);
					?>
		                <td width="20" align="center" class="txt_titulo3">
					<?php if($l_int_pag > 1 ) {?>
					<strong class="txt_titulo3"><a href="galeria_indice.php?news_not_pk=<?php echo $news_not_pk;?>&l_int_pag=<?php echo ($l_int_pag - 1);?>">&lt;</a></strong>
					<?php }?>
				    </td>

				    <td align="center">
					<span class="txt_titulo2"><strong><?php echo $l_int_pag;?></strong> de<strong> <?php echo $l_total_paginas ;?></ </strong></span>
				    </td>

				    <td width="20" align="center">
					<?php if(($l_total_registros - ($l_int_pag * K_QTD_IMG_GALERIA)) > 0 ){?>
					<strong class="txt_titulo3"><a href="galeria_indice.php?news_not_pk=<?php echo $news_not_pk;?>&l_int_pag=<?php echo ($l_int_pag + 1);?>">&gt;</a></strong>
					<?php }?>
				    </td>
       		    </tr>
		         </table>
			</td>
		  </tr>
</table>
<?php $l_obj_noticia->dbconn->fechar();?>