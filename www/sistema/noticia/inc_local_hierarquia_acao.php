<a href="../adm/ap_index.php" id="link01">&raquo; In&iacute;cio</a>

<?php

if(isset($_REQUEST["news_cat_pk"])){

    //vai ser necessario conectar com o banco
    $l_obj_noticia = new Noticia;

    //cria conexao com o banco
    $l_obj_noticia->dbconn->conectar();

    //coloca o menu para voltar para a raiz
        echo "<a href='../noticia/ap_index_inicio.php' id='link01'>&raquo; Not&iacute;cias</a>";

    //pega as categorias pais de atual
    $RScategoria = $l_obj_noticia->GetCategoriasPais($_REQUEST["news_cat_pk"]);
    $totalCategorias = $l_obj_noticia->dbconn->getQtdRegistros($RScategoria);

    $count = 1;
    while ( $RStemp = $l_obj_noticia->dbconn->getRecordsetArray($RScategoria) ) {

        if($count < $totalCategorias)
            echo "<a href='../noticia/ap_index_inicio.php?news_cat_pk=".$RStemp["news_cat_pk"]."' id='link01'>&nbsp;&raquo; ".$RStemp["news_cat_nome"]."</a>";
        else
            echo "<a href='../noticia/ap_index_lst_noticia.php?news_cat_pk=".$RStemp["news_cat_pk"]."' id='link01'>&nbsp;&raquo; ".$RStemp["news_cat_nome"]."</a>";

        $count++;
     }

    //fecha conexao
    $l_obj_noticia->dbconn->fechar();

}
else{
    echo "<span class='tx_texto_02'>&raquo; Not&iacute;cias</span>";
}

?>
