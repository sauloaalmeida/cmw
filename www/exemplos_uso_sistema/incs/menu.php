<?php
$l_obj_menu = new MenuLink;
$l_obj_menu->dbconn->conectar();

$rsMenuObj = $l_obj_menu->getArvoreMenu();
?>

<div id="menu">
<div>
  <!-- QuickMenu Structure [Menu 0] -->
 <?php
  $nivelMenuAnterior  = 0;
  $blInicio=true;


  while($rsMenu = $l_obj_menu->dbconn->getRecordsetArray($rsMenuObj)) {

        if($nivelMenuAnterior < $rsMenu["menu_link_nivel"] && $rsMenu["menu_link_nivel"] == 1){

              echo "<ul ".(($blInicio)?"id='qm0' class='qmmc'":"").">\n";
              echo "   <li><a class='qmparent' ".( ($rsMenu["menu_link_target"]!=NULL && trim($rsMenu["menu_link_target"])!="")?"target='".$rsMenu["menu_link_target"]."'":"")." href='".(($rsMenu["menu_link_url"]!=NULL && trim($rsMenu["menu_link_url"])!="")?$rsMenu["menu_link_url"]:"javascript:void(0)")."'>".$rsMenu["menu_link_nome"]."</a>";
              if($rsMenu["menu_link_existe_filho"] == 0){
                 echo "</li>\n";
              }
              
              if($blInicio){
                   $blInicio = false;
              }
        }

        if($nivelMenuAnterior < $rsMenu["menu_link_nivel"] && $rsMenu["menu_link_nivel"] == 2){
            echo "   <ul>\n";
            echo      "      <li><a  ".( ($rsMenu["menu_link_target"]!=NULL && trim($rsMenu["menu_link_target"])!="")?"target='".$rsMenu["menu_link_target"]."'":"")." href='".(($rsMenu["menu_link_url"]!=NULL && trim($rsMenu["menu_link_url"])!="")?$rsMenu["menu_link_url"]:"javascript:void(0)")."'>".$rsMenu["menu_link_nome"]."</a></li>\n";
        }

        if($nivelMenuAnterior == $rsMenu["menu_link_nivel"] &&  $rsMenu["menu_link_nivel"] == 1){
             echo "<li><a class='qmparent'  ".( ($rsMenu["menu_link_target"]!=NULL && trim($rsMenu["menu_link_target"])!="")?"target='".$rsMenu["menu_link_target"]."'":"")." href='".(($rsMenu["menu_link_url"]!=NULL && trim($rsMenu["menu_link_url"])!="")?$rsMenu["menu_link_url"]:"javascript:void(0)")."'>".$rsMenu["menu_link_nome"]."</a>";
              if($rsMenu["menu_link_existe_filho"] == 0){
                 echo "</li>\n";
              }
        }

        if($nivelMenuAnterior == $rsMenu["menu_link_nivel"] &&  $rsMenu["menu_link_nivel"] == 2){
            echo  "      <li><a  ".( ($rsMenu["menu_link_target"]!=NULL && trim($rsMenu["menu_link_target"])!="")?"target='".$rsMenu["menu_link_target"]."'":"")." href='".(($rsMenu["menu_link_url"]!=NULL && trim($rsMenu["menu_link_url"])!="")?$rsMenu["menu_link_url"]:"javascript:void(0)")."'>".$rsMenu["menu_link_nome"]."</a></li>\n";
        }

        if($nivelMenuAnterior > $rsMenu["menu_link_nivel"]){
            echo "   </ul>\n";
            echo "   <li><a class='qmparent'  ".( ($rsMenu["menu_link_target"]!=NULL && trim($rsMenu["menu_link_target"])!="")?"target='".$rsMenu["menu_link_target"]."'":"")." href='".(($rsMenu["menu_link_url"]!=NULL && trim($rsMenu["menu_link_url"])!="")?$rsMenu["menu_link_url"]:"javascript:void(0)")."'>".$rsMenu["menu_link_nome"]."</a>";

            if($rsMenu["menu_link_existe_filho"] == 0){
                 echo "</li>\n";
            }
        }


        $nivelMenuAnterior = $rsMenu["menu_link_nivel"];
    }
    echo "<li class='qmclear'>&nbsp;</li>";
    echo "</ul>\n";
  ?>
  </div>
  <!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
  <script type="text/javascript">qm_create(0,true,0,500,'all',false,false,false,false);</script>
</div>

<?php $l_obj_menu->dbconn->fechar(); ?>