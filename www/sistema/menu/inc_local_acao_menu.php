<a href="../adm/ap_index.php" id="link01">&raquo; In&iacute;cio</a>
<a href="ap_index_lst_menu.php" id="link01">&raquo; Menu do site</a>
<?php

$menu_link_pk = (isset($_REQUEST["menu_link_pk"]))?$_REQUEST["menu_link_pk"]:K_RAIZ_MENU;

    //vai ser necessario conectar com o banco
    $l_obj_menu = new MenuLink;

    //cria conexao com o banco
    $l_obj_menu->dbconn->conectar();

	//pega o meu atual
	$l_obj_menu->getMenu($menu_link_pk);

    //pega os menus pais de atual
    $RSmenu = $l_obj_menu->GetMenusPais($menu_link_pk);
    $totalMenus = $l_obj_menu->dbconn->getQtdRegistros($RSmenu);


    while ( $RStemp = $l_obj_menu->dbconn->getRecordsetArray($RSmenu) ) {

       echo "<a href='ap_index_lst_menu.php?menu_link_pk=".$RStemp["menu_link_pk"]."' id='link01'>&nbsp;&raquo; ".$RStemp["menu_link_nome"]."</a> ";

    }

?>
<span class="tx_texto_02">&raquo; <?php echo $l_str_acao ?> Menu</span>
