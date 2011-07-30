<br>
<table width="100%" border="0" align="center">
<?php
$l_obj_noticia = new Noticia;

//cria conexao com o banco
$l_obj_noticia->dbconn->conectar();

if(!isset($_REQUEST["news_cat_pk"])){
    //pega as categorias todas as categorias da raiz
    $RScategoria = $l_obj_noticia->GetCategorias();
}else{
    $RScategoria = $l_obj_noticia->GetCategoriasFilhas($_REQUEST["news_cat_pk"]);
}


while ( $RStemp = $l_obj_noticia->dbconn->getRecordsetArray($RScategoria) ) {

  $url = ($RStemp["news_cat_tem_filho"] == 'S')?'../noticia/ap_index_inicio.php':'../noticia/ap_index_lst_noticia.php';

  echo "<tr><td style='padding-bottom:8px;'><input type='button' value=\"".$RStemp["news_cat_nome"]."\" class='botao01' onClick=\"GoTo('".$url."?news_cat_pk=".$RStemp["news_cat_pk"]."')\"</td></tr>";
}

$l_obj_noticia->dbconn->fechar();
?>
</table>