<?php 

function msg($p_fl_msg, $p_fl_janela, $p_str_titulo, $p_str_msg){

    echo "<script language='JavaScript' type='text/javascript'> window.location = '../ap_msg.php?g_fl_tipo=".$p_fl_msg."&g_fl_janela=".$p_fl_janela."&g_str_titulo=".$p_str_titulo."&g_str_msg=".$p_str_msg."'; </script>";

}

function func_str_completa_esquerda($p_str_valor,$p_int_tamcampo,$p_chr_caracter){

  // Atribuir valores as vari�veis 
  $l_str_temp = "";
  
  for ($l_int_count = 1; $l_int_count <= ($p_int_tamcampo - strlen(trim($p_str_valor))); $l_int_count++)
      $l_str_temp = strval($l_str_temp) . strval($p_chr_caracter);

 return $l_str_temp . strval($p_str_valor);

}

function func_str_nome_mes($p_mes){

  // Atribuir valores as variaveis
  $l_str_temp = NULL;

    switch ($p_mes) {
        case 1:
            $l_str_temp = "Janeiro";
            break;
        case 2:
            $l_str_temp = "Fevereiro";
            break;
        case 3:
            $l_str_temp = "Mar&ccedil;o";
            break;
        case 4:
            $l_str_temp = "Abril";
            break;
        case 5:
            $l_str_temp = "Maio";
            break;
        case 6:
            $l_str_temp = "Junho";
            break;
        case 7:
            $l_str_temp = "Julho";
            break;
        case 8:
            $l_str_temp = "Agosto";
            break;
        case 9:
            $l_str_temp = "Setembro";
            break;
        case 10:
            $l_str_temp = "Outubro";
            break;
        case 11:
            $l_str_temp = "Novembro";
            break;
        case 12:
            $l_str_temp = "Dezembro";
            break;
        default:
            $l_str_temp = "Desconhecido";
    }

return $l_str_temp;

}

function func_exclui_arq($p_str_path_arquivo){
   
   //limpa o cache
   clearstatcache ();
   
   //verifica se o arquivo existe
   if (file_exists($p_str_path_arquivo))
        unlink($p_str_path_arquivo); //se existir apaga
}

?>