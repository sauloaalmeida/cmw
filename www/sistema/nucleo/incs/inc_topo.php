<?php

$l_str_nome = $l_obj_seguranca->Get_adm_usr_nome();
$l_boo_tipo_usuario = $l_obj_seguranca->Get_isAdm();

$l_str_verbo="s&atilde;o";

  $l_ar_meses = array ("Janeiro","fevereiro","Mar&ccedil;o","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

  if (date("H") >=0 && date("H")<12)
   $l_str_saudacao = "Bom Dia, "; 
  elseif (date("H") >=12 && date("H")<18)
   $l_str_saudacao = "Boa Tarde, "; 
  elseif (date("H") >=18)
   $l_str_saudacao = "Boa Noite, ";
  
  
                if (date("d") == 1) 
                   $l_str_verbo = "&eacute;";
              
  $l_str_saudacao.= "<b>".$l_str_nome."</b><br>Hoje ". $l_str_verbo." <span class=tx_saudacao>".date("d")." de ".$l_ar_meses[date("m")-1]." de ".date("Y")."</span>"
 ?>


<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
//area de definicao de variaveis globais

var hours = parseInt(<?php echo date("H") ?>);
var minutes = parseInt(<?php echo date("i") ?>);
var seconds = parseInt(<?php echo date("s") ?>);

//fun��o do rel�gio
function funClock() {
// if (!document.layers && !document.all)
// return;
 if (seconds<59){ 
  seconds = seconds + 1;}
 else{
     seconds = 0;
  if (minutes<59){ 
   minutes = minutes + 1;}
  else{
      minutes = 0;
   if (hours<23){ 
    hours = hours + 1;}
   else{
       hours = 0;}
   }
  }   
 var dn = "AM";
 hours2= hours;
 if (hours >= 12) {
  dn = "PM";
  hours2 = hours - 12;
 }
 
 if((hours2 == 0) && (dn = "PM"))
   hours2 = 12;
   
 minutes2 = minutes;
 seconds2 = seconds;
 if (hours == 0) {  hours2 = 12;}
 if (minutes <= 9) { minutes2 = "0" + minutes;}
 if (seconds <= 9) { seconds2 = "0" + seconds;}
 
 movingtime = "<b>"+ hours2 + ":" + minutes2 + ":" + seconds2 + " " + dn + "</b>";
// if (document.layers) {
//  document.layers.clock.document.write(movingtime);
//  document.layers.clock.document.close();
// }
// else if (document.all) {
//  clock.innerHTML = movingtime;
// }

 obj=document.getElementById("clock")
 obj.innerHTML = movingtime;
 
 setTimeout("funClock()", 1000);
}
//  End -->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-bottom:2px solid #405f1c; border-top:1px solid #efefef"> 
<tr>
 <td> 
 <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr>
  <td width="10%" rowspan="2"><img src="../nucleo/imgs/logo.gif"></td>
  <td rowspan="2" align="left" valign="middle" style="padding-left:10px;"><?php echo $l_str_saudacao ?></font></td>
  <td valign="top" align="right"><table cellspacing="0" width="150" border="0" cellpadding="0">
    <tr>
      <td width="50%"><? if ($l_boo_tipo_usuario){ 

   echo "  <table  cellspacing='0' border='0' cellpadding='0' >";
   echo "  <tr>";
                 echo "  <td width='5' valign='top'><img src='../nucleo/imgs/canto_menu_sup_esq.gif' width='5' height='15'></td>";
                 echo "  <td width='60' id='fundo03' align='center'><a href='../adm/ap_index_administracao.php'>Adm</a></td>";
                 echo "  <td width='5' align='right' valign='top'><img src='../nucleo/imgs/canto_menu_sup_dir.gif' width='5' height='15'></td>";    
   echo "  <td width='5'></td>";
   echo "  </tr>";
   echo "  </table>";
     }
  ?>      </td>
      <td width="50%"><table cellspacing="0" border="0" cellpadding="0">
          <tr>
            <td width="5"  valign='top' ><img src='../nucleo/imgs/canto_menu_sup_esq.gif' width='5' height='15' /></td>
            <td width="60" id="fundo03" align="center"><a href="../index.php">[X] Sair</a></td>
            <td width="5" valign="top"><img src='../nucleo/imgs/canto_menu_sup_dir.gif' width='5' height='15' /></td>
            <td width="5"></td>
          </tr>
      </table></td>
    </tr>
  </table></td>
  </tr> 
  <tr> 
  <td width="28%" valign="bottom"> 
   <table border="1" cellspacing="0" cellpadding="0" bordercolor="#C0C0C0" align="right" > 
    <tr> 
    <td> 
     <table border="0" cellspacing="0" cellpadding="2" width="90"> 
      <tr> 
       <td id="fundo03" width="100%"><font size="1" face="Verdana,arial"><span id=clock style="position:relative;width:80"></span>
                        </font></td>
      </tr> 
     </table>    </td>
    </tr>
    </table>   </td>
  </tr> 
 </table>
 </td>
</tr> 
</table>
<script language="JavaScript" type="text/javascript">
//inicia o relogio
funClock();
</script>
